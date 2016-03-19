<?php
class DB_Placeinfo extends DB_Manager {
  
    public final function addPlaceinfo($Address, $Latitude, $Longitude, $Name, $Summary, $Postalcode, $genre_GenreId) {
        $stmt = $this->pdo->prepare("INSERT INTO placeinfo(Address, Latitude, Longitude, Name, Summary, Postalcode, genre_GenreId)
                                                  VALUES (:Address, :Latitude, :Longitude, :Name, :Summary, :Postalcode,  :genre_GenreId)");
        $stmt->bindParam(':Address', $this->escape($Address), PDO::PARAM_INT);
        $stmt->bindValue(':Latitude', $this->escape($Latitude), PDO::PARAM_INT);
        $stmt->bindParam(':Longitude', $this->escape($Longitude), PDO::PARAM_INT);
        $stmt->bindValue(':Name', $this->escape($Name), PDO::PARAM_STR);
        $stmt->bindValue(':Summary', $this->escape($Summary), PDO::PARAM_STR);
        $stmt->bindParam(':Postalcode', $Postalcode, PDO::PARAM_STR);
        $stmt->bindValue(':genre_GenreId', $this->escape($genre_GenreId), PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public final function removePlaceinfo($cond = array()) {
        if(!is_array($cond) || empty($cond)) return false; // $condについて配列か、空配列かをチェック
        $keysExpected = array('PlaceId', 'Address', 'Latitude', 'Longitude', 'Name', 'Summary', 'Postalcode', 'Date', 'Genre_genreId'); // カラム名ホワイトリスト
        $aryWhere = array();
        $valsToBind = array();
        foreach($cond as $k => $v) {
            if(in_array($k, $keysExpected, true)) {
                $aryWhere[] = sprintf("%s = ?", $k);
                $valsToBind[] = $v;
            }
        }
        if(!empty($aryWhere)) {
            $sql = sprintf("DELETE FROM placeinfo WHERE %s", implode(' AND ', $aryWhere));
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($valsToBind);
        } else {
            return false;
        }
        return true;
    

        if(!empty($aryWhere)) {
            $sql = sprintf("SELECT * FROM placeinfo WHERE %s", implode(' AND ', $aryWhere));
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($valsToBind);
        } else {
            return null;
        }
        return ($stmt->fetch(PDO::FETCH_ASSOC));
    }

   public final function getAllPlaceinfo() {
        $sql = "SELECT * FROM placeinfo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $ret = array();
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) array_push($ret, $result);
        return $ret;
    }

}

?>
