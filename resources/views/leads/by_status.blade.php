<x-app-layout>
{{-- CUSTOM STYLE --}}
<style>
  .hover-row:hover {
    background-color: #fff5f5;
    transition: 0.2s;
  }
  .card {
    overflow: hidden;w
  }
  .btn.rounded-circle {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
 

</style>

<!-- <div class="container-fluid">
    <h1 class="mb-4 text-capitalize">
        {{ $status }} Leads
    </h1>
</div> -->



<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
/>

<div class="container py-4">

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

@if(session('warning'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
      {{ session('warning') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif


  {{-- HEADER --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold text-danger mb-0">
        <i class="bi bi-people-fill me-2"></i> {{$status}} Leads List
      </h2>
      <p class="text-muted small mb-0">Monitor and manage all your potential client projects.</p>
    </div>
    <a href="{{ route('leads.create') }}" class="btn btn-danger shadow-sm">
      <i class="bi bi-plus-circle me-1"></i> Add Lead
    </a>
  </div>

  {{-- TABLE WRAPPER --}}
  <div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
      <table class="table align-middle mb-0">
        <thead class="bg-danger text-white">
          <tr>
            <th style="width:5%" class="text-center">No</th>
            <th style="width:15%%">Created at</th>
            <th style="width:25%"  >Client / CRM</th>
            <th>Status</th>
            <th>Assigned To</th>
            <th>Follow Ups</th>
            <th>Last Contact</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($leads as $lead)
          <tr class="border-bottom hover-row">
            {{-- Nomor urut otomatis --}}
            <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
             <td>{{ $lead->created_at ?? '-' }}</td>

            {{-- CRM Name --}}
           <td class="fw-semibold" title="View Detail Lead">
              <a href="{{ route('leads.show', $lead->id) }}" class="text-decoration-none text-dark">
                  {{ $lead->crm->name }}
              </a>
          </td>


            {{-- Status --}}
            <td>
              @php
                $badgeColors = [
                  'new' => 'secondary',
                  'contacted' => 'info',
                  'qualified' => 'success',
                  'unqualified' => 'danger',
                ];
                $icons = [
                  'new' => 'bi-lightning-charge',
                  'contacted' => 'bi-telephone',
                  'qualified' => 'bi-check-circle',
                  'unqualified' => 'bi-x-circle',
                ];
              @endphp
              <span class="badge bg-{{ $badgeColors[$lead->status] ?? 'secondary' }} px-3 py-2 rounded-pill shadow-sm">
                <i class="bi {{ $icons[$lead->status] ?? 'bi-circle' }} me-1"></i>
                {{ ucfirst($lead->status) }}
              </span>
            </td>

           


            {{-- Assigned To --}}
            <td>{{ $lead->assignedUser->name ?? '-' }}</td>



            {{-- Follow Ups --}}
            <td>
              <i class="bi bi-chat-dots-fill text-danger me-1"></i>
              {{ $lead->followUps->count() }} x
            </td>

            {{-- Last Contact --}}
            <td>
              @if($lead->followUps->count())
                <span class="text-dark fw-semibold">
                  {{ \Carbon\Carbon::parse($lead->followUps->sortByDesc('date')->first()->date)->format('d M Y') }}
                </span>
                <small class="text-muted d-block">
                  {{ $lead->followUps->sortByDesc('date')->first()->created_at->diffForHumans() }}
                </small>
              @else
                <span class="text-muted">Belum ada</span>
              @endif
            </td>

            {{-- Aksi --}}
            <td class="text-center">
              <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('followups.index', $lead->id) }}" 
                   class="btn btn-sm btn-outline-danger rounded-circle" title="View Follow Ups">
                  <i class="bi bi-chat-dots-fill"></i>
                </a>
                <a href="{{ route('leads.edit', $lead) }}" 
                   class="btn btn-sm btn-outline-warning rounded-circle" title="Edit Lead">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('leads.destroy', $lead) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Are you sure you want to delete this lead?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus Lead">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center text-muted py-5">
              <i class="bi bi-inbox fs-1 d-block mb-3"></i>
              Belum ada leads yang tercatat.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>









</x-app-layout>
