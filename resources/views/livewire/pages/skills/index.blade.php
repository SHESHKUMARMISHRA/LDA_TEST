<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Skills</h1>
        </div>
        {{-- TODO: Add table here and a form to create a new skill --}}
        @if (session()->has('message'))
            <div class="bg-green-500 text-white p-2 mb-4 rounded">
                {{ session('message') }}
            </div>
        @endif

        <div class="grid grid-cols-3 gap-6">
            <!-- Skills List -->
            <div class="col-span-2 bg-white shadow-md rounded-lg p-4">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left p-2">Name</th>
                            <th class="p-2 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($skills as $skill)
                            <tr class="border-t">
                                <td class="p-2">{{ $skill->name }}</td>
                                <td class="p-2 text-right">
                                    <button wire:click="$dispatch('editSkill', { id: {{ $skill->id }} })" class="text-blue-500">Edit</button>
                                    <button wire:click="delete({{ $skill->id }})" class="text-red-500 ml-2">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Add New Skill Form -->
             <livewire:pages.skills.add-skill />
            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $skills->links() }}
            </div>
        </div>
    </div>
</div>
