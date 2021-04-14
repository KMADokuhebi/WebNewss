<?php
    use classes\DB;
    $db = new DB();
    $db->connect();

    // Cập nhật bài viết
    if(isset($_POST["title"]) and isset($_POST["content"])) {
        $content = htmlentities(htmlspecialchars($_POST["content"]));
        $result = $db->query("INSERT INTO tin(TieuDe, Content) VALUES (\"{$_POST["title"]}\", \"{$content}\")");
        header("Location: /webnewss/admin/posts");
    }
?>
<form action="" method="POST">
    <div class="input-group" style="width: 100%; margin-bottom: 1rem;">
        <input type="text" name="title" class="form-control" placeholder="Title*"
            style="width: 100%; margin-bottom: 1rem;">
    </div>
    <textarea name="content" id="editor1" rows="10" cols="80"></textarea>
    <button class="btn btn-primary" type="submit" style="margin-top: 2rem; float: right">Cập nhật</button>
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