<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webnews";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    mysqli_query($conn, "SET NAME 'utf8'");

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $qr1 = "SELECT * FROM tin ORDER BY idTin DESC LIMIT 1,7";
    $data1 = mysqli_query($conn, $qr1);

    $qr2 = "SELECT * FROM tin WHERE idTin=26";
    $data2 = mysqli_query($conn, $qr2);

    $qr3 = "SELECT * FROM tin ORDER BY idTin DESC LIMIT 14,18";
    $data3 = mysqli_query($conn, $qr3);

    $qr4 = "SELECT * FROM tin ORDER BY idTin DESC LIMIT 8,13";
    $data4 = mysqli_query($conn, $qr4);
?>
<!DOCTYPE html>
<html>
    <head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="assets/css/HomepageCSS.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style-menu.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style-footer.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style-login.css">
    </head>
	<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=3964996543560719&autoLogAppEvents=1" nonce="ChHci4s5"></script>
<body>
	<section class="content-home">
        <section class="head-new">
            <section class="hn-top">
                <?php 
                    $tinmoinhat_mottin = $data2;
                    $row_tinmoinhat_mottin = mysqli_fetch_array($tinmoinhat_mottin);
                ?>
                <a href="#"><img src="upload/tintuc/<?php echo $row_tinmoinhat_mottin['urlHinh']?>" alt="images hot news" srcset="" class="img-hn-left"></a>
                <section class="content-hn-top">
                <strong><a href="#"><?php echo $row_tinmoinhat_mottin['TieuDe']?></a> </strong>
                <p style="padding-top: 10px;"><?php echo $row_tinmoinhat_mottin['TomTat']?></p>
                </section>
            </section>
            <?php 
                    $batinmoi = $data3;
                    $row1_batinmoi = mysqli_fetch_array($batinmoi);
                    $row2_batinmoi = mysqli_fetch_array($batinmoi);
                    $row3_batinmoi = mysqli_fetch_array($batinmoi);
                ?>
            <a href="#"><img src="upload/tintuc/<?php echo $row3_batinmoi['urlHinh']?>" alt="images hot news" class="img-hn-right" srcset=""></a>

            <section class="hn-bottom">
                <ul>
                    <strong><a href="#"><?php echo $row1_batinmoi['TieuDe']?></a></strong>
                    <li><?php echo $row1_batinmoi['TomTat']?></li>
                </ul>
                <ul style="padding: 0px 24px 0px 48px;">
                    <strong><a href="#"><?php echo $row2_batinmoi['TieuDe']?></a></strong>
                    <li><?php echo $row2_batinmoi['TomTat']?></li>
                </ul>
                <ul style="border-left: 3px solid #e5e5e5; padding: 0px 24px;">
                <strong><a href="#"><?php echo $row3_batinmoi['TieuDe']?></a></strong>
                    <li><?php echo $row3_batinmoi['TomTat']?></li>
                </ul>
            </section>
        </section>
         <!-- new-centrer -->
        <section class="new-center">
            <section class="new-left">
                <?php
                  $bontinmoi = $data1;
                  while($row_bontinmoi = mysqli_fetch_array($bontinmoi)){
                ?>
                <section class="left">
                    <strong><a href=""><?php echo $row_bontinmoi['TieuDe']?></a></strong>
                    <p><a href="#"><img src="upload/tintuc/<?php echo $row_bontinmoi['urlHinh'] ?>"></a> 
                    <?php echo $row_bontinmoi['TomTat']?></p>
                </section>
                <?php
                  }
                ?>
            </section>
       
            <section class="new-right">
                <section class="right">
                    <ul class="menu-right">
                        <li><a href="#" style="border-bottom: 2px solid #8A0829; color: black; font-size: 17px; font-weight: bold;">Thời sự</a> </li>
                        <li><a href="#">Chính trị</a> </li>
                        <li><a href="#">Giao thông</a> </li>
                    </ul>
                    <?php
                        $mottin = $data4;
                        $row1_mottin = mysqli_fetch_array($mottin);
                        $row2_mottin = mysqli_fetch_array($mottin);
                        $row3_mottin = mysqli_fetch_array($mottin);
                        $row4_mottin = mysqli_fetch_array($mottin);
                        $row5_mottin = mysqli_fetch_array($mottin);
                    ?>
                    <p class="right-top-left"><a href="#"><img src="upload/tintuc/<?php echo $row1_mottin['urlHinh'] ?>" alt="Tin tuc" srcset=""></a>
                        <strong><a href="#"><?php echo $row1_mottin['TieuDe'] ?></a></strong>
                        <?php echo $row1_mottin['TomTat'] ?></p>
                    <p class="right-top-right"><a href="#"><strong><?php echo $row2_mottin['TieuDe'] ?></a></strong>
                    <?php echo $row2_mottin['TomTat'] ?>
                    </p>
                    <section class="right-bottom">
                        <ul>
                            <li><a href="#"><?php echo $row3_mottin['TomTat'] ?></a></li>
                            <li><a href="#"><?php echo $row4_mottin['TomTat'] ?></a></li>
                            <li><a href="#"><?php echo $row5_mottin['TomTat'] ?></a></li>
                        </ul>
                    </section>
                </section>
                </section>
            </section>
        </section>
    </section> 
	<div class="fb-comments" data-href="https://vnexpress.net/thoi-su" data-width="100%" data-numposts="5"></div>
	<div class="fb-comment-embed" data-href="https://www.facebook.com/yannews/posts/6528860440518123?comment_id=6540084706062363&amp;__cft__[0]=AZUUhjqaHTOy1x71EzIVCs_S2aaxCvnt7-mTfZgprMUenfuw-IlRC1X76vK22cEy5cwaXOM4wQGSEzU0rGw5v0rUV8je1yEMpFh662VZCCUQQMgBcrvPdqS-IHQEBruJOQNKCwB8S3fCs7TIWebmZFE0&amp;__tn__=R]-R" data-width="1500px" data-include-parent="false"></div>
	<div class="fb-comment-embed" data-href="https://www.facebook.com/yannews/posts/6528860440518123?comment_id=6540076822729818&amp;reply_comment_id=564578341125773&amp;__cft__[0]=AZUUhjqaHTOy1x71EzIVCs_S2aaxCvnt7-mTfZgprMUenfuw-IlRC1X76vK22cEy5cwaXOM4wQGSEzU0rGw5v0rUV8je1yEMpFh662VZCCUQQMgBcrvPdqS-IHQEBruJOQNKCwB8S3fCs7TIWebmZFE0&amp;__tn__=R]-R" data-width="1500" data-include-parent="true"></div>
</body>
</html>