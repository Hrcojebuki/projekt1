<?php

/**
 * Represents the DAO and the POPO class. This class interacts with the DB and 
 * is also used in place of the POPO object to store data retrieved from the DB.
 */
class Managerevent {

    private $manager;
    private $event;

    public function get_id() { 
        return $this->manager; 
    }
    
    // db
    static function get_all() { 
        return DB::queryAll('SELECT * FROM manager_event', 'ManagerEvent'); 
    }
    static function get_all_by_event($event) { 
        return DB::queryAll('SELECT * FROM manager_event WHERE event = :event', 'ManagerEvent' ,['event' => $event]); 
    }
    static function get_by_manager($manager) { 
        return DB::queryAll('SELECT datestart, dateend, numberallowed, event.name AS event, venue.name AS venue, attendee.name AS name FROM manager_event JOIN event ON event=idevent JOIN venue ON venue=idvenue JOIN attendee ON manager=idattendee WHERE manager = :manager', 'Event', ['manager' => $manager]); 
    }
    static function delete_by_event($idevent) { 
        return DB::query('DELETE FROM manager_event WHERE event = :idevent', ['idevent' => $idevent]); 
    }

    static function insert($manager, $event) {
        try {
            $queryString = 
            'insert into manager_event (manager, event)
             values (:manager,:event)';
            return DB::query($queryString, [
                "manager" => $manager, 
                "event" => $event, 
            ]);
        } catch (PDOException $pdo) {
            header('Location: index.php?page=managerevent');
            exit();
        }
    }
}