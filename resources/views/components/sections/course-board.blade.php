@props(['courses', 'view' => false])

<div
    class="w-full max-w-[692px] max-h-[70dvh] overflow-y-scroll sidebar-scroll scroll-sep scroll-smooth py-[31px] flex flex-col items-center justify-start gap-[25px] bg-white rounded-[10px] px-[21px] xl:px-[45px]">

    <div
        class="
        w-full max-w-[518px] self-start
        {{ request()->is('courses') && auth()->user()->role == 'teacher' ? 'justify-between' : 'justify-start gap-[50px] lg:gap-[110px]' }}
        flex flex-row items-center  mb-[9px] flex-wrap">
        <h1 class="font-poppins font-semibold text-text-1 text-[16px] md:text-[18px] lg:text-[22px]">Courses</h1>
        @if (auth()->user()->role = !'teacher')
            {{-- {{ dd(auth()->user()->role) }} --}}
            {{-- <div class="tab-list">
                <button
                    class="tab-list-item rounded-[6px] px-[15px] py-[4px] font-poppins font-medium text-[12px] active"
                    data-target="tab1">All
                </button>
                <button class="tab-list-item rounded-[6px] px-[15px] py-[4px] font-poppins font-medium text-[12px]"
                    data-target="tab2">
                    Recent
                </button>
            </div> --}}
        @elseif(auth()->user()->role == 'teacher')
            <form class="hidden" method="POST" id="createForm" action="/courses/create">
                @csrf
                @method('GET')
            </form>
            <button type="submit" form="createForm" id="createForm"
                class="rounded-[10px] px-[15px] bg-primary py-[12px] text-white font-medium text-[12px] self-end"
                data-target="tab1">+ Add New Courses
            </button>
        @endif
    </div>
    {{-- @if (auth()->user()->role = !'teacher')
        <div class="tabs">
            <div class="tab-content">
                <div id="tab1" class="tab active">
                    @foreach ($courses as $course)
                        <x-ui.course-card :image="$course->thumbnail" :title="$course->title" :updated_at="$course->updated_at" :duration="$course->duration" />
                    @endforeach
                </div>
                <div id="tab2" class="tab">
                    Content for Tab 2
                </div>
            </div>
        </div>
    @endif --}}
    <div class="w-full flex flex-col items-start justify-start gap-4">
        @foreach ($courses as $course)
            <x-ui.course-card :image="$course->thumbnail" :title="$course->title" :updated_at="$course->updated_at" :duration="$course->duration"
                :teacher="$course->teacher_id" :view="$view" :id="$course->id"/>
        @endforeach
    </div>
    @if (request()->is('dashboard'))
        <div class="w-full max-w-[518px] flex items-end justify-end">
            <a href="/courses" class=" text-sky-900 text-sm font-semibold font-poppins">See more >>></a>
        </div>
    @endif
</div>

<style>
    .tab-list-item {
        cursor: pointer;
    }

    .tab-list-item.active {
        background-color: #DAD9F5 !important;
        color: #605C9D !important;
        font-weight: 600 !important;
    }

    .tab {
        display: none;
    }

    .tab.active {
        display: block;
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab-list-item');
        tabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                tabs.forEach(function(tab) {
                    tab.classList.remove('active');
                });
                const target = this.dataset.target;
                document.querySelectorAll('.tab').forEach(function(tabContent) {
                    tabContent.classList.remove('active');
                });
                document.getElementById(target).classList.add('active');
                this.classList.add('active');
            });
        });
    });
</script>
