<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public Note $note;
    public $heart_count;

    public function mount(Note $note)
    {
        $this->note = $note;
        $this->heart_count = $note->heart_count;
    }

    public function increaseHeart()
    {
        $this->note->heart_count++;
        $this->note->save();
        $this->heart_count = $this->note->heart_count;
    }
}; ?>

<div>
    <x-button xs wire:click='increaseHeart' rose icon="heart" spinner>{{ $heart_count }}</x-button>
</div>
