<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberSaveRequest;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        return view('members.index', [
            'members' => Member::filtersByRequest($request)->orderBy('id', $request->get('sort', 'desc'))->paginate(25),
            'request' => $request,
        ]);
    }

    public function create()
    {
        return view('members.create', [
            'member' => new Member,
        ]);
    }

    public function store(MemberSaveRequest $request)
    {
        if(! $member = Member::create( $request->validated() ) ) {
            return back()->with('danger', 'Error saving member, try again please');
        }

        return redirect()->route('members.index')->with('success', "You saved the member <b>{$member->full_name}</b>");
    }

    public function show(Member $member)
    {
        $previous = $member->before();
        $next = $member->after();

        return view('members.show', [
            'member' => $member->load('crews.members'),
            'routes' => [
                'previous' => $previous ? route('members.show', $previous) : false,
                'next' => $next ? route('members.show', $next) : false,
            ],
        ]);
    }

    public function edit(Member $member)
    {
        return view('members.edit', [
            'member' => $member,
        ]);
    }

    public function update(MemberSaveRequest $request, Member $member)
    {
        if(! $member->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating member, try again please');
        }

        if( $member->isInactive() ) {
            $member->crews()->detach();
            if($user = $member->user) {
                $user->deactivate();
            }
        } else {
            if($user = $member->user) {
                $user->fill(['is_active' => 1])->save();
            }
        }

        return redirect()->route('members.edit', $member)->with('success', "You updated the member <b>{$member->full_name}</b>");
    }

    public function destroy(Member $member)
    {
        if(! $member->delete() ) {
            return back()->with('danger', 'Error deleting member, try again please');
        }

        return redirect()->route('members.index')->with('success', "You deleted the member <b>{$member->full_name}</b>");
    }
}
