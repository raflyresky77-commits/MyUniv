
@props([
    'user' => null,
    'student' => null,
    'size' => 'w-10 h-10',
    'type' => 'student',
])

@php
    $photo = 'images/Profile/icon-GuruBK.jpg';

    if ($type !== 'counselor') {
        $gender = strtolower(trim($student?->gender ?? ''));

        $photo = match ($gender) {
            'perempuan' => 'images/Profile/icon-female.jpg',
            'laki-laki' => 'images/Profile/icon-male.jpg',
            default => 'images/Profile/icon-male.jpg',
        };
    }
@endphp

<div {{ $attributes->merge([
    'class' => $size . ' rounded-2xl overflow-hidden shrink-0 ring-2 ring-indigo-100 shadow-md'
]) }}>
    <img
        src="{{ asset($photo) }}"
        alt="Foto profil {{ $user?->name ?? 'Pengguna' }}"
        class="w-full h-full object-cover"
    >
</div>
