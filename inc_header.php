<?php 
session_start();
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKATIGA</title>
    <link rel="stylesheet" href="<?php echo url_dasar()?>/css/style.css">
</head>
<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href='<?php echo url_dasar()?>'>SIKATIGA.</a></div>
            <div class="menu">
                <ul>
                    <li><a href="<?php echo url_dasar()?>#home">HOME</a></li>
                    <li><a href="<?php echo url_dasar()?>#courses">APD</a></li>
                    <li><a href="<?php echo url_dasar()?>#tutors">APAR & P3K</a></li>
                    <li><a href="<?php echo url_dasar()?>#partners">COLOR CODE</a></li>
                    <li><a href="<?php echo url_dasar()?>#contact">RISK REGISTER</a></li>
                    <li>
                    <?php if(isset($_SESSION['members_nama_lengkap'])){
                        echo "<a href='".url_dasar()."/ganti_profile.php'>".$_SESSION['members_nama_lengkap']." | <a href='".url_dasar()."/logout.php'>Logout</a>";
                    }else{?>
                        <a href="pendaftaran.php" class="tbl-biru">SIGN UP</a>
                    <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">