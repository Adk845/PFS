<x-app-layout>
  <div class="container py-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h3 class="fw-bold text-danger mb-1">
          <i class="bi bi-pencil-square me-2"></i>Edit Follow Up
        </h3>
        <p class="text-muted small mb-0">
          Update detail follow-up untuk lead: 
          <span class="fw-semibold text-dark">{{ $lead->crm->name ?? 'Without CRM' }}</span>
        </p>
      </div>
      <a href="{{ route('leads.show', $lead->id) }}" class="btn btn-outline-secondary shadow-sm rounded-3">
        <i class="bi bi-arrow-left"></i> Back
      </a>
    </div>

    <!-- Card -->
    <div class="card border-0 shadow-sm rounded-4">
      <div class="card-body p-4">
        <h5 class="fw-bold text-secondary mb-4">Edit Follow Up Details</h5>

        <form method="POST" action="{{ route('followups.update', [$lead->id, $followUp->id]) }}">
          @csrf
          @method('PUT')

          <div class="row g-3">
            <!-- Date -->
            <div class="col-md-6">
              <label for="date" class="form-label fw-semibold text-secondary">Date</label>
              <input type="date" name="date" id="date" value="{{ old('date', $followUp->date) }}" 
                     class="form-control shadow-sm" required>
            </div>

            <!-- Type -->
            <div class="col-md-6">
              <label for="type" class="form-label fw-semibold text-secondary"> Follow Up Type</label>
              <select name="type" id="type" class="form-select shadow-sm" required>
                <option value="">-- Select Type --</option>
                @foreach($types as $t)
                  <option value="{{ $t }}" {{ $followUp->type == $t ? 'selected' : '' }}>
                    {{ ucfirst($t) }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Notes -->
            <div class="col-12">
              <label for="notes" class="form-label fw-semibold text-secondary">Notes</label>
              <textarea name="notes" id="notes" rows="5" 
                        class="form-control shadow-sm" 
                        placeholder="Write a follow-up update...">{{ old('notes', $followUp->notes) }}</textarea>
            </div>
          </div>

          <!-- Buttons -->
          <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('leads.show', $lead->id) }}" class="btn btn-outline-secondary px-4">
              <i class="bi bi-x-circle"></i> Cancel
            </a>
            <button type="submit" class="btn btn-danger px-4">
              <i class="bi bi-save"></i> Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <style>
    .form-control, .form-select {
      border-radius: 10px;
      padding: 0.7rem 0.9rem;
      transition: all 0.2s ease-in-out;
    }

    .form-control:focus, .form-select:focus {
      border-color: #dc3545;
      box-shadow: 0 0 0 0.15rem rgba(220,53,69,0.25);
    }

    .card {
      transition: all 0.25s ease-in-out;
    }

    .card:hover {
      transform: translateY(-2px);
    }

    textarea {
      resize: none;
    }
  </style>
</x-app-layout>
