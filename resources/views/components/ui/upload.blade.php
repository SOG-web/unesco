@props(['label' => '', 'name' => ''])

<div class="flex w-full flex-col items-start justify-start gap-[6px]">
    <p class="font-semibold text-[14px] lg:text-[16px] leading-[21px] lg:leading-[24px] text-text-4">{{ $label }}:</p>
    <div id="{{ $name }}"
         class="flex items-center justify-center w-full bg-background h-[54px] lg:h-[84px] rounded-[9px] lg:rounded-[25px]">
        <label for="dropzone-file"
               class="flex flex-col items-center justify-center w-full h-full">
            <div class="flex flex-row items-center justify-center gap-3 w-full h-full">
                <svg class="w-6 h-6 text-gray-500 " aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <div class="flex flex-col items-center justify-center gap-1 w-fit h-full">
                    <p class="text-sm text-gray-500"><span
                            class="font-semibold">Click to upload</span></p>
                    <p class="text-xs text-gray-500">(MAX. 800x400px)</p>
                </div>
            </div>
            <input id="dropzone-file" name="{{ $name }}" {{ $attributes }} type="file" class="hidden"/>
        </label>
    </div>
</div>

