@php
    use Carbon\Carbon;

    $teacherData = \App\Models\User::where('id', $teacher)->get()->first();

    $uniqueId = $id;
@endphp

@props(['image', 'title', 'view' => false, 'updated_at', 'teacher', 'duration', 'id', 'type' => 'video', 'progress'=>[]])

<div onclick="goto({{$id}})" class="flex flex-row items-center justify-between w-full h-full course-card cursor-pointer"
     id="{{ $id }}">
    <div class="flex flex-row items-start justify-start gap-4 w-full h-full">
        {{-- <img src="{{ $image }}" alt="course_image" class="w-[122px] h-[108px] md:w-[123px] md:[82px] rounded-[8px]" /> --}}
        <div class="w-[80px] h-[80px] rounded-[8px] bg-bg-2 flex justify-center items-center">
            @if ($type == 'video')
                <svg class="w-[30px] h-[30px] text-secondary" viewBox="0 0 26 25" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M24.8083 8.70193C24.0766 8.33113 23.1977 8.40842 22.542 8.90125L20.5562 10.3757C20.2747 7.60953 17.9471 5.50419 15.1667 5.50068H15.0746L10.6091 1.03625C10.0014 0.424285 9.17384 0.0813087 8.31137 0.0840001H1.08332C0.485012 0.0840001 0 0.569063 0 1.16737C0 1.76567 0.485012 2.25068 1.08332 2.25068H8.31132C8.59848 2.25145 8.87372 2.3655 9.07725 2.56812L12.0098 5.50068H5.41668C2.42663 5.50429 0.00360547 7.92732 0 10.9174V19.5841C0.00360547 22.5741 2.42663 24.9971 5.41668 25.0007H15.1667C17.9472 24.9972 20.2747 22.8918 20.5562 20.1257L22.5387 21.6034C23.496 22.3213 24.8541 22.1273 25.5721 21.1701C25.8533 20.795 26.0054 20.3389 26.0054 19.8701V10.6389C26.0082 9.81785 25.544 9.06664 24.8083 8.70193ZM18.4167 19.584C18.4167 21.3789 16.9616 22.834 15.1667 22.834H5.41668C3.62177 22.834 2.16668 21.3789 2.16668 19.584V10.9174C2.16668 9.12245 3.62177 7.66737 5.41668 7.66737H15.1667C16.9616 7.66737 18.4167 9.12245 18.4167 10.9174V19.584ZM23.8333 19.8624L20.5833 17.4401V13.0613L23.8333 10.639V19.8624Z"
                        fill="#8F00FF"/>
                </svg>
            @elseif ($type == 'audio')
                <x-iconic-headphones class="w-[30px] h-[30px] text-secondary"/>
            @else
                <x-iconic-link class="w-[30px] h-[30px] text-secondary"/>
            @endif
        </div>
        <div class="flex flex-col w-full h-full items-start justify-between gap-[10px]">
            <div class="w-full flex flex-col gap-0.5 items-start justify-start">
                <div class="md:hidden flex flex-row gap-2 items-center justify-start">
                    <heroicon-c-user class="w-[14px] h-[14px] text-gray-2"/>
                    <p class="font-medium font-poppins text-[8px] text-gray-2">{{ $teacherData->title . ' ' . $teacherData->first_name . ' '. $teacherData->last_name }}</p>
                </div>
                <h1
                    class="max-w-[379px] max-h-[63px] font-poppins font-semibold text-[14px] text-text-1 text-left truncate text-wrap">
                    {{ $title }}</h1>
                @if(auth()->user()->role == 'students')
                    @if(count($progress) < 1)
                        <x-progress value="1" max="100" class="w-full max-w-[290px] h-1.5 progress-error"/>
                    @else
                        <x-progress value="{{ (int) $progress[0]->progress }}" max="100"
                                    class="w-full max-w-[290px] h-1.5 {{ (int) $progress[0]->progress < 20 ? 'progress-error' : ((int) $progress[0]->progress < 60 ? 'progress-warning' : 'progress-success') }}"/>
                    @endif
                @endif
            </div>
            <div class="flex flex-row justify-between gap-4 items-center">
                <div class="flex flex-row gap-2 items-center justify-center">
                    <x-heroicon-o-calendar-days class="w-[14px] h-[14px] text-gray-2"/>
                    <p class="font-medium font-poppins text-[8px] text-gray-2">
                        {{ Carbon::parse($updated_at)->format('d M, h:iA') }}</p>
                </div>
                <div class="hidden md:flex flex-row gap-2 items-center justify-start">
                    <heroicon-c-user class="w-[14px] h-[14px] text-gray-2"/>
                    <p class="font-medium font-poppins text-[8px] text-gray-2">{{ $teacherData->title . ' ' . $teacherData->first_name . ' '. $teacherData->last_name }}</p>
                </div>
                <div class="flex flex-row gap-2 items-center justify-start">
                    <x-heroicon-o-clock class="w-[14px] h-[14px] text-gray-2"/>
                    <p class="font-medium font-poppins text-[8px] text-gray-2">{{ $duration }}</p>
                </div>
            </div>
        </div>
    </div>
    @if ($view)
        <a href="{{ '/courses/' . $id }}"
           class="hidden md:block font-poppins font-semibold text-[14px] text-left text-sky-900 w-[90px] view">View
            ></a>
    @endif
</div>


<script>
    function goto(id) {
        window.location.href = '/courses/' + id;
    }
</script>
