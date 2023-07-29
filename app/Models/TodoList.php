<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MongoDB\Client;
use MongoDB\BSON\ObjectId;


class TodoList extends Model
{
    use HasFactory;

    protected $collection;

    public function __construct()
    {
        $mongodbHost = config('database.connections.mongodb.host', '127.0.0.1');
        $mongodbPort = config('database.connections.mongodb.port', 27017);
        $mongodbDatabase = config('database.connections.mongodb.database', 'Todo_db');
        $mongodbUsername = config('database.connections.mongodb.username', null);
        $mongodbPassword = config('database.connections.mongodb.password', null);

        $uri = "mongodb://";
        if ($mongodbUsername && $mongodbPassword) {
            $uri .= "{$mongodbUsername}:{$mongodbPassword}@";
        }
        $uri .= "{$mongodbHost}:{$mongodbPort}/{$mongodbDatabase}";

        $connection = new Client($uri);


        $database = $connection->selectDatabase('Todo_db');
        $this->collection = $database->selectCollection('List');
    }

    public function getAllData()
    {
        return $this->collection->find();
    }

    public function insertData(array $data)
    {
        $this->collection->insertOne($data);
    }

    public function remove($id)
    {
        $this->collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectID($id)]);
    }

    public function updateData($id, array $data)
    {
        $objectId = new ObjectId($id);

        $this->collection->updateOne(
            ['_id' => $objectId],
            ['$set' => $data]
        );
    }

    
}
