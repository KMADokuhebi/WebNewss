<?php
spl_autoload_register(function ($class_name) {
    $filename = $class_name . '.php';
    $filename = str_replace('\\', '/', $filename);
    if (file_exists($filename)) {
        include_once $filename;
    }
});
include_once("core/init.php");

use classes\DB;
use classes\Session;

// Kết nối database
$db = new DB();
$db->connect();
$session = new Session();

$message = "";
$status = false;

if ((isset($_POST['user_signin']) && isset($_POST['pass_signin']))) {
    // Xử lý các giá trị 
    $user_signin = trim(htmlspecialchars(addslashes($_POST['user_signin'])));
    $pass_signin = trim(htmlspecialchars(addslashes($_POST['pass_signin'])));
    // Nếu giá trị rỗng
    if ($user_signin == '' || $pass_signin == '') {
        $message = 'Vui lòng điền đầy đủ thông tin';
    } else { // Ngược lại
        $sql_check_user_exist = "SELECT Username FROM users WHERE Username = '$user_signin'";
        // Nếu tồn tại Username
        if ($db->num_rows($sql_check_user_exist)) {
            $pass_signin = md5($pass_signin);
            $sql_check_signin = "SELECT Username, `Password` FROM users WHERE Username = '$user_signin' AND `Password` = '$pass_signin'";
            if ($db->num_rows($sql_check_signin)) {
                echo "OK";
                $sql_check_stt = "SELECT Username, Password, Active FROM users WHERE Username = '$user_signin' AND Password = '$pass_signin' AND Active = '0'";
                // Nếu Username và Password khớp và tài khoản không bị khoá (Active = 0)
                if ($db->num_rows($sql_check_stt)) {
                    $session->send($user_signin);
                    $db->close(); // Giải phóng
                    echo ("<script>location.href = '/webnewss/admin';</script>");
                } else {
                    $message = 'Tài khoản của bạn đã bị khoá, vui lòng liên hệ quản trị viện để biết thêm thông tin chi tiết.';
                }
            } else {
                $message = 'Mật khẩu không chính xác.';
            }
        }
        // Ngược lại không tồn tại Username
        else {
            $message = 'Tên đăng nhập không tồn tại.';
        }
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <p>Vui lòng đăng nhập để tiếp tục.</p>
            <form method="POST" id="formSignin">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" placeholder="Tên đăng nhập" name="user_signin">
                    </div><!-- div.input-group -->
                </div><!-- div.form-group -->
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" class="form-control" placeholder="Mật khẩu" name="pass_signin">
                    </div><!-- div.input-group -->
                </div><!-- div.form-group -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </div><!-- div.form-group -->
                <?php
                if (strlen($message)) {
                    ?><div class="alert alert-danger hidden"><?= $message ?></div><?php
                }
                ?>
            </form><!-- form#formSignin -->
        </div><!-- dib.col-md-6 -->
    </div><!-- div.row -->
</div><!-- div.container -->