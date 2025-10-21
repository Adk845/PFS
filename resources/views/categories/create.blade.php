<x-app-layout>

<main class="app-main">
    <!--begin::App Content Header-->
    

        <div class="app-content mt-10">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-danger card-outline mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Create CRM</h5>
                        </div>

                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('categories.store') }}" method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="name">Name Category<span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                                </div>

                                                             
                                <div class="d-flex gap-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg"></i> Save
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