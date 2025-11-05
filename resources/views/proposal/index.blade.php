<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
/>

<x-app-layout>
     <marquee behavior="scroll" direction="left" scrollamount="6" style="background-color: #ec1b2dff; color: #fce9ebff; padding: 10px; font-weight: bold;">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        Sorry, this page is still under construction.
    </marquee>
<div class="container py-4">

  {{-- ALERTS --}}
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

  {{-- BACK BUTTON --}}
  <div class="mt-3">
    <a href="{{ route('leads.index') }}" class="btn btn-outline-danger">
      <i class="bi bi-arrow-left"></i> Back
    </a>
  </div>

  {{-- HEADER --}}
  <div class="d-flex justify-content-between align-items-center mt-5 mb-4">
    <div>
      <h2 class="fw-bold text-danger mb-0">
        <i class="bi bi-folder-fill me-2"></i>
        Proposal List
      </h2>
      <p class="text-muted small mb-0">Stay organized and keep track of every proposal’s progress</p>
    </div>

    <div>
    <!-- <a href="{{ asset('scripts/open_folder.bat') }}" download class="btn btn-danger shadow-sm">
        <i class="bi bi-folder2-open me-1"></i> Open Folder in Explorer
    </a>

    <a href="file://192.168.2.10/sharing folder" class="btn btn-danger shadow-sm">
      <i class="bi bi-folder2-open me-1"></i> Open Folder in server
    </a> -->




    <a href="{{ route('proposals.create') }}" class="btn btn-danger shadow-sm">
      <i class="bi bi-plus-circle me-1"></i> Add
    </a>
    </div>

  </div>

  {{-- TABLE --}}
  <div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
      <table class="table align-middle mb-0">
        <thead class="bg-danger text-white">
          <tr>
            <th style="width:5%" class="text-center">No</th>
            <th style="width:15%">
              <span>Created at</span>
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at_asc']) }}" style="text-decoration: none; color: white; font-size: 11px;">&#9650;</a>
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at_desc']) }}" style="text-decoration: none; color: white; font-size: 11px;">&#9660;</a>
            </th>
            <th style="width:15%">
              <span>Title</span>
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'title_asc']) }}" style="text-decoration: none; color: white; font-size: 11px;">&#9650;</a>
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'title_desc']) }}" style="text-decoration: none; color: white; font-size: 11px;">&#9660;</a>
            </th>

             <th style="width:20%">
              <span>Name</span>
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}" style="text-decoration: none; color: white; font-size: 11px;">&#9650;</a>
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}" style="text-decoration: none; color: white; font-size: 11px;">&#9660;</a>
            </th>

            <th style="width:10%">
              Status
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'status_asc']) }}" style="text-decoration: none; color: white; font-size: 11px;">&#9650;</a>
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'status_desc']) }}" style="text-decoration: none; color: white; font-size: 11px;">&#9660;</a>
            </th>
            <th style="width:10%">
              <span>PIC</span>
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'pic_asc']) }}" style="text-decoration: none; color: white; font-size: 11px;">&#9650;</a>
              <a href="{{ request()->fullUrlWithQuery(['sort' => 'pic_desc']) }}" style="text-decoration: none; color: white; font-size: 11px;">&#9660;</a>
            </th>
            <th>Description</th>
            <th class="text-center" style="width:10%">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($proposals as $index => $proposal)
          <tr class="hover-row">
            <td class="text-center">{{ $proposals->firstItem() + $index }}</td>
            <td>{{ $proposal->created_at->format('d M Y') }}</td>
            <td>{{ $proposal->title }}</td>
            <!-- <td>{{ $proposal->lead->crm->name }} -->

            <td class="fw-semibold" title="View Detail Lead">
              <a href="{{ route('proposals.show2', $proposal->id) }}" class="text-decoration-none text-dark">
                  {{ $proposal->lead->crm->name  }}
              </a>
              <br>
               <small class="text-danger">{{$proposal->lead->crm->company}}</small>
          </td>
                <!-- <br>
                <small class="text-danger">{{$proposal->lead->crm->company}}</small>
            </td> -->

            <td>
              @php
                $statusColors = [
                    'draft' => 'secondary',
                    'submitted' => 'primary',
                    'awaiting_po' => 'warning',
                    'awarded' => 'success',
                    'decline' => 'danger',
                    'lost' => 'dark'
                ];
              @endphp
              <span class="badge bg-{{ $statusColors[$proposal->status] ?? 'secondary' }}">
                {{ ucfirst(str_replace('_', ' ', $proposal->status)) }}
              </span>
            </td>
            <td>{{ $proposal->assignedUser->name ?? '-' }}</td>
            <td class="text-truncate" style="max-width: 250px;">{{ $proposal->description ?? '-' }}</td>

            <td class="text-center">
              <div class="btn-group">
                <a href="{{ route('proposals.show', $proposal->id) }}" class="btn btn-sm btn-outline-secondary rounded-circle" title="View">
                  <i class="bi bi-eye"></i>
                </a>
                <a href="{{ route('proposals.edit', $proposal->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Edit">
                  <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('proposals.destroy', $proposal->id) }}" method="POST" onsubmit="return confirm('Are you sure want to delete this proposal?')" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Delete">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center text-muted py-4">
                <i class="bi bi-folder-x fs-3 d-block mb-2"></i>
                No proposals found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="mt-3">
    {{ $proposals->links() }}
  </div>

</div>

{{-- STYLE --}}
<style>
  .pagination .page-link {
      color: #dc3545;
      border: 1px solid #dc3545;
  }
  .pagination .page-item.active .page-link {
      background-color: #dc3545;
      border-color: #dc3545;
      color: #fff;
  }
  .pagination .page-link:hover {
      background-color: #dc3545;
      color: #fff;
      border-color: #dc3545;
  }
  .pagination .page-item.disabled .page-link {
      color: #ccc;
      border-color: #eee;
      background-color: #fff;
  }
  .hover-row:hover {
      background-color: #fff5f5;
      transition: 0.2s;
  }
  .card { overflow: hidden; }
  .btn.rounded-circle {
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
  }
</style>

</x-app-layout>
