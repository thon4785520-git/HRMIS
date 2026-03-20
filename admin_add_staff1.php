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
    <title>Add Staff - Absent Database System</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Google Font: Kanit -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;700&display=swap" rel="stylesheet">

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

        /* Card Form */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .card-header-custom {
            background: linear-gradient(45deg, #28a745, #5dd879);
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 15px 20px;
            font-weight: 600;
        }

        /* Form Controls */
        .form-control {
            border-radius: 6px;
        }
        
        /* Section Dividers */
        .form-section-title {
            font-size: 1rem;
            color: #003399;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
            margin-bottom: 15px;
            margin-top: 10px;
            font-weight: 600;
        }

        label.error {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
        }
    </style>

    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js" charset="utf-8"></script>

    <script>
    $(document).ready(function(){
        $("#form1").validate();
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
                        <a href="admin_view_control.php"><i class="fas fa-file-contract"></i> ทะเบียนคุมสัญญา พม.</a>
                        <a href="admin_view_work.php"><i class="fas fa-desktop"></i> ข้อมูลการปฏิบัติงาน</a>
                        <a href="admin_view_absent.php"><i class="fas fa-edit"></i> จัดการข้อมูลการลา</a>
                        <a href="admin_report.php"><i class="fas fa-chart-bar"></i> รายงานผลข้อมูล</a>
                        <a href="logout.php" class="text-danger"><i class="fas fa-lock"></i> ออกจากระบบ</a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 page-header">
                    <h1 class="h2"><i class="fas fa-user-plus text-success"></i> เพิ่มข้อมูลบุคลากรใหม่</h1>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card card-custom">
                            <div class="card-header card-header-custom">
                                <i class="fas fa-address-card"></i> แบบฟอร์มลงทะเบียนบุคลากร
                            </div>
                            <div class="card-body">
                                <form method="POST" action="admin_add_staff2.php" id="form1">
                                    
                                    <div class="form-section-title"><i class="fas fa-building"></i> ข้อมูลสังกัดและเข้าสู่ระบบ</div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>หน่วยงาน <span class="text-danger">*</span></label>
                                            <select name="DEPARTMENTID" class="form-control required">
                                                <option value="">--- เลือกหน่วยงาน ---</option>
                                                <?php
                                                $sql="select * from department";
                                                $res=mysql_query($sql);
                                                while($ln=mysql_fetch_array($res)){
                                                    echo "<option value='$ln[0]'>$ln[1]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Username (ตามระบบ MIS) <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user-lock"></i></span></div>
                                                <input class="form-control required" type="text" name="USERLOGIN" placeholder="กรอก Username">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-section-title"><i class="fas fa-id-card"></i> ข้อมูลส่วนตัว</div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label>คำนำหน้า <span class="text-danger">*</span></label>
                                            <input class="form-control required" type="text" name="PREFIXNAME" placeholder="นาย/นาง/นางสาว">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>ชื่อ <span class="text-danger">*</span></label>
                                            <input class="form-control required" type="text" name="STAFFNAME" placeholder="ระบุชื่อจริง">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>นามสกุล <span class="text-danger">*</span></label>
                                            <input class="form-control required" type="text" name="STAFFSURNAME" placeholder="ระบุนามสกุล">
                                        </div>
                                    </div>

                                    <div class="form-section-title"><i class="fas fa-briefcase"></i> ข้อมูลตำแหน่งงาน</div>
                                    <div class="form-group">
                                        <label>ตำแหน่ง <span class="text-danger">*</span></label>
                                        <input class="form-control required" type="text" name="POSITIONNAME" placeholder="ระบุตำแหน่งงาน">
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>ประเภทบุคลากร</label>
                                            <select name="STAFFTYPE" class="form-control">
                                                <?php
                                                $sql_type="select * from type";
                                                $res_type=mysql_query($sql_type);
                                                while($ln=mysql_fetch_array($res_type)){
                                                    echo "<option value='$ln[0]'>$ln[1]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>สายปฏิบัติการ</label>
                                            <select name="STAFFGROUP" class="form-control">
                                                <option value="1">อาจารย์</option>
                                                <option value="2">สนับสนุน</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-success btn-lg shadow px-5"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
                                        <button type="reset" class="btn btn-warning btn-lg shadow px-5 text-white ml-3"><i class="fas fa-undo"></i> รีเซ็ต</button>
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