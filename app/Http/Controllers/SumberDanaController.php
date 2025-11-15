<?php

namespace App\Http\Controllers;

use App\Models\SumberDana;
use Illuminate\Http\Request;

class SumberDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sumberDanas = SumberDana::latest()->paginate(10);
        return view('sumber_danas.index', compact('sumberDanas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sumber_danas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_sumber_dana' => 'required|unique:sumber_danas|max:255',
            'nama_sumber_dana' => 'required|max:255',
        ]);

        SumberDana::create($request->all());

        return redirect()->route('sumber_danas.index')
                         ->with('success', 'Sumber Dana created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SumberDana $sumberDana)
    {
        return view('sumber_danas.show', compact('sumberDana'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SumberDana $sumberDana)
    {
        return view('sumber_danas.edit', compact('sumberDana'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SumberDana $sumberDana)
    {
        $request->validate([
            'kode_sumber_dana' => 'required|unique:sumber_danas,kode_sumber_dana,' . $sumberDana->id . '|max:255',
            'nama_sumber_dana' => 'required|max:255',
        ]);

        $sumberDana->update($request->all());

        return redirect()->route('sumber_danas.index')
                         ->with('success', 'Sumber Dana updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SumberDana $sumberDana)
    {
        $sumberDana->delete();

        return redirect()->route('sumber_danas.index')
                         ->with('success', 'Sumber Dana deleted successfully.');
    }
}
