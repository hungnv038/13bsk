<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/13/15
 * Time: 22:29
 */

class Settings {
    private static $table;

    public static function get($key) {
        if ( ! self::$table ) {
            self::$table = array();
            $r = DBConnection::read()->select("SELECT * FROM _settings");
            foreach($r as $item) {
                self::$table[$item->key] = $item->value;
            }
        }
        if ( isset( self::$table[$key]) ) {
            return self::$table[$key];
        }
        return null;
    }
    public static function getAll() {
        if ( ! self::$table ) {
            self::$table = array();
            $r = DBConnection::read()->select("SELECT * FROM _settings");
            foreach($r as $item) {
                self::$table[$item->key] = $item->value;
            }
        }
        return self::$table;
    }
}