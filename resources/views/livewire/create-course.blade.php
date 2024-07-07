<?php

use App\Models\Course;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component {

    #[Validate('required|string')]
    public String $slug;
    #[Validate('required|string')]
    public String $title;
    #[Validate('required|string')]
    public String $description;
    #[Validate('required|string')]
    public String $type = 'audio';
    #[Validate('required|string')]
    public String $duration;
    #[Validate('required|string')]
    public String $link;
    #[Validate('nullable|string')]
    public String $date;
    #[Validate('nullable|string')]
    public String $time;

    public $types = [
        ['name' => 'audio', 'label' => 'Audio', 'id' => 'audio'],
        ['name' => 'video', 'label' => 'Video', 'id' => 'video'],
        ['name' => 'link', 'label' => 'Link', 'id' => 'link'],
    ];


    public function save()
    {
        if (!auth()->user()->isTeacher()) {
            abort(401);
        }

        $this->validate();

        // handle file upload

        $course = Course::create([
            'teacher_id' => auth()->id(),
            'slug' => $this->slug,
            'title' => $this->title,
            'duration' => $this->duration,
            'description' => $this->description,
            'type' => $this->type,
            'link' => $this->link,
            'date' => $this->date ?? null,
            'time' => $this->time ?? null,
        ]);

        // save activity
        auth()->user()->activities()->create([
            'title' => 'Course created',
            'content' => 'Course created '.$course->slug,
            'status' => 'unread',
            'type' => 'course',
        ]);

        // send notification to admin
        $admin = User::where('role', 'admin')->first();

        $admin->setNotification('A new course has been created '.$course->slug.' by '.auth()->user()->first_name.' '.auth()->user()->last_name,
            'course', 'New Course Created');

//        if ($this->type === 'audio' || $this->type === 'video') {
//            $course->addMedia($this->upload)->toMediaCollection('course');
//        }

        $this->reset();

        // page reload to show the new course
        return redirect()->route('courses');
    }

}; ?>

<div
    x-data="{ type: @entangle('type') }"
    class="w-full max-w-[692px] py-[31px] flex flex-col items-center justify-start gap-[25px] bg-white rounded-[10px] px-[21px]">
    <div class="w-full max-w-[518px] justify-start gap-[10px] flex flex-row items-center  mb-[9px] flex-wrap">
        <p class="text-primary"> < </p>
        <h1 class="font-poppins font-semibold text-text-1 text-[16px] md:text-[18px] lg:text-[22px]">Add New
            Course</h1>
    </div>
    <div class="w-full max-w-[518px]">
        <x-form wire:submit="save" class="w-full gap-[32px]">

            <x-input label="Course Code" wire:model="slug" placeholder="Enter Course Code" required/>


            <x-input label="Course Title" wire:model="title" placeholder="Enter Course Title" required/>


            <x-textarea
                label="Course Description"
                wire:model="description"
                placeholder="Enter Course Description....."
                hint="Max 1000 chars"
                rows="5"
                required
            />

            <x-select required label="Course Type" :options="$types" wire:model="type"/>

            <x-input label="Course Duration" wire:model="duration" placeholder="Enter Course Duration" required/>

            <x-input label="Course Link" wire:model="link" placeholder="Paste link here"/>

            <template x-if="type === 'link'">
                <div class="flex flex-col items-start justify-start gap-[10px] w-full">
                    <p class="font-semibold text-[14px] lg:text-[16px] leading-[21px] lg:leading-[24px] text-text-4">
                        Class Schedule:</p>
                    <div class="flex flex-row items-center justify-between gap-[20px] w-full">

                        <x-datetime label="Course Date" wire:model="date" icon="o-calendar"/>

                        <x-datetime label="Course Time" wire:model="time" type="time" icon="o-calendar"/>

                    </div>
                </div>
            </template>
            <x-button
                class="mt-[16px] select-none rounded-lg bg-primary w-full max-w-[151px] py-3.5 px-7 text-center align-middle font-poppins text-sm font-bold uppercase text-white shadow-md leading-snug shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                label="Add Course" type="submit" spinner="save"/>
        </x-form>
    </div>
</div>
