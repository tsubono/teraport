<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $type;
    /**
     * @var string
     */
    protected $email;
    /**
     * @var string
     */
    protected $content;

    /**
     * ContactNotification constructor.
     * @param string $name
     * @param string $type
     * @param string $email
     * @param string $content
     */
    public function __construct(string $name, string $type, string $email, string $content)
    {
        $this->name = $name;
        $this->type = $type;
        $this->email = $email;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact')
            ->subject('お問い合わせが届きました')
            ->with([
                'name' => $this->name,
                'type' => $this->type,
                'email' => $this->email,
                'content' => $this->content,
            ]);
    }
}
