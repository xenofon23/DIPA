<?php

namespace App\Database;
use MongoDB\Client;
use MongoDB\Client as Mongo;
use MongoDB\Collection;

trait database
{
    public function mongo($mongoCollection): Collection
    {
//        $username='superadmin';
//        $password='password';
//        $host='192.168.242.129';
//        $port='27017';
//        $database='admin';
//
//        $uri = sprintf(
//            'mongodb://%s:%s@%s:%s/%s',
//            $username,
//            $password,
//            $host,
//            $port,
//            $database
//        );
//
//        $mongoConnection=new Client($uri);
        $mongoConnection = new Mongo('mongodb://localhost:27017/');
        $db = $mongoConnection->selectDatabase('dipa');
        return $db->selectCollection($mongoCollection);
    }

}
