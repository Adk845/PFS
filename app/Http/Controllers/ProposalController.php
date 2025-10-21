<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\User;
use App\Models\Lead;
use App\Models\ProposalFile;


class ProposalController extends Controller
{
    
public function index(Request $request)
{
    $leads = Lead::all();
    $sort = $request->get('sort', 'created_at_desc');

    $query = Proposal::with('assignedUser');

    switch ($sort) {
        case 'title_asc':
            $query->orderBy('title', 'asc');
            break;
        case 'title_desc':
            $query->orderBy('title', 'desc');
            break;
        case 'status_asc':
            $query->orderBy('status', 'asc');
            break;
        case 'status_desc':
            $query->orderBy('status', 'desc');
            break;
        case 'pic_asc':
            $query->join('users', 'users.id', '=', 'proposals.assign_to')
                ->orderBy('users.name', 'asc')
                ->select('proposals.*');
            break;
        case 'pic_desc':
            $query->join('users', 'users.id', '=', 'proposals.assign_to')
                ->orderBy('users.name', 'desc')
                ->select('proposals.*');
            break;
        default:
            $query->orderBy('created_at', 'desc');
    }

    $proposals = $query->paginate(10);

    return view('proposal.index', compact('proposals', 'leads', 'sort'));
}


    public function create()
{
    $leads = Lead::all();
    $users = User::all();
    return view('proposal.create', compact('leads', 'users'));
}


public function store(Request $request)
{
    $validated = $request->validate([
        'lead_id'     => 'required|exists:leads,id',
        'title'       => 'required|string|max:255',
        'status'      => 'required|in:draft,submitted,awaiting_po,awarded,decline,lost',
        'assign_to'   => 'nullable|exists:users,id',
        'description' => 'nullable|string',
        'files.*'     => 'nullable|file|mimes:pdf,doc,docx,xlsx,xls,ppt,pptx,jpg,jpeg,png|max:10240',
    ]);

    $proposal = Proposal::create([
        'lead_id'     => $validated['lead_id'],
        'title'       => $validated['title'],
        'status'      => $validated['status'],
        'assign_to'   => $validated['assign_to'] ?? null,
        'description' => $validated['description'] ?? null,
    ]);

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $path = $file->store('proposal_files', 'public');

            ProposalFile::create([
                'proposal_id' => $proposal->id,
                'filename'    => $file->getClientOriginalName(),
                'filepath'    => $path,
            ]);
        }
    }

    return redirect()
        ->route('proposals.index')
        ->with('success', 'Proposal has been successfully created!');
}

public function destroy($id)
{
    $proposal = Proposal::findOrFail($id);
    $proposal->delete();

    return redirect()
        ->route('proposals.index')
        ->with('success', 'Proposal has been successfully deleted!');

}

public function show($id)
{
    $proposal = Proposal::with('lead.crm', 'assignedUser', 'files')->findOrFail($id);
    return view('proposal.show', compact('proposal'));
}

}
