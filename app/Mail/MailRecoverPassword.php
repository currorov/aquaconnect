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

class MailRecoverPassword extends Mailable
{
        use Queueable, SerializesModels;
    
        /**
         * Create a new message instance.
         */
        public function __construct(User $user, $password)
        {
            $this->user = $user;
            $this->password = $password;
        }
    
        public function build()
        {
            return $this->subject($this->user->mail)
                        ->view('recoverPass')
                        ->from($this->user->mail, $this->user->name)
                        ->with(['user' => $this->user, 'password' => $this->password]);
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
                view: 'recoverPass',
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
