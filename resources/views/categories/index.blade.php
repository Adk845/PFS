<x-app-layout>

<main class="app-main">
 

  <div class="app-content mt-5">
    <!-- <div class="search-bar-container">
      <div class="input-group search-bar">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input type="text" id="crm-search" class="form-control" placeholder="Search CRM...">
      </div>
    </div> -->

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center w-100">
              <div class="card-title mb-0">Category List</div>
              <div class="ms-auto">
                <a href="{{ route('categories.create') }}" class="btn btn-danger-subtle btn-sm">
                  <i class="bi bi-plus-lg"></i> Add New Category
                </a>
              </div>
            </div>

            <div class="card-body">
              @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
              @endif

              @if($categories->count())
                <div class="table-responsive">
                  <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-danger">
                      <tr>
                        <th style="width: 50px;">No</th>
                       
                         <th>
                          <span> Name</span>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}" 
                            style="text-decoration: none; color: black; font-size: 11px;">&#9650;</a>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}" 
                            style="text-decoration: none; color: black; font-size: 11px;">&#9660;</a>
                          </th>
                        <th style="width: 220px;">Actions</th>
                      </tr>
                    </thead>
                    <tbody id="user-table-body">
                      @foreach($categories as $index => $category)
                        <tr>
                          <td>{{ $index + 1 }}</td>
                          <td>{{ $category->name }}</td>
                          <td>
                          <div class="d-flex gap-2">
                              <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                              </a>
                              <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category data?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                  <i class="bi bi-trash"></i> Delete
                                </button>
                              </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <div class="alert alert-info mt-3">No categories found. Please add a new category data.</div>
              @endif
            </div>

            <div class="card-footer clearfix">
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>
</x-app-layout>
