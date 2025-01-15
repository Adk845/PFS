<?php

namespace App\Http\Controllers;

use App\Models\ExperienceDetail;
use App\Models\Image;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PfsExport;
use App\Imports\PfsImport;


class ExperienceDetailController extends Controller
{

    public function export() 
    {
        return Excel::download(new PfsExport, 'pfs.xlsx');
    }

    public function import(Request $request)
    {
        // dd($request);
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv', // Validasi tipe file
        ]);

        // Lakukan import
        Excel::import(new PfsImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data imported successfully!');
    }

    public function generatePdfAll(Request $request)
    {
        
        $search = $request->input('search');
        $category = $request->input('category');
        
      
        $query = ExperienceDetail::query();
        
        if ($search) {
            $query->where('project_name', 'like', '%' . $search . '%');
        }
    
        if ($category) {
            $query->where('category', $category);
        }
    
      
        $experiences = $query->get();
    
        if ($experiences->isEmpty()) {
            return redirect()->route('experiences.index')->with('error', 'No experiences found.');
        }
    
        
        $experienceIds = $experiences->pluck('id');  
        $images = Image::whereIn('experience_detail_id', $experienceIds)->get();  
    
        
        $pdf = PDF::loadView('pdf.all_experience', ['experiences' => $experiences, 'images' => $images])
                   ->setPaper('a4', 'landscape');
        
       
        return $pdf->stream('all-experiences.pdf');
    }
    
    


    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $paginate = $request->input('pagination');
        
    
        $experiences_query = ExperienceDetail::query()
            ->when($search, function($query, $search) {
                return $query->where('project_name', 'like', "%{$search}%")
                             ->orWhere('client_name', 'like', "%{$search}%");
            })
            ->when($category, function($query, $category) {
                return $query->where('category', $category);
            });  // Adjust pagination as needed

            if($paginate === 'all') {
                $experiences = $experiences_query->get();
            } else {
                $experiences = $experiences_query->paginate((int) $paginate);
                $experiences->appends($request->all());
            }

            // return($experiences);
        return view('experience_detail.index', compact('experiences'));
    }

public function generatePdffs($id)
{
    $images = Image::where('experience_detail_id', $id)->get();
    $experiences = ExperienceDetail::find($id);
    if (!$experiences) {
        return redirect()->route('experience_detail.index')->with('error', 'Experience Detail not found.');
    }

    $pdf = PDF::loadView('experience_detail.pdffs', [
        'experiences' => $experiences,
        'images' => $images
    ])
    ->setPaper('a4', 'portrait');
    return $pdf->stream('ExperienceDetail.pdf');
}
    


public function generateBast($id)
{
    $images = Image::where('experience_detail_id', $id)->get();
    $experiences = ExperienceDetail::find($id);
    if (!$experiences) {
        return redirect()->route('experience_detail.index')->with('error', 'Experience Detail not found.');
    }

    $pdf = PDF::loadView('experience_detail.bast', [
        'experiences' => $experiences,
        'images' => $images
    ])
    ->setPaper('a4', 'portrait');
    return $pdf->stream('Certificate.pdf');
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
       'category' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'project_no' => 'required|string|max:255',
        'project_name' => 'required|string|max:255',
        'client_name' => 'required|string|max:255', 
        'durations' => 'required|string|max:255',     
        'date_project_start' => 'required|date',
        'date_project_end' => 'required|date',
        'locations' => 'required|string|max:255',
        'amount' => 'nullable|string|max:255',

        'kbli_number' => 'required|string|max:255',
        'scope_of_work' => 'required|string|max:600',
        'images.*' => 'image|mimes:jpeg,png,jpg,gifmax:6048',
    ]);

    $experienceDetail = new ExperienceDetail();
    $experienceDetail->category = $request->category;
    $experienceDetail->status = $request->status;
    $experienceDetail->project_no = $request->project_no;
    $experienceDetail->project_name = $request->project_name;
    $experienceDetail->client_name = $request->client_name;
    $experienceDetail->durations = $request->durations;
    $experienceDetail->date_project_start = $request->date_project_start;
    $experienceDetail->date_project_end = $request->date_project_end;
    $experienceDetail->locations = $request->locations;
    $experienceDetail->amount = $request->amount;

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
    // Menarik data ExperienceDetail beserta relasi 'Images'
    $experienceDetail = ExperienceDetail::with(['Images'])->findOrFail($id);

    // Ambil kategori dari $experienceDetail, misalnya jika ada kolom 'category' di ExperienceDetail
    $category = $experienceDetail->category;

    // Kirimkan ke tampilan
    return view('experience_detail.edit', compact('experienceDetail', 'category'));
}


public function edit_api($id)
{
    $experienceDetail = ExperienceDetail::with(['Images'])->findOrFail($id);
    return response()->json($experienceDetail);
}


public function update(Request $request, $id)
{
    // dd($request->all());
    // if ($request->has('images_id')) {
    //     foreach($request->images_id as $index =>  $image_id) {
    //         $image = Image::find($image_id);
    //         dd($image);
    //         if($image){
    //             Storage::disk('images')->delete($image->path);
    //             dd('ketemu');
    //         }
    //     }
    // }
    // dd('gak dapet');
    $request->validate([
        'category' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'project_no' => 'required|string|max:255',
        'project_name' => 'required|string|max:255',
        'client_name' => 'required|string|max:255', 
        'durations' => 'required|string|max:255',     
        'date_project_start' => 'required|date',
        'date_project_end' => 'required|date',
        'locations' => 'required|string|max:255',
        'amount' => 'nullable|string|max:255',

        'kbli_number' => 'required|string|max:255',
        'scope_of_work' => 'required|string|max:600',
        'images.*' => 'image|mimes:jpeg,png,jpg,gifmax:6048',
    ]);
    $experienceDetail = ExperienceDetail::findOrFail($id);

    $experienceDetail->category = $request->category;
    $experienceDetail->status = $request->status;
    $experienceDetail->project_no = $request->project_no;
    $experienceDetail->project_name = $request->project_name;
    $experienceDetail->client_name = $request->client_name;
    $experienceDetail->durations = $request->durations;
    $experienceDetail->date_project_start = $request->date_project_start;
    $experienceDetail->date_project_end = $request->date_project_end;
    $experienceDetail->locations = $request->locations;
    $experienceDetail->amount = $request->amount;
    $experienceDetail->kbli_number = $request->kbli_number;
    $experienceDetail->scope_of_work = $request->scope_of_work;

    $experienceDetail->save();

    // untuk mengedit dengan menghapus gambar yang sudah ada 
    
    if ($request->has('images_id_delete')) {
        foreach($request->images_id_delete as $index =>  $image_id) {
            $image = Image::find($image_id);
            // dd($image->foto);
            if($image){
               Storage::disk('public')->delete($image->foto);
               $image->delete();
                // dd('success deleted image')
            }
        }
    }

    // untuk mengedit dengan mengganti gambar dengan yang baru, hapus yang lama dan ganti dengan yang baru
    if ($request->has('images_id')) {
        foreach($request->images_id as $index =>  $image_id) {
            $image = Image::find($image_id);
            // dd($image->foto);
            if($image){
               Storage::disk('public')->delete($image->foto);
               $image->delete();
                // dd('success deleted image')
            }
        }
    }
    if ($request->has('images')) {
        foreach ($request->file('images') as $file) {
            $path = $file->store('images', 'public'); 
            Image::create([ 
                'experience_detail_id' => $experienceDetail->id,
                'foto' => $path,
            ]);
        }
    }
    return redirect()->route('experiences.index');
   
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
