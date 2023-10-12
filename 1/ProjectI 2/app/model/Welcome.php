<?php
class Welcome {
    public static function get_page_data($actions) {
        if(isset($_SESSION["loggedin"])) return [
            "template" => "welcome",
            "title" => "Welcome",
            "username" => strtoupper(Role::get_by_id($_SESSION["role"])->name),
            "events" => Table::generate(Attendeeevent::get_by_attendee($_SESSION["id"]), "Attendeeevent",  $actions),
            "sessions" => Table::generate(Attendeesession::get_by_attendee($_SESSION["id"]), "Attendeesession", $actions),
            "manager" => Table::generate(Managerevent::get_by_manager($_SESSION["id"]), "Managerevent", NULL),
        ]; else return [
            "template" => "welcome",
            "title" => "Welcome",
        ];
    }
}