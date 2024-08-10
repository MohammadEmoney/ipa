<?php

namespace App\Livewire\Admin\Settings;

use App\Enums\EnumLanguages;
use App\Enums\EnumPaymentMethods;
use App\Enums\EnumPaymentMode;
use App\Models\Setting;
use App\Repositories\SettingsRepository;
use App\Traits\AlertLiveComponent;
use App\Traits\MediaTrait;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveSettings extends Component
{
    use WithFileUploads, MediaTrait, AlertLiveComponent;

    public string $title;
    public $data = [];
    public $step;
    public $setting;

    public function mount()
    {
        $this->step = 'public';
        $this->title = __('global.settings');
        $this->load();
    }

    public function rules()
    {
        return [
            'card_number' => 'nullable|regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/',
        ];
    }

    public function setTab($select)
    {
        $this->step = $select;
    }

    public function load()
    {
        $settings = new SettingsRepository();
        $this->setting = $settings->get();
        $this->data = $this->setting->data;
        $this->data['lang'] = app()->getLocale();
        $this->data['logo'] = $this->setting->getFirstMedia('logo');
        $this->data['favicon'] = $this->setting->getFirstMedia('favicon');
        $this->data['login'] = $this->setting->getFirstMedia('login');
        $this->data['register'] = $this->setting->getFirstMedia('register');
    }

    public function updated($field,$values)
    {
        if($field=='data.gateway'){
            if(!in_array('zarinpal',$values)){
                unset($this->data['zarinpal_mode']);
                unset($this->data['zarinpal_currency']);
                unset($this->data['zarinpal_merchantId']);
                unset($this->data['zarinpal_description']);
            }
            if(!in_array('behpardakht',$values)){
                unset($this->data['behpardakht_currency']);
                unset($this->data['behpardakht_terminalId']);
                unset($this->data['behpardakht_username']);
                unset($this->data['behpardakht_password']);
                unset($this->data['behpardakht_description']);
            }
            if(!in_array('saman',$values)){
                unset($this->data['saman_currency']);
                unset($this->data['saman_merchantId']);
                unset($this->data['saman_description']);
            }
            if(!in_array('parsian',$values)){
                unset($this->data['parsian_currency']);
                unset($this->data['parsian_merchantId']);
                unset($this->data['parsian_description']);
            }
        }
    }
    public function submit()
    {
        $setting = $this->setting;
        $this->createImage($setting, 'logo');
        $this->createImage($setting, 'favicon');
        $this->createImage($setting, 'login');
        $this->createImage($setting, 'register');
        $setting->update([
            'data' => $this->data
        ]);

        $this->alert(__('messages.settings_updated'))->success()->autoClose();
        return redirect()->to(route('admin.settings.general'));
    }
    
    public function render()
    {
        $langs = EnumLanguages::getTranslatedAll();
        $zarinpalModes = EnumPaymentMode::getTranslatedAll();
        $paymentMethods = EnumPaymentMethods::getTranslatedAll();
        return view('livewire.admin.settings.live-settings', compact('langs', 'zarinpalModes', 'paymentMethods'))->extends('layouts.admin-panel')->section('content');
    }
}
