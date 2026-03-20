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
    <link href="css/clean.css" rel="stylesheet">

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

<!--begin calendar-->
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">      
window.onload = function () {	
	dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('dated'));	
};
</script>
<!--end calendar-->

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
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
        <h3> แก้ไขการมาปฏิบัติงาน </h3>
</div>

<?
include"config.php";
$sql="select * from abwork where dated='$_GET[id]' ";
$res=mysql_query($sql);
$data=mysql_fetch_array($res);
$x=explode(",",$data[researcher]);
?>

<form action="admin_edit_abwork2.php" method="post" name="form1" id="form1">

<div class="form-group">
         <label>วันที่ปฏิบัติงาน</label>
         <input class="form-control required" type="text" name="dated" id="dated" value="<?=$data[dated]?>">
</div>

<table class="table table-hover">
<tr class="success">
	<th>ชื่อ - สกุล</th>
	<th>ลงชื่อ</th>
</tr>
<?
//include"config.php";
$sql="select * from researcher where department_id=9 order by name_th";
$res=mysql_query($sql);
while($ln=mysql_fetch_array($res)){
?>
<tr>
	<td><?=$ln[name_th]?></td>
	<td><input type="checkbox" name="ch[]" value="<?=$ln[0]?>" <? if(in_array($ln[0],$x)) echo "checked";?>></td>
</tr>
<? }?>
</table>

<INPUT TYPE="submit" class="btn btn-success" value="Save">
<INPUT TYPE="reset" class="btn btn-warning" value="Reset">

</form>

</div>
            <!-- /.container-fluid -->

</div>
        <!-- /#page-wrapper -->

</div>
    <!-- /#wrapper -->

</body>

</html>