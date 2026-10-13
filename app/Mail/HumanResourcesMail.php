<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HumanResourcesMail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicationData;
    public $cvFilePath;
    public $cvFileName;

    /**
     * Create a new message instance.
     *
     * @param array $applicationData
     * @param string $cvFilePath Temporarily stored CV file path
     * @param string $cvFileName Original filename
     * @return void
     */
    public function __construct($applicationData, $cvFilePath, $cvFileName)
    {
        $this->applicationData = $applicationData;
        $this->cvFilePath = $cvFilePath;
        $this->cvFileName = $cvFileName;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
   public function envelope()
{
    return new Envelope(
        from: config('mail.from.address') ?: 'info@guvenkagroup.com',
        subject: 'Yeni Kariyer / İnsan Kaynakları Başvurusu: ' . $this->applicationData['name'],
    );
}

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'frontend.hr_mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
            Attachment::fromPath($this->cvFilePath)
                ->as($this->cvFileName),
        ];
    }
}
