<?php

use classes\DB;

$db = new DB();
$db->connect();
// Nếu đăng nhập
if ($user) {
    // URL ảnh đại diện tài khoản
    if ($data_user['url_avatar'] == '') {
        $data_user['url_avatar'] = $_DOMAIN . 'images/profile.png';
    } else {
        $data_user['url_avatar'] = $_DOMAIN . 'images/profile.png';
    }
    $type1 = 1;
    $sql_user = "SELECT * FROM theloai WHERE Username = '$user'";
    $us =   $db->fetch_assoc($sql_user, $type1);

    // var_dump($_DOMAIN);
    // var_dump($data_user['url_avatar']);
    // var_dump($data_user);

    // Form Upload ảnh đại diện
    echo
    '
        <h3>Hồ sơ cá nhân</h3>
        <div class="panel panel-default">
            <div class="panel-heading">Upload ảnh đại diện</div>
            <div class="panel-body">
                <form action="' . $_DOMAIN . 'profile.php" method="POST" onsubmit="return false;" id="formUpAvt" enctype="multipart/form-data">
                    <div class="form-group box-current-img">
                        <p><strong>Ảnh hiện tại</strong></p>
                        <img src="' . $data_user['url_avatar'] . '" alt="Ảnh đại diện của ' . $data_user['HoTen'] . '" width="80" height="80">
                    </div>
                    <div class="alert alert-info">Vui lòng chọn file ảnh có đuôi .jpg, .png, .gif và có dung lượng dưới 5MB.</div>
                    <div class="form-group">
                        <label>Chọn hình ảnh</label>
                        <input type="file" class="form-control" id="img_avt" name="img_avt" onchange="preUpAvt();">
                    </div>
                    <div class="form-group box-pre-img hidden">
                        <p><strong>Ảnh xem trước</strong></p>
                    </div>            
                    <div class="form-group hidden box-progress-bar">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary pull-left" type="submit">Upload</button>
                        <a class="btn btn-danger pull-right" id="del_avt"><span class="glyphicon glyphicon-trash"></span> Xoá</a>
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="alert alert-danger hidden"></div>
                </form>
            </div>
        </div>
    ';

    echo
    '
        <div class="panel panel-default">
            <div class="panel-heading">Cập nhật thông tin</div>
            <div class="panel-body">
                <form method="POST" onsubmit="return false;" id="formUpdateInfo">
                    <div class="form-group">
                        <label>Tên hiển thị *</label>
                        <input type="text" class="form-control" id="dn_update" value="' . $data_user["HoTen"] . '">
                    </div>
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="text" class="form-control" id="email_update" ">
                    </div>
                  
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                    <div class="alert alert-danger hidden"></div>
                </form>
            </div>
        </div>
    ';

    // Form đổi mật khẩu


    // Form Cập nhật các thông tin còn lại
}
// Ngược lại chưa đăng nhập
else {
    // new Redirect($_DOMAIN); // Trở về trang index
    echo ("<script>location.href = '/webnewss/';</script>");
}
