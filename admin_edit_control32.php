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

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="container-fluid" style="background:#FFF">

<!--Header-->
<div class="page-header">
        <h3> <i class="fa fa-cog text-success"></i> Process </h3>
</div>

<?
include"config.php";

$sql="INSERT INTO controls (STAFFID, ch1, ch2, ch3, ch4, ch5, ch6, ch7, ch8, ch9, ch10, ch11, ch12, ch13, ch14, ch15, ch16, ch17, ch18) VALUES ($_POST[id], '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')";
//echo "$sql";
$res=@mysql_query($sql);

if($_FILES[ch17][name]!=""){
	$rand=rand(100001,999999) . ".pdf";
	@move_uploaded_file($_FILES[ch17][tmp_name],"file/$rand.pdf");
}else{
	$rand=$_POST[old];
}

for($i=0;$i<count($_POST[ch16]);$i++){
	$x .= $_POST[ch16][$i] . ",";
}

for($i=0;$i<count($_POST[ch18]);$i++){
	$y .= $_POST[ch18][$i] . ",";
}

$sql="update controls set ch11='$_POST[ch11]', ch12='$_POST[ch12]', ch13='$_POST[ch13]', ch14='$_POST[ch14]', ch15='$_POST[ch15]', ch16='$x', ch17='$rand', ch18='$y' where STAFFID=$_POST[id] ";
$res=mysql_query($sql)or die(mysql_error());
if($res){
	echo "<div class='alert alert-success'>";
	echo "<strong>Save SucceccFully</strong><br>";
	echo "</div>";
}else{
	echo "<div class='alert alert-danger'>";
	echo "<strong>Save Error !</strong> <br>";
	echo "<a href='javascript:history.go(-1)' class='btn btn-sm btn-info'>Back</a>";
	echo "</div>";
}
?>

</body>

</html>