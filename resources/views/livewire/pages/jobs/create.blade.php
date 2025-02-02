<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Create new job posting</h1>
        </div>
        {{-- TODO: Add form here --}}
        @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4 rounded">
            {{ session('message') }}
        </div>
        @endif

        <form wire:submit.prevent="save">
            <div class="grid grid-cols-2 gap-4">
                <!-- Job Details -->
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="font-bold mb-2">Job Details</h3>

                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" wire:model="title" class="border rounded w-full p-2 mt-1">

                    <label class="block text-sm font-medium text-gray-700 mt-2">Description</label>
                    <textarea wire:model="description" class="border rounded w-full p-2 mt-1"></textarea>

                    <label class="block text-sm font-medium text-gray-700 mt-2">Experience</label>
                    <input type="text" wire:model="experience" class="border rounded w-full p-2 mt-1">

                    <label class="block text-sm font-medium text-gray-700 mt-2">Salary</label>
                    <input type="text" wire:model="salary" class="border rounded w-full p-2 mt-1">

                    <label class="block text-sm font-medium text-gray-700 mt-2">Location</label>
                    <input type="text" wire:model="location" class="border rounded w-full p-2 mt-1">

                    <label class="block text-sm font-medium text-gray-700 mt-2">Extra Info</label>
                    <input type="text" wire:model="extra_info" class="border rounded w-full p-2 mt-1">
                </div>

                <!-- Company Details -->
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="font-bold mb-2">Company Details</h3>

                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" wire:model="company_name" class="border rounded w-full p-2 mt-1">

                    <label class="block text-sm font-medium text-gray-700 mt-2">Logo</label>
                    <input type="file" wire:model="company_logo" class="border rounded w-full p-2 mt-1">

                    <div wire:loading wire:target="company_logo">Uploading...</div>
                    <br>
                    <!-- Skills Selection -->
               
                    

                    <label class="block text-sm font-medium text-gray-700">Select Skills</label>
                    <select wire:model="skills" multiple class="border rounded w-full p-2 mt-1">
                        @foreach($allSkills as $skill)
                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                        @endforeach
                    </select>

                    <p class="text-sm text-gray-500 mt-2">Hold down the Ctrl (Windows) or Command (Mac) key to select
                        multiple options.</p>
                </div>

            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded">Save</button>
        </form>
    </div>
</div>