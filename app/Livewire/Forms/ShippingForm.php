<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use App\Helpers\Cart;
use App\Mail\OrderConfirmation;
use App\Models\User;
use Livewire\Form;
use Mail;

class ShippingForm extends Form
{
    #[Validate('required')]
    public $address = null;
    #[Validate('required')]
    public $city = null;
    #[Validate('required|numeric')]
    public $zip = null;
    #[Validate('required')]
    public $country = null;
    public $notes = null;

    public function sendEmail($backorder){
        $message = '<p>Thank you for your order.<br> Your purchases will be delivered as soon as possible.</p>';
        $message .= '<ul>';
        foreach (Cart::getItems() as $item) {
            $message .= "<li>{$item['qty']} x {$item['name']} - {$item['description']}</li>";
        }
        $message .= '</ul>';
        $message .= "<p>Total price: &euro; " . Cart::getTotalPrice() . "</p>";
        $message .= '<p><b>Shipping address:</b><br>';
        $message .= $this->address . '<br>';
        $message .= $this->zip . ' ' . $this->city . '<br>';
        $message .= $this->country . '</p>';
        $message .= '<p><b>Notes:</b><br>';
        $message .= $this->notes . '</p>';
        if (count($backorder) > 0) {
            $message .= '<p><b>Backorder:</b></p>';
            $message .= '<ul>';
            foreach ($backorder as $item) {
                $message .= "<li>{$item}</li>";
            }
            $message .= '</ul>';
        }

        $template = new OrderConfirmation([
            'message' => $message,
        ]);

        // Send email ONLY to the customer (removed admin CC)
        Mail::to(auth()->user())->send($template);
    }
}
