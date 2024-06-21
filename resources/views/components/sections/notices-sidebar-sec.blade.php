@props([
    'notices', 'noticeCount'=> 0])

<div class="w-full max-w-[186px] flex flex-col items-start justify-start gap-[25px]">
    <div class="flex flex-row items-center justify-center gap-2">
        <p class="text-text-1 text-left font-medium text-[14px] md:text-[16px]">Notices</p>
        <x-ui.dot content="{{ $noticeCount }}"/>
    </div>
    <div class="flex flex-col items-start justify-start gap-4">
        @foreach($notices as $notice)
            <x-ui.notice-side-card :title="$notice->title" :created_at="$notice['created_at']"/>
        @endforeach
    </div>
    @if($noticeCount > 0)
        <a href="/notices" class="text-sky-900 text-sm font-semibold font-poppins">See more >>></a>
    @endif
</div>
