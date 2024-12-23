<?php

namespace App\Http\Controllers;

use App\Models\ExperienceDetail;
use App\Models\Image;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


class ExperienceDetailController extends Controller
{


    public function generatePdffs($id)
    {
        $experiences = ExperienceDetail::find($id);
        if (!$experiences) {
            return redirect()->route('experience_detail.index')->with('error', 'Experience Detail not found.');
        }
    
       
        $pdf = PDF::loadView('experience_detail.pdffs', ['experiences' => $experiences])
            ->setPaper('a4', 'portrait'); 
    
        
        return $pdf->stream('ExperienceDetail.pdf');
    }
    
    
    public function index(Request $request)
    {
       
        $experiences = ExperienceDetail::all();

        return view('experience_detail.index', [
            'experiences' => $experiences
        ]);
    }

    public function guest(Request $request)
    {
       
        $experiences = ExperienceDetail::all();

        return view('welcome', [
            'experiences' => $experiences
        ]);
    }

    public function create()
    {
        return view('experience_detail.create');
    }


    public function store(Request $request)
{     
    $request->validate([
        'categories.*' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'project_no' => 'required|string|max:255',
        'project_name' => 'required|string|max:255',
        'client_name' => 'required|string|max:255', 
        'durations' => 'required|string|max:255',     
        'date_project_start' => 'required|date',
        'date_project_end' => 'required|date',
        'locations' => 'required|string|max:255',
        'kbli_number' => 'required|string|max:255',
        'scope_of_work' => 'required|string',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $experienceDetail = new ExperienceDetail();
    $experienceDetail->category = implode("|", $request->categories ?? []);
    $experienceDetail->status = $request->status;
    $experienceDetail->project_no = $request->project_no;
    $experienceDetail->project_name = $request->project_name;
    $experienceDetail->client_name = $request->client_name;
    $experienceDetail->durations = $request->durations;
    $experienceDetail->date_project_start = $request->date_project_start;
    $experienceDetail->date_project_end = $request->date_project_end;
    $experienceDetail->locations = $request->locations;
    $experienceDetail->kbli_number = $request->kbli_number;
    $experienceDetail->scope_of_work = $request->scope_of_work;

    $experienceDetail->save(); 
  
    if ($request->has('images')) {
        foreach ($request->file('images') as $file) {
            $path = $file->store('images', 'public'); 
            Image::create([ 
                'experience_detail_id' => $experienceDetail->id,
                'foto' => $path,
            ]);
        }
    }

    // return response()->json([
    //     'status' => 'success',
    //     'message' => 'Experience detail created successfully.',
    //     'data' => $experienceDetail,
    // ], 201);

    return redirect()->route('experiences.index');
}

public function edit($id)
{
    //=============contoh EAGER LOADING with(['images']) 'images' ini ngikutin nama method relation nya, disini nama model nya 'image'
    //==============tapi relations model nya di experienceDetail model 'images'
    $experienceDetail = ExperienceDetail::with(['Images'])->findOrFail($id);
    // dd($experienceDetail);
    return view('experience_detail.edit', compact('experienceDetail'));
}

public function edit_api($id)
{
    $experienceDetail = ExperienceDetail::with(['Images'])->findOrFail($id);
    return response()->json($experienceDetail);
}


public function update(Request $request, $id)
{
    // dd($request->all());
    $request->validate([
        'categories.*' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'project_no' => 'required|string|max:255',
        'project_name' => 'required|string|max:255',
        'client_name' => 'required|string|max:255', 
        'durations' => 'required|string|max:255',     
        'date_project_start' => 'required|date',
        'date_project_end' => 'required|date',
        'locations' => 'required|string|max:255',
        'kbli_number' => 'required|string|max:255',
        'scope_of_work' => 'required|string',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    //  dd($request->all());
    $experienceDetail = ExperienceDetail::findOrFail($id);

    $experienceDetail->category = implode("|", $request->categories ?? []);
    $experienceDetail->status = $request->status;
    $experienceDetail->project_no = $request->project_no;
    $experienceDetail->project_name = $request->project_name;
    $experienceDetail->client_name = $request->client_name;
    $experienceDetail->durations = $request->durations;
    $experienceDetail->date_project_start = $request->date_project_start;
    $experienceDetail->date_project_end = $request->date_project_end;
    $experienceDetail->locations = $request->locations;
    $experienceDetail->kbli_number = $request->kbli_number;
    $experienceDetail->scope_of_work = $request->scope_of_work;

    $experienceDetail->save();

    if ($request->has('image')) {
        foreach ($request->file('image') as $file) {
            $path = $file->store('images', 'public'); 
            Image::create([ 
                'experience_detail_id' => $experienceDetail->id,
                'foto' => $path,
            ]);
        }
    }
    return redirect()->route('experiences.index');
    // return response()->json([
    //     'status' => 'success',
    //     'message' => 'Experience detail updated successfully.',
    //     'data' => $experienceDetail,
    // ], 200);
}

public function destroy($id)
{
    $experienceDetail = ExperienceDetail::findOrFail($id);

    $images = Image::where('experience_detail_id', $id)->get();
    foreach ($images as $image) {
        if (Storage::disk('public')->exists($image->foto)) {
            Storage::disk('public')->delete($image->foto);
        }
        $image->delete();
    }

    $experienceDetail->delete();
    return redirect()->route('experiences.index');
    // return response()->json([
    //     'status' => 'success',
    //     'message' => 'Experience detail deleted successfully.',
    // ], 200);
}


    



    

}
