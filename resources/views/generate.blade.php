<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Generate Companion Button</h1>

        <form method="POST" action="{{ route('generate.run') }}">
            @csrf
            <textarea name="prompt" rows="4" class="w-full border rounded p-2" placeholder="Describe what you want the button to do...">{{ old('prompt') }}</textarea>

            <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Generate
            </button>
        </form>

        @if (isset($jsonOutput))
            <div class="mt-6">
                <h2 class="text-xl font-semibold mb-2">Generated JSON</h2>
                <pre class="bg-black text-green-400 p-4 rounded overflow-auto text-sm">{{ $jsonOutput }}</pre>

                <h2 class="text-xl font-semibold mt-6 mb-2">Explanation</h2>
                <p class="bg-gray-100 dark:bg-gray-800 p-4 rounded text-gray-900 dark:text-gray-100">{{ $explanation }}</p>

                <div class="mt-4 flex gap-4">
                    <form method="POST" action="{{ route('generate.run') }}">
                        <input type="hidden" name="prompt" value="{{ $prompt }}">
                        <button formaction="{{ route('generate.run') }}" formmethod="POST"
                                class="px-4 py-2 bg-yellow-500 text-black rounded hover:bg-yellow-600"
                                onclick="downloadJSON('{{ addslashes(json_encode($jsonOutput)) }}', 'button.json')">
                            Download JSON
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <script>
        function downloadJSON(content, filename) {
            const blob = new Blob([content], { type: "application/json" });
            const url = URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = filename;
            a.click();
        }
    </script>
</x-app-layout>
