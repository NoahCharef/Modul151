<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class MusikerModel extends Database
{
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM Musiker ORDER BY id ASC LIMIT ?", ["i", $limit]);
    }
}
