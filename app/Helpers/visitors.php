<?php

if (! function_exists('visits')) {
    /**
     * set visitor by visitor type and model data
     */
    function visits(string|App\Models\Visitor $type, object $model): App\Services\VisitorService
    {
        return new App\Services\VisitorService($type, $model);
    }
}
