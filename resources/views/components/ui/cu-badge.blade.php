@props(['color' => 'bg-red-500', 'content' => ''])

<div class="relative inline-flex">
    {{ $slot }}
    <span
        class="absolute rounded-full py-1 px-1.5 text-[10px] font-medium content-[''] leading-none grid place-items-center top-[4%] right-[2%] translate-x-2/4 -translate-y-2/4 {{ $color }} text-white min-w-[14px] min-h-[14px]">
        {{ $content }}
  </span>
</div>
