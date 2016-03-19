<?php

class DB_Manager {
    protected $pdo;

    public function __construct() {
        $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8';
        $option = array(
            PDO::ATTR_EMULATE_PREPARES => false
        );

        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PW, $option);
            $this->pdo->query('SET NAMES utf8;');
        } catch (PDOException $e) {
            die("Can't connect to MySQL server.<br>\n");
            // $e->getMessage() コメントアウト禁止 脆弱性になる。
        }
    }

    public function __destruct() {
        $this->pdo = null;
    }

    protected function escape($s) {
        $s = htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
        return $s;
    }

}

?>
