<?php
class Permissions {
    public static $ADMIN = 1;
    public static $MANAGER = 2;
    public static $ATTENDEE = 3;
    
    public static function get_pages_access($idrole) {
        switch ($idrole) {
            case self::$ADMIN:
                return ["welcome", "event", "attendeeevent", "attendeesession", "edit", "session", "venue", "attendee", "role", "auth", "404"];
            break;
            case self::$MANAGER:
                return ["welcome", "event", "attendeeevent", "attendeesession", "edit", "session", "venue", "404", "auth" ];
            break;
            default:
            case self::$ATTENDEE:
                return ["welcome", "event", "attendeeevent", "attendeesession", "session", "404", "auth"];
            break;
        }
    }

    public static function get_pages_show($idrole) {
        switch ($idrole) {
            case self::$ADMIN:
                return ["welcome", "event", "session", "venue", "attendee", "role"];
            break;
            case self::$MANAGER:
                return ["welcome", "event", "session", "venue"];
            break;
            default:
            case self::$ATTENDEE:
                return ["welcome", "event", "session"];
            break;
        }
    }

    public static function get_db_access($idrole) {
        switch ($idrole) {
            case self::$ADMIN:
                return ["logout", "create", "show", "fetch", "apply", "cancel", "remove", "edit"];
            break;
            case self::$MANAGER:
                return ["logout", "create", "show", "fetch",  "apply", "cancel", "remove", "edit"];
            break;
            default:
            case self::$ATTENDEE:
                return ["logout", "fetch", "apply", "cancel"];
            break;
        }
    }

    public static function get_button_access($idrole) {
        switch ($idrole) {
            case self::$ADMIN:
                return ["apply", "remove", "edit"];
            break;
            case self::$MANAGER:
                return ["remove", "edit"];
            break;
            default:
            case self::$ATTENDEE:
                return ["apply"];
            break;
        }
    }
}