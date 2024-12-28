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

        $message = (string) $this->message;
        // Send email
        $template = new ContactMail($this->name, $this->email, $message);
        $to = new Address('test1@example.com', 'Test User');
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
