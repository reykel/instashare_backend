<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait HasToManageSettings {

    public function setSettingValue($_key, $_value) { 
        config([$_key => $_value]);
    }

    public function getSettingValue($_key) { 
        return config($_key);
    }
}