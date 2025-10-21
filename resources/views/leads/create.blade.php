<x-app-layout>
    <div class="container py-5">
        <!-- Card Utama -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <!-- Header Card -->
            <div class=" bg-danger card-header bg-gradient text-white py-3" 
                 style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                    <div>
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-person-plus me-2"></i> Add Lead
                        </h5>
                    </div>
                </div>
            </div>

            <!-- Body Card -->
            <div class="card-body p-4">
                <form action="{{ route('leads.store') }}" method="POST">
                    @csrf
                   


                   

                    <div class="row g-4">
                        <!-- Status -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary">Status</label>
                            <select name="status" class="form-select shadow-sm">
                                <option value="new">New</option>
                                <option value="contacted">Contacted</option>
                                <option value="qualified">Qualified</option>
                                <option value="unqualified">Unqualified</option>
                            </select>
                        </div>

                             <div class="col-md-6">
                            <label for="crm_id" class="form-label fw-semibold text-secondary">
                                <i class="bi bi-building me-1 text-primary"></i> CRM Name
                            </label>
                            <select name="crm_id" id="crm_id" 
                                    class="form-select shadow-sm @error('crm_id') is-invalid @enderror">
                                <option value="">-- Select CRM --</option>
                                @foreach($crms as $crm)
                                    <option value="{{ $crm->id }}" 
                                        {{ old('crm_id') == $crm->id ? 'selected' : '' }}>
                                        {{ $crm->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('crm_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Assigned To -->
                        <div class="col-md-6">
                            <label for="assigned_to" class="form-label fw-semibold text-secondary">
                                <i class="bi bi-person-circle me-1 text-primary"></i> Assigned To
                            </label>
                            <select name="assigned_to" id="assigned_to" 
                                    class="form-select shadow-sm @error('assigned_to') is-invalid @enderror">
                                <option value="">-- Select User --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" 
                                        {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('assigned_to')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>



                        <!-- Catatan -->
                        <div class="col-12">
                            <label class="form-label fw-semibold text-secondary">Notes</label>
                            <textarea name="notes" rows="4" class="form-control shadow-sm" 
                                      placeholder="Enter additional notes"></textarea>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('crm.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                        <a href="{{ url()->previous() }}" class="btn btn-outline-danger px-4">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        .card {
            border-radius: 1.25rem;
            transition: all 0.25s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }

        .form-control, .form-select {
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            border: 1px solid #dee2e6;
            transition: 0.2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.15rem rgba(78,115,223,0.25);
        }

        textarea {
            resize: none;
        }

        .btn {
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .bg-gradient {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
    </style>
</x-app-layout>
