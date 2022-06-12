<?php
    session_start();
    
    require_once('./dbconect.php'); 
    ini_set('display_errors',true);

    //sqlに条件に使用するため企業IDを取得する。
    $company_id =  $_SESSION['company_id'];
    
    // 企業連番を生成
    $company_no = 0;
    
         // ①ログインしている企業以外の企業情報を表示する。
         $sql="SELECT company_id,company_name,industry
         FROM companylist
         WHERE company_id <> :company_id";

         $stmt = $pdo -> prepare($sql);
         $stmt -> bindValue(':company_id', $company_id, PDO::PARAM_INT);
         $stmt -> execute();

         // ②　①で取得した企業情報を多次元配列で取得する。
         $supliers_infor = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/companiesList.css" rel="stylesheet">
    <title>取引可能企業一覧</title>
</head>
<body>
        <header class="site-header">    
          <h1 class="site-tittle">受注管理システム　受注くん(取引可能企業一覧)</h1>

          <nav class="nav">
                <ul class="nav__wrapper">
                    <li class="nav__item"><a href="registration_infor.php">企業登録情報</a></li>
                    <li class="nav__item"><a href="companiesList.php">取引可能企業一覧</a></li>
                    <li class="nav__item"><a href="index.php">ログアウト</a></li>
                </ul>
            </nav>

        </header>
 
    <div class="wrapper">
 
    

        <div class="companiesList">
            <table>
                <tr>
                    <th class="searchNo no">企業NO</th>
                    <th class="searchCompanyName name">企業名称</th>
                    <th class="searchField field">商品分類</th>
                  
                </tr>
            
                <?php foreach ($supliers_infor as $suplier) { ?>                
                    
                    <tr>
                        <td class="companiesNo">
                            <?php echo $company_no =$company_no + 1 ;?></td>
                    
                        <td class="companName">
                            <a href="reception.php?data=<?php echo $suplier['company_id'];?>">
                                <?php echo $suplier['company_name'];?>
                            </a>
                        </td>
                        
                        <td class="companiesField"><?php echo $suplier['industry'];?></td>
                    </tr>
                    
                <?php } ?>

            </table>

        </div>

    </div>


</body>
</html>