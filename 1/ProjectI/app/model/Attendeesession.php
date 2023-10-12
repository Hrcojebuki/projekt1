<?php

/**
 * Represents the DAO and the POPO class. This class interacts with the DB and 
 * is also used in place of the POPO object to store data retrieved from the DB.
 */
class Attendeesession {

    public $attendee;
    public $session;

    public function get_id() { return $this->attendee; }

    // db
    static function get_all() { 
        return DB::queryAll('SELECT * FROM attendee_session', 'AttendeeSession'); 
    }
    static function get_all_by_session($session) { 
        return DB::queryAll('SELECT * FROM attendee_session WHERE session = :session', 'AttendeeSession' ,['session' => $session]); 
    }
    static function get_by_attendee($attendee) { 
        return DB::queryAll('SELECT idsession, enddate, startdate, session.numberallowed, session.name AS name, event.name AS event FROM session LEFT JOIN attendee_session ON session.idsession = attendee_session.session LEFT JOIN event ON event.idevent = session.event  WHERE attendee = :attendee', 'Session', ['attendee' => $attendee]); 
    }
    static function delete_by_session($session) { 
        return DB::query('DELETE FROM attendee_session WHERE session = :session', ['session' => $session]); 
    }
    static function delete_by_attendee_and_session($attendee, $session) { 
        return DB::query('DELETE FROM attendee_session WHERE session = :session AND attendee = :attendee', ['session' => $session, 'attendee' => $attendee]); 
    }
    static function get_by_attendee_and_session($attendee, $session) { 
        return DB::query('SELECT * FROM attendee_session WHERE session = :session AND attendee = :attendee', ['session' => $session, 'attendee' => $attendee]); 
    }

    static function insert($attendee, $session) {
        try {
            $queryString = 
            'insert into attendee_session (attendee, session)
             values (:attendee,:session)';
    
            return DB::query($queryString, [
                "attendee" => $attendee, 
                "session" => $session, 
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
        $session = $array[1];
        self::delete_by_attendee_and_session($attendee, $session);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}