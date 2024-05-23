<div class="w-full max-w-[692px] py-[31px] flex flex-col items-center justify-start gap-[25px] bg-white rounded-[10px]">
    <div class="w-full max-w-[518px] gap-[110px] flex flex-row items-center justify-start mb-[9px] flex-wrap">
        <h1 class="font-poppins font-semibold text-text-1 text-[16px] md:text-[18px] lg:text-[22px]">Courses</h1>
        <div class="tab-list">
            <button class="tab-list-item rounded-[6px] px-[15px] py-[4px] font-poppins font-medium text-[12px] active"
                    data-target="tab1">All
            </button>
            <button class="tab-list-item rounded-[6px] px-[15px] py-[4px] font-poppins font-medium text-[12px]"
                    data-target="tab2">
                Recent
            </button>
        </div>
    </div>
    <div class="tabs">
        <div class="tab-content">
            <div id="tab1" class="tab active">
                Content for Tab 1
            </div>
            <div id="tab2" class="tab">
                Content for Tab 2
            </div>
        </div>
    </div>
    <div class="w-full max-w-[518px] flex items-end justify-end">
        <a href="/courses" class=" text-sky-900 text-sm font-semibold font-poppins">See more >>></a>
    </div>
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
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('.tab-list-item');
        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                tabs.forEach(function (tab) {
                    tab.classList.remove('active');
                });
                const target = this.dataset.target;
                document.querySelectorAll('.tab').forEach(function (tabContent) {
                    tabContent.classList.remove('active');
                });
                document.getElementById(target).classList.add('active');
                this.classList.add('active');
            });
        });
    });
</script>
