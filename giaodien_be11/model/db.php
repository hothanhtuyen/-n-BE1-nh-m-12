<?php
require_once 'config.php';

class Database {
    // Connection
    public static $conn;

    public function __construct() {
        if (!self::$conn) {
            self::$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, PORT);
            self::$conn->set_charset(DB_CHARSET);
        }
    }
}
?>