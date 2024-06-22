
<?php

class Connection
{
    private $dbType;
    private $host;
    private $dbName;
    private $port;
    private $username;
    private $password;
    private $connection;

    public function __construct($dbType, $host, $dbName, $port, $username, $password)
    {
        $this->setDbType($dbType);
        $this->setHost($host);
        $this->setDbName($dbName);
        $this->setPort($port);
        $this->setUsername($username);
        $this->setPassword($password);
    }

    public function connectToDB()
    {
        $dbType = $this->getDbType();
        $host = $this->getHost();
        $dbName = $this->getDbName();
        $port = $this->getPort();
        $username = $this->getUsername();
        $password = $this->getPassword();
        $connection = $this->getConnection();

        try {
            $connection = new PDO("$dbType:host=$host;dbname=$dbName;port=$port", $username, $password);
            $this->setConnection($connection);
        } catch (PDOException $errors) {
            echo $errors->getMessage();
            die();
        }
    }

    public function getDbType()
    {
        return $this->dbType;
    }
    public function setDbType($dbType)
    {
        $this->dbType = $dbType;

        return $this;
    }


    public function getHost()
    {
        return $this->host;
    }
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }


    public function getDbName()
    {
        return $this->dbName;
    }
    public function setDbName($dbName)
    {
        $this->dbName = $dbName;

        return $this;
    }


    public function getPort()
    {
        return $this->port;
    }
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }


    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }


    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }


    public function getConnection()
    {
        return $this->connection;
    }
    public function setConnection($connection)
    {
        $this->connection = $connection;

        return $this;
    }

    function selectAll($query, $array = [])
    {
        $connection = $this->getConnection();

        $selectSQL = $query;
        $selectQuery = $connection->prepare($selectSQL);
        $selectQuery->execute($array);
        $result = $selectQuery->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    function selectOne($query, $array = [])
    {
        $connection = $this->getConnection();

        $selectSQL = $query;
        $selectQuery = $connection->prepare($selectSQL);
        $selectQuery->execute($array);
        $result = $selectQuery->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function insert($query, $array)
    {
        $connection = $this->getConnection();

        $insertSQL = $query;
        $insertQuery = $connection->prepare($insertSQL);
        $insertQuery->execute($array);
    }

    function update($query, $array)
    {
        $connection = $this->getConnection();

        $insertSQL = $query;
        $insertQuery = $connection->prepare($insertSQL);
        $insertQuery->execute($array);
    }

    function delete($query, $array)
    {
        $connection = $this->getConnection();

        $insertSQL = $query;
        $insertQuery = $connection->prepare($insertSQL);
        $insertQuery->execute($array);
    }
}
