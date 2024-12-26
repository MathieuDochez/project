<?php

namespace App\Traits;

use Livewire\WithPagination;

trait SweetAlertTrait
{
    /**
     * @param string $text
     * @param string $background ('success', 'danger', 'error', 'warning', 'primary' 'info')
     * @param array $options (see link below for all options)
     * @see https://sweetalert2.github.io/#configuration
     * @return void
     */
    public function swalToast(string $text = '', string $background = 'success', array $options = []): void
    {
        $defaults = [
            'text' => $text,
            'background' => $background,
        ];

        $options = array_merge($defaults, $options);
        $this->dispatch('swal:toast', $options);
    }

    /**
     * Display a confirmation dialog with SweetAlert.
     *
     * @param string $title The title of the dialog.
     * @param string $text The text of the dialog.
     * @param string $background ('success', 'danger', 'error', 'warning', 'primary' 'info')
     * @param string|null $nextEvent The event to fire when the user confirms.
     * @param int $id The id to pass to the event.
     * @param array $options (see link below for all options)
     * @see https://sweetalert2.github.io/#configuration
     *
     * @return void
     */
    public function swalConfirm(string $title = '', string $text = '', string $background = 'white', string|null $nextEvent = null, int $id = 0, array $options = []): void
    {
        $defaults = [
            'title' => $title,
            'text' => $text,
            'background' => $background,
            'next' => [
                'event' => $nextEvent,
                'params' => ['id' => $id],
            ],
        ];

        $options = array_merge($defaults, $options);
        $this->dispatch('swal:confirm', $options);
    }
}
