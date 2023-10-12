<?php

/**
 * Represents the DAO and the POPO class. This class interacts with the DB and 
 * is also used in place of the POPO object to store data retrieved from the DB.
 */
class Attendeeevent {

    public $paid;
    public $attendee;
    public $event;

    public function get_id() { return $this->attendee; }

    // db
    static function get_all() { 
        return DB::queryAll('SELECT * FROM attendee_event', 'AttendeeEvent'); 
    }
    static function get_all_by_event($event) { 
        return DB::queryAll('SELECT * FROM attendee_event WHERE event = :event', 'AttendeeEvent' ,['event' => $event]); 
    }
    static function get_by_attendee($attendee) { 
        return DB::queryAll('SELECT event.name, idevent, dateend, numberallowed, datestart, venue.name AS venue FROM event LEFT JOIN attendee_event ON event.idevent = attendee_event.event LEFT JOIN venue ON event.venue = venue.idvenue WHERE attendee = :attendee', 'Event', ['attendee' => $attendee]); 
    }
    static function delete_by_event($event) { 
        return DB::query('DELETE FROM attendee_event WHERE event = :event', ['event' => $event]); 
    }
    static function delete_by_attendee_and_event($attendee, $event) { 
        return DB::query('DELETE FROM attendee_event WHERE event = :event AND attendee = :attendee', ['event' => $event, 'attendee' => $attendee]); 
    }
    static function get_by_attendee_and_event($attendee, $event) { 
        return DB::query('SELECT * FROM attendee_event WHERE event = :event AND attendee = :attendee', ['event' => $event, 'attendee' => $attendee]); 
    }

    static function insert($attendee, $event, $paid) {
        try {
            $queryString = 
            'insert into attendee_event (attendee, event, paid)
             values (:attendee,:event,:paid)';
    
            return DB::query($queryString, [
                "attendee" => $attendee, 
                "event" => $event, 
                "paid" => $paid, 
            ]);
        } catch (PDOException $pdo) {
            header('Location: index.php?page=event');
            exit();
        }
    }

    static function apply($id) {
        self::insert($_SESSION["id"], $id, 1);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    static function cancel($params) {
        $array = explode(",", $params);
        $attendee = $array[0];
        $event = $array[1];
        self::delete_by_attendee_and_event($attendee, $event);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}