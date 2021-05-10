<?php
    use classes\DB;
    $db = new DB();
    $db->connect();

    // Cập nhật bài viết
    if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["display"])) {
        $content = htmlentities(htmlspecialchars($_POST["content"]));
        $_POST["display"] = $_POST["display"] == "on" ? 1 : 0;
        $result = $db->query("INSERT INTO tin(TieuDe, Content, AnHien) VALUES (\"{$_POST["title"]}\", \"{$content}\", {$_POST["display"]})");
        header("Location: /webnewss/admin/posts");
    }
?>
<form action="" method="POST">
    <div class="input-group" style="width: 100%; margin-bottom: 1rem;">
        <input type="text" name="title" class="form-control" placeholder="Title*"
            style="width: 100%; margin-bottom: 1rem;">
    </div>
    <textarea name="content" id="editor1" rows="10" cols="80"></textarea>
    <div style="margin-top: 1rem; display: inline-block; float: right;">
        <div class="input-group-text">
            <span style="font-size: 1.5rem">Hiện: </span>
            <input type="checkbox" name="display">
        </div>
        <button class="btn btn-primary" type="submit" style="margin-top: 2rem">Cập nhật</button>
    </div>
</form>

<script src="/webnewss/assets/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1', {
    height: 350
    });
</script>
<style>
    .ck-editor {
        width: 100%!important;
    }
</style>