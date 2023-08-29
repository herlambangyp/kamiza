<?php
require "function.php";


// $sql = mysqli_query($koneksi, "SELECT * FROM tb_candidate");
$team = mysqli_query( $koneksi, "SELECT * FROM tb_team ORDER BY id ASC" );
$count = mysqli_query( $koneksi, "SELECT COUNT(job_name) AS jumlah FROM tb_candidate" );
$mvv = mysqli_query( $koneksi, "SELECT * FROM tb_mvv" );

$valuedes = mysqli_query( $koneksi, "SELECT * FROM tb_values" );

// Periksa apakah query berhasil dijalankan
if ( mysqli_num_rows( $count ) > 0 ) {
  // Ambil hasil dari query
  $data = mysqli_fetch_assoc( $count );
  $totalCount = $data[ 'jumlah' ];
} else {
  $totalCount = 0;
}


if ( isset( $_POST[ 'search_data' ] ) ) {
  $region = $_POST[ 'region' ];
  $skills = $_POST[ 'skills' ];
  $availability = $_POST[ 'availability' ];
  $experience = $_POST[ 'experience' ];

  $result = mysqli_query( $koneksi, "SELECT * FROM tb_candidate WHERE loc LIKE '%$region%' OR skill LIKE '%$skills%' OR avail LIKE '%$availability%' OR experience LIKE '%$experience%' GROUP BY id DESC" );
} else {
  $result = mysqli_query( $koneksi, "SELECT * FROM tb_candidate GROUP BY id DESC" );
}

$customers = mysqli_query($koneksi, "SELECT * FROM tb_customers");
$partners = mysqli_query($koneksi, "SELECT * FROM tb_partners");

?>

<?php
$itemsPerPage = 2; // Jumlah item yang akan ditampilkan per halaman
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Dapatkan nomor halaman saat ini dari parameter URL

// Hitung indeks awal untuk halaman saat ini
$startIndex = ($currentPage - 1) * $itemsPerPage;

$query = "SELECT * FROM tb_candidate";

// Query pencarian jika ada data POST dari form
if (isset($_POST['search_data'])) {
  $region = $_POST['region'];
  $skills = $_POST['skills'];
  $availability = $_POST['availability'];
  $experience = $_POST['experience'];

  $query .= " WHERE loc LIKE '%$region%' OR skill LIKE '%$skills%' OR avail LIKE '%$availability%' OR experience LIKE '%$experience%' GROUP BY id DESC ";
}

// Tambahkan LIMIT dan OFFSET ke query
$query .= " LIMIT $startIndex, $itemsPerPage";

$result = mysqli_query($koneksi, $query);

$count = mysqli_query($koneksi, "SELECT COUNT(job_name) AS jumlah FROM tb_candidate");

// Periksa apakah query berhasil dijalankan
if (mysqli_num_rows($count) > 0) {
  // Ambil hasil dari query
  $data = mysqli_fetch_assoc($count);
  $totalCount = $data['jumlah'];
} else {
  $totalCount = 0;
}

// Hitung total jumlah halaman
$totalPages = ceil($totalCount / $itemsPerPage);
$popup = mysqli_query($koneksi, "SELECT * FROM tb_sosmed");

// seach filter
//region
$regionF = mysqli_query($koneksi, "SELECT loc FROM tb_candidate GROUP BY loc");
$skillsF = mysqli_query($koneksi, "SELECT skill FROM tb_candidate GROUP BY skill");
$availabilityF = mysqli_query($koneksi, "SELECT avail FROM tb_candidate GROUP BY avail");
$experienceF = mysqli_query($koneksi, "SELECT experience FROM tb_candidate GROUP BY experience");

$input_region = [];
$input_skill = [];
$input_availability = [];
$input_experience = [];

if (isset($_POST['searching'])) {
  $input_region = $_POST['input_region'] ?? [];
  $input_skill = $_POST['input_skill'] ?? [];
  $input_availability = $_POST['input_availability'] ?? [];
  $input_experience = $_POST['input_experience'] ?? [];

  // Mulai query
  $query = "SELECT * FROM tb_candidate WHERE 1"; // WHERE 1 akan selalu benar, sehingga semua record dipertimbangkan

  // Tambahkan kondisi pencarian berdasarkan input yang ada
  if (!empty($input_region)) {
      $region_condition = " AND loc IN ('" . implode("', '", $input_region) . "')";
      $query .= $region_condition;
  }

  if (!empty($input_skill)) {
      $skill_condition = " AND skill IN ('" . implode("', '", $input_skill) . "')";
      $query .= $skill_condition;
  }

  if (!empty($input_availability)) {
      $availability_condition = " AND avail IN ('" . implode("', '", $input_availability) . "')";
      $query .= $availability_condition;
  }

  if (!empty($input_experience)) {
      $experience_condition = " AND experience IN ('" . implode("', '", $input_experience) . "')";
      $query .= $experience_condition;
  }

  // Eksekusi query
  $result = mysqli_query($koneksi, $query);

  // Eksekusi query untuk menghitung jumlah data yang sesuai dengan kriteria pencarian
  $countQuery = "SELECT COUNT(*) as total FROM tb_candidate WHERE 1";

  if (!empty($input_region)) {
      $countQuery .= $region_condition;
  }

  if (!empty($input_skill)) {
      $countQuery .= $skill_condition;
  }

  if (!empty($input_availability)) {
      $countQuery .= $availability_condition;
  }

  if (!empty($input_experience)) {
      $countQuery .= $experience_condition;
  }

  $countResult = mysqli_query($koneksi, $countQuery);
  $rowCount = mysqli_fetch_assoc($countResult)['total'];
} else {
  // Eksekusi query untuk menghitung keseluruhan data
  $countQuery = "SELECT COUNT(*) as total FROM tb_candidate";
  $countResult = mysqli_query($koneksi, $countQuery);
  $rowCount = mysqli_fetch_assoc($countResult)['total'];

   // Eksekusi query tanpa filter
  $result = mysqli_query($koneksi, "SELECT * FROM tb_candidate group by id desc");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Kemizares-customers-partners</title>
<meta content="" name="description">
<meta content="" name="keywords">

<!-- Favicons -->
<link href="assets/img/ikonwebkam.png" rel="icon">
<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="assets/vendor/aos/aos.css" rel="stylesheet">
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Template Main CSS File -->
<link href="assets/css/style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> 
    <script>
$(document).ready(function(){
    var result1Content = $('#result1').html(); // Simpan konten dari result1
    var result2Content = ''; // Inisialisasi variabel untuk menyimpan konten result2

    $('#search').on('input', function(){
        var query = $(this).val();
        if (query !== '') {
            $('#result1').html(''); 
            $('#result2').show(); 
            $.ajax({
                url: "search.php",
                method: "POST",
                data: { query: query },
                success: function(data){
                    result2Content = data;
                    $('#result2').html(data);
                    pagination();
                    pemanggiljam();
                    submitpropose();
                }
            });
        } else {
            $('#result1').html(result1Content);
            $('#result2').html(''); 
			      pagination();
            pemanggiljam();
            submitpropose();
        }
    });
});
    </script>
	
	
	<!-- =======================================================
  * Template Name: Squadfree - v4.11.0
  * Template URL: https://bootstrapmade.com/squadfree-free-bootstrap-template-creative/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- End Contact Section --> 
  
  <!-- ..................... -->
  
  <style>
		.candidate-info{
			margin-top: 40%;
		}		
.resize {
  height: 521px;
  width: 385px;
  padding: 34px;
  margin-bottom: 80px;
  background: #000000;
  text-align: center;
  position: relative;
  box-shadow: 0 5px 3px rgba(0, 0, 0, 0.5);
		}

	.resize:hover h4,
.resize:hover h6,
.resize:hover p,
.resize:hover li,
.resize:hover a
{
  color: black;
}
.resize:hover {
  background-color: white;
}
.resize:hover img {
	filter: invert(100%);}		
		.row .candidate-info .candidates-left{
	position: relative;
font-family: 'Mulish';
font-style: normal;
font-weight: 400;
font-size: 20px;
line-height: 25px;
letter-spacing: 0.05em;
color: rgba(255, 255, 255, 0.6);
		}
		
  .row .candidate-info .candidates-right{
position: relative;
font-family: 'Mulish';
font-style: normal;
font-weight: 300;
font-size: 20px;
line-height: 25px;
letter-spacing: 0.05em;
color: #FFFFFF ;	  

  }
  .form-control {
  border: none;
  border-bottom: 1px solid black;
  border-radius: 0;
  padding: 5px 0;
  background-color: transparent;
  box-shadow: none;
  color: black;

  }

  .form-controls {
  position: absolute;
  height: 20px;
  left: 79px;
  top: 396px;
  font-family: 'Mulish';
  font-style: normal;
  font-weight: 700;
  font-size: 16px;
  line-height: 20px;
  letter-spacing: 0.05em;
  color: #000000;
  

  position: absolute;
  width: 273px;
  height: 26px;
  left: 45%;
  top: 63%;
  border: solid #999999;
  border-width: 2px;
  font-weight: 800;
  }

  .row .view-more-a .read-more-button {
display: flex;
    align-items: center;
    justify-content: center;
    width: 100px;
    height: 30px;
    background-color: #858585;
    color: #ffffff;
    border-radius: 5px;
    text-decoration: none;
    bottom: -10%;
    left: 50%;
    transform: translate(-50%, -50%);
    position: relative;
font-family: 'Inter';
font-style: normal;
font-weight: 600;
font-size: 14px;
line-height: 24px;
display: flex;
align-items: center;
text-align: center;
letter-spacing: 0.5px;

color: #FFFFFF
	}
  .form-control-subsub {
  border-bottom: 1px solid black;
  border-radius: 0;
  background-color: transparent;
  color: #000000;
  margin-left: 125px;
  margin-right: -230px;
  }
  .form-control:focus {
  outline: none;
  border-bottom: 1px solid blue;

  }

  .form-controll {
  border: none;
  border-bottom: 1px solid black;
  border-top: 1px solid black;
  border-right: 1px solid black;
  border-left: 1px solid black;
  border-radius: 0;
  padding-right: 100px;
  width: 410px; /* Menentukan lebar kotak input */
  height: 100px; /* Menentukan tinggi kotak input */
  background-color: transparent;
  box-shadow: none;
  color: black;
  margin-top: 43px;
  margin-left: -90px;
  margin-right: 7px;
  }


  .form-controll:focus {
  outline: none;
  border-bottom: 1px solid blue;
  }

  .form-control::placeholder {
  color: black;
  }

  .form-controll::placeholder {
  color: black;
  }
  .modal-lg {
  max-width: 1000px;
  }

  .modal-body {
  display: flex;
  }

  .contact-info {
  padding: 20px;
  background-color: #f8f9fa;
  border-radius: 0px;
  }

  .contact-info h3 {
  margin-bottom: 15px;
  }


  .social-links a {
  margin-right: 10px;
  }

  .modal-content {
  width: 150%;
  margin-left: -25%;
  }

  .modal-contentt {
  width: 80%;
  margin-left: 50px;


  }

  .modal-title {
  text-align: center;
  }
  
  /*-- css Contact Information --*/
  
  .contact-info {
  padding: 20px;
  background-color: #f8f9fa;
  border-radius: 0px;
  }

  .contact-info h3 {
  margin-bottom: 60px;
  }


  .contact-info .social-links {
  margin-left: 13px;
  margin-right: -5px;
  margin-top: 200px;
  }

  .contact-info .social-links a {
  margin: 35px;
  font-size: 20px; /* Ubah ukuran ikon sesuai kebutuhan */
  }

  .bg {
  background-color: #000000;
  color: white;
  margin-left: 37px;
  }

  .bgo {
    background-color: transparent;
    color: white;
    margin-left: 0px;
  }

  .bgoo {
  background-color: #000000;
  color: white;
  margin-left: 37px;
  }

  
  /*-- css icon social-links --*/
  
  .social-links {
  display: flex;
  flex-direction: row;
  }

  .social-links a {
  display: inline-block;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  text-align: center;
  line-height: 32px;
  }

  /*---------------------------------------
  Get Notify bar 
  -----------------------------------------*/
  .closemail {
  position: absolute;
  top: -6px;
  right: 95px;
  color: #000;
  opacity: 1;
  font-size: 27px;
  font-weight: bold;
  transition: opacity 0.3s;
  background-color: transparent;
  border: hidden;
  }

  .closemail:hover {
  opacity: 0.5;
  }

  .bgmnone {
  border: hidden;
  width: 150%;
  margin-left: -25%;
  border-radius: 0px;
  margin-top: 200px;
  background: rgba(255, 255, 255, 0.0);
  }

  .boxgetemail {
  background: #FFFFFF;
  max-width: 100%;
  width: 540px;
  }

  .boxgetemail h4 {
  margin-top: 4%;
  margin-bottom: 5%;
  text-align: center;
  font-size: 20px;
  font-weight: 600;
  font-family: inter;
  }

  .form-control {
  display: inline-block;
  background-color: #F4F4F4;
  height: 48px;
  max-width: 100%;
  font-family: mulish;
  left: 50%;
  right: 50;
  margin-bottom: 5%;
  /*      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);*/
  }

  .form-controlll {
  display: inline-block;
  background-color: #F4F4F4;
  height: 48px;
  max-width: 90%;
  font-family: mulish;
  left: 50%;
  right: 50;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  border-radius: 6px;
  width: 600px;
  padding: 15px;
  border: 1px solid #ced4da;
  }

  .btnmail:hover {
  background-color: #B3B3B3;
  color: #000000;
  }

  .btnmail {
  width: 100%;
  max-width: 106px;
  background-color: #424242;
  color: #fff;
  height: 35px;
  margin-top: 36px;
  border: hidden;
  border-radius: 7px;
  margin-bottom: 4.5%;
  }

  .boxTQ {
  background: #FFFFFF;
  max-width: 100%;
  width: 540px;
  }

  .boxTQ img {
  margin-left: 46%;
  width: 50px;
  height: 44px;
  max-width: 100%;
  margin-top: 4%;
  }

  .boxTQ h4 {
  text-align: center;
  font-size: 24px;
  font-weight: 600;
  font-family: inter;
  }

  .boxTQ h6 {
  font-size: 14px;
  text-align: center;
  font-weight: 400;
  }

  .form-controlll.error {
  border-color: red;
  }

  .error-message {
  color: red;
  font-size: 12px;
  margin-top: -4.5%;
  margin-left: 35px;
  }
	  
/*-------------------------------------------------
	CSS untuk tulisan jumlah avaialable candidate
--------------------------------------------------*/	
      .tulisan h1{
          font-size: 175px;
     font-weight: bold;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
          color: #FFFFFF;

      }
      .tulisan h5{
      font-size: 34px;
      position: absolute;
      bottom: 5%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #FFFFFF;
      width: 100%;
      }	
/*-------------------------------------------------
	END CSS untuk tulisan jumlah avaialable candidate
--------------------------------------------------*/	  
	  
  .form-group {
  display: flex;
  align-items: center;

  }

  .form-group label {
  flex: 0 0 80px; /* Sesuaikan lebar label sesuai kebutuhan */
  margin-right: 10px; /* Sesuaikan jarak antara label dan select input */
  margin-top: -107px;
  }

  .form-group .form-control {
  flex: 1;
  margin-right: 10px; /* Sesuaikan jarak antara select input */
  background: transparent;
  }

  .form-control-subb {
  border: none;
  border-bottom: 1px solid black;
  border-top: 1px solid black;
  border-right: 1px solid black;
  border-left: 1px solid black;
  border-radius: 0;
  padding: 5px 0;
  background-color: transparent;
  box-shadow: none;
  color: black;
  margin-right: 0px;
  margin-left: 15px;


  }

  .form-group {
  display: flex;
  align-items: center;
  }

  .form-group label {
  flex: 0 0 80px; /* Sesuaikan lebar label sesuai kebutuhan */
  margin-right: 10px; /* Sesuaikan jarak antara label dan select input */
  }

  .form-group .form-control {
  flex: 1;
  margin-right: 10px; /* Sesuaikan jarak antara select input */
  }

  .form-control-subb {
  border: none;
  border-bottom: 1px solid black;
  border-radius: 0;
  padding: 5px 0;
  background-color: transparent;
  box-shadow: none;
  color: black;
  margin-right: -410px;
  }
  .jamulai{
  margin-left: 5%;

  }
  .jementek{
  margin-left: 5%;

  }

  .kalender{
  border-bottom: 1px solid black;
  border-radius: 0;
  background-color: transparent;
  color: #000000;
  margin-left: 5%;
  }


  .modal-box {
  box-sizing: border-box;
  position: relative;
  width: 621px;
  height: 629px;
  background: #FFFFFF;
  border: 0.2px solid #2F2F2F;
  margin-left: -15%;
  margin-top: 3%;
  }
  .purpose-close {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 24px;
  color: #000000;
  background: transparent;
  border: none;
  cursor: pointer;
  }

  .propose-meeting {
  position: absolute;
  height: 60px;
  left: 88px;
  top: 44px;
  font-family: 'Mulish';
  font-style: normal;
  font-weight: 700;
  font-size: 48px;
  line-height: 60px;
  letter-spacing: 0.05em;
  color: #000000;
  }

  .mobile-app-developer {
  position: absolute;
  height: 25px;
width: 100%;
	  text-align: center;
  top: 115px;
  font-family: 'Mulish';
  font-style: normal;
  font-weight: 400;
  font-size: 20px;
  line-height: 25px;
  letter-spacing: 0.05em;
  color: #000000;
  }

  .select-date {
  position: absolute;
  height: 20px;
  left: 79px;
  top: 179px;
  font-family: 'Mulish';
  font-style: normal;
  font-weight: 700;
  font-size: 16px;
  line-height: 20px;
  letter-spacing: 0.05em;
  color: #000000;
  }
  #ikontanggal img{

  position: absolute;
  left: 34%;
  top: 181px;
  z-index: 0;
  width: 16px;
  height: 20px;

  }

  .input-select-date {
  position: absolute;
  text-align: left;
  height: 20px;
  left: 34%;
  top: 29%;
  border: hidden;
  font-weight: 800;
  background-color: transparent;
  width: 27%;

  }

  #input-select-date{
  display: block;

  }
  .input-select-date::-webkit-calendar-picker-indicator {
  background-image: url('assets/img/icondate.png');
  background-size: cover;
  width: 20px;
  height: 20px;
  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  cursor: pointer;
  }

  .modal-box input[type="date"]:in-range::-webkit-datetime-edit-year-field, 
  .modal-box input[type="date"]:in-range::-webkit-datetime-edit-month-field, 
  .modal-box input[type="date"]:in-range::-webkit-datetime-edit-day-field, 
  .modal-box input[type="date"]:in-range::-webkit-datetime-edit-text { 	
  color: transparent; 
  }


  .modal-box input[type="time"]::-webkit-calendar-picker-indicator { 
  background-image: url('assets/img/cawang.png');
  position: absolute;
  width: 12px;
  height: 7px;
  right: 3%;;		  
  } 

  .start-time {
  position: absolute;
  height: 20px;
  left: 79px;
  top: 243px;
  font-family: 'Mulish';
  font-style: normal;
  font-weight: 700;
  font-size: 16px;
  line-height: 20px;
  letter-spacing: 0.05em;
  color: #000000;
  }

  .input-start-time {
  position: absolute;
  height: 52px;
  width: 142px;
  left: 34%;
  top: 36%;
  border: solid #999999;
  border-width: 2px; 
  font-weight: 700; }

  .stop-time {
  position: absolute;
  height: 20px;
  left: 79px;
  top: 325px;
  font-family: 'Mulish';
  font-style: normal;
  font-weight: 700;
  font-size: 16px;
  line-height: 20px;
  letter-spacing: 0.05em;
  color: #000000;
  }

  .input-stop-time {
  position: absolute;
  height: 52px;
  width: 142px;
  left: 34%;
  top: 49%;
  border: solid #999999;
  border-width: 2px;
  font-weight: 700;	
  }  

  .email-to-be-contacted {
  position: absolute;
  height: 20px;
  left: 79px;
  top: 396px;
  font-family: 'Mulish';
  font-style: normal;
  font-weight: 700;
  font-size: 16px;
  line-height: 20px;
  letter-spacing: 0.05em;
  color: #000000;
  }


  .input-email {
  position: absolute;
  width: 273px;
  height: 26px;
  left: 45%;
  top: 63%;
  border: solid #999999;
  border-width: 2px;
  font-weight: 800;
  }


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

        .transparent-input {
            background-color: transparent;
            border: 2px solid #999999;
            font-weight: 800;
            /* Tambahan styling sesuai kebutuhan Anda */
        }
    

    



  .submit-button {
  position: absolute;
  width: 205px;
  height: 36px;
  left: 196px;
  top: 517px;
  background: rgba(0, 0, 0, 0.7);
  opacity: 0.6;
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  border: hidden;
  }

  .submit-button-text {
  font-family: 'Inter';
  font-style: normal;
  font-weight: 600;
  font-size: 14px;
  line-height: 24px;
  letter-spacing: 0.5px;
  color: #FFFFFF;
  }

  .mboh{
  font-family: 'Mulish';
  font-style: normal;
  font-weight: 500;
  font-size: 15px;
  color: #D80027;
  }
  #emailsalah{
  display: none;
  position: absolute;
  top: 68%;
  left: 45%;
  }
  #jamenteksalah{
  display: none;
  position: absolute;
  left: 62%;
  top: 50%;
  }
  #jamulai-salah{
  display: none;
  position: absolute;
  left: 62%;
  top: 36%;
  }
  #tanggalsalah{
  display: none;
  position: absolute;
  left: 62%;
  top: 29%;
  }
  
  .cuaks {
  border: hidden;
  width: 150%;
  margin-left: -25%;
  border-radius: 0px;
  margin-top: 200px;
  background: rgba(255, 255, 255, 0.0);
  }
  .btnmail:hover {
  background-color: #B3B3B3;
  color: #000000;
  }

  .btnmail {
  width: 100%;
  max-width: 136px;
  background-color: #666666;
  color: #fff;
  height: 35px;
  margin-top: 36px;
  border: hidden;
  border-radius: 7px;
  margin-bottom: 4.5%;
  }
  .boxTQjam {
  background: #FFFFFF;
  position: absolute;
  top: 171%;
  width: 540px;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
  }

  .boxTQjam img {
  margin-left: 46%;
  width: 50px;
  height: 44px;
  max-width: 100%;
  margin-top: 4%;
  }

  .boxTQjam h4 {
  text-align: center;
  font-size: 24px;
  font-weight: 600;
  font-family: inter;
  }

  .boxTQjam h6 {
  position: relative;
  width: 401px;
  height: 54px;
  left: 76px;
  top: 27px;
  font-family: 'Mulish';
  font-style: normal;
  font-weight: 600;
  font-size: 14px;
  line-height: 18px;
  display: flex;
  align-items: center;
  text-align: center;
  color: #000000;
  }
  #start-time img{
  position: absolute;
  top: 27%;
  left: 276%;
  width: 12px;
  height: 7px;
  z-index: 1;
  }

  #stop-time img{
  position: absolute;
  top: 47%;
  left: 288%;
  width: 12px;
  height: 7px;
  z-index: 1;
  }
  .check-logo {
  position: relative;
  width: 40px;
  height: 40px;
  left: 257px;
  top: 13px;
  background: #2EBB55;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  }

  .check-logo::before {
  content: "";
  position: relative;
  width: 16px;
  height: 8px;
  border-style: solid;
  border-width: 0 3px 3px 0;
  border-color: #FFFFFF;
  transform: rotate(45deg);
  }	    
    
    .smalltittle{
      color:#9B9B9B; 
      margin-bottom: -6%;
    }
      .tulisan h1{
          font-size: 175px;
     font-weight: bold;
        position: absolute;
        top: 50%; 
        left: 50%;
        transform: translate(-50%, -50%);
          color: #FFFFFF;

      }
      .tulisan h5{
      font-size: 34px;
      position: absolute;
      bottom: 5%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #FFFFFF;
      width: 100%;
      } 
      .sisi-kanan {
    position: relative;
    font-family: 'Mulish';
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 18px;
    letter-spacing: 0.05em;
    text-align: revert;
    width: 100%;
    right: 0px;
  }   
   
        .sisi-kiri{
    position: relative;
    font-family: 'Mulish';
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 18px;
    letter-spacing: 0.05em;
    text-align: left;
  width: 100%;    
    }
	
    .row ul{
    position: relative;
    font-family: 'Mulish';
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 18px;
    letter-spacing: 0.05em;
    color: #FFFFFF;
    }
    .row a{
position: relative;
font-family: 'Mulish';
font-style: normal;
font-weight: 300;
line-height: 25px;
align-items: flex-end;
letter-spacing: 0.05em;
color: #FFFFFF;


    }
    .col6-right{
      position: relative;
    display: flex;
    justify-content: center;
    right: 5%;
    }

  /* Style untuk tautan */
  .my-link {
    text-decoration: none;
    position: relative; /* Menambahkan positioning */
    color: #9b9b9b; /* Ganti warna teks jika diperlukan */
    margin-left: -2px;
  }

  /* Style untuk garis putih */
  .my-link::after {
    content: '';
    display: block;
    position: absolute;
    bottom: -2px; /* Mengatur spasi antara garis dan teks (dapat disesuaikan) */
    left: 0;
    right: 0;
    height: 1px;
    background-color: #9b9b9b;
  }


    .check-logo::before {
    content: "";
    position: relative;
    width: 10px;
    height: 20px;
    border-style: solid;
    border-width: 0 3px 3px 0;
    border-color: #FFFFFF;
    transform: rotate(43deg);
}

</style>

  <!-- ..................... --> 
<!-- ======= Header ======= -->
<header id="header" class="fixed-top header-transparent">
  <div class="container d-flex align-items-center justify-content-between position-relative">
    <div class="logo"> 
      <!-- <h1 class="text-light"><a href="index.php"><span>Squadfree</span></a></h1> --> 
      <!-- Uncomment below if you prefer to use an image logo --> 
      <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> </div>
    <nav id="navbar" class="navbar d-flex">
      <ul id="bagtulis">
        <!-- Home --> -
        <!-- <li><a class="nav-link scrollto active" href="#hero">JOIN US</a></li> -->
        <li class="dropdown"><a href="#"><span>JOIN US</span> <i></i></a>
          <ul>
            <li><a class="nav-link scrollto active" href="index-available.php#availablepositions">Available Positions</a></li>
            <li><a class="nav-link scrollto active" href="index-available.php#meetourteam">Meet Our Team</a></li>
          </ul>
        </li>
        
        <!-- About Us -->
        <li><a class="nav-link scrollto " href="index-whatweoffer.php#whatweoffer">WHAT WE OFFER</a></li>
        <!-- Services --> 
        <!-- <li><a class="nav-link scrollto" href="#services">CUSTOMERS & PARTNERS</a></li> -->
        <li class="dropdown"><a href="#"><span>CUSTOMERS & PARTNERS</span> <i></i></a>
          <ul>
            <li><a class="nav-link scrollto active" href="index-candidates.php#">Available Candidates</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link scrollto" href="Contact.php">CONTACT</a></li>
	<ul id="dunya">
        <li class="dropdown" id="kotak"><a href="#"><img src="assets/img/globe.png" class="logo-dunia"></a>
          <ul class="languagechose">
            <li><img src="assets/img/swe.png" class="logo-bendera" alt=""><a href="#" onclick="selectSwedish(); gantiunsub();">SWE</a></li>
            <li><i>&nbsp;&nbsp;&nbsp;</i></li>
            <li><img src="assets/img/eng.png" class="logo-bendera" alt=""><a href="#" onclick="selectEnglish()">ENG</a></li>
          </ul>
        </li>
      </ul>
      <div class="translate-container">
<style>
.skiptranslate{
    margin-bottom: -40px;
    opacity: 0;	
	}	

	
	body .VIpgJd-yAWNEb-VIpgJd-fmcmS-sn54Q {
    background-color: transparent;
    box-shadow: 2px 2px 4px transparent;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    position: relative;
	}	  
	
	</style>		  
    <button class="translate-button" onclick="toggleTranslation()" style="display: none;">
          <img src="assets/img/globe.png" class="logo-dunia" alt="">
    </button>
    <div class="translate" id="google_translate_element" style="display: none;"></div>
<script type="text/javascript">
function gantiunsub(){
	
document.getElementById("btn-unsubs").textContent = "Avprenumerera";
}	
	
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({ pageLanguage: 'en', includedLanguages: 'en,sv'}, 'google_translate_element');
    }
    function selectSwedish() {
  var optionElement = document.querySelector('.goog-te-combo option[value="sv"]');
  optionElement.selected = true;

  var selectElement = document.querySelector('.goog-te-combo');
  selectElement.dispatchEvent(new Event('change'));
}
function selectEnglish() {
  var optionElement = document.querySelector('.goog-te-combo option[value="en"]');
  optionElement.selected = true;

  var selectElement = document.querySelector('.goog-te-combo');
  selectElement.dispatchEvent(new Event('change'));

  var imgElement = document.querySelector('img[alt="close"]');
  imgElement.click();

}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		  
</div>      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i> </nav>
    <!-- .navbar --> 
    
  </div>
</header>
<!-- End Header -->

<main id="main">

<!-- ======= Contact Section ======= -->
<section id="availablecandidates" class="contact section-bgg">


   


<div class="container" data-aos="fade-up">
<div class="row">
  <h2><?php foreach ($mvv as $mv){
      
  ?>
  <div class="col-lg-12" style="margin-top: 90px;">
    <div class="info-box-candidates"> <img class="icon-candidates" src="assets/img/dart.png">
      <h3>Our Mission</h3>
      <h5 class="font-wwo"> <?= $mv['mission'];?> </h5>
      <garis></garis>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="info-box-candidates"> <img class="icon-candidates" src="assets/img/eye.png">
      <h3>Our Vision</h3>
      <h5 class="font-wwo"><span class="dot-a"></span><?= $mv['vision'];?> </h5>
      <garis></garis>
    </div>
  </div>
  <?php

  } ?>
  
  <div class="col-lg-12">
    <div class="info-box-candidates-diamon mb-4"> <img class="icon-candidates-diamon" src="assets/img/diamon.png"> </div>
    <h3 class="our-values">Our Values</h3>
    <div class="font-wwoo"><br>     
      <?php foreach($valuedes as $vd) { ?>
      <li>
        <!-- <p>Relationships - engaged long-term relationships</p> -->
        <p><?= $vd['descr']; ?></p>
      </li>
      <?php } ?>


      <!-- <br>
      <li>
        <p>Simlicity - close contact to work efficiently</p>
      </li>
      <br>
      <li>
        <p>Commitment - provide quality and take ownership of our work</p>
      </li>
      <br>
      <li>
        <p>Collaboration - work together</p>
      </li> -->
    </div>
  </div>
</div>
</section>

<!-- End Contact Section --> 

<!-- ======= Available Candidates ======= -->

<section id="availablecandidates" class="pricing section-bgg">
<div class="container">
<div class="section-title-candidates">
<h2 data-aos="fade-in">AVAILABLE CANDIDATES</h2>

<!-- pop up tombol di kanan -->
<?php foreach($popup as $pp){?>
<div class="rightcontactt">
  <div id="rightboxx" class="rightboxx">
    <h1>Want to become a <br>
      part of Kemizares team?</h1>
    <p class="email">Visit us or email us!</p>
    <img src="assets/img/siderightt.png"  id="siderightt-img" class="siderghtt-img" alt=""> <img src="assets/img/GPSalm.png" class="gpsimgg" alt=""><a target="_blank" href="<?php echo $pp['link_address']; ?>" class="gpstextt">Kemizares AB, C/O United Spaces,
    Pumpgatan 1, 417 55 Gothenburg</a> <img src="assets/img/mail.png" class="mailimgg" alt=""><a class="text-white-black mailtextt"href="<?php echo $pp['link_email']; ?>">contact@kemizares.se</a> </div>
  <div id="rightnavv" class="rightnavv">
    <h1><img src="assets/img/sideleftt.png" class="ikon-kirii" alt=""></h1>
  </div>
</div>
<?php }?>

<!-- end pop up tombol di kanan -->
<form action="#" method="POST">
<div class="search-container">
    <a class="right-link-candidates" data-toggle="modal" data-target="#modalSubscriptionForm"> <i class="bi bi-bell"></i> Get an email notification when new candidates are added </a>
<div class="search-box-candidates" data-aos="fade-in" onload="kotakcari()">
    <img src="assets/img/ikon search-white.png" class="ikon-cilik-candidates" style="filter: invert(100%);">
<input type="text" id="search" id="live_search" placeholder="Title or Keyword" class="bi-search-candidates kotakcari" oninput="inputkosong();">
    <a class="resetcari" onclick="resetInput()"><span>&times;</span></a>
    <button name="searching" type="submit">Search</button>
</div>
<script>
function resetInput() {
    console.log("Reset button clicked"); 
    var inputElement = document.getElementById("search");
    inputElement.value = ""; 
    inputElement.dispatchEvent(new Event("input"));
}
</script>
<script>
</script>
  </div>
  <div class="row">	    
	  
  <div class="col-md-2">
    <div class="custom-dropdown" id="region-dropdown">
      <p id="region-dropdown-btn" class="form-select custom-select-filter region"><?= !empty($input_region) ? implode(", ", $input_region) : "Region" ?></p>
      <div class="custom-dropdown-content form-select custom-select-pilihan region" id="region-dropdown-content">
        <?php foreach($regionF as $rf) {?>
        <label class="judul-filter" id="judul-filter" <?php echo in_array($rf['loc'], $input_region) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
        <input type="checkbox" name="input_region[]" value="<?php echo $rf['loc']; ?>" <?php echo in_array($rf['loc'], $input_region) ? 'checked' : ''; ?>><p class="pilihan-opsi"><?php echo $rf['loc']; ?></p>
        </label>
        <?php }?>
      </div>
    </div>
  </div>
              
  <div class="col-md-2">
    <div class="custom-dropdown" id="skills-dropdown">
      <p id="skills-dropdown-btn" class="form-select custom-select-filter skills"><?= !empty($input_skill) ? implode(", ", $input_skill) : "Skills" ?></p>
      <div class="custom-dropdown-content form-select custom-select-pilihan skills" id="skills-dropdown-content">
      <?php foreach($skillsF as $sf) {?>
        <label class="judul-filter" id="skills-filter" <?php echo in_array($sf['skill'], $input_skill) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_skill[]" value="<?php echo $sf['skill']; ?>" <?php echo in_array($sf['skill'], $input_skill) ? 'checked' : ''; ?>><p class="pilihan-opsi"><?php echo $sf['skill'];?></p>
        </label>  
        <?php }?>      
      </div>
    </div>
  </div>

  <div class="col-md-2">
    <div class="custom-dropdown" id="availability-dropdown">
      <p id="availability-dropdown-btn" class="form-select custom-select-filter availability"><?= !empty($input_availability) ? implode(", ", $input_availability) : "Availability" ?></p>
      <div class="custom-dropdown-content form-select custom-select-pilihan availability" id="availability-dropdown-content">
        <label class="judul-filter" id="judul-filter" <?php echo in_array('1 month', $input_availability) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_availability[]" value="1 month" <?php echo in_array('1 month', $input_availability) ? 'checked' : ''; ?>><p class="pilihan-opsi">1 Month</p>
        </label>
        <label class="judul-filter" id="judul-filter" <?php echo in_array('2 month', $input_availability) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_availability[]" value="2 month" <?php echo in_array('2 month', $input_availability) ? 'checked' : ''; ?>><p class="pilihan-opsi">2 Months</p>
        </label>
        <label class="judul-filter" id="judul-filter" <?php echo in_array('3 month', $input_availability) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_availability[]" value="3 month" <?php echo in_array('3 month', $input_availability) ? 'checked' : ''; ?>><p class="pilihan-opsi">3 Months</p>
        </label>
        <label class="judul-filter" id="judul-filter" <?php echo in_array('4 month', $input_availability) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_availability[]" value="4 month" <?php echo in_array('4 month', $input_availability) ? 'checked' : ''; ?>><p class="pilihan-opsi">4 Months</p>
        </label>
        <label class="judul-filter" id="judul-filter" <?php echo in_array('5 month', $input_availability) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_availability[]" value="5 month" <?php echo in_array('5 month', $input_availability) ? 'checked' : ''; ?>><p class="pilihan-opsi">5 Months</p>
        </label>
        <label class="judul-filter" id="judul-filter" <?php echo in_array('6 month', $input_availability) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_availability[]" value="6 month" <?php echo in_array('6 month', $input_availability) ? 'checked' : ''; ?>><p class="pilihan-opsi">6 Months</p>
        </label>
        <label class="judul-filter" id="judul-filter" <?php echo in_array('7 month', $input_availability) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_availability[]" value="7 month" <?php echo in_array('7 month', $input_availability) ? 'checked' : ''; ?>><p class="pilihan-opsi">7 Months</p>
        </label>
        <label class="judul-filter" id="judul-filter" <?php echo in_array('8 month', $input_availability) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_availability[]" value="8 month" <?php echo in_array('8 month', $input_availability) ? 'checked' : ''; ?>><p class="pilihan-opsi">8 Months</p>
        </label>
        <label class="judul-filter" id="judul-filter" <?php echo in_array('9 month', $input_availability) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_availability[]" value="9 month" <?php echo in_array('9 month', $input_availability) ? 'checked' : ''; ?>><p class="pilihan-opsi">9 Months</p>
        </label>
        <label class="judul-filter" id="judul-filter" <?php echo in_array('10 month', $input_availability) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_availability[]" value="10 month" <?php echo in_array('10 month', $input_availability) ? 'checked' : ''; ?>><p class="pilihan-opsi">10 Months</p>
        </label>
        <label class="judul-filter" id="judul-filter" <?php echo in_array('11 month', $input_availability) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_availability[]" value="11 month" <?php echo in_array('11 month', $input_availability) ? 'checked' : ''; ?>><p class="pilihan-opsi">11 Months</p>
        </label>
        <label class="judul-filter" id="judul-filter" <?php echo in_array('12 month', $input_availability) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_availability[]" value="12 month" <?php echo in_array('12 month', $input_availability) ? 'checked' : ''; ?>><p class="pilihan-opsi">12 Months</p>
        </label>
      </div>
    </div>
  </div>
      
  <div class="col-md-2">
    <div class="custom-dropdown" id="experience-dropdown">
      <p id="experience-dropdown-btn" class="form-select custom-select-filter experience"><?= !empty($input_experience) ? implode(", ", $input_experience) : "Experience" ?></p>
      <div class="custom-dropdown-content form-select custom-select-pilihan experience" id="experience-dropdown-content">
        <label class="judul-filter" id="judul-filter" <?php echo in_array('0-2 years', $input_experience) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_experience[]" value="0-2 years" <?php echo in_array('0-2 years', $input_experience) ? 'checked' : ''; ?>><p class="pilihan-opsi">0-2 Years</p>
        </label>
        <label class="judul-filter" id="judul-filter" <?php echo in_array('3-5 years', $input_experience) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_experience[]" value="3-5 years" <?php echo in_array('3-5 years', $input_experience) ? 'checked' : ''; ?>><p class="pilihan-opsi">3-5 Years</p>
        </label>
        <label class="judul-filter" id="judul-filter" <?php echo in_array('6-8 years', $input_experience) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_experience[]" value="6-8 years" <?php echo in_array('6-8 years', $input_experience) ? 'checked' : ''; ?>><p class="pilihan-opsi">6-8 Years</p>
        </label>
        <label class="judul-filter" id="judul-filter" <?php echo in_array('9-11 years', $input_experience) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_experience[]" value="9-11 years" <?php echo in_array('9-11 years', $input_experience) ? 'checked' : ''; ?>><p class="pilihan-opsi">9-11 Years</p>
        </label>
        <label class="judul-filter" id="judul-filter" <?php echo in_array('12 +years', $input_experience) ? 'style="background-color: rgb(153, 153, 153); color: rgb(31, 31, 31);"' : ''; ?>>
          <input type="checkbox" name="input_experience[]" value="12 +years" <?php echo in_array('12 +years', $input_experience) ? 'checked' : ''; ?>><p class="pilihan-opsi">12 +Years</p>
        </label>        
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <button class="reset-buton" onclick="resetFilter()">Reset</button>
      </div>
  </div>
  
</form>
	<script>
	</script>	
<section> </section>

<!-- -------start------------------ -->

<!-- ------end--------------- --> 

<!-- -----------start---------- -->
<div id="result" class="posts-list" style="min-height: 1131px;">
<div id="result1">
  <div class="row no-gutters maksimal-3-item-2-baris">
    <div class="col-lg-4 box resize tulisan" data-aos="zoom-in" style="background-image: url('assets/img/tags/candidates.jpg'); background-size: cover;">
      <h1>#<?= $rowCount; ?></h1>
      <h5>Available Candidate</h5>
    </div>
    <?php
    while ( $row = mysqli_fetch_assoc( $result ) ) {
      $count = 0; // Tambahkan variabel counter untuk nomor urut
      $count++;
      $modalId = 'modal_' . $row[ 'id' ];
      $contactsubsubModalId = 'contactsubsub_' . $row[ 'id' ];
      $purposeModalId = 'purposeModal_' . $row[ 'id' ];


      ?>
    <div class="col-lg-4 resize itempage" data-aos="zoom-in">
      <div class="logo filter"><img src="assets/img/logoav.png" alt="Logo" style="width: 200px; height: auto; display: block; margin-right: auto; margin-left: 0;"> </div>
      <h4>
        <?= $row['job_name']; ?>
      </h4>
      <div class="candidate-info d-flex">
        <div class="col-lg-6">
          <ul class="candidates-left">
            <li> SKILL</li>
            <li> LOCATION</li>
            <li> AVAILABILITY</li>
            <li> EXPERIENCE</li>
          </ul>
        </div>
        <div class="col-lg-7">
          <ul class="candidates-right">
            <li>
              <?= $row['skill']; ?>
            </li>
            <li>
              <?= $row['loc']; ?>
            </li>
            <li>
              <?= $row['avail']; ?>
            </li>
            <li>
              <?= $row['experience']; ?>
            </li>
          </ul>
        </div>
      </div>
      <a href="#<?= $contactsubsubModalId; ?>" data-toggle="modal" data-target="#<?= $contactsubsubModalId; ?>Label" class="view-more-a">
      <div class="read-more-button"> View More </div>
      </a> 
	  </div>
    <div class="modal fade" id="<?= $contactsubsubModalId; ?>Label" tabindex="-1" role="dialog" aria-labelledby="<?= $contactsubsubModalId; ?>Label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content kotakmodalavaila-candidate" style="max-width: 1033px; width: 500%; margin-left: -50%; min-height: 692px;">
          <button type="button" class="butonclose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="row putih">
            <div class="col-md-6">
              <h3 class="job-name">
                <?= $row['job_name']; ?>
              </h3>
              <div class="row">
                <div class="col-md-12 cand-kiriputih">
                  <label for="name"><strong>Roles</strong></label>
                  <p><?php echo $row['roles']; ?></p>
                </div>
                <div class="col-md-12 cand-kiriputih">
                  <label for="name"><strong>Tools/Technologies</strong></label>
                  <p><?php echo $row['tools']; ?></p>
                </div>
                <div class="col-md-12 cand-kiriputih">
                  <label for="name"><strong>Experience</strong></label>
                  <p><?php echo $row['experience']; ?></p>
                </div>
                <section></section>
                <div class="col-md-12 cand-kiriputih" style="position: absolute; bottom: 0px;">
                  <label for="name"><strong>Attached documents</strong></label>
                  <div class="footer-box-cand d-flex justify-content-between">
                    <h5><u>CV</u></h5>
                    <a class="btn btn-view" href="superadmin/view_pdf.php?idv=<?= $row['id']; ?>" target="_blank">View</a>
                    <a class="btn btn-download" href="superadmin/view_pdf.php?idd=<?= $row['id']; ?>">Download</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 cand-hitam">
              <h3 class="judul-kanan-hitam-candidate"><strong>Contact Information</strong></h3>
              <ul>
                <div class="em"> <img src="assets/img/GPS.png" class="ma"><a href="https://www.google.com/maps/search/?api=1&query=Kemizares+AB,+C/O+United+Spaces,+Pumpgatan+1,+417+66+Gothenburg" target="_blank" style="color: white;"><?php echo $row['loc'] ?></a></div>
                <div class="em" style="margin-bottom: 13%;"> <img src="assets/img/maill.png" class="ma"> <a style="color: white;"href="mailto:contact@kemizares.se"><?php echo $row['email_can']; ?></a></div>
              </ul>
              <div class="d-flex justify-content-center tombol-prupose-meeting"> <a href="#<?= $purposeModalId ?>" data-toggle="modal" data-target="#<?= $purposeModalId ?>">
                <div class="btn btn-proposemeeting"> Propose meeting </div>
                </a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- purpose meetinng -->
    <div class="modal fade propose-meeting-background" id="<?= $purposeModalId ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $purposeModalId ?>Label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-box" id="modalBox">
          <button type="button" class="purpose-close" data-dismiss="modal" aria-label="Close">&times;</button>
          <div class="propose-meeting">Propose Meeting</div>
          <div class="mobile-app-developer"><?php echo $row['job_name']; ?></div>
          <form class="purpose-meeting-form">
              <input type="hidden" id="job_name" name="job_name" value="<?php echo $row['job_name']; ?>">
              <div id="ikontanggal"><img id="ikoncal" src="assets/img/icondate.png" alt=""></div>
			  <div class="select-date">Select Date</div>
              <input type="text" id="input-select-date" name="date" class="input-select-date">
              <div class="mboh" id="tanggalsalah">Picking a date is needed</div>
              <div class="start-time" id="start-time">Start Time<img src="assets/img/cawang.png"></div>
              <input type="text" class="input-start-time" id="input-start-time" name="start_time">
              <div class="mboh" id="jamulai-salah">Please pick a time when the meeting starts</div>
              <div class="stop-time" id="stop-time">Stop Time<img src="assets/img/cawang.png" alt=""></div>
              <input type="text" class="input-stop-time" id="input-stop-time" name="stop_time">
              <div class="mboh" id="jamenteksalah">We need to end the meeting at some time</div>
              <div class="email-to-be-contacted">Email to be Contacted</div>
              <input type="email" class="input-email" id="input-email" name="email">
              <div class="mboh" id="emailsalah">This value is required</div>
              <button type="submit" class="submit-button">
              <span class="submit-button-text">Submit</span>
              </button>
          </form>
        </div>
      </div>
    </div>

    <style>
.modal{
  background: rgba(0,0,0,0.52);  
} 
</style>

    <div class="modal fade" id="reg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content cuaks" style="border: hidden;">
          <div class="modal-body mx-3 d-flex justify-content-center" style="padding-left: 0px">
            <div class="col-lg-10 boxTQjam">
              <div class="notify-tittle align-content-center">
                <div class="check-logo"></div>

                <h6>Thank you for proposing a meeting with our candicate! Our sell-team will shortly come back to confirm the proposed day and time.</h6>
              </div>
              <div class="d-flex justify-content-center">
                <button class="btnmail" type="button" aria-label="Close" data-bs-dismiss="modal">Got it</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>	  
    <?php
    }

    ?>
  </div>
<div class="pagination justify-content-center" id="pagination-no-halaman-meet">
  <a href="#" class="pagination-button prev">&lt;</a>
  <a href="#" class="pagination-button next">&gt;</a>
</div>	
<script>
/*-------------------------------------------------------------------------------
Fungsi Pagination Meet Our Team
--------------------------------------------------------------------------------*/	
function pagination() {  
  var daftarTim = document.querySelector(".posts-list");
  var anggotaTim = daftarTim.getElementsByClassName("col-lg-4 resize itempage");
  var anggotaPerHalaman = 5;
  var totalHalaman = Math.ceil(anggotaTim.length / anggotaPerHalaman);
  var halamanSaatIni = 1;
  var nomerHalamanMeet = document.getElementById("pagination-no-halaman-meet");	
	
function tampilkanHalaman(nomorHalaman) {
  var indeksAwal = (nomorHalaman - 1) * anggotaPerHalaman;
  var indeksAkhir = Math.min(indeksAwal + anggotaPerHalaman, anggotaTim.length);

  for (var i = 0; i < anggotaTim.length; i++) {
    if (i >= indeksAwal && i < indeksAkhir) {
      anggotaTim[i].style.animation = "fade-zoom-in 0.5s ease-in-out";
      anggotaTim[i].style.display = "block";
    } else {
      anggotaTim[i].style.animation = "fade-zoom-out 0.5s ease-in-out";
      anggotaTim[i].style.display = "none";
    }
  }
}

function perbaruiNavigasi() {
  var tombolSebelumnya = document.querySelector(".pagination-button.prev");
  var tombolSelanjutnya = document.querySelector(".pagination-button.next");

  if (halamanSaatIni === 1) {
    tombolSebelumnya.classList.add("disabled");
    tombolSebelumnya.classList.add("first-page"); 
  } else {
    tombolSebelumnya.classList.remove("disabled");
    tombolSebelumnya.classList.remove("first-page"); 
  }

  if (halamanSaatIni === totalHalaman) {
    tombolSelanjutnya.classList.add("disabled");
    tombolSelanjutnya.classList.add("last-page"); 
  } else {
    tombolSelanjutnya.classList.remove("disabled");
    tombolSelanjutnya.classList.remove("last-page");
  }
}

  function keHalamanSebelumnya() {
    if (halamanSaatIni > 1) {
      halamanSaatIni--;
      tampilkanHalaman(halamanSaatIni);
      perbaruiNavigasi();
    }
  }

  function keHalamanSelanjutnya() {
    if (halamanSaatIni < totalHalaman) {
      halamanSaatIni++;
      tampilkanHalaman(halamanSaatIni);
      perbaruiNavigasi();
    }
  }

  document.querySelector(".pagination-button.prev").addEventListener("click", function(e) {
    e.preventDefault();
    keHalamanSebelumnya();
  });

  document.querySelector(".pagination-button.next").addEventListener("click", function(e) {
    e.preventDefault();
    keHalamanSelanjutnya();
  });


	if (anggotaTim.length <= anggotaPerHalaman) {
  nomerHalamanMeet.style.display = "none";
} else {
  nomerHalamanMeet.style.display = "flex";
}
  tampilkanHalaman(halamanSaatIni);
  perbaruiNavigasi();
};		

/*-------------------------------------------------------------------------------
End Fungsi Pagination Meet Our Team
--------------------------------------------------------------------------------*/	
	</script>	
</div>
	
<div id="result2" style="display: none"></div>	
	<script>
/*-------------------------------------------------------------------------------
Fungsi Clear Search
--------------------------------------------------------------------------------*/
function inputkosong() {
    var kotakpencarian = document.querySelector(".kotakcari");
    var resetcari = document.querySelector(".resetcari");
    var pagination = document.querySelector(".pagination");

    if (kotakpencarian.value === "") {
        resetcari.style.display = "none";
    } else {
        resetcari.style.display = "block";
       
    }	
}
window.onload = function() {	
    inputkosong();
	pagination();
	pemanggiljam();	
submitpropose();		
    };	

/*-------------------------------------------------------------------------------
END Fungsi Clear Search
--------------------------------------------------------------------------------*/
	</script>
<script>
function submitpropose(){	
 const forms = document.querySelectorAll('.purpose-meeting-form');

    forms.forEach(function(form) {
        const ikontanggal = form.querySelector('#ikontanggal');
        ikontanggal.style.display = 'block';

        const pilehtgl = form.querySelector('.input-select-date');
        pilehtgl.addEventListener('input', function() {
            if (pilehtgl.value === "") {
                ikontanggal.style.display = 'block';
            } else {
                ikontanggal.style.display = 'none';
            }
        });
		
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const inputs = form.querySelectorAll('input');
                const inputsalah = form.querySelectorAll('div .mboh');
				const tanggalsalah = form.querySelector('.input-select-date');
				const emailkosong = form.querySelector('.input-email');
				const emailform = form.querySelector('#emailsalah');
				const tanggalkosong = form.querySelector('#tanggalsalah');
                const values = {};

                let validation = true;

                inputs.forEach(function(input) {
                    values[input.name] = input.value;

                    if (emailkosong.value === "") {
                        emailform.style.display = "block";
                        emailkosong.style.border = "solid";
                        emailkosong.style.borderWidth = "1px";
                        emailkosong.style.borderColor = "#d80027";
                        validation = false;
                    } else {
                        emailform.style.display = "none";
                        emailkosong.style.borderColor = "";
                        emailkosong.style.border = "";
						emailkosong.value === "";
                  
                    }

                    if (tanggalsalah.value === "") {
                        tanggalkosong.style.display = "block";
                        tanggalsalah.style.border = "solid";
                        tanggalsalah.style.borderWidth = "1px";
                        tanggalsalah.style.borderColor = "#d80027";
                        validation = false;
                    } else {
                        tanggalkosong.style.display = "none";
                        tanggalsalah.style.borderColor = "";
                        tanggalsalah.style.border = "hidden";
						tanggalsalah.style.display = "block"; 

                    }
                });

                if (validation) {
                    axios({
                        url: 'https://api.emailjs.com/api/v1.0/email/send',
                        method: 'post',
                        data: {
                            // service_id: 'service_4090uts',
                            // template_id: 'template_4s2v6fw',
                            // user_id: 'NBPYm29A5wDaJqog4',
                            // accessToken: 'WHR13A1kuD86LuUUKdADQ',

                            service_id: 'service_tdn6d79',
                            template_id: 'template_bgr3qpk',
                            user_id: 'XdoeTIjHOTNpfWqOR',
                            accessToken: 'z0MHTiEl6NAL3FtDpsDTY',
                            
                            template_params: {
                                'subject': 'Propose Meeting ' + values.job_name,
                                'message': `Date: ${values.date}<br>
                                            Start Time: ${values.start_time}<br>
                                            Stop Time: ${values.stop_time}<br>
                                            Email: ${values.email}`
                            }
                        },
                    })
                    form.querySelectorAll('input')[4].value = "";
                    form.querySelectorAll('input')[1].value = "";
					ikontanggal.style.display = 'block';
                    $('#reg').appendTo(form).modal('show');
                }
            });
        });
}
	
	</script>	
</div>	
</section>

<!-- End available candidates --> 

  <!-- ======= Contact Section ======= -->
<section id="availablecandidates" class="contact section-bgg">
<div class="container" data-aos="fade-up">
<div class="section-title-candidates-white">
  <h4 class="custom-working">Working with the best clients & partners!</h4>
  <br>
  </br>
  <h4 class="custom-heading-customers">Customers</h4>
  <div class="container">
    <div class="sponsor-box">
      <?php 
      foreach ( $customers as $cs) {

      
      ?>
      <div class="logo"> <img src="data:image/jpeg;base64,<?=base64_encode($cs['file_gambar'] )?>" width="288px" > </div>
      <?php 
    } ?>

    </div>
  </div>
  <br>
  </br>
  <h4 class="custom-heading-customers">Partners</h4>
  <div class="container">
    <div class="sponsor-box">
      <?php 
        foreach ( $partners as $pt) {
        ?>
        <div class="logo"> <img src="data:image/jpeg;base64,<?=base64_encode($pt['file_gambar'] )?>" width="288px" > </div>
        <?php 
      } ?>

    </div>
  </div>
  </section>

  <!-- contact-sub --> 
  
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

<!-- end contact-sub -->


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<!-------
  prpose meeting
  ------>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="assets/vendor/axios/axios.min.js"></script>
<script>
//document.addEventListener('DOMContentLoaded', function() {
   

function pemanggiljam(){	

	flatpickr("#input-select-date", {
  	dateFormat: "F, d Y",
  	minDate: "today"
	});
	
	

  	flatpickr("#input-start-time", {
	enableTime: true,
  	noCalendar: true,
  	dateFormat: "H:i K",
  	defaultDate: "11:00",
		
  	onClose: function(selectedDates, dateStr, instance) {
  if (dateStr === "") {
  instance._input.value = ""; 
  }
  }
		
  });

	
	
	
  	flatpickr("#input-stop-time", {
  enableTime: true,
  noCalendar: true,
  dateFormat: "H:i K",
  defaultDate: "11:00",
		
  onClose: function(selectedDates, dateStr, instance) {
  if (dateStr === "") {
  instance._input.value = ""; 
  }
  } 
  });
}
	
  </script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.id.min.js">
  </script> 

<!-- ----Get Notify bar an email-------- -->
<div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bgmnone">
      <div class="modal-body mx-3 d-flex justify-content-center" style="padding-left: 0px">
        <div class="col-lg-10 boxgetemail">
            <form id="subcribe-candidate-form">
              <div class="notify-tittle">
                <button type="button" class="closemail" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <h4>Notify me when new positions are added</h4>
              </div>
              <input type="hidden" name="type" value="sub">
              <input type="hidden" name="notify-option" value="2">
              <div class="d-flex justify-content-center">
                <input type="email" id="form2" class="form-controlll validate" placeholder="Email Address" name="email" required>
                <label data-error="wrong" data-success="right" for="form2"></label>
              </div>
              <div class="error-message" id="form2-error" style="display: none;">The Value is Required</div>
              <div class="d-flex justify-content-center">
                <button type="submit" class="btnmail">Subscribe</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="TQ" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bgmnone">
      <div class="modal-body mx-3 d-flex justify-content-center" style="padding-left: 0px">
        <div class="col-lg-10 boxTQ">
          <div class="notify-tittle align-content-center"> <img class="align-self-center" src="assets/img/STRA.png" alt=""><br>
            <h4>Thank You</h4>
            <h6>You will get email notifications whenever new positions are added.</h6>
          </div>
          <div class="d-flex justify-content-center">
            <button class="btnmail" type="button" aria-label="Close" data-dismiss="modal">Got it</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!---------------------------------- 
  Script untuk fungsi get notify email
  ------------------------------------> 

<script>
  document.querySelector('#TQ .btnmail').addEventListener('click', function () {
  $('#TQ').modal('hide');
  $('#modalSubscriptionForm').modal('hide');
  }); 
  </script> 
<!--------------------- 
  End script get notify
  -----------------------> 

<!-- ----End Get Notify bar an email-------- -->

<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@200&display=swap" rel="stylesheet">

<!----  Privacy policy---->
<div class="container">
  <div class="row">
    <div class="col-lg-12 mx-auto">
      <div class="modal fade" id="PP" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="PP">
            <div class="row Polis">
              <div class="col-md-12 isipolis">
                <label style="padding-left: 45px" for="name"><strong>Privacy Policy</strong></label>
                <p>We respect your privacy and are committed to protecting it through our compliance with this privacy policy (“Policy”). This Policy describes the types of information we may collect from you or that you may provide (“Personal Information”) on the kemizares.se website (“Website” or “Service”) and any of its related products and services (collectively, “Services”), and our practices for collecting, using, maintaining, protecting, and disclosing that Personal Information. It also describes the choices available to you regarding our use of your Personal Information and how you can access and update it.</p>
                <p>This Policy is a legally binding agreement between you (“User”, “you” or “your”) and Kemizares AB (“Kemizares AB”, “we”, “us” or “our”). If you are entering into this agreement on behalf of a business or other legal entity, you represent that you have the authority to bind such entity to this agreement, in which case the terms “User”, “you” or “your” shall refer to such entity. If you do not have such authority, or if you do not agree with the terms of this agreement, you must not accept this agreement and may not access and use the Website and Services. By accessing and using the Website and Services, you acknowledge that you have read, understood, and agree to be bound by the terms of this Policy. This Policy does not apply to the practices of companies that we do not own or control, or to individuals that we do not employ or manage.</p>
              </div>
            </div>
            <div class="isipolis ">
              <label style="padding-left: 45px"  for="name"><strong>Table of Contents</strong></label>
              <p style=" color: #446381;" >1. Collection of personal information</p>
              <p style=" color: #446381;" >2. Privacy of children</p>
              <p style=" color: #446381;" >3. Use and processing of collected information</p>
              <p style=" color: #446381;" >4. Payment processing</p>
              <p style=" color: #446381;" >5. Disclosure of information</p>
              <p style=" color: #446381;" >6. Retention of information</p>
              <p style=" color: #446381;" >7. Transfer of information</p>
              <p style=" color: #446381;" >8. Data protection rights under the GDPR</p>
              <p style=" color: #446381;" >9. How to exercise your rights</p>
              <p style=" color: #446381;" >10. Data analytics</p>
              <p style=" color: #446381;" >11. Do Not Track signals</p>
              <p style=" color: #446381;" >12. Push notifications</p>
              <p style=" color: #446381;" >13. Links to other resources</p>
              <p style=" color: #446381;" >14. Information security</p>
              <p style=" color: #446381;" >15. Data breach</p>
              <p style=" color: #446381;" >16. Changes and amendments</p>
              <p style=" color: #446381;" >17. Acceptance of this policy</p>
              <p style=" color: #446381;" >18. Contacting us</p>
            </div>
            <div class="isipolis aaa">
              <label style="padding-left: 45px"  for="name"><strong>Collection of personal information</strong></label>
              <p>You can access and use the Website and Services without telling us who you are or revealing any information by which someone could identify you as a specific, identifiable individual. If, however, you wish to use some of the features offered on the Website, you may be asked to provide certain Personal Information (for example, your name and e-mail address).</p>
              <p>We receive and store any information you knowingly provide to us when you make a purchase, or fill any forms on the Website. When required, this information may include the following:</p>
              <li>Contact information (such as email address, phone number, etc)</li>
              <li>Basic personal information (such as name, country of residence, etc)</li>
              <p>You can choose not to provide us with your Personal Information, but then you may not be able to take advantage of some of the features on the Website. Users who are uncertain about what information is mandatory are welcome to contact us.</p>
            </div>
            <div class="col-md-12 isipolis">
              <label style="padding-left: 45px"  for="name"><strong>Privacy of children</strong></label>
              <p>We do not knowingly collect any Personal Information from children under the age of 18. If you are under the age of 18, please do not submit any Personal Information through the Website and Services. If you have reason to believe that a child under the age of 18 has provided Personal Information to us through the Website and Services, please contact us to request that we delete that child’s Personal Information from our Services.</p>
              <p>We encourage parents and legal guardians to monitor their children’s Internet usage and to help enforce this Policy by instructing their children never to provide Personal Information through the Website and Services without their permission. We also ask that all parents and legal guardians overseeing the care of children take the necessary precautions to ensure that their children are instructed to never give out Personal Information when online without their permission.</p>
            </div>
            <div class="col-md-12 isipolis aaaa">
              <label style="padding-left: 45px"  for="name"><strong>Use and processing of collected information</strong></label>
              <p>We act as a data controller and a data processor in terms of the GDPR when handling Personal Information, unless we have entered into a data processing agreement with you in which case you would be the data controller and we would be the data processor.</p>
              <p>Our role may also differ depending on the specific situation involving Personal Information. We act in the capacity of a data controller when we ask you to submit your Personal Information that is necessary to ensure your access and use of the Website and Services. In such instances, we are a data controller because we determine the purposes and means of the processing of Personal Information and we comply with data controllers’ obligations set forth in the GDPR.</p>
              <p>We act in the capacity of a data processor in situations when you submit Personal Information through the Website and Services. We do not own, control, or make decisions about the submitted Personal Information, and such Personal Information is processed only in accordance with your instructions. In such instances, the User providing Personal Information acts as a data controller in terms of the GDPR.</p>
              <p>In order to make the Website and Services available to you, or to meet a legal obligation, we may need to collect and use certain Personal Information. If you do not provide the information that we request, we may not be able to provide you with the requested products or services. Any of the information we collect from you may be used for the following purposes:</p>
              <li>Deliver products or services</li>
              <li>Respond to inquiries and offer support</li>
              <li>Run and operate the Website and Services</li>
              <p>Processing your Personal Information depends on how you interact with the Website and Services, where you are located in the world and if one of the following applies: (i) you have given your consent for one or more specific purposes; this, however, does not apply, whenever the processing of Personal Information is subject to European data protection law; (ii) provision of information is necessary for the performance of an agreement with you and/or for any pre-contractual obligations thereof; (iii) processing is necessary for compliance with a legal obligation to which you are subject; (iv) processing is related to a task that is carried out in the public interest or in the exercise of official authority vested in us; (v) processing is necessary for the purposes of the legitimate interests pursued by us or by a third party.</p>
              <p>We rely on the following legal bases as defined in the GDPR upon which we collect and process your Personal Information:</p>
              <li>User’s consent</li>
              <li>Employment or social security obligations</li>
              <li>Compliance with the law and legal obligations</li>
              <p>Note that under some legislations we may be allowed to process information until you object to such processing by opting out, without having to rely on consent or any other of the legal bases above. In any case, we will be happy to clarify the specific legal basis that applies to the processing, and in particular whether the provision of Personal Information is a statutory or contractual requirement, or a requirement necessary to enter into a contract.</p>
            </div>
            <div class="col-md-12 isipolis">
              <label style="padding-left: 45px"  for="name"><strong>Payment processing</strong></label>
              <p>In case of Services requiring payment, you may need to provide your credit card details or other payment account information, which will be used solely for processing payments. We use third-party payment processors (“Payment Processors”) to assist us in processing your payment information securely. Payment Processors adhere to the latest security standards as managed by the PCI Security Standards Council, which is a joint effort of brands like Visa, MasterCard, American Express, and Discover. Sensitive and private data exchange happens over an SSL secured communication channel and is encrypted and protected with digital signatures, and the Website and Services are also in compliance with strict vulnerability standards in order to create as secure of an environment as possible for Users. We will share payment data with the Payment Processors only to the extent necessary for the purposes of processing your payments, refunding such payments, and dealing with complaints and queries related to such payments and refunds.</p>
              <p>Please note that the Payment Processors may collect some Personal Information from you, which allows them to process your payments (e.g., your email address, address, credit card details, and bank account number) and handle all the steps in the payment process through their systems, including data collection and data processing. The Payment Processors’ use of your Personal Information is governed by their respective privacy policies which may or may not contain privacy protections as protective as this Policy. We suggest that you review their respective privacy policies.</p>
            </div>
            <div class="col-md-12 isipolis">
              <label style="padding-left: 45px"  for="name"><strong>Disclosure of information</strong></label>
              <p>Depending on the requested Services or as necessary to complete any transaction or provide any Service you have requested, we may share your information with our trusted subsidiaries and joint venture partners, affiliates, contracted companies, and service providers (collectively, “Service Providers”) we rely upon to assist in the operation of the Website and Services available to you and whose privacy policies are consistent with ours or who agree to abide by our policies with respect to Personal Information. We will not share any personally identifiable information with third parties and will not share any information with unaffiliated third parties.</p>
              <p>Service Providers are not authorized to use or disclose your information except as necessary to perform services on our behalf or comply with legal requirements. Service Providers are given the information they need only in order to perform their designated functions, and we do not authorize them to use or disclose any of the provided information for their own marketing or other purposes.</p>
              <p>We may also disclose any Personal Information we collect, use or receive if required or permitted by law, such as to comply with a subpoena or similar legal process, and when we believe in good faith that disclosure is necessary to protect our rights, protect your safety or the safety of others, investigate fraud, or respond to a government request.</p>
              <p>In the event we go through a business transition, such as a merger or acquisition by another company, or sale of all or a portion of its assets, your Personal Information will likely be among the assets transferred.</p>
            </div>
            <div class="col-md-12 isipolis">
              <label style="padding-left: 45px"  for="name"><strong>Retention of information</strong></label>
              <p>We will retain and use your Personal Information for the period necessary to comply with our legal obligations, to enforce our agreements, resolve disputes, and unless a longer retention period is required or permitted by law.</p>
              <p>We may use any aggregated data derived from or incorporating your Personal Information after you update or delete it, but not in a manner that would identify you personally. Once the retention period expires, Personal Information shall be deleted. Therefore, the right to access, the right to erasure, the right to rectification, and the right to data portability cannot be enforced after the expiration of the retention period.</p>
            </div>
            <div class="col-md-12 isipolis">
              <label style="padding-left: 45px"  for="name"><strong>Transfer of information</strong></label>
              <p>Depending on your location, data transfers may involve transferring and storing your information in a country other than your own. However, this will not include countries outside the European Union and European Economic Area. If any such transfer takes place, you can find out more by checking the relevant sections of this Policy or inquire with us using the information provided in the contact section.</p>
            </div>
            <div class="col-md-12 isipolis">
              <label style="padding-left: 45px"  for="name"><strong>Data protection rights under the GDPR</strong></label>
              <p>If you are a resident of the European Economic Area (“EEA”), you have certain data protection rights and we aim to take reasonable steps to allow you to correct, amend, delete, or limit the use of your Personal Information. If you wish to be informed what Personal Information we hold about you and if you want it to be removed from our systems, please contact us. In certain circumstances, you have the following data protection rights:</p>
              <p>(i) You have the right to withdraw consent where you have previously given your consent to the processing of your Personal Information. To the extent that the legal basis for our processing of your Personal Information is consent, you have the right to withdraw that consent at any time. Withdrawal will not affect the lawfulness of processing before the withdrawal.</p>
              <p>(ii) You have the right to learn if your Personal Information is being processed by us, obtain disclosure regarding certain aspects of the processing, and obtain a copy of your Personal Information undergoing processing.</p>
              <p>(iii) You have the right to verify the accuracy of your information and ask for it to be updated or corrected. You also have the right to request us to complete the Personal Information you believe is incomplete.</p>
              <p>(iv) You have the right to object to the processing of your information if the processing is carried out on a legal basis other than consent. Where Personal Information is processed for the public interest, in the exercise of an official authority vested in us, or for the purposes of the legitimate interests pursued by us, you may object to such processing by providing a ground related to your particular situation to justify the objection.</p>
              <p>(v) You have the right, under certain circumstances, to restrict the processing of your Personal Information. These circumstances include: the accuracy of your Personal Information is contested by you and we must verify its accuracy; the processing is unlawful, but you oppose the erasure of your Personal Information and request the restriction of its use instead; we no longer need your Personal Information for the purposes of processing, but you require it to establish, exercise or defend your legal claims; you have objected to processing pending the verification of whether our legitimate grounds override your legitimate grounds. Where processing has been restricted, such Personal Information will be marked accordingly and, with the exception of storage, will be processed only with your consent or for the establishment, to exercise or defense of legal claims, for the protection of the rights of another natural, or legal person or for reasons of important public interest.</p>
              <p>(vi) You have the right, under certain circumstances, to obtain the erasure of your Personal Information from us. These circumstances include: the Personal Information is no longer necessary in relation to the purposes for which it was collected or otherwise processed; you withdraw consent to consent-based processing; you object to the processing under certain rules of applicable data protection law; the processing is for direct marketing purposes; and the personal data have been unlawfully processed. However, there are exclusions of the right to erasure such as where processing is necessary: for exercising the right of freedom of expression and information; for compliance with a legal obligation; or for the establishment, to exercise or defense of legal claims.</p>
              <p>(vii) You have the right to receive your Personal Information that you have provided to us in a structured, commonly used, and machine-readable format and, if technically feasible, to have it transmitted to another controller without any hindrance from us, provided that such transmission does not adversely affect the rights and freedoms of others.</p>
              <p>(viii) You have the right to complain to a data protection authority about our collection and use of your Personal Information. If you are not satisfied with the outcome of your complaint directly with us, you have the right to lodge a complaint with your local data protection authority. For more information, please contact your local data protection authority in the EEA. This provision is applicable provided that your Personal Information is processed by automated means and that the processing is based on your consent, on a contract which you are part of, or on pre-contractual obligations thereof.</p>
            </div>
            <div class="col-md-12 isipolis">
              <label style="padding-left: 45px"  for="name"><strong>How to exercise your rights</strong></label>
              <p>Any requests to exercise your rights can be directed to us through the contact details provided in this document. Please note that we may ask you to verify your identity before responding to such requests. Your request must provide sufficient information that allows us to verify that you are the person you are claiming to be or that you are the authorized representative of such person. If we receive your request from an authorized representative, we may request evidence that you have provided such an authorized representative with power of attorney or that the authorized representative otherwise has valid written authority to submit requests on your behalf.</p>
              <p>You must include sufficient details to allow us to properly understand the request and respond to it. We cannot respond to your request or provide you with Personal Information unless we first verify your identity or authority to make such a request and confirm that the Personal Information relates to you.</p>
            </div>
            <div class="col-md-12 isipolis">
              <label style="padding-left: 45px"  for="name"><strong>Data analytics</strong></label>
              <p>Our Website and Services may use third-party analytics tools that use cookies, web beacons, or other similar information-gathering technologies to collect standard internet activity and usage information. The information gathered is used to compile statistical reports on User activity such as how often Users visit our Website and Services, what pages they visit and for how long, etc. We use the information obtained from these analytics tools to monitor the performance and improve our Website and Services. We do not use third-party analytics tools to track or to collect any personally identifiable information of our Users and we will not associate any information gathered from the statistical reports with any individual User.</p>
            </div>
            <div class="col-md-12 isipolis">
              <label style="padding-left: 45px"  for="name"><strong>Do Not Track signals</strong></label>
              <p>Some browsers incorporate a Do Not Track feature that signals to websites you visit that you do not want to have your online activity tracked. Tracking is not the same as using or collecting information in connection with a website. For these purposes, tracking refers to collecting personally identifiable information from consumers who use or visit a website or online service as they move across different websites over time. How browsers communicate the Do Not Track signal is not yet uniform. As a result, the Website and Services are not yet set up to interpret or respond to Do Not Track signals communicated by your browser. Even so, as described in more detail throughout this Policy, we limit our use and collection of your Personal Information. For a description of Do Not Track protocols for browsers and mobile devices or to learn more about the choices available to you, visit <a href="https://internetcookies.com" style="font-size: 18px; font-weight: 1000px; border-bottom: 1px solid #446381; color: #446381; ">internetcookies.com</a> 
            </div>
            <div class="col-md-12 isipolis">
              <label style="padding-left: 45px"  for="name"><strong>Push notifications</strong></label>
              <p>We offer push notifications to which you may voluntarily subscribe at any time. To make sure push notifications reach the correct devices, we rely on a device token unique to your device which is issued by the operating system of your device. While it is possible to access a list of device tokens, they will not reveal your identity, your unique device ID, or your contact information to us. We will maintain the information sent via e-mail in accordance with applicable laws and regulations. If, at any time, you wish to stop receiving push notifications, simply adjust your device settings accordingly.</p>
            </div>
            <div class="col-md-12 isipolis">
              <label style="padding-left: 45px"  for="name"><strong>Links to other resources</strong></label>
              <p>The Website and Services contain links to other resources that are not owned or controlled by us. Please be aware that we are not responsible for the privacy practices of such other resources or third parties. We encourage you to be aware when you leave the Website and Services and to read the privacy statements of each and every resource that may collect Personal Information.</p>
            </div>
            <div class="col-md-12 isipolis">
              <label style="padding-left: 45px"  for="name"><strong>Information security</strong></label>
              <p>We secure information you provide on computer servers in a controlled, secure environment, protected from unauthorized access, use, or disclosure. We maintain reasonable administrative, technical, and physical safeguards in an effort to protect against unauthorized access, use, modification, and disclosure of Personal Information in our control and custody. However, no data transmission over the Internet or wireless network can be guaranteed.</p>
              <p>Therefore, while we strive to protect your Personal Information, you acknowledge that (i) there are security and privacy limitations of the Internet which are beyond our control; (ii) the security, integrity, and privacy of any and all information and data exchanged between you and the Website and Services cannot be guaranteed; and (iii) any such information and data may be viewed or tampered with in transit by a third party, despite best efforts.</p>
              <p>As the security of Personal Information depends in part on the security of the device you use to communicate with us and the security you use to protect your credentials, please take appropriate measures to protect this information.</p>
            </div>
            <div class="col-md-12 isipolis">
              <label style="padding-left: 45px"  for="name"><strong>Data breach</strong></label>
              <p>In the event we become aware that the security of the Website and Services has been compromised or Users’ Personal Information has been disclosed to unrelated third parties as a result of external activity, including, but not limited to, security attacks or fraud, we reserve the right to take reasonably appropriate measures, including, but not limited to, investigation and reporting, as well as notification to and cooperation with law enforcement authorities. In the event of a data breach, we will make reasonable efforts to notify affected individuals if we believe that there is a reasonable risk of harm to the User as a result of the breach or if notice is otherwise required by law. When we do, we will send you an email.</p>
            </div>
            <div class="col-md-12 isipolis">
              <label style="padding-left: 45px"  for="name"><strong>Changes and amendments</strong></label>
              <p>We reserve the right to modify this Policy or its terms related to the Website and Services at any time at our discretion. When we do, we will revise the updated date at the bottom of this page. We may also provide notice to you in other ways at our discretion, such as through the contact information you have provided.</p>
              <p>An updated version of this Policy will be effective immediately upon the posting of the revised Policy unless otherwise specified. Your continued use of the Website and Services after the effective date of the revised Policy (or such other act specified at that time) will constitute your consent to those changes. However, we will not, without your consent, use your Personal Information in a manner materially different than what was stated at the time your Personal Information was collected.</p>
            </div>
            <div class="col-md-12 isipolis">
              <label style="padding-left: 45px"  for="name"><strong>Acceptance of this policy</strong></label>
              <p>You acknowledge that you have read this Policy and agree to all its terms and conditions. By accessing and using the Website and Services and submitting your information you agree to be bound by this Policy. If you do not agree to abide by the terms of this Policy, you are not authorized to access or use the Website and Services.</p>
            </div>
            <div class="col-md-12 isipolis">
              <label style="padding-left: 45px"  for="name"><strong>Contacting us</strong></label>
              <p>If you have any questions regarding the information we may hold about you or if you wish to exercise your rights, you may use the following data subject request form to submit your request:<br>
                <br>
                <a target="_blank" href="https://app.websitepolicies.com/dsar/view/g6hy5ojl" style="font-size: 18px; font-style: bold; border-bottom: 1px solid #446381; color: #446381; ">Submit a data access request</a></p>
              
              <!-- <p><a href="data-access-request-form.php">Submit a data access request</a></p> -->
              <p>If you have any other questions, concerns, or complaints regarding this Policy, we encourage you to contact us using the details below:<br>
                <br>
                <a href="mailto:contact@kemizares.se" style="font-size: 18px; font-style: bold; border-bottom: 1px solid #446381; color: #446381; ">contact@kemizares.se</a></p>
              <p>We will attempt to resolve complaints and disputes and make every reasonable effort to honor your wish to exercise your rights as quickly as possible and in any event, within the timescales provided by applicable data protection laws.</p>
              <p>This document was last updated on February 3, 2023</p>
            </div>
            <button type="button" class="read-more-buttonn" data-dismiss="modal">
            <a>Close</a>
            </button>
            <section></section>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require 'subscribe.php' ?>  
<?php include "footer.php"; ?>
<?php include "terimakasih-sub.php"	?>
<?php include "unsub.php"	?>	
  
  
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> 
  
  <!-- Vendor JS Files --> 
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script> 
  <script src="assets/vendor/aos/aos.js"></script> 
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script> 
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script> 
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script> 
  <script src="assets/vendor/php-email-form/validate.js"></script> 
  <script src="assets/vendor/sweetalert2/sweetalert2.js"></script> 
  <script src="assets/vendor/axios/axios.min.js"></script> 
  
  <!-- Template Main JS File --> 
  <script src="assets/js/main.js"></script> 
  <script>
function resetFilter() {
  const checkboxesAvailability = kontenDropdownavailability.querySelectorAll('input[type="checkbox"]');
  checkboxesAvailability.forEach(checkbox => checkbox.checked = false);

  const checkboxesSkills = kontenDropdownSkills.querySelectorAll('input[type="checkbox"]');
  checkboxesSkills.forEach(checkbox => checkbox.checked = false);

  const checkboxesRegion = kontenDropdownRegion.querySelectorAll('input[type="checkbox"]');
  checkboxesRegion.forEach(checkbox => checkbox.checked = false);
	
  const checkboxesPengalaman = kontenDropdownPengalaman.querySelectorAll('input[type="checkbox"]');
  checkboxesPengalaman.forEach(checkbox => checkbox.checked = false);	

  perbaruiTeksTombolavailability();
  perbaruiTeksTombolSkills();
  perbaruiTeksTombolRegion();
  perbaruiTeksTombolPengalaman();
}
/*----------------------------------------------------------------------------------------------------------------------------------------------
														Fungsi multi select-candidate
-----------------------------------------------------------------------------------------------------------------------------------------------*/

/*------------------------------------------------------ Region ------------------------------------------------------------------*/


const tombolDropdownRegion = document.getElementById('region-dropdown-btn');
const kontenDropdownRegion = document.getElementById('region-dropdown-content');

function tampilkanDropdownRegion() {
  kontenDropdownRegion.style.display = kontenDropdownRegion.style.display === 'block' ? 'none' : 'block';
}

function perbaruiTeksTombolRegion() {
  const selectedOptions = Array.from(kontenDropdownRegion.querySelectorAll('input[type="checkbox"]:checked'))
    .map(checkbox => checkbox.parentElement.textContent.trim());

  tombolDropdownRegion.textContent = selectedOptions.length > 0 ? selectedOptions.join(', ') : 'Region';

  const judulFilters = kontenDropdownRegion.querySelectorAll('.judul-filter');
  judulFilters.forEach(filter => {
    if (filter.querySelector('input[type="checkbox"]:checked')) {
      filter.style.backgroundColor = '#999999';
      filter.style.color = 'rgba(31,31,31,1.00)';
    } else {
      filter.style.backgroundColor = 'transparent';
      filter.style.color = '';
    }
  });
      const isAnyFilterActive = Array.from(kontenDropdownRegion.querySelectorAll('input[type="checkbox"]:checked')).length > 0;

      // Tombol reset hanya akan ditampilkan jika ada filter yang aktif.
      const resetButton = document.querySelector('.reset-button');
      if (resetButton) {
        resetButton.style.display = isAnyFilterActive ? 'inline-block' : 'none';
      }		
}

tombolDropdownRegion.addEventListener('click', tampilkanDropdownRegion);

kontenDropdownRegion.addEventListener('change', perbaruiTeksTombolRegion);

window.addEventListener('click', (event) => {
  if (!tombolDropdownRegion.contains(event.target)) {
    kontenDropdownRegion.style.display = 'none';
  }
});

/*------------------------------------------------------ End Region ------------------------------------------------------------------*/


/*------------------------------------------------------ Skills ------------------------------------------------------------------*/

const tombolDropdownSkills = document.getElementById('skills-dropdown-btn');
const kontenDropdownSkills = document.getElementById('skills-dropdown-content');

function tampilkanDropdownSkills() {
  kontenDropdownSkills.style.display = kontenDropdownSkills.style.display === 'block' ? 'none' : 'block';
}

function perbaruiTeksTombolSkills() {
  const selectedOptions = Array.from(kontenDropdownSkills.querySelectorAll('input[type="checkbox"]:checked'))
    .map(checkbox => checkbox.parentElement.textContent.trim());

  tombolDropdownSkills.textContent = selectedOptions.length > 0 ? selectedOptions.join(', ') : 'Skills';

  const judulFilters = kontenDropdownSkills.querySelectorAll('.judul-filter');
  judulFilters.forEach(filter => {
    if (filter.querySelector('input[type="checkbox"]:checked')) {
      filter.style.backgroundColor = '#999999';
      filter.style.color = 'rgba(31,31,31,1.00)';
    } else {
      filter.style.backgroundColor = 'transparent';
      filter.style.color = '';
    }
  });
      const isAnyFilterActive = Array.from(kontenDropdownSkills.querySelectorAll('input[type="checkbox"]:checked')).length > 0;

      // Tombol reset hanya akan ditampilkan jika ada filter yang aktif.
      const resetButton = document.querySelector('.reset-button');
      if (resetButton) {
        resetButton.style.display = isAnyFilterActive ? 'inline-block' : 'none';
      }	
}

tombolDropdownSkills.addEventListener('click', tampilkanDropdownSkills);

kontenDropdownSkills.addEventListener('change', perbaruiTeksTombolSkills);

window.addEventListener('click', (event) => {
  if (!tombolDropdownSkills.contains(event.target)) {
    kontenDropdownSkills.style.display = 'none';
  }
});

/*------------------------------------------------------ End Skills ------------------------------------------------------------------*/

    /*------------------------------------------------------ Availability ------------------------------------------------------------------*/
    const tombolDropdownavailability = document.getElementById('availability-dropdown-btn');
    const kontenDropdownavailability = document.getElementById('availability-dropdown-content');

    function tampilkanDropdownavailability() {
      kontenDropdownavailability.style.display = kontenDropdownavailability.style.display === 'block' ? 'none' : 'block';
    }

    function perbaruiTeksTombolavailability() {
      const opsiTerpilih = Array.from(kontenDropdownavailability.querySelectorAll('input[type="checkbox"]:checked'))
        .map(checkbox => checkbox.parentElement.textContent.trim());

      tombolDropdownavailability.textContent = opsiTerpilih.length > 0 ? opsiTerpilih.join(', ') : 'Availability';

      const judulFilters = kontenDropdownavailability.querySelectorAll('.judul-filter');
      judulFilters.forEach(filter => {
        if (filter.querySelector('input[type="checkbox"]:checked')) {
          filter.style.backgroundColor = '#999999';
          filter.style.color = 'rgba(31,31,31,1.00)';
        } else {
          filter.style.backgroundColor = 'transparent';
          filter.style.color = '';
        }
      });

      // Setelah mengupdate teks tombol, tambahkan logika untuk memeriksa apakah ada filter yang aktif.
      const isAnyFilterActive = Array.from(kontenDropdownavailability.querySelectorAll('input[type="checkbox"]:checked')).length > 0;

      // Tombol reset hanya akan ditampilkan jika ada filter yang aktif.
      const resetButton = document.querySelector('.reset-button');
      if (resetButton) {
        resetButton.style.display = isAnyFilterActive ? 'inline-block' : 'none';
      }
    }

    tombolDropdownavailability.addEventListener('click', tampilkanDropdownavailability);

    kontenDropdownavailability.addEventListener('change', perbaruiTeksTombolavailability);

    window.addEventListener('click', (event) => {
      if (!tombolDropdownavailability.contains(event.target)) {
        kontenDropdownavailability.style.display = 'none';
      }
    });
    /*------------------------------------------------------ End Availibility ------------------------------------------------------------------*/
/*------------------------------------------------------ Experience ------------------------------------------------------------------*/


const tombolDropdownPengalaman = document.getElementById('experience-dropdown-btn');
const kontenDropdownPengalaman = document.getElementById('experience-dropdown-content');

function toggleDropdownPengalaman() {
  kontenDropdownPengalaman.style.display = kontenDropdownPengalaman.style.display === 'block' ? 'none' : 'block';
}

function perbaruiTeksTombolPengalaman() {
  const pilihanTerpilih = Array.from(kontenDropdownPengalaman.querySelectorAll('input[type="checkbox"]:checked'))
    .map(checkbox => checkbox.parentElement.textContent.trim());

  tombolDropdownPengalaman.textContent = pilihanTerpilih.length > 0 ? pilihanTerpilih.join(', ') : 'Experience';

  const judulFilters = kontenDropdownPengalaman.querySelectorAll('.judul-filter');
  judulFilters.forEach(filter => {
    if (filter.querySelector('input[type="checkbox"]:checked')) {
      filter.style.backgroundColor = '#999999';
      filter.style.color = 'rgba(31,31,31,1.00)';
    } else {
      filter.style.backgroundColor = 'transparent';
      filter.style.color = '';
    }
  });
      // Setelah mengupdate teks tombol, tambahkan logika untuk memeriksa apakah ada filter yang aktif.
      const isAnyFilterActive = Array.from(kontenDropdownPengalaman.querySelectorAll('input[type="checkbox"]:checked')).length > 0;

      // Tombol reset hanya akan ditampilkan jika ada filter yang aktif.
      const resetButton = document.querySelector('.reset-button');
      if (resetButton) {
        resetButton.style.display = isAnyFilterActive ? 'inline-block' : 'none';
      }
	
}

tombolDropdownPengalaman.addEventListener('click', toggleDropdownPengalaman);

kontenDropdownPengalaman.addEventListener('change', perbaruiTeksTombolPengalaman);

window.addEventListener('click', (event) => {
  if (!tombolDropdownPengalaman.contains(event.target)) {
    kontenDropdownPengalaman.style.display = 'none';
  }
});


/*------------------------------------------------------ End Experience ------------------------------------------------------------------*/


/*----------------------------------------------------------------------------------------------------------------------------------------------
														End fungsi multi select-candidate
-----------------------------------------------------------------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------
Fungsi Get Notify Email
--------------------------------------------------------------------------------*/
document.querySelector('#modalSubscriptionForm .btnmail').addEventListener('click', function () {
  var emailInput = document.getElementById('form2');
  var emailValue = emailInput.value;
  var errorContainer = document.getElementById('form2-error');
  var tqModal = document.getElementById('TQ');

  if (emailValue.trim() === '') {
    emailInput.classList.add('error');
    errorContainer.style.display = 'block';
    $(tqModal).modal('hide');
  } else {
    emailInput.classList.remove('error');
    errorContainer.style.display = '';
    $('#modalSubscriptionForm').modal('hide');
    $('#TQ').modal('show');
  }
});
	
/*-------------------------------------------------------------------------------
END Fungsi Get Notify Email
--------------------------------------------------------------------------------*/	
	
    document.getElementById("subcribe-candidate-form").addEventListener("submit", function(event) {
        event.preventDefault()

        let emailInput = document.getElementById('form2');
        let emailValue = emailInput.value;
        let errorContainer = document.getElementById('form2-error');
        let tqModal = document.getElementById('TQ');

        if (emailValue.trim() === '') {
            emailInput.classList.add('error');
            errorContainer.innerText = 'The Value is Required';
            $(tqModal).modal('hide');
        } else {
            axios({
                url: 'process_subscribe.php',
                method: 'post',
                data: $(event.currentTarget).serialize(),
            }).then(response => {
                if (response.data.status === true) {
                    emailInput.classList.remove('error');
                    errorContainer.innerText = '';
                    $('#modalSubscriptionForm').modal('hide');
                    $('#TQ').modal('show');
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: response.data.message
                    })
                }
            }).catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'System Error'
                })
            })
        }
    })
	  
    document.getElementById("subscribe-form").addEventListener("submit", function(event) {
        event.preventDefault()

        axios({
            url: 'process_subscribe.php',
            method: 'post',
            data: $(event.currentTarget).serialize(),
        }).then(response => {
            if (response.data.status === true) {
                $('#subscribe').modal('show');
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: response.data.message
                })
            }
        }).catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'System Error'
            })
        })
    })

    document.getElementById("unsubscribe-form").addEventListener("submit", function(event) {
        event.preventDefault()

        axios({
            url: 'process_subscribe.php',
            method: 'post',
            data: $(event.currentTarget).serialize(),
        }).then(response => {
            if (response.data.status === true) {
            $('#unsubscribe').modal('show');
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: response.data.message
                })
            }
        }).catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'System Error'
            })
        })
    })
</script> 
</main>
</body>
</html>