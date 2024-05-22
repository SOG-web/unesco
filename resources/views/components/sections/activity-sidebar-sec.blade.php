@props([
    'activities' => [
        ['header' => 'Posted New Course', 'date_time' => '09 Jan, 09:20AM', 'type' => 'course']
        ]
    ])

<div class="w-full max-w-[186px] flex flex-col items-start justify-start gap-[25px]">
    <div class="flex flex-row items-center justify-center gap-2">
        <p class="text-text-1 text-left font-poppins font-medium text-[16px]">Recent Activity</p>
    </div>
    <div class="flex flex-col items-start justify-start gap-4">
        @foreach($activities as $activity)
            <x-ui.activity-side-card :header="$activity['header']" :date_time="$activity['date_time']"
                                     :type="$activity['type']"/>
        @endforeach
    </div>
    <a href="/notices" class="text-sky-900 text-sm font-semibold font-poppins">See more >>></a>
</div>
