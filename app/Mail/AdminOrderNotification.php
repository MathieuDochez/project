<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminOrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $customer;
    public $orderItems;
    public $shippingDetails;
    public $backorderItems;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, array $orderItems, array $shippingDetails = [], array $backorderItems = [])
    {
        $this->order = $order;
        $this->customer = $order->user;
        $this->orderItems = $orderItems;
        $this->shippingDetails = $shippingDetails;
        $this->backorderItems = $backorderItems;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Order Received - Order #' . $this->order->id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'emails.admin-order-notification',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
