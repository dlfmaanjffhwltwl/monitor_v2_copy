<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">



    <title>차량 모니터링</title>

    <link href="<?=URL?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?=URL?>/vendor/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?=URL?>/css/main.css" rel="stylesheet">
    <link href="<?=URL?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="<?=URL?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?=URL?>/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script>
    $(function() {
        var currentUrl = window.location.href;
        var rootUrl = "<?=URL?>/";
        var depth = currentUrl.replace(rootUrl, '');
        if (depth == "") {
            $(".nav-item").eq(0).addClass("active");
        } else {
            for (var i = 0; i < $(".nav-item").length; i++) {
                if ($(".nav-item").eq(i).hasClass(depth)) {
                    $(".nav-item").eq(i).addClass("active");
                    break;
                }
            }
        }
    })
    </script>
</head>

<body>

    <div id="wrapper">
        <!-- Sidebar -->
        <?php 
            if(Session::exists("userId")){  //세션값이 있다면 보여지고
                echo  ' 
                    <ul class="navbar-nav bg-gradient-dark sidebar toggled" id="accordionSidebar">
                        <li class="nav-item mt-3">
                            <a class="nav-link" href="./">
                                <i class="fas fa-fw fa-display"></i>
                                <span>모니터</span>
                            </a>
                        </li>
                        <hr class="sidebar-divider">
                        <li class="nav-item path">
                            <a class="nav-link" href="./path">
                                <i class="fas fa-fw fa-bezier-curve"></i>
                                <span>경로</span>
                            </a>
                        </li>
                        <li class="nav-item statistics">
                            <a class="nav-link" href="./statistics">
                                <i class="fas fa-fw fa-chart-pie"></i>
                                <span>통계</span></a>
                        </li>
                        <li class="nav-item carInfo">
                            <a class="nav-link" href="./carInfo">
                                <i class="fas fa-fw fa-car-side"></i>
                                <span>차량정보</span>
                            </a>
                        </li>
                        <li class="nav-item carDrive">
                            <a class="nav-link" href="./carDrive">
                                <i class="fas fa-fw  fa-file-signature"></i>
                                <span>운행일지</span>
                            </a>
                         </li>
                         <li class="nav-item carInspection">
                            <a class="nav-link" href="./carInspection">
                                <i class="fas fa-fw fa-screwdriver-wrench"></i>
                                <span>점검일지</span>
                            </a>
                          </li>
                ';
                if(Session::get("userLevel")==1){   //사용자가 관리자권한이라면 사용자,데이터 메뉴가 보인다
                    echo '
                    <li class="nav-item user">
                        <a class="nav-link" href="./user">
                            <i class="fas fa-fw fa-users"></i>
                            <span>사용자</span>
                        </a>
                    </li>
                    <li class="nav-item carData">
                        <a class="nav-link" href="./carData">
                            <i class="fas fa-fw fa-database"></i>
                            <span>데이터</span>
                        </a>
                    </li>
                    ';  
                }
                echo  ' 
                    <hr class="sidebar-divider">
                    <li class="nav-item logout">
                        <a class="nav-link" href="./login/logout">
                            <i class="fas fa-fw fa-arrow-right-from-bracket"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                 
                </ul>
                ';
            }
        ?>
        <div id="content-wrapper">
            <div id="content">