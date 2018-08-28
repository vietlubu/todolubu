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
        } catch (\Exception $e) {
            error_log("Could not connect to database: " . $e->getMessage());
        }
    }
}
