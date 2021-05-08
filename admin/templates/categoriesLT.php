<?php // trang quản lí loại tin
// neu dang nhap
if ($user) {
    //neu la tac gia
    if ($data_user['idGroup'] == 0) {
        echo '<div class ="alert alert-danger"> Ban khong co quyen truy cap nha then ml </div>';
    }
    // neu laf admin
    elseif ($data_user['idGroup'] == 1) {

        echo '<h3>Loại tin</h3>';
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
            // Trang thêm Loại tin
            if ($ac == 'add') {
                // Dãy nút của thêm Loại tin
                echo
                '
                    <a href="' . $_DOMAIN . 'categoriesLT" class="btn btn-default">
                        <span class="glyphicon glyphicon-arrow-left"></span> Trở về
                    </a> 
                ';

                // Content thêm Loại tin
                echo
                '   
                <p class="form-add-cate">
                    <form method="POST" id="formAddCate" onsubmit="return false;">

                        <div class="form-group">
                            <label>Tên Loại tin</label>
                            <input type="text" class="form-control title" id="label_add_cate">
                        </div>
                        
                        
                        <div class="form-group hidden parent-add-cate">
                            <label>Parent Loại tin</label>
                            <select id="parent_add_cate" class="form-control">
                            </select>
                        </div>
                       
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Tạo</button>
                        </div>
                        <div class="alert alert-danger hidden"></div>
                    </form>
                </p>
                ';
            }
            // Trang chỉnh sửa Loại tin
            else if ($ac == 'edit') {
                $sql_check_idLT = "SELECT idLT FROM theloai WHERE idLT = '$id'";
                // Nếu tồn tại tham số id trong table
                if ($db->num_rows($sql_check_idLT)) {
                    // Dãy nút của chỉnh sửa Loại tin
                    echo
                    '
                        <a href="' . $_DOMAIN . 'categoriesLT" class="btn btn-default">
                            <span class="glyphicon glyphicon-arrow-left"></span> Trở về
                        </a>
                        <a class="btn btn-danger" id="del_cate" data-id="' . $id . '">
                            <span class="glyphicon glyphicon-trash"></span> Xoá
                        </a> 
                    ';

                    // Content chỉnh sửa Loại tin
                } else {
                    // Hiển thị thông báo lỗi
                    echo
                    '
                        <div class="alert alert-danger">ID Loại tin đã bị xoá hoặc không tồn tại.</div>
                    ';
                }
            }
        }
        // Ngược lại không có tham số ac
        // Trang danh sách Loại tin
        else {
            // Dãy nút của danh sách Loại tin
            echo
            '
                <a href="' . $_DOMAIN . 'categoriesLT/add" class="btn btn-default">
                    <span class="glyphicon glyphicon-plus"></span> Thêm
                </a> 
                
            ';
            // <a href="' . $_DOMAIN . 'categoriesLT/edit" class="btn btn-default">
            //         <span class="glyphicon glyphicon-edit"></span> Sửa
            //     </a> 
            //     <a class="btn btn-danger" id="del_cate_list">
            //         <span class="glyphicon glyphicon-trash"></span> Xoá
            //     </a> 

            // Content danh sách Loại tin
            $sql_get_list_cate = "SELECT * FROM loaitin ORDER BY idLT DESC";
            // Nếu có Loại tin
            if ($db->num_rows($sql_get_list_cate)) {
                echo
                '
                <br><br>
                <div class="table-responsive">
                    <table class="table table-striped list" id="list_cate">
                        <tr>
                            <td><input type="checkbox"></td>
                            <td><strong>ID</strong></td>
                            <td><strong>Tên Loại Tin</strong></td>
                            <td><strong>ID Thể Loại</strong></td>
                            
                            <td><strong>Ẩn/Hiện</strong></td>
                            <td><strong>Tools</strong></td>
                        </tr>
                ';

                // In danh sách Loại tin
                foreach ($db->fetch_assoc($sql_get_list_cate, 0) as $key => $data_cate) {

                    // $sql_get_cate_parent = "SELECT * FROM categories ";

                    //Hiển thị loại Loại tin 
                    if ($data_cate['AnHien'] == 1) {
                        $data_cate['AnHien'] = 'HIện';
                    } else if ($data_cate['AnHien'] == 0) {
                        $data_cate['AnHien'] = 'Ẩn';
                    }

                    echo
                    '
                    <tr>
                    <td><input type="checkbox" name="idLT[]" value="' . $data_cate['idLT'] . '"></td>
                    <td>' . $data_cate['idLT'] . '</td>
                    <td><a href="' . $_DOMAIN . 'categoriesLT/edit/' . $data_cate['idLT'] . '">' . $data_cate['Ten'] . '</a></td>
                    <td>' . $data_cate['idTL'] . '</td>
                    
                    <td>' . $data_cate['AnHien'] . '</td>
                    
                   
                    <td>
                        <a href="' . $_DOMAIN . 'categoriesLT/edit/' . $data_cate['idLT'] . '" class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-edit"> Sửa </span>
                        </a>
                        <a class="btn btn-danger btn-sm del-cate-list" data-id="' . $data_cate['idLT'] . '">
                            <span class="glyphicon glyphicon-trash"> Xoá </span>
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
            // Nếu không có Loại tin
            else {
                echo '<br><br><div class="alert alert-info">Chưa có Loại tin nào.</div>';
            }
        }
    }
    // chua dang nhap    
} else {
    echo ("<script>location.href = '/';</script>");
    // ve trang chu ngay

}
