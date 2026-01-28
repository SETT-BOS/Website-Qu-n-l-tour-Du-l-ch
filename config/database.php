<?php
class Database {
private static $instance = null;


public static function connect(){
if(self::$instance === null){
$dsn = "mysql:host=localhost;dbname=tourdulich;charset=utf8";
self::$instance = new PDO($dsn, "root", "");
self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
return self::$instance;
}
}
?>