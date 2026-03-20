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
    <title>Search Work - Absent Database System</title>

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
        
        /* Table */
        .table thead th {
            border-top: none;
            border-bottom: 2px solid #003399;
            color: #003399;
            background-color: #f8f9fa;
            font-weight: 600;
            vertical-align: middle;
        }
        .table-hover tbody tr:hover {
            background-color: #f0f4ff;
        }

        /* Status Badges */
        .badge-status {
            font-size: 0.85rem;
            padding: 0.5em 0.8em;
            border-radius: 20px;
        }
        .badge-soft-success { background-color: rgba(40, 167, 69, 0.15); color: #28a745; }
        .badge-soft-danger { background-color: rgba(220, 53, 69, 0.15); color: #dc3545; }
        .badge-soft-warning { background-color: rgba(255, 193, 7, 0.15); color: #856404; }
        .badge-soft-info { background-color: rgba(23, 162, 184, 0.15); color: #17a2b8; }
        .badge-soft-secondary { background-color: rgba(108, 117, 125, 0.15); color: #6c757d; }
        .badge-soft-purple { background-color: rgba(111, 66, 193, 0.15); color: #6f42c1; }

    </style>

    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js" charset="utf-8"></script>
    <script>
        $(document).ready(function(){
            $("#form1").validate();
        });

        function thon(url){
            // Open popup logic from original
            window.open(url, "mywindow", "width=600,height=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes");
        }
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
                        <a href="admin_report.php"><i class="fas fa-chart-bar"></i> รายงานผลข้อมูล</a>
                        <a href="logout.php" class="text-danger"><i class="fas fa-lock"></i> ออกจากระบบ</a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 page-header">
                    <h1 class="h2"><i class="fas fa-search text-primary"></i> ค้นหาข้อมูลการมาปฏิบัติงาน</h1>
                </div>

                <!-- Search Form -->
                <div class="card card-custom">
                    <div class="card-body">
                        <form method="POST" action="" id="form1">
                            <div class="form-row align-items-end">
                                <div class="col-md-3 mb-3">
                                    <label class="font-weight-bold">ค้นหาโดย</label>
                                    <select name="search" class="form-control custom-select">
                                        <option value="STAFFNAME">ชื่อ - สกุล บุคลากร</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">คำค้นหา (Keyword)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                                        </div>
                                        <input type="text" name="key" class="form-control required" placeholder="ระบุคำค้นหา..." required>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="btn-group w-100" role="group">
                                        <button type="submit" class="btn btn-primary shadow-sm"><i class="fas fa-search"></i> ค้นหา</button>
                                        <button type="reset" class="btn btn-warning text-white shadow-sm"><i class="fas fa-undo"></i> รีเซ็ต</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php
                if(isset($_POST['search']) && isset($_POST['key'])){
                    $search = mysql_real_escape_string($_POST['search']);
                    $key = mysql_real_escape_string($_POST['key']);
                ?>

                <!-- Result 1: Support Staff (Work1) -->
                <div class="card card-custom">
                    <div class="card-header card-header-blue">
                        <i class="fas fa-user-cog"></i> สายสนับสนุน (ลงเวลาปฏิบัติงาน)
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="25%">ชื่อ - สกุล</th>
                                        <th width="20%">หน่วยงาน</th>
                                        <th width="20%">วันที่/เวลา</th>
                                        <th width="35%">สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql="select * from work1 A,staff B,department C where A.STAFFID=B.STAFFID and B.DEPARTMENTID=C.DEPARTMENTID and $search like '%$key%' order by A.dated DESC";
                                    $res=mysql_query($sql);
                                    
                                    if(mysql_num_rows($res) > 0) {
                                        while($ln=mysql_fetch_array($res)){
                                            $A=explode(":",$ln['timein']);
                                            $A1=(float)"$A[0].$A[1]";
                                            $B=explode(":",$ln['timeout']);
                                            $B1=(float)"$B[0].$B[1]";
                                    ?>
                                    <tr>
                                        <td class="font-weight-bold text-primary">
                                            <?php echo $ln['STAFFNAME'] . " " . $ln['STAFFSURNAME']; ?>
                                        </td>
                                        <td><?php echo $ln['DEPARTMENTNAME']; ?></td>
                                        <td>
                                            <h6 class="mb-0 text-dark font-weight-bold"><?php echo DateThai($ln['dated']); ?></h6>
                                            <small class="text-muted"><i class="far fa-clock"></i> <?php echo $ln['timein'] . " - " . $ln['timeout']; ?></small>
                                        </td>
                                        <td>
                                            <?php
                                            if($A1 != 0.0 && $A1<=8.30 && $B1>=16.30 && $B1 != 0.0) echo "<span class='badge badge-status badge-soft-success'><i class='fas fa-check-circle'></i> มาปกติ</span>";			
                                            if($A1>8.30) echo "<span class='badge badge-status badge-soft-danger'><i class='fas fa-exclamation-circle'></i> สาย</span>";
                                            if($A1==0.0 && $B1!=0.0) echo "<span class='badge badge-status badge-soft-warning'>ไม่ลงชื่อเข้า</span>";
                                            if($A1==0.0 && $B1==0.0) echo "<span class='badge badge-status badge-soft-secondary'>ขาดงาน</span>";
                                            if($A1!=0.0 && $B1<16.30 && $B1!=0.0) echo "<span class='badge badge-status badge-soft-info'>ลงชื่อออกก่อน</span>";
                                            if($A1!=0.0 && $B1==0.0) echo "<span class='badge badge-status badge-soft-info'>ไม่ลงชื่อออก</span>";			
                                            
                                            // Check Absent Record
                                            $sql1="select * from absent where STAFFID=$ln[STAFFID] and '$ln[dated]' between date1 and date2";
                                            $res1=mysql_query($sql1);
                                            if(mysql_num_rows($res1) > 0) {
                                                echo "<div class='mt-1'><span class='badge badge-status badge-soft-purple'><i class='fas fa-briefcase'></i> ลา/ราชการ/WFH</span></div>";
                                            }
                                            if($ln['reason'] != "") echo "<div class='small text-muted mt-1'><i class='fas fa-comment'></i> " . $ln['reason'] . "</div>";
                                            ?>
                                        </td>
                                    </tr>
                                    <?php 
                                        } 
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center py-3 text-muted'>ไม่พบข้อมูล</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Result 2: Academic Staff (Work - Level Based) -->
                <div class="card card-custom">
                    <div class="card-header card-header-green">
                        <i class="fas fa-chalkboard-teacher"></i> สายวิชาการ (ลงนามปฏิบัติงาน)
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="25%">ชื่อ - สกุล</th>
                                        <th width="20%">หน่วยงาน</th>
                                        <th width="20%">วันที่ปฏิบัติงาน</th>
                                        <th width="35%">สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql="select * from work A,staff B,department C where A.STAFFID=B.STAFFID and C.DEPARTMENTID=B.DEPARTMENTID and $search like '%$key%' order by dated DESC";
                                    $res=mysql_query($sql);
                                    
                                    if(mysql_num_rows($res) > 0) {
                                        while($ln=mysql_fetch_array($res)){
                                    ?>
                                    <tr>
                                        <td class="font-weight-bold text-success">
                                            <?php echo $ln['STAFFNAME'] . " " . $ln['STAFFSURNAME']; ?>
                                        </td>
                                        <td><?php echo $ln['DEPARTMENTNAME']; ?></td>
                                        <td>
                                            <h6 class="mb-0 font-weight-bold"><?php echo DateThai($ln['dated']); ?></h6>
                                            <a href="javascript:thon('boss_cog_work.php?id=<?php echo base64_encode($ln['STAFFID']); ?>&di=<?php echo base64_encode($ln['dated']); ?>')" class="btn btn-sm btn-outline-warning mt-1 py-0 px-2" title="แก้ไขสถานะ">
                                                <i class="fas fa-edit"></i> แก้ไข
                                            </a>
                                        </td>
                                        <td>
                                            <?php 
                                            if($ln['level']==1) echo "<span class='badge badge-status badge-soft-success'><i class='fas fa-check-circle'></i> มาปกติ</span>";
                                            if($ln['level']==2) echo "<span class='badge badge-status badge-soft-danger'><i class='fas fa-exclamation-circle'></i> มาสาย</span>";
                                            if($ln['level']==3) echo "<span class='badge badge-status badge-soft-secondary'><i class='fas fa-times-circle'></i> ไม่มาปฏิบัติงาน</span>";
                                            if($ln['level']==5) echo "<span class='badge badge-status badge-soft-info'><i class='fas fa-question-circle'></i> ไม่เซ็นชื่อเข้า</span>";
                                            
                                            // Check Absent Record
                                            $sql1="select * from absent where STAFFID=$ln[STAFFID] and '$ln[dated]' between date1 and date2";
                                            $res1=mysql_query($sql1);
                                            if(mysql_num_rows($res1) > 0) {
                                                echo "<div class='mt-1'><span class='badge badge-status badge-soft-purple'><i class='fas fa-briefcase'></i> ลา/ราชการ</span></div>";
                                            }
                                            if($ln['reason'] != "") echo "<div class='small text-muted mt-1'><i class='fas fa-comment'></i> " . $ln['reason'] . "</div>";
                                            ?>
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center py-3 text-muted'>ไม่พบข้อมูล</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <?php 
                } // End if POST
                ?>

            </main>
        </div>
    </div>
</body>
</html>