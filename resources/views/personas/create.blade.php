<x-app-layout>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">Tambah Customer Persona</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('personas.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="crm_id" class="form-label">CRM</label>
                    <select name="crm_id" id="crm_id" class="form-select" required>
                        <option value="">-- Pilih CRM --</option>
                        @foreach($crms as $crm)
                            <option value="{{ $crm->id }}" {{ $selectedCrmId == $crm->id ? 'selected' : '' }}>
                                {{ $crm->name }} - {{ $crm->company }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="Male">Laki-laki</option>
                            <option value="Female">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="occupation" class="form-label">Pekerjaan</label>
                    <input type="text" name="occupation" id="occupation" class="form-control" placeholder="Contoh: Marketing Manager">
                </div>

                <div class="mb-3">
                    <label for="income_level" class="form-label">Tingkat Pendapatan</label>
                    <input type="text" name="income_level" id="income_level" class="form-control" placeholder="Contoh: Rp10.000.000/bulan">
                </div>

                <div class="mb-3">
                    <label for="education_level" class="form-label">Pendidikan</label>
                    <input type="text" name="education_level" id="education_level" class="form-control" placeholder="Contoh: S1 Ilmu Komunikasi">
                </div>

                <div class="mb-3">
                    <label for="key_interest" class="form-label">Minat Utama</label>
                    <input type="text" name="key_interest" id="key_interest" class="form-control" placeholder="Contoh: Teknologi, Pemasaran Digital">
                </div>

                <div class="mb-3">
                    <label for="pain_point" class="form-label">Masalah yang Dihadapi</label>
                    <input type="text" name="pain_point" id="pain_point" class="form-control" placeholder="Contoh: Kesulitan menjangkau target audiens">
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Catatan</label>
                    <textarea name="notes" id="notes" rows="4" class="form-control" placeholder="Tambahkan catatan tambahan..."></textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>
