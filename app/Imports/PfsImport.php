<?php

namespace App\Imports;

use App\Models\ExperienceDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PfsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Debugging untuk melihat data yang diterima
        Log::info('Row Data:', $row);

        // Pastikan ID ada atau gunakan fallback
        $id = $row['id'] ?? null;

        // Format tanggal jika ada
        $projectStart = $this->formatDate($row['date_project_start'] ?? null);
        $projectFinish = $this->formatDate($row['date_project_end'] ?? null);

        // Jika ID tidak ada, buat entri baru
        if (!$id) {
            Log::info('Creating new ExperienceDetail entry');
            return new ExperienceDetail($this->getProjectData($row, $projectStart, $projectFinish));
        }

        // Cari proyek berdasarkan ID
        $experience = ExperienceDetail::find($id);

        if ($experience) {
            // Jika proyek ditemukan, perbarui semua kolomnya
            Log::info('Updating ExperienceDetail entry', ['id' => $id]);
            $experience->update($this->getProjectData($row, $projectStart, $projectFinish));
        } else {
            // Jika proyek tidak ditemukan, tambahkan data baru
            Log::info('ExperienceDetail entry not found, creating a new one', ['id' => $id]);
            return new ExperienceDetail($this->getProjectData($row, $projectStart, $projectFinish));
        }
    }

    /**
     * Format tanggal ke format Y-m-d
     */
    private function formatDate($date)
    {
        try {
            if (!$date) {
                return null; // Jika tanggal kosong
            }
            return Carbon::parse($date)->format('Y-m-d'); // Format tanggal
        } catch (\Exception $e) {
            Log::error('Error parsing date: ' . $date, ['exception' => $e]);
            return null; // Jika gagal parsing
        }
    }

    /**
     * Validasi apakah tanggal valid atau tidak
     */
    private function isValidDate($date)
    {
        return $date && \DateTime::createFromFormat('Y-m-d', $date) !== false;
    }

    /**
     * Persiapkan data untuk disimpan ke database
     */
    private function getProjectData(array $row, $projectStart, $projectFinish)
    {
        return [
            'category' => $row['category'] ?? null,
            'status' => $row['status'] ?? null,
            'project_no' => $row['project_no'] ?? null,
            'project_name' => $row['project_name'] ?? null,
            'client_name' => $row['client_name'] ?? null,
            'durations' => $row['durations'] ?? null,
            'amount' => $row['amount'] ?? null,
            'date_project_start' => $projectStart,
            'date_project_end' => $projectFinish,
            'locations' => $row['locations'] ?? null,
            'kbli_number' => $row['kbli_number'] ?? null,
            'scope_of_work' => $row['scope_of_work'] ?? null,
        ];
    }
}