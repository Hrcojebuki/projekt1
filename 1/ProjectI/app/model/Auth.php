<?php

class Auth {
    public static function signin() {
        $button = Filter::validate_and_sanitize(INPUT_POST, 'button', NULL);
        $username = Filter::validate_and_sanitize(INPUT_POST, 'username', '/[^a-z0-9]/i');
        $password = Filter::validate_and_sanitize(INPUT_POST, 'password', '/[^a-z0-9]/i');
        
        if(in_array(NULL, [$username, $password])) {
            $_SESSION["auth_error"] = "Bad credentials.";
            header("Location: index.php?page=auth");
            exit();
        }

        $user = NULL;

        switch($button) {
            case "signin": 
                $user = Attendee::authenticate($username, $password);
                if(!$user){
                    if($username == "admin" && $password == "admin") {
                        Attendee::insert($username, $password, Permissions::$ADMIN);
                        $user = Attendee::authenticate($username, $password);
                    } else {
                        $_SESSION["auth_error"] = "User failed to authenticate.";
                        header("Location: index.php?page=auth");
                        exit();
                    }
                }
                break;
            case "register":
                $user = Attendee::get_by_username($username);
                if($user) {
                    $_SESSION["auth_error"] = "This username already exists.";
                    header("Location: index.php?page=auth");
                    exit();
                } else {
                    Attendee::insert($username, $password, Permissions::$ATTENDEE);
                    $user = Attendee::authenticate($username, $password);
                }
                break;
        }

        $_SESSION["id"] = $user->get_id();
        $_SESSION["name"] = $user->name;
        $_SESSION["role"] = $user->role;
        $_SESSION["loggedin"] = true;
        
        header("Location: index.php?page=welcome");
        exit();
    }

    public static function logout() {
        self::destroy_session();
        $_SESSION["auth_error"] = "User has been logged out.";
    }

    public static function destroy_session() {
        session_unset();    // remove all session variables from the $_SESSION(the session file still exists)
        session_destroy();  // destroy the session with the file

        // delete the session cookie, if a cookie is used to propagate the session id
        if (ini_get('session.use_cookies')) {
            $cookieInfo = session_get_cookie_params();
            setcookie(session_name(), '', time() - 1, $cookieInfo['path'], $cookieInfo['domain']);
        }
    }

    public static function get_page_data($actions) {
        return [
            "template" => "auth"
        ];
    }
}