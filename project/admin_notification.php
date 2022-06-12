<?php
session_start();

$company_name = $_SESSION['company_name'];
$tell_num = $_SESSION['tell_num'];
$mail_ddless = $_SESSION['mail_addless'] ;
$addless = $_SESSION['addless'];
$charge_department = $_SESSION['charge_department'];
$charge_name = $_SESSION['charge_name'];


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/admin_notification.css" rel="stylesheet">
    <title>登録情完了通知画面</title>
</head>
<body>
      <header class="site-header">    
          <h1 class="site-tittle">受注管理システム　受注くん(企業登録情報)</h1>

          <nav class="nav">
                <ul class="nav__wrapper">
                    <li class="nav__item"><a href="admin_notification.php">企業登録情報</a></li>
                    <li class="nav__item"><a href="admin_prodouctdeteil.php">取扱商品詳細</a></li>
                    <li class="nav__item"><a href="admin_login.php">ログアウト</a></li>

                </ul>
            </nav>
      </header>

    <div class="wrapper">
            <div class="item">
                    <label>企業名称</label>
                    <input type="text" value="<?php echo $company_name;?>">                  
                </div>

                <div class="item">
                    <label>電話番号</label>
                    <input type="text" value="<?php echo $tell_num;?>">                      
                </div>

                <div class="item">
                    <label>メールアドレス</label>
                    <input type="text" value="<?php echo $mail_ddless;?>">                
                </div>

                <div class="item">
                    <label>住所</label>
                    <input type="text" value="<?php echo $addless;?>">                
                </div>

                <div class="item">
                    <label>担当部署</label>
                    <input type="text" value="<?php echo $charge_department;?>">                
                </div>

                <div class="item">
                    <label>担当者名</label>
                    <input type="text" value="<?php echo $charge_name;?>">                
                </div>
        </div>
    </div>
</body>
</html>
