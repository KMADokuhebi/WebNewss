<!-- Dashboard bài viết -->
<h3>Bài viết</h3>
<div class="row">
    <?php
    if ($data_user['idGroup'] == '1') {
        // Lấy tổng số bài viết
        $sql_get_count_all_post = "SELECT idTin FROM tin";
        $count_all_post = $db->num_rows($sql_get_count_all_post);

        echo
        '
      <div class="col-md-4">
        <div class="alert alert-info">
          <h1>' . $count_all_post . '</h1>
          <p>tổng bài viết</p>
        </div>
      </div>
    ';
    } else {
        // Lấy số bài viết của tác giả
        $sql_get_count_post_author = "SELECT idTin FROM tin WHERE idUser = '" . $data_user['idUser'] . "'";
        $count_post_author = $db->num_rows($sql_get_count_post_author);

        echo
        '
      <div class="col-md-4">
        <div class="alert alert-info">
          <h1>' . $count_post_author . '</h1>
          <p>bài viết của bạn</p>
        </div>
      </div>
    ';
    }

    ?>

    <div class="col-md-4">
        <div class="alert alert-success">
            <h1>
                <?php

                // Lấy tổng bài viết xuất bản
                // Nếu tài khoản là admin thì lấy toàn bộ bài viết xuất bản
                if ($data_user['idGroup'] == 1) {
                    $sql_get_count_post_public = "SELECT idTin FROM tin WHERE AnHien = '1'";
                    // Nếu tài khoản là tác giả thì lấy các bài viết xuất bản của tài khoản đó 
                } else {
                    $sql_get_count_post_public = "SELECT idTin FROM tin WHERE AnHien = '1' AND idUser = '$data_user[idUser]'";
                }
                echo $db->num_rows($sql_get_count_post_public);

                ?>
            </h1>
            <p>bài viết xuất bản</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="alert alert-warning">
            <h1>
                <?php

                // Lấy tổng bài viết ẩn
                // Nếu tài khoản là admin thì lấy toàn bộ bài viết ẩn
                if ($data_user['idGroup'] == 1) {
                    $sql_get_count_post_hide = "SELECT idTin FROM tin WHERE AnHien = '0'";
                    // Nếu tài khoản là tác giả thì lấy các bài viết xuất bản của tài khoản đó 
                } else {
                    $sql_get_count_post_hide = "SELECT idTin FROM tin WHERE AnHien = '0' AND idUser = '$data_user[idUser]'";
                }
                echo $db->num_rows($sql_get_count_post_hide);

                ?>
            </h1>
            <p>bài viết ẩn</p>
        </div>
    </div>
</div>
<?php

if ($data_user['idGroup'] == '1') {

?>

<!-- Dashboard Chủ đề -->
<h3>Chủ đề</h3>
<div class="row">


    <?php

        // Lấy số theloai
        $sql_get_count_cate_1 = "SELECT idTL FROM theloai ";
        $count_cate_1 = $db->num_rows($sql_get_count_cate_1);

        echo
        '
    <div class="col-md-3">
      <div class="alert alert-info">
        <h1>' . $count_cate_1 . '</h1>
        <p> Thể Loại </p>
      </div>
    </div>
  ';

        ?>

    <?php

        // Lấy số loaitin
        $sql_get_count_cate_2 = "SELECT idLT FROM loaitin ";
        $count_cate_2 = $db->num_rows($sql_get_count_cate_2);

        echo
        '
    <div class="col-md-3">
      <div class="alert alert-success">
        <h1>' . $count_cate_2 . '</h1>
        <p> Loai Tin </p>
      </div>
    </div>
  ';

        ?>


</div>

<!-- Dashboard tài khoản -->

<?php

}

?>
<h3>Tài khoản</h3>
<div class="row">
    <?php

    // Lấy tổng tài khoản
    $sql_get_count_acc = "SELECT idUser FROM users WHERE Active = '0'";
    $count_acc = $db->num_rows($sql_get_count_acc);

    echo
    '
    <div class="col-md-4">
      <div class="alert alert-info">
        <h1>' . $count_acc . '</h1>
        <p>tổng tài khoản</p>
      </div>
    </div>
  ';

    ?>

    <?php

    // Lấy số tài khoản hoạt động
    $sql_get_count_acc_active = "SELECT idUser FROM users WHERE Active = '0' AND idGroup = '0'";
    $count_acc_active = $db->num_rows($sql_get_count_acc_active);

    echo
    '
    <div class="col-md-4">
      <div class="alert alert-success">
        <h1>' . $count_acc_active . '</h1>
        <p>tài khoản hoạt động</p>
      </div>
    </div>
  ';

    ?>

    <?php

    // Lấy số tài khoản bị khoá
    $sql_get_count_acc_locked = "SELECT idUser FROM users WHERE Active = '1' AND idGroup = '0'";
    $count_acc_locked = $db->num_rows($sql_get_count_acc_locked);

    echo
    '
    <div class="col-md-4">
      <div class="alert alert-warning">
        <h1>' . $count_acc_locked . '</h1>
        <p>tài khoản bị khoá</p>
      </div>
    </div>
  ';

    ?>
</div>