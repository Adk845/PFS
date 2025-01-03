<?php

namespace App\Imports;

use App\Models\ExperienceDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class PfsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Pastikan ID ada
        if (empty($row['id'])) {
            // Jika ID tidak ada, buat entri baru
            return new ExperienceDetail($this->getProjectData($row, null, null));
        }

        // Format tanggal jika ada dan validasi
        $projectStart = !empty($row['date_project_start']) ? $this->formatDate($row['date_project_start']) : null;
        $projectFinish = !empty($row['date_project_end']) ? $this->formatDate($row['date_project_end']) : null;

        // Mencari proyek berdasarkan ID
        $experience = ExperienceDetail::find($row['id']);
        // dd($this->getProjectData($row, $projectStart, $projectFinish));
        if ($experience) {
            // Jika proyek ditemukan, perbarui semua kolomnya
            $experience->update($this->getProjectData($row, $projectStart, $projectFinish));
        } else {
            // Jika proyek tidak ditemukan, tambahkan data baru
            return new ExperienceDetail($this->getProjectData($row, $projectStart, $projectFinish));
        }
    }

    private function formatDate($date)
    {
        try {
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            return null; // Kembalikan null jika gagal
        }
    }

    private function isValidDate($date)
    {
        return $date && \DateTime::createFromFormat('Y-m-d', $date) !== false;
    }

    private function getProjectData(array $row, $projectStart, $projectFinish)
    { 
        // dd($row);
        return [
            'category' => $row['category'],
            'status' => $row['status'],
            'project_no' => $row['project_no'],
            'project_name' => $row['project_name'],
            'client_name' => $row['client_name'],
            'durations' => $row['durations'],
            'amount' => $row['amount_contract'],
            'date_project_start' => $projectStart,
            'date_project_end' => $projectFinish,
            'locations' => $row['locations'],
            'kbli_number' => $row['kbli_number'],
            'scope_of_work' => $row['scope_of_work'],
        ];
    }
}
