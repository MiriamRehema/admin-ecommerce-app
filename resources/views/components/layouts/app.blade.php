<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
    <livewire:styles />
   <livewire:scripts />

</x-layouts.app.sidebar>
