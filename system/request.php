<?php

require_once('./require.php');

$requestType = htmlspecialchars($_POST['requestType'], ENT_QUOTES, 'UTF-8');

switch($requestType) {
    ### administrator request ###
    // サーバ起動時の設定
    case 'admin_setup_server':
        break;
    // フロントの設定
    case 'admin_edit_basic':
        $inst = new SYS_Basic();
        $inst->setPost($_POST);
        break;
    // フロントの設定
    case 'admin_edit_front':
        $inst = new SYS_Front();
        $inst->setPost($_POST);
        break;
    // ユーザの編集（管理者）
    case 'admin_edit_user':
        $inst = new SYS_User();
        $inst->updateUser($_POST);
        break;
    // サーバの各種設定
    case 'admin_edit_config':
        break;
    // データベースの初期化
    case 'admin_initialize_database':
        break;
    // ジャンルの追加
    case 'admin_add_genre':
        $inst = new SYS_Genre();
        $inst->setPost($_POST);
        break;
    // ジャンルの編集
    case 'admin_edit_genre':
        break;
    // ジャンルの削除
    case 'admin_remove_genre':
        break;

    ### author request ###
    // 問題の追加
    case 'author_question_add':
        $inst = new SYS_Question();
        $inst->setPost($_POST);
        break;
    // 問題の編集
    case 'author_question_edit':
        $inst = new SYS_Question();
        $inst->setPost($_POST);
        break;
    // 問題の削除
    case 'author_question_remove':
        break;

    ### user request ####
    // ユーザの追加
    case 'user_add':
        break;
    // ユーザの編集
    case 'user_edit':
        break;
    // ユーザの削除
    case 'user_remove':
        break;
    // チームの追加
    case 'user_team_add':
        break;
    // チームの編集
    case 'user_team_edit':
        break;
    // チームの削除
    case 'user_team_remove':
        break;

    ### other request ###
    default:
        break;
}

// 元のページに戻す
if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
    // リファラが設定されている場合、そのページに飛ばす。
    header("Location: ".$_SERVER['HTTP_REFERER']);
} else {
    // リファラが設定されていない場合
    $inst = new SYS_Front();
    $url = $inst->getBaseUrl();
    if($url !== null && $url !== '') {
        // ベースURLが設定されていればジャンプ
        header("Location: ".$url);
    } else {
        // リファラもベースURLも設定されていない場合
        die("ブラウザのRefererの設定を有効にしてください。<br>\n");
    }

}


?>
