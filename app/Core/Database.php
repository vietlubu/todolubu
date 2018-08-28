<?php

namespace App\Core;

use PDO;

class Database extends PDO
{
    /**
     * Construct function. Create connection to database
     */
    public function __construct()
    {
        try {
            $dbPatch = APP_ROOT . "database/database.db";
            parent::__construct("sqlite:" . $dbPatch);

            $this->createTasksTable();
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
