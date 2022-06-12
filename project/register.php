<?php
session_start();

require_once('./dbconect.php'); 
ini_set('display_errors',true);
$errorMessage = '';
//企業登録数を格納する。
$row_count= 0;

//POSTで受け取った値がからでないときデータを各変数に格納する。
if(!empty($_POST['company_name']) and 
   !empty($_POST['tell_num']) and
   !empty($_POST['mail_addless']) and
   !empty($_POST['pass']) and 
   !empty($_POST['addless']) and 
   !empty($_POST['charge_department']) and 
   !empty($_POST['charge_name']) and
   !empty($_POST['industry'])) {

//POSTで送信されたデータの受け取り
    $_SESSION['company_name'] = $_POST['company_name'];
    $_SESSION['industry'] = $_POST['industry'];
    $_SESSION['tell_num'] = $_POST['tell_num'];
    $_SESSION['mail_addless'] = $_POST['mail_addless'];
    $_SESSION['pass'] = $_POST['addless'];
    $_SESSION['addless'] = $_POST['addless'];
    $_SESSION['charge_department']=$_POST['charge_department'];
    $_SESSION['charge_name'] = $_POST['charge_name'];
    

//　企業件数を取得後、件数プラス１をcompany_idに付与
    $rowcount_sql = 'SELECT * FROM  companylist';
    $stmt = $pdo -> query($rowcount_sql);
    $row_count = $stmt -> rowcount();
    $_SESSION['company_id'] = $row_count + 1;

// // データーベースへの登録クエリ
    $sql =
    'INSERT INTO companylist(company_id,industry,company_name,tell_num,mail_addless,pass,addless,charge_department,charge_name) 
     VALUES(:company_id, :industry, :company_name, :tell_num, :mail_addless, :pass, :addless, :charge_department, :charge_name)';

// // SQLセット
    $stmt = $pdo->prepare($sql);
    
// // 登録するデータをセット    
    $stmt->bindValue(':company_id', $_SESSION['company_id'], PDO::PARAM_INT);
    $stmt->bindValue(':company_name',$_SESSION['company_name'],  PDO::PARAM_STR);
    $stmt->bindValue(':industry',$_SESSION['industry'],  PDO::PARAM_STR);
    $stmt->bindValue(':tell_num', $_SESSION['tell_num'], PDO::PARAM_STR);
    $stmt->bindValue(':mail_addless', $_SESSION['mail_addless'], PDO::PARAM_STR);
    $stmt->bindValue(':pass', $_SESSION['pass'], PDO::PARAM_STR);
    $stmt->bindValue(':addless', $_SESSION['addless'], PDO::PARAM_STR);
    $stmt->bindValue(':charge_department', $_SESSION['charge_department'], PDO::PARAM_STR);
    $stmt->bindValue(':charge_name', $_SESSION['charge_name'], PDO::PARAM_STR);

// SQL実行
    $stmt->execute();
    header('location: notification.php');


} else{
            echo '全項目に入力してください。';
    };


?>

<!DOCTYPE html>
<html lang='ja'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=,initial-scale=1.0'>
    <link href='css/register.css' rel='stylesheet'>
    <link href='js/commos.js'>


    <title>新規登録画面/登録情報</title>
</head>
<body>
        <header class='site-header'>    
          <h1 class='site-tittle'>受注管理システム　受注くん(企業情報)</h1>
         </header>
    
    <div class='form-register'>
        <div class='form-item1 register-information'>

            <form class='form' method='POST'>
               
                 <div class='form-item2'>
                    <label>企業名称</label>
                    <input type='text' name='company_name'>
                </div>

                <div class='form-item2'>
                    <label>主産業</label>
                    <input type='text' name='industry'>
                </div>

                <div class='form-item2'>
                    <label>電話番号</label>
                    <input type='text' name='tell_num'>
                </div>

                <div class='form-item2'>
                    <label>メールアドレス</label>
                    <input type='text' name='mail_addless'>
                </div>
                <div class='form-item2'>
                    <label>パスワード</label>
                    <input type='text' name='pass'>
                </div>
                <div class='form-item2'>
                    <label>所在地</label>
                    <input type='text' name='addless'>
                </div>

                <div class='form-item2'>
                    <label>担当部署名</label>
                    <input type='text' name='charge_department'>
                </div>

                <div class='form-item2'>
                    <label>担当名</label>
                    <input type='text' name='charge_name'>
                </div>
               
                
        </div>
       
        <div class='form-item1 submit'>
           
            <div class='form-item2' method='POST'>
                <input type='submit' value='登録'>
            </div>
        
        
        </div>


        </form>




    </div>

</body>
</html>


