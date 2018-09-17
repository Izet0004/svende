<?php
// Autoload classes
spl_autoload_register(function ($class) {
    include COREPATH . '/classes/' . strtolower($class). '.php';
});
?>