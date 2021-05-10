<?php

use classes\DB;

$db = new DB();
$db->connect();


// Toggle display bài viết
if (isset($_POST["toggle_display_id"])) {
    $result = $db->fetch_assoc("SELECT * FROM tin WHERE idTin={$_POST["toggle_display_id"]}", 1);
    if ($result) {
        $newData = $result["AnHien"] == "1" ? "0" : "1";
        $result = $db->query("UPDATE tin SET AnHien=$newData WHERE idTin={$_POST["toggle_display_id"]}");
    }
    return;
}


// Xóa bài viết
if (isset($_POST["delete_id"])) {
    $result = $db->query("DELETE FROM tin WHERE idTin={$_POST["delete_id"]}");
}

$tin = $db->fetch_assoc("SELECT * FROM tin ORDER BY idTin DESC", 0);
?>
<button class="btn btn-outline" style="margin-bottom: 1rem;">
    <a href="/webnewss/admin/posts/create">Tạo bài viết</a>
</button>
<table class="table">
    <thead>
        <tr>
            <th>Tiêu đề</th>
            <th>Hiện</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tin as $item) { ?>
        <tr>
            <td>
                <a href="/webnewss/admin/posts/<?= $item["idTin"] ?>"><?= $item["TieuDe"] ?></a>
            </td>
            <td>
                <input type="checkbox" name="display" <?= $item["AnHien"] == "1" ? "checked" : "" ?>
                    onchange="toggleDisplay(<?= $item["idTin"] ?>)" />
            </td>
            <td>
                <form action="" method="POST">
                    <input type="hidden" name="delete_id" value="<?= $item["idTin"] ?>" />
                    <button class="btn btn-danger btn-xs" type="submit">Xóa</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
function toggleDisplay(id) {
    $.post("", {
        toggle_display_id: id,
    }, function(data, status) {});
}
</script>

<script>
function xoa(id) {
    let res = confirm("Bạn chắc chắn muốn xóa bài viết?");
    if (res) {
        $.post("", function({
            delete_id: id,
        }, status) {});
    }
}
</script>