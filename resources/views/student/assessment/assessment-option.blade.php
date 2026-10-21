
@props([
    'questionId',
    'value',
    'label',
    'required' => false,
])

<td class="py-4 px-3 text-center align-middle">
    <label class="inline-flex items-center justify-center cursor-pointer">
        <input
            type="radio"
            name="responses[{{ $questionId }}]"
            value="{{ $value }}"
            @if ($required) required @endif
            class="h-5 w-5 cursor-pointer accent-indigo-600"
        >
        <span class="sr-only">{{ $label }}</span>
    </label>
</td>
