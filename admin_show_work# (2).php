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
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Absent Database System</title>

    <!-- jQuery -->
   <script src="js/jquery.js"></script>
   
   <!-- css datepicker -->
    <link rel="stylesheet" href="jquery.datetimepicker.css">

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
                    <a href="#"> <font color="#FFF"> <i class="fa fa-fw fa-user"></i> <?=$_SESSION['ss_name']?> </font> </a>                    
                </li>
			</ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">					
                    <li>
                        <a href="admin.php"><i class="fa fa-fw fa-home"></i> ˹á </a>
                    </li>					
                    <li>
                        <a href="admin_view_work.php"><i class="fa fa-fw fa-desktop"></i> ѴâšûԺѵԧҹ </a>
                    </li>
                    <li>
                        <a href="admin_view_absent.php"><i class="fa fa-fw fa-edit"></i> Ѵâš </a>
                    </li>
                    <li>
                        <a href="admin_report.php"><i class="fa fa-fw fa-table"></i> §ҹŢ </a>
                    </li> 
					<li>
                        <a href="logout.php"><i class="fa fa-fw fa-lock"></i> ͡ҡк </a>
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
        <h3><i class="fa fa-file"></i> ŧ͡һԺѵԧҹ </h3>
</div>

<div class="well text-info"><strong>ѹ <?=DateThai($_GET['id'])?></strong></div>

<table class="table table-hover">
	<tr class="success">
		<th> - ʡ </th>
		<th>˹§ҹ</th>
		<th>ѹ/ Ժѵԧҹ</th>
		<th>ʶҹ</th>
	</tr>
<?php
$sql="select * from work1 A,staff B,department C where A.STAFFID=B.STAFFID and B.DEPARTMENTID=C.DEPARTMENTID and A.dated='{$_GET['id']}' order by B.DEPARTMENTID";
$res=mysql_query($sql);
$i=0;
while($ln=@mysql_fetch_array($res)){
	$i++;
?>
	<tr>
		<td><?=$ln['STAFFNAME']?> <?=$ln['STAFFSURNAME']?></td>
		<td>
			<?=$ln['DEPARTMENTNAME']?></td>
		<td><h5 class="bg-info"><?=$ln['dated']?></h5> <h5><?=$ln['timein']?> - <?=$ln['timeout']?></h5>
		</td>
		<td>
			<?php if(Timing($ln['timein']) != 0 && Timing($ln['timein']) < 8.31) echo  "<font color=green>һ</font>  ";?>
			<?php if(Timing($ln['timein']) != 0 && Timing($ln['timein']) > 8.30) echo  "<font color=red></font>  ";?>
			<?php if(Timing($ln['timein']) == 0 && Timing($ln['timeout']) == 0) echo  "<font color=maroon>һԺѵԧҹ</font>  ";?>
			<?php if(Timing($ln['timein']) == 0 && Timing($ln['timeout']) != 0) echo  "<font color=blue>繪</font>  ";?>
			<?php if(Timing($ln['timein']) > 0 && Timing($ln['timeout'])== 0) echo  "<font color=blue>繪͡Ѻ</font>  ";?>
			<?php
			//chk absent 
			$sql1="select * from absent where STAFFID={$ln['STAFFID']} and '{$_GET['id']}' between date1 and date2";
			//echo $sql1;
			$res1=mysql_query($sql1);
			$rows=mysql_num_rows($res1);
			//echo $rows;
			if($rows>0)
				echo "<br><font color=#9955ff>(ͧҡ/Ҫ)</font>";
			echo "<br><font color=darkpink><u>{$ln['reason']}</ul></font>";
			?>
		</td>
	</tr>
<?php }?>
</table>


</div>
            <!-- /.container-fluid -->

</div>
        <!-- /#page-wrapper -->

</div>
    <!-- /#wrapper -->

</body>

</html>