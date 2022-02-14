<?php

namespace App\Mail;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class welcomeEmail extends Mailable
{
    use Queueable, SerializesModels;


    // protected Admin $admin;

    // protected Admin $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('hr@CMS-System.com')
        ->subject('CMS-System | Welcome Email')
        ->markdown('cms.emails.welcome')->with('data',$this->data);
    }
}
