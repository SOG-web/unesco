@props([
    'activities' => [
        ['title' => 'Posted New Course', 'created_at' => '2024-05-23 01:01:22', 'type' => 'course']
        ]
    ])

<div class="w-full max-w-[186px] flex flex-col items-start justify-start gap-[25px]">
    <div class="flex flex-row items-center justify-center gap-2">
        <p class="text-text-1 text-left font-medium leading-[21px] text-[14px] lg:text-[16px]">Recent Activity</p>
    </div>
    <div class="flex flex-col items-start justify-start gap-4">
        @foreach($activities as $activity)
            <x-ui.activity-side-card :title="$activity['title']" :created_at="$activity['created_at']"
                                     :type="$activity['type']"/>
        @endforeach
    </div>
    @if(count($activities) > 4)
        <a href="/activities" class="text-sky-900 text-sm font-semibold font-poppins">See more >>></a>
    @endif
</div>
