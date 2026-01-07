@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'mt-1 italic text-sm text-red-600']) }}>*** {{ $message }}</p>
@enderror
