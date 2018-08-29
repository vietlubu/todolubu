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

        $this->db = new Database(config("database.sqlite_patch"));
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

        return $stmt->fetch(\PDO::FETCH_ASSOC);
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
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Create record
     *
     * @param Array $data Data
     *
     * @return Boolean
     */
    public function create($data)
    {
        $keys = array_keys($data);
        $fields = implode(", ", $keys);
        $values = ':' . implode(", :", $keys);

        $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$values})";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    /**
     * Create record
     *
     * @param Array $data Data
     *
     * @return Boolean
     */
    public function update($data)
    {
        $keys = array_keys($data);

        $values = "";
        foreach ($keys as $field) {
            $values .= $field . '=:' . $field . ', ';
        }
        $values = trim($values, ", ");

        $sql = "UPDATE {$this->table} SET {$values} WHERE {$this->primaryKey}=:{$this->primaryKey}";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    /**
     * Delete record
     *
     * @param int $id Resource ID
     *
     * @return Boolean
     */
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey}=:{$this->primaryKey}";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$this->primaryKey => $id]);
    }
}
