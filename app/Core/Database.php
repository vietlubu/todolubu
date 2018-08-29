<?php

namespace App\Core;

use PDO;

class Database extends PDO
{
    /**
     * Construct function. Create connection to database
     *
     * @param string $dbPath Database path
     */
    public function __construct($dbPath)
    {
        try {
            parent::__construct("sqlite:" . $dbPath);

            if (config("database.create_table")) {
                $this->createTasksTable();
            }
        } catch (\Exception $e) {
            error_log("Could not connect to database: " . $e->getMessage());
        }
    }

    /**
     * Create table `tasks`
     *
     * @return void
     */
    private function createTasksTable()
    {
        $sqlCreateTable = "
            CREATE TABLE IF NOT EXISTS `tasks` (
                `id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                `name`	TEXT NOT NULL,
                `starting_date`	TEXT NOT NULL,
                `ending_date`	TEXT,
                `status`	INTEGER NOT NULL DEFAULT 1
            );
        ";

        $this->exec($sqlCreateTable);
    }
}
