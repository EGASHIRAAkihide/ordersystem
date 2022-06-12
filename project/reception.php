<?php
    session_start();

    require_once("./dbconect.php"); 
    ini_set("display_errors",true);
    $errorMessage = ""; 

    //companylist.phpの企業名をクリックすると企業ごとの商品注文ページにとぶ。
    $company_id = $_GET['data'];

    $sql = 
    "SELECT  companylist.company_id AS prodouct_id, prodouct_name,price
    FROM prodouctlist 
    JOIN companylist
    ON prodouctlist.prodouct_id = companylist.company_id 
    WHERE companylist.company_id = :company_id";

    $stmt = $pdo->prepare($sql);
    $stmt -> bindValue(':company_id',$company_id, PDO::PARAM_INT);
    $stmt->execute();

    $prodoucts = $stmt->fetchall(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang=ja>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reception.css">
    <title>注文受付画面</title>
</head>

<body>
        <header class="site-header">    
          <h1 class="site-tittle">受注管理システム　受注くん(注文画面)</h1>

          <nav class="nav">
                <ul class="nav__wrapper">
                    <li class="nav__item"><a href="registration_infor.php">企業登録情報</a></li>
                    <li class="nav__item"><a href="companiesList.php">取引可能企業一覧</a></li>
                    <li class="nav__item"><a href="index.php">ログアウト</a></li>
                </ul>
            </nav>

        </header>


        <form class="wrapper"　action="hirotobeat227@icoloud.com" method="POST">

            <div class="form">
                <h2>●注文者情報</h2>

                    <div class="form-item">
                        <label>予約者名</label>
                        <input type="text">
                    </div>
                    <div class="form-item">
                        <label>電話番号</label>
                        <input type="text">
                    </div>
                    <div class="form-item">
                        <label>メールアドレス</label>
                        <input type="text">
                    </div>
                    <div class="form-item">
                        <label>郵便番号</label>
                        <input type="text">
                    </div>
                    <div class="form-item">
                        <label>住所</label>
                        <input type="text">
                    </div>
                    <div class="form-item">
                        <label>特質事項</label>
                        <input type="text">
                    </div>

                <div class="submit">
                    <input type="submit" value="注文する">
                </div>

            </div>
           

            <div class="prodouct">
                <table>
                    <tr>
                        <th>商品名</th>
                        <th>金額</th>
                        <th>個数</th>
                        <th>詳細</th>
                    </tr>
 

                    <?php foreach ($prodoucts as $prodouct) { ?>                
                        <tr>
                            <td><?php echo $prodouct['prodouct_name']; ?></td>
                            <td><?php echo $prodouct['price']; ?></td>
                            <td><input type="text">個</td>
                            <td>
                                <a href="prodouctDeteil.php?data=<?php echo $prodouct['prodouct_name'];?>">
                                詳細
                            </a>
                        </td>
                            
                       </tr>
                        
                    <?php } ?>

                </table>
            </div>
        </form>
       
    </div>
</body>
</html>