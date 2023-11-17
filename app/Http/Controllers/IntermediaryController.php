<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntermediarySaveRequest;
use App\Models\Intermediary;
use Illuminate\Http\Request;

class IntermediaryController extends Controller
{
    public function index()
    {
        return view('intermediaries.index', [
            'intermediaries' => Intermediary::orderBy('name')->paginate(25),
        ]);
    }

    public function create()
    {
        return view('intermediaries.create', [
            'intermediary' => new Intermediary,
        ]);
    }

    public function store(IntermediarySaveRequest $request)
    {
        if(! $intermediary = Intermediary::create($request->validated()) ) {
            return back()->with('danger', 'Error saving intermediary, try again please');
        }

        return redirect()->route('intermediaries.index')->with('success', "Intermediary <b>{$intermediary->name}</b> saved");
    }

    public function show(Intermediary $intermediary)
    {
        return view('intermediaries.show', [
            'intermediary' => $intermediary,
        ]);
    }

    public function edit(Intermediary $intermediary)
    {
        return view('intermediaries.edit', [
            'intermediary' => $intermediary,
        ]);
    }

    public function update(IntermediarySaveRequest $request, Intermediary $intermediary)
    {
        if(! $intermediary->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating intermediary, try again please');
        }

        return redirect()->route('intermediaries.edit', $intermediary)->with('success', "Intermediary <b>{$intermediary->name}</b> updated");
    }

    public function destroy(Intermediary $intermediary)
    {
        if(! $intermediary->delete() ) {
            return back()->with('danger', 'Error deleting intermediary, try again please');
        }

        return redirect()->route('intermediaries.index')->with('success', "Intermediary <b>{$intermediary->name}</b> deleted");
    }
}
