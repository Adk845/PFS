<x-app-layout>
<div class="container py-4">

    {{-- Tombol kembali --}}
    <div class="mt-3">
    <a href="{{ route('leads.index') }}" class="btn btn-outline-danger">
        <i class="bi bi-arrow-left"></i> Back
    </a>
    </div>


    {{-- Judul --}}
    <h3 class="fw-bold text-danger mb-4 mt-5">
        <i class="bi bi-people-fill me-2"></i> Detail : {{ $proposal->lead->crm->name ?? '-' }}
    </h3>

    {{--  Card Utama --}}
    <div class="card shadow-sm rounded-4">
        <div class="card-body">

            {{--  Tabs --}}
            <ul class="nav nav-tabs mb-3" id="leadTab" role="tablist">
                
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="proposal-tab" data-bs-toggle="tab" data-bs-target="#proposal" type="button" role="tab">
                         Proposal Information
                    </button>
                </li>

               <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab">
                        Contact Information
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="persona-tab" data-bs-toggle="tab" data-bs-target="#persona" type="button" role="tab">
                         Persona Information
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="followup-tab" data-bs-toggle="tab" data-bs-target="#followup" type="button" role="tab">
                        Follow Up Tracking
                    </button>
                </li>
            </ul>


            
            
   
            {{-- 🔸 Tab Content --}}
            <div class="tab-content" id="leadTabContent">


                    {{-- PROPOSAL TAB --}}
                    <div class="tab-pane fade" id="proposal" role="tabpanel" aria-labelledby="proposal-tab">
                    @if($proposal)

                     <ul class="list-group list-group-flush">

                        <li class="list-group-item proposal-row">
                            <span class="label">Name</span>
                            <span class="colon">:</span>
                            <span class="value">{{ $proposal->lead->crm->name ?? '-' }}</span>
                        </li>

                         <li class="list-group-item proposal-row">
                            <span class="label">PIC</span>
                            <span class="colon">:</span>
                            <span class="value">{{ $proposal->assignedUser->name ?? '-' }}</span>
                        </li>

                        @foreach([
                           
                            'title' => 'Title',
                            'status' => 'Status',
                            'description' => 'Description',
                           
                        ] as $field => $label)
                            <li class="list-group-item proposal-row">
                                <span class="label">{{ $label }}</span>
                                <span class="colon">:</span>
                                <span class="value">
                                    <span class="view-mode">{{ $proposal->$field ?? '-' }}</span>
                                    <input type="text"
                                        class="form-control form-control-sm edit-mode-persona d-none"
                                        data-field="{{ $field }}"
                                        value="{{ $proposal->$field ?? '' }}">
                                </span>
                            </li>
                        @endforeach
                        
                        <li class="list-group-item proposal-row">
                             <span class="label">FIle</span>
                            <span class="colon">:</span>
                            <span class="value">{{ $proposal->files->file_name ?? '-' }}</span>
                        </li>
                    </ul>
                    @else
                        <p class="text-muted">Belum ada data persona.</p>
                    @endif
                </div>

                {{-- CONTACT TAB --}}
                <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="d-flex justify-content-end mb-3">
                        <button id="editBtn" class="btn btn-warning btn-sm me-2">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        <button id="saveBtn" class="btn btn-success btn-sm d-none">
                            <i class="bi bi-check2-circle"></i> Save
                        </button>
                        <button id="cancelBtn" class="btn btn-secondary btn-sm d-none">
                            <i class="bi bi-x-circle"></i> Cancel
                        </button>
                    </div>

                    <ul class="list-group list-group-flush">
                        @php
                            $fields = [
                                'name' => 'Name',
                                'position' => 'Position',
                                'company' => 'Company',
                                'email' => 'Email',
                                'phone' => 'Telephone',
                                'address' => 'Address',
                                'notes' => 'Notes'
                            ];
                        @endphp

                        @foreach ($fields as $field => $label)
                            <li class="list-group-item contact-row">
                                <span class="label">{{ $label }}</span>
                                <span class="colon">:</span>
                                <span class="value">
                                    <span class="view-mode">{{ $proposal->lead->crm->$field ?? '-' }}</span>
                                    <input type="text"
                                        class="form-control form-control-sm edit-mode d-none"
                                        data-field="{{ $field }}"
                                        value="{{ $proposal->lead->crm->$field ?? '' }}">
                                </span>
                            </li>
                        @endforeach

                        <li class="list-group-item contact-row">
                            <span class="label">Category</span>
                            <span class="colon">:</span>
                            <span class="value">{{ $proposal->lead->crm->category->name ?? '-' }}</span>
                        </li>

                        <!-- <li class="list-group-item contact-row">
                            <span class="label">Assigned To</span>
                            <span class="colon">:</span>
                            <span class="value">{{ $lead->assignedUser->name ?? '-' }}</span>
                        </li> -->

                    
                    </ul>
                </div>

                {{-- PERSONA TAB --}}
                        <div class="tab-pane fade" id="persona" role="tabpanel" aria-labelledby="persona-tab">
                    @if($proposal->lead->persona)
                    <div class="d-flex justify-content-end mb-3">
                        <button id="editBtnPersona" class="btn btn-warning btn-sm me-2">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        <button id="saveBtnPersona" class="btn btn-success btn-sm d-none">
                            <i class="bi bi-check2-circle"></i> Save
                        </button>
                        <button id="cancelBtnPersona" class="btn btn-secondary btn-sm d-none">
                            <i class="bi bi-x-circle"></i> Cancel
                        </button>
                    </div>

                    <ul class="list-group list-group-flush">
                        @foreach([
                            'date_of_birth' => 'Date of Birth',
                            'gender' => 'Gender',
                            'education_level' => 'Education',
                            'income_level' => 'Income',
                            'key_interest' => 'Key Interest',
                            'pain_point' => 'Pain Point',
                            'notes' => 'Notes'
                        ] as $field => $label)
                            <li class="list-group-item persona-row">
                                <span class="label">{{ $label }}</span>
                                <span class="colon">:</span>
                                <span class="value">
                                    <span class="view-mode">{{ $proposal->lead->persona->$field ?? '-' }}</span>
                                    <input type="text"
                                        class="form-control form-control-sm edit-mode-persona d-none"
                                        data-field="{{ $field }}"
                                        value="{{ $lead->persona->$field ?? '' }}">
                                </span>
                            </li>   
                        @endforeach
                    </ul>
                    @else
                        <p class="text-muted">Belum ada data persona.</p>
                    @endif
                </div>


                {{-- FOLLOW UP TAB --}}
                <div class="tab-pane fade" id="followup" role="tabpanel" aria-labelledby="followup-tab">
                    @if($proposal->lead->followUps->count())
                        <table class="table table-hover mt-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Type</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proposal->lead->followUps as $index => $fu)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($fu->date)->format('d M Y') }}</td>
                                        <td>{{ ucfirst($fu->type) }}</td>
                                        <td>{{ $fu->notes }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted mt-3">Belum ada follow up.</p>
                    @endif
                </div>
               
            </div>
        </div>
    </div>
</div>

{{-- === STYLE === --}}
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .nav-tabs .nav-link.active {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545 #dc3545 #fff;
    }
    .card .list-group-item {
        border: none;
        padding-left: 0;
    }
    .contact-row, .persona-row, .proposal-row {
        display: grid;
        grid-template-columns: 150px 10px 1fr;
        align-items: center;
        gap: 5px;
    }
    .label { font-weight: 600; }
    .colon { text-align: center; }
    .value { word-break: break-word; }
    .edit-mode, .edit-mode-persona { max-width: 300px; }
</style>

{{-- === SCRIPT === --}}
<script>
document.addEventListener('DOMContentLoaded', () => {

    // === CONTACT TAB ===
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const viewModes = document.querySelectorAll('#contact .view-mode');
    const editModes = document.querySelectorAll('#contact .edit-mode');
    let originalValues = {};

    editBtn.addEventListener('click', () => {
        editModes.forEach(input => {
            originalValues[input.dataset.field] = input.value;
            input.classList.remove('d-none');
        });
        viewModes.forEach(span => span.classList.add('d-none'));
        editBtn.classList.add('d-none');
        saveBtn.classList.remove('d-none');
        cancelBtn.classList.remove('d-none');
    });

    cancelBtn.addEventListener('click', () => {
        editModes.forEach(input => {
            input.value = originalValues[input.dataset.field];
            input.classList.add('d-none');
        });
        viewModes.forEach(span => span.classList.remove('d-none'));
        saveBtn.classList.add('d-none');
        cancelBtn.classList.add('d-none');
        editBtn.classList.remove('d-none');
    });

    saveBtn.addEventListener('click', async () => {
        const id = {{ $proposal->lead->crm->id }};
        const updates = {};
        editModes.forEach(input => updates[input.dataset.field] = input.value);

        try {
            const res = await fetch(`/admin/crm/${id}/update-multiple`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(updates)
            });

            const data = await res.json();
            if (!res.ok || !data.success) throw new Error();

            alert(' Contact data saved successfully!');
            location.reload();
        } catch (err) {
            alert(' Terjadi kesalahan saat menyimpan data contact.');
        }
    });

    // === PERSONA TAB ===
    const editBtnP = document.getElementById('editBtnPersona');
    const saveBtnP = document.getElementById('saveBtnPersona');
    const cancelBtnP = document.getElementById('cancelBtnPersona');
    const editModesP = document.querySelectorAll('#persona .edit-mode-persona');
    const viewModesP = document.querySelectorAll('#persona .view-mode');
    let originalPersona = {};

    if (editBtnP) {
        editBtnP.addEventListener('click', () => {
            editModesP.forEach(input => {
                originalPersona[input.dataset.field] = input.value;
                input.classList.remove('d-none');
            });
            viewModesP.forEach(span => span.classList.add('d-none'));
            editBtnP.classList.add('d-none');
            saveBtnP.classList.remove('d-none');
            cancelBtnP.classList.remove('d-none');
        });

        cancelBtnP.addEventListener('click', () => {
            editModesP.forEach(input => {
                input.value = originalPersona[input.dataset.field];
                input.classList.add('d-none');
            });
            viewModesP.forEach(span => span.classList.remove('d-none'));
            saveBtnP.classList.add('d-none');
            cancelBtnP.classList.add('d-none');
            editBtnP.classList.remove('d-none');
        });

        saveBtnP.addEventListener('click', async () => {
            const id = {{ $lead->persona->id ?? 'null' }};
            const updates = {};
            editModesP.forEach(input => updates[input.dataset.field] = input.value);

            try {
                const res = await fetch(`/persona/${id}/update-multiple`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(updates)
                });

                const data = await res.json();
                if (!res.ok || !data.success) throw new Error();

                alert('✅ Data persona berhasil disimpan!');
                location.reload();
            } catch (err) {
                alert('Terjadi kesalahan saat menyimpan data persona.');
            }
        });
    }
});
</script>
</x-app-layout>
