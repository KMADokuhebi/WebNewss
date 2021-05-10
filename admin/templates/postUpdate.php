<?php

use classes\DB;

$db = new DB();
$db->connect();

// Cập nhật bài viết
if (
    isset($_POST["id"]) && isset($_POST["title"])
    && isset($_POST["content"])
) {
    $content = htmlentities(htmlspecialchars($_POST["content"]));
    $display = "0";
    if (isset($_POST["display"])) {
        $display = $_POST["display"] == "on" ? "1" : "0";
    }
    $result = $db->query("UPDATE tin SET TieuDe=\"{$_POST["title"]}\", Content=\"{$content}\", AnHien=$display WHERE idTin={$_POST["id"]}");
}
if (isset($_POST["id"]) and isset($_POST["title"]) and isset($_POST["content"])) {
    $content = htmlentities(htmlspecialchars($_POST["content"]));
    $result = $db->query("UPDATE tin SET TieuDe=\"{$_POST["title"]}\", Content=\"{$content}\" WHERE idTin={$_POST["id"]}");

    header("Location: /webnewss/admin/posts");
}

if (isset($_GET['ac'])) {
    $ac = trim(addslashes(htmlspecialchars($_GET['ac'])));
} else {
    $ac = '';
}

$tin = $db->fetch_assoc("SELECT * FROM tin WHERE idTin=$ac", 1);
?>

<form action="" method="POST">
    <input type="hidden" name="id" value="<?= $tin["idTin"] ?>">
    <div class="input-group" style="width: 100%; margin-bottom: 1rem;">
        <input type="text" name="title" class="form-control" placeholder="Title*" value="<?= $tin["TieuDe"] ?>" style="width: 100%; margin-bottom: 1rem;">
    </div>
    <textarea name="content" id="editor1" rows="10" cols="80">
        <?= html_entity_decode(htmlspecialchars_decode($tin["Content"])) ?>
    </textarea>

    <div style="margin-top: 1rem; display: inline-block; float: right">
        <div class="input-group-text">
            <span style="font-size: 1.5rem">Hiện: </span>
            <input type="checkbox" name="display" <?= $tin["AnHien"] == "1" ? "checked" : "" ?>>
        </div>
        <button class="btn btn-primary" type="submit" style="margin-top: 2rem">Cập nhật</button>
    </div>
</form>

<script src="/webnewss/assets/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1', {
        height: 350
    })
</script>
<style>
    .ck-editor {
        width: 100% !important;
    }
</style>