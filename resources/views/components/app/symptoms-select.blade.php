<label for="{{ $key ?? '' }}" class="flex justify-between p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
    <span class="text-lg">{{ $value ?? '' }}</span>
    <input
    id="{{ $key ?? '' }}"
    name="symptoms[{{ $key ?? '' }}]"
    {{ $checked === '1' ? 'checked' : '' }}
    type="checkbox"
    class="shrink-0 ms-auto mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
    >
</label>
