<?php

/**
 * Auto-load class files from multiple directories using the SPL_AUTOLOAD_REGISTER method
 * Source: https://www.php.net/manual/en/function.spl-autoload-register.php
 * 
 * Note: Class names in PHP are case insensitive. Following two classes are equivalent:
 *     class MyClass{} AND class myclass{}
 * 
 * If you are using an autoloader that searches for a class file when the class 
 * is required, the autoloader will match the file based on the filesystem’s 
 * case-sensitivity. 
 *      - Windows is case insensitive
 *      - Mac  is case-aware but not case sensitive. 
 *      - Linux is case sensitive, and Solace is Linux
 * 
 * Hence, FOR SOLACE, we will need to 
 *      - rename all php files to lowercase OR
 *      - use the ucfirst() in the autoloader on class names as below (make sure the class name consists of one word only)
 */
class Autoloader {

    public static function register() {
        spl_autoload_register(function ($class_name) {
            // Define an array of directories in the order of their priority to iterate through.
            $dirs = array(
                'app/permissions/',
                'app/controller/',
                'app/filter/',
                'app/model/',
                'app/view/',
                'app/db/',
            );

            // Loop through each directory to load all the class files. It will only require a file once.
            // If it finds the same class in a directory later on, IT WILL IGNORE IT! Because of that require once!
            foreach ($dirs as $dir) {
                // Since linux-based systems are case sensitive we need to make uppercase the first letter of the class_name with ucfirst()
                if (file_exists($dir . ucfirst($class_name) . '.php')) {
                    require_once($dir . ucfirst($class_name) . '.php');
                    return true;
                }
            }
            return false;
        });
    }

}

Autoloader::register();