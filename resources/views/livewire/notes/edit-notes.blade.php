<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {
    public Note $note;

    public $title;
    public $body;
    public $recipient;
    public $send_date;
    public $is_published;

    public function mount($note)
    {
        $this->authorize('update', $note);
        $this->fill($note);
        $this->title = $note->title;
        $this->body = $note->body;
        $this->recipient = $note->recipient;
        $this->send_date = $note->send_date;
        $this->is_published = $note->is_published;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|min:5',
            'body' => 'required|min:20',
            'recipient' => 'required|email',
            'send_date' => 'required|date',
        ]);

        $this->note->update([
            'title' => $this->title,
            'body' => $this->body,
            'recipient' => $this->recipient,
            'send_date' => $this->send_date,
            'is_published' => $this->is_published,
        ]);

        $this->dispatch('save-note');
    }
}; ?>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Note') }}
    </h2>
</x-slot>

<div class="p-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form wire:submit="update" class="space-y-4">
            <x-action-message on="save-note" />
            @csrf
            <x-input wire:model='title' label='Note Title' placeholder="it's been a greate day" />
            <x-textarea wire:model='body' label='Your Note' placeholder="Share all your toughts with your friends" />
            <x-input icon="user" wire:model='recipient' label='Recipient' placeholder="yourfriend@gmail.com" />
            <x-input icon="calendar" wire:model='send_date' type="date" label='Send Date' />
            <x-checkbox label="Note Published" wire:model='is_published' />
            <div class="pt-4 flex justify-between">
                <x-button flat indigo type="submit" indigo right-icon="pencil-square" spinner='update'>Save
                    Note</x-button>
                <x-button flat yellow icon='arrow-left' href="{{ route('notes.index') }}">Back to Notes</x-button>
            </div>
            <x-errors />
        </form>
    </div>
</div>
