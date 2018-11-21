<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CU BANK</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../../lib/css/bootstrap.min.css">  <!-- TODO -->
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../../lib/css/style.pink.css" id="theme-stylesheet"> <!-- TODO -->
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="../../lib/css/custom.css"> <!-- TODO -->
    <!-- Favicon-->
    <link rel="shortcut icon" href="../../lib/img/favicon.ico"> <!-- TODO -->
    <!-- Font Awesome CDN-->
    <!-- you can replace it by local Font Awesome-->
    <script src="https://use.fontawesome.com/99347ac47f.js"></script>
    <!-- Font Icons CSS-->
    <link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css">
    <link rel="stylesheet" href="../../lib/css/sweetalert2.css"> <!-- TODO -->
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<style>
    .pink {
        color: #3F51B5;
    }

    .bg-pink {
        background: #3F51B5;
    }
</style>

<body onload="loadCustInfo()"> <!-- TODO -->
<header class="header">
    <nav class="navbar" style="background: #3F51B5">
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <!-- Navbar Header-->
                <div class="navbar-header">
                    <!-- Navbar Brand -->
                    <a id="homeBtn" href="../view/main.html" class="navbar-brand">
                        <div class="brand-text brand-big">
                                <span>
                                    <strong>CU</strong>
                                </span> BANK
                                <span>
                                    <i>-<strong> Driver</strong> version</i>
                                </span>
                        </div>
                        <!-- Toggle Button-->
                </div>
                <!-- Navbar Menu -->
                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    <!-- Name-->
                    <li class="nav-item d-flex align-items-center">
                        <a href="#" class="nav-link"></a>
                    </li>
                    <!-- Logout    -->
                    <li class="nav-item">
                        <a id="logoutBtn" href="#" class="nav-link logout">ออกจากระบบ
                            <i class="fa fa-sign-out"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="" id="subview">
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <a id="backBtn" href="../../view/main.html" class="btn btn-secondary">
                        <i class="fa fa-reply"></i> ย้อนกลับ</a>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <!-- Horizontal Form-->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">ฝากเงิน</h3>
                        </div>
                        <div class="card-body">
                            <p>เข้าบัญชีหมายเลข :
                                <span class="pink"> <input type="text" id="accNo" style="font-family: Poppins, sans-serif"></span>
                            </p>
                            <p>ยอดเงินคงเหลือ :
                                <span id="accBalance" class="pink">Balance</span> บาท
                            </p>
                            <form id="depositForm" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">จำนวนเงิน
                                    </label>
                                    <div class="col-sm-6">
                                        <input id="amount" type="text" style="font-family: Poppins, sans-serif">
                                        <small class="form-text"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10 offset-sm-2">
                                        <input type="submit" value="ยืนยัน" class="btn btn-primary" style="background: #3F51B5; border-color: #3F51B5">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    function loadCustInfo() {
        var acctNum = readCookie("authentication");
        if (acctNum) {
            $.ajax({
                method: "POST",
                url: "../controller.php",  // TODO
                dataType: "json",
                data: {
                    service: "ServiceAuthentication"
                }
            })
                .done(function (result) {
                    if (result.isError) {
                        swal(
                            'ผิดพลาด',
                            result.message,
                            'error'
                        );
                    }
                    else {
                        $("#accNo").text(result.accNo.toString().replace(/(\d{1})\-?(\d{3})\-?(\d{3})\-?(\d{3})/, '$1-$2-$3-$4'));
                        $("#accName").text(result.accName);
                        $("#accBalance").text(commaSeparateNumber(result.accBalance));
                    }
                }).fail(function (xhr, status, error) {
                swal(
                    'ผิดพลาด',
                    error,
                    'error'
                );
            });
        }
    }

    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
</script>

<!-- Javascript files-->
<script src="../../lib/js/cookie-mgmt.js"></script> <!-- TODO -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../../lib/js/tether.min.js"></script>
<script src="../../lib/js/bootstrap.min.js"></script>
<script src="../../lib/js/jquery.cookie.js"></script>
<script src="../../lib/js/jquery.validate.min.js"></script>
<script src="../../lib/js/front.js"></script>
<script src="../../lib/js/sweetalert2.js"></script>
<script type="text/javascript">
    $("#depositForm").submit(function (event) {
        var account_number = document.getElementById("accNo").value;
        console.log(account_number);
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "service.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        param = "account_number=" + account_number + "&amount=" + document.getElementById("amount").value;
        console.log(param);
        xhttp.send(param);
        xhttp.onload = function () {
            if (xhttp.readyState === xhttp.DONE) {
                console.log(xhttp.responseText);
                var res = JSON.parse(xhttp.responseText);
                if (typeof res['is_valid'] !== 'undefined' && !res['is_valid']) {
                    swal(
                        'ผิดพลาด',
                        res['message'],
                        'error'
                    );
                } else {
                    document.getElementById("accBalance").innerText = commaSeparateNumber(res['accBalance']);
                }
            }
        };
        event.preventDefault();
    });
</script>
</body>
</html>