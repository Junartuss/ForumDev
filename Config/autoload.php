<?php
spl_autoload_register(function($class) {
    if (file_exists(ROOT_DIR . "/" . $class . '.php')) {
        require_once(ROOT_DIR  . "/" . $class . '.php');
    }
});
