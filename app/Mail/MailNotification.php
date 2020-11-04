<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    protected $title;
    /**
     * @var string
     */
    protected $text;
    /**
     * @var
     */
    protected $url;

    /**
     * MailNotification constructor.
     * @param string $title
     * @param string $text
     * @param string|null $url
     */
    public function __construct(string $title, string $text, ?string $url = null)
    {
        $this->title = $title;
        $this->text = $text;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notification')
                ->subject($this->title)
                ->with([
                    'text' => $this->text,
                    'url' => $this->url,
                  ]);
    }
}
