<?php

namespace App\Models;

use App\Core\Database;

class Model
{
    protected $db;
    protected $table;
    protected $primaryKey = 'id';

    /**
     * Construct function.
     */
    public function __construct()
    {
        if (!isset($this->table)) {
            throw \Exception("table must be defined");
        }

        $this->db = new Database();
    }

    /**
     * Get current DB connection
     *
     * @return void
     */
    public function db()
    {
        $this->db;
    }

    /**
     * Close DB connection
     *
     * @return void
     */
    public function close()
    {
        $this->db = null;
    }

    /**
     * Find a record
     *
     * @param Integer $id Resrouce ID
     *
     * @return Object
     */
    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey}=:{$this->primaryKey}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->primaryKey => $id]);

        return $stmt->fetch();
    }


    /**
     * Select all record
     *
     * @param Array $fields Fields list
     *
     * @return Object
     */
    public function all($fields = ['*'])
    {
        $fields = implode(',', $fields);
        $sql = "SELECT {$fields} FROM {$this->table}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
