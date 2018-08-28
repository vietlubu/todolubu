<?php

if (!function_exists('dd')) {
    /**
     * Debug helper function
     *
     * @param string $data data
     *
     * @return void
     */
    function dd($data = null)
    {
        var_dump($data);
        die;
    }
}

if (!function_exists('view')) {
    /**
     * View Helper function
     *
     * @param string $view   view path
     * @param array  $params list param
     *
     * @return void
     */
    function view($view, array $params = [])
    {
        $view = str_replace('.', '/', $view);
        ob_start();
        extract($params, EXTR_SKIP);
        require_once APP_PATH . "Views/{$view}.php";
        ob_end_flush();
    }
}

if (!function_exists('config')) {
    /**
     * Get config helper function
     *
     * @param string $key config key
     *
     * @return mix
     */
    function config($key)
    {
        return \App\Core\Config::get($key);
    }
}
