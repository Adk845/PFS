<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExperienceDetail;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

public function index()
{
    // Projects per category
    $categoryCounts = ExperienceDetail::select('category', DB::raw('COUNT(*) as total'))
        ->groupBy('category')
        ->get();

    // Projects per status
    $statusCounts = ExperienceDetail::select('status', DB::raw('COUNT(*) as total'))
        ->groupBy('status')
        ->get();

    // Projects per year (pakai date_project_start)
    $yearlyCounts = ExperienceDetail::select(
            DB::raw('YEAR(date_project_start) as year'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy(DB::raw('YEAR(date_project_start)'))
        ->orderBy('year', 'asc')
        ->get();

    // Total amount per year (convert amount string jadi integer)
    $amountPerYear = ExperienceDetail::select(
            DB::raw('YEAR(date_project_start) as year'),
            DB::raw('SUM(REPLACE(amount, ".", "")) as total_amount')
        )
        ->groupBy(DB::raw('YEAR(date_project_start)'))
        ->orderBy('year', 'asc')
        ->get();

           // Statistik singkat
        $totalProjects = ExperienceDetail::count();

    

    return view('dashboard.index', compact(
        'categoryCounts',
        'statusCounts',
        'yearlyCounts',
        'amountPerYear',
        'totalProjects'
    ));
}


}



