<div class="mb-4">
    <label class="block mb-1 font-semibold">{{ $label ?? '' }}</label>
    <input
        type="{{ $type ?? 'text' }}"
        name="{{ $name ?? '' }}"
        class="w-full border rounded p-2"
        value="{{ $value ?? '' }}"
    />
</div>
