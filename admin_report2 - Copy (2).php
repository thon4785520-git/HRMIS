<?
session_start();
if($_SESSION[ss_status]!="admin"){
	echo "<script>location='index.php';</script>";
}
include"config.php";

// convert day
$d1=explode("-",$_POST[date1]);
$d2=explode("-",$_POST[date2]);
$_POST[date1]=$d1[2]-543 ."-$d1[1]-$d1[0]";
$_POST[date2]=$d2[2]-543 . "-$d2[1]-$d2[0]";
?>
<!DOCTYPE html>
<html lang="th">

<head>

    <meta charset="windows-874">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Absent Database System</title>

    <!-- jQuery -->
   <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap Theme CSS -->
    <link href="css/united.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

<!--begin validate-->
<script type="text/javascript" src="js/jquery.validate.js" charset="utf-8"></script>
<style type="text/css">
label.error{
color: red;
font-weight:bold;
font-size: 13px;
}
</style>
  <script>
  $(document).ready(function(){
    $("#form1").validate();
  });
  </script>
<!--end validate-->


    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admin.php"><b>Absent Database System</b></a>
            </div>
			<!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#"> <font color="#FFF"> <i class="fa fa-fw fa-user"></i> <?=$_SESSION[ss_name]?> </font> </a>                    
                </li>
			</ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">					
                    <li>
                        <a href="admin.php"><i class="fa fa-fw fa-home"></i> หน้าแรก </a>
                    </li>					
                    <li>
                        <a href="admin_view_work.php"><i class="fa fa-fw fa-desktop"></i> จัดการข้อมูลการปฏิบัติงาน </a>
                    </li>
                    <li>
                        <a href="admin_view_absent.php"><i class="fa fa-fw fa-edit"></i> จัดการข้อมูลการลา </a>
                    </li>
                    <li>
                        <a href="admin_report.php"><i class="fa fa-fw fa-table"></i> รายงานผลข้อมูล </a>
                    </li> 
					<li>
                        <a href="logout.php"><i class="fa fa-fw fa-lock"></i> ออกจากระบบ </a>
                    </li>                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

<div class="container-fluid">

<!-- ***** Content This Here ***** -->
<div id="zzz">
<strong>แบบรายงานข้อมูลการมาทำงาน และการลาต่าง ๆ</strong><br>
สังกัด 
<?
$sql="select * from department where DEPARTMENTID=$_POST[DEPARTMENTID]";
$res=mysql_query($sql);
$ln=mysql_fetch_array($res);
echo $ln[1]
?> <br>
<strong>เรื่อง</strong> รายงานสรุปการมาปฏิบัติราชการของข้าราชการ พนักงานมหาวิทยาลัย พนักงานราชการ ลูกจ้างประจำ และพนักงานประจำตามสัญญา
ตั้งแต่วันที่ <?=DateThai($_POST[date1])?> ถึง <?=DateThai($_POST[date2])?>
<br>
<strong>เรียน</strong> อธิการบดี
<br>
<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#000000">
  <tr>
    <th rowspan="2"><div align="center">ที่</div></th>
    <th rowspan="2"><div align="center">ชื่อ-สกุล</div></th>
    <th colspan="5"><div align="center">ประเภทบุคลากร</div></th>
    <th rowspan="2"><div align="center">ตำแหน่ง</div></th>
    <th><div align="center">มาสาย</div></th>
    <th colspan="2"><div align="center">ลากิจ</div></th>
    <th colspan="2"><div align="center">ลาป่วย</div></th>
    <th colspan="2"><div align="center">ลาพักผ่อน</div></th>
    <th><div align="center">ไม่เซ็นเข้า</div></th>
    <th><div align="center">ไม่เซ็นกลับ</div></th>
    <th colspan="2"><div align="center">ไปราชการ </div></th>
	<th colspan="2"><div align="center">ลาคลอด </div></th>
	<th colspan="2"><div align="center">ลาอุุปสมบท </div></th>
    </tr>
  <tr>
    <th><div align="center">ขร.</div></th>
    <th><div align="center">พม.</div></th>
    <th><div align="center">พร.</div></th>
    <th><div align="center">พส.</div></th>
    <th><div align="center">ลจ.</div></th>
    <th><div align="center">ครั้ง</div></th>
    <th><div align="center">ครั้ง</div></th>
    <th><div align="center">วัน</div></th>
    <th><div align="center">ครั้ง</div></th>
    <th><div align="center">วัน</div></th>
    <th><div align="center">ครั้ง</div></th>
    <th><div align="center">วัน</div></th>
    <th><div align="center">ครั้ง</div></th>
    <th><div align="center">ครั้ง</div></th>
    <th><div align="center">ครั้ง</div></th>
    <th><div align="center">วัน</div></th>
	<th><div align="center">ครั้ง</div></th>
    <th><div align="center">วัน</div></th>
	<th><div align="center">ครั้ง</div></th>
    <th><div align="center">วัน</div></th>
    </tr>
 <?
if($_POST[STAFFTYPE]==0)
	$sql="select * from staff where DEPARTMENTID=$_POST[DEPARTMENTID] order by STAFFNAME";
else
	$sql="select * from staff where DEPARTMENTID=$_POST[DEPARTMENTID] and STAFFTYPE=$_POST[STAFFTYPE] order by STAFFNAME";
	
$res=mysql_query($sql);
$j=0;
while($ln=mysql_fetch_array($res)){
	$i++;
?>
  <tr>
    <td><?=$i?></td>
    <td><?=$ln[PREFIXNAME]?><?=$ln[STAFFNAME]?> <?=$ln[STAFFSURNAME]?></td>
    <td><? if($ln[STAFFTYPE]==1)echo "<img src='images/tick.png'>";?></td>
	<td><? if($ln[STAFFTYPE]==4)echo "<img src='images/tick.png'>";?></td>
	<td><? if($ln[STAFFTYPE]==3)echo "<img src='images/tick.png'>";?></td>
	<td><? if($ln[STAFFTYPE]==5)echo "<img src='images/tick.png'>";?></td>
	<td><? if($ln[STAFFTYPE]==2)echo "<img src='images/tick.png'>";?></td>
    <td><?=$ln[POSITIONNAME]?></td>
    <td>
		<?
		$sql1="select * from work1 where STAFFID=$ln[STAFFID] and dated between '$_POST[date1]' and '$_POST[date2]' and timein > '8:30' ";
		$res1=mysql_query($sql1);
		$rows1=mysql_num_rows($res1);
		// chk mid day /////////////////////////////////////////////////////////////////
		$x=0;
		$y=0;
		$sql2="select * from absent where STAFFID=$ln[0] and date1 between '$_POST[date1]' and '$_POST[date2]' and amount=0.5";
		$res2=mysql_query($sql2);
		while($ln2=mysql_fetch_array($res2)){
			$x++;
			$y+=$ln2[amount];
		}		
		$rows1=$rows1-$y;
		if($rows1<0)$rows1=0;
		//////////////////////////////////////////////////////////////////////////////////////////
		echo "<center>$rows1</center>";
		?>	</td>
    <td>
	<?
	$x=0;
	$y=0;
	$sql1="select * from absent where STAFFID=$ln[0] and type=2 and date1 between '$_POST[date1]' and '$_POST[date2]' and approve=1";
	$res1=mysql_query($sql1);
	while($ln1=mysql_fetch_array($res1)){
		$x++;
		$y+=$ln1[amount];
	}
	echo "<center>".$x."</center>";
	?></td>
    <td><center><?=$y?></center></td>
    <td>
	<?
	$x=0;
	$y=0;
	$sql1="select * from absent where STAFFID=$ln[0] and type=1 and date1 between '$_POST[date1]' and '$_POST[date2]' and approve=1";
	$res1=mysql_query($sql1);
	while($ln1=mysql_fetch_array($res1)){
		$x++;
		$y+=$ln1[amount];
	}
	echo "<center>".$x."</center>";
	?></td>
    <td><center><?=$y?></center></td>
    <td>
	<?
	$x=0;
	$y=0;
	$sql1="select * from absent where STAFFID=$ln[0] and type=3 and date1 between '$_POST[date1]' and '$_POST[date2]' and approve=1";
	$res1=mysql_query($sql1);
	while($ln1=mysql_fetch_array($res1)){
		$x++;
		$y+=$ln1[amount];
	}
	echo "<center>".$x."</center>";
	?></td>
    <td><center><?=$y?></center></td>
    <td>
		<?
		$sql1="select * from work1 where STAFFID=$ln[STAFFID] and dated between '$_POST[date1]' and '$_POST[date2]' and timein = '00:00' and timeout != '00:00' and reason = '' ";
		$res1=mysql_query($sql1);
		$rows1=mysql_num_rows($res1);
		echo "<center>$rows1</center>";
		?></td>
    <td>
		<?
		$sql1="select * from work1 where STAFFID=$ln[STAFFID] and dated between '$_POST[date1]' and '$_POST[date2]' and timein > '00:00' and timeout = '00:00' and reason = '' ";
		$res1=mysql_query($sql1);
		$rows1=mysql_num_rows($res1);
		echo "<center>$rows1</center>";
		?>
		</td>
    <td>
	<?
	$x=0;
	$y=0;
	$sql1="select * from absent where STAFFID=$ln[0] and type=4 and date1 between '$_POST[date1]' and '$_POST[date2]' and approve=1";
	$res1=mysql_query($sql1);
	while($ln1=mysql_fetch_array($res1)){
		$x++;
		$y+=$ln1[amount];
	}
	echo "<center>".$x."</center>";
	?></td>
    <td><center><?=$y?></center></td>
	<td>
	<?
	$x=0;
	$y=0;
	$sql1="select * from absent where STAFFID=$ln[0] and type=5 and date1 between '$_POST[date1]' and '$_POST[date2]' and approve=1";
	$res1=mysql_query($sql1);
	while($ln1=mysql_fetch_array($res1)){
		$x++;
		$y+=$ln1[amount];
	}
	echo "<center>".$x."</center>";
	?></td>
    <td><center><?=$y?></center></td>
	<td>
	<?
	$x=0;
	$y=0;
	$sql1="select * from absent where STAFFID=$ln[0] and type=6 and date1 between '$_POST[date1]' and '$_POST[date2]' and approve=1";
	$res1=mysql_query($sql1);
	while($ln1=mysql_fetch_array($res1)){
		$x++;
		$y+=$ln1[amount];
	}
	echo "<center>".$x."</center>";
	?></td>
    <td><center><?=$y?></center></td>
    </tr>
<? }?>
</table>
</div>
<form name="form1" method="post" action="PDF/index.php">
<input type="hidden" name="xxx">
</form>

<br>
<a href="javascript:history.go(-1)" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Back</a> 
<a href="doc_report1.php?date1=<?=$_POST[date1]?>&date2=<?=$_POST[date2]?>&id=<?=$_POST[DEPARTMENTID]?>&type=<?=$_POST[STAFFTYPE]?>" class="btn btn-sm btn-success">
ส่งออกไฟล์ WORD <i class="fa fa-arrow-down"></i></a></div>
            <!-- /.container-fluid -->

</div>
        <!-- /#page-wrapper -->

</div>
    <!-- /#wrapper -->

</body>

</html>