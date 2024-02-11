<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberSaveRequest;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $members = Member::filterByParameters( $request->all() )
        ->orderBy('id', $request->get('sort', 'desc'))
        ->paginate(25);

        return view('members.index', [
            'members' => $members,
            'request' => $request,
        ]);
    }

    public function create()
    {
        return view('members.create')->with('member', new Member);
    }

    public function store(MemberSaveRequest $request)
    {
        if(! $member = Member::create( $request->validated() ) ) {
            return back()->with('danger', 'Error saving member, try again please');
        }

        return redirect()->route('members.index')->with('success', "You created the member <b>{$member->full_name}</b>");
    }

    public function show(Member $member)
    {
        $member->load('crews.members');
        return view('members.show')->with('member', $member);
    }

    public function edit(Member $member)
    {
        return view('members.edit')->with('member', $member);
    }

    public function update(MemberSaveRequest $request, Member $member)
    {
        if(! $member->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating member, try again please');
        }

        if( $member->isInactive() ) {
            $member->down();
        } 
        else {
            $member->up();
        }

        return redirect()->route('members.edit', $member)->with('success', "You updated the member <b>{$member->full_name}</b>");
    }

    public function destroy(Member $member)
    {
        if(! $member->delete() ) {
            return back()->with('danger', 'Error deleting member, try again please');
        }

        $member->down();

        return redirect()->route('members.index')->with('success', "You deleted the member <b>{$member->full_name}</b>");
    }
}
