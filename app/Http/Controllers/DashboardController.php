<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExperienceDetail;
use App\Models\Lead;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

public function index()
{
    // Projects per category
    $categoryCounts = ExperienceDetail::select('category', DB::raw('COUNT(*) as total'))
        ->groupBy('category')
        ->get();

    $newLeads = Lead::where('status', 'new')->count();
    $contactedLeads = Lead::where('status', 'contacted')->count();
    $qualifiedLeads = Lead::where('status', 'qualified')->count();
    $totalLeads = Lead::count();

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

         // Projects per category per year (NEW)
    $categoryPerYear = ExperienceDetail::select(
            'category',
            DB::raw('YEAR(date_project_start) as year'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('category', DB::raw('YEAR(date_project_start)'))
        ->orderBy('category')
        ->orderBy('year', 'asc')
        ->get();


           // Statistik singkat
        $totalProjects = ExperienceDetail::count();

    

    return view('dashboard.index', compact(
        'categoryCounts',
        'statusCounts',
        'yearlyCounts',
        'amountPerYear',
        'totalProjects',
        'categoryPerYear',
        'newLeads',
        'contactedLeads',
        'qualifiedLeads',
        'totalLeads'
    ));
}

// DashboardController.php
public function getProjectsByYear($year)
{
    $projects = ExperienceDetail::whereYear('date_project_start', $year)
        ->select('project_no', 'project_name', 'client_name', 'amount')
        ->get();

    return response()->json($projects);
}

public function getProjectsByStatus($status)
{
    $projects = ExperienceDetail::where('status', $status)
        ->select('project_no', 'project_name', 'client_name', 'amount')
        ->get();

    return response()->json($projects);
}



}



