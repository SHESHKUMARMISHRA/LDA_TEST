<div class="bg-white shadow-md rounded-lg p-4">
    <h3 class="font-bold mb-2">{{ $isEditing ? 'Edit Skill' : 'Add New Skill' }}</h3>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        <label class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" wire:model="name" class="border rounded w-full p-2 mt-1" placeholder="Skill name">
        
        @error('name')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
        
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded">
            {{ $isEditing ? 'Update' : 'Save' }}
        </button>

        @if ($isEditing)
            <button type="button" wire:click="cancelEdit" class="bg-gray-500 text-white px-4 py-2 mt-4 rounded">
                Cancel
            </button>
        @endif
    </form>
</div>
