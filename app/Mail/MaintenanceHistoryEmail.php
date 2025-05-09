<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MaintenanceHistoryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $project_name;
    public string $maintenance_hour;
    public string $maintenance_remark;
    public string $maintenance_created_at;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        \App\Models\User $user,
        \App\Models\Project $project,
        \App\Models\MaintenanceHistory $maintenance_history
    )
    {
        $this->name = $user->name;
        $this->project_name = $project->name;
        $this->maintenance_hour = $maintenance_history->maintenance_hour;
        $this->maintenance_remark = $maintenance_history->maintenance_remark;
        $this->maintenance_created_at = $maintenance_history->created_at;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Maintenance History Email',
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
            view: 'mails.maintenancehour',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
