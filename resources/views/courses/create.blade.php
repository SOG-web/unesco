<x-auth-layout>
    <div class="w-full min-h-dvh flex flex-col items-center justify-start gap-[33px] pt-[50px] px-[10px] xl:pl-0">
        <div class="max-w-[692px] w-full lg:pl-[20px]">
            <x-ui.wlecome/>
        </div>
        <div
            class="w-full max-w-[692px] py-[31px] flex flex-col items-center justify-start gap-[25px] bg-white rounded-[10px] px-[21px]">
            <div class="w-full max-w-[518px] justify-start gap-[10px] flex flex-row items-center  mb-[9px] flex-wrap">
                <p class="text-primary"> < </p>
                <h1 class="font-poppins font-semibold text-text-1 text-[16px] md:text-[18px] lg:text-[22px]">Add New
                    Course</h1>
            </div>
            <form method="POST" action="/courses/store"
                  class="w-full max-w-[518px] flex flex-col items-center justify-start gap-[32px]">
                @csrf
                <x-form-field>
                    <x-ui.input label="Course Title" id="title" placeholder="Enter Title " name="title" type="text"
                                :value="old('title')"
                                required typed="others"/>
                    <x-form-error name="title"/>
                </x-form-field>
                <x-form-field>
                    <x-ui.input label="Course Description" id="description" placeholder="Enter description"
                                name="description"
                                required typed="textarea">
                        {{ old('description') }}
                    </x-ui.input>
                    <x-form-error name="description"/>
                </x-form-field>
                <x-form-field>
                    <x-ui.input label="Course Type" id="course-type"
                                name="type"
                                required typed="selection" :list="['audio', 'video', 'link']"/>
                    <x-form-error name="type"/>
                </x-form-field>
                <div id="upload-div" class="w-full">
                    <x-form-field>
                        <x-ui.upload label="Upload" id="upload" name="upload"/>
                        <x-form-error name="upload"/>
                    </x-form-field>
                </div>
                <div class="hidden w-full flex-col justify-center items-center gap-[33px]" id="link-div">
                    <x-form-field>
                        <x-ui.input label="Link" id="link" placeholder="Paste link here" name="link" type="text"
                                    :value="old('link')"
                                    typed="others"/>
                        <x-form-error name="link"/>
                    </x-form-field>
                    <div class="flex flex-col items-start justify-start gap-[10px] w-full">
                        <p class="font-semibold text-[14px] lg:text-[16px] leading-[21px] lg:leading-[24px] text-text-4">
                            Class Schedule:</p>
                        <div class="flex flex-row items-center justify-between gap-[20px] w-full">
                            <x-form-field>
                                <x-ui.input id="date" placeholder="Date" name="date" type="date"
                                            :value="old('date')"
                                            typed="others"/>
                                <x-form-error name="date"/>
                            </x-form-field>
                            <x-form-field>
                                <x-ui.input id="time" placeholder="Time" name="time" type="time"
                                            :value="old('time')"
                                            typed="others"/>
                                <x-form-error name="time"/>
                            </x-form-field>
                        </div>
                    </div>
                </div>
                <button
                    class="mt-[16px] select-none rounded-lg bg-primary w-full max-w-[151px] py-3.5 px-7 text-center align-middle font-poppins text-sm font-bold uppercase text-white shadow-md leading-snug shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="submit"
                >
                    Add Course
                </button>
            </form>
        </div>
    </div>
</x-auth-layout>

<script>
    document.getElementById('course-type').addEventListener('change', function () {
        const otherInput = document.getElementById('upload-div');
        const otherInput2 = document.getElementById('link-div');
        if (this.value === 'audio' || this.value === 'video') {
            otherInput.disabled = false;
            otherInput.classList.remove('hidden');
            otherInput2.classList.add('hidden');
            otherInput2.classList.remove('flex');
        } else {
            otherInput.disabled = true;
            otherInput.classList.add('hidden');
            otherInput2.classList.remove('hidden');
            otherInput2.classList.add('flex');
        }
    });
</script>

