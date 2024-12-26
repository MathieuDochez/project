<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

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
}
