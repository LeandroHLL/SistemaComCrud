<?php
class Database {
    private $host = 'localhost';  // Endereço do servidor MySQL
    private $db_name = 'atv2';     // Nome do banco de dados
    private $username = 'root';    // Usuário do MySQL
    private $password = '';        // Senha do MySQL (mantenha vazio se for padrão local)
    public $conn;

    // Função para obter a conexão com o banco de dados
    public function getConnection() {
        $this->conn = null;

        try {
            // Cria uma nova conexão com o MySQL
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

            // Verifica se houve erro na conexão
            if ($this->conn->connect_error) {
                throw new Exception("Erro na conexão: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }

        return $this->conn;
    }
}
?>
