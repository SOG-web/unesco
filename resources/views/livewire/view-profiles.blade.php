<div class="w-full p-[40px] flex flex-col items-center justify-start gap-[20px]">
    <div class="w-full flex flex-row items-center justify-center">
        <h1 class="font-semibold text-[22px] leading-[33px] text-center text-text-1">View {{ $title }}</h1>
        {{--        <p class="text-[14px] text-primary leading-[21px] font-semibold self-end">edit</p>--}}
    </div>
    @if($user->profile_pic)
        <img src="{{ $user->profile_pic }}" alt="user picture"
             class="w-[60px] h-[60px] 2xl:w-[80px] 2xl:h-[80px] xl2:w-[100px] xl2:h-[100px] rounded-full bg-background"/>
    @else
        {{--name avatar--}}
        <x-ui.name-avatar :first_name="$user->first_name" :last_name="$user->last_name"/>
    @endif

    <div class="flex flex-col items-center justify-center w-full">
        <h1 class="font-semibold text-[32px] leading-[48px] text-center text-text-1">{{ $user->first_name }} {{ $user->last_name }}</h1>
        <p class="text-[14px] text-text-3 leading-[21px] font-normal">{{ $user->email }}</p>
    </div>

    <div class="flex flex-col items-center justify-center w-full">
        <h1 class="font-normal text-[14px] leading-[21px] text-center text-text-3">Courses:</h1>
        <div class="flex flex-row items-center justify-center gap-[10px]">
            @foreach($courses as $course)
                <p class="text-[22px] text-text-1 leading-[32px] tracking-[-6%] w-full text-wrap font-semibold">{{ $course }}
                    ,</p>
            @endforeach
        </div>
    </div>

    <div class="flex flex-col items-center justify-center w-full">
        <h1 class="font-normal text-[14px] leading-[21px] text-center text-text-3">Total Assessment:</h1>
        <div class="flex flex-row items-center justify-center gap-[10px]">
            <p class="text-[22px] text-text-1 leading-[32px] tracking-[-6%] w-full text-wrap font-semibold">{{ $assessmentCount }}</p>
        </div>
    </div>

    <div class="flex flex-col items-center justify-center w-full">
        <h1 class="font-normal text-[14px] leading-[21px] text-center text-text-3">Assessment Completed:</h1>
        <div class="flex flex-row items-center justify-center gap-[10px]">
            <p class="text-[22px] text-text-1 leading-[32px] tracking-[-6%] w-full text-wrap font-semibold">{{ $completedAssessments }}</p>
        </div>
    </div>

    <div class="flex flex-col items-center justify-center w-full">
        <h1 class="font-normal text-[14px] leading-[21px] text-center text-text-3">Date Joined:</h1>
        <div class="flex flex-row items-center justify-center gap-[10px]">
            <p class="text-[22px] text-text-1 leading-[32px] tracking-[-6%] w-full text-wrap font-semibold">{{ $user->created_at->format('d M Y') }}</p>
        </div>
    </div>

    {{--    <div class="w-[151px] m-auto mt-4">--}}
    {{--        <x-button label="< go back" class="mt-4 bg-primary text-white w-full"--}}
    {{--                  wire:click="$parent.closeModal({{ $type }})"/>--}}
    {{--    </div>--}}

</div>
