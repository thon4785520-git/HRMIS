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
                        <a href="admin_view_staff.php"><i class="fa fa-fw fa-user"></i> Ѵâźؤҡ </a>
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
        <h3><i class="fa fa-plus"></i> ŧ͡һԺѵԧҹ </h3>
</div>

<?php
if($_POST['date1']=="")
	$_POST['date1']=date("d")."-" . date("m") . "-" . (date("Y")+543);
?>

<!-- form -->
<FORM METHOD="POST" ACTION="" id="form1">
ͧؤҡ
<select name="STAFFTYPE">
	<option value="0" <?php if($_POST['STAFFTYPE']==0)echo "selected";?>> *  *</option>
	<option value="1" <?php if($_POST['STAFFTYPE']==1)echo "selected";?>> Ҫ </option>
	<option value="2" <?php if($_POST['STAFFTYPE']==2)echo "selected";?>> ١ҧШ </option>
	<option value="3" <?php if($_POST['STAFFTYPE']==3)echo "selected";?>> ѡҹҪ </option>
	<option value="4" <?php if($_POST['STAFFTYPE']==4)echo "selected";?>> ѡҹԷ </option>
	<option value="5" <?php if($_POST['STAFFTYPE']==5)echo "selected";?>> ѡҹШӵѭ </option>
</select>
˹§ҹ 
<select name="DEPARTMENTID" style="width:200px;">
	<?php
	include"config.php";
	$sql="select * from department";
	$res=mysql_query($sql);
	while($ln=mysql_fetch_array($res)){
		if($_POST['DEPARTMENTID']==$ln[0])
			echo "<option value='{$ln[0]}' selected>{$ln[1]}";
		else
			echo "<option value='{$ln[0]}'>{$ln[1]}";
	}
	?>
</select>
»Ժѵԡ
<select name="STAFFGROUP">
	<option value="2" <?php if($_POST['STAFFGROUP']==2)echo "selected";?>> ʹѺʹع </option>
	<option value="1" <?php if($_POST['STAFFGROUP']==1)echo "selected";?>> Ԫҡ </option>
</select>
ѹ軯Ժѵԧҹ <input type="text" name="date1" id="date1" size="7" class="required" title=" * " value="<?=$_POST['date1']?>"> &nbsp;&nbsp;

<!-- js datepicker -->  
<script src="jquery.datetimepicker.full.js" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">   
$(function(){
	
	$.datetimepicker.setLocale('th'); 
	

    $("#date1").datetimepicker({
        timepicker:false,
        format:'d-m-Y',  		
		//format:'Y-m-d',
        lang:'th', 
		onSelectDate:function(dp,$input){
			var yearT=new Date(dp).getFullYear()-0;  
			var yearTH=yearT+543;
			var fulldate=$input.val();
			var fulldateTH=fulldate.replace(yearT,yearTH);
			$input.val(fulldateTH);
		},
    });    
	 
	$("#date1").on("mouseenter mouseleave",function(e){
		var dateValue=$(this).val();
		if(dateValue!=""){
				var arr_date=dateValue.split("-");  
				if(e.type=="mouseenter"){
					var yearT=arr_date[2]-543;
				}		
				if(e.type=="mouseleave"){
					var yearT=parseInt(arr_date[2])+543;
				}	
				dateValue=dateValue.replace(arr_date[2],yearT);
				$(this).val(dateValue);													
		}		
	});
    
});
</script> 

<INPUT TYPE="submit" class="btn btn-sm btn-success" value="View">
<INPUT TYPE="reset" class="btn btn-sm btn-warning" value="Reset">

</FORM>

<!-- form -->
<FORM METHOD="POST" ACTION="admin_add_work2.php" id="form2" name="form2">
<input type="hidden" name="dated" value="<?=$_POST['date1']?>">
<br>
<table class="table table-hover">
	<tr class="success">
		<th> - ʡ </th>
		<th>ؤҡ</th>
		<th>һԺѵԧҹ (<font color="green"></font>)</th>
		<th>һԺѵԧҹ (<font color="red"></font>)</th>
		<th>һԺѵԧҹ</th>
		<th>ѹش</th>
		<th>繪͡Ѻ</th>
	</tr>
<?php
if($_POST['STAFFTYPE'] != 0)
	$sql="select * from staff where STAFFTYPE={$_POST['STAFFTYPE']} and DEPARTMENTID={$_POST['DEPARTMENTID']} and STAFFGROUP={$_POST['STAFFGROUP']} order by STAFFNAME";
else
	$sql="select * from staff where DEPARTMENTID={$_POST['DEPARTMENTID']} and STAFFGROUP={$_POST['STAFFGROUP']} order by STAFFNAME";

$res=mysql_query($sql);
$i=0;
while($ln=@mysql_fetch_array($res)){
	$i++;
?>
	<input type="hidden" name="STAFFID[<?=$i?>]" value="<?=$ln['STAFFID']?>">
	<tr>
		<td><?=$ln['STAFFNAME']?> <?=$ln['STAFFSURNAME']?></td>
		<td>
			<?php
			$x=array("","Ҫ","١ҧШ","ѡҹҪ","ѡҹԷ","ѡҹШӵѭ");
			echo $x[$ln['STAFFTYPE']];
			?>
		</td>
		<td><input type="radio" name="level[<?=$i?>]" value="1" checked="checked"></td>
		<td><input type="radio" name="level[<?=$i?>]" value="2"></td>
		<td><input type="radio" name="level[<?=$i?>]" value="3"></td>
		<td><input type="radio" name="level[<?=$i?>]" value="4"></td>
		<td><input type="radio" name="level[<?=$i?>]" value="5"></td>
	</tr>
<?php }?>
</table>

<INPUT TYPE="submit" class="btn btn-success" value="Save">
<INPUT TYPE="reset" class="btn btn-warning" value="Reset">
</FORM>

</div>
            <!-- /.container-fluid -->

</div>
        <!-- /#page-wrapper -->

</div>
    <!-- /#wrapper -->

</body>

</html>