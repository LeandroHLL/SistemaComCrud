<?php
class Database
{
    private $host = 'localhost';
    private $db_name = 'atv2';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

            if ($this->conn->connect_error) {
                throw new Exception("Erro na conexão: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }

        return $this->conn;
    }
}
