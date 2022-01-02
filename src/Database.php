<?php
namespace Dalaenir\Utils;

use \PDO;

class Database
{
    /**
    * @var PDO
    * */
    private $pdo;

    /**
    * @param PDO $pdo Required
    */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
    * @param string $statement Required
    * @param array $params Optional (default: empty)
    * @param string $className Optional (default: empty)
    * @param bool $onlyOne Optional (default: false)
    * @return mixed
    */
    public function query(string $statement, array $params = [], string $className = "", bool $onlyOne = false)
    {
        if (empty($params)) :
            $result = $this->pdo->query($statement);
        else :
            $result = $this->pdo->prepare($statement);
            $result->execute($params);
        endif;

        if (!empty($className)) :
            $result->setFetchMode(PDO::FETCH_CLASS, $className);
        endif;

        if (0 === strpos($statement, "SELECT")) :
            if (false === $onlyOne) :
                $data = $result->fetchAll();
            else :
                $data = $result->fetch();
            endif;

            $result->closeCursor();

            return $data;
        endif;

        $result->closeCursor();
    }

    /**
    * @return int
    */
    public function lastInsertId() : int
    {
        return $this->pdo->lastInsertId();
    }
}