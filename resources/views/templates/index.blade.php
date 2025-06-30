<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Your Templates</h1>

        <a href="{{ route('templates.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + New Template
        </a>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($templates->isEmpty())
            <p class="text-gray-600 dark:text-gray-300">No templates saved yet.</p>
        @else
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="p-2">Name</th>
                        <th class="p-2">Description</th>
                        <th class="p-2">Created</th>
                        <th class="p-2 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($templates as $template)
                        <tr class="border-b dark:border-gray-600">
                            <td class="p-2 font-semibold">{{ $template->name }}</td>
                            <td class="p-2 text-gray-700 dark:text-gray-300">{{ $template->description }}</td>
                            <td class="p-2 text-gray-500 text-sm">{{ $template->created_at->diffForHumans() }}</td>
                            <td class="p-2 text-right">
                                <a href="{{ route('templates.edit', $template) }}" class="text-blue-600 hover:underline">Edit</a> |
                                <a href="{{ route('templates.download', [$template, 'json']) }}" class="text-yellow-600 hover:underline">.json</a> |
                                <a href="{{ route('templates.download', [$template, 'companionconfig']) }}" class="text-pink-600 hover:underline">.companionconfig</a> |
                                <form action="{{ route('templates.destroy', $template) }}" method="POST" class="inline" onsubmit="return confirm('Delete this template?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
