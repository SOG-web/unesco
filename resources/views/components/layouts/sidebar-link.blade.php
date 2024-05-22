@props(['active' => false])

{{--<div class="w-full flex items-center justify-center h-[57px]">--}}
<a {{ $attributes->merge([
        'class' => '
        flex flex-row items-center
        justify-start pl-[15px] xl:pl-[30px] gap-[5px] w-full
        xl:h-[45px] h-[40px] font-poppins' .
        ($active ?
        ' active-sidebar-nav border-l-[6px] border-l-white text-[14px] xl:text-[18px] font-semibold text-white leading-[-0.2px]' :
        ' border-l-[6px] border-l-primary text-sm text-gray-4 font-medium leading-normal'
        )
        ]) }}
>
    {{ $slot }}
</a>
{{--</div>--}}
