<?php

namespace App\Jobs;

use App\Models\Note;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Note $note)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $noteUrl = config('app.url') . '/notes/' . $this->note->id;

        $emailContent = "Hello, you've recieved a new note. View it here: {$noteUrl}";

        Mail::raw($emailContent, function ($message) {
            $message->from('mynotes@gmail.com', 'MyNotes')
                ->to($this->note->recipient)
                ->subject('You have new note from ' . $this->note->user->name);
        });
        Log::info('SendEmail job completed.');
    }
}
