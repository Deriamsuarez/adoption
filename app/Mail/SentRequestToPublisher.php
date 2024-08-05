<?php
namespace App\Mail;

use App\Models\Form;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SentRequestToPublisher extends Mailable
{
    use Queueable, SerializesModels;

    public $form;
    public $pet;
    public $applicant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Form $form, Pet $pet, User $applicant)
    {
        $this->form = $form;
        $this->pet = $pet;
        $this->applicant = $applicant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.send_request_to_publiser')
                    ->with([
                        'form' => $this->form,
                        'pet' => $this->pet,
                        'applicant' => $this->applicant, // Asegúrate de incluir esta línea

                    ]);
    }
}
