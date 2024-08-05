<?php
namespace App\Mail;

use App\Models\Form;
use App\Models\Pet;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SentRequestToApplicant extends Mailable
{
    use Queueable, SerializesModels;

    public $form;
    public $pet;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Form $form, Pet $pet)
    {
        $this->form = $form;
        $this->pet = $pet;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.send_request_to_applicant')
                    ->with([
                        'form' => $this->form,
                        'pet' => $this->pet,
                    ]);
    }
}
