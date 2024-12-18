<?php

namespace App\Livewire;

use Illuminate\Mail\Mailables\Address;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $message;

    public function sendEmail()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Send email
        $template = new ContactMail($this->name, $this->email, $this->message);
        $to = new Address($this->email, $this->name);
        Mail::to($to)
            ->send($template);

        // Show a success message
        session()->flash('success', 'Thank you for your message. We will contact you soon.');

        // Reset form fields
        $this->reset();
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
