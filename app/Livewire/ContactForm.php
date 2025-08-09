<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|string|min:2|max:100',
        'email' => 'required|email|max:255',
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

            // Get all admins (exact same pattern as your checkout)
            $admins = User::where('admin', true)->select('name', 'email')->get();

            // Check if we have any admins
            if ($admins->isEmpty()) {
                // Fallback to a default email if no admins exist
                Mail::to('test1@example.com')->send($contactMail);
            } else {
                // Send to admins (exactly like your checkout pattern)
                Mail::to($admins->first())
                    ->cc($admins->skip(1))
                    ->send($contactMail);
            }

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
