<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractorSaveRequest;
use App\Models\Contractor;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    public function index()
    {
        return view('contractors.index', [
            'contractors' => Contractor::with('work_orders')->orderBy('id', 'desc')->paginate(25),
        ]);
    }

    public function create()
    {
        return view('contractors.create')->with('contractor', new Contractor);
    }

    public function store(ContractorSaveRequest $request)
    {
        if(! $contractor = Contractor::create($request->validated()) ) {
            return back()->with('danger', 'Error saving contractor, try again please');
        }

        return redirect()->route('contractors.index')->with('success', "You saved the contractor <b>{$contractor->name}</b>");
    }

    public function show(Contractor $contractor)
    {
        $contractor->work_orders->load(['job','crew','client']);

        return view('contractors.show')->with('contractor', $contractor);
    }

    public function edit(Contractor $contractor)
    {
        return view('contractors.edit')->with('contractor', $contractor);
    }

    public function update(ContractorSaveRequest $request, Contractor $contractor)
    {
        if(! $contractor->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating contractor, try again please');
        }

        return redirect()->route('contractors.edit', $contractor)->with('success', "You updated the contractor <b>{$contractor->name}</b>");
    }

    public function destroy(Contractor $contractor)
    {
        if(! $contractor->delete() ) {
            return back()->with('danger', 'Error deleting contractor, try again please');
        }

        return redirect()->route('contractors.index')->with('success', "You deleted the contractor <b>{$contractor->name}</b>");
    }
}
