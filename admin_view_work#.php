<?
session_start();
if($_SESSION[ss_status]!="admin"){
	echo "<script>location='index.php';</script>";
}
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
                        <a href="admin_view_staff.php"><i class="fa fa-fw fa-user"></i> จัดการข้อมูลบุคลากร </a>
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

<!--Header-->
<div class="page-header">
        <h3><i class="fa fa-desktop"></i> จัดการข้อมูลการมาปฏิบัติงาน </h3>
</div>

<a href="admin_add_work.php" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> ลงชื่อมาปฏิบัติงาน </a> 
<a href="XLS/" class="btn btn-sm btn-info"><i class="fa fa-upload"></i> นำเข้าไฟล์ excel </a> 
<a href="admin_search_work.php" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> ค้นหาข้อมูลการมาปฏิบัติงาน</a> <br><br> 

<table class="table table-hover">
<tr class="success">
	<th>วันที่ปฏิบัติงาน</th>
	<th>มาปฏิบัติงาน (<font color="green">ปกติ</font>)</th>
	<th>มาปฏิบัติงาน (<font color="red">สาย</font>)</th>
	<th>ไม่มาปฏิบัติงาน</th>
	<th>วันหยุด</th>
	<th>ไม่เซ็นชื่อกลับ</th>
	<th width="125">Option</th>
</tr>
<?
include"config.php";

//$sql="select * from work group by dated order by dated DESC";
$sql="select DISTINCT dated from work order by dated DESC";
$res=mysql_query($sql)or die(mysql_error());
while($ln=mysql_fetch_array($res)){
	// count level 1
	$sql1="select count(*) from work where dated='$ln[dated]' and level=1";
	//echo $sql1;
	$res1=mysql_query($sql1);
	$ln1=mysql_fetch_array($res1);
	$y1=$ln1[0];
	// count level 2
	$sql1="select count(*) from work where dated='$ln[dated]' and level=2";
	$res1=mysql_query($sql1);
	$ln1=mysql_fetch_array($res1);
	$y2=$ln1[0];
	// count level 3
	$sql1="select count(*) from work where dated='$ln[dated]' and level=3";
	$res1=mysql_query($sql1);
	$ln1=mysql_fetch_array($res1);
	$y3=$ln1[0];
	// count level 4
	$sql1="select count(*) from work where dated='$ln[dated]' and level=4";
	$res1=mysql_query($sql1);
	$ln1=mysql_fetch_array($res1);
	$y4=$ln1[0];
	// count level 5
	$sql1="select count(*) from work where dated='$ln[dated]' and level=5";
	$res1=mysql_query($sql1);
	$ln1=mysql_fetch_array($res1);
	$y5=$ln1[0];
?>
<tr>
	<td> <?=DateThai($ln[dated])?> </td>
	<td><?=$y1?> คน</td>
	<td><?=$y2?> คน	</td>
	<td><?=$y3?> คน	</td>
	<td><?=$y4?> คน	</td>
	<td><?=$y5?> คน	</td>
	<td>   
		<a href="admin_show_work.php?id=<?=$ln[dated]?>" class="btn btn-sm btn-info" title="ดูข้อมูล"><i class="fa fa-file"></i></a>
		<a href="admin_edit_work.php?id=<?=$ln[dated]?>" class="btn btn-sm btn-warning" title="แก้ไข"><i class="fa fa-pencil"></i></a>
		<a href="admin_del_work.php?id=<?=$ln[dated]?>" class="btn btn-sm btn-danger" title="ลบ" onClick="return confirm('แน่ใจว่าลบ?')"><i class="fa fa-close"></i></a>
	</td>
</tr>
<? }?>
</table>

</div>
            <!-- /.container-fluid -->

</div>
        <!-- /#page-wrapper -->

</div>
    <!-- /#wrapper -->

</body>

</html>