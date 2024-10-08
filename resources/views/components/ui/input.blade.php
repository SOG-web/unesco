@props(['label' => '', 'name' => '', 'typed' => 'auth', 'list'=>[]])

@if($typed == 'auth')
    <div class="relative w-full min-w-[200px] h-[56px]">
        <input
            name="{{ $name }}"
            class="w-full h-full px-3 py-3 font-poppins text-sm font-normal transition-all
        bg-transparent border rounded-lg peer text-[#424242] outline outline-0
        focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 placeholder-shown:border
        placeholder-shown:border-[#424242] placeholder-shown:border-t-[#424242]
        focus:border-2 border-t-transparent focus:border-t-transparent border-[#424242] focus:border-[#424242]"
            {{ $attributes }}/>
        <label
            for="{{  $name }}"
            class="flex w-full h-full select-none pointer-events-none
        absolute left-0 font-normal !overflow-visible truncate
        peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight
        peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500
        transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px]
        peer-focus:text-[11px] before:content[' '] before:block before:box-border
        before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1
        peer-placeholder-shown:before:border-transparent before:rounded-tl-md
        before:border-t peer-focus:before:border-t-2 before:border-l
        peer-focus:before:border-l-2 before:pointer-events-none
        before:transition-all peer-disabled:before:border-transparent
        after:content[' '] after:block after:flex-grow after:box-border
        after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1
        peer-placeholder-shown:after:border-transparent
        after:rounded-tr-md after:border-t peer-focus:after:border-t-2
        after:border-r peer-focus:after:border-r-2 after:pointer-events-none
        after:transition-all peer-disabled:after:border-transparent
        peer-placeholder-shown:leading-[4.1] text-gray-500 peer-focus:text-[#424242]
        before:border-[#424242] peer-focus:before:!border-[#424242] after:border-[#424242]
        peer-focus:after:!border-gray-900">
            {{ $label }}
        </label>
    </div>
@elseif($typed == 'others')
    <div class="flex w-full flex-col items-start justify-start gap-[6px]">
        @if(!$label == '')
            <label for="{{ $name }}"
                   class="font-semibold text-[14px] lg:text-[16px] leading-[21px] lg:leading-[24px] text-text-4">{{ $label }}
                :</label>
        @endif
        <input
            name="{{ $name }}"
            class="w-full h-[54px] lg:h-[61px] px-[24px] lg:px-[37px]
            border-[1px] border-[#E5E5E5] rounded-[6px] font-poppins
            font-normal text-[12px] lg:text-[16px] text-text-4
            focus:outline-none focus:border-[#424242]
            placeholder-text-2
            "
            {{ $attributes }}/>
    </div>
@elseif($typed == 'textarea')
    <div class="flex w-full flex-col items-start justify-start gap-[6px]">
        <label for="{{ $name }}"
               class="font-semibold text-[14px] lg:text-[16px] leading-[21px] lg:leading-[24px] text-text-4">{{ $label }}
            :</label>
        <textarea
            name="{{ $name }}"
            class="w-full h-[162px] lg:h-[153px] px-[24px] lg:px-[37px]
            border-[1px] border-[#E5E5E5] rounded-[6px] text-left
            font-normal text-[12px] lg:text-[16px] text-text-4
            focus:outline-none focus:border-[#424242]
            placeholder-text-2
            "
            {{ $attributes }}>
            {{ $slot }}
        </textarea>
    </div>
@elseif($typed == 'selection')
    <div class="flex w-full flex-col items-start justify-start gap-[6px]">
        <label for="{{ $name }}"
               class="font-semibold text-[14px] lg:text-[16px] leading-[21px] lg:leading-[24px] text-text-4">{{ $label }}
            :</label>
        <select
            name="{{ $name }}"
            {{ $attributes }}
            class="peer w-full h-[54px] lg:h-[61px] px-[24px] lg:px-[37px]
            border-[1px] border-[#E5E5E5] rounded-[6px] text-left text-text-4
            focus:outline-none focus:border-[#424242]"
        >
            @foreach($list as $item)
                <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
    </div>
@endif
