<?php
if (isset($_GET['msv'])) {
    $msv = $_GET['msv'];

    include_once '../Controller/StudentController.php';
    $studentController = new StudentController();
    $student = $studentController->getStudentById($msv);


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $msv = $_POST['msv'];
        $hoten = $_POST['hoten'];
        $gioitinh = $_POST['gioitinh'];
        $khoa = $_POST['khoa_select'];

        $studentController = new StudentController();
        $gt = $studentController->getGioitinh($gioitinh);
        $result = $studentController->updateStudent($msv, $hoten, $gt, $khoa);

        if ($result) {
            header('Location: StudentList.php');
            exit();
        } else {
            echo "<script>alert('Đã xảy ra lỗi khi cập nhật sinh viên')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sửa sinh viên</title>
</head>

<body>
    <div class="container">
        <a href="StudentList.php"><button>Quay lại</button></a>
        <form action="" method="post">
            <h1>Sửa thông tin sinh viên: <?php echo $student->hoten; ?></h1>
            <label for="msv">Mã SV: </label>
            <input type="text" id="msv" name="msv" readonly value="<?php echo  $student->msv ?>" /><br /><br>
            <label for="hoten">Họ tên: </label>
            <input type="text" id="hoten" name="hoten" value="<?php echo $student->hoten ?>" /><br /><br>
            <label for="gioitinh">Giới tính: </label>
            <input type="radio" name="gioitinh" id="nam" value="Nam" <?php echo $student->gioitinh == 'Nam' ? 'checked' : ''; ?>>
            <label for="nam">Nam</label>
            <input type="radio" name="gioitinh" id="nu" value="Nữ" <?php echo $student->gioitinh == 'Nữ' ? 'checked' : ''; ?>>
            <label for="nu">Nữ</label><br /><br>
            <label for="khoa_select">Khoa: </label>
            <select name="khoa_select" id="khoa_select">
                <option value="Khoa Toán" <?php echo $student->khoa == 'Khoa Toán' ? 'selected' : ''; ?>>Khoa Toán</option>
                <option value="Khoa Lý" <?php echo $student->khoa == 'Khoa Lý' ? 'selected' : ''; ?>>Khoa Lý</option>
                <option value="Khoa Hóa" <?php echo $student->khoa == 'Khoa Hóa' ? 'selected' : ''; ?>>Khoa Hóa</option>
                <option value="Khoa Công nghệ thông tin" <?php echo $student->khoa == 'Khoa Công nghệ thông tin' ? 'selected' : ''; ?>>Khoa Công nghệ thông tin</option>
            </select><br /><br>
            <input type="submit" name="submit" value="Lưu lại" />
        </form>

    </div>
</body>

</html>