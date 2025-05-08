<?php

if (! function_exists('module_path_v2')) {
    function module_path_v2(string $moduleName, string $path = ''): string
    {
        return app_path("Modules/{$moduleName}").($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}
