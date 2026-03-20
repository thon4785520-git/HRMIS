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
    <title>Add Absent - Absent Database System</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Google Font: Kanit -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- CSS Datepicker -->
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
        .custom-control-label::before {
            background-color: #fff;
            border: 1px solid #adb5bd;
        }
        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #28a745;
            border-color: #28a745;
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
    <!-- JS Datepicker -->
    <script src="jquery.datetimepicker.full.js" charset="utf-8"></script>

    <script>
    $(document).ready(function(){
        $("#form1").validate();

        // Datepicker Setup (Thai Year Logic)
        $.datetimepicker.setLocale('th'); 
        
        function setupDatepicker(id) {
            $(id).datetimepicker({
                timepicker:false,
                format:'Y-m-d',  // Value sent to DB
                formatDate:'Y-m-d',
                lang:'th',
                closeOnDateSelect:true,
                onSelectDate:function(dp,$input){
                    // Logic for displaying Thai year if needed, 
                    // or just keep Y-m-d for consistency with DB
                }
            });
        }
        
        // Note: The original PHP code used Date('Y-m-d') for default value, 
        // so we stick to Y-m-d format for compatibility.
        setupDatepicker("#dated");
        setupDatepicker("#date1");
        setupDatepicker("#date2");
    });

    function thon(i){
        $('#xxx').html('<div class="text-center text-muted"><i class="fas fa-spinner fa-spin"></i> ѧŴ...</div>');
        $('#xxx').load("get_staff.php?id="+i, function(){
            $('#xxx select').addClass('form-control'); // Add bootstrap class to loaded select
        });
    }

    function xxx(txt){
        $("#reason").val(txt);
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
                        <a href="admin_view_staff.php"><i class="fas fa-users"></i> źؤҡ</a>
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
                    <h1 class="h2"><i class="fas fa-plus-circle text-success"></i> š</h1>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card card-custom">
                            <div class="card-header card-header-custom">
                                <i class="fas fa-file-signature"></i> Ẻѹ֡
                            </div>
                            <div class="card-body">
                                <form method="POST" action="admin_add_absent2.php" id="form1">
                                    
                                    <div class="form-section-title"><i class="fas fa-user"></i> ż</div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>͡˹§ҹ <span class="text-danger">*</span></label>
                                            <select name="DEPARTMENTID" class="form-control" onChange="thon(this.value)" required>
                                                <option value="">--- س͡˹§ҹ ---</option>
                                                <?php
                                                $sql="select * from department";
                                                $res=mysql_query($sql);
                                                while($ln=mysql_fetch_array($res)){
                                                    echo "<option value='{$ln[0]}'>{$ln[1]}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>͡ - ʡ  <span class="text-danger">*</span></label>
                                            <span id="xxx">
                                                <select class="form-control" disabled>
                                                    <option>س͡˹§ҹ͹</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-section-title"><i class="far fa-clock"></i> ´ѹ</div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>ѹ</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-calendar-day"></i></span></div>
                                                <input class="form-control required" type="text" name="dated" id="dated" value="<?=Date('Y-m-d')?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>ҵѹ <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
                                                <input class="form-control required" type="text" name="date1" id="date1" autocomplete="off" placeholder="͡ѹ">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>֧ѹ <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
                                                <input class="form-control required" type="text" name="date2" id="date2" autocomplete="off" placeholder="͡ѹش">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>ӹǹѹ (ѹ) <span class="text-danger">*</span></label>
                                            <input class="form-control required number" type="text" name="amount" placeholder="кصŢ ( 1, 0.5)">
                                        </div>
                                    </div>

                                    <div class="form-section-title"><i class="fas fa-tasks"></i> ˵ؼ</div>
                                    <div class="form-group">
                                        <label> <span class="text-danger">*</span></label>
                                        <div class="card bg-light border-0">
                                            <div class="card-body py-2">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input type="radio" id="type1" name="type" value="1" class="custom-control-input" checked onClick="xxx('ä')">
                                                            <label class="custom-control-label" for="type1">һ</label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input type="radio" id="type2" name="type" value="2" class="custom-control-input" onClick="xxx('ոз')">
                                                            <label class="custom-control-label" for="type2">ҡԨ</label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input type="radio" id="type3" name="type" value="3" class="custom-control-input" onClick="xxx('ͧþѡ͹')">
                                                            <label class="custom-control-label" for="type3">Ҿѡ͹</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input type="radio" id="type4" name="type" value="4" class="custom-control-input" onClick="xxx('Ҫ÷')">
                                                            <label class="custom-control-label" for="type4">Ҫ</label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input type="radio" id="type5" name="type" value="5" class="custom-control-input" onClick="xxx('ʹص')">
                                                            <label class="custom-control-label" for="type5">Ҥʹ</label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input type="radio" id="type6" name="type" value="6" class="custom-control-input" onClick="xxx('ػ')">
                                                            <label class="custom-control-label" for="type6">ػ</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input type="radio" id="type7" name="type" value="7" class="custom-control-input" onClick="xxx('§ٺص')">
                                                            <label class="custom-control-label" for="type7">§ٺص</label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input type="radio" id="type9" name="type" value="9" class="custom-control-input" onClick="xxx('СͺԸѨ')">
                                                            <label class="custom-control-label" for="type9">СͺԸѨ</label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input type="radio" id="type8" name="type" value="8" class="custom-control-input" onClick="xxx('ѡ (§Դ-19)')">
                                                            <label class="custom-control-label" for="type8">ѡ (Դ-19)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>˵ؼŷ <span class="text-danger">*</span></label>
                                        <textarea name="reason" id="reason" rows="3" class="form-control required" required></textarea>
                                    </div>

                                    <div class="form-section-title"><i class="fas fa-check-double"></i> ͹ѵ (Pre-Approve)</div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card border-info mb-3">
                                                <div class="card-header bg-transparent border-info text-info font-weight-bold p-2 text-center">ҹؤҡ</div>
                                                <div class="card-body p-2">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="advise1" name="advise" value="1" class="custom-control-input" checked>
                                                        <label class="custom-control-label text-success" for="advise1">繤͹ѵ</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="advise2" name="advise" value="2" class="custom-control-input">
                                                        <label class="custom-control-label text-danger" for="advise2">繤͹ѵ</label>
                                                    </div>
                                                    <input name="advise" type="radio" value="0" style="display:none"> <!-- Default hidden fallback -->
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="card border-success mb-3">
                                                <div class="card-header bg-transparent border-success text-success font-weight-bold p-2 text-center">ѧѺѭҵ</div>
                                                <div class="card-body p-2">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="approve1" name="approve" value="1" class="custom-control-input">
                                                        <label class="custom-control-label text-success" for="approve1">͹ѵ</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="approve2" name="approve" value="2" class="custom-control-input">
                                                        <label class="custom-control-label text-danger" for="approve2">͹ѵ</label>
                                                    </div>
                                                    <input name="approve" type="radio" value="0" checked style="display:none">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card border-primary mb-3">
                                                <div class="card-header bg-transparent border-primary text-primary font-weight-bold p-2 text-center">ѧѺѭ٧</div>
                                                <div class="card-body p-2">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="approve1_1" name="approve1" value="1" class="custom-control-input">
                                                        <label class="custom-control-label text-success" for="approve1_1">͹ѵ</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="approve1_2" name="approve1" value="2" class="custom-control-input">
                                                        <label class="custom-control-label text-danger" for="approve1_2">͹ѵ</label>
                                                    </div>
                                                    <input name="approve1" type="radio" value="0" checked style="display:none">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-success btn-lg shadow px-5"><i class="fas fa-save"></i> ѹ֡</button>
                                        <button type="reset" class="btn btn-warning btn-lg shadow px-5 text-white ml-3"><i class="fas fa-undo"></i> </button>
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