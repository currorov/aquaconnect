<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;
use App\Models\Jetsky;

class JetskyInfoMail extends Mailable
{
        use Queueable, SerializesModels;
    
        /**
         * Create a new message instance.
         */
        public function __construct(User $user, User $userjetsky, Jetsky $jetsky)
        {
            $this->user = $user;
            $this->userjetsky = $userjetsky;
            $this->jetsky = $jetsky;
        }
    
        public function build()
        {
            return $this->subject($this->user->mail)
                        ->view('jetsky_info')
                        ->from($this->user->mail, $this->user->name)
                        ->with(['user' => $this->user, 'jetsky' => $this->jetsky, 'userjetsky' => $this->userjetsky]);
        }
    
        /**
         * Get the message envelope.
         */
        public function envelope(): Envelope
        {
            return new Envelope(
                subject: 'Send Mail',
            );
        }
    
        /**
         * Get the message content definition.
         */
        public function content(): Content
        {
            return new Content(
                view: 'jetsky_info',
            );
        }
    
        /**
         * Get the attachments for the message.
         *
         * @return array<int, \Illuminate\Mail\Mailables\Attachment>
         */
        public function attachments(): array
        {
            return [];
        }
}
