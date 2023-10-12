<?php

/**
 * Represents the DAO and the POPO class. This class interacts with the DB and 
 * is also used in place of the POPO object to store data retrieved from the DB.
 */
class Role {

    private $idrole;
    public $name;

    // accessors
    public function get_id() { 
        return $this->idrole; 
    }

    // db
    static function get_all() { 
        return DB::queryAll('SELECT * FROM role ORDER BY idrole ASC', 'Role'); 
    }
    static function get_by_id($idrole) { 
        return DB::queryOne('SELECT * FROM role WHERE idrole = :idrole', 'Role', ['idrole' => $idrole]); 
    }
    static function delete_by_id($idrole) { 
        return DB::query('DELETE FROM role WHERE idrole = :idrole', ['idrole' => $idrole]); 
    }

    static function insert($name) {
        try {
            $queryString = 
            'insert into role (name)
             values (:name)';
            return DB::query($queryString, [
                "name" => $name
            ]);
        } catch (PDOException $pdo) {
            return null;
        }
    }

    public static function update($id, $name) {
        try {
            $queryString = 
            'update role set name = :name
             where idrole = :id';
            return DB::query($queryString, [
                "name" => $name,
                "id" => $id,
            ]);
        } catch (PDOException $pdo) {
            header('Location: index.php?page=role');
            exit();
        }
    }

    // exposed static methods
    public static function create() {
        $name = Filter::validate_and_sanitize(INPUT_POST, 'name', NULL);
        self::insert($name);
        header('Location: index.php?page=role');
        exit();
    }

    public static function edit($id) {
        $name = Filter::validate_and_sanitize(INPUT_POST, 'name', NULL);
        self::update($id, $name);
        header('Location: index.php?page=role');
        exit();
    }

    public static function remove($id) {
        self::delete_by_id($id);
        header('Location: index.php?page=role');
        exit();
    }

    public static function get_page_data($actions) {
        return [
            "template" => "manage",
            "title" => "Roles",
            "form" => "app/view/forms/role.php",
            "table" => Table::generate(self::get_all(), "role", $actions),
            "all_events" => Event::get_all(),
            "all_venues" => Venue::get_all(),
            "all_roles" => Role::get_all(),
        ];
    }
}