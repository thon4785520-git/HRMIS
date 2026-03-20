<?php
// กำหนด Header ให้เป็น Windows-874 เพื่อรองรับภาษาไทยในระบบเดิม
header('Content-Type: text/html; charset=windows-874');
session_start();

// ตรวจสอบสถานะ Admin
if($_SESSION['ss_status'] != "admin"){
	echo "<script>location='index.php';</script>";
    exit();
}

include "config.php"; 
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="windows-874">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Report System - Absent Database System</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Google Font: Kanit -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- CSS Datepicker (Old lib compatibility) -->
    <link rel="stylesheet" href="jquery.datetimepicker.css">

    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        /* Navbar Styling */
        .navbar-custom {
            background: linear-gradient(135deg, #003399 0%, #001f66 100%);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #fff !important;
        }
        .nav-link {
            color: rgba(255,255,255,0.8) !important;
        }
        .nav-link:hover {
            color: #fff !important;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: #fff;
            min-height: 100vh;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            padding-top: 20px;
        }
        .sidebar a {
            padding: 15px 20px;
            display: block;
            color: #555;
            text-decoration: none;
            font-weight: 500;
            border-left: 5px solid transparent;
            transition: all 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #f0f4ff;
            color: #003399;
            border-left-color: #003399;
        }
        .sidebar i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Content Area */
        .page-header {
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #003399;
        }

        /* Cards */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            transition: transform 0.2s;
        }
        .card-custom:hover {
            transform: translateY(-2px);
        }
        .card-header-blue {
            background: linear-gradient(45deg, #003399, #4d79ff);
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 15px 20px;
            font-weight: 600;
        }
        .card-header-green {
            background: linear-gradient(45deg, #28a745, #5dd879);
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 15px 20px;
            font-weight: 600;
        }

        /* Form Controls */
        .form-control {
            border-radius: 8px;
            height: calc(1.5em + 1rem + 2px);
            padding: 0.5rem 1rem;
        }
        .btn-custom {
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 500;
        }

        label.error {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 5px;
        }
    </style>

    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js" charset="utf-8"></script>
    
    <!-- JS Datepicker -->
    <script src="jquery.datetimepicker.full.js" charset="utf-8"></script>

    <script>
    $(document).ready(function(){
        $("#form1").validate();
        $("#form2").validate();
        
        // Datepicker Logic (Original Logic Preserved)
        $.datetimepicker.setLocale('th'); 

        function setupDatepicker(id) {
            $(id).datetimepicker({
                timepicker:false,
                format:'d-m-Y',  		
                lang:'th', 
                onSelectDate:function(dp,$input){
                    var yearT=new Date(dp).getFullYear()-0;  
                    var yearTH=yearT+543;
                    var fulldate=$input.val();
                    var fulldateTH=fulldate.replace(yearT,yearTH);
                    $input.val(fulldateTH);
                },
            });

            $(id).on("mouseenter mouseleave",function(e){
                var dateValue=$(this).val();
                if(dateValue!=""){
                    var arr_date=dateValue.split("-");  
                    if(e.type=="mouseenter"){
                        var yearT=arr_date[2]-543;
                    }		
                    if(e.type=="mouseleave"){
                        var yearT=parseInt(arr_date[2])+543;
                    }	
                    if(!isNaN(yearT)) { // Add check to prevent error on empty
                        dateValue=dateValue.replace(arr_date[2],yearT);
                        $(this).val(dateValue);
                    }													
                }		
            });
        }

        setupDatepicker("#date1");
        setupDatepicker("#date2");
        setupDatepicker("#date3");
        setupDatepicker("#date4");
    });
    </script>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874"></head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <a class="navbar-brand" href="admin.php">
            <i class="fas fa-calendar-check mr-2"></i> Absent DB
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-user-circle"></i> <?php echo $_SESSION['ss_name']; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid" style="margin-top: 70px;">
        <div class="row">
            
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse" id="sidebarMenu">
                <div class="position-sticky">
                    <div class="list-group list-group-flush">
                        <a href="admin.php"><i class="fas fa-home"></i> หน้าแรก</a>
                        <a href="admin_view_staff.php"><i class="fas fa-users"></i> ข้อมูลบุคลากร</a>
                        <a href="admin_view_work.php"><i class="fas fa-desktop"></i> ข้อมูลการปฏิบัติงาน</a>
                        <a href="admin_view_absent.php"><i class="fas fa-edit"></i> จัดการข้อมูลการลา</a>
                        <a href="admin_report.php" class="active"><i class="fas fa-chart-bar"></i> รายงานผลข้อมูล</a>
                        <a href="logout.php" class="text-danger"><i class="fas fa-lock"></i> ออกจากระบบ</a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 page-header">
                    <h1 class="h2"><i class="fas fa-chart-pie text-secondary"></i> ระบบรายงานผลข้อมูล</h1>
                </div>

                <div class="row">
                    <!-- Card 1: Report Absent -->
                    <div class="col-lg-6">
                        <div class="card card-custom">
                            <div class="card-header card-header-blue">
                                <i class="fas fa-file-alt"></i> รายงานข้อมูลการลา
                            </div>
                            <div class="card-body">
                                <form method="POST" action="admin_report2.php" id="form1" target="_blank">
                                    <div class="form-group">
                                        <label class="font-weight-bold">ประเภทบุคลากร</label>
                                        <select name="STAFFTYPE" class="form-control">
                                            <option value="0">--- แสดงทั้งหมด ---</option>
                                            <option value="1">ข้าราชการ</option>
                                            <option value="2">ลูกจ้างประจำ</option>
                                            <option value="3">พนักงานราชการ</option>
                                            <option value="4">พนักงานมหาวิทยาลัย</option>
                                            <option value="5">พนักงานประจำตามสัญญา</option>
                                            <option value="6">พนักงานจ้างเหมาบริการ</option>	
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold">หน่วยงาน</label>
                                        <select name="DEPARTMENTID" class="form-control">
                                            <option value="4785520">--- แสดงทั้งหมด ---</option>
                                            <?php
                                            $sql_dept="select * from department";
                                            $res_dept=mysql_query($sql_dept);
                                            while($ln_dept=mysql_fetch_array($res_dept)){
                                                echo "<option value='$ln_dept[0]'>$ln_dept[1]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold">ตั้งแต่วันที่</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" name="date1" id="date1" class="form-control required" autocomplete="off" placeholder="วว-ดด-ปปปป">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold">ถึงวันที่</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" name="date2" id="date2" class="form-control required" autocomplete="off" placeholder="วว-ดด-ปปปป">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary btn-custom shadow-sm"><i class="fas fa-search"></i> ดูรายงาน</button>
                                        <button type="reset" class="btn btn-secondary btn-custom shadow-sm ml-2"><i class="fas fa-undo"></i> ล้างค่า</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Report Work Attendance -->
                    <div class="col-lg-6">
                        <div class="card card-custom">
                            <div class="card-header card-header-green">
                                <i class="fas fa-clock"></i> รายงานข้อมูลการมาปฏิบัติงาน
                            </div>
                            <div class="card-body">
                                <form method="POST" action="admin_report3.php" id="form2" target="_blank">
                                    <div class="alert alert-light border mb-4">
                                        <i class="fas fa-info-circle text-success"></i> เลือกช่วงเวลาที่ต้องการตรวจสอบประวัติการลงเวลา
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold">ตั้งแต่วันที่</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-check"></i></span>
                                                </div>
                                                <input type="text" name="date1" id="date3" class="form-control required" autocomplete="off" placeholder="วว-ดด-ปปปป">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold">ถึงวันที่</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-check"></i></span>
                                                </div>
                                                <input type="text" name="date2" id="date4" class="form-control required" autocomplete="off" placeholder="วว-ดด-ปปปป">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3 pt-4">
                                        <button type="submit" class="btn btn-success btn-custom shadow-sm"><i class="fas fa-search"></i> ดูรายงาน</button>
                                        <button type="reset" class="btn btn-secondary btn-custom shadow-sm ml-2"><i class="fas fa-undo"></i> ล้างค่า</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
</body>
</html>