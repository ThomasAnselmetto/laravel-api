<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PublishedProjectMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $project;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()

    //   metti il published dentro la variabile subject
    {
        return new Envelope(
            subject: 'Published Project Mail' . env('APP_NAME'),

            //? possiamo aggiungere altre voci es
            // replyTo: 'mailgenerica@gmail.com',
            // cc:stringa,array o cosa vogliamo
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        
    // * per la mail avremo un template apposta che si rifa' ad uno specifico elemento quindi potremmo avere uno scaffolding ben strutturato con mail_per_i_projects, mail_per_i_types ecc

    $project = $this->project;
    $published_text = $project->published ? 'Project created correctly' : 'Project ejected from the list';
    $button_url = env('APP_FRONTEND_URL') . '/projects/' . $project->slug;

        return new Content(
            markdown: 'mails.projects.published',

            // ? possiamo creare array associativo con chiave valore oppure utilizzare ilcompact
            // ? with: ['project' => $project,
            // ? 'published_text' => $published_text
            // ? ]
            
            with:compact('project','published_text','button_url'),
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