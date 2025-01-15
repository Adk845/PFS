<?php

namespace App\Exports;

use App\Models\ExperienceDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PfsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Mengambil data ExperienceDetail untuk di-export.
     */
    public function collection()
    {
        // Ambil data ExperienceDetail dari database
        return ExperienceDetail::all();
    }

    /**
     * Header kolom yang muncul di file Excel
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
            'Amount',
            'Date Project Start',
            'Date Project End',
            'Locations',
            'KBLI Number',
            'Scope of Work',
        ];
    }

    /**
     * Mapping data untuk setiap baris
     */
    public function map($experience): array
    {
        return [
            $experience->id,
            $experience->category,
            $experience->status,
            $experience->project_no,
            $experience->project_name,
            $experience->client_name,
            $experience->durations,
            $experience->amount,
            $this->formatDate($experience->date_project_start),
            $this->formatDate($experience->date_project_end),
            $experience->locations,
            $experience->kbli_number,
            $experience->scope_of_work,
        ];
    }

    /**
     * Format tanggal ke format Y-m-d
     */
    private function formatDate($date)
    {
        return $date ? \Carbon\Carbon::parse($date)->format('Y-m-d') : null;
    }
}