<?php

return (static function () {
    $illuminate = collect(['Cache', 'Filesystem', 'View']);
    $app = collect(['App', 'AppSettings', 'Blaze', 'Database', 'Mail', 'View', 'Route', 'Logging', 'Observer']);

    return $illuminate->map(fn ($service) => "Illuminate\\{$service}\\{$service}ServiceProvider")->concat($app->map(fn ($service) => "App\\Providers\\{$service}ServiceProvider"))->toArray();
})();
