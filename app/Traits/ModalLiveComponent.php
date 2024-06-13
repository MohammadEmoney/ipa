<?php

namespace App\Traits;


trait ModalLiveComponent
{
    /**
     * Dispatch show modal event
     */
    protected function showModal( string $name)
    {
        $this->dispatch('showModal', [
            'name' => $name,
        ]);
    }

     /**
     * Dispatch close modal event
     */
    protected function closeModal( string $name)
    {
        $this->dispatch('closeModal', [
            'name' => $name,
        ]);
    }
}
