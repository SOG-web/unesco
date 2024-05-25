<?php
$lists = [
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  1.',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  2.',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  3.'
];

?>

<x-app-layout :title="request()->is('login') ? 'Login' : 'Register' ">
    <div class="w-full min-h-dvh auth">
        <div
            class="w-full min-h-dvh auth-cover flex flex-row flex-wrap items-end justify-center gap-10 px-[15px] pt-[48px]">
            <div class="self-center flex flex-col items-center xl:items-start justify-center gap-[42px]">
                <img src="/img/logo.png" alt="logo" class="w-[171px] h-[104px] md:w-[275px] md:h-[165px]">
                <h1 class="text-2xl md:text-[32px] text-center xl:text-left leading-[35px] md:leading-[48px] font-semibold text-white max-w-[559px] font-poppins mt-[14px]">
                    Begin your
                    entrepreneurial
                    journey with us
                    today...</h1>
                <p id="activeList"
                   class="text-white text-center xl:text-left font-poppins text-xs md:text-[16px] font-normal leading-[23.2px] md:leading-[28.16px] max-w-[380px]">
                    {{ $lists[0] }} </p>

                <div id="bars" class="flex flex-row gap-3 items-start justify-center"></div>
            </div>
            @if($type == 'login')
                <div
                    class="bg-white rounded-t-3xl min-h-[600px]
                    max-w-[460px] w-full pt-[31px] px-[19px] flex
                    flex-col items-center justify-start gap-[18px]">
                    <div class="w-full flex flex-col items-center xl:items-start justify-center">
                        <p
                            class="text-center text-black text-xs font-normal font-poppins leading-snug">
                            WELCOME BACK
                        </p>
                        <p
                            class="text-center text-black text-[25px] font-medium font-poppins leading-[44px]">
                            Log In to your Account
                        </p>
                    </div>
                    <x-all-form-errors/>
                    <form method="POST" action="/login"
                          class="w-full flex flex-col items-center justify-center gap-[20px]">
                        @csrf
                        <x-form-field>
                            <x-ui.input label="Email" placeholder=" " id="email" name="email" type="email"
                                     :value="old('email')"
                                     required/>
                            <x-form-error name="email"/>
                        </x-form-field>
                        <x-form-field>
                            <x-ui.input label="Password" id="password" placeholder=" " name="password" type="password"
                                     required/>
                            <x-form-error name="password"/>
                        </x-form-field>
                        <div class="w-full flex flex-row items-center justify-between">
                            <div class="inline-flex items-center">
                                <div
                                    class="relative flex items-center p-3 rounded-full cursor-pointer"
                                    htmlFor="check">
                                    <input type="checkbox"
                                           name="rememberMe"
                                           class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10"
                                           id="rememberMe"/>
                                    <span
                                        class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                           fill="currentColor"
                                           stroke="currentColor" stroke-width="1">
                                        <path fill-rule="evenodd"
                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                              clip-rule="evenodd"></path>
                                      </svg>
                                    </span>
                                </div>
                                <label for="rememberMe"
                                       class="mt-px font-light font-poppins text-gray-700 cursor-pointer select-none"
                                       htmlFor="check">
                                    Remember Me
                                </label>
                            </div>
                            <a href="/forgot-password"
                               class="text-right text-[#424242] text-neutral-700 text-xs font-medium font-poppins leading-snug">
                                Forgot Password?</a>
                        </div>
                        <button
                            class="select-none rounded-lg bg-primary w-full py-3.5 px-7 text-center align-middle font-poppins text-sm font-bold uppercase text-white shadow-md leading-snug shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="submit"
                        >
                            Log In
                        </button>
                    </form>
                </div>
            @else
                <div
                    class="bg-white rounded-t-3xl min-h-[600px]
                    max-w-[460px] w-full py-[39px] px-[19px] xl:px-[39px] flex
                    flex-col items-center justify-start gap-[18px]">
                    <div class="w-full flex flex-col items-center xl:items-start justify-center">
                        <p
                            class="text-center text-black text-xs font-normal font-poppins leading-snug">
                            WELCOME
                        </p>
                        <p
                            class="text-center text-black text-[25px] font-medium font-poppins leading-[44px]">
                            Create your Account
                        </p>
                    </div>
                    <x-all-form-errors/>
                    <form method="POST" action="/register"
                          class="w-full flex flex-col items-center justify-center gap-[20px]">
                        @csrf
                        <x-form-field>
                            <x-ui.input label="First Name" placeholder=" " id="first_name" name="first_name" type="text"
                                     :value="old('first_name')"
                                     required/>
                            <x-form-error name="first_name"/>
                        </x-form-field>
                        <x-form-field>
                            <x-ui.input label="Last Name" placeholder=" " id="last_name" name="last_name" type="text"
                                     :value="old('last_name')"
                                     required/>
                            <x-form-error name="last_name"/>
                        </x-form-field>
                        <x-form-field>
                            <x-ui.input label="Email" placeholder=" " id="email" name="email" type="email"
                                     :value="old('email')"
                                     required/>
                            <x-form-error name="email"/>
                        </x-form-field>
                        <x-form-field>
                            <x-ui.input label="Password" id="password" placeholder=" " name="password" type="password"
                                     required/>
                            <x-form-error name="password"/>
                        </x-form-field>
                        <x-form-field>
                            <x-ui.input label="Confirm Password" id="password_confirmation" placeholder=" "
                                     name="password_confirmation" type="password"
                                     required/>
                            <x-form-error name="password_confirmation"/>
                        </x-form-field>
                        <div class="w-full flex flex-row items-center justify-between">
                            <div class="inline-flex items-center">
                                <div
                                    class="relative flex items-center p-3 rounded-full cursor-pointer"
                                    htmlFor="check">
                                    <input type="checkbox"
                                           name="rememberMe"
                                           class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10"
                                           id="rememberMe"/>
                                    <span
                                        class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                           fill="currentColor"
                                           stroke="currentColor" stroke-width="1">
                                        <path fill-rule="evenodd"
                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                              clip-rule="evenodd"></path>
                                      </svg>
                                    </span>
                                </div>
                                <label for="rememberMe"
                                       class="mt-px font-light font-poppins text-gray-700 cursor-pointer select-none"
                                       htmlFor="check">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <button
                            class="select-none rounded-lg bg-primary w-full py-3.5 px-7 text-center align-middle font-poppins text-sm font-bold uppercase text-white shadow-md leading-snug shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="submit"
                        >
                            Register
                        </button>
                    </form>
                    <div class="my-[20px] xl:mb-[10px] xl:mt-[50px]">
                        <p
                            class="text-center text-neutral-800 text-[12.80px] font-normal font-poppins"
                        >Already have an account? <a href="/login" class="underline">LOG IN HERE</a></p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

<script>
    // Get the paragraph element
    const paragraph = document.querySelector('#activeList');

    // Get the bars element
    const bars = document.querySelector('#bars');

    // Initialize the counter
    let counter = 0;

    // The list of texts
    const lists = <?php echo json_encode($lists); ?>;

    // Create the bars
    lists.forEach((list, index) => {
        const bar = document.createElement('div');
        bar.classList.add('bg-[#9E9E9E]', 'h-[2px]', 'md:h-[5px]', 'w-[33.26px]', 'md:w-[48px]');
        bar.id = `list-${index}`;
        bars.appendChild(bar);
    });

    // Apply white to the first bar until the interval starts
    const initBar = document.getElementById('list-0');
    initBar.classList.remove('bg-[#9E9E9E]');
    initBar.classList.add('bg-white');

    // Function to change the active list
    function changeActiveList() {
        // Set the text content of the paragraph to the current list item
        paragraph.textContent = lists[counter];

        // Remove the active class from past bars
        const pastBar = document.getElementById('list-' + (counter === 0 ? lists.length - 1 : counter - 1));
        pastBar.classList.remove('bg-white')
        pastBar.classList.add('bg-[#9E9E9E]')

        // Get the current bar
        const currentBar = document.getElementById('list-' + counter);

        // Add the active class to the current bar
        currentBar.classList.add('bg-white');
        currentBar.classList.remove('bg-[#9E9E9E]')


        // Increment the counter
        counter++;

        // If the counter is equal to the length of the list, reset it to 0
        if (counter === lists.length) {
            counter = 0;
        }
    }

    // Call the function every 3 seconds
    setInterval(changeActiveList, 3000);
</script>
