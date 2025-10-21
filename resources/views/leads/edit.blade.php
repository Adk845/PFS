<x-app-layout>
<main class="app-main">
    <!-- Page Header -->


    <!-- 🪪 Page Content -->
    <div class="app-content mt-10">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="card border-0 shadow-lg rounded-4">
                        <div class="card-header text-white rounded-top-4"
                             style="background: linear-gradient(90deg, #880000 0%, #5a0000 100%);">
                            <h5 class="mb-0 fw-semibold">
                                <i class="bi bi-file-earmark-text me-2"></i> Update Lead Record
                            </h5>
                        </div>

                        <div class="card-body bg-light-subtle p-4">
                            <!--  Validation Errors -->
                            @if ($errors->any())
                                <div class="alert alert-danger border-0 shadow-sm">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- 🧾 Form -->
                            <form action="{{ route('leads.update', $lead->id) }}" method="POST" novalidate>
                                @csrf
                                @method('PUT')

                                <div class="row g-4">
                                    <!-- CRM -->
                                   <div class="col-md-6">
                                        <label for="crm_id" class="form-label fw-semibold text-secondary">
                                            <i class="bi bi-building me-1"></i> CRM <span class="text-danger">*</span>
                                        </label>

                                        <!-- Select nonaktif -->
                                        <select id="crm_id" class="form-select form-select-lg shadow-sm" disabled>
                                            @foreach ($crms as $crm)
                                                <option value="{{ $crm->id }}" {{ old('crm_id', $lead->crm_id) == $crm->id ? 'selected' : '' }}>
                                                    {{ $crm->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <!-- Hidden input untuk tetap kirim ke server -->
                                        <input type="hidden" name="crm_id" value="{{ $lead->crm_id }}">
                                    </div>


                                    <!-- Status -->
                                    <!-- <div class="col-md-6">
                                        <label for="status" class="form-label fw-semibold text-secondary">
                                            <i class="bi bi-flag me-1"></i> Status <span class="text-danger">*</span>
                                        </label>
                                        <select id="status" name="status" class="form-select form-select-lg shadow-sm">
                                            <option value="new" {{ old('status', $lead->status) == 'new' ? 'selected' : '' }}>New</option>
                                            <option value="contacted" {{ old('status', $lead->status) == 'contacted' ? 'selected' : '' }}>Contacted</option>
                                            <option value="qualified" {{ old('status', $lead->status) == 'qualified' ? 'selected' : '' }}>Qualified</option>
                                            <option value="unqualified" {{ old('status', $lead->status) == 'unqualified' ? 'selected' : '' }}>Unqualified</option>
                                        </select>
                                    </div> -->

                                <div class="col-md-6">
                                    <label for="category_id" class="form-label fw-semibold text-secondary">
                                        <i class="bi bi-tags me-1"></i> Category
                                    </label>

                                    <select id="category_id" name="category_id" class="form-select form-select-lg shadow-sm">
                                        <option value="">-- Select Category CRM --</option>

                                        {{-- Tampilkan semua kategori kecuali "Others" --}}
                                        @foreach ($categories->where('name', '!=', 'Others') as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $lead->crm->category_id ?? null) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach

                                        {{-- Tambahkan kategori "Others" di bagian bawah (jika ada) --}}
                                        @php
                                            $others = $categories->firstWhere('name', 'Others');
                                        @endphp
                                        @if ($others)
                                            <option value="{{ $others->id }}"
                                                {{ old('category_id', $lead->crm->category_id ?? null) == $others->id ? 'selected' : '' }}>
                                                {{ $others->name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>



                                   

                                    <!-- Assigned To -->
                                   <!-- <div class="col-md-6">
                                        <label for="assigned_to" class="form-label fw-semibold text-secondary">
                                            <i class="bi bi-person-check me-1"></i> Assigned To
                                        </label>
                                        <select id="assigned_to" name="assigned_to" class="form-select form-select-lg shadow-sm">
                                            <option value="">-- Select User --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ old('assigned_to', $lead->assigned_to) == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> -->

                                      <!-- Status -->
                                    <!-- <div class="col-md-6">
                                        <label for="category" class="form-label fw-semibold text-secondary">
                                            <i class="bi bi-flag me-1"></i> Category <span class="text-danger">*</span>
                                        </label>
                                        
                                        <select id="category" name="category" class="form-select form-select-lg shadow-sm" >
                                         <option value="">-- Select Category --</option>    
                                        <option value="universitas" {{ old('category', $lead->category) == 'universitas' ? 'selected' : '' }}>University</option>
                                            <option value="smk" {{ old('category', $lead->category) == 'smk' ? 'selected' : '' }}>SMK</option>
                                            <option value="media partner" {{ old('category', $lead->category) == 'media partner' ? 'selected' : '' }}>Media Partner</option>
                                            <option value="hotel" {{ old('category', $lead->category) == 'hotel' ? 'selected' : '' }}>Hotel</option>
                                            <option value="bank-finance" {{ old('category', $lead->category) == 'bank-finance' ? 'selected' : '' }}>Bank - Finance</option>
                                            <option value="comunity" {{ old('category', $lead->category) == 'comunity' ? 'selected' : '' }}> Comunity</option>
                                            <option value="other institutions" {{ old('category', $lead->category) == 'other institutions' ? 'selected' : '' }}>Other Institutions</option>
                                        </select>
                                    </div> -->


                                    <!-- Notes -->
                                    <!-- <div class="col-12">
                                        <label for="notes" class="form-label fw-semibold text-secondary">
                                            <i class="bi bi-journal-text me-1"></i> Notes
                                        </label>
                                        <textarea id="notes" name="notes" rows="4"
                                                  class="form-control shadow-sm"
                                                  placeholder="Additional information...">{{ old('notes', $lead->notes) }}</textarea>
                                    </div> -->
                                </div>

                                <!-- Buttons -->
                                <div class="d-flex justify-content-end gap-3 mt-4">
                                    <a href="{{ route('leads.index') }}" class="btn btn-outline-secondary px-4">
                                        <i class="bi bi-x-circle"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-danger px-4">
                                        <i class="bi bi-save"></i> Update Lead
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /Card -->
                </div>
            </div>
        </div>
    </div>
</main>
</x-app-layout>
