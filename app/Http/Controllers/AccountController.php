<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountUpdateRequest;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function edit()
    {
        return view('account.edit');
    }

    public function update(AccountUpdateRequest $request)
    {
        $validated = ! $request->filled('password') ? $request->only('email') : $request->validated();

        auth()->user()->update($validated);

        auth()->user()->refresh();

        return redirect()->route('account.edit')->with('success', 'Your account was updated');
    }
}
