<x-filament-widgets::widget>
    <x-filament::section>
        <div class="p-6 bg-white shadow rounded-lg w-full">
            <h1 class="text-3xl font-bold">
                📊 Welcome, {{ auth()->user()->name }} to {{ config('app.name') }}
            </h1>
            <p class="mt-2 text-gray-700 text-lg">
                Here, you can track student performance, school statistics, and financial insights at a glance.
            </p>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>