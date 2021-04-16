<?php
    use classes\DB;
    $db = new DB();
    $db->connect();

    // Cập nhật bài viết
<<<<<<< HEAD
    if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["display"])) {
        $content = htmlentities(htmlspecialchars($_POST["content"]));
        $result = $db->query("INSERT INTO tin(TieuDe, Content, AnHien) VALUES (\"{$_POST["title"]}\", \"{$content}\"), {$_POST["display"]}");
=======
    if(isset($_POST["title"]) and isset($_POST["content"])) {
        $content = htmlentities(htmlspecialchars($_POST["content"]));
        $result = $db->query("INSERT INTO tin(TieuDe, Content) VALUES (\"{$_POST["title"]}\", \"{$content}\")");
>>>>>>> 368aade5b309ef4348adcffe8530aefc560b36c6
        header("Location: /webnewss/admin/posts");
    }
?>
<form action="" method="POST">
    <div class="input-group" style="width: 100%; margin-bottom: 1rem;">
        <input type="text" name="title" class="form-control" placeholder="Title*"
            style="width: 100%; margin-bottom: 1rem;">
    </div>
    <textarea name="content" id="editor1" rows="10" cols="80"></textarea>
<<<<<<< HEAD
    <div style="margin-top: 1rem; display: inline-block; float: right">
        <div class="input-group-text">
            <span style="font-size: 1.5rem">Hiện: </span>
            <input type="checkbox" name="display" value="<?= $tin["AnHien"] ?>">
        </div>
        <button class="btn btn-primary" type="submit" style="margin-top: 2rem">Cập nhật</button>
    </div>
=======
    <button class="btn btn-primary" type="submit" style="margin-top: 2rem; float: right">Cập nhật</button>
>>>>>>> 368aade5b309ef4348adcffe8530aefc560b36c6
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