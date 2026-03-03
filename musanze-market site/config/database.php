<?php
// config/database.php
// Database connection configuration
// NOTE: In production, use environment variables or a .env file
// Never commit real credentials to GitHub

define('DB_HOST', 'sql301.infinityfree.com');
define('DB_USER', 'if0_41288824');
define('DB_PASS', 'bahiziian1234');
define('DB_NAME', 'if0_41288824_musanzemarketdb');
define('DB_CHARSET', 'utf8mb4');

/**
 * Get a MySQLi database connection (singleton pattern)
 */
function getDB(): mysqli
{
    static $connection = null;

    if ($connection === null) {
        $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($connection->connect_error) {
            // In production: log this error, don't expose it
            error_log('DB Connection failed: ' . $connection->connect_error);
            die(json_encode(['error' => 'Database connection failed. Please try again later.']));
        }

        $connection->set_charset(DB_CHARSET);
    }

    return $connection;
}
