<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vietpharma_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $message = $_POST["message"];

    $name = mysqli_real_escape_string($conn, $name);
    $phoneNumber = mysqli_real_escape_string($conn, $phoneNumber);
    $email = mysqli_real_escape_string($conn, $email);
    $address = mysqli_real_escape_string($conn, $address);
    $message = mysqli_real_escape_string($conn, $message);

    // Câu truy vấn INSERT (đã loại bỏ chú thích sai vị trí)
    $sql = "INSERT INTO contacts (name, phoneNumber, email, address, message)
            VALUES ('$name', '$phoneNumber', '$email', '$address', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Dữ liệu đã được lưu thành công!";
        header("Location: thank_you.html");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>