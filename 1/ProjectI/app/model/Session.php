<?php

/**
 * Represents the DAO and the POPO class. This class interacts with the DB and 
 * is also used in place of the POPO object to store data retrieved from the DB.
 */
class Session {

    private $idsession;
    public $name;
    public $event;
    public $numberallowed;
    public $startdate;
    public $enddate;

    // accessors
    public function get_id() { 
        return $this->idsession; 
    }
    public function get_startdate() { 
        return explode(" ", $this->startdate); 
    }    
    public function get_enddate() { 
        return explode(" ", $this->enddate); 
    }  

    // db
    public static function get_all() { 
        return DB::queryAll('SELECT idsession, enddate, startdate, session.name, concat(count(attendee_session.session), "/", session.numberallowed) AS numberallowed, session.event, event.name AS event FROM session LEFT JOIN event ON session.event = event.idevent LEFT JOIN attendee_session ON attendee_session.session = idsession GROUP BY idsession ORDER BY idsession ASC', 'Session'); 
    }
    public static function get_all_by_event($event) { 
        return DB::queryAll('SELECT * FROM session WHERE event = :event', 'Session' ,['event' => $event]); 
    }
    public static function get_by_id($idsession) { 
        return DB::queryOne('SELECT * FROM session WHERE idsession = :idsession', 'Session', ['idsession' => $idsession]); 
    }
    public static function delete_by_id($idsession) {
        return DB::query('DELETE FROM session WHERE idsession = :idsession', ['idsession' => $idsession]);
    }
    public static function get_last_id() {
        return DB::queryOne( "SELECT MAX( idsession ) AS lastid FROM session;", "Session")->lastid;
    }

    static function insert($name, $event, $numberallowed, $startdate, $enddate) {
        try {
            $queryString = 
            'insert into session (name, event, numberallowed, startdate, enddate)
             values (:name,:event,:numberallowed,:startdate,:enddate)';
    
            return DB::query($queryString, [
                "name" => $name, 
                "event" => $event, 
                "numberallowed" => $numberallowed, 
                "startdate" => $startdate, 
                "enddate" => $enddate 
            ]);
            
        } catch (PDOException $pdo) {
            header('Location: index.php?page=session');
            exit();
        }
    }

    public static function update($id, $name, $event, $numberallowed, $startdate, $enddate) {
        try {
            $queryString = 
            'update session set name = :name, event = :event, numberallowed = :numberallowed, startdate = :startdate, enddate = :enddate
             where idsession = :id';

            return DB::query($queryString, [
                "name" => $name, 
                "event" => $event, 
                "numberallowed" => $numberallowed, 
                "startdate" => $startdate,
                "enddate" => $enddate,
                "id" => $id,
            ]);
        } catch (PDOException $pdo) {
            header('Location: index.php?page=session');
            exit();
        }
    }
    
    // exposed static methods
    public static function create() {
        $name = Filter::validate_and_sanitize(INPUT_POST, 'name', NULL);
        $datestart = Filter::validate_and_sanitize(INPUT_POST, 'datestart', NULL);
        $timestart = Filter::validate_and_sanitize(INPUT_POST, 'timestart', NULL);
        $dateend = Filter::validate_and_sanitize(INPUT_POST, 'dateend', NULL);
        $timeend = Filter::validate_and_sanitize(INPUT_POST, 'timeend', NULL);
        $numberallowed = Filter::validate_and_sanitize(INPUT_POST, 'capacity', NULL);
        $event = Filter::validate_and_sanitize(INPUT_POST, 'event', NULL);
        
        self::insert($name, $event, $numberallowed, $datestart." ".$timestart.":00", $dateend." ".$timeend.":00");

        $attendee = $_SESSION["id"];
        $session = self::get_last_id();
        Attendeesession::insert($attendee, $session);

        header('Location: index.php?page=session');
        exit();
    }

    public static function edit($id) {
        $name = Filter::validate_and_sanitize(INPUT_POST, 'name', NULL);
        $datestart = Filter::validate_and_sanitize(INPUT_POST, 'datestart', NULL);
        $timestart = Filter::validate_and_sanitize(INPUT_POST, 'timestart', NULL);
        $dateend = Filter::validate_and_sanitize(INPUT_POST, 'dateend', NULL);
        $timeend = Filter::validate_and_sanitize(INPUT_POST, 'timeend', NULL);
        $numberallowed = Filter::validate_and_sanitize(INPUT_POST, 'capacity', NULL);
        $event = Filter::validate_and_sanitize(INPUT_POST, 'event', NULL);
        self::update($id, $name, $event, $numberallowed, $datestart." ".$timestart, $dateend." ".$timeend);
        header('Location: index.php?page=session');
        exit();
    }
    
    public static function remove($id) {
        Attendeesession::delete_by_session($id);
        self::delete_by_id($id);
        header('Location: index.php?page=session');
        exit();
    }

    public static function get_page_data($actions) {
        return [
            "template" => "manage",
            "title" => "Sessions",
            "form" => "app/view/forms/session.php",
            "table" => Table::generate(self::get_all(), "session", $actions),
            "all_events" => Event::get_all(),
        ];
    }
}