<?php

class SYS_Manager {

    public function __construct() {

    }

    public function __destruct() {

    }

    protected function escape($s) {
        $s = htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
        return $s;
    }

}

?>
