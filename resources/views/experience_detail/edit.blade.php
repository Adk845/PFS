<x-app-layout>
    
    <div class="container mx-auto max-w-7xl py-6" id="app">
        <h1 class="text-2xl font-semibold mb-4">Edit</h1>
    
        <!-- Form to create a new experience detail -->
        <form method="POST" action="{{ route('experiences.update', $experienceDetail->id) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="project_name" class="block text-sm font-medium text-gray-700">Project Name</label>
                <input type="text" name="project_name" id="project_name" value="{{ old('project_name', $experienceDetail->project_name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
    
            <div>
                <label for="client_name" class="block text-sm font-medium text-gray-700">Client Name</label>
                <input type="text" name="client_name" id="client_name" value="{{ old('client_name', $experienceDetail->client_name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
    
            
            <div class="grid gap-4 grid-cols-2">
    
                <div>
                    <label for="project_no" class="block text-sm font-medium text-gray-700">Project No</label>
                    <input type="text" name="project_no" id="project_no" value="{{ old('project_no', $experienceDetail->project_no) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
    
                <div>
                    <label for="kbli_number" class="block text-sm font-medium text-gray-700">KBLI Number</label>
                    <input type="text" name="kbli_number" id="kbli_number" value="{{ old('kbli_number', $experienceDetail->kbli_number) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
        
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <input type="text" name="status" id="status" value="{{ old('status', $experienceDetail->status) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                       
              
                <div>
    <label for="locations" class="block text-sm font-medium text-gray-700">Location</label>
    <input type="text" name="locations" id="locations" value="{{ old('locations', $experienceDetail->locations) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
</div>
</div>

<div>
    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
    <select name="category" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        <option value="" disabled {{ old('category', $category) == '' ? 'selected' : '' }}>Choose category</option>
        <option value="Travel Arrangement" {{ old('category', $category) == 'Travel Arrangement' ? 'selected' : '' }}>Travel Arrangement (Flight and Accommodations)</option>
        <option value="Marchandise/ATK" {{ old('category', $category) == 'Marchandise/ATK' ? 'selected' : '' }}>Marchandise/ATK</option>
        <option value="Business Development" {{ old('category', $category) == 'Business Development' ? 'selected' : '' }}>Business Development</option>
        <option value="IT" {{ old('category', $category) == 'IT' ? 'selected' : '' }}>IT</option>
        <option value="Manpower Supply" {{ old('category', $category) == 'Manpower Supply' ? 'selected' : '' }}>Manpower Supply</option>
        <option value="Event Organizer" {{ old('category', $category) == 'Event Organizer' ? 'selected' : '' }}>Event Organizer</option>
        <option value="Printing" {{ old('category', $category) == 'Printing' ? 'selected' : '' }}>Printing</option>
        <option value="Car Rental" {{ old('category', $category) == 'Car Rental' ? 'selected' : '' }}>Car Rental</option>
        <option value="Company Loan" {{ old('category', $category) == 'Company Loan' ? 'selected' : '' }}>Company Loan</option>
        <option value="Rent Building" {{ old('category', $category) == 'Rent Building' ? 'selected' : '' }}>Rent Building</option>
    </select>
</div>


            <!-- <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            
            <div class="grid grid-cols-4 gap-4">
                
                <div class="flex gap-2"  v-for="(category, index) in categories" :key='category.id'>               
                    <input type="text" name="categories[]" id="category"  :placeholder="'category ' + (index + 1)" :value="category.value" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <div class="flex items-center">
                            <button @click="removeInput1(category.id)" type="button" class="w-full sm:w-auto rounded-full bg-blue-500 px-3.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                -
                            </button>
                        </div>
                </div>  
            </div>
            <div class="button ms-1 col-md-1">
                <button @click="addInput1" type="button" class="w-full sm:w-auto rounded-full bg-blue-500 px-3.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">+</button>
            </div> -->
    
    
            <div class="flex gap-4">
                <div>
                    <label for="date_project_start" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" name="date_project_start" id="date_project_start" value="{{ old('date_project_start', $experienceDetail->date_project_start) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
    
                <div>
                    <label for="date_project_end" class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="date" name="date_project_end" id="date_project_end" value="{{ old('date_project_end', $experienceDetail->date_project_end) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div>
                    <label for="durations" class="block text-sm font-medium text-gray-700">Durations</label>
                    <input type="text" name="durations" id="durations" value="{{ old('durationss', $experienceDetail->durations) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
           </div>
    
            <div>
                <label for="scope_of_work" class="block text-sm font-medium text-gray-700">Scope of Work</label>
                <textarea name="scope_of_work" id="scope_of_work" value="{{ old('scope_of_work', $experienceDetail->scope_of_work) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
            </div>
    
            {{-- <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Upload Images</label>
                <input type="file" name="image[]" id="image" accept="image/*" onchange="previewImages(event)" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" multiple>
            </div> --}}
            
            {{-- =============== TUTUP SEMENTARA ======================= --}}
            {{-- <div class="kontainer_upload_image grid grid-cols-3 gap-2">
                <div class="flex" v-for="(image, index) in images" :key='image.id' >
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700" v-text="'image ' + (index + 1)"></label>
                        <input @change="previewImage(image.id, $event)" type="file" name="images[]" :id='"image" + (index + 1)' accept="image/*" class="mt-1 block w-80 border-gray-300 rounded-md shadow-sm">
                    </div>       
                    <div class="flex items-center">
                        <button @click="removeInput2(image.id)" type="button" class="w-full sm:w-auto rounded-full bg-blue-500 px-3.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            -
                        </button>
                    </div>
                </div>
            </div>
    
            <div class="button ms-1 col-md-1">
                <button @click="addInput2" type="button" class="w-full sm:w-auto rounded-full bg-blue-500 px-3.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">+</button>
            </div> --}}
    
            {{-- BAGIAN PREVIEW GAMBAR  --}}
            {{-- =============== TUTUP SEMENTARA ======================= --}}
            {{-- <div id="image-preview-container" class="grid grid-cols-10 gap-4 mt-4">
                <div v-for="(preview, id) in previews" :key='id'>
                    <img :src='preview' alt="image preview"class="w-32 h-32 object-cover rounded-md shadow-md">
                </div>
            </div> --}}
    
           <div class="kontainer_upload_image grid grid-cols-3 gap-2">
    <!-- Iterasi untuk menampilkan input gambar dan preview -->
    <div class="flex" v-for="(image, index) in images" :key='image.id'>
        <div :id='image.id'>
            <label for="image" class="block text-sm font-medium text-gray-700" v-text="'Image ' + (index + 1)"></label>
            <!-- Input untuk upload gambar -->
            {{-- <input type="hidden" name="image_id" :value='image.id' :id='image.id'> --}}
            <input 
                {{-- @change="previewImage(image.id, $event)"  --}}
                @change="previewImage(inndex, $event)" 
                type="file" 
                name="images[]" 
                :id="'image' + (index + 1)" 
                accept="image/*" 
                class="mt-1 block w-80 border-gray-300 rounded-md shadow-sm"
            >
        </div>
        
        <!-- Tampilkan gambar sebelumnya jika ada -->
        {{-- <div v-if="image.preview" class="mt-2">
            <img :src="image.preview" alt="image preview" class="w-32 h-32 object-cover rounded-md shadow-md">
        </div> --}}
        
        <!-- Tombol untuk menghapus gambar -->
        <div class="flex items-center">
            <button @click="removeInput2(image.id)" type="button" class="w-full sm:w-auto rounded-full bg-red-500 px-3.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-600">
                -
            </button>
        </div>
    </div>
    <div id="for_delete">

    </div>
</div>

<!-- Tombol untuk menambah input gambar baru -->
<div class="button ms-1 col-md-1">
    <button @click="addInput2" type="button" class="w-full sm:w-auto rounded-full bg-blue-500 px-3.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        +
    </button>
</div>

{{-- BAGIAN PREVIEW GAMBAR --}}
<div id="image-preview-container" class="grid grid-cols-10 gap-4 mt-4">
    <!-- Preview gambar yang baru di-upload -->
    <div v-for="(preview, id) in previews" :key='id'>
        <div class="flex-row">
            <div class="flex justify-center">
                <h3 v-text="'Image ' + (id + 1)"></h3>
            </div>
            <img :src='preview.path' alt="image preview" class="w-32 h-32 object-cover rounded-md shadow-md mt-3">
        </div>
        
    </div>
</div>

    
            <div class="max-w-60">
                <button type="submit" class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Save</button>
            </div>
        </form>
    </div>
    
    <script>
    
    
          const {
                createApp
            } = Vue
    
            createApp({
                data() {
                    return {
                        categories: [],
                        images: [],
                        previews: [],
                        index_for_prviews: 6                   
                    }
                },
                mounted() {
                    this.fetchData();
                },
                methods: {
                    fetchData() {
                        fetch("{{ route('edit_api', ['id' => $experienceDetail->id]) }}")
                        .then(response => response.json())
                        .then(data => {
                            array_categories = data.category.split("|");
                            // for(let index in array_categories){
                            //     console.log("ini" + array_categories[index])
                            // }
                            let number = 0
                            array_categories.forEach(category => {
                                this.categories.push({
                                    id: number += 1,
                                    value: category,
                                })
                            }); 
                            let number2 = 0;
                           data.images.forEach(image => {
                            this.images.push({
                                id: image.id,
                                vue_id: number += 1,
                                image: image.foto
                            })
                            // this.previews[image.id] = {{ Storage::url('') }} + image.foto
                            this.previews.push({
                                id: image.id,
                                path: {{ Storage::url('') }} + image.foto,
                            })
                           })
                           console.log(this.previews)
                        })
                    },
                    addInput1(index) {
                        this.categories.push({
                            id: Date.now()                        
                        });
                    },
                    removeInput1(id) {
                        // versi arrow function
                        this.categories = this.categories.filter(category => category.id !== id)
                        console.log(this.categories)
                    },
                    addInput2() {
                        if(this.images.length !== 5){
                            this.images.push({
                            id: Date.now()                        
                        })
                        } else {
                            alert("maksimum upload 3 images")
                        }
                        
                        console.log(this.previews);
                    },
                    removeInput2(id) {
                        // versi fungsi anonim
                        // this.images = this.images.filter(function(category){
                        //     image.id !== id
                        // });
                        const existingPreviewIndex = this.previews.findIndex(preview => preview.id === id);
                            if (existingPreviewIndex !== -1) { 
                                $('#for_delete').append(` <input type="hidden" name="images_id_delete[]" value="${id}">`);
                                this.previews.splice(existingPreviewIndex, 1)
                                console.log(this.previews)                                
                            }

                        this.images = this.images.filter(image => image.id !== id)
                        delete this.previews[id];
                        // console.log()
                    },
                    previewImage(id, event) {
                        // $('#' + id).append(` <input type="hidden" name="images_id[]" value="${id}">`);
                        const file = event.target.files[0];
                        if (file && file.type.startsWith("image/")) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                const existingPreviewIndex = this.previews.findIndex(preview => preview.id === id);
                                if (existingPreviewIndex !== -1) { 
                                    $('#' + id).append(` <input type="hidden" name="images_id[]" value="${id}">`);                   
                                    this.previews[existingPreviewIndex].path = e.target.result;
                                } else {
                                    this.previews.push({
                                        id: this.index_for_prviews += 1,
                                        path: e.target.result
                                    })
                                }
                            //    this.previews[id] = e.target.result
                            console.log(e.target.result)
                            };
                            reader.readAsDataURL(file);
                        }
                        console.log(this.previews);
                        
                    }
                    
                }
            }).mount('#app')
    
        //     function previewImages(event) {
        //         const files = event.target.files;
        //         const previewContainer = document.getElementById('image-preview-container');
                
        //         // Kosongkan kontainer sebelum menambahkan preview baru
        //         previewContainer.innerHTML = '';
    
        //         // Loop melalui file yang diunggah
        //         Array.from(files).forEach(file => {
        //             if (file.type.startsWith('image/')) {
        //                 const reader = new FileReader();
    
        //                 reader.onload = function (e) {
        //                     const img = document.createElement('img');
        //                     img.src = e.target.result; // URL hasil membaca file
        //                     img.alt = file.name;
        //                     img.classList.add('w-32', 'h-32', 'object-cover', 'rounded-md', 'shadow-md'); // TailwindCSS
        //                     previewContainer.appendChild(img);
        //                 };
    
        //                 reader.readAsDataURL(file); // Membaca file sebagai Data URL
        //             }
        //         });
        // }
    
    
    </script>
    </x-app-layout>
    