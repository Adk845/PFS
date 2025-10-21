<x-app-layout>

@if (session('green'))
  <div 
    x-data="{ show: true }"
    x-show="show"
    x-transition
    class="mb-4 p-4 rounded-md bg-green-100 text-green-800 border border-green-300 flex justify-between items-center"
  >
    <span>{{ session('green') }}</span>
    <button @click="show = false" class="text-green-700 font-bold hover:text-green-900">
      &times;
    </button>
  </div>
@endif

@if ($errors->any())
  <div 
    x-data="{ show: true }"
    x-show="show"
    x-transition
    class="mb-4 p-4 rounded-md bg-red-100 text-red-800 border border-red-300"
  >
    <ul class="list-disc list-inside text-sm">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
    <button @click="show = false" class="text-red-700 font-bold hover:text-red-900 absolute top-1 right-2">
      &times;
    </button>
  </div>
@endif


  <div class="max-w-6xl mx-auto py-8 px-6" x-data="{ isEditing: false }">
    <h2 class="text-3xl font-bold text-[#880000] mb-8 border-b pb-3 mt-10">Detail CRM</h2>

    <form method="POST" action="{{ route('crm.update', $crm->id) }}" class="space-y-6">
      @csrf
      @method('PUT')

      <div class="flex flex-row flex-wrap gap-6">
        <!-- KIRI: Informasi Kontak -->
        <div class="flex-1 min-w-[320px] bg-white shadow rounded-lg p-6">
          <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Contact Informations</h3>
          <div class="space-y-4">
            @foreach ([ 'name' => 'Name', 'position' => 'Postion', 'company' => 'Company', 'email' => 'Email', 'phone' => 'Telephone', 'address' => 'Address', 'website' => 'Website', 'notes' => 'Notes' ] as $field => $label)
              <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">{{ $label }}</label>
                <template x-if="isEditing">
                  <input type="text" name="{{ $field }}" value="{{ old($field, $crm->$field) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-800 text-sm focus:outline-none focus:ring-1 focus:ring-[#880000]" />
                </template>
                <template x-if="!isEditing">
                  <p class="text-gray-800 text-sm leading-tight">{{ $crm->$field ?: '-' }}</p>
                </template>
              </div>
            @endforeach
          </div>
        </div>

        <!-- KANAN: Customer Persona -->
       <!-- KANAN: Customer Persona -->
<div class="flex-1 min-w-[320px] bg-white shadow rounded-lg p-6">
  <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Customer Persona</h3>

  <div class="space-y-4">
    @foreach ([ 
      'date_of_birth' => 'Date of birth', 
      'gender' => 'Gender', 
      'occupation' => 'Work/Occupation', 
      'income_level' => '  Income ', 
      'education_level' => ' Education', 
      'key_interest' => ' Key Interest', 
      'pain_point' => 'Pain Point', 
      'notes' => 'Notes Persona' 
    ] as $field => $label)
      <div>
        <label class="block text-xs font-medium text-gray-600 mb-1">{{ $label }}</label>

        @if ($field === 'notes')
          <template x-if="isEditing">
            <div>
              <input id="persona_notes_input" type="hidden" name="persona[notes]" 
                value="{{ old('persona.notes', optional($crm->persona)->notes) }}">
              <trix-editor input="persona_notes_input" 
                class="trix-content border border-gray-300 rounded-md bg-white"></trix-editor>
            </div>
          </template>

          <template x-if="!isEditing">
            <div class="prose prose-sm max-w-none text-gray-800">
              {!! optional($crm->persona)->notes 
                    ? $crm->persona->notes 
                    : '<p class="text-gray-500 italic">Belum ada catatan persona.</p>' !!}
            </div>
          </template>

        @elseif ($field === 'date_of_birth')
          <template x-if="isEditing">
            <input type="date" name="persona[{{ $field }}]" 
              value="{{ old('persona.' . $field, optional($crm->persona)->$field) }}"
              class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-800 text-sm focus:outline-none focus:ring-1 focus:ring-[#880000]" />
          </template>

          <template x-if="!isEditing">
            <p class="text-gray-800 text-sm leading-tight">
              {{ optional($crm->persona)->$field ? \Carbon\Carbon::parse(optional($crm->persona)->$field)->format('d M Y') : '-' }}
            </p>
          </template>

        @elseif ($field === 'gender')
          <template x-if="isEditing">
            <select name="persona[{{ $field }}]" 
              class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-800 text-sm focus:outline-none focus:ring-1 focus:ring-[#880000]">
              <option value="">-- Pilih Jenis Kelamin --</option>
              <option value="Laki-laki" {{ old('persona.gender', optional($crm->persona)->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Perempuan" {{ old('persona.gender', optional($crm->persona)->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </template>

          <template x-if="!isEditing">
            <p class="text-gray-800 text-sm leading-tight">
              {{ optional($crm->persona)->$field ?: '-' }}
            </p>
          </template>

        @else
          <template x-if="isEditing">
            <input type="text" name="persona[{{ $field }}]" 
              value="{{ old('persona.' . $field, optional($crm->persona)->$field) }}"
              class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-800 text-sm focus:outline-none focus:ring-1 focus:ring-[#880000]" />
          </template>

          <template x-if="!isEditing">
            <p class="text-gray-800 text-sm leading-tight">
              {{ optional($crm->persona)->$field ?: '-' }}
            </p>
          </template>
        @endif
      </div>
    @endforeach
  </div>
</div>

      </div>

      <!-- TOMBOL DI DALAM FORM -->
      <div class="flex justify-end space-x-3 mt-6">

        <a href="{{ route('crm.index') }}" 
          class="inline-block px-6 py-2 bg-white text-black border border-gray-300 rounded-md text-sm hover:bg-gray-100 transition mr-auto m-2">
          <i class="fa fa-arrow-left"></i> Back
        </a>

        <template x-if="!isEditing">
          <button type="button" @click="isEditing = true"
            class="px-6 py-2 bg-danger text-white rounded-md text-sm hover:bg-[#6a0000] transition m-2">
            <i class="fa fa-pencil"></i> Edit
          </button>
        </template>

        <template x-if="isEditing">
          <div class="flex space-x-3">
            <button type="submit"
              class="px-6 py-2 bg-green-600 text-white rounded-md text-sm hover:bg-green-700 transition m-2">
              <i class="fa fa-save"></i> Save
            </button>

            <button type="button" @click="isEditing = false"
              class="px-6 py-2 bg-red-500 text-white rounded-md text-sm hover:bg-red-600 transition m-2">
              Batal
            </button>
          </div>
        </template>

      </div>
    </form>

  </div>

  <!-- Trix & AlpineJS -->
  <link rel="stylesheet" href="https://unpkg.com/trix/dist/trix.css">
  <script src="https://unpkg.com/trix/dist/trix.umd.min.js"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
</x-app-layout>
