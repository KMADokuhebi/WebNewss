<?php
  use classes\DB;
  $db = new DB();
  $db->connect();

  // Xóa bài viết
  if(isset($_POST["delete_id"])) {
    $result = $db->query("DELETE FROM tin WHERE idTin={$_POST["delete_id"]}");
  }

  $tin = $db->fetch_assoc("SELECT * FROM tin ORDER BY idTin DESC", 0);
?>
<button class="btn btn-outline" style="margin-bottom: 1rem;">
  <a href="/webnewss/admin/posts/create">Tạo bài viết</a>
</button>
<ul class="list-group">
  <?php foreach($tin as $item) { ?>
    <li class="list-group-item">
      <a href="/webnewss/admin/posts/<?= $item["idTin"] ?>"><?= $item["TieuDe"] ?></a>
      <div style="float: right">
        <form action="" method="POST">
          <input type="hidden" name="delete_id" value="<?= $item["idTin"] ?>" />
          <button class="btn btn-danger btn-xs" type="submit">Xóa</button>
        </form>
      </div>
    </li>
  <?php } ?>
</ul>

<script>
function xoa(id) {
  let res = confirm("Bạn chắc chắn muốn xóa bài viết?");
  if(res) {
    $.post("", function({
      delete_id: id,
    }, status) {});
  }
}
</script>