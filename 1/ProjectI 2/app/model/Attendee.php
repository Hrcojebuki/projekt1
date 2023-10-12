<?php

/**
 * Represents the DAO and the POPO class. This class interacts with the DB and 
 * is also used in place of the POPO object to store data retrieved from the DB.
 */
class Attendee {

    private $idattendee;
    public $name;
    public $password;
    public $role;
    
    // accessors
    public function get_id() { return $this->idattendee; }

    // db
    static function get_all() {        
        return DB::queryAll("SELECT idattendee, attendee.name AS name, password, role.name AS role
            FROM attendee LEFT JOIN role ON role = idrole ORDER BY idattendee ASC", 'Attendee');
    }

    static function get_all_by_role($role) { 
        return DB::queryAll("SELECT * FROM attendee WHERE role = :role", 'Attendee' ,['role' => $role]);
    }

    static function get_by_id($idattendee) {
        return DB::queryOne("SELECT * FROM attendee WHERE idattendee = :idattendee", 'Attendee', ['idattendee' => $idattendee]);
    }
  
    static function get_by_username($username) {
        return DB::queryOne("SELECT * FROM attendee WHERE name = :name", 'Attendee', ['name' => $username]);
    }

    static function delete_by_id($idattendee) {
        return DB::query("DELETE FROM attendee WHERE idattendee = :idattendee", ['idattendee' => $idattendee]);
    }

    static function insert($name, $password, $role) {
        $hash = hash('sha256', $password);
        try {
            $queryString = 
            'insert into attendee (name, password, role)
             values (:name,:password,:role)';
    
            return DB::query($queryString, [
                "name" => $name, 
                "password" => $hash, 
                "role" => $role
            ]);
        } catch (PDOException $pdo) {
            header('Location: index.php?page=event');
            exit();
        }
    }

    public static function update($id, $name, $password, $role) {
        try {
            $queryString = 
            'update attendee set name = :name, password = :password, role = :role
             where idattendee = :id';

            return DB::query($queryString, [
                "name" => $name, 
                "password" => $password, 
                "role" => $role, 
                "id" => $id,
            ]);
        } catch (PDOException $pdo) {
            header('Location: index.php?page=attendee');
            exit();
        }
    }

    static function authenticate($name, $password) {
        $hash = hash('sha256', $password);
        return DB::queryOne('SELECT * FROM attendee WHERE name = :name AND password = :password', 'Attendee', ['name' => $name, 'password' => $hash]);
    }

    // exposed static methods
    public static function create() {
        $name = Filter::validate_and_sanitize(INPUT_POST, 'name', NULL);
        $password = Filter::validate_and_sanitize(INPUT_POST, 'password', NULL);
        $role = Filter::validate_and_sanitize(INPUT_POST, 'role', NULL);
        self::insert($name, $password, $role);
        header('Location: index.php?page=attendee');
        exit();
    }

    public static function edit($id) {
        $name = Filter::validate_and_sanitize(INPUT_POST, 'name', NULL);
        $password = Filter::validate_and_sanitize(INPUT_POST, 'password', NULL);
        $role = Filter::validate_and_sanitize(INPUT_POST, 'role', NULL);

        if(!$password) {
            $password = Attendee::get_by_id($id)->password;
        } else {
            $password = hash('sha256', $password);
        }

        self::update($id, $name, $password, $role);
        header('Location: index.php?page=attendee');
        exit();
    }

    public static function remove($id) {
        self::delete_by_id($id);
        header('Location: index.php?page=attendee');
        exit();
    }

    public static function get_page_data($actions) {
        return [
            "template" => "manage",
            "title" => "Attendees",
            "form" => "app/view/forms/attendee.php",
            "table" => Table::generate(self::get_all(), "attendee", $actions),
            "all_roles" => Role::get_all(),
        ];
    }
}