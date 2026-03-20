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
    <title>Search Absent - Absent Database System</title>

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

        /* Cards */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        .card-header-custom {
            background-color: #fff;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            color: #003399;
            padding: 15px 20px;
            border-radius: 12px 12px 0 0;
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
        .action-btn {
            width: 32px;
            height: 32px;
            line-height: 32px;
            text-align: center;
            padding: 0;
            border-radius: 50%;
            margin: 0 2px;
        }
        
        /* Status Badges */
        .status-badge {
            display: block;
            font-size: 0.8rem;
            margin-bottom: 3px;
            text-align: left;
            padding: 5px 10px;
            border-radius: 6px;
        }
        .status-badge i { width: 20px; text-align: center; }

        .badge-soft-purple { background-color: rgba(111, 66, 193, 0.1); color: #6f42c1; }
        .badge-soft-green { background-color: rgba(40, 167, 69, 0.1); color: #28a745; }
        .badge-soft-red { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; }
        .badge-soft-blue { background-color: rgba(23, 162, 184, 0.1); color: #17a2b8; }

    </style>

    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.validate.js"></script>
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
                        <a href="admin_view_absent.php" class="active"><i class="fas fa-edit"></i> จัดการข้อมูลการลา</a>
                        <a href="admin_report.php"><i class="fas fa-chart-bar"></i> รายงานผลข้อมูล</a>
                        <a href="logout.php" class="text-danger"><i class="fas fa-lock"></i> ออกจากระบบ</a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 page-header">
                    <h1 class="h2"><i class="fas fa-search text-primary"></i> ค้นหาข้อมูลการลา</h1>
                </div>

                <!-- Search Form -->
                <div class="card card-custom">
                    <div class="card-body">
                        <form method="POST" action="" id="form1">
                            <div class="form-row align-items-end">
                                <div class="col-md-3 mb-3">
                                    <label class="font-weight-bold">ค้นหาโดย</label>
                                    <select name="search" class="form-control custom-select">
                                        <option value="B.STAFFNAME">ชื่อ - สกุล ผู้ลา</option>
                                        <option value="A.date1">วันที่ลา (YYYY-MM-DD)</option>
                                        <option value="A.id">เลขที่ใบลา</option>										
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

                <!-- Result Table -->
                <?php
                if(isset($_POST['search']) && isset($_POST['key'])){
                    $key = mysql_real_escape_string($_POST['key']);
                    $search_field = mysql_real_escape_string($_POST['search']);
                    
                    $sql="select * from absent A,staff B where A.STAFFID=B.STAFFID and $search_field like '%$key%' order by date1 DESC";
                    $res=mysql_query($sql);
                    $num_rows = mysql_num_rows($res);
                ?>

                <div class="card card-custom">
                    <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-list"></i> ผลการค้นหา</span>
                        <span class="badge badge-primary p-2">พบ <?php echo $num_rows; ?> รายการ</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="20%">ชื่อ - สกุล</th>
                                        <th width="20%">ช่วงวันที่ลา</th>
                                        <th width="15%">ประเภทการลา</th>
                                        <th width="30%">สถานะการอนุมัติ</th>
                                        <th width="15%" class="text-center">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=0;
                                    $type_arr = array("","ลาป่วย","ลากิจ","ลาพักผ่อน","ไปราชการ","ลาคลอด","ลาอุปสมบท","ช่วยเหลือภริยาเลี้ยงดูบุตร","WFH","ประกอบพิธีฮัจญ์");

                                    if($num_rows > 0) {
                                        while($ln=mysql_fetch_array($res)){
                                            $i++;
                                            $absent_type = isset($type_arr[$ln['type']]) ? $type_arr[$ln['type']] : "ไม่ระบุ";
                                    ?>
                                    <tr>
                                        <td class="font-weight-bold text-primary">
                                            <?php echo $ln['PREFIXNAME'] . $ln['STAFFNAME'] . " " . $ln['STAFFSURNAME']; ?>
                                        </td>
                                        <td>
                                            <i class="far fa-calendar-alt text-muted"></i> <?php echo DateThai($ln['date1']); ?> <br>
                                            <small>ถึง <?php echo DateThai($ln['date2']); ?></small>
                                        </td>
                                        <td>
                                            <span class="badge badge-light border text-dark"><?php echo $absent_type; ?></span>
                                            <div class="small text-danger mt-1 font-weight-bold">(<?php echo $ln['amount']; ?> วัน)</div>
                                        </td>
                                        <td>
                                            <?php
                                            // HR Advise
                                            if($ln['advise']==1) echo "<div class='status-badge badge-soft-purple'><i class='fas fa-user-tie'></i> งานบุคลากร: <span class='text-success font-weight-bold'>เห็นควร</span></div>";
                                            if($ln['advise']==2) echo "<div class='status-badge badge-soft-purple'><i class='fas fa-user-tie'></i> งานบุคลากร: <span class='text-danger font-weight-bold'>ไม่เห็นควร</span></div>";
                                            
                                            // Head Approve
                                            if($ln['approve']==1) echo "<div class='status-badge badge-soft-green'><i class='fas fa-check-circle'></i> ผบ.ต้น: <span class='font-weight-bold'>อนุมัติ</span></div>";
                                            if($ln['approve']==2) echo "<div class='status-badge badge-soft-red'><i class='fas fa-times-circle'></i> ผบ.ต้น: <span class='font-weight-bold'>ไม่อนุมัติ</span></div>";
                                            
                                            // Top Approve
                                            if($ln['approve1']==1) echo "<div class='status-badge badge-soft-blue'><i class='fas fa-signature'></i> ผบ.สูง: <span class='font-weight-bold'>อนุมัติ</span></div>";
                                            if($ln['approve1']==2) echo "<div class='status-badge badge-soft-red'><i class='fas fa-times-circle'></i> ผบ.สูง: <span class='font-weight-bold'>ไม่อนุมัติ</span></div>";
                                            ?>
                                        </td>
                                        <td class="text-center"> 
                                            <a href="form1.php?id=<?php echo $ln['id']; ?>" class="btn btn-info action-btn shadow-sm" title="พิมพ์แบบฟอร์ม" target="_blank">
                                                <i class="fas fa-print" style="font-size: 0.8rem;"></i>
                                            </a>  
                                            <a href="admin_edit_absent.php?id=<?php echo base64_encode($ln['id']); ?>" class="btn btn-warning action-btn text-white shadow-sm" title="แก้ไข">
                                                <i class="fas fa-pencil-alt" style="font-size: 0.8rem;"></i>
                                            </a>
                                            <a href="admin_del_absent.php?id=<?php echo base64_encode($ln['id']); ?>" class="btn btn-danger action-btn shadow-sm" title="ลบ" onClick="return confirm('ยืนยันการลบข้อมูลนี้หรือไม่?');">
                                                <i class="fas fa-trash-alt" style="font-size: 0.8rem;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' class='text-center py-4 text-muted'>ไม่พบข้อมูลที่ค้นหา</td></tr>";
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