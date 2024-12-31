<?php 

namespace App\Exports;

use App\Models\ExperienceDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon; // Import Carbon for date handling
use Illuminate\Support\Collection; // Import Collection for return type hint

class PfsExport implements FromCollection, WithHeadings
{
    /**
     * Get data from the database.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ExperienceDetail::all([
            'id',
            'category', 
            'status', 
            'project_no', 
            'project_name', 
            'client_name', 
            'durations', 
            'amount',
            'date_project_start', 
            'date_project_end', 
            'locations', 
            'kbli_number', 
            'scope_of_work'
        ])->map(function ($experience) {
            return [
                $experience->id,
                $experience->category,
                $experience->status,
                $experience->project_no,
                $experience->project_name,
                $experience->client_name,
                $experience->durations,
                $experience->amount,
                // Format date or return null if the date is not set
                $this->formatDate($experience->date_project_start),
                $this->formatDate($experience->date_project_end),
                $experience->locations,
                $experience->kbli_number,
                $experience->scope_of_work,
            ];
        });
    }

    /**
     * Format the date or return null if it's not a valid date.
     *
     * @param  string|null  $date
     * @return string|null
     */
    private function formatDate($date)
    {
        return $date ? Carbon::parse($date)->format('Y-m-d') : null;
    }

    /**
     * Set the headings for the Excel file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Category',
            'Status',
            'Project No',
            'Project Name',
            'Client Name',
            'Durations',
            'Amount Contract',
            'Date Project Start',
            'Date Project End',
            'Locations',
            'KBLI Number',
            'Scope of Work'
        ];
    }
}
