@props(['first_name', 'last_name'])

<div
    class="w-[60px] h-[60px] 2xl:w-[80px] 2xl:h-[80px] xl2:w-[100px] xl2:h-[100px] rounded-full bg-background flex items-center justify-center">
                <span
                    class="text-[20px] 2xl:text-[30px] xl2:text-[40px] text-primary font-bold font-poppins">{{ substr($first_name, 0, 1) }} {{ substr($last_name, 0, 1) }}</span>
</div>
