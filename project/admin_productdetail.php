<?php
    session_start();
    
    require_once('./dbconect.php'); 
    ini_set('display_errors',true);
    $errorMessage = "商品情報を追加する場合は全項目に値を入力してください。"; // エラーメッセージ初期化

    $company_id = $_SESSION['company_id'];


    // ログイン中企業の商品を「取扱商品詳細更新フォーム」に表示する。
    $sql="SELECT * FROM prodouctlist WHERE prodouct_id = :company_id";
    $stmt= $pdo->prepare($sql);
    $stmt->bindValue('company_id',$company_id);
    $stmt->execute();
    $products = $stmt->fetchall(PDO::FETCH_ASSOC);

    // 商品追加フォームが全て入力されている場合、商品を追加可能
    if(!empty($_POST['add_prodouctname'])and!empty($_POST['add_prodouctimage'])and
       !empty($_POST['add_price'])and!empty($_POST['add_material'])and
       !empty($_POST['add_detail'])and!empty($_POST['add_quantity'])){


        $sql_addprodouct=
            'INSERT INTO prodouctlist(prodouct_id,prodouct_image,prodouct_name, price, material, detail,quantity)
            VALUES(:prodouct_id,:prodouct_image,:prodouct_name,:price,:material,:detail,:quantity)';

        $stmt= $pdo->prepare($sql_addprodouct);
                    
                $stmt->bindValue(':prodouct_id', $company_id,PDO::PARAM_INT);
                $stmt->bindValue(':prodouct_name', $_POST['add_prodouctname'],PDO::PARAM_STR);
                $stmt->bindValue(':prodouct_image', $_POST['add_prodouctimage'],PDO::PARAM_STR); 
                $stmt->bindValue(':price', $_POST['add_price'] , PDO::PARAM_INT);
                $stmt->bindValue(':material', $_POST['add_material'], PDO::PARAM_STR);
                $stmt->bindValue(':detail', $_POST['add_detail'], PDO::PARAM_STR);
                $stmt->bindValue(':quantity', $_POST['add_quantity'], PDO::PARAM_INT);

                $stmt->execute();

                header('location: admin_productdetail.php');
                exit();
             

    }else{
                echo $errorMessage;
    };

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_productdetail.css">
    <title>商品管理画面</title>
</head>
<body>

    <header class="site-header">    
          <h1 class="site-tittle">受注管理システム　受注くん(商品管理画面)</h1>

            <nav class="nav">
                <ul class="nav__wrapper">
                    <li class="nav__item"><a href="admin_notification.php">企業登録情報</a></li>
                    <li class="nav__item"><a href="admin_productdetail.php">取扱商品詳細</a></li>
                    <li class="nav__item"><a href="admin_login.php">ログアウト</a></li>

                </ul>
            </nav>
      </header>

      <div class="wrapper">
            <div class="item">
                <p>取扱商品追加フォーム</p>
            
                <form class='form' method='POST'>
                    <table>

                        <tr>
                            <th>商品名</th>
                            <th>商品イメージ</th>
                            <th>値段</th>
                            <th>素材</th>
                            <th>商品の特徴</th>
                            <th>在庫管理（個数）</th>
                        </tr>

                        <tr>
                            <td><input type="text" name="add_prodouctname"></td>
                            <td><input type="text" name="add_prodouctimage"></td">
                            <td><input type="number" name="add_price"></td>
                            <td><input type="text" name="add_material"></td>
                            <td><input type="text" name="add_detail"></td>      
                            <td><input type="number" name="add_quantity"></td>       
                        </tr>
                
                    </table>

                    <div class="submit" method="POST">
                        <input type="submit" value="追加">
                    </div>
                </form>  
            </div>

            <div class="item">
                 <p>取扱商品詳細更新フォーム</p>

            
                    <table>
                        <tr>
                            <th>商品名</th>
                            <th>商品イメージ</th>
                            <th>値段</th>
                            <th>素材</th>
                            <th>商品の特徴</th>
                            <th>在庫管理（個数）</th>
                        </tr>

                        <?php  foreach($products as $prodcut){ ?>

                                <tr>
                                    <td><input value="<?php echo $prodcut['prodouct_name'];?> "></td>
                                    <td><input value="<?php echo $prodcut['prodouct_image'];?> "></td>
                                    <td><input value="<?php echo $prodcut['price'];?> "></td>
                                    <td><input value="<?php echo $prodcut['material'];?> "></td>
                                    <td><input value="<?php echo $prodcut['detail'];?> "></td>
                                    <td><input value="<?php echo $prodcut['quantity'];?> "></td>
                            </tr>
                        <?php }  ?>

                        </table>


            </div>
        </div>
</body>
</html>