<?php

namespace App\Mail;

use App\Models\ProjectInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectInvitationMail extends Mailable
{ 
    use Queueable, SerializesModels;
    public ProjectInvitation $invitation;

    public function __construct(ProjectInvitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function build()
    {
        return $this->subject('Project Invitation')
            ->view('emails.project_invitation');
    }
}