<?php

namespace App\Http\Controllers;

use App\Models\Mou;
use Illuminate\Http\Request;

class MouController
{
    // Fetch all MoUs and pass them to the view
    public function index()
    {
        $mous = Mou::orderBy('created_at', 'desc')->get();
        return view('mous', compact('mous'));
    }

    // Validate and save a new MoU
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'parties_involved' => 'required|string|max:255',
            'effective_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Mou::create($validated);

        return redirect()->route('mous.index')->with('success', 'MoU added successfully!');
    }

    // Delete an MoU
    public function destroy(Mou $mou)
    {
        $mou->delete();
        return redirect()->route('mous.index')->with('success', 'MoU deleted!');
    }
}