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
            
            <div class="flex gap-2"  v-for="(category, index) in categories" :key='index'>               
                <input type="text" name="category[]" id="category"  :placeholder="'categories ' + (index + 1)" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <div class="flex">
                        <button @click="removeInput1(index)" class="w-full sm:w-auto rounded-full bg-blue-500 px-3.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
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
       </div>

        <div>
            <label for="scope_of_work" class="block text-sm font-medium text-gray-700">Scope of Work</label>
            <textarea name="scope_of_work" id="scope_of_work" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Upload Images</label>
            <input type="file" name="image[]" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" multiple>
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
                        value: ''
                    }],                   
                }
            },
            methods: {
                addInput1() {
                    this.categories.push({
                        value: ''
                    });
                },
                removeInput1(index) {
                    this.categories.splice(index, 1);
                },
                
            }
        }).mount('#app')

</script>
</x-app-layout>
