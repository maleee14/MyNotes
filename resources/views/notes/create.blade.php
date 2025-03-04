<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Notes') }}
        </h2>
    </x-slot>

    <div class="p-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <x-button flat yellow icon='arrow-left' href="{{ route('notes.index') }}">All Notes</x-button>
            <livewire:notes.create-notes />
        </div>
    </div>
</x-app-layout>
