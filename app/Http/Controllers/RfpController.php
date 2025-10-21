<?php

namespace App\Http\Controllers;

use App\Models\Rfp;
use App\Models\Lead;
use Illuminate\Http\Request;

class RfpController extends Controller
{
    public function index()
    {
        $rfps = Rfp::with('lead')->latest()->get();
        return view('rfp.index', compact('rfps'));
    }

    public function create($lead_id)
    {
        $lead = Lead::findOrFail($lead_id);
        return view('rfp.create', compact('lead'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string'
        ]);

        Rfp::create($request->all());

        return redirect()->route('rfp.index')->with('success', 'RFP created successfully!');
    }

    public function edit(Rfp $rfp)
    {
        return view('rfp.edit', compact('rfp'));
    }

    public function update(Request $request, Rfp $rfp)
    {
        $rfp->update($request->all());

        // Jika status berubah menjadi "awarded", arahkan isi Experience Detail
        if ($rfp->status === 'awarded' && !$rfp->experienceDetail) {
            return redirect()->route('experience.createFromRfp', $rfp->id)
                             ->with('info', 'Please fill the project experience detail.');
        }

        return redirect()->route('rfp.index')->with('success', 'RFP updated successfully!');
    }

    public function destroy(Rfp $rfp)
    {
        $rfp->delete();
        return back()->with('success', 'RFP deleted!');
    }
}
