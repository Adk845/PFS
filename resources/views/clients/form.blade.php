<style>
    body {
        background: linear-gradient(135deg, #880000, #ff0000);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
        margin: 0;
    }

    .crm-card {
        background: #fff;
        border-radius: 14px;
        padding: 32px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        width: 100%;
        max-width: 900px; /* Lebar diperbesar */
        animation: fadeInUp 0.6s ease;
    }

    .crm-card h4 {
        text-align: center;
        font-weight: 700;
        font-size: 1.4rem;
        margin-bottom: 6px;
        color: #880000;
    }

    .crm-card p {
        text-align: center;
        color: #6c757d;
        font-size: 0.92rem;
        margin-bottom: 25px;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div class="crm-card">

    <div class="text-center mb-3">
        <img src="{{ asset('assets/image/logo-isol.png') }}" alt="Logo" width="200" height="80">
    </div>


    <h4>Create CRM</h4>
    <p>Please fill in the details below</p>



    <div id="crm-form" @if(session('success')) style="display:none;" @endif>

    <form id="crmForm" action="{{ route('crm.submitForm') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Full Name<span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control"
                       placeholder="Enter full name" value="{{ old('name') }}" required>
            </div>

            <div class="col-md-6">
                <label for="position" class="form-label">Position</label>
                <input type="text" name="position" id="position" class="form-control"
                       placeholder="Enter full position" value="{{ old('position') }}" >
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email Address<span class="text-danger">*</span></label>
                <input type="text" name="email" id="email" class="form-control"
                       placeholder="Enter email" value="{{ old('email') }}" required>
            </div>

           <div class="col-md-6">
            <label for="phone">Nomor Telepon</label>
            <input type="tel" id="phone" name="phone" class="form-control">
            <input type="hidden" name="country_code" id="country_code">
                        <!-- <small class="text-muted">Contoh: 81234567890</small> -->
        </div>

          <div class="col-md-6">
            <label for="company" class="form-label">Company Nam e</label>
            <input type="text" name="company" id="company" class="form-control"
                placeholder="Example: Isolutions Indonesia, PT" value="{{ old('company') }}" >
            <!-- <small class="form-text text-muted">
                Use the format: <b>Company Name, PT</b>. Example: <b>Indika Energy, PT</b>
            </small> -->
        </div>


            <!-- <div class="col-md-6">
                <label for="category" class="form-label">Category</label>
                <select name="category" id="category" class="form-select" >
                    <option value="">-- Select Category --</option>
                    <option value="Clients" {{ old('category') == 'Clients' ? 'selected' : '' }}>Clients</option>
                    <option value="Vendor" {{ old('category') == 'Vendor' ? 'selected' : '' }}>Vendor</option>
                    <option value="Others" {{ old('category') == 'Others' ? 'selected' : '' }}>Others</option>
                </select>
            </div> -->

             <div class="col-md-6">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="form-control" >
                                        <option value="">-- Pilih Category --</option>

                                        {{-- kategori selain Others --}}
                                        @foreach ($categories->where('name', '!=', 'Others') as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach

                                        {{-- taruh Others di bawah --}}
                                        @php
                                            $others = $categories->firstWhere('name', 'Others');
                                        @endphp
                                        @if($others)
                                            <option value="{{ $others->id }}" {{ old('category_id') == $others->id ? 'selected' : '' }}>
                                                {{ $others->name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>

            <div class="col-md-6">
                <label for="website" class="form-label">Website</label>
                <input type="url" name="website" id="website" class="form-control"
                       placeholder="Enter website URL" value="{{ old('website') }}">
            </div>

            <div class="col-md-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" class="form-control"
                       placeholder="Enter address" value="{{ old('address') }}" >
            </div>

            <div class="col-md-6">
                <label for="notes" class="form-label">Notes</label>
                <textarea name="notes" id="notes" class="form-control" rows="1"
                          placeholder="Additional notes">{{ old('notes') }}</textarea>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary w-100" style="background-color:#880000; border:none;">
                <i class="bi bi-check-lg me-1"></i> Save
            </button>
        </div>
    </form>
    </div>

    {{-- Hasil QR --}}
@if(session('success'))
    <div id="crm-result" class="text-center mt-4">
        <h4>{{ session('name') }} - {{ session('company') }}</h4>
        <h5>QR Code Generated:</h5>
        <img src="{{ asset('storage/' . session('qrcode')) }}" alt="QR Code" width="200">

        <div class="mt-4 text-end">
            <button class="btn btn-danger" onclick="addNewCrm()">Add New CRM</button>
        </div>
    </div>
@endif


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        confirmButtonColor: '#880000',
    });

    function addNewCrm() {
        // sembunyikan result
        document.getElementById('crm-result').style.display = 'none';
        // tampilkan form lagi
        document.getElementById('crm-form').style.display = 'block';
    }
</script>

<script>
const input = document.querySelector("#phone");
const iti = window.intlTelInput(input, {
  initialCountry: "auto",
  geoIpLookup: function(callback) {
    fetch("https://ipapi.co/json")
      .then(res => res.json())
      .then(data => callback(data.country_code))
      .catch(() => callback("ID")); // default Indonesia
  },
  utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js",
});

input.addEventListener("countrychange", function() {
  const countryData = iti.getSelectedCountryData();
  document.querySelector("#country_code").value = countryData.dialCode;
});

// Saat submit, ambil full number dengan kode negara
document.querySelector("form").addEventListener("submit", function() {
  const fullNumber = iti.getNumber(); // contoh: +628123456789
  input.value = fullNumber;
});
</script>

</div>


@endif
