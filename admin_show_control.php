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
                        <a href="admin_view_control.php"><i class="fa fa-fw fa-tag"></i> ทะเบียนคุมสัญญา พม. </a>
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
        <h3><i class="fa fa-fw fa-tag"></i> ข้อมูลทะเบียนคุมสัญญา พนักงานมหาวิทยาลัย </h3>
</div>

<?
include"config.php";

$_GET[id]=base64_decode($_GET[id]);

$sql="select * from staff A,department B where A.DEPARTMENTID=B.DEPARTMENTID and A.STAFFID=$_GET[id]";
//echo"$sql"; 
$res=mysql_query($sql);
$ln=mysql_fetch_array($res);
?>	
<!-- panel -->
<div class="panel panel-green">
       <div class="panel-heading">
              <h3 class="panel-title"> ข้อมูลส่วนตัว </h3>
       </div>
        <div class="panel-body">
              <table class="table">
              <tr>
              	<td bgcolor="#EEE" width="200">ชื่อ- สกุล</td>
                <td><?=$ln[STAFFNAME]?> <?=$ln[STAFFSURNAME]?></td>
              </tr>
              	<td bgcolor="#EEE">ตำแหน่ง</td>
                <td><?=$ln[POSITIONNAME]?></td> 
              </tr>              
              	<td bgcolor="#EEE">หน่วยงาน</td>
                <td><?=$ln[DEPARTMENTNAME]?></td>
              </tr>                                   
              	<td bgcolor="#EEE">กลุ่มบุคลากร</td>
                <td>
   
                </td>   
              </tr>                               
              	<td bgcolor="#EEE">เลขบัตรประชาชน</td>
                <td></td>  
              </tr>                               
              	<td bgcolor="#EEE">เลขที่ตำแหน่ง</td>
                <td></td>    
              </tr>                               
              	<td bgcolor="#EEE">วันที่เริ่มทำงาน</td>
                <td></td>   
              </tr>                              
              	<td bgcolor="#EEE">วันที่บรรจุ</td>
                <td></td>                
              </tr>              
          </table>
        </div>
</div>
 
    
	</div>
</div>


</div>
            <!-- /.container-fluid -->

</div>
        <!-- /#page-wrapper -->

</div>
    <!-- /#wrapper -->

</body>

</html>