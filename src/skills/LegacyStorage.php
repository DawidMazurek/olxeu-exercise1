<?php

namespace naspersclassifieds\olxeu\skills;

use naspersclassifieds\olxeu\app\Db;
use naspersclassifieds\olxeu\app\Uuid;

class LegacyStorage
{
    public static function add($bind)
    {
        $bind['id'] = Uuid::v4();
        Db::insert(static::getName(), $bind);
        return $bind['id'];
    }

    public static function getName()
    {
        return 'skills';
    }

    public static function update($bind)
    {
        return Db::update(static::getName(), $bind);
    }

    public static function find($where)
    {
        return Db::query(self::getName(), $where);
    }

    public static function create()
    {
        $name = static::getName();
        Db::execute("CREATE TABLE IF NOT EXISTS $name (" .
            "id VARCHAR(100) PRIMARY KEY," .
            "name TEXT)"
        );
    }
}