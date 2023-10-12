<?php

/**
 * Class to sanitize and validate the input.
 */
class Filter {
    //TODO: Implement what is needed to validate and sanitize the values.
    static function validate_and_sanitize($method, $index, $regex) {
        $data = filter_has_var($method, $index) ? filter_input($method, $index, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : NULL;
        if($regex === NULL) {
            return $data;
        } else {
            return preg_match($regex, $data) === 0 ? $data : NULL;
        }
    }
}