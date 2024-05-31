@props(['lists' => [], 'type' => 'image'])


<div
    class="w-full max-w-[323px] py-[31px] flex flex-col items-start justify-start gap-[30px] bg-white rounded-[10px] px-[21px]">
    @foreach ($lists as $list)
        @if ($type == 'image')
            <div class="w-full flex flex-row items-start justify-start gap-4">
                <div class="w-[43px] h-[43px] bg-[#F3E4FF] rounded-full">
                    <img src="{{ $list['profile_pic'] }}" alt="profile image"
                         class="w-full h-full object-cover rounded-full">
                </div>
                <div class="flex flex-col items-start justify-start">
                    <h1 class="max-w-[150px] truncate font-poppins font-semibold text-text-1 text-[12px]">
                        {{ $list['first_name'] . ' ' . $list['last_name'] }}</h1>
                    <p class="max-w-[120px] truncate font-poppins font-normal text-text-2 text-[12px]">{{ $list['email'] }}</p>
                </div>
            </div>
        @else
            <div class="w-full flex flex-row items-start justify-start gap-4">
                <div class="flex items-center justify-center w-[43px] h-[36px] bg-[#F3E4FF] rounded-[8px] px-1.5">
                    <p class="max-w-[33px] truncate font-semibold text-center leading-[11.87px] text-text-1 text-[12px] text-wrap">
                        {{ $list['course'] }}</p>
                </div>
                <div class="flex flex-col items-start justify-start">
                    <h1 class="max-w-[150px] truncate font-poppins font-semibold text-text-1 text-[12px]">
                        {{ $list['title'] . ' ' . $list['first_name'] . ' ' . $list['last_name'] }}</h1>
                    <p class="max-w-[150px] truncate font-poppins font-normal text-text-2 text-[12px]">{{ $list['role'] }}</p>
                </div>
            </div>
        @endif
    @endforeach
</div>
