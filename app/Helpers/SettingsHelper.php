<?php 
    function settings($key = null, $default = null) {
        if ($key === null) {
            return app(App\Settings::class);
        }
        
        return app(App\Settings::class)->get($key, $default);
    }

    function loadSettings($key) 
    {
        return settings()->has($key) ? settings()->get($key) : null;
    }
?>