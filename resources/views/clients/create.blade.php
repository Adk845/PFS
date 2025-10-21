<x-app-layout>
<main class="app-main">
    <!--  Page Header -->
    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h3 class="fw-bold text-danger mb-2">
                    <i class="bi bi-person-plus-fill me-2"></i> Add CRM Data
                </h3>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-dark">Create CRM</li>
                </ol>
            </div>
        </div>
    </div>

    <!--  Page Content -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <!-- 🪪 Card -->
                    <div class="card border-0 shadow-lg rounded-4">
                        <div class="card-header text-white rounded-top-4"
                             style="background: linear-gradient(90deg, #dc3545 0%, #b02a37 100%);">
                            <h5 class="mb-0 fw-semibold">
                                <i class="bi bi-file-earmark-text me-2"></i> Create CRM Record
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

                            <!-- Form -->
                            <form action="{{ route('crm.store') }}" method="POST" novalidate>
                                @csrf

                                <div class="row g-4">
                                    <!-- Full Name -->
                                    <div class="col-md-6">
                                        <label for="name" class="form-label fw-semibold text-secondary">
                                            <i class="bi bi-person me-1"></i> Full Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" id="name" name="name"
                                               class="form-control form-control-lg shadow-sm"
                                               placeholder="Enter full name"
                                               value="{{ old('name') }}" required>
                                    </div>

                                    <!-- Position -->
                                    <div class="col-md-6">
                                        <label for="position" class="form-label fw-semibold text-secondary">
                                            <i class="bi bi-briefcase me-1"></i> Position
                                        </label>
                                        <input type="text" id="position" name="position"
                                               class="form-control form-control-lg shadow-sm"
                                               placeholder="Job title or role"
                                               value="{{ old('position') }}">
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <label for="email" class="form-label fw-semibold text-secondary">
                                            <i class="bi bi-envelope me-1"></i> Email Address <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" id="email" name="email"
                                               class="form-control form-control-lg shadow-sm"
                                               placeholder="example@mail.com"
                                               value="{{ old('email') }}" required>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label fw-semibold text-secondary">
                                            <i class="bi bi-telephone me-1"></i> Phone
                                        </label>
                                        <input type="text" id="phone" name="phone"
                                               class="form-control form-control-lg shadow-sm"
                                               placeholder="+62..."
                                               value="{{ old('phone') }}">
                                    </div>

                                    <!-- Company -->
                                    <div class="col-md-6">
                                        <label for="company" class="form-label fw-semibold text-secondary">
                                            <i class="bi bi-building me-1"></i> Company Name
                                        </label>
                                        <input type="text" id="company" name="company"
                                               class="form-control form-control-lg shadow-sm"
                                               placeholder="Company name"
                                               value="{{ old('company') }}">
                                    </div>

                                    <!-- Category -->
                                    <div class="col-md-6">
                                        <label for="category_id" class="form-label fw-semibold text-secondary">
                                            <i class="bi bi-tags me-1"></i> Category
                                        </label>
                                        <select id="category_id" name="category_id"
                                                class="form-select form-select-lg shadow-sm">
                                            <option value="">-- Select Category --</option>
                                            @foreach ($categories->where('name', '!=', 'Others') as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                            @php $others = $categories->firstWhere('name', 'Others'); @endphp
                                            @if ($others)
                                                <option value="{{ $others->id }}"
                                                    {{ old('category_id') == $others->id ? 'selected' : '' }}>
                                                    {{ $others->name }}
                                                </option>
                                            @endif
                                        </select>
                                    </div>

                                    <!-- Website -->
                                    <div class="col-md-6">
                                        <label for="website" class="form-label fw-semibold text-secondary">
                                            <i class="bi bi-globe me-1"></i> Website
                                        </label>
                                        <input type="text" id="website" name="website"
                                               class="form-control form-control-lg shadow-sm"
                                               placeholder="https://example.com"
                                               value="{{ old('website') }}">
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-6">
                                        <label for="address" class="form-label fw-semibold text-secondary">
                                            <i class="bi bi-geo-alt me-1"></i> Address
                                        </label>
                                        <input type="text" id="address" name="address"
                                               class="form-control form-control-lg shadow-sm"
                                               placeholder="Full address"
                                               value="{{ old('address') }}">
                                    </div>

                                    <!-- Notes -->
                                    <div class="col-12">
                                        <label for="notes" class="form-label fw-semibold text-secondary">
                                            <i class="bi bi-journal-text me-1"></i> Notes
                                        </label>
                                        <textarea id="notes" name="notes" rows="4"
                                                  class="form-control shadow-sm"
                                                  placeholder="Additional information...">{{ old('notes') }}</textarea>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="d-flex justify-content-end gap-3 mt-4">
                                    <a href="{{ route('crm.index') }}" class="btn btn-outline-secondary px-4">
                                        <i class="bi bi-x-circle"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-danger px-4">
                                        <i class="bi bi-save"></i> Save Data
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
