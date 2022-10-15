<?php

if (!function_exists('disk_type')) {

    function disk_type()
    {
        $appEnv = app()->environment();

        $envArray = ['staging', 'production'];

        $disk = 'public';

        if (in_array($appEnv, $envArray)) {
            $disk = 'public';
        }

        return $disk;
    }
}
