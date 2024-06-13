<?php

namespace App\Livewire\Admin\Settings;

use App\Generators\CustomUrlGenerator;
use App\Models\DefaultLanguage;
use App\Traits\AlertLiveComponent;
use Livewire\Component;

class LiveDefaultLanguage extends Component
{
    use AlertLiveComponent;

    public function setDefaultLang($lang, $currentRoute)
    {
        DefaultLanguage::updateOrCreate(['id' => 1],['lang' => $lang]);
        $this->alert(__('messages.updated_successfully'));
        return redirect()->to(CustomUrlGenerator::localeRoute($lang, $currentRoute));
    }

    public function render()
    {
        return view('livewire.admin.settings.live-default-language');
    }
}
