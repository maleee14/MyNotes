<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $this->authorize('delete', $note);
        $note->delete();
    }

    public function with()
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }
}; ?>

<div>
    <div class="space-y-2">
        @if ($notes->isEmpty())
            <div class="text-center">
                <h1 class="text-2xl font-bold">No notes found</h1>
                <p class="text-gray-500">You have not created any notes yet.</p>
                <x-button class="mt-3" indigo icon="plus" href="{{ route('notes.create') }}" wire:navigate>Create
                    Note</x-button>
            </div>
        @else
            <x-button class="mb-12" indigo icon="plus" href="{{ route('notes.create') }}" wire:navigate>Create
                Note</x-button>
            <div class="grid grid-cols-2 gap-4 mt-12">
                @foreach ($notes as $item)
                    <x-card wire:key="{{ $item->id }}">
                        <div class="flex justify-between">
                            <div>
                                <a href="{{ route('notes.edit', $item->id) }}" wire:navigate
                                    class="text-xl font-bold hover:underline hover:text-blue-500">{{ $item->title }}</a>
                                <p class="text-xs mt-2">{{ Str::limit($item->body, 30, '...') }}</p>
                            </div>
                            <div class="text-xs text-gray-5oo">
                                {{ \Carbon\Carbon::parse($item->send_date)->format('d-M-Y') }}
                            </div>
                        </div>
                        <div class="flex items-end justify-between mt-4 space-x-1">
                            <p class="text-xs">Recipient: <span class="font-semibold">{{ $item->recipient }}</span></p>
                            <div>
                                <x-mini-button rounded icon="eye" yellow></x-mini-button>
                                <x-mini-button rounded icon="trash" yellow
                                    wire:click="delete('{{ $item->id }}')"></x-mini-button>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>
</div>
