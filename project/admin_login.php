<?php
session_start();

require_once('./dbconect.php'); 
ini_set('display_errors',true);
$errorMessage = "";

// フォームが送信された場合
if (!empty($_POST["mail_addless"])) {
    // フォーム入力値を取得
    $mail_addless = $_POST['mail_addless'];
    $pass = $_POST['pass'];
 
 
    // データーベースから入力されたユーザーを検索
    $sql =
     "SELECT
       *
      FROM
      companylist
      WHERE
       mail_addless = :mail_addless
      AND
       pass = :pass";
    

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':mail_addless', $mail_addless, PDO::PARAM_STR);
    $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
    $stmt->execute();
 
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // ユーザーが見つかればログインOK
    if ($user) {

      // $_SESSIONにログインしたユーザーIDを保持
      $_SESSION['company_id'] = $user['company_id'];
      $_SESSION['pass'] = $user['pass'];
      $_SESSION['company_name'] = $user['company_name'];
      $_SESSION['tell_num'] = $user['tell_num'];
      $_SESSION['mail_addless'] = $user['mail_addless'];
      $_SESSION['addless'] = $user['addless'];
      $_SESSION['charge_department'] = $user['charge_department'];
      $_SESSION['charge_name'] = $user['charge_name'];
      
      // メールアドレスを記憶させる場合
      if ($_POST['save'] === 'ON') {
        // クッキーにメールアドレスを保持
        setcookie('mail_addless', $mail_addless, time()+60*60*24*14);
      }

      // ログイン後の画面に遷移
      
      header('Location:  admin_notification.php');
      exit();

    } else {
      // ログインNG
      $error['login'] = "failed";
    }
  }

?>

<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/adminlogin.css" rel="stylesheet">
    <link href="js/commos.js">
    
    
    <title>管理者ログイン画面</title>
</head>
<body>
     <header class="site-header">

            <h1 class="site-tittle">受注管理システム　受注くん(管理者ログインフォーム) </h1>

        </header>
 
 <div class="log-form">
    <div class="form-item1">

        <form method="POST" class="form_main">
            <div class="form-item2">
                <label>ID</label>
                <input type="text" name="mail_addless" title="username" placeholder="username">
            </div>
            <div class="form-item2">
                <label>PASS</label>
                <input type="text" name="pass" title="username" placeholder="pass">
            </div>

            <div class="form-item2">
              <input class="submit" type="submit" value="送信する">
            </div>

        </form>
    </div>

    <div class="form-item1">
        <p><a href="admin_register.php">新規登録の方はこちら</a></p>
    </div>
</div>
    
</body>
</html>
