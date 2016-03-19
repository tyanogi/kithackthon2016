<?php

require_once('./require.php');

// インスタンスの生成
$authInstance = new SYS_Auth();

// POSTの受け取り
$requestType = htmlspecialchars($_POST['requestType'], ENT_QUOTES, 'UTF-8');
if(isset($_POST['nextUrl'])) {
    $nextUrl = htmlspecialchars($_POST['nextUrl'], ENT_QUOTES, 'UTF-8');
}
if(isset($_POST['token'])) {
    $token = htmlspecialchars($_POST['token'], ENT_QUOTES, 'UTF-8');
    $authInstance->tokenCheck($requestType, $token);
}

// リクエストに応じてPOSTを振り分ける
switch($requestType) {
    ### administrator request ###
    // サーバ起動時の設定
    case 'admin_setup_server':
        break;
    // データベースの初期化
    case 'admin_initialize_database':
        break;
    // フロントの設定
    case 'admin_edit_basic':
        $authInstance->typeCheck(array(10));
        $inst = new SYS_Basic();
        $inst->setPost($_POST);
        break;
    // フロントの設定
    case 'admin_edit_front':
        $authInstance->typeCheck(array(10));
        $inst = new SYS_Front();
        $inst->setPost($_POST);
        break;
    // ユーザの編集（管理者）
    case 'admin_edit_user':
        $authInstance->typeCheck(array(10));
        $inst = new SYS_User();
        $inst->updateUser($_POST);
        break;
    // チームの編集（管理者）
    case 'admin_edit_team':
        $authInstance->typeCheck(array(10));
        $inst = new SYS_Team();
        $inst->updateTeam($_POST);
        break;

    ### author request ###
    // 問題の追加
    case 'author_question_add':
        $authInstance->typeCheck(array(10, 11));
        $inst = new SYS_Question();
        $inst->setPost($_POST);
        break;
    // 問題の編集
    case 'author_question_edit':
        $authInstance->typeCheck(array(10, 11));
        $inst = new SYS_Question();
        $inst->updateQuestion($_POST);
        break;
    // 問題の削除
    case 'author_question_remove':
        break;
    // ジャンルの追加
    case 'author_add_genre':
        $authInstance->typeCheck(array(10, 11));
        $inst = new SYS_Genre();
        $inst->addGenre($_POST);
        break;
    case 'author_edit_genre':
        $authInstance->typeCheck(array(10, 11));
        $inst = new SYS_Genre();
        $inst->updateGenre($_POST);
        break;
    case 'author_remove_genre':
        break;

    ### user request ####
    // ユーザ・チームの登録
    case 'user_join':
        $inst = new SYS_Join();
        $logInstance = new SYS_Log();
        $logInstance->user_join($_POST);
        $inst->setPost($_POST);
        break;
    // ユーザのログイン処理
    case 'user_login':
        $inst = new SYS_Login();
        $logInstance = new SYS_Log();
        $result = $inst->setPost($_POST);
        $logInstance->user_login($_POST, $result);
        break;
    // ユーザのログアウト処理
    case 'user_logout':
        $logInstance = new SYS_Log();
        $logInstance->user_logout();
        $authInstance->logout();
        break;
    // ユーザによるユーザ編集
    case 'user_edit_userinfo':
        $authInstance->loginCheck();
        $inst = new SYS_EditUser();
        $inst->setUserInfo($_POST);
        break;
    // ユーザによるパスワード編集
    case 'user_edit_userpw':
        $authInstance->loginCheck();
        $inst = new SYS_EditUser();
        $inst->setUserPW($_POST);
        break;
    // ユーザによるチーム編集
    case 'user_edit_teaminfo':
        $authInstance->loginCheck();
        $inst = new SYS_EditTeam();
        $inst->setTeamInfo($_POST);
        break;
    // ユーザによるチームパスワード編集
    case 'user_edit_teampw':
        $authInstance->loginCheck();
        $inst = new SYS_EditTeam();
        $inst->setTeamPW($_POST);
        break;

    ### other request ###
    case 'other_inquiry':
        $inst = new SYS_Inquiry();
        $inst->setPost($_POST);
        break;
    default:
        break;
}

// nextUrl が指定されていれば、次のページへ遷移させる
if(isset($nextUrl) && $nextUrl !== '' && (mb_substr($nextUrl, 0, 7) === 'http://' || mb_substr($nextUrl, 0, 8) === 'https://')) {
    header("Location: ".$nextUrl);
    # die("<html><head><meta http-equiv=\"refresh\" content=\"0; URL=".$nextUrl."\"></head></html>");
    die("ページ遷移に失敗しました。<br>\n<a href=\"".$nextUrl."\">こちら</a>をクリックして移動してください。");
}

// 元のページに戻す
if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
    // リファラが設定されている場合、そのページに飛ばす。
    header("Location: ".$_SERVER['HTTP_REFERER']);
    # die("<html><head><meta http-equiv=\"refresh\" content=\"0; URL=".$_SERVER['HTTP_REFERER']."\"></head></html>");
    die("ページ遷移に失敗しました。<br>\n<a href=\"".$_SERVER['HTTP_REFERER']."\">こちら</a>をクリックして移動してください。");
} else {
    // リファラが設定されていない場合
    $inst = new SYS_Front();
    $url = $inst->getBaseUrl();
    if($url !== null && $url !== '') {
        // ベースURLが設定されていればジャンプ
        header("Location: ".$url);
        # die("<html><head><meta http-equiv=\"refresh\" content=\"0; URL=".$_SERVER['HTTP_REFERER']."\"></head></html>");
        die("ページ遷移に失敗しました。<br>\n<a href=\"".$url."\">こちら</a>をクリックして移動してください。");
    } else {
        // リファラもベースURLも設定されていない場合
        die("ブラウザのRefererの設定を有効にしてください。<br>\n");
    }

}


?>
