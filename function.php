<?php


$host = "localhost";
$user = "root";
$pass = "";
$db = "datacenter";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if($koneksi){
	
}else{
	echo "Disconnected";
}


function subscribe($email, $type)
{
    global $koneksi;
    $checkExist = mysqli_query($koneksi, "SELECT id FROM subscription WHERE email = '$email' AND type = $type");
    if ($checkExist->num_rows < 1) {
        mysqli_query($koneksi, "INSERT INTO subscription (email, type) VALUES ('$email', $type)");
    }
}

function unsubscribe($email)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM subscription WHERE email = '$email'");
}