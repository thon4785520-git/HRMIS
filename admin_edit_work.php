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

// ดึงวันที่จาก GET
$date_show = isset($_GET['id']) ? $_GET['id'] : date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="windows-874">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Works - Absent Database System</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Google Font: Kanit -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Colorbox CSS (Keep original if compatible or update path) -->
    <link rel="stylesheet" href="colorbox.css" />

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

        /* Card */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .card-header-custom {
            background-color: #fff;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            color: #003399;
            padding: 15px 20px;
            border-radius: 12px 12px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            padding: 0.4em 0.8em;
            border-radius: 20px;
        }
        .badge-soft-success { background-color: rgba(40, 167, 69, 0.15); color: #28a745; }
        .badge-soft-danger { background-color: rgba(220, 53, 69, 0.15); color: #dc3545; }
        .badge-soft-warning { background-color: rgba(255, 193, 7, 0.15); color: #856404; }
        .badge-soft-info { background-color: rgba(23, 162, 184, 0.15); color: #17a2b8; }
        .badge-soft-secondary { background-color: rgba(108, 117, 125, 0.15); color: #6c757d; }
        .badge-soft-purple { background-color: rgba(111, 66, 193, 0.15); color: #6f42c1; }

        /* Time Block */
        .time-block {
            background-color: #e3f2fd;
            color: #0d47a1;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: 500;
            display: inline-block;
        }

    </style>

    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="jquery.colorbox.min.js"></script>
    
    <script>
        $(document).ready(function(){
            $(".jax").colorbox({iframe:true, width:"80%", height:"80%", maxWidth:"750px", maxHeight:"650px"});
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
                        <a href="admin_report.php"><i class="fas fa-chart-bar"></i> รายงานผลข้อมูล</a>
                        <a href="logout.php" class="text-danger"><i class="fas fa-lock"></i> ออกจากระบบ</a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 page-header">
                    <h1 class="h2"><i class="fas fa-edit text-info"></i> แก้ไขการลงชื่อการมาปฏิบัติงาน</h1>
                </div>

                <div class="card card-custom">
                    <div class="card-header card-header-custom">
                        <span><i class="fas fa-calendar-day"></i> ประจำวันที่ <span class="text-primary"><?php echo DateThai($date_show); ?></span></span>
                        <a href="admin_view_work.php" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="30%">ชื่อ - สกุล / จัดการ</th>
                                        <th width="20%">หน่วยงาน</th>
                                        <th width="20%">วันที่/เวลา</th>
                                        <th width="15%">สถานะ</th>
                                        <th width="15%">เหตุผล</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql="select * from work1 A,staff B,department C where A.STAFFID=B.STAFFID and B.DEPARTMENTID=C.DEPARTMENTID and A.dated='$date_show' ";
                                    $res=mysql_query($sql);
                                    
                                    if(mysql_num_rows($res) > 0) {
                                        while($ln=mysql_fetch_array($res)){
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="font-weight-bold text-primary mb-1">
                                                <?php echo $ln['STAFFNAME'] . " " . $ln['STAFFSURNAME']; ?>
                                            </div>
                                            <a href="admin_edit_work1.php?id=<?php echo $ln['STAFFID']; ?>&dated=<?php echo $ln['dated']; ?>" class="btn btn-sm btn-warning text-white jax shadow-sm" title="แก้ไขเวลา">
                                                <i class="fas fa-edit"></i> แก้ไขเวลา
                                            </a>
                                        </td>
                                        <td>
                                            <?php echo $ln['DEPARTMENTNAME']; ?>
                                        </td>
                                        <td>
                                            <div class="time-block">
                                                <i class="far fa-clock"></i> <?php echo $ln['timein']; ?> - <?php echo $ln['timeout']; ?>
                                            </div>
                                            <div class="small text-muted mt-1"><?php echo $ln['dated']; ?></div>
                                        </td>
                                        <td>
                                            <?php 
                                            // Status Badge Logic (using Timing function assumed in config.php)
                                            if(Timing($ln['timein']) != 0 && Timing($ln['timein']) < 8.31) echo "<span class='badge badge-status badge-soft-success'><i class='fas fa-check-circle'></i> มาปกติ</span>";
                                            if(Timing($ln['timein']) != 0 && Timing($ln['timein']) > 8.30) echo "<span class='badge badge-status badge-soft-danger'><i class='fas fa-exclamation-circle'></i> มาสาย</span>";
                                            if(Timing($ln['timein']) == 0 && Timing($ln['timeout']) == 0) echo "<span class='badge badge-status badge-soft-secondary'><i class='fas fa-times-circle'></i> ไม่มา</span>";
                                            if(Timing($ln['timein']) == 0 && Timing($ln['timeout']) != 0) echo "<span class='badge badge-status badge-soft-info'><i class='fas fa-question-circle'></i> ไม่เซ็นเข้า</span>";
                                            if(Timing($ln['timein']) > 0 && Timing($ln['timeout'])== 0) echo "<span class='badge badge-status badge-soft-info'><i class='fas fa-question-circle'></i> ไม่เซ็นกลับ</span>";
                                            
                                            // Check Absent Record
                                            $sql1="select * from absent where STAFFID=$ln[STAFFID] and '$date_show' between date1 and date2";
                                            $res1=mysql_query($sql1);
                                            $rows=mysql_num_rows($res1);
                                            
                                            if($rows > 0) {
                                                echo "<div class='mt-1'><span class='badge badge-status badge-soft-purple'><i class='fas fa-briefcase'></i> ลา/ราชการ</span></div>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <span class="text-muted small"><?php echo $ln['reason']; ?></span>
                                        </td>
                                    </tr>
                                    <?php 
                                        } 
                                    } else {
                                        echo "<tr><td colspan='5' class='text-center py-4 text-muted'>ไม่พบข้อมูลการลงเวลาในวันที่นี้</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
</body>
</html>