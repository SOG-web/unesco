@props(['content'=> '9'])

<div {{ $attributes->merge([
    'class' => 'flex justify-center items-center rounded-full w-4 h-4 bg-red-500 text-white font-bold font-poppins text-xs'
]) }} >
    <span>{{ $content }}</span>
</div>
