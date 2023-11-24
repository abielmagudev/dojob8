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
            'intermediaries' => Intermediary::orderBy('id', 'desc')->paginate(25),
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

        return redirect()->route('intermediaries.index')->with('success', "You saved the intermediary <b>{$intermediary->name}</b>");
    }

    public function show(Intermediary $intermediary)
    {
        $previous = Intermediary::before($intermediary->id)->first();
        $next = Intermediary::after($intermediary->id)->first();

        return view('intermediaries.show', [
            'intermediary' => $intermediary,
            'routes' => [
                'previous' => $previous ? route('intermediaries.show', $previous) : false,
                'next' => $next ? route('intermediaries.show', $next) : false,
            ],
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

        return redirect()->route('intermediaries.edit', $intermediary)->with('success', "You updated the intermediary <b>{$intermediary->name}</b>");
    }

    public function destroy(Intermediary $intermediary)
    {
        if(! $intermediary->delete() ) {
            return back()->with('danger', 'Error deleting intermediary, try again please');
        }

        return redirect()->route('intermediaries.index')->with('success', "You deleted the intermediary <b>{$intermediary->name}</b>");
    }
}
