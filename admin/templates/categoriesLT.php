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
                // them loai tin

                if (isset($_POST["Tao"])) {
                    // lay id cao nhat vaf tanglen 1
                    $select_sql = "SELECT idLT FROM theloai ORDER BY idLT DESC";
                    $type = 1;
                    $d = $db->fetch_assoc($select_sql, $type);
                    $id = (int)$d["idLT"] + 1;
                    // var_dump($id);
                    // ghi du lieu vao sql
                    $input = $_POST["input"];
                    $idloaitin = $_POST["chon"];
                    var_dump($input);
                    var_dump($idloaitin);
                    $insert_sql = "INSERT INTO loaitin(Ten,idTL) value ('$input','$idloaitin') ";
                    if ($db->query($insert_sql) == NULL) {
                        echo '<br><br><div class="alert alert-info">Thêm thành công</div>';
                        echo ("<script>location.href = '/webnewss/admin/categoriesLT/';</script>");
                    } else {
                        echo '<br><br><div class="alert alert-info">Thất bại</div>';
                    }
                }

                // Dãy nút của thêm Loại tin



                echo
                '
                    <a href="' . $_DOMAIN . 'categoriesLT" class="btn btn-default">
                        <span class="glyphicon glyphicon-arrow-left"></span> Trở về
                    </a> 
                ';


                echo '<p class="form-add-cate">';
                echo '    <form method="POST" id="formAddCate" >';

                echo '    <div class="form-group">';
                echo '            <label>Tên Loại tin</label>';
                echo '            <input type="text" name="input"class="form-control title" id="label_add_cate">';
                echo '    </div>';
                // bảng xổ xuống
                $type = 0;
                echo '        <div class="form-group">';
                $sql_cl = "SELECT Ten from loaitin";
                echo "          <label for='chon'> Chọn THể loại </label>";
                echo "          <select id='chon' name='chon' class='form-control' style='width:200px; color:black;'>";
                // du lieu dong chua hoan thanh
                // foreach ($row = $db->fetch_assoc($sql_cl, $type) as $value) {
                //     echo "<option value= $row[idLT] > $row[Ten]</option>";
                // }
                // code tĩnh
                echo            "<option value='1'  > Xã Hội </option>";
                echo            "<option value='2'  > Thế Giới </option>";
                echo            "<option value='3'  > Kinh Doanh </option>";
                echo            "<option value='4'  > Văn Hóa </option>";
                echo            "<option value='5'  > Thể Thao </option>";
                echo            "<option value='6'  > Pháp Luật </option>";
                echo            "<option value='7'  > Đời Sống </option>";
                echo            "<option value='8'  > Khoa Học </option>";
                echo            "<option value='9'  > Vi Tính </option>";
                echo            "</select>";
                echo '        </div>';
                // Content thêm Loại tin


                echo '        <div class="form-group">';
                echo '            <button type="submit" name="Tao" class="btn btn-primary">Tạo</button>';
                echo '        </div>';
                echo '        <div class="alert alert-danger hidden"></div>';
                echo '    </form>';
                echo '</p>';
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
