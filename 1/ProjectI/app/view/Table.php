<?php

// This file is not consistent with MVC and I realise that, but I already refactored it
// like 10 times and I dont have more patience 

class Table {
    public static function generate($data, $model, $actions, $title = "") {
        if (!$data || !is_array($data) || sizeof($data)==0) return "";
        $first_row = $data[0];
        $html  = "<div class='p-4 my-4 bg-light rounded-3'>";
        $html .= "    <div class='card-body'>";
        $html .= "        <h1>".ucfirst($title)."</h1>";
        $html .= "        <table class='table table-striped mt-4'>";
        $html .= "            <thead>";
        $html .= "                <tr>";
        foreach(get_object_vars($first_row) as $name=>$value) {
            $html .= "                <th scope='col'>".ucfirst($name)."</th>";
        }
        if ($actions) $html .= "      <th scope='col'>"."Actions"."</th>";
        $html .= "               </tr>";
        $html .= "            </thead>";
        $html .= "            <tbody>";
        foreach ($data as $row) {
            $html .= "            <tr>";
            foreach(get_object_vars($row) as $name=>$value) {
                if(strpos($name, "ate")>0) {
                    $value = date('jS \of F h:i a', strtotime($value));
                }
                $html .= "      <td>".$value."</td>";
            }
            $html .= "                <td>";
            $html .= "                    <div class='d-flex btn-group w-100' role='group' aria-label='Basic example'>";
            if($actions) foreach($actions as $action) {
                $model = strpos($model, "event") !== false ? "event" : $model;
                $model = strpos($model, "session") !== false ? "session" : $model;
                
                $show = true;
                switch($model) {
                    case "event":
                    case "attendeeevent":
                        $sessions = Session::get_all_by_event($row->get_id());
                        $show = sizeof($sessions) == 0;
                        break;
                    case "venue":
                        $venues = Event::get_all_by_venue($row->get_id());
                        $show = sizeof($venues) == 0;
                        break;
                    case "role":
                        $roles = Attendee::get_all_by_role($row->get_id());
                        $show = sizeof($roles) == 0;
                        break;              
                }
                switch($action){
                    case "apply":
                        $id = $_SESSION["id"];
                        if($model == "event" || $model == "session")
                        if(Attendeeevent::get_by_attendee_and_event($_SESSION["id"], $row->get_id()) || Attendeesession::get_by_attendee_and_session($_SESSION["id"], $row->get_id())){
                            $html .= Button::create("attendee".$model, 'cancel', $id, $row->get_id());
                        } else {
                            $html .= Button::create("attendee".$model, 'apply', $row->get_id());
                        }
                    break;
                    case "remove":
                        if($show){
                            $html .= Button::create($model, 'remove', $row->get_id());
                        }else{
                            $html .= Button::create(NULL, 'remove', $row->get_id());
                        }
                    break;
                    case "edit":
                        $html .= Button::create("edit", 'show', $model, $row->get_id());
                    break;
                }
            }
            $html .= "                     </div>";
            $html .= "                 </td>";
            $html .= "            </tr>";
        }
        $html .= "            </tbody>";
        $html .= "         </table>";
        $html .= "     </div>";
        $html .= " </div>";
        return $html;
    }
}