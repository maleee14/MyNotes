<?php

use Livewire\Volt\Component;

new class extends Component {
    public $title;
    public $body;
    public $recipient;
    public $send_date;

    public function store()
    {
        $this->validate([
            'title' => 'required|min:5',
            'body' => 'required|min:20',
            'recipient' => 'required|email',
            'send_date' => 'required|date',
        ]);

        auth()
            ->user()
            ->notes()
            ->create([
                'title' => $this->title,
                'body' => $this->body,
                'recipient' => $this->recipient,
                'send_date' => $this->send_date,
            ]);
        redirect()->route('notes.index');
    }
}; ?>

<div>
    <form wire:submit="store" class="space-y-4">
        @csrf
        <x-input wire:model='title' label='Note Title' placeholder="it's been a greate day" />
        <x-textarea wire:model='body' label='Your Note' placeholder="Share all your toughts with your friends" />
        <x-input icon="user" wire:model='recipient' label='Recipient' placeholder="yourfriend@gmail.com" />
        <x-input icon="calendar" wire:model='send_date' type="date" label='Send Date' />
        <div class="pt-4">
            <x-button type="submit" flat indigo right-icon="pencil-square" spinner>Schedule Note</x-button>
        </div>
        <x-errors />
    </form>
</div>
