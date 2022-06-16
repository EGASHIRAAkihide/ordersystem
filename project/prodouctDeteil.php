<?php
    session_start();
    
    require_once('./dbconect.php'); 
    ini_set('display_errors',true);

    //sqlに条件に使用するため企業IDを取得する。
    $prodouct_name =  $_GET['data'];
    // echo $prodouct_name;

    $sql="SELECT * FROM prodouctlist WHERE prodouct_name = :prodouct_name";
    $stmt = $pdo->prepare($sql);
    $stmt-> bindValue(':prodouct_name',$prodouct_name);
    $stmt->execute();

    $prodouctdetail = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/productDetail.css">
    <title>商品詳細</title>
</head>
<body>
    <header class="site-header">    
          <h1 class="site-tittle">受注管理システム　受注くん(商品詳細情報)</h1>

          <nav class="nav">
                <ul class="nav__wrapper">
                    <li class="nav__item"><a href="registration_infor.php">企業登録情報</a></li>
                    <li class="nav__item"><a href="companiesList.php">取引可能企業一覧</a></li>
                    <li class="nav__item"><a href="index.php">ログアウト</a></li>
                </ul>
            </nav>

    </header>

    <div class="wrapper">
       <div class="productDetail">
            <div class="content1"> 
                    <p class="detail">商品イメージ <img src="img/611dffc01122a.webp"></p>
                    
            </div>
            
            <div class="content2">
                <?php foreach($prodouctdetail as $detail) { ?>
                        <div>
                            <p class="prodouctName detail">商品名</p>
                            <p class="text"><?php echo $detail['prodouct_name'] ?></p>
                        </div>
                        
                        <div>
                            <p class="prodouctMaterial detail">素材</p>
                            <p class="text"><?php echo $detail['material']?></p>

                        </div>
                        <div>            
                            <p class="prodouctColor detail">商品の特色</p>
                            <p class="text"><?php echo $detail['detail']?></p>

                        </div>

                        <div>
                            <p class="prodouctStock detail">在庫状況</p>     
                            <p class="text"><?php echo $detail['quantity'] ?></p>

                        </div>
                <?php }?>
            </div>

       </div>
    </div>
</body>
</html>