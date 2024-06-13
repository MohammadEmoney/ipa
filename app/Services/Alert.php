<?php

namespace App\Services;

use App\Enums\EnumAlertConfirmClass;
use App\Enums\EnumAlertType;
use Livewire\Component;

class Alert
{
    private $dispatchBrowserEvent;
    private $type;
    private $message;
    private $title;
    private $autoClose;
    private $confirmText;
    private $confirmClass;
    private $reload;
    private $redirect;
    private $autoCloseTimer;

    public function __construct($dispatchBrowserEvent, string $message, string $title)
    {
        $this->dispatchBrowserEvent = $dispatchBrowserEvent;
        $this->type = EnumAlertType::Info;
        $this->message = $message;
        $this->title = $title;
        $this->autoClose = false;
        $this->confirmText = __('global.confirmed');
        $this->confirmClass = EnumAlertConfirmClass::Info;
        $this->reload = false;
        $this->redirect = '';
        $this->autoCloseTimer = 1500;
    }

    public function __destruct()
    {
        $this->dispatchBrowserEvent->dispatch('alert', [
            'type' => $this->type,
            'title' => $this->title,
            'message' => $this->message,
            'autoClose' => $this->autoClose,
            'confirmText' => $this->confirmText,
            'confirmClass' => $this->confirmClass,
            'reload' => $this->reload,
            'redirect' => $this->redirect,
            'autoCloseTimer' => $this->autoCloseTimer,
        ]);
    }

    // Begin alert Type
    public function success()
    {
        $this->type = EnumAlertType::Success;
        $this->confirmClass = EnumAlertConfirmClass::Success;
        return $this;
    }

    public function warning()
    {
        $this->type = EnumAlertType::Warning;
        $this->confirmClass = EnumAlertConfirmClass::Warning;
        return $this;
    }

    public function error()
    {
        $this->type = EnumAlertType::Error;
        $this->confirmClass = EnumAlertConfirmClass::Error;
        return $this;
    }

    public function info()
    {
        $this->type = EnumAlertType::Info;
        $this->confirmClass = EnumAlertConfirmClass::Info;
        return $this;
    }

    // End alert Type

    public function autoClose($value = true, $timer = 1500)
    {
        $this->autoClose = $value;
        $this->autoCloseTimer = $timer;
        return $this;
    }

    public function confirmText($value)
    {
        $this->confirmText = $value;
        return $this;
    }

    public function reload()
    {
        $this->reload = true;
        return $this;
    }


    public function redirect($value,$param=[])
    {
        $this->redirect = route($value,$param);
        return $this;
    }
}
