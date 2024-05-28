@props(['lists'])


<div
    class="w-full py-[31px] flex flex-row flex-wrap items-start justify-start gap-[30px] bg-white rounded-[10px] px-[21px]">
    @foreach($lists as $list)
            <div class="flex flex-row items-start justify-start gap-4">
                <div class="w-[43px] h-[43px] bg-[#F3E4FF] rounded-full">
                    <img src="{{ $list['profile_photo_url'] }}" alt="profile image" class="w-full h-full object-cover rounded-full">
                </div>
                <div class="flex flex-col items-start justify-start">
                    <h1 class="font-poppins font-semibold text-text-1 text-[12px]">{{ $list['first_name'] . ' '. $list['last_name'] }}</h1>
                    <p class="font-poppins font-normal text-text-2 text-[12px] truncate w-[100px]">{{ $list['email'] }}</p>
                </div>
            </div>
    @endforeach
</div>
