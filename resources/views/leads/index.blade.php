<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
/>

<x-app-layout>
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
<div class="mt-3">
  <a href="{{ route('leads.dashboard') }}" class="btn btn-outline-danger">
    <i class="bi bi-arrow-left"></i> Back
  </a>
</div>


  <div class="d-flex justify-content-between align-items-center mt-5 mb-4">
    <div>
      <h2 class="fw-bold text-danger mb-0">
        <i class="bi bi-people-fill me-2"></i>
        Leads List - {{ $category ?? 'All Categories' }}
      </h2>

      <p class="text-muted small mb-0">Monitor and manage all your potential client projects.</p>
    </div>

      

    <a href="{{ route('leads.create') }}" class="btn btn-danger shadow-sm">
      <i class="bi bi-plus-circle me-1"></i> Add Lead
    </a>
  </div>

  {{-- Tombol Category berdasarkan data CRM --}}


  {{-- TABLE WRAPPER --}}
  <div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
      <table class="table align-middle mb-0">
        <thead class="bg-danger text-white">
          <tr>
            <th style="width:5%" class="text-center">No</th>
            <th style="width:15%%">
            <span>Created at</span>
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at_asc']) }}" 
              style="text-decoration: none; color: white; font-size: 11px;">&#9650;</a>
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at_desc']) }}" 
              style="text-decoration: none; color: white; font-size: 11px;">&#9660;</a>
            </th>
            <th style="width:15%"  >
            <span>CRM Name</span>
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}" 
              style="text-decoration: none; color: white; font-size: 11px;">&#9650;</a>
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}" 
              style="text-decoration: none; color: white; font-size: 11px;">&#9660;</a>
            </th>

            <th> Category
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'category_asc']) }}" 
              style="text-decoration: none; color: white; font-size: 11px;">&#9650;</a>
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'category_desc']) }}" 
              style="text-decoration: none; color: white; font-size: 11px;">&#9660;</a>
            </th>
         
            <th>
              <span> Status</span>
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'status_asc']) }}" 
              style="text-decoration: none; color: white; font-size: 11px;">&#9650;</a>
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'status_desc']) }}" 
              style="text-decoration: none; color: white; font-size: 11px;">&#9660;</a>
            </th>
            <!--<th>-->
            <!--  <span> Assigned To</span>-->
            <!--  <a href="{{ request()->fullUrlWithQuery(['sort' => 'assigned_to_asc']) }}" -->
            <!--  style="text-decoration: none; color: white; font-size: 11px;">&#9650;</a>-->
            <!--  <a href="{{ request()->fullUrlWithQuery(['sort' => 'assigned_to_desc']) }}" -->
            <!--  style="text-decoration: none; color: white; font-size: 11px;">&#9660;</a>-->
            <!--</th>-->
            <th>Follow Ups</th>
            <th>Last Contact</th>
            <!--<th>Notes</th>-->

            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($leads as $lead)
          <tr class="border-bottom hover-row">
            {{-- Nomor urut otomatis --}}
            <td class="text-center fw-semibold">
                {{ ($leads->currentPage() - 1) * $leads->perPage() + $loop->iteration }}
            </td>

            <td>
              {{ $lead->created_at ? \Carbon\Carbon::parse($lead->created_at)->translatedFormat('d M Y, H:i') : '-' }}
            </td>


            {{-- CRM Name --}}
           <td class="fw-semibold" title="View Detail Lead">
              <a href="{{ route('leads.show', $lead->id) }}" class="text-decoration-none text-dark">
                  {{ $lead->crm->name }}
              </a>
          </td>

            {{-- Category --}}
            <td>
            {{ $lead->crm->category->name ?? '-' }} <br>
            <!-- <small style = "color: red;"> {{$lead->category}}</small> -->
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
            <!--<td>{{ $lead->assignedUser->name ?? '-' }}</td>-->



            {{-- Follow Ups --}}
            <td>
               <a href="{{ route('followups.index', $lead->id) }}" class="text-decoration-none text-dark">
              <i class="bi bi-chat-dots-fill text-danger me-1"></i>
              {{ $lead->followUps->count() }} x
            </a>
            </td>

            {{-- Last Contact --}}
         <td>
            @if($lead->followUps->count())
              @php
                $sortedFollowUps = $lead->followUps->sortByDesc('date');
                $latestFollowUp = $sortedFollowUps->first();
              @endphp

              <div class="dropdown">
                <a href="#" class="text-dark fw-semibold dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  {{ \Carbon\Carbon::parse($latestFollowUp->date)->format('d M Y') }}
                </a>
                <small class="text-muted d-block">
                  {{ $latestFollowUp->created_at->diffForHumans() }}
                </small>

                <ul class="dropdown-menu shadow-lg border-0 rounded-3 p-3" style="min-width: 300px; max-height: 320px; overflow-y: auto;">
                  <li class="fw-semibold text-secondary mb-2 border-bottom pb-2">
                    Riwayat Follow-up
                  </li>

                  @foreach($sortedFollowUps as $followUp)
                    <li class="mb-2">
                      <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semibold text-dark small">
                          {{ \Carbon\Carbon::parse($followUp->date)->format('d M Y') }}
                        </span>
                        <span class="text-muted small">
                          {{ $followUp->created_at->diffForHumans() }}
                        </span>
                      </div>

                      @if(!empty($followUp->type))
                        <div class="text-primary small mt-1">
                          <i class="
                            @if($followUp->type == 'Call') bi-telephone
                            @elseif($followUp->type == 'Email') bi-envelope
                            @elseif($followUp->type == 'Meeting') bi-people
                            @elseif($followUp->type == 'WhatsApp') bi-whatsapp
                            @else bi-chat-dots
                            @endif
                            me-1
                          "></i>
                          <strong>{{ ucfirst($followUp->type) }}</strong>
                        </div>
                      @endif

                      @if(!empty($followUp->notes))
                        <div class="text-muted small mt-1">
                          <i class="bi bi-chat-left-text me-1"></i>{{ $followUp->notes }}
                        </div>
                      @endif

                      @if(!$loop->last)
                        <hr class="my-2">
                      @endif
                    </li>
                  @endforeach
                </ul>
              </div>

              

            @else
              <span class="text-muted">Not Yet</span>
            @endif
          </td>


            {{-- Notes --}}
            <!--<td>-->
            <!--  @if($lead->notes)-->
            <!--    <span title="{{ $lead->notes }}">-->
            <!--      {{ Str::limit($lead->notes, 30) }}-->
            <!--    </span>-->
            <!--  @else-->
            <!--    <span class="text-muted">-</span>-->
            <!--  @endif-->
            <!--</td>-->

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
<div class="mt-3 d-flex justify-content-center">
    {{ $leads->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>




</div>

{{-- CUSTOM STYLE --}}
<style>

  .pagination .page-link {
    color: #dc3545; /* merah Bootstrap */
    border: 1px solid #dc3545;
}

.pagination .page-item.active .page-link {
    background-color: #dc3545;
    border-color: #dc3545;
    color: #fff;
}

/* Hover effect */
.pagination .page-link:hover {
    background-color: #dc3545;
    color: #fff;
    border-color: #dc3545;
}

/* Disabled state */
.pagination .page-item.disabled .page-link {
    color: #ccc;
    border-color: #eee;
    background-color: #fff;
}
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

                .dropdown-menu {
                    position: absolute !important;
                    z-index: 1050 !important;
                  }

  
                .dropdown-menu::-webkit-scrollbar {
                  width: 6px;
                }
                .dropdown-menu::-webkit-scrollbar-thumb {
                  background-color: rgba(0, 0, 0, 0.15);
                  border-radius: 10px;
                }
                .dropdown-menu::-webkit-scrollbar-thumb:hover {
                  background-color: rgba(0, 0, 0, 0.25);
                }

           

</style>


</x-app-layout>
