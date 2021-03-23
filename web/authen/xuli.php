<?php
header('Content-Type: text/html; charset=utf-8');
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', 'root', 'Webtintuc') or die ('Lỗi kết nối'); mysqli_set_charset($conn, "utf8");

// Dùng isset để kiểm tra Form
if(isset($_POST['dangky'])){
$username = trim($_POST['UserNames']);
$password = trim($_POST['PassWords']);
$email = trim($_POST['email']);



if (empty($username)) {
array_push($errors, "Username is required"); 
}
if (empty($email)) {
array_push($errors, "Email is required"); 
}

if (empty($password)) {
array_push($errors, "Two password do not match"); 
}

// Kiểm tra username hoặc email có bị trùng hay không
$sql = "SELECT * FROM Users WHERE UserNames = '$username' OR email = '$email'";

// Thực thi câu truy vấn
$result = mysqli_query($conn, $sql);

// Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
if (mysqli_num_rows($result) > 0)
{
echo '<script language="javascript">alert("Bị trùng tên hoặc chưa nhập tên!"); window.location="login.php";</script>';

// Dừng chương trình
die ();
}
else {
$sql = "INSERT INTO Users (UserNames, PassWords, email) VALUES ('$username','$password','$email')";
echo '<script language="javascript">alert("Đăng ký thành công!"); window.location="login.php";</script>';

if (mysqli_query($conn, $sql)){
echo "Tên đăng nhập: ".$_POST['UserNames']."<br/>";
echo "Mật khẩu: " .$_POST['PassWords']."<br/>";
echo "Email đăng nhập: ".$_POST['email']."<br/>";

}
else {
echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý"); window.location="register.php";</script>';
}
}
}
?>