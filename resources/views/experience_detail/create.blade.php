<x-app-layout>
    
<div class="container mx-auto max-w-7xl py-6" id="app">
    <h1 class="text-2xl font-semibold mb-4">Create New Experience Detail</h1>

    <!-- Form to create a new experience detail -->
    <form method="POST" action="{{ route('experiences.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="project_name" class="block text-sm font-medium text-gray-700">Project Name</label>
            <input type="text" name="project_name" id="project_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="client_name" class="block text-sm font-medium text-gray-700">Client Name</label>
            <input type="text" name="client_name" id="client_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        
        <div class="grid gap-4 grid-cols-2">

            <div>
                <label for="project_no" class="block text-sm font-medium text-gray-700">Project No</label>
                <input type="text" name="project_no" id="project_no" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label for="kbli_number" class="block text-sm font-medium text-gray-700">KBLI Number</label>
                <input type="text" name="kbli_number" id="kbli_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
    
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <input type="text" name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
    
           
          
            <div>
                <label for="locations" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="locations" id="locations" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
    
          
        </div>
        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
        
        <div class="grid grid-cols-4 gap-4">
            
            <div class="flex gap-2"  v-for="(category, index) in categories" :key='category.id'>               
                <input type="text" name="categories[]" id="category"  :placeholder="'category ' + (index + 1)" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <div class="flex items-center">
                        <button @click="removeInput1(category.id)" type="button" class="w-full sm:w-auto rounded-full bg-blue-500 px-3.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            -
                        </button>
                    </div>
            </div>  
        </div>
        <div class="button ms-1 col-md-1">
            <button @click="addInput1" type="button" class="w-full sm:w-auto rounded-full bg-blue-500 px-3.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">+</button>
        </div>


        <div class="flex gap-4">
            <div>
                <label for="date_project_start" class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" name="date_project_start" id="date_project_start" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label for="date_project_end" class="block text-sm font-medium text-gray-700">End Date</label>
                <input type="date" name="date_project_end" id="date_project_end" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label for="durations" class="block text-sm font-medium text-gray-700">Durations</label>
                <input type="text" name="durations" id="durations" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
       </div>

        <div>
            <label for="scope_of_work" class="block text-sm font-medium text-gray-700">Scope of Work</label>
            <textarea name="scope_of_work" id="scope_of_work" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
        </div>

        {{-- <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Upload Images</label>
            <input type="file" name="image[]" id="image" accept="image/*" onchange="previewImages(event)" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" multiple>
        </div> --}}
        
        <div class="kontainer_upload_image grid grid-cols-3 gap-2">
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
        </div>

        {{-- BAGIAN PREVIEW GAMBAR  --}}
        <div id="image-preview-container" class="grid grid-cols-10 gap-4 mt-4">
            <div v-for="(preview, id) in previews" :key='id'>
                <img :src='preview' alt="image preview"class="w-32 h-32 object-cover rounded-md shadow-md">
            </div>
        </div>

       

        <div class="max-w-60">
            <button type="submit" class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Create Experience Detail</button>
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
                    categories: [{
                        id: Date.now()                        
                    }],
                    images: [{
                        id: Date.now()                        
                    }],
                    previews: {}                   
                }
            },
            methods: {
                addInput1(index) {
                    this.categories.push({
                        id: Date.now()                        
                    });
                },
                removeInput1(id) {
                    // versi arrow function
                    this.categories = this.categories.filter(category => category.id !== id)
                    console.log(id)
                },
                addInput2() {
                    if(this.images.length !== 5){
                        this.images.push({
                        id: Date.now()                        
                    })
                    } else {
                        alert("maksimum upload 5 images")
                    }
                    
                    console.log(this.images.length)
                },
                removeInput2(id) {
                    // versi fungsi anonim
                    // this.images = this.images.filter(function(category){
                    //     image.id !== id
                    // });

                    this.images = this.images.filter(image => image.id !== id)
                    delete this.previews[id];
                    // console.log()
                },
                previewImage(id, event) {
                    const file = event.target.files[0];
                    if (file && file.type.startsWith("image/")) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                           this.previews[id] = e.target.result
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
