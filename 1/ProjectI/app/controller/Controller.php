<?php
/**
 * Common Controller class that loads Model & View.
 * In this scenario, the controller also serves as a router: a query parameter 
 * 'page' is used to identify the view that will be rendered and returned back 
 * to the client. This controller handles all the requests, we have one controller 
 * for all pages. In another scenario, we might have several controllers, 
 * and one FrontController that will serve as a router.
 * 
 *  The default page is login.php. Other pages will be returned in response to the 
 *  query parameter 'page'. For example: http://localhost:8000/.../?page=lorem
 */
class Controller {

    public function __construct() {
        DB::connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    public function handle_request() {
        $page = Filter::validate_and_sanitize(INPUT_GET, 'page', NULL);
        $method = Filter::validate_and_sanitize(INPUT_GET, 'method', NULL);
        $param = Filter::validate_and_sanitize(INPUT_GET, 'param', NULL);

        $pages_access = ["welcome", "auth"];
        $db_access = ["signin"];
        $data = NULL;
        $view = NULL;

        if(isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin'])){
            $pages_access = Permissions::get_pages_access($_SESSION['role']);
            $db_access = Permissions::get_db_access($_SESSION['role']);
        }

        if(!in_array($page, $pages_access)){
            return self::handle_page_with_method("404", NULL, NULL, $db_access);
        }

        if (!$method && method_exists($page, "get_all")) {
            return self::handle_page_with_method($page, NULL, NULL, $db_access);
        }

        if(in_array($method, $db_access)||$page=="welcome"){
            return self::handle_page_with_method($page, $method, $param, $db_access);
        } else {
            return self::handle_page_with_method($page, NULL, NULL, $db_access);
        }
    }

    public static function handle_page_with_method($page, $method, $param, $db_access) {
        $role = isset($_SESSION["role"]) ? $_SESSION["role"] : "";
        $actions = Permissions::get_button_access($role);
        
        if(method_exists($page, $method)) {
            $data = $page::$method($param);
        } else {
            if(class_exists($page)) {
                $data = $page::get_page_data($actions);
            } else {
                $data["template"] = "404";
            }
            $page = $data["template"];
        }
        
        $view = new View('app/view/template/' . $page . '.php');
        $data["show_create"] = in_array("create", $db_access);
        return $view->render($data);
    }
}