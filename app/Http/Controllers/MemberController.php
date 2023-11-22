<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberSaveRequest;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('members.index', [
            'members' => Member::orderBy('name')->paginate(25),
        ]);
    }

    public function create()
    {
        return view('members.create', [
            'member' => new Member,
            'categories' => Member::getCategories(),
            'scopes' => array_reverse(Member::getScopes()),
        ]);
    }

    public function store(MemberSaveRequest $request)
    {
        if(! $member = Member::create( $request->validated() ) ) {
            return back()->with('danger', 'Error saving member, try again please');
        }

        return redirect()->route('members.index')->with('success', "You saved the member <b>{$member->fullname}</b>");
    }

    public function show(Member $member)
    {
        return view('members.show', [
            'member' => $member,
        ]);
    }

    public function edit(Member $member)
    {
        return view('members.edit', [
            'member' => $member,
            'categories' => Member::getCategories(),
            'scopes' => array_reverse(Member::getScopes()),
        ]);
    }

    public function update(MemberSaveRequest $request, Member $member)
    {
        if(! $member->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating member, try again please');
        }

        return redirect()->route('members.edit', $member)->with('success', "You updated the member <b>{$member->fullname}</b>");
    }

    public function destroy(Member $member)
    {
        if(! $member->delete() ) {
            return back()->with('danger', 'Error deleting member, try again please');
        }

        return redirect()->route('members.index')->with('success', "You deleted the member <b>{$member->fullname}</b>");
    }
}
