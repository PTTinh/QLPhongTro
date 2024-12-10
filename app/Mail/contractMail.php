<?php

namespace App\Mail;

use App\Models\Contract;
use App\Models\ContractDetails;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class contractMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;        
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Hợp đồng thuê Trọ',
        );
    }

    /**
     * Get the message content definition.
     */

    public function content(): Content
    {
        $name = ContractDetails::find($this->id)->lessee->name;
        $uid = ContractDetails::find($this->id)->lessee->id;
        return new Content(
            view: 'mail.mail_content',
            with: [
                'name' => $name,
                'id' => $this->id,
                'uid' => $uid
            ],
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
