<?php
// ˹ Header  Windows-874 ͧѺк
header('Content-Type: text/html; charset=windows-874');
session_start();

// Ǩͺʶҹ Admin
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
    <title>Manage Staff - Absent Database System</title>

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
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        .card-header-custom {
            background-color: #fff;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            color: #003399;
            padding: 15px 20px;
            border-radius: 10px 10px 0 0;
        }

        /* Table */
        .table thead th {
            border-top: none;
            border-bottom: 2px solid #003399;
            color: #003399;
            background-color: #f8f9fa;
        }
        .table-hover tbody tr:hover {
            background-color: #f0f4ff;
        }
        .action-btn {
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            padding: 0;
            border-radius: 50%;
        }

        /* Colors */
        .bg-gradient-blue {
            background: linear-gradient(45deg, #003399, #4d79ff);
        }
        .text-orange {
            color: #fd7e14;
        }
    </style>

    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

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
                        <i class="fas fa-sign-out-alt"></i> ͡ҡк
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
                        <a href="admin.php"><i class="fas fa-home"></i> ˹á</a>
                        <a href="admin_view_staff.php" class="active"><i class="fas fa-users"></i> źؤҡ</a>
                        <a href="admin_view_control.php"><i class="fas fa-file-contract"></i> ¹ѭ .</a>
                        <a href="admin_view_work.php"><i class="fas fa-desktop"></i> šûԺѵԧҹ</a>
                        <a href="admin_view_absent.php"><i class="fas fa-edit"></i> Ѵâš</a>
                        <a href="admin_report.php"><i class="fas fa-chart-bar"></i> §ҹŢ</a>
                        <a href="logout.php" class="text-danger"><i class="fas fa-lock"></i> ͡ҡк</a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 page-header">
                    <h1 class="h2"><i class="fas fa-users text-orange"></i> Ѵâźؤҡ</h1>
                </div>

                <!-- Action Bar & Filter -->
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <a href="admin_add_staff.php" class="btn btn-success shadow-sm">
                                    <i class="fas fa-plus-circle"></i> ؤҡ
                                </a>
                            </div>
                            <div class="col-md-6">
                                <form method="post" action="" class="form-inline justify-content-md-end">
                                    <label class="mr-2 font-weight-bold text-muted">ͧ˹§ҹ:</label>
                                    <select name="DEPARTMENTID" class="form-control custom-select" style="min-width: 250px;" onChange="this.form.submit()">
                                        <option value="">--- ʴ / ͡˹§ҹ ---</option>
                                        <?php
										if($_POST['DEPARTMENTID']=='')$_POST['DEPARTMENTID']=4;
                                        $sql_dept="select * from department";
                                        $res_dept=mysql_query($sql_dept);
                                        while($ln_dept=mysql_fetch_array($res_dept)){
                                            $selected = (isset($_POST['DEPARTMENTID']) && $ln_dept[0] == $_POST['DEPARTMENTID']) ? 'selected' : '';
                                            echo "<option value='{$ln_dept[0]}' $selected>{$ln_dept[1]}</option>";
                                        }
                                        ?>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Staff Table -->
                <?php
                if(isset($_POST['DEPARTMENTID']) && $_POST['DEPARTMENTID'] != "") {
                ?>
                <div class="card card-custom">
                    <div class="card-header card-header-custom">
                        <i class="fas fa-list"></i> ªͺؤҡ
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%" class="text-center">ID</th>
                                        <th width="35%"> - ʡ</th>
                                        <th width="30%">˹</th>
                                        <th width="15%" class="text-center">»Ժѵԡ</th>
                                        <th width="15%" class="text-center">Ѵ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $dept_id = mysql_real_escape_string($_POST['DEPARTMENTID']);
                                    $sql="select * from staff where DEPARTMENTID=$dept_id order by STAFFID";
                                    $res=mysql_query($sql);
                                    
                                    if(mysql_num_rows($res) > 0) {
                                        while($ln=mysql_fetch_array($res)){
                                            // ˹ Badge §ҹ
                                            $badge_class = ($ln['STAFFGROUP'] == 1) ? 'badge-info' : 'badge-secondary';
                                            $group_name = ($ln['STAFFGROUP'] == 1) ? 'Ҩ' : 'ʹѺʹع';
                                    ?>
                                    <tr>
                                        <td class="text-center font-weight-bold text-muted"><?php echo $ln['STAFFID']; ?></td>
                                        <td class="font-weight-bold text-primary">
                                            <?php echo $ln['PREFIXNAME'] . $ln['STAFFNAME'] . " " . $ln['STAFFSURNAME']; ?>
                                        </td>
                                        <td><?php echo $ln['POSITIONNAME']; ?></td>
                                        <td class="text-center">
                                            <span class="badge <?php echo $badge_class; ?> p-2"><?php echo $group_name; ?></span>
                                        </td>
                                        <td class="text-center">   
                                            <a href="admin_edit_staff.php?id=<?php echo base64_encode($ln[0]); ?>" class="btn btn-warning action-btn text-white shadow-sm" title="">
                                                <i class="fas fa-pencil-alt" style="font-size: 0.8rem;"></i>
                                            </a>
                                            <a href="admin_del_staff.php?id=<?php echo base64_encode($ln[0]); ?>" class="btn btn-danger action-btn shadow-sm" title="ź" onClick="return confirm('׹ѹźŹ? źö׹');">
                                                <i class="fas fa-times" style="font-size: 0.8rem;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                        } 
                                    } else {
                                        echo "<tr><td colspan='5' class='text-center py-4 text-muted'>辺źؤҡ˹§ҹ</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php 
                } else {
                ?>
                    <div class="alert alert-info text-center py-5 shadow-sm" style="border-radius: 10px;">
                        <i class="fas fa-search fa-3x mb-3 text-info"></i><br>
                        <h4>س͡˹§ҹ</h4>
                        <p>ʴªͺؤҡѧѴ</p>
                    </div>
                <?php
                }
                ?>

            </main>
        </div>
    </div>
</body>
</html>