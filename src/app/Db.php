<?php

namespace naspersclassifieds\olxeu\app;

use PDO;

class Db
{
    private static $connection;

    /**
     * @param $sql
     * @return int
     */
    public static function execute($sql)
    {
        return self::getConnection()->exec($sql);
    }

    /**
     * @return PDO
     */
    private static function getConnection()
    {
        if (self::$connection === null) {
            $connection = new PDO('sqlite:../runtime/db.sqlite3');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection = $connection;
        }

        return self::$connection;
    }

    /**
     * @param $table
     * @param $bind
     * @return bool
     */
    public static function insert($table, $bind)
    {
        $keys = implode(', ', array_keys($bind));
        $params = implode(', ', array_fill(0, count($bind), '?'));
        $statement = self::getConnection()->prepare("INSERT INTO $table ($keys) VALUES ($params)");
        return $statement->execute(array_values($bind));
    }

    /**
     * @param $table
     * @param $bind
     * @return bool
     */
    public static function update($table, $bind)
    {
        $keys = implode(', ', array_map(function ($key) {
            return $key . ' = ?';
        }, array_keys($bind)));
        $statement = self::getConnection()->prepare("UPDATE $table SET $keys");
        return $statement->execute(array_values($bind));
    }

    /**
     * @param $table
     * @param $where
     * @return \PDOStatement
     */
    public static function query($table, $where)
    {
        return self::getConnection()->query("SELECT * FROM $table WHERE $where")->fetchAll();
    }

}