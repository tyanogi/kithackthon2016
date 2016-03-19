<?php

class DB_Genre extends DB_Manager {

    public final function addGenre($genreMain, $genreSub) {
        $stmt = $this->pdo->prepare("INSERT INTO Genre(genreMain, genreSub) VALUES (:genreMain, :genreSub)");
        #$stmt->bindParam(':genreName', $this->escape($genreName), PDO::PARAM_STR);
        $stmt->execute();
    }

    public final function removeGenre($cond = array()) {
        if(!is_array($cond) || empty($cond)) return false; // $condについて配列か、空配列かをチェック
        $keysExpected = array('genreId', 'genreName', 'genreSub'); // カラム名ホワイトリスト
        $aryWhere = array();
        $valsToBind = array();
        foreach($cond as $k => $v) {
            if(in_array($k, $keysExpected, true)) {
                $aryWhere[] = sprintf("%s = ?", $k);
                $valsToBind[] = $v;
            }
        }
        if(!empty($aryWhere)) {
            $sql = sprintf("DELETE FROM Genre WHERE %s", implode(' AND ', $aryWhere));
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($valsToBind);
        } else {
            return false;
        }
        return true;
    }

    public final function getGenre($cond = array()) {
        if(!is_array($cond) || empty($cond)) return false; // $condについて配列か、空配列かをチェック
        $keysExpected = array('genreId', 'genreMain', 'genreSub'); // カラム名ホワイトリスト
        $aryWhere = array();
        $valsToBind = array();
        foreach($cond as $k => $v) {
            if(in_array($k, $keysExpected, true)) {
                $aryWhere[] = sprintf("%s = ?", $k);
                $valsToBind[] = $v;
            }
        }
        if(!empty($aryWhere)) {
            $sql = sprintf("SELECT * FROM Genre WHERE %s", implode(' AND ', $aryWhere));
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($valsToBind);
        } else {
            return null;
        }
        return ($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public final function getAllGenre() {
        $sql = "SELECT * FROM Genre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $ret = array();
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) array_push($ret, $result);
        return $ret;
    }

    public final function updateGenre($genreId, $cond = array()) {
        if(!is_array($cond) || empty($cond)) return false; // $condについて配列か、空配列かをチェック
        $keysExpected = array('genreName'); // カラム名ホワイトリスト
        $aryWhere = array();
        $valsToBind = array();
        foreach($cond as $k => $v) {
            if(in_array($k, $keysExpected, true)) {
                $aryWhere[] = sprintf("%s = ?", $k);
                $valsToBind[] = $v;
            }
        }
        if(!empty($aryWhere)) {
            $sql = sprintf("UPDATE Genre SET %s WHERE genreId = '".($this->escape($genreId))."'", implode(', ', $aryWhere));
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($valsToBind);
        } else {
            return false;
        }
        return true;
    }

    public final function cntGenre($cond = array()) {
        if(!is_array($cond) || empty($cond)) return false; // $condについて配列か、空配列かをチェック
        $keysExpected = array('genreId', 'genreName'); // カラム名ホワイトリスト
        $aryWhere = array();
        $valsToBind = array();
        foreach($cond as $k => $v) {
            if(in_array($k, $keysExpected, true)) {
                $aryWhere[] = sprintf("%s = ?", $k);
                $valsToBind[] = $v;
            }
        }
        if(!empty($aryWhere)) {
            $sql = sprintf("SELECT COUNT(*) AS CNT FROM Genre WHERE %s", implode(' AND ', $aryWhere));
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($valsToBind);
        } else {
            return null;
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return intval($result['CNT']);
    }

}

?>
