<?php
class db
{
    private $dbhost = 'localhost';
    private $dbuser = 'db_leenh';
    private $dbpass = '321321';
    private $dbname = 'slim';

    public function connect()
    {
        $conn = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
}
