<?php

namespace Exam\Core\Repository;

use \PDO as PDO;
use \PDOException as PDOException;

abstract class Repository
{
    protected $DBH;

    function openConnection(): PDO
    {
        try {
            $settings = parse_ini_file(RESOURCES_PATH . '/db.properties.ini');
            $dsn = 'pgsql:
                    host=' . $settings['host'] . ';
                    port=' . $settings['port'] . ';
                    dbname=' . $settings['db'] . ';';
            $opt = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false];
            $this->DBH = new PDO($dsn, $settings['user'], $settings['pass'], $opt);
            return $this->DBH;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return null;
    }

    function closeConnection()
    {
        $this->DBH = null;
    }
}