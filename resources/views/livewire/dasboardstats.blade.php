<?php

use Livewire\Volt\Component;

new class extends Component {
    public function with()
    {
        return [
            'notesSend' => Auth::user()->notes()->where('send_date', '<', now())->where('is_published', true)->count(),
            'notesLoved' => Auth::user()->notes()->sum('heart_count'),
        ];
    }
}; ?>

<div>
    <div class="grid grid-cols-2 gap-6">
        <x-card class="p-5 bg-white shadow-md rounded-xl border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Notes Sent</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $notesSend }}</p>
                </div>
            </div>
        </x-card>

        <x-card class="p-5 bg-white shadow-md rounded-xl border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Notes Loved</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $notesLoved }}</p>
                </div>
            </div>
        </x-card>
    </div>
</div>
