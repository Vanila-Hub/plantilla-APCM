<?php

spl_autoload_register(function ($class) {
    $prefix = 'Dwes\videoclub2_0\app';
    $base_dir = __DIR__ . '/app';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);

    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    //echo "Intentando cargar: $file<br>";

    if (file_exists($file)) {
        require $file;
    }
});
?>
