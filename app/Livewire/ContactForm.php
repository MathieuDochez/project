<?php

namespace App\Livewire;

use Illuminate\Mail\Mailables\Address;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Log;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|string|min:2|max:100',
        'email' => 'required|email:rfc,dns|max:255',
        'message' => 'required|string|min:10|max:1000',
    ];

    protected $messages = [
        'name.required' => 'Please tell us your name.',
        'name.min' => 'Name must be at least 2 characters.',
        'name.max' => 'Name cannot exceed 100 characters.',
        'email.required' => 'We need your email to get back to you.',
        'email.email' => 'Please enter a valid email address.',
        'message.required' => 'Please tell us how we can help you.',
        'message.min' => 'Message must be at least 10 characters.',
        'message.max' => 'Message cannot exceed 1000 characters.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function sendEmail()
    {
        $this->validate();

        try {
            // Clean and prepare the message
            $cleanMessage = strip_tags($this->message);
            $cleanName = strip_tags($this->name);

            // Create the email
            $contactMail = new ContactMail($cleanName, $this->email, $cleanMessage);

            // Send to your business email
            $recipient = new Address('info@example.com', 'The Dog Kennel');
            Mail::to($recipient)->send($contactMail);

            // Optional: Send a confirmation email to the user
            // You could create an additional mail class for this
            // Mail::to($this->email)->send(new ContactConfirmationMail($cleanName));

            // Log the contact for record keeping
            Log::info('Contact form submitted', [
                'name' => $cleanName,
                'email' => $this->email,
                'message_length' => strlen($cleanMessage),
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            // Show success message
            session()->flash('success', 'Thank you for your message! We will get back to you within 24 hours. Woof! 🐕');

            // Reset form fields
            $this->reset(['name', 'email', 'message']);

        } catch (\Exception $e) {
            // Log the error
            Log::error('Contact form submission failed', [
                'error' => $e->getMessage(),
                'name' => $this->name,
                'email' => $this->email,
            ]);

            // Show error message to user
            session()->flash('error', 'Sorry, there was an issue sending your message. Please try again or call us directly at (123) 456-7890.');
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
