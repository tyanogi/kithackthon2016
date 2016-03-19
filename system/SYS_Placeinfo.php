<?php
//require_once('./require.php');

class SYS_Placeinfo extends SYS_Manager {

    private static $placeinfoIns = null;

    public function __construct() {
        $this->placeIns = new DB_Placeinfo();
    }

    public function __destruct() {
        $this->placeIns = null;
    }

    public final function getAllPlaceinfo() {
        return ($this->placeIns->getAllplaceinfo());
    }

    public final function addPlaceinfo($post) {
        // エスケープ処理
        $Address = $this->escape($post['Address']);
        $Latitude = $this->escape($post['latitude']);
        $Longitude = $this->escape($post['longitude']);
        $Name = $this->escape($post['name']);
        $Summary = $this->escape($post['description']);
        $Postalcode = $this->escape($post['Postalcode']);
        $genre_GenreId = $this->escape($post['genre']);

        echo "debug :";
        print_r($post);

        // 登録処理
        $result = $this->placeIns->addPlaceinfo($Address, $Latitude, $Longitude, $Name, $Summary, $Postalcode, $genre_GenreId);
    }

    public final function removePlaceinfo($post) {

    }

    public final function updatePlaceinfo($post) {
        // 権限チェック
        $this->authInstance->typeCheck(array(10, 11));

        // エスケープ処理
        $data['genreId'] = $this->escape($post['genreId']);
        $data['genreName'] = $this->escape($post['genreName']);

        // 空欄チェック
        foreach($data as $k => $v) {
            if($v === null || $v === '') {
                $this->errorInstance->errorMessage("ジャンルIDもしくはジャンル名を空欄にすることはできません。");
            }
        }

        // ジャンルIDが存在するかの確認
        $cntGenre = $this->genreInstance->cntGenre(array('genreId' => $data['genreId']));
        if($cntGenre !== 1) {
            $this->errorInstance->errorMessage("指定されたジャンルIDは存在しません。");
        }
        unset($cntGenre);

        // 既に登録されていないかの確認
        $cntGenre = $this->genreInstance->cntGenre(array('genreName' => $data['genreName']));
        if($cntGenre !== 0) {
            $this->errorInstance->errorMessage("既に同じジャンル名が登録されています。");
        }

        // 編集処理
        $cond = array(
            'genreName' => $data['genreName']
        );
        $this->genreInstance->updateGenre($data['genreId'], $cond);
    }

}

