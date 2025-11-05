<x-app-layout>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  />

  <div class="container py-4">

    {{-- Alert Section --}}
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

    <div class="d-flex justify-content-between align-items-center mt-5 mb-4 flex-wrap gap-2">
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

    {{-- TABLE WRAPPER --}}
    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
      <div class="card-body p-0">

        {{-- Responsive Scroll Wrapper --}}
        <div class="table-responsive" style="overflow-x: auto;">
          <table class="table table-hover align-middle mb-0 text-nowrap">
            <thead class="bg-danger text-white">
              <tr>
                <th class="text-center">No</th>
                <th>
                  Created at
                  <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at_asc']) }}" class="text-white small text-decoration-none">&#9650;</a>
                  <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at_desc']) }}" class="text-white small text-decoration-none">&#9660;</a>
                </th>
                <th>
                  CRM Name
                  <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}" class="text-white small text-decoration-none">&#9650;</a>
                  <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}" class="text-white small text-decoration-none">&#9660;</a>
                </th>
                <th>
                  Category
                  <a href="{{ request()->fullUrlWithQuery(['sort' => 'category_asc']) }}" class="text-white small text-decoration-none">&#9650;</a>
                  <a href="{{ request()->fullUrlWithQuery(['sort' => 'category_desc']) }}" class="text-white small text-decoration-none">&#9660;</a>
                </th>
                <th>
                  Status
                  <a href="{{ request()->fullUrlWithQuery(['sort' => 'status_asc']) }}" class="text-white small text-decoration-none">&#9650;</a>
                  <a href="{{ request()->fullUrlWithQuery(['sort' => 'status_desc']) }}" class="text-white small text-decoration-none">&#9660;</a>
                </th>
                <th>Follow Ups</th>
                <th>Last Contact
                  <a href="{{ request()->fullUrlWithQuery(['sort' => 'lastcontact_asc']) }}" class="text-white small text-decoration-none">&#9650;</a>
                  <a href="{{ request()->fullUrlWithQuery(['sort' => 'lastcontact_desc']) }}" class="text-white small text-decoration-none">&#9660;</a>
                </th>
                <th class="text-center">Action</th>
              </tr>
            </thead>

            <tbody>
              @forelse($leads as $lead)
                <tr>
                  <td class="text-center fw-semibold">
                    {{ ($leads->currentPage() - 1) * $leads->perPage() + $loop->iteration }}
                  </td>

                  <td>{{ $lead->created_at ? \Carbon\Carbon::parse($lead->created_at)->translatedFormat('d M Y, H:i') : '-' }}</td>

                  <td class="fw-semibold">
                    <a href="{{ route('leads.show', $lead->id) }}" class="text-decoration-none text-dark">
                      {{ $lead->crm->name }}
                    </a>
                  </td>

                  <td>{{ $lead->crm->category->name ?? '-' }}</td>

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

                  <td>
                    <a href="{{ route('followups.index', $lead->id) }}" class="text-decoration-none text-dark">
                      <i class="bi bi-chat-dots-fill text-danger me-1"></i>
                      {{ $lead->followUps->count() }} x
                    </a>
                  </td>

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

                        <ul class="dropdown-menu shadow border-0 rounded-3 p-3" style="min-width: 280px; max-height: 300px; overflow-y: auto;">
                          <li class="fw-semibold text-secondary mb-2 border-bottom pb-2">Follow-up History</li>
                          @foreach($sortedFollowUps as $followUp)
                            <li class="mb-2">
                              <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-semibold text-dark small">{{ \Carbon\Carbon::parse($followUp->date)->format('d M Y') }}</span>
                                <span class="text-muted small">{{ $followUp->created_at->diffForHumans() }}</span>
                              </div>
                              @if($followUp->type)
                                <div class="text-primary small mt-1">
                                  <i class="@if($followUp->type == 'Call') bi-telephone @elseif($followUp->type == 'Email') bi-envelope @elseif($followUp->type == 'Meeting') bi-people @elseif($followUp->type == 'WhatsApp') bi-whatsapp @else bi-chat-dots @endif me-1"></i>
                                  <strong>{{ ucfirst($followUp->type) }}</strong>
                                </div>
                              @endif
                              @if($followUp->notes)
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

                  <td class="text-center">
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                      <a href="{{ route('followups.index', $lead->id) }}" class="btn btn-sm btn-outline-danger rounded-circle" title="View Follow Ups">
                        <i class="bi bi-chat-dots-fill"></i>
                      </a>
                      <a href="{{ route('leads.edit', $lead) }}" class="btn btn-sm btn-outline-warning rounded-circle" title="Edit Lead">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                      <form action="{{ route('leads.destroy', $lead) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this lead?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Delete Lead">
                          <i class="bi bi-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="text-center text-muted py-5">
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

    <div class="mt-3 d-flex justify-content-center">
      {{ $leads->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>

  </div>

  <style>
    .hover-row:hover {
      background-color: #fff5f5;
      transition: 0.2s;
    }
    .btn.rounded-circle {
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .dropdown-menu::-webkit-scrollbar {
      width: 6px;
    }
    .dropdown-menu::-webkit-scrollbar-thumb {
      background-color: rgba(0, 0, 0, 0.15);
      border-radius: 10px;
    }

    /* Responsive Mobile View */
    @media (max-width: 768px) {
      .table-responsive {
        border: none !important;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
      }
      table.table th,
      table.table td {
        font-size: 13px;
        white-space: nowrap;
      }
      .btn.rounded-circle {
        width: 32px;
        height: 32px;
      }
      h2.fw-bold {
        font-size: 1.2rem;
      }
      .d-flex.justify-content-between {
        flex-direction: column !important;
        align-items: start !important;
      }
    }
  </style>
</x-app-layout>
