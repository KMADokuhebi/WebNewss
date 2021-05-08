$_DOMAIN = 'http://localhost:8080/webnewss/admin/';
// Đăng nhập
$('#formSignin button').on('click', function () {
    $this = $('#formSignin button');
    $this.html('Đang tải nhoé...');
    // Gán các giá trị trong các biến
    $user_signin = $('#formSignin #user_signin').val();
    $pass_signin = $('#formSignin #pass_signin').val();
    // Nếu các giá trị rỗng
    if ($user_signin == '' || $pass_signin == '') {
        $('#formSignin .alert').removeClass('hidden');
        $('#formSignin .alert').html('Vui lòng điền đầy đủ thông tin.');
        $this.html('Đăng nhập');
    }
    // Ngược lại
    else {
        $.ajax({
            url: '/webnewss/admin/signin.php',
            type: 'POST',
            data: {
                user_signin: $user_signin,
                pass_signin: $pass_signin
            }, success: function (data) {
                $('#formSignin .alert').removeClass('hidden');
                $('#formSignin .alert').html(data);
                $this.html('Đăng nhập');
            }, error: function () {
                $('#formSignin .alert').removeClass('hidden');
                $('#formSignin .alert').html('Không thể đăng nhập vào lúc này, hãy thử lại sau.');
                $this.html('Đăng nhập');
            }
        });
    }
});
// Tự động tạo slug
function ChangeToSlug() {
    var title, slug;
    title = $('.title').val();
    slug = title.toLowerCase();

    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    slug = slug.replace(/ /gi, "-");
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    $('.slug').val(slug);
}

$('.slug').on('click', function () {
    ChangeToSlug();
});
// Thêm tài khoản
$('#formAddAcc button').on('click', function () {
    $un_add_acc = $('#un_add_acc').val();
    $pw_add_acc = $('#pw_add_acc').val();
    $repw_add_acc = $('#repw_add_acc').val();

    if ($un_add_acc == '' || $pw_add_acc == '' || $repw_add_acc == '') {
        $('#formAddAcc .alert').removeClass('hidden');
        $('#formAddAcc .alert').html('Vui lòng điền đầy đủ thông tin.');
    }
    else {
        $.ajax({
            url: $_DOMAIN + 'templates/accounts.php',
            type: 'POST',
            data: {
                un_add_acc: $un_add_acc,
                pw_add_acc: $pw_add_acc,
                repw_add_acc: $repw_add_acc,
                action: 'add_acc'
            }, success: function (data) {
                $('#formAddAcc .alert').html(data);
            }, error: function () {
                $('#formAddAcc .alert').removeClass('hidden');
                $('#formAddAcc .alert').html('Đã có lỗi xảy ra, hãy thử lại.');
            }
        });
    }
});
// Khoá nhiều tài khoản cùng lúc
$('#lock_acc_list').on('click', function () {
    $confirm = confirm('Bạn có chắc chắn muốn khoá các tài khoản đã chọn không?');
    if ($confirm == true) {
        $id_acc = [];

        $('#list_acc input[type="checkbox"]:checkbox:checked').each(function (i) {
            $id_acc[i] = $(this).val();
        });

        if ($id_acc.length === 0) {
            alert('Vui lòng chọn ít nhất một tài khoản.');
        }
        else {
            $.ajax({
                url: $_DOMAIN + 'templates/accounts.php',
                type: 'POST',
                data: {
                    id_acc: $id_acc,
                    action: 'lock_acc_list'
                },
                success: function (data) {
                    // alert('ok');

                    location.reload();
                    // console.log(data)
                }, error: function () {
                    alert('Đã có lỗi xảy ra, hãy thử lại.');
                }
            });
        }
    }
    else {
        return false;
    }
});
// Khoá tài khoản chỉ định trong bảng danh sách
$('.lock-acc-list').on('click', function () {
    $confirm = confirm('Bạn có chắc chắn muốn khoá tài khoản này không?');
    if ($confirm == true) {
        $id_acc = $(this).attr('data-id');

        $.ajax({
            url: $_DOMAIN + 'templates/accounts.php',
            type: 'POST',
            data: {
                id_acc: $id_acc,
                action: 'lock_acc'
            },
            success: function () {
                location.reload();
            }
        });
    }
    else {
        return false;
    }
});
// Mở khoá nhiều tài khoản cùng lúc
$('#unlock_acc_list').on('click', function () {
    $confirm = confirm('Bạn có chắc chắn muốn mở khoá các tài khoản đã chọn không?');
    if ($confirm == true) {
        $id_acc = [];

        $('#list_acc input[type="checkbox"]:checkbox:checked').each(function (i) {
            $id_acc[i] = $(this).val();
        });

        if ($id_acc.length === 0) {
            alert('Vui lòng chọn ít nhất một tài khoản.');
        }
        else {
            $.ajax({
                url: $_DOMAIN + 'templates/accounts.php',
                type: 'POST',
                data: {
                    id_acc: $id_acc,
                    action: 'unlock_acc_list'
                },
                success: function (data) {
                    location.reload();
                }, error: function () {
                    alert('Đã có lỗi xảy ra, hãy thử lại.');
                }
            });
        }
    }
    else {
        return false;
    }
});
// Mở tài khoản chỉ định trong bảng danh sách
$('.unlock-acc-list').on('click', function () {
    $confirm = confirm('Bạn có chắc chắn muốn mở khoá tài khoản này không?');
    if ($confirm == true) {
        $id_acc = $(this).attr('data-id');

        $.ajax({
            url: $_DOMAIN + 'templates/accounts.php',
            type: 'POST',
            data: {
                id_acc: $id_acc,
                action: 'unlock_acc'
            },
            success: function () {
                location.reload();
            }
        });
    }
    else {
        return false;
    }
});
// Xem ảnh avatar trước
function preUpAvt() {
    img_avt = $('#img_avt').val();
    $('#formUpAvt .box-pre-img').html('<p><strong>Ảnh xem trước</strong></p>');
    $('#formUpAvt .box-pre-img').removeClass('hidden');

    // Nếu đã chọn ảnh
    if (img_avt != '') {
        $('#formUpAvt .box-pre-img').html('<p><strong>Ảnh xem trước</strong></p>');
        $('#formUpAvt .box-pre-img').removeClass('hidden');
        $('#formUpAvt .box-pre-img').append('<img src="' + URL.createObjectURL(event.target.files[0]) + '" style="border: 1px solid #ddd; width: 50px; height: 50px; margin-right: 5px; margin-bottom: 5px;"/>');
    }
    // Ngược lại chưa chọn ảnh
    else {
        $('#formUpAvt .box-pre-img').html('');
        $('#formUpAvt .box-pre-img').addClass('hidden');
    }
}
// Upload ảnh đại diện
$('#formUpAvt').submit(function (e) {
    img_avt = $('#img_avt').val();
    $('#formUpAvt button[type=submit]').html('Đang tải ...');

    // Nếu có chọn ảnh
    if (img_avt) {
        size_img_avt = $('#img_avt')[0].files[0].size;
        type_img_avt = $('#img_avt')[0].files[0].type;

        e.preventDefault();
        // Nếu lỗi về size ảnh
        if (size_img_avt > 5242880) { // 5242880 byte = 5MB 
            $('#formUpAvt button[type=submit]').html('Upload');
            $('#formUpAvt .alert-danger').removeClass('hidden');
            $('#formUpAvt .alert-danger').html('Tệp đã chọn có dung lượng lớn hơn mức cho phép.');
            // Nếu lỗi về định dạng ảnh
        } else if (type_img_avt != 'image/jpeg' && type_img_avt != 'image/png' && type_img_avt != 'image/gif') {
            $('#formUpAvt button[type=submit]').html('Upload');
            $('#formUpAvt .alert-danger').removeClass('hidden');
            $('#formUpAvt .alert-danger').html('File ảnh không đúng định dạng cho phép.');
        } else {
            $(this).ajaxSubmit({
                beforeSubmit: function () {
                    target: '#formUpAvt .alert-danger',
                        $("#formUpAvt .box-progress-bar").removeClass('hidden');
                    $("#formUpAvt .progress-bar").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    $("#formUpAvt .progress-bar").animate({ width: percentComplete + '%' });
                    $("#formUpAvt .progress-bar").html(percentComplete + '%');
                },
                success: function (data) {
                    $('#formUpAvt button[type=submit]').html('Upload');
                    $('#formUpAvt .alert-danger').attr('class', 'alert alert-success');
                    $('#formUpAvt .alert-success').html(data);
                },
                error: function () {
                    $('#formUpAvt button[type=submit]').html('Upload');
                    $('#formUpAvt .alert-danger').removeClass('hidden');
                    $('#formUpAvt .alert-danger').html('Không thể upload hình ảnh vào lúc này, hãy thử lại sau.');
                },
                resetForm: true
            });
            return false;
        }
        // Ngược lại không chọn ảnh
    } else {
        $('#formUpAvt button[type=submit]').html('Upload');
        $('#formUpAvt .alert-danger').removeClass('hidden');
        $('#formUpAvt .alert-danger').html('Vui lòng chọn tệp hình ảnh.');
    }
});
// Xoá ảnh đại diện
$('#del_avt').on('click', function () {
    $confirm = confirm('Bạn có chắc chắn muốn xoá ảnh đại diện này không?');
    if ($confirm == true) {
        $.ajax({
            url: $_DOMAIN + 'templates/profile.php',
            type: 'POST',
            data: {
                action: 'delete_avt'
            }, success: function () {
                location.reload();
            }, error: function () {
                alert('Đã có lỗi xảy ra, vui lòng thử lại.');
            }
        });
    }
    else {
        return false;
    }
});