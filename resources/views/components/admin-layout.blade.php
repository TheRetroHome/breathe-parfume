@props(['title' => 'Admin'])
<x-admin :title="$title">
    <x-slot name="title">{{ $title }}</x-slot>
    {{ $slot }}
</x-admin>
