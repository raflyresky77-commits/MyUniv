{{-- Opsi radio reusable untuk pertanyaan asesmen. --}}
@props([
    'questionId',
    'value',
    'label' => null,
    'required' => false,
])
<td data-label="{{ $label }}" {{ $attributes->class('py-4 px-4 text-center align-middle') }}>
    <label class="relative flex items-center justify-center cursor-pointer">
        <input
            type="radio"
            name="responses[{{ $questionId }}]"
            value="{{ $value }}"
            class="option-input sr-only"
            @if ($required) required @endif
            onchange="highlightRow(this)"
        >
        <span class="option-label w-9 h-9 sm:w-10 sm:h-10 rounded-xl border-2 border-gray-200 bg-gray-50 flex items-center justify-center font-bold text-gray-500 transition-all duration-200 hover:border-indigo-300 hover:bg-indigo-50/50">
            {{ $value }}
        </span>
    </label>
</td>
