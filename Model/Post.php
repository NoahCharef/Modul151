<?php

class Post
{
    private $connection;
    private $table_musiker = "tbl_musiker";
    private $table_instrumente = "tbl_instrument";

    public $id;
    public $musiker_name;
    public $instrument_id;
    public $instrument_name;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function read_musiker(){
        $query = 'SELECT 
                m.id,
                m.name, 
                i.instrumentname as instrument_name
                FROM 
                ' . $this->table_musiker . ' m 
                left join 
                tbl_instrument i 
                on 
                m.fk_instrument = i.id
                ORDER BY
                m.id ASC;';

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read_instrument(){
        $query = 'SELECT 
                *
                FROM 
                ' . $this->table_instrumente . '
                ORDER BY
                id ASC;';

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read_single()
    {
        $query = 'SELECT 
                m.id,
                m.name, 
                i.instrumentname as instrument_name
                FROM 
                ' . $this->table_musiker . ' m 
                left join 
                tbl_instrument i 
                on 
                m.fk_instrument = i.id  
                WHERE m.id = ? 
                LIMIT 0,1'
        ;

        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(1, $this->id, PDO::PARAM_INT);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->musiker_name = $row['name'];
        $this->instrument_name = $row['instrument_name'];
    }

    public function create_musiker()
    {
        // Create query
        $query = 'INSERT INTO '
            . $this->table_musiker . ' 
            SET 
            name = :name, 
            fk_instrument = :instrument_id'
        ;

        // Prepare statement
        $stmt = $this->connection->prepare($query);

        // Clean data
        $this->musiker_name = htmlspecialchars(strip_tags($this->musiker_name));
        $this->instrument_id = htmlspecialchars(strip_tags($this->instrument_id));

        // Bind data
        $stmt->bindParam(':name', $this->musiker_name);
        $stmt->bindParam(':instrument_id', $this->instrument_id);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function create_instrument()
    {
        // Create query
        $query = 'INSERT INTO '
            . $this->table_instrumente . ' 
            SET 
            instrumentname = :instrument_name'
        ;

        // Prepare statement
        $stmt = $this->connection->prepare($query);

        // Clean data
        $this->instrument_name = htmlspecialchars(strip_tags($this->instrument_name));

        // Bind data
        $stmt->bindParam(':instrument_name', $this->instrument_name);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function update() {
        // Create query
        $query = 'UPDATE ' . $this->table_musiker . '
                SET name = :name, fk_instrument = :fk_instrument
                WHERE id = :id';

        // Prepare statement
        $stmt = $this->connection->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->instrument_name = htmlspecialchars(strip_tags($this->instrument_name));
        $this->instrument_id = htmlspecialchars(strip_tags($this->instrument_id));

        // Bind data
        $stmt->bindParam(':name', $this->musiker_name);
        $stmt->bindParam(':fk_instrument', $this->instrument_id);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Delete Post
    public function delete_musiker() {
        // Create query
        $query = 'DELETE FROM ' . $this->table_musiker . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->connection->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}