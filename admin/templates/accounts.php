<?php

// Nếu đăng nhập
if ($user) {
    // Nếu tài khoản là tác giả
    if ($data_user['idGroup'] == 0) {
        echo '<div class="alert alert-danger">Bạn không có đủ quyền để vào trang này.</div>';
    }
    // Ngược lại tài khoản là admin
    else if ($data_user['idGroup'] == 1) {
        // echo '<h3>Tài khoản</h3>';
        // Lấy tham số ac
        if (isset($_GET['ac'])) {
            $ac = trim(addslashes(htmlspecialchars($_GET['ac'])));
        } else {
            $ac = '';
        }

        // Lấy tham số id
        if (isset($_GET['id'])) {
            $id = trim(addslashes(htmlspecialchars($_GET['id'])));
        } else {
            $id = '';
        }

        // Nếu có tham số ac
        if ($ac != '') {
            // Trang thêm tài khoản
            if ($ac == 'add') {
                // Dãy nút của thêm tài khoản
                echo
                '
                    <a href="' . $_DOMAIN . 'accounts" class="btn btn-default">
                        <span class="glyphicon glyphicon-arrow-left"></span> Trở về
                    </a> 
                ';

                // Content thêm tài khoản
                echo '
                <p class="form-add-acc">
                    <form method="POST" id="formAddAcc"  >
                        <div class="form-group">
                            <label>Tên đăng nhập</label>
                            <input type="text" class="form-control title" id="un_add_acc" >
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label> 
                            <input type="password" class="form-control title" id="pw_add_acc">
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" class="form-control title" id="repw_add_acc">
                        </div>
                        <div class="form-group">
                            <button type="submit" name ="submit_addAcc"class="btn btn-primary">Thêm</button>
                        </div>
                        <div class="alert alert-danger hidden"></div>
                    </form>
                </p>
            ';
            }
        }
        // Ngược lại không có tham số ac
        else {
            // Dãy nút của danh sách tài khoản
            echo
            '
                <a href="' . $_DOMAIN . 'accounts/add" class="btn btn-default">
                    <span class="glyphicon glyphicon-plus"></span> Thêm
                </a> 
                <a href="' . $_DOMAIN . 'accounts" class="btn btn-default">
                    <span class="glyphicon glyphicon-repeat"></span> Reload
                </a>
                <a class="btn btn-warning" id="lock_acc_list">
                    <span class="glyphicon glyphicon-lock"></span> khoá
                </a>
                <a class="btn btn-success" id="unlock_acc_list">
                    <span class="glyphicon glyphicon-lock"></span> Mở khoá
                </a> 
                <a class="btn btn-danger" id="del_acc_list">
                    <span class="glyphicon glyphicon-trash"></span> Xoá
                </a> 
            ';
            // Trang danh sách tài khoản

            $sql_get_list_acc = "SELECT * FROM users WHERE idGroup='0' ORDER BY idUser DESC";
            // Nếu có tài khoản
            if ($db->num_rows($sql_get_list_acc)) {
                echo
                '
                    <br><br>
                    <div class="table-responsive">
                        <table class="table table-striped list" id="list_acc">
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><strong>ID</strong></td>
                                <td><strong>Tên đăng nhập</strong></td>
                                <td><strong>Trạng thái</strong></td>
                                <td><strong>Tools</strong></td>
                            </tr>
                ';

                // In danh sách tài khoản
                foreach ($db->fetch_assoc($sql_get_list_acc, 0) as $key => $data_acc) {
                    // Trạng thái tài khoản
                    if ($data_acc['Active'] == 0) {
                        $stt_acc = '<label class="label label-success">Hoạt động</label>';
                    } else if ($data_acc['Active'] == 1) {
                        $stt_acc = '<label class="label label-warning" >Khoá</label>';
                    }

                    echo
                    '
                        <tr>
                            <td><input type="checkbox" name="id_acc[]" value="' . $data_acc['idUser'] . '"></td>
                            <td>' . $data_acc['idUser'] . '</td>
                            <td>' . $data_acc['Username'] . '</td>
                            <td>' . $stt_acc . '</td>
                            <td>
                                <a data-id="' . $data_acc['idUser'] . '" class="btn btn-sm btn-warning lock-acc-list">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </a>
                                <a data-id="' . $data_acc['idUser'] . '" class="btn btn-sm btn-success unlock-acc-list">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </a>
                                <a data-id="' . $data_acc['idUser'] . '" class="btn btn-sm btn-danger del-acc-list">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                        </tr>
                    ';
                }

                echo
                '
                        </table>
                    </div>
                ';
            }
            // Nếu không có tài khoản
            else {
                echo '<br><br><div class="alert alert-info">Chưa có tài khoản nào.</div>';
            }
            // Content danh sách tài khoản

        }
    }
}
// Ngược lại chưa đăng nhập
else {
    // new Redirect($_DOMAIN); // Trở về trang index
    echo ("<script>location.href = '/webnewss/';</script>");
}



// Kết nối database và thông tin chung
spl_autoload_register(function ($class_name) {
    $filename = $class_name . '.php';
    $filename = str_replace('\\', '/', $filename);
    if (file_exists($filename)) {
        include_once $filename;
    }
});
// require_once './core/init.php';

// Nếu đăng nhập
if ($user) {
    // Nếu tồn tại POST action
    if (isset($_POST['action'])) {
        // Xử lý POST action
        $action = trim(addslashes(htmlspecialchars($_POST['action'])));

        // Thêm tài khoản
        if ($action == 'add_acc') {
            // Xử lý các giá trị
            $un_add_acc = trim(htmlspecialchars(addslashes($_POST['un_add_acc'])));
            $pw_add_acc = trim(htmlspecialchars(addslashes($_POST['pw_add_acc'])));
            $repw_add_acc = trim(htmlspecialchars(addslashes($_POST['repw_add_acc'])));

            // Các biến xử lý thông báo
            $show_alert = '<script>$("#formAddAcc .alert").removeClass("hidden");</script>';
            $hide_alert = '<script>$("#formAddAcc .alert").addClass("hidden");</script>';
            $success = '<script>$("#formAddAcc .alert").attr("class", "alert alert-success");</script>';

            // Kiểm tra tên đăng nhập
            $sql_check_un_exist = "SELECT Username FROM users WHERE Username = '$un_add_acc'";

            if ($un_add_acc == '' || $pw_add_acc == '' || $repw_add_acc == '') {
                echo $show_alert . 'Vui lòng điền đầy đủ thông tin.';
            } else if (strlen($un_add_acc) < 6 || strlen($un_add_acc) > 32) {
                echo $show_alert . 'Tên đăng nhập nằm trong khoảng 6-32 ký tự.';
            } else if (preg_match('/\W/', $un_add_acc)) {
                echo $show_alert . 'Tên đăng nhập không chứa kí tự đậc biệt và khoảng trắng.';
            } else if ($db->num_rows($sql_check_un_exist)) {
                echo $show_alert . 'Tên đăng nhập đã tồn tại.';
            } else if (strlen($pw_add_acc) < 6) {
                echo $show_alert . 'Mật khẩu quá ngắn.';
            } else if ($pw_add_acc != $repw_add_acc) {
                echo $show_alert . 'Mật khẩu nhập lại không khớp.';
            } else {
                $pw_add_acc = md5($pw_add_acc);
                $sql_add_acc = "INSERT INTO users(Username,Password ) VALUES (
                    '$un_add_acc',
                    '$pw_add_acc',
                )";
                $db->query($sql_add_acc);
                $db->close();

                echo $show_alert . $success . 'Thêm tài khoản thành công.';
                // new Redirect($_DOMAIN . 'accounts'); // Trở về trang danh sách tài khoản
                echo ("<script>location.href = '/webnewss/admin/accounts/';</script>");
            }
        }
        // Mở tài khoản
        // Mở khoá 1 tài khoản
        else if ($action == 'unlock_acc') {
            $id_acc = trim(htmlspecialchars(addslashes($_POST['id_acc'])));
            $sql_check_id_acc_exist = "SELECT idUser FROM users WHERE idUser = '$id_acc'";
            if ($db->num_rows($sql_check_id_acc_exist)) {
                $sql_unlock_acc = "UPDATE users SET status = '0' WHERE idUser = '$id_acc'";
                $db->query($sql_unlock_acc);
                $db->close();
            }
        }
        // Mở khoá nhiều tài khoản cùng lúc     
        else if ($action == 'unlock_acc_list') {
            foreach ($_POST['id_acc'] as $key => $id_acc) {
                $sql_check_id_acc_exist = "SELECT idUser FROM users WHERE idUser = '$id_acc'";
                if ($db->num_rows($sql_check_id_acc_exist)) {
                    $sql_unlock_acc = "UPDATE users SET Active = '0' WHERE id_acc = '$id_acc'";
                    $db->query($sql_unlock_acc);
                }
            }
            $db->close();
        }
        // Khoá nhiều tài khoản cùng lúc        

        else if ($action == 'lock_acc_list') {
            // echo $show_alert . 'có lock acction';
            $id_acc = $_POST['id_acc'];
            foreach ($_POST['id_acc'] as $key => $id_acc) {
                // echo $show_alert . 'ok chạy';

                $sql_check_id_acc_exist = "SELECT idUser FROM users WHERE idUser = $id_acc";
                if ($db->num_rows($sql_check_id_acc_exist)) {
                    $sql_lock_acc = "UPDATE users SET Active = '1' WHERE idUser = $id_acc";
                    $db->query($sql_lock_acc);
                }
            }
            $db->close();
        }
        // Khoá 1 tài khoản
        else if ($action == 'lock_acc') {
            $id_acc = trim(htmlspecialchars(addslashes($_POST['id_acc'])));
            $sql_check_id_acc_exist = "SELECT idUser FROM users WHERE idUser = $id_acc";
            if ($db->num_rows($sql_check_id_acc_exist)) {
                $sql_lock_acc = "UPDATE users SET Active = '1' WHERE idUser = $id_acc";
                $db->query($sql_lock_acc);
                $db->close();
            }
        }
        // Xoá tài khoản 
    } else {
        // new Redirect($_DOMAIN); // Trở về trang index
        // echo ("<script>location.href = '/webnewss/';</script>");
        // echo ("<script>location.href = '/webnewss/admin/accounts/';</script>");
    }
} else {
    // new Redirect($_DOMAIN); // Trở về trang inde
    echo ("<script>location.href = '/webnewss/';</script>");
}