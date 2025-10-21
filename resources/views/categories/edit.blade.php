<x-app-layout>
<main class="app-main">
    <!--begin::App Content Header-->


    <!--begin::App Content-->
     <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-danger card-outline mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Category</h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-3">
                                    <label for="name">Name Category</label>
                                    <input type="text" name="name" id="name" class="form-control" 
                                           value="{{ old('name', $category->name) }}" required>
                                </div>

                                <div class="d-flex gap-3">
                                    <button type="submit" class="btn btn-warning">
                                        <i class="bi bi-check-lg"></i> Update
                                    </button>
                                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-x-lg"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
            </div>
        </div>
    </div>
</main>
</x-app-layout>
