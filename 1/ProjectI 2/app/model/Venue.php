<?php

/**
 * Represents the DAO and the POPO class. This class interacts with the DB and 
 * is also used in place of the POPO object to store data retrieved from the DB.
 */
class Venue {

    private $idvenue;
    public $name;
    public $capacity;

    // accessors
    public function get_id() { 
        return $this->idvenue; 
    }

    // db
    static function get_all() { 
        return DB::queryAll('SELECT * FROM venue ORDER BY idvenue ASC', 'Venue'); 
    }
    static function get_all_by_event($event) { 
        return DB::queryAll('SELECT * FROM venue WHERE event = :event', 'Venue' ,['event' => $event]); 
    }
    static function get_by_id($idvenue) { 
        return DB::queryOne('SELECT * FROM venue WHERE idvenue = :idvenue', 'Venue', ['idvenue' => $idvenue]); 
    }
    static function delete_by_id($idvenue) { 
        return DB::query('DELETE FROM venue WHERE idvenue = :idvenue', ['idvenue' => $idvenue]); 
    }

    static function insert($name, $capacity) {
        try {
            $queryString = 
            'insert into venue (name, capacity)
             values (:name,:capacity)';
    
            return DB::query($queryString, [
                "name" => $name, 
                "capacity" => $capacity, 
            ]);
        } catch (PDOException $pdo) {
            header('Location: index.php?page=venue');
            exit();
        }
    }

    public static function update($id, $name, $capacity) {
        try {
            $queryString = 
            'update venue set name = :name, capacity = :capacity
             where idvenue = :id';

            return DB::query($queryString, [
                "name" => $name, 
                "capacity" => $capacity, 
                "id" => $id,
            ]);
        } catch (PDOException $pdo) {
            header('Location: index.php?page=venue');
            exit();
        }
    }

    // exposed static methods
    public static function create() {
        $name = Filter::validate_and_sanitize(INPUT_POST, 'name', NULL);
        $capacity = Filter::validate_and_sanitize(INPUT_POST, 'capacity', NULL);
        self::insert($name, $capacity);
        header('Location: index.php?page=venue');
        exit();
    }
    
    public static function edit($id) {
        $name = Filter::validate_and_sanitize(INPUT_POST, 'name', NULL);
        $capacity = Filter::validate_and_sanitize(INPUT_POST, 'capacity', NULL);
        self::update($id, $name, $capacity);
        header('Location: index.php?page=venue');
        exit();
    }

    public static function can_be_removed($id) {
        $venue = self::get_by_id($id);
        $events = Event::get_all_by_venue($venue->get_id());
    }

    public static function remove($id) {
        self::delete_by_id($id);
        header('Location: index.php?page=venue');
        exit();
    }

    public static function get_page_data($actions) {
        return [
            "template" => "manage",
            "title" => "Venue",
            "form" => "app/view/forms/venue.php",
            "table" => Table::generate(self::get_all(), "venue", $actions)
        ];
    }

    public static function clean_table_rows($dirty) {
        var_dump($dirty);
        $clean = [
            "x"=> (object)["a"=>"b"]
        ];
        $clean = array((object)["a"=>"0","b"=>"1","c"=>"2"], (object)["a"=>"0","b"=>"1","c"=>"2"],(object)["a"=>"0","b"=>"1","c"=>"2"],(object)["a"=>"0","b"=>"1","c"=>"2"]);
        var_dump($clean);
        return $clean;
    }
}