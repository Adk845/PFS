<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProposalFileController extends Controller
{
    public function store(Request $request, $proposalId)
{
    $request->validate([
        'file' => 'required|file|max:20480', // max 20MB
        'notes' => 'nullable|string',
    ]);

    $proposal = Proposal::findOrFail($proposalId);

    $path = $request->file('file')->store('proposals/' . $proposalId, 'public');

    $proposal->files()->create([
        'file_name' => $request->file('file')->getClientOriginalName(),
        'file_path' => $path,
        'uploaded_by' => auth()->user()->name ?? null,
        'notes' => $request->notes,
    ]);

    return back()->with('success', 'File uploaded successfully.');
}

}
