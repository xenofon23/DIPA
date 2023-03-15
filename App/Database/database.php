<?php

namespace App\Database;
use MongoDB\Client as Mongo;
use MongoDB\Collection;

trait database
{
    public function mongo($mongoCollection): Collection
    {

        $mongoConnection = new Mongo('mongodb://' .
            $_SERVER['APP_DB_ADDRESS'] . ':' .
            $_SERVER['APP_DB_PORT']);
        $db = $mongoConnection->selectDatabase('hotelRawData');
        return $db->selectCollection($mongoCollection);
    }

}