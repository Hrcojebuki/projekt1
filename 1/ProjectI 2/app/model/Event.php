<?php

/**
 * Represents the DAO and the POPO class. This class interacts with the DB and 
 * is also used in place of the POPO object to store data retrieved from the DB.
 */
class Event {

    private $idevent;
    private $idvenue;
    public $name;
    public $venue;
    public $numberallowed;
    public $datestart;
    public $dateend;

    // accessors
    public function get_id() { 
        return $this->idevent; 
    }
    public function get_idvenue() { 
        return $this->idvenue; 
    }
    public function get_datestart() { 
        return explode(" ", $this->datestart); 
    }    
    public function get_dateend() { 
        return explode(" ", $this->dateend); 
    }  
    public static function get_all() { 
        return DB::queryAll('SELECT idevent, event.name AS name, datestart, dateend, concat(count(attendee_event.event), "/", numberallowed) AS numberallowed, venue.name AS venue, idvenue FROM event LEFT JOIN venue ON venue = idvenue LEFT JOIN attendee_event ON attendee_event.event = idevent GROUP BY idevent ORDER BY idevent ASC', 'Event'); 
    }
    public static function get_all_by_venue($venue) { 
        return DB::queryAll('SELECT * FROM event WHERE venue = :venue', 'Event' ,['venue' => $venue]); 
    }
    public static function get_by_id($idevent) { 
        return DB::queryOne('SELECT * FROM event WHERE idevent = :idevent', 'Event', ['idevent' => $idevent]); 
    }
    public static function delete_by_id($idevent) { 
        return DB::query('DELETE FROM event WHERE idevent = :idevent', ['idevent' => $idevent]); 
    }
    public static function get_last_id() {
        return DB::queryOne( "SELECT MAX( idevent ) AS lastid FROM event;", "Event")->lastid;
    }

    public static function insert($name, $venue, $numberallowed, $datestart, $dateend) {
        try {
            $queryString = 
            'insert into event (name, venue, numberallowed, datestart, dateend)
             values (:name,:venue,:numberallowed,:datestart,:dateend)';
            return DB::query($queryString, [
                "name" => $name, 
                "venue" => $venue, 
                "numberallowed" => $numberallowed, 
                "datestart" => $datestart, 
                "dateend" => $dateend 
            ]);
        } catch (PDOException $pdo) {
            header('Location: index.php?page=event');
            exit();
        }
    }
   
    public static function update($id, $name, $venue, $numberallowed, $datestart, $dateend) {
        try {
            $queryString = 
            'update event set name = :name, venue = :venue, numberallowed = :numberallowed, datestart = :datestart, dateend = :dateend
             where idevent = :id';
            return DB::query($queryString, [
                "name" => $name, 
                "venue" => $venue, 
                "numberallowed" => $numberallowed, 
                "datestart" => $datestart, 
                "dateend" => $dateend,
                "id" => $id,
            ]);
        } catch (PDOException $pdo) {
            header('Location: index.php?page=event');
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
        $venue = Filter::validate_and_sanitize(INPUT_POST, 'venue', NULL);

        self::insert($name, $venue, $numberallowed, $datestart." ".$timestart.":00", $dateend." ".$timeend.":00");

        $idmanager = $_SESSION["id"];
        $idevent = self::get_last_id();
        Managerevent::insert($idmanager, $idevent);
        
        header('Location: index.php?page=event');
        exit();
    }

    public static function edit($id) {
        $name = Filter::validate_and_sanitize(INPUT_POST, 'name', NULL);
        $datestart = Filter::validate_and_sanitize(INPUT_POST, 'datestart', NULL);
        $timestart = Filter::validate_and_sanitize(INPUT_POST, 'timestart', NULL);
        $dateend = Filter::validate_and_sanitize(INPUT_POST, 'dateend', NULL);
        $timeend = Filter::validate_and_sanitize(INPUT_POST, 'timeend', NULL);
        $numberallowed = Filter::validate_and_sanitize(INPUT_POST, 'capacity', NULL);
        $venue = Filter::validate_and_sanitize(INPUT_POST, 'venue', NULL);

        self::update($id, $name, $venue, $numberallowed, $datestart." ".$timestart."", $dateend." ".$timeend."");

        header('Location: index.php?page=event');
        exit();
    }
    
    public static function remove($id) {
        self::delete_by_id($id);
        Managerevent::delete_by_event($id);
        header('Location: index.php?page=event');
        exit();
    }

    public static function get_page_data($actions) {
        return [
            "template" => "manage",
            "title" => "Events",
            "form" => "app/view/forms/event.php",
            "table" => Table::generate(self::get_all(), "event", $actions),
            "all_venues" => Venue::get_all(),
        ];
    }
}
