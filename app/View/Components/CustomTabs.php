<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomTabs extends Component
{

    public string $uuid;

    public function __construct(
        public ?string $selected = null,
        public string $labelClass = 'font-semibold border-b-2 border-b-base-300',
        public string $activeClass = 'border-b-2 border-b-gray-600 dark:border-b-gray-400',
        public string $labelDivClass = 'border-b-2 border-b-base-200 flex overflow-x-auto',
        public string $tabsClass = 'relative w-full',
    ) {
        $this->uuid = "custom".md5(serialize($this));
    }

    public function render(): View|Closure|string
    {
        return <<<'HTML'
                    <div
                        x-data="{
                                tabs: [],
                                selected:
                                    @if($selected)
                                        '{{ $selected }}'
                                    @else
                                        @entangle($attributes->wire('model'))
                                    @endif
                                 ,
                                 init() {
                                     // Fix weird issue when navigating back
                                     document.addEventListener('livewire:navigating', () => {
                                         document.querySelectorAll('.tab').forEach(el =>  el.remove());
                                     });
                                 }
                        }"
                        class="{{ $tabsClass }}"
                    >
                        <!-- TAB LABELS -->
                        <div class="{{ $labelDivClass }}">
                            <template x-for="tab in tabs">
                                <a
                                    role="tab"
                                    x-html="tab.label"
                                    @click="selected = tab.name"
                                    :class="(selected === tab.name) && '{{ $activeClass }}'"
                                    class="tab {{ $labelClass }}"></a>
                            </template>
                        </div>

                        <!-- TAB CONTENT -->
                        <div role="tablist" {{ $attributes->except(['wire:model', 'wire:model.live'])->class(["tabs block"]) }}>
                            {{ $slot }}
                        </div>
                    </div>
                HTML;
    }
}
