<?php
session_start();
if($_SESSION['ss_status']!="admin"){
	echo "<script>location='index.php';</script>";
}
include"config.php";
?>
<!DOCTYPE html>
<html lang="th">

<head>

    <meta charset="windows-874">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Absent Database System</title>


</head>

<body>

<h3>ͧ §ҹػһԺѵԧҹͧҪ ѡҹԷ ١ҧШ ѡҹШӵѭ Шѹ <?=$_GET['id']?></h3>

<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border:1px solid #EEE;font-size:14px;">
  <tr>
    <th rowspan="2">ӴѺ</th>
    <th rowspan="2">-ʡ</th>
    <th rowspan="2">˹§ҹ</th>
    <th rowspan="2"></th>
    <th rowspan="2">͡</th>
    <th colspan="11">˵</th>
  </tr>
  <tr>
    <th>WFH</th> 
    <th>ҡԨ</th>
    <th>һ</th>
    <th>Ҿѡ͹</th>
    <th>Ҥʹص</th>
    <th>Ҫ</th>
    <th></th>
    <th>ŧ</th>
    <th>ŧ͡</th>
    <th>Ҵҹ</th>
    <th>ŧ͡͹ 16.30 </th>
  </tr>
<?php
$sql="select * from work1 A,staff B,department C where A.STAFFID=B.STAFFID and B.DEPARTMENTID=C.DEPARTMENTID and A.dated='{$_GET['id']}' and C.DEPARTMENTID not in (403,404,405) and B.STAFFNAME !='-' order by B.DEPARTMENTID";
$res=mysql_query($sql);
$i=0;
while($ln=@mysql_fetch_array($res)){
	$i++;
	$A=explode(":",$ln['timein']);
	$A1=(float)"{$A[0]}.{$A[1]}";
	$B=explode(":",$ln['timeout']);
	$B1=(float)"{$B[0]}.{$B[1]}";
	//chk absent 
	$sql1="select * from absent where STAFFID={$ln['STAFFID']} and '{$_GET['id']}' between date1 and date2";
	$res1=mysql_query($sql1);
	$rows=mysql_num_rows($res1);
	$ln1=mysql_fetch_array($res1);
?>  
  <tr>
    <td><?=$i?></td>
    <td><?=$ln['PREFIXNAME']?><?=$ln['STAFFNAME']?> <?=$ln['STAFFSURNAME']?></td>
    <td><?=$ln['DEPARTMENTNAME']?></td>
    <td><?=$A[0]?>.<?=$A[1]?></td>
    <td><?=$B[0]?>.<?=$B[1]?></td>
	<!--//////////////////////////////////////////////-->
    <td>
		<?php
		if($ln1['type']==8)echo"<img src='images/check.png'>";
		?>
	</td>	
    <td>
		<?php
		if($ln1['type']==2)echo"<img src='images/check.png'>";
		?>
	</td>
    <td>
		<?php
		if($ln1['type']==1)echo"<img src='images/check.png'>";
		?>
	</td>
    <td>
		<?php
		if($ln1['type']==3)echo"<img src='images/check.png'>";
		?>
	</td>
    <td>
		<?php
		if($ln1['type']==5)echo"<img src='images/check.png'>";
		?>
	</td>
    <td>
		<?php
		if($ln1['type']==4)echo"<img src='images/check.png'>";
		?>
	</td>
    <td>
		<?php
		if($A1>8.30)echo"<img src='images/check.png'>";
		?>
	</td>
    <td>
		<?php
		if($A1==0.0 && $B1!=0.0)echo"<img src='images/check.png'>";
		?>		
	</td>
    <td>&nbsp;</td>
    <td>
		<?php
		if($ln1['type']=="" && $A1==0.0 && $B1==0.0)echo"<img src='images/check.png'>";
		?>
	</td>
    <td>
		<?php
		if($A1!=0.0 && $B1<16.30)echo"<img src='images/check.png'>";
		?>
	</td>
  </tr>
<?php
}
?>  
</table>
</body>

</html>