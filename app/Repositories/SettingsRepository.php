<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingsRepository
{
    public function get()
    {
        return Setting::firstOrCreate(['lang' => app()->getLocale()], ['data' => []]);
    }

    public function getLanguages()
    {
        return Setting::firstOrCreate(['lang' => 'all'], ['data' => []]);
    }

    public function getByKey(string $key)
    {
        $settings = $this->get();
        return $settings->data[$key] ?? null;
    }

    public function setByKey(string $key, $value)
    {
        $settings = $this->get();
        $settings->data[$key] = $value;
        $settings->save();
    }
}
