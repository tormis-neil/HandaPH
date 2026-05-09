<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TyphoonMyth;
use App\Http\Requests\StoreTyphoonMythRequest;
use App\Http\Requests\UpdateTyphoonMythRequest;

class TyphoonMythController extends Controller
{
    public function index()
    {
        $myths = TyphoonMyth::latest()->get();
        return view('admin.typhoon-myths', compact('myths'));
    }

    public function store(StoreTyphoonMythRequest $request)
    {
        TyphoonMyth::create($request->validated());
        return redirect()->route('admin.typhoon-myths.index')->with('success', 'Typhoon myth added successfully.');
    }

    public function update(UpdateTyphoonMythRequest $request, TyphoonMyth $typhoonMyth)
    {
        $typhoonMyth->update($request->validated());
        return redirect()->route('admin.typhoon-myths.index')->with('success', 'Typhoon myth updated successfully.');
    }

    public function destroy(TyphoonMyth $typhoonMyth)
    {
        $typhoonMyth->delete();
        return redirect()->route('admin.typhoon-myths.index')->with('success', 'Typhoon myth deleted successfully.');
    }
}
