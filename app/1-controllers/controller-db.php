<?php

namespace Controllers;

class DataBase
{
    protected static $host = 'localhost';
    protected static $user = 'server';
    protected static $pass = 'RotRot.314.RotRot';
    protected static $db   = 'outsiders';

    protected $connection = null;


    protected function connect()
    {
        $this->connection = mysqli_connect(self::$host, self::$user, self::$pass, self::$db);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
    }

    protected function disconnect()
    {
        if ($this->connection != null)
            $this->connection->close();
    }

    public function select($table, $columns = null, $condition = null)
    {
        $data = [];

        $query  = 'SELECT ' . ($columns == null ? '*' : implode(',', $columns));
        $query .= ' FROM ' . $table . ($condition == null ? ';' : (' WHERE ' . $condition.' ;'));

        $this->connect();
        $result = $this->connection->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        $this->disconnect();

        if( count($data) == 0 )
            return false;

        return $data;
    }

    public function insert($table, $data)
    {
        $columns = [];
        $values  = [];

        foreach ($data as $key => $value) {
            $columns[] = $key;
            $values[]  = is_numeric($value) ? $value : ('\'' . $value . '\'');
        }
        $query = 'INSERT INTO ' . $table . ' (' . implode(',', $columns) . ') VALUES (' . implode(',', $values) . ');';

        $this->connect();
        $this->connection->query($query);
        $lastID = mysqli_insert_id($this->connection);
        $this->disconnect();

        return $lastID;
    }

    public function update($table, $data, $condition = null)
    {
        $statements = [];

        foreach ($data as $key => $value) {
            $statements[] = ($key . '=' . ( is_numeric($value) ? $value : ('\'' . $value . '\'')));
        }

        $query = 'UPDATE ' . $table . ' SET ' . implode(',', $statements) . ( $condition == null ? ';' : (' WHERE '.$condition.' ;') );

        $this->connect();
        $this->connection->query($query);
        $this->disconnect();
    }

    public function delete($table,$condition=null) {
        $query = 'DELETE FROM '.$table.' '.( $condition == null ? ';' : ('WHERE '.$condition.';') );

        $this->connect();
        $this->connection->query($query);
        $this->disconnect();
    }
}
