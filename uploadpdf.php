<?php
require 'function.php';
if (isset($_POST['apply'])) {
    // Sanitize and validate input (add more validation as needed)
    $firstname = htmlspecialchars($_POST['firstname']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? $_POST['email'] : '';
    $city = htmlspecialchars($_POST['city']);
    $gender = ($_POST['gender'] === 'male' || $_POST['gender'] === 'female') ? $_POST['gender'] : '';
    $lastname = htmlspecialchars($_POST['lastname']);
    $phonenumber = htmlspecialchars($_POST['phonenumber']);
    $country = htmlspecialchars($_POST['country']);
    $birthdate = htmlspecialchars($_POST['birthdate']);
    $linkedin = htmlspecialchars($_POST['linkedin']);
    $message = htmlspecialchars($_POST['message']);

    // File upload validation and handling
    $allowedFileTypes = array('pdf', 'doc', 'docx');
    $maxFileSize = 5242880; // 5MB in bytes

    if (isset($_FILES["pdfFile"]) && $_FILES["pdfFile"]["error"] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES["pdfFile"]["tmp_name"];
        $fileName = $_FILES["pdfFile"]["name"];
        $fileType = $_FILES["pdfFile"]["type"];
        $fileSize = $_FILES["pdfFile"]["size"];

        // Validate file type and size
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedFileTypes)) {
            die("Error: Invalid file type. Allowed types are: " . implode(', ', $allowedFileTypes));
        }

        if ($fileSize > $maxFileSize) {
            die("Error: File size exceeds the maximum allowed limit.");
        }

        // Read file data as binary
        $fileData = file_get_contents($fileTmpPath);
        $fileData = mysqli_real_escape_string($koneksi, $fileData);
        $fileName = mysqli_real_escape_string($koneksi, $fileName);
    } else {
        // Handle file upload errors, if necessary
        $fileData = null;
        $fileName = null;
    }


    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($koneksi, "INSERT INTO job_apply (first_name, last_name, email, phone, city, country, gender, birthdate, file_name, file_data, linkedin, mess) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssssssss", $firstname, $lastname, $email, $phonenumber, $city, $country, $gender, $birthdate, $fileName, $fileData, $linkedin, $message);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        // Optionally, you can check if the insertion was successful
        // $affectedRows = mysqli_stmt_affected_rows($stmt);
    } else {
        // Handle error if the prepared statement fails
        die("Insertion failed: " . mysqli_error($koneksi));
    }

    // Close the database connection
    mysqli_close($koneksi);
}



?>