
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

    <title>訂單管理</title>
  </head>
  <body>
<?php
head();
horizontal_bar();
menu("產品品項");
?>
 <?php

echo "歡迎 $username!!";

?>


    <h1>訂單管理</h1>
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
  
  function display_form($op,$OrderId)
  {

      if ($op==3)
      {
        $OrderId="";
        $ProdId="";
        $EmpId="";
        $CustId="";
        $Qty="";
        $OrderDate="";
        $Descript="";
        $op=4;

      }
      else
      {
        include("connectdb.php");
        $sql = "SELECT * FROM salesorder,orderdetail where salesorder.OrderId='$OrderId' and orderdetail.OrderId='$OrderId'";
        $result =$connect->query($sql);
        if ($row = $result->fetch_assoc()) {
          $OrderId=$row['OrderId'];
          $ProdId=$row['ProdId'];
          $EmpId=$row['EmpId'];
          $CustId=$row['CustId'];
          $Qty=$row['Qty'];
          $OrderDate=$row['OrderDate'];
          $Descript=$row['Descript'];
              }
                $op=2;
      }


      echo "<form action=salesorder.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>訂單編號</label>
              <input type='text' class='form-control' name=OrderId id='OrderId' placeholder='請輸入訂單編號' value=$OrderId>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品代號</label>
              <input type='text' class='form-control' name=ProdId id='ProdId' placeholder='請輸入產品代號' value=$ProdId>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>員工代號</label>
              <input type='text' class='form-control' name=EmpId id='EmpId' placeholder='請輸入員工代號' value=$EmpId>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>客戶代號</label>
              <input type='text' class='form-control' name=CustId id='CustId' placeholder='請輸入客戶代號' value=$CustId>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>數量</label>
              <input type='text' class='form-control' name=Qty id='Qty' placeholder='請輸入銷貨數量' value=$Qty>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>訂單日期</label>
              <input type='text' class='form-control' name=OrderDate id='OrderDate' placeholder='請輸入訂單日期' value=$OrderDate>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>備註</label>
              <input type='text' class='form-control' name=Descript id='Descript'placeholder='請輸入備註' value=$Descript>
            </div>";
      echo " <div class='col-auto'>
              <button type='submit' class='btn btn-primary mb-3'>儲存</button>           
              <button type='reset' class='btn btn-primary mb-3'>reset</button>                            
            </div>";
      echo "</form>";

  }


    if(isset($_REQUEST['op']))
    {
      $op=$_REQUEST['op'];   

      
      switch ($op)
      {
        case 1:
              $OrderId=$_REQUEST['OrderId']; 
               display_form($op,$OrderId);
              break;      
        case 2:
              $OrderId=$_REQUEST['OrderId'];
              $ProdId=$_REQUEST['ProdId'];
              $EmpId=$_REQUEST['EmpId'];
              $CustId=$_REQUEST['CustId'];
              $Qty=$_REQUEST['Qty'];
              $OrderDate=$_REQUEST['OrderDate'];
              $Descript=$_REQUEST['Descript'];
                  $sql="update salesorder 
                        set OrderId='$OrderId',
                        EmpId='$EmpId',
                        CustId='$CustId',
                        OrderDate='$OrderDate',
                        Descript='$Descript'
                        where OrderId='$OrderId'";
                  $sql1="update orderdetail 
                        set OrderId='$OrderId',
                        ProdId='$ProdId',
                        Qty='$Qty'
                        where OrderId='$OrderId'";                  
                  include("connectdb.php");
                  include('dbutil.php');
                  execute_sql($sql);
                  execute_sql($sql1);
              break;
        case 3:
               $OrderId="";
                display_form($op,$OrderId);
              break;
        case 4:
              $OrderId=$_REQUEST['OrderId'];
              $ProdId=$_REQUEST['ProdId'];
              $EmpId=$_REQUEST['EmpId'];
              $CustId=$_REQUEST['CustId'];
              $Qty=$_REQUEST['Qty'];
              $OrderDate=$_REQUEST['OrderDate'];
              $Descript=$_REQUEST['Descript'];
              $sql="insert into salesorder (OrderId,EmpId,CustId,OrderDate,Descript) values ('$OrderId','$EmpId','$CustId','$OrderDate','$Descript')";
              $sql1="insert into orderdetail (OrderId,ProdId,Qty) values ('$OrderId','$ProdId','$Qty')";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
              execute_sql($sql1);
              break;      
        case 5:            
              $OrderId=$_REQUEST['OrderId'];              
              $sql="delete from salesorder where OrderId='$OrderId'";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
              break;

      }      
  
    }
  ?>
    <p align=right>
    <a href=salesorder.php?op=3><button type='button' class='btn btn-success'>新增 <i class='bi bi-alarm'></i></button></a>  </p>
    <table class="example">
  	<thead>
  		<tr>
  			     <td>訂單編號</td>
             <td>產品代號</td>
             <td>員工代號</td>
             <td>客戶代號</td>  
             <td>銷貨數量</td>
             <td>訂單日期</td>
             <td>備註</td>
             <td>edit</td>			
             <td> delete</td>			
  		</tr>
  	</thead>
  	<tbody>
    <?php    
    include("connectdb.php");
    $sql = "SELECT * FROM salesorder,orderdetail where salesorder.OrderId=orderdetail.OrderId";
    $result =$connect->query($sql);
    while ($row = $result->fetch_assoc()) {
      $OrderId=$row['OrderId'];
      $ProdId=$row['ProdId'];
      $EmpId=$row['EmpId'];
      $CustId=$row['CustId'];
      $Qty=$row['Qty'];
      $OrderDate=$row['OrderDate'];
      $Descript=$row['Descript'];
        echo "<tr><TD>$OrderId<td>$ProdId<td>$EmpId<td>$CustId<td>$Qty<td>$OrderDate<td>$Descript";    
        echo "<TD><a href=salesorder.php?op=1&OrderId=$OrderId><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
        echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$ProdId]嗎?'))location='salesorder.php?OrderId=$OrderId&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
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