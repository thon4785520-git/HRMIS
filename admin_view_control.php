<?php
session_start();
if($_SESSION['ss_status']!="admin"){
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

<!--begin color box-->		
		<link rel="stylesheet" href="colorbox.css" />
		<script src="jquery.colorbox.min.js"></script>
		<script>
			$(document).ready(function(){
				$(".photo").colorbox({rel:'group1'});				
				$(".jax").colorbox({iframe:true, width:"800", height:"600"});
			});
		</script>
<!--end color box-->

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
                        <a href="admin_view_staff.php"><i class="fa fa-fw fa-user"></i> Ѵâźؤҡ </a>
                    </li>	
					<li>
                        <a href="admin_view_control.php"><i class="fa fa-fw fa-tag"></i> ¹ѭ . </a>
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
        <h3><i class="fa fa-fw fa-tag"></i> ¹ѭ ѡҹԷ </h3>
</div>

<a href="admin_view_alert.php" class="btn btn-sm btn-primary"><i class="fa fa-info"></i> ͹ѭ</a> 
<br><br>

<!-- form -->
<FORM METHOD="POST" ACTION="" id="form1" class="well jumbotron">

س͡˹§ҹ 
<select name="DEPARTMENTID">
<option value="4785520"> *  *
	<?php
	include"config.php";
	$sql="select * from department";
	$res=mysql_query($sql);
	while($ln=mysql_fetch_array($res)){
		if($_POST['DEPARTMENTID']==$ln[0])
			echo "<option value={$ln[0]} selected>{$ln[1]}";
		else
			echo "<option value={$ln[0]} >{$ln[1]}";		
	}
	?>
</select>

<INPUT TYPE="button" class="btn btn-success" value="Display" onClick="this.form.target='_self';this.form.action='admin_view_control.php';this.form.submit();">
<INPUT TYPE="button" class="btn btn-warning" value="Report" onClick="this.form.target='_blank';this.form.action='admin_report_control.php';this.form.submit();">
</FORM>

<table class="table table-hover">
<tr class="success">
	<th>Ţ˹</th>
	<th> - ʡ</th>
	<th>˹</th>
	<th width="160">Manage 1</th>
	<th width="160"> </th>    
</tr>
<?php
//include"config.php";
if($_POST['DEPARTMENTID']==4785520)
	$sql="select * from staff where STAFFTYPE=4 order by STAFFNAME";
else
	$sql="select * from staff where DEPARTMENTID={$_POST['DEPARTMENTID']} and STAFFTYPE=4 order by STAFFNAME";
$res=mysql_query($sql);
while($ln=mysql_fetch_array($res)){
	
?>
<tr>
	<td><?=$ln['STAFFNO']?> </td>
	<td> <?=$ln['PREFIXNAME']?><?=$ln['STAFFNAME']?> <?=$ln['STAFFSURNAME']?> </td>
	<td><?=$ln['POSITIONNAME']?> </td>
	<td>   
	<a class="jax" href="admin_edit_personnel.php?id=<?=base64_encode($ln[0])?>"><i class="fa fa-fw fa-edit" style="color:deeppink"></i> 
    ǹ</a><br>
	<a class="jax" href="admin_edit_control1.php?id=<?=base64_encode($ln[0])?>"><i class="fa fa-fw fa-edit" style="color:darkviolet"></i> 
    6 ͹駷 1</a><br>
	<a class="jax" href="admin_edit_control2.php?id=<?=base64_encode($ln[0])?>"><i class="fa fa-fw fa-edit" style="color:green"></i> 
    6 ͹駷 2</a><br>
	<a class="jax" href="admin_edit_control3.php?id=<?=base64_encode($ln[0])?>"><i class="fa fa-fw fa-edit" style="color:orangered"></i> 
    Сèҧ駷 2</a><br>
	<a class="jax" href="admin_edit_control4.php?id=<?=base64_encode($ln[0])?>"><i class="fa fa-fw fa-edit" style="color:blue"></i> 
    Сèҧ駷 3</a><br>
	</td>
	<td>   
	<a class="jax" href="admin_edit_control5.php?id=<?=base64_encode($ln[0])?>"><i class="fa fa-fw fa-edit" style="color:darkviolet"></i> 
    Сèҧ駷 4</a><br>
	<a class="jax" href="admin_edit_control6.php?id=<?=base64_encode($ln[0])?>"><i class="fa fa-fw fa-edit" style="color:maroon"></i> 
    Сèҧ駷 5</a><br>
	<a class="jax" href="admin_edit_control7.php?id=<?=base64_encode($ln[0])?>"><i class="fa fa-fw fa-edit" style="color:steelblue"></i> 
    Сèҧ駷 6</a><br>            
	</td>
    
</tr>
<?php }?>
</table>
	
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