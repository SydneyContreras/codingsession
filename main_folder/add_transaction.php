<!--
=========================================================
 Light Bootstrap Dashboard - v2.0.1
=========================================================

 Product Page: https://www.creative-tim.com/product/light-bootstrap-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/light-bootstrap-dashboard/blob/master/LICENSE)

 Coded by Creative Tim

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.  -->
 <?php
include "db_conn.php";

if (isset($_POST['submit'])) {
    $datelog = date('Y-m-d H:i:s');
    $documentcode = $_POST['documentcode'];
    $action = $_POST['action'];
    $office = $_POST['name'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $remarks = $_POST['remarks'];

    // Concatenate lastname and firstname to get the employee name
    $employee_name = $lastname . ' ' . $firstname;

    // Query to retrieve employee_id based on the concatenated name
    $employee_query = "SELECT id FROM employee WHERE CONCAT(lastname, ' ', firstname) = '$employee_name'";
    $employee_result = mysqli_query($conn, $employee_query);

    if ($employee_result && $employee_row = mysqli_fetch_assoc($employee_result)) {
        $employee_id = $employee_row['id'];

        // Insert into the transaction table
        $sql = "INSERT INTO transaction (datelog, documentcode, action, office_id, employee_id, remarks)
                VALUES ('$datelog', '$documentcode', '$action', '$office', '$employee_id', '$remarks')";

        if (mysqli_query($conn, $sql)) {
            header("Location: office.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Error retrieving employee_id.');</script>";
    }

    mysqli_close($conn);
}
?>

 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/form.css">
    <link rel="stylesheet" href="./styles/header.css">
    <link rel="stylesheet" href="./styles/utils.css">
    <link rel="stylesheet" href="./styles/nav.css">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Light Bootstrap Dashboard - Free Bootstrap 4 Admin Dashboard by Creative Tim</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <!-- sidebar start-->
        <div class="sidebar-wrapper">
                <?php include './template/sidebar.html'; ?>
        </div>
        <!-- sidebar end-->
        
        <div class="main-panel">
            <!-- navbar start-->
            <?php include "./template/navbar.html"; ?>
                
            <div class="content">
                <div class="container-fluid">
                <h2>Add New Transaction Form</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="documentcode">DOCUMENT CODE: </label>
                            <select id="documentcode" name="documentcode" required>
                                <option value="100">100</option>
                                <option value="101">101</option>
                                <option value="102">102</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="action">ACTION: </label>
                            <select id="action" name="action" required>
                                <option value="in">IN</option>
                                <option value="out">OUT</option>
                                <option value="complete">COMPLETE</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="office">Office:</label>
                            <select id="name" name="name" required>
                                <?php
                                include "db_conn.php";

                                $sql = "SELECT id, name FROM recordapp_db.office";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                    }
                                } else {
                                    echo "<option value='' disabled>No offices found</option>";
                                }

                                $conn->close();
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name: </label>
                            <input type="text" id="lastname" name="lastname" required>
                        </div>
                        <div class="form-group">
                            <label for="firstname">First Name: </label>
                            <input type="text" id="firstname" name="firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="name">REMARKS: </label>
                            <input type="text" id="remarks" name="remarks" required>
                        </div>
                        <button class="button-button" type="submit" name="submit">Submit</button>
                    </form>
                </div>
                <footer>
                <p class="copyright text-center" style='color:#E5E7EB;'>
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </footer>
            </div>
        </div>
    </div>
    <!--   -->
    <!-- <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
            <i class="fa fa-cog fa-2x"> </i>
        </a>

        <ul class="dropdown-menu">
			<li class="header-title"> Sidebar Style</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                    <p>Background Image</p>
                    <label class="switch">
                        <input type="checkbox" data-toggle="switch" checked="" data-on-color="primary" data-off-color="primary"><span class="toggle"></span>
                    </label>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <p>Filters</p>
                    <div class="pull-right">
                        <span class="badge filter badge-black" data-color="black"></span>
                        <span class="badge filter badge-azure" data-color="azure"></span>
                        <span class="badge filter badge-green" data-color="green"></span>
                        <span class="badge filter badge-orange" data-color="orange"></span>
                        <span class="badge filter badge-red" data-color="red"></span>
                        <span class="badge filter badge-purple active" data-color="purple"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="header-title">Sidebar Images</li>

            <li class="active">
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../assets/img/sidebar-1.jpg" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../assets/img/sidebar-3.jpg" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="..//assets/img/sidebar-4.jpg" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../assets/img/sidebar-5.jpg" alt="" />
                </a>
            </li>

            <li class="button-container">
                <div class="">
                    <a href="http://www.creative-tim.com/product/light-bootstrap-dashboard" target="_blank" class="btn btn-info btn-block btn-fill">Download, it's free!</a>
                </div>
            </li>

            <li class="header-title pro-title text-center">Want more components?</li>

            <li class="button-container">
                <div class="">
                    <a href="http://www.creative-tim.com/product/light-bootstrap-dashboard-pro" target="_blank" class="btn btn-warning btn-block btn-fill">Get The PRO Version!</a>
                </div>
            </li>

            <li class="header-title" id="sharrreTitle">Thank you for sharing!</li>

            <li class="button-container">
				<button id="twitter" class="btn btn-social btn-outline btn-twitter btn-round sharrre"><i class="fa fa-twitter"></i> · 256</button>
                <button id="facebook" class="btn btn-social btn-outline btn-facebook btn-round sharrre"><i class="fa fa-facebook-square"></i> · 426</button>
            </li>
        </ul>
    </div>
</div>
 -->
 <script src="./js/sidebar.js"></script>
 <script src="./js/navbar.js"></script>
</body>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="../assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>

</html>
