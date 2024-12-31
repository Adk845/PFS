<?php

namespace App\Imports;

use App\Models\ExperienceDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon; // Import Carbon for date handling
use Illuminate\Support\Facades\Log; // Import Log for debugging

class PfsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Debugging untuk memeriksa data yang diterima
        Log::info('Imported Row:', $row);

        $projectStart = !empty($row['date_project_start']) ? $this->formatDate($row['date_project_start']) : null;
        $projectFinish = !empty($row['date_project_end']) ? $this->formatDate($row['date_project_end']) : null;

        // Cek jika 'id' kosong atau tidak, jika kosong maka buat data baru
        if (empty($row['id'])) {
            Log::info('Inserting new project with data:', $row);
            return new ExperienceDetail($this->getProjectData($row, $projectStart, $projectFinish));
        }

        // Cari data project berdasarkan 'id'
        $project = ExperienceDetail::find($row['id']);
        if ($project) {
            Log::info('Updating project with ID: ' . $row['id']);
            $project->update($this->getProjectData($row, $projectStart, $projectFinish));
        } else {
            Log::info('Inserting new project with data:', $row);
            return new ExperienceDetail($this->getProjectData($row, $projectStart, $projectFinish));
        }
    }

    private function formatDate($date)
    {
        try {
            // Coba parsing tanggal ke format yang standar 'Y-m-d'
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            // Jika gagal parsing, kembalikan null
            Log::error('Error parsing date: ' . $date, ['exception' => $e->getMessage()]);
            return null;
        }
    }

    private function getProjectData(array $row, $projectStart, $projectFinish)
    {
        // Mapping data dari baris Excel ke field-model ExperienceDetail
        return [
            'category' => $row['category'],
            'status' => $row['status'],
            'project_no' => $row['project_no'],
            'project_name' => $row['project_name'],
            'client_name' => $row['client_name'],
            'durations' => $row['durations'],
            'date_project_start' => $projectStart,
            'date_project_end' => $projectFinish,
            'locations' => $row['locations'],
            'amount' => $row['amount'],
            'kbli_number' => $row['kbli_number'],
            'scope_of_work' => $row['scope_of_work'],
        ];
    }
}
