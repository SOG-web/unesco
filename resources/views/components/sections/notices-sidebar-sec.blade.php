@props([
    'notices' => [
        ['header' => 'New Notification', 'time' => '09:20AM', 'date' => '22/04/24']
        ]
    ])

<div class="w-full max-w-[186px] flex flex-col items-start justify-start gap-[25px]">
    <div class="flex flex-row items-center justify-center gap-2">
        <p class="text-text-1 text-left font-poppins font-medium text-[16px]">Notices</p>
        <x-ui.dot content="{{ count($notices) }}"/>
    </div>
    <div class="flex flex-col items-start justify-start gap-4">
        @foreach($notices as $notice)
            <x-ui.notice-side-card :header="$notice['header']" :time="$notice['time']" :date="$notice['date']"/>
        @endforeach
    </div>
    <a href="/notices" class="text-sky-900 text-sm font-semibold font-poppins">See more >>></a>
</div>
