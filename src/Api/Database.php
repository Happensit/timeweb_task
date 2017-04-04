<?php

namespace Api;

use PDO;

/**
 * Class Database
 * @package Api
 */
class Database
{

    /**
     * @var string
     */
    protected $dsn = '';

    /**
     * @var string
     */
    protected $username = '';

    /**
     * @var string
     */
    protected $password = '';

    /**
     * @var Database
     */
    private $pdo;

    /**
     * @var
     */
    private $statement;

    /**
     * Connection constructor.
     * @param $dsn
     * @param $username
     * @param $password
     */
    public function __construct($dsn, $username, $password)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return PDO
     * @throws \PDOException
     */
    private function createPdoInstance()
    {
        try {
            $this->pdo = new PDO($this->dsn, $this->username, $this->password);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            throw new \PDOException("Database connection could not be established. ;( Reason: " . $e->getMessage());
        }
    }

    /**
     * @return PDO|Database
     */
    public function getPdoInstance()
    {
        if (!isset($this->pdo)) {
             $this->createPdoInstance();
        }
        return $this->pdo;
    }

    /**
     * @param $sql
     * @param array $params
     * @return $this
     */
    public function query($sql, $params = [])
    {
        $this->prepare($sql);
        $this->statement->execute($params);
        return $this;
    }

    /**
     * @param $sql
     * @param array $params
     * @return bool
     */
    public function execute($sql, $params = [])
    {
        $this->prepare($sql);
        $this->statement->execute($params);
        $rowCount = $this->statement->rowCount();
        $this->statement->closeCursor();
        $this->statement = null;
        return $rowCount;
    }

    /**
     * Get PDO statement
     * @param $sql
     * @return mixed
     * @throws \Exception
     */
    private function prepare($sql)
    {
        try {
            $this->statement = $this->getPdoInstance()->prepare($sql);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
        return $this->statement;
    }

    /**
     * @return array|false
     */
    public function findAll()
    {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
