<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Create New Template</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('templates.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description (optional)</label>
                <input type="text" name="description" value="{{ old('description') }}" class="w-full border rounded p-2 mt-1">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">JSON Configuration</label>
                <textarea name="json_config" rows="10" class="w-full border rounded p-2 mt-1 font-mono text-sm" placeholder='{"name": "Example", "bank": {"style": "text"}}' required>{{ old('json_config') }}</textarea>
            </div>

            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Save Template
            </button>
        </form>
    </div>
</x-app-layout>
