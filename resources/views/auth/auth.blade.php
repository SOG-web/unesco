<?php
$lists = [
    'dolor sit amet,
consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
et dolore magna aliqua 1.', 'dolor sit amet,
consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
et dolore magna aliqua 2.', 'dolor sit amet,
consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
et dolore magna aliqua 3.'
];

$activeList = $lists[0];

?>

<x-layouts.main :title="request()->is('login') ? 'Login' : 'Register' ">
    <div class="w-full min-h-dvh auth">
        <div class="w-full min-h-dvh auth-cover flex flex-row items-end justify-center gap-10">
            <div class="self-center flex flex-col items-start justify-center gap-[42px]">
                <img src="/img/logo.png" alt="logo" class="w-[275px] h-[165px]">
                <h1 class="text-[32px] leading-[48px] font-semibold text-white max-w-[559px] font-poppins mt-[14px]">
                    Begin your
                    entrepreneurial
                    journey with us
                    today...</h1>
                <p id="activeList"
                   class="text-white font-poppins text-[16px] font-normal leading-[28.16px max-w-[380px]">
                    {{ $activeList }} </p>

                <div id="bars" class="flex flex-row gap-3 items-start justify-center"></div>
            </div>
            <div class="bg-white rounded-t-3xl min-h-[600px] max-w-[460px] w-full"></div>
        </div>
    </div>
</x-layouts.main>

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
        bar.classList.add('bg-[#9E9E9E]', 'h-[5px]', 'w-[48px]');
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
