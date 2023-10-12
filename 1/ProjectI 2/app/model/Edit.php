<?php 
class Edit {
    public static function show($param) {
        $arr = explode(",", $param);
        $id = $model = NULL;
        if(sizeof($arr)>1){
            $model = $arr[0];
            $id = $arr[1];
        } else if (sizeof($arr)>0) {
            $model = $arr[0];
        } else {
            header("Location: index.php?page=welcome");
            exit();
        }
        $model_data = $model::get_by_id($id);
        return [
            "path" => "app/view/forms/".$model.".php",
            "model_data" => $model_data,
            "all_roles" => Role::get_all(),
            "all_sessions" => Session::get_all(),
            "all_venues" => Venue::get_all(),
            "all_events" => Event::get_all(),
        ];
    }
}