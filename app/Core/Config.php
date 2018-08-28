<?php

namespace App\Core;

class Config
{
    /**
     * Get config by key
     *
     * @param String $key config key
     *
     * @return Mix
     */
    public static function get($key)
    {
        $pathInfo = explode('.', $key);
        if (empty($pathInfo)) {
            return null;
        }

        $configFile = sprintf("%sConfig/%s.php", APP_PATH, $pathInfo[0]);

        $config = require($configFile);

        $countPath = count($pathInfo);
        if ($countPath >= 2) {
            for ($i=1; $i < $countPath; $i++) {
                $config = $config[$pathInfo[$i]];
            }
            return $config;
        }

        return $config;
    }
}
