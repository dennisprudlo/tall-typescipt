<div
    x-data="Modal()"
    x-init="init()"
    x-on:close.stop="hide($event)"
    x-on:keydown.escape.window="hide($event)"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    class="fixed z-40 inset-0 overflow-y-scroll"
    style="display: none;"
>
    {{-- Modal Wrapper --}}
    <div class="flex">

        {{-- Modal Transparency Background --}}
        <div
            x-show="show"
            x-on:click="hide($event)"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-all transform">
            <div class="absolute inset-0 bg-black opacity-40"></div>
        </div>

        {{-- Modal Container --}}
        <div
            x-show="show && showActiveComponent"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4 xs:translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 -translate-y-4 xs:translate-y-4 sm:translate-y-0 sm:scale-95"
            class="xs:mt-4 sm:mt-10 mb-10 xs:px-4 sm:px-10 transform transition-all w-full"
        >
            @foreach ($components as $id => $component)
                <div x-show.immediate="activeComponent == '{{ $id }}'" class="w-full mx-auto">
                    @livewire($component['name'], $component['attributes'], key($id))
                </div>
            @endforeach
        </div>
    </div>
</div>
