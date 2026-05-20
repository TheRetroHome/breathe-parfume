@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-body text-sm text-dark-400 uppercase tracking-widest']) }}>
    {{ $value ?? $slot }}
</label>
