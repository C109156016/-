
<?php
include("auth.php");
include("template.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    <title>庫存管理</title>
  </head>
  <body>
<?php
head();
horizontal_bar();
menu("庫存管理");
?>
 <?php

echo "歡迎 $username!!";

?>


    <h1>庫存管理</h1>
    <!-- <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    進銷存管理
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="dept.php">部門資料維護</a></li>
    <li><a class="dropdown-item" href="product.php">產品品項</a></li>
    <li><a class="dropdown-item" href="inv.php">庫存管理</a></li>
    <li><a class="dropdown-item" href="salesorder.php">訂單管理</a></li>
  </ul>
</div> -->

    <div class="container">

  <?php
  
  function display_form($op,$ProdId)
  {

      if ($op==3)
      {
        $ProdId="";
        $Stock="";
        $SafeStock="";
        $op=4;
      }
      
      else
      {
              include("connectdb.php");
              $sql = "SELECT * FROM inv,product where product.ProdId='$ProdId' and inv.ProdId='$ProdId'";
              $result =$connect->query($sql);
              if ($row = $result->fetch_assoc()) {
                $ProdId=$row['ProdId'];
                $Stock=$row['Stock'];
                $SafeStock=$row['SafeStock'];
                $ProdName=$row['ProdName'];
                $UnitPrice=$row['UnitPrice'];
                $Cost=$row['Cost'];
              }
                $Stock1="";
                $op=2; 
      }
      echo "<form action=inv.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品代號</label>
              <input type='text' class='form-control' name=ProdId id='ProdId' readonly placeholder='請輸入產品代號' value=$ProdId>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品名稱</label>
              <input type='text' class='form-control' name=ProdName id='ProdName' readonly placeholder='請輸入產品名稱' value=$ProdName>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>單價</label>
              <input type='text' class='form-control' name=UnitPrice id='UnitPrice' readonly placeholder='請輸入產品單價' value=$UnitPrice>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>成本</label>
              <input type='text' class='form-control' name=Cost id='Cost' readonly placeholder='請輸入產品成本' value=$Cost>
            </div>";
      echo "</form>";  
      echo "<form action=inv.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
      <input type='hidden' class='form-control' name=ProdId id='ProdId' readonly placeholder='請輸入產品代號' value=$ProdId>
    </div><div class='mb-3'>
            <label for='exampleFormControlInput1' class='form-label'>目前庫存量</label>
            <input type='text' class='form-control' name=Stock id='Stock' readonly placeholder='庫存數量' value=$Stock>
          </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>進貨量</label>
              <input type='text' class='form-control' name=Stock1 id='Stock1' placeholder='輸入進貨數量' value=$Stock1>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>安全存量</label>
              <input type='text' class='form-control' name=SafeStock id='SafeStock' readonly placeholder='安全庫存' value=$SafeStock>
            </div>";
      echo " <div class='col-auto'>
              <button type='submit' class='btn btn-primary mb-3'>進貨</button>           
              <button type='reset' class='btn btn-primary mb-3'>清除</button>                            
            </div>";
      echo "</form>"; 
  }
    if(isset($_REQUEST['op']))
    {
      $op=$_REQUEST['op'];   

      
      switch ($op)
      {
        case 1:
              $ProdId=$_REQUEST['ProdId']; 
               display_form($op,$ProdId);
              break;      
        case 2:
              $ProdId=$_REQUEST['ProdId'];
              $Stock=$_REQUEST['Stock'];
              $Stock1=$_REQUEST['Stock1'];
              $SafeStock=$_REQUEST['SafeStock'];

                  $sql="update inv 
                          set ProdId='$ProdId',
                              Stock='$Stock'+'$Stock1',
                              SafeStock='$SafeStock'
                        where ProdId='$ProdId'";
                  include("connectdb.php");
                  include('dbutil.php');
                  execute_sql($sql);
              break;
        case 3:
               $ProdId="";
                display_form($op,$ProdId);
              break;
        case 4:
              $ProdId=$_REQUEST['ProdId'];
              $Stock=$_REQUEST['Stock'];
              $SafeStock=$_REQUEST['SafeStock'];

              $sql="insert into inv (ProdId,Stock,SafeStock) values ('$ProdId','$Stock','$SafeStock')";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
              break;      
        case 5:            
              $ProdId=$_REQUEST['ProdId'];              
            
              $sql="delete from inv where ProdId='$ProdId'";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
              break;
      }      
  
    }
  ?>
    <!-- <p align=right>
    <a href=inv.php?op=3><button type='button' class='btn btn-success'>新增產品品項<i class='bi bi-alarm'></i></button></a>  </p> -->
    <table class="example">
  	<thead>
  		<tr>
  			<td>產品代號</td>
             <td>庫存量</td>
             <td>安全存量</td>  
             <td> 進貨</td>						
  		</tr>
  	</thead>
  	<tbody>
    <?php    
    include("connectdb.php");
    $sql = "SELECT * FROM inv,product where inv.ProdId=product.ProdId";
    $result =$connect->query($sql);
    while ($row = $result->fetch_assoc()) {
        $ProdId=$row['ProdId'];
        $Stock=$row['Stock'];
        $SafeStock=$row['SafeStock'];
        $ProdName=$row['ProdName'];
        $UnitPrice=$row['UnitPrice'];
        $Cost=$row['Cost'];
        echo "<tr><TD>$ProdId<td> $Stock<TD>$SafeStock";    
        echo "<TD><a href=inv.php?op=1&ProdId=$ProdId><button type='button' class='btn btn-success'>進貨 <i class='bi bi-alarm'></i></button></a>";
        // echo "<TD><a href=inv.php?op=1&ProdId=$ProdId><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
        // echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$ProdId]嗎?'))location='inv.php?ProdId=$ProdId&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
    }    
    ?>
</tbody>
  </table>
  </div>
  <script>
  	$( ".example" ).DataTable();
  </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
<?php
footer();
?>