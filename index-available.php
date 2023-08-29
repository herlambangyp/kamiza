<?php
require "function.php";
// $apply = mysqli_query($koneksi, "SELECT * FROM tb_avail_pos");
// $row3 = $apply->fetch_assoc();
$sql = mysqli_query( $koneksi, "SELECT * FROM tb_avail_pos" );
// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
//     // Note: You may need to sanitize and validate the input to prevent SQL injection.
//     // For simplicity, we'll assume it's safe in this example.
//     $sql2 = mysqli_query($koneksi, "SELECT * FROM tb_avail_pos WHERE id = '$id'");
//     $row2 = $sql2->fetch_assoc();
//     var_dump($row2);
// }

$count = mysqli_query( $koneksi, "SELECT COUNT(job_name) AS jumlah FROM tb_avail_pos" );

// Periksa apakah query berhasil dijalankan
if ( mysqli_num_rows( $count ) > 0 ) {
  // Ambil hasil dari query
  $data = mysqli_fetch_assoc( $count );
  $totalCount = $data[ 'jumlah' ];
} else {
  $totalCount = 0;
}



if ( isset( $_GET[ 'job_name' ] ) ) {
  $job_name = $_GET[ 'job_name' ];
  // Note: You may need to sanitize and validate the input to prevent SQL injection.
  // For simplicity, we'll assume it's safe in this example.
  $apply2 = mysqli_query( $koneksi, "SELECT * FROM tb_avail_pos WHERE job_name = '$job_name'" );

  // var_dump($row3);
}


if ( isset( $_POST[ 'cari' ] ) ) {
  $cari_kerja = $_POST[ 'cari_kerja' ];
  $sql = mysqli_query( $koneksi, "SELECT * FROM tb_avail_pos WHERE 
  job_name LIKE '%$cari_kerja%' OR place LIKE '%$cari_kerja%' OR date_post LIKE '%$cari_kerja%' OR end_date LIKE '%$cari_kerja%' OR type_contract LIKE '%$cari_kerja%' OR working_hours LIKE '%$cari_kerja%' OR no_pos LIKE '%$cari_kerja%' OR salary LIKE '%$cari_kerja%'" );
} else {
  $sql = mysqli_query( $koneksi, "SELECT * FROM tb_avail_pos" );
}
$team = mysqli_query( $koneksi, "SELECT * FROM tb_team ORDER BY id ASC" );


if ( isset( $_POST[ 'apply' ] ) ) {
  $first_name = $_POST[ 'first_name' ];
  $last_name = $_POST[ 'last_name' ];
  $email = $_POST[ 'email' ];
  $phone = $_POST[ 'phone' ];
  $city = $_POST[ 'city' ];
  $country = $_POST[ 'country' ];
  $gender = $_POST[ 'gender' ];
  $birthdate = $_POST[ 'birthdate' ];
  $cv = $_POST[ 'cv' ];
  $other = $_POST[ 'other' ];
  $linkedin = $_POST[ 'linkedin' ];
  $mess = $_POST[ 'mess' ];

  $apply = mysqli_query( $koneksi, "INSERT INTO job_apply (first_name, last_name, email, phone, city, country, gender, birthdate, cv, other, linkedin, mess) VALUES('$first_name', '$last_name', '$email', '$phone', '$city', '$country', '$gender', '$birthdate', '$cv', '$other', '$linkedin', '$mess'" );

  // Cek apakah query berhasil atau ada error
  if ( $apply ) {
    // Jika berhasil
    echo "Data berhasil disimpan.";
  } else {
    // Jika terjadi error
    echo "Error: " . mysqli_error( $koneksi );
  }

}
?>

<?php
if (isset($_POST['resetBut'])) {
    // Mengatur nilai pencarian kembali menjadi kosong
    $inputSimpan = '';
    echo $inputSimpan;
    
    // Lakukan query untuk menampilkan data default
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_avail_pos GROUP BY id DESC");
    $count = mysqli_query($koneksi, "SELECT COUNT(job_name) AS jumlah FROM tb_avail_pos");
} elseif (isset($_POST['cari'])) {
  $cari_kerja = $_POST['cari_kerja'];
  $sql = mysqli_query($koneksi, "SELECT * FROM tb_avail_pos WHERE 
  job_name LIKE '%$cari_kerja%' OR place LIKE '%$cari_kerja%' OR date_post LIKE '%$cari_kerja%' OR end_date LIKE '%$cari_kerja%' OR type_contract LIKE '%$cari_kerja%' OR working_hours LIKE '%$cari_kerja%' OR no_pos LIKE '%$cari_kerja%' OR salary LIKE '%$cari_kerja%'
  GROUP BY id DESC");
  $count = mysqli_query($koneksi, "SELECT COUNT(job_name) AS jumlah FROM tb_avail_pos WHERE job_name LIKE '%$cari_kerja%'");
  $inputSimpan = $_POST['cari_kerja'];
} else {
  $sql = mysqli_query($koneksi, "SELECT * FROM tb_avail_pos GROUP BY id DESC");
  $count = mysqli_query($koneksi, "SELECT COUNT(job_name) AS jumlah FROM tb_avail_pos");
  $inputSimpan = '';
}

if (mysqli_num_rows($count) > 0) {
    $data = mysqli_fetch_assoc($count);
    $totalCount = $data['jumlah'];
} else {
    $totalCount = 0;
}

$popup = mysqli_query($koneksi, "SELECT * FROM tb_sosmed");
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Kemizares-joinus</title>
<meta content="" name="description">
<meta content="" name="keywords">

<!-- Favicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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

<!-- Template Main CSS File -->
<link href="assets/css/style.css" rel="stylesheet">

<!-- =======================================================
  * Template Name: Squadfree - v4.11.0
  * Template URL: https://bootstrapmade.com/squadfree-free-bootstrap-template-creative/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> 
<script>
window.onload = function(){
pagen();	
}	
    $(document).ready(function(){
        var result1Content = $('#result1').html();
        var result2Content = '';
                inputkosong();

        $('button[name="cari"]').click(function(event){
            event.preventDefault(); 
            var query = $('#cari_k').val();
            if(query != ''){
                $('#result1').html(''); 
                $('#result2').show(); 
                $.ajax({
                    url:"searchavail.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data){
                        result2Content = data;
                        $('#result2').html(data);
                        pagen();
                    }
                });
            } else {
                $('#result1').html(result1Content);
                $('#result2').html('');
                pagen();
                inputkosong();			
            }
        });

        $('.resetcari').click(function(event){
            event.preventDefault(); 
            $('#cari_k').val(''); 
            $('#result1').html(result1Content); 
            $('#result2').html('');
            pagen();
            inputkosong();			
        });

        $('#cari_k').on('input', function() {
            var query = $(this).val();
            if (query === '') {
                $('#result1').html(result1Content);
                $('#result2').html('');
                pagen();
                inputkosong();
            }
        });

        // Tambahkan event handler untuk tombol Enter
        $('#cari_k').keydown(function(event) {
            if (event.keyCode === 13) {
                event.preventDefault(); // Menghentikan aksi bawaan dari tombol Enter
                $('button[name="cari"]').click(); // Menjalankan pencarian
            }
        });
    });
</script>
	
  
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top header-transparent">
  <div class="container d-flex align-items-center justify-content-between position-relative">
    <div class="logo"> 
      <!-- <h1 class="text-light"><a href="index.php"><span>Squadfree</span></a></h1> --> 
      <!-- Uncomment below if you prefer to use an image logo --> 
      <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> </div>
    <nav id="navbar" class="navbar d-flex">
      <ul id="bagtulis">
        <!-- Home --> 
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
    <div class="translate" id="google_translate_element" style="display: none;"></div>
<script type="text/javascript">
function gantiunsub(){
	
document.getElementById("btn-unsubs").textContent = "Avprenumerera";
}	
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({ pageLanguage: 'en', includedLanguages: 'en,sv' }, 'google_translate_element');
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

}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		  
</div>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i> </nav>
    <!-- .navbar --> 
    
  </div>
</header>
<!-- End Header -->

<main id="main"> 
  
  <!-- ======= Available Positions ======= -->
  <section id="availablepositions" class="pricing section-bg">
    <div class="container">
      <div class="section-title">
        <h2 data-aos="fade-in">AVAILABLE POSITIONS</h2>
        
        <!-- pop up tombol di kanan -->


<?php foreach($popup as $pp){?>
<div class="rightcontact">
  <div id="rightbox" class="rightbox">
    <h1>Want to become a <br>
	part of Kemizares team?</h1>
    <p class="email">Visit us or email us!</p>
    <img src="assets/img/sideright.png" id="sideright-img" class="siderght-img" alt="">
    <img src="assets/img/GPSalm.png" class="gpsimg" alt="">
    <a href="<?php echo $pp['link_address']; ?>" target="_blank" class="gpstext">Kemizares AB, C/O United Spaces,
      Pumpgatan 1, 417 55 Gothenburg</a>
<img src="assets/img/mail.png" class="mailimg" alt=""><a class="text-white-black mailtext"href="<?php echo $pp['link_email']; ?>">contact@kemizares.se</a>
  </div>
	
  <div id="rightnav" class="rightnav">
    <h1><img src="assets/img/sideleft.png" class="ikon-kiri" alt=""></h1>
  </div>
</div>

<?php }?>


        <!-- end pop up tombol di kanan -->
        
        <form action="#" method="POST" id="search-form">
          <div class="search-container">
            <div class="search-box" data-aos="fade-in"> <a class="right-link" data-toggle="modal" data-target="#modalSubscriptionForm"> <i class="bi bi-bell" style="margin-right: 10px"></i> Get an email notification when new candidates are added </a> <img src="assets/img/ikon search.png" class="ikon-cilik" alt="">
              <input type="text" id="cari_k" name="cari_kerja" value="<?php echo $inputSimpan ?>" placeholder="Title or Keyword" class="bi-search kotakcari" oninput="inputkosong()">
                <button class="resetcari"><span>&times;</span></button>
              <button type="submit" name="cari">Search</button>
            </div>
          </div>
        </form>
        <div id="result1">
        <div id="high" style="min-height: 1280px;">
          <div class="row no-gutters justify-content-start">
            <div class="col-lg-4 box tulisan" style="background-image: url('assets/img/tags/positions.jpg'); background-size:cover; height: inherit; min-height: 33em;" data-aos="zoom-in">
              <h1>#<?= $totalCount; ?></h1>
              <h5>Available Position</h5>
            </div>
            <?php
            while ( $row = mysqli_fetch_assoc( $sql ) ) {
              $modalId = 'modal_' . $row[ 'id' ];
              // $applyModalId = 'applyModal_' . $row['id'];
              ?>
            <div class="col-lg-4 box list" data-aos="zoom-in">
              <h4>
                <?= $row['job_name']; ?>
              </h4>
              <h6 class="lokasi"><i class="bi bi-geo-alt"></i>
                <?= $row['place']; ?>
              </h6>
              <div class="date-container">
                <div class="sisi-kiri"> <img src="assets/img/calender.png" style="margin-right: 20%; width: 24px;">Date posted </div>
                <div class="sisi-kanan"> End Date </div>
              </div>
              <div class="date-container">
                <div class="sisi-kiri"> <img src="assets/img/blank.png" style="margin-right: 20%; width: 24px;">
                  <?= $row['date_post']; ?>
                </div>
                <div class="sisi-kanan">
                  <?= $row['end_date']; ?>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <ul>
                    <li class="smalltittle"> Type of contract</li>
                    <br>
                    <li>
                      <?= $row['type_contract']; ?>
                    </li>
                    <br>
                    <br>
                    <br>
                    <li class="smalltittle"> No: of positions</li>
                    <br>
                    <li>
                      <?= $row['no_pos']; ?>
                    </li>
                  </ul>
                </div>
                <div class="col-lg-6 col6-right">
                  <ul>
                    <li class="smalltittle">Working hours</li>
                    <br>
                    <li>
                      <?= $row['working_hours']; ?>
                    </li>
                    <br>
                    <br>
                    <br>
                    <li class="smalltittle"> Salary</li>
                    <br>
                    <li>
                      <?= $row['salary']; ?>
                    </li>
                  </ul>
                </div>
                <a href="#contactModall" data-bs-toggle="modal" data-bs-target="#contactModallEmbed<?php echo $row['id']; ?>" class="jobdeskripsi">
                <?= $row['comment']; ?>
                <a2 class="selengkapnya">...Read More</a2>
                </a> 
                
                <!-- <a href="#" class="get-started-btn">Read More</a> --> 
              </div>
            </div>
            
            <!-- <div class="container"> --> 
            <!-- <div class="row"> --> 
            <!-- <div class="col-lg-12 mx-auto"> -->
            <div class="modal fade" id="contactModallEmbed<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content kotakmodalavaila" style="max-width: 1033px; width: 500%; margin-left: -50%;">
                  <button type="button" class="butonclose" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                  <div class="row putih">
                    <div class="col-md-6">
                      <h3 class="job-name">
                        <?= $row['job_name']; ?>
                      </h3>
                      <div class="row">
                        <div class="col-md-12 kiriputih">
                          <label for="name"><strong>About the role</strong></label>
                          <p class="inner-description">
                            <?= $row['about']; ?>
                          </p>
                        </div>
                      </div>
                      <div class="form-group kiriputih">
                        <label for="name"><strong>Technical Requirements</strong></label>
                        <p class="inner-description">
                          <?= $row['technical_re']; ?>
                        </p>
                      </div>
                      <div class="form-group kiriputih">
                        <label for="name"><strong>Who you are</strong></label>
                        <p class="inner-description">
                          <?= $row['who_you_are']; ?>
                        </p>
                      </div>
                      <div class="form-group kiriputih">
                        <label for="name"><strong>What we offer</strong></label>
                        <p class="inner-description">
                          <?= $row['what_we']; ?>
                        </p>
                      </div>
                      <div class="text-center"> <a class="aplly-now-txt" href="applyposition.php?job=<?= $row['job_name']; ?>">
						  <button class="btn btn-indigo"><p style="font-size: 14px">Apply now</p></button>
                        </a> </div>
                    </div>
                    <div class="col-md-6 hitam">
                      <h3 class="judul-kanan-hitam"><strong>Information</strong></h3>
                      <ul>
                        <div class="em"> <img src="assets/img/GPS.png" class="ma">&nbsp;<a href="<?= $row['link_lokasi']; ?>" target="_blank" style="color: white;"><?= $row['place']; ?></a></div>
                        <div class="em" style="margin-bottom: 13%;"> <img src="assets/img/maill.png" class="ma"> <a style="color: white;"href="mailto:contact@kemizares.se"><?= $row['email_post']; ?></a></div>
                        <div class="date-container">
                          <div class="tanggal-kiri"> <img src="assets/img/calender.png" style="margin-right: 20%; width: 24px;">Date posted </div>
                          <div class="tanggal-kanan"> End Date </div>
                        </div>
                        <div class="date-container">
                          <div class="tanggal-kiri"> <img src="assets/img/blank.png" style="margin-right: 20%; width: 24px;">
                            <?= $row['date_post']; ?>
                          </div>
                          <div class="tanggal-kanan">
                            <?= $row['end_date']; ?>
                          </div>
                        </div>
                      </ul>
                      <div class="row kete">
                        <div class="col-lg-6" id="readmore">
                          <ul>
                            <li style="color:#9B9B9B;"> Type of contract</li>
                            <li>
                              <?= $row['type_contract']; ?>
                            </li>
                            <br>
                            <br>
                            <li style="color:#9B9B9B;"> No: of positions</li>
                            <li>
                              <?= $row['no_pos']; ?>
                            </li>
                          </ul>
                        </div>
                        <div class="col-lg-6" id="read-more">
                          <ul>
                            <li style="color:#9B9B9B;">Working hours</li>
                            <li>
                              <?= $row['working_hours']; ?>
                            </li>
                            <br>
                            <br>
                            <li style="color:#9B9B9B;"> Salary</li>
                            <li>
                              <?= $row['salary']; ?>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="social-icon mt-3 d-flex justify-content-center"> 
                        <a target="_blank" href=" <?= $row['link_facebook']; ?>" class="facebook"><i class="bx bxl-facebook"></i></a> 
                        <a target="_blank" href=" <?= $row['link_instagram']; ?>" class="instagram"><i class="bx bxl-instagram"></i></a> 
                        <a target="_blank" href=" <?= $row['link_linkedin']; ?>" class="linkedin"><i class="bx bxl-linkedin"></i></a> 
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
<div id="custom-pagination" style="    display: flex;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);">
	<div class="d-flex justify-content-center">
    <a href="#" id="custom-prev-page" style="text-align: center;">&lt;</a>
    <a href="#" id="custom-next-page" style="text-align: center;">&gt;</a>
	</div>		
</div>

    <script>
        function pagen() {
            var currentPage = 1;
            // Variabel untuk menghitung total halaman
            var totalPages = Math.ceil(<?= $totalCount; ?> / 5);

            // Fungsi untuk mengupdate tampilan berdasarkan halaman saat ini
function updatePagination() {
    if (totalPages <= 1) {
        // Jika item kurang dari atau berjumlah 5, sembunyikan pagination
        document.getElementById("custom-pagination").style.display = "none";
        return;
    }

    document.getElementById("custom-pagination").style.display = "flex";

    if (currentPage === 1) {
        // Jika halaman pertama, nonaktifkan tombol "Prev"
        document.getElementById("custom-prev-page").classList.add("disabled");
        document.getElementById("custom-next-page").classList.add("kenek");
        document.getElementById("custom-next-page").classList.remove("disabled");
        document.getElementById("custom-prev-page").classList.remove("kenek");
    } else {
        document.getElementById("custom-prev-page").classList.remove("disabled");
        document.getElementById("custom-prev-page").classList.add("kenek");
    }

    if (currentPage === totalPages) {
        // Jika di halaman terakhir, nonaktifkan tombol "Next"
        document.getElementById("custom-next-page").classList.add("disabled");
        document.getElementById("custom-prev-page").classList.add("kenek");
        document.getElementById("custom-next-page").classList.remove("kenek");
        document.getElementById("custom-prev-page").classList.remove("disabled");
    } else {
        document.getElementById("custom-next-page").classList.remove("disabled");
        document.getElementById("custom-next-page").classList.add("kenek");
    }

    // Sembunyikan semua item yang sedang tampil
    var activeItems = document.querySelectorAll(".box.list.active");
    activeItems.forEach(function (item) {
        item.style.animation = "none";
        void item.offsetWidth; // Membaca property offsetWidth untuk memaksa reflow
        item.style.animation = "fade-zoom-in 0.5s ease forwards";
    });

    // Sembunyikan semua item
    var items = document.querySelectorAll(".box.list");
    items.forEach(function (item) {
        item.style.display = "none";
        item.classList.remove("active");
    });

    // Tampilkan item yang sesuai dengan halaman saat ini
    var startIndex = (currentPage - 1) * 5;
    var endIndex = startIndex + 5;
    for (var i = startIndex; i < endIndex; i++) {
        if (items[i]) {
            items[i].style.display = "block";
            items[i].classList.add("active");
        }
    }
}

            // Fungsi untuk mengubah halaman ke halaman sebelumnya
            document.getElementById("custom-prev-page").addEventListener("click", function (event) {
                event.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    updatePagination();
                }
            });

            // Fungsi untuk mengubah halaman ke halaman berikutnya
            document.getElementById("custom-next-page").addEventListener("click", function (event) {
                event.preventDefault();
                if (currentPage < totalPages) {
                    currentPage++;
                    updatePagination();
                }
            });

            // Inisialisasi tampilan awal
            updatePagination();
        }

        // Panggil fungsi pagination saat halaman dimuat
        pagen();
    </script>
			</div>
        </div>
		  <div id="result2"></div>
		  </div>	
      

      </div>
    </div>
  </section>
          
          <!-- End Pricing Section --> 
          
          <!-- ======= Team Section ======= -->
          <section id="meetourteam" class="team">
            <div class="container">
              <div class="section-title" data-aos="fade-in" data-aos-delay="100">
                <h2>MEET OUR TEAM</h2>
              </div>
              <div class="row posts-list">
              <?php      
              // Query untuk mengambil data dari database    
            
              while($tm = mysqli_fetch_assoc($team)){       
                // echo $row['salary'];
                ?>
                <div class="col-lg-4 col-md-6 team">
                  <div class="member" data-aos="fade-up" data-aos-delay="150">
                    <div class="id">
                      <h4><?= $tm['name'] ?></h4>
                      <h6><i><?= $tm['major'] ?></i></h6>
                      <h6><?= $tm['experience'] ?></h6>
                      <div class="pic"><img src="data:image/jpeg;base64,<?=base64_encode($tm['file_gambar'] )?>" width="288px" ></div>
                      <a href="mailto:indira.sethumadhavan@kemizares.se">
                      <h6><strong><u class="email"><?= $tm['email']; ?></u></strong></h6>
                      </a>
                      <!-- <div class="social"> 
                        <a href="https://www.facebook.com/rozak.kamikaze.9"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/husain_mz/"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/muhammad-husaini-zuhdi-5514b6198/"><i class="bi bi-linkedin"></i></a>
                      </div> -->
                    </div>
                  </div>
                </div>
              
              <?php
              }    
              ?>
            </div>
        <div class="pagination justify-content-center" id="pagination-no-halaman-meet">
          <a href="#" class="pagination-button prev"style="text-align:center">&lt;</a>
          <a href="#" class="pagination-button next"style="text-align:center">&gt;</a>
        </div>
		
  </section>
  <!-- End Team Section --> 
  
  <!-- Contact modal --> 
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

      <!-- hapus -->
    </div>
  </div>
  <!-- -------------------sub sub modal apply now-------------------- -->
  <style>
	  
	.social-icon {
    position: relative;
    left: 0px;
    top: -60px;
    bottom: 0px;
}
.social-icon .facebook,
.social-icon .instagram,
.social-icon .linkedin
	  {
display: inline-block;
margin-top: 25%;
    font-size: 18px;
    display: inline-block;
    background: #cbcbcb;
    color: #000;
    line-height: 1;
    padding: 9px 0;
    margin-right: 90px;
    border-radius: 50%;
    text-align: center;
    width: 38px;
    height: 36px;
    transition: 0.3s;
	color: black;
	
}
	.social-icon a:hover{
		    background: #0c0c0c;
    color: #fff;
    text-decoration: none;
	}	
	  
	  
  /*------------------------------------------------------------------------------------------------------------ 
  CSS for Job aplication
  --------------------------------------------------------------------------------------------------------------*/
  .embed-1 {
  color: #FFFFFF;
  display: none;
  position: fixed;
  z-index: 1055;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: scroll;
  background-color: rgba(0, 0, 0, 0.5);
  }
  .embed-content-2 h2{
  text-align: center;
  }
  .embed-content-2 {
  justify-content: space-between;
  background-color: #0F0F0F;
  margin-right: -95%;
  padding: 20px;
  width: 1033px;
  max-width: 1033px;
  border: hidden;
  pointer-events: auto;
  position: relative;
  left: -26%;
  margin-top: 1%;
  }

  .embed-content-2 h4 {
  font-size: 26px;
  margin: 0;
  color: #FFFFFF;
	text-align: center;  
  }

  .embed-content-2 h5 {
  text-align: left;
  margin-top: 5%;
  margin-bottom: 5px;
  }
  #country-code{
  width: 30%;
  height: 35px;
  max-width: 300px;
  border-radius: 7px;
  border-bottom-right-radius: 0px;
  border-top-right-radius: 0px;
  border-right-color: #000000 1000px;
  border-left: hidden;
  border-bottom: hidden;
  border-top: hidden;
  margin-bottom: -15px;
  }
  .embed-content-2 input[type="tel"]{
  width: 70%;
  height: 35px;
  border-radius: 7px;
  border: hidden;
  border-bottom-left-radius: 0px;
  border-top-left-radius: 0px;
  }
  #gender{
  width: 100%;
  height: 35px;
  max-width: 300px;
  border-radius: 7px;
  border: hidden;
  margin-bottom: -15px;	

  }
  .agree{
      text-align: left;
      position: relative;
      width: 1000px;
      height: 17px;
      left: 12%;
      font-family: 'Inter';
      font-style: normal;
      font-weight: 400;
      font-size: 14px;
      line-height: 17px;

  }
  #agree{
  width: 13px;
  height: 13px;

  }
        .label-linkedin{
  position: absolute;
      width: 93px;
      height: 20px;
      left: 137px;
      top: 545px;
      font-family: 'Mulish';
      font-style: normal;
      font-weight: 400;
      font-size: 24px;
      line-height: 20px;
      display: flex;
      align-items: center;
      color: #FFFFFF;
        }
        .label-massage{
      position: absolute;
      width: 100px;
      height: 20px;
      left: 137px;
      top: 605px;
      font-family: 'Mulish';
      font-style: normal;
      font-weight: 400;
      font-size: 24px;
      line-height: 20px;
      display: flex;
      align-items: center;
      color: #FFFFFF;
        }
        #message{
      width: 100%;
      height: 35px;
      max-width: 431px;
      border-radius: 7px;
      border: hidden;
      margin-bottom: 1px;
      position: relative;
      left: 35%;
        }
  #linkedin{
      width: 100%;
      height: 35px;
      max-width: 431px;
      border-radius: 7px;
      border: hidden;
      margin-bottom: 25px;
      position: relative;
      left: 35%;
      margin-top: 25px;


  }
  .embed-content-2 input[type="text"],
  .embed-content-2 input[type="email"],
  .embed-content-2 input[type="date"],
  .embed-content-2 input[type="file"],
  .embed-content-2 input[type="text"] {
      width: 100%;
      height: 35px;
      max-width: 300px;
      border-radius: 7px;
      border: hidden;
  }

  .embed-body-4 {
  max-width: 1033px;
  margin-bottom: 10px;
  max-height: 50%;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding-left: 12%;
  padding-right: 12%;
  }

  .form-right-6 h4 {
  padding-right: 20%;
  text-align: right;
  font-size: 14px;
  margin-top: 0;
  }

  .form-right-6 h5 {
  padding-left: 20%;
  margin-bottom: 5px;
  }

  .form-left-5 h4 {
  text-align: left;
  font-size: 14px;
  margin-top: 0;
  }

  .embed-footer-7 {
  text-align: center;
  margin-top: 20px;
  }

  .embed-footer-7 button {
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
  }

  .embed-content-2 .chekbocks {
  width: 100px;
  max-width: 100%;
  }

  .embed-content-2 .form-left-5,
  .embed-content-2 .form-right-6 {
  flex-basis: 50%;
  margin-bottom: 0;
  }

  .embed-body-4 h5 {
  text-align: left;
  font-size: 14px;
  margin-bottom: 5px;
  }

  .embed-content-2 input {
  z-index: 1000;
  }

  .embed-content-2 h4 {
  font-size: 26px;
  }

  .embed-content-2 h5 {
  text-align: left;
  margin-top: 5%;
  }

  .chekbocks {
  width: 100px;
  max-width: 100%;
  }

  .embed-content-2 input {
  width: 431px;
  max-width: 100%;
  }

  .embed-body-4 .form-right-6 h4 {
      padding-right: 0%;
      text-align: right;
      font-size: 16px;
      margin-top: 0;
      position: relative;
      top: 15px;
  }

  .embed-body-4 .form-right-6 h5 {
      padding-left: 0%;
  }

  .embed-body-4 .form-left-5 h4 {
      text-align: left;
      font-size: 20px;
      margin-top: 0px;
      position: relative;
      top: 15px;
  }

  .embed-body-4 h5 {
  text-align: left;
  font-size: 14px;
  margin-bottom: 0px;
  }

  .embed-body-4 input {
  width: 300px;
  height: 35px;
  max-width: 100%;
  border-radius: 7px;
  border: hidden;
  margin-bottom: -32px;
  }

  .embed-body-4 .form-left-5,
  .embed-body-4 .form-right-6 {
  flex-basis: 50%;
  }

  .embed-footer-7 {
      text-align: center;
      margin-top: 20px;
      margin-bottom: 50px;
  }

  .embed-footer-7 button {
  position: relative;
  background: #999999;
  border-radius: 6px;
  color: #ffffff;
  border: none;
  cursor: pointer;
  }
        .embed-footer-7 label{	  
  position: absolute;
  left: 23.33%;
  right: 23.33%;
  top: 25%;
  bottom: 25%;
  font-family: 'Inter';
  font-style: normal;
  font-weight: 600;
  font-size: 14px;
  line-height: 24px;
  display: flex;
  align-items: center;
  letter-spacing: 0.5px;

  color: #FFFFFF;


        }	  

  .close-8 {
  color: #fff;
  float: right;
  font-size: 30px;
  font-weight: bold;
  cursor: pointer;
  }

  .close-8:hover,
  .close-8:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
  }

  .thank-you-9 {
  font-size: 24px;
  margin-bottom: 10px;
  }

  .checkmark-icon-10 {
  display: inline-block;
  width: 100px;
  height: 100px;
  background-image: url('checkmark.png');
  background-repeat: no-repeat;
  background-position: center;
  background-size: contain;
  }

  .waiting-message-11 {
  font-size: 14px;
  }

        .form-left{
            color: #bcbcbc;
  position: relative;
  left: 119px;
        }
  .form-right {
  color: #bcbcbc;
  position: relative;
  right: 119px;	  }

        #agree-error{
      color: rgba(255,0,4,1.00);
      position: absolute;
      left: 139px;
      top: 83%;
      font-size: 12px;
        }
        .cv input[type=file]::-webkit-file-upload-button{
  position: absolute;
  width: 132px;
  height: 35px;
  left: 273px;
  top: 470px;
  background: #FFFFFF;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.12);
  border-radius: 6px;
  border: hidden;
  text-align: left;		  
        }	
        .other input[type=file]::-webkit-file-upload-button{
  position: absolute;
  width: 132px;
  height: 35px;
  left: 690px;
  top: 470px;
  background: #FFFFFF;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.12);
  border-radius: 6px;
  border: hidden;
  text-align: left;		  	  
        }
        .cuv{
      position: relative;
      height: 20px;
      left: -5px;
      top: 45px;
      font-family: 'Mulish';
      font-style: normal;
      font-weight: 400;
      font-size: 24px;
      display: flex;
      align-items: center;
      color: #FFFFFF;
        }
        .pother{
      position: absolute;
      width: 63px;
      height: 20px;
      left: 601px;
      top: 477px;
      font-family: 'Mulish';
      font-style: normal;
      font-weight: 400;
      font-size: 24px;
      display: flex;
      align-items: center;
      color: #FFFFFF;
        } 
        #no-chosen-file-cv{

      font-family: 'Mulish';
      font-style: normal;
      font-weight: 400;
      font-size: 14px;
      line-height: 20px;
      color: #FFFFFF;
      margin-left: 72%;
      margin-left: 73%;
      margin-top: 3%;
        }
        #no-choosen-file-other{
      margin-left: 78%;
      margin-top: 9%;
      font-family: 'Mulish';
      font-style: normal;
      font-weight: 400;
      font-size: 14px;
      line-height: 35px;
      color: #FFFFFF;  

        }
        #thankYouEmbed{
            display:none;
  }
        .warning{
      display: none;
      position: absolute;
      margin-top: 0px;
      font-size: 10px;
      color: red;
  }
            .warningkanan{
      display: none;
      position: absolute;
      margin-top: -6px;
      font-size: 10px;
      color: red;
  }
        .form-right-6{
            padding-left: 10%;
        }
        .form-right-6 input{
      margin-bottom: 6px;
        }
        .form-left-5 input{
            margin-bottom: 0px;
        }

  /*------------------------------------------------------------------------------------------------------------ 
  End css job aplication
  --------------------------------------------------------------------------------------------------------------*/

  </style>
  <div class="modal fade embed-1" id="myEmbed" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true" onclick="closeEmbed(event)">
    <div class="modal-dialog" role="document">
      <div class="modal-content embed-content-2">
        <button type="button" class="butonclose" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        <h2>Job Aplication</h2>
        <h4>Embeded Developer</h4>
        <div class="embed-body-4">
          <div class="form-left-5">
            <h4>Personal Details</h4>
            <h5 id="h5name">First Name</h5>
            <input type="text" id="name" placeholder="First Name" required>
            <br>
            <p id="inputnama" class="warning">The Value is required</p>
            <h5 id="h5email">Email</h5>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <br>
            <p id="inputemail" class="warning">The Value is required</p>
            <h5 id="h5city">City</h5>
            <input type="text" id="city" name="city" placeholder="City" required>
            <br>
            <p id="inputkota" class="warning">The Value is required</p>
            <h5>Gender</h5>
            <select id="gender" name="gender">
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
            <div class="cv">
              <p class="cuv">CV*</p>
              <input type="file" id="no-chosen-file-cv" name="cv" class="sembunyi">
            </div>
            <p class="label-linkedin">Linkedin</p>
            <input type="text" id="linkedin" name="linkedin" placeholder="Linkedin">
            <p class="label-massage">Massage</p>
            <input id="message" name="message" placeholder="Message">
          </div>
          <div class="form-right-6">
            <h4>Mandatory Fields*</h4>
            <h5 id="h5lastname">Last Name</h5>
            <input type="text" id="text" name="last-name" placeholder="Last Name" required>
            <br>
            <p id="inputlast" class="warningkanan">The Value is required</p>
            <h5 id="h5phonenumber">Phone Number</h5>
            <select id="country-code" name="country-code">
              <option value="+1">+1</option>
              <option value="+44">+44</option>
              <option value="+61">+61</option>
              <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>
              <br>
              <p id="inputphone" class="warning">
              The Value is required
              </p>
            </select>
            <h5 id="h5country">Country</h5>
            <input type="text" id="country" name="country" placeholder="Country">
            <br>
            <p id="inputcountry" class="warningkanan">The Value is required</p>
            <h5 id="h5birthdate">Birthdate</h5>
            <input type="date" id="birthdate" name="birthdate" placeholder="Birthdate" required>
            <br>
            <p id="inputtgl" class="warning">The Value is required</p>
            <div class="other">
              <p class="pother">Other</p>
              <input type="file" id="no-choosen-file-other" name="cv" class="sembunyi">
            </div>
          </div>
        </div>
        <label for="agree" class="agree">
          <input type="checkbox" id="agree" name="agree">
          &nbsp;&nbsp;&nbsp;&nbsp;<a href="#PP" data-toggle="modal" data-target="#PP"><u>I have read and accept the terms and conditions and privacy policy*</u></a> </label>
        <div id="agree-error" class="error-message-12"></div>
        <div class="embed-footer-7">
          <button onclick="submitForm()">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="thankYouEmbed" tabindex="1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content bgmnone">
        <div class="modal-body mx-3 d-flex justify-content-center" style="padding-left: 0px">
          <div class="col-lg-10 boxTQ">
            <div class="notify-tittle align-content-center"> <img class="align-self-center" src="assets/img/cawangbig.png" alt=""><br>
              <h4>Your application was successfully sent!</h4>
              <h6>You will be hearing from us soon.</h6>
            </div>
            <div class="d-flex justify-content-center">
              <button class="btnmail" type="button" aria-label="Close" data-dismiss="modal" onclick="closeThankYouEmbed()">Got it</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
  <!-- -------------------end sub sub modal apply now-------------------- --> 
  <script>
  /*------------------------------
  Fungsi modal job aplication
  Function for job aplication box
  -------------------------------- */

  function openEmbed() {
  document.getElementById("myEmbed").style.display = "block";
  }

  function closeEmbed(event) {
  var embed = document.getElementById("myEmbed");
  if (event.target === embed || event.target.classList.contains("close-8")) {
  embed.style.display = "none";
  }
  }

  function submitForm() {
    var agreeCheckbox = document.getElementById("agree");
    var agreeError = document.getElementById("agree-error");
    var inputnama = document.getElementById('name');
    var inputemail = document.getElementById('email');
    var inputcountry = document.getElementById('country');
    var inputlastname = document.getElementById('text');
    var peringatanname = document.getElementById('inputnama');
    var peringatanemail = document.getElementById('inputemail');
    var peringatancountry = document.getElementById('inputcountry');
    var peringatanlastname = document.getElementById('inputlast');
    var h5name = document.getElementById('h5name');
    var h5email = document.getElementById('h5email');
    var h5country = document.getElementById('h5country');
    var h5lastname = document.getElementById('h5lastname');
    var bener = true;

    if (!agreeCheckbox.checked) {
      agreeError.textContent = "Please agree to the terms and conditions.";
      bener = false;
    } else {
      agreeError.textContent = "";
    }

    if (inputnama.value === "") {
      peringatanname.style.display = "block";
      h5name.style.color = "red";
      h5name.textContent = "First Name*";
      bener = false;
    } else {
      peringatanname.style.display = "";
      h5name.style.color = "";
      h5name.textContent = "First Name";
    }

    if (inputemail.value === "") {
      peringatanemail.style.display = "block";
      h5email.style.color = "red";
      h5email.textContent = "Email*";
      bener = false;
    } else {
      peringatanemail.style.display = "";
      h5email.style.color = "";
      h5email.textContent = "Email";
    }

    if (inputcountry.value === "") {
      peringatancountry.style.display = "block";
      h5country.style.color = "red";
      h5country.textContent = "Country*";
      bener = false;
    } else {
      peringatancountry.style.display = "";
      h5country.style.color = "";
      h5country.textContent = "Country";
    }

    if (inputlastname.value === "") {
      peringatanlastname.style.display = "block";
      h5lastname.style.color = "red";
      h5lastname.textContent = "Last Name*";
      bener = false;
    } else {
      peringatanlastname.style.display = "";
      h5lastname.style.color = "";
      h5lastname.textContent = "Last Name";
    }

    if (bener) {
      $('#thankYouEmbed').modal('show');
    }
  }

  function closeThankYouEmbed() {
  $('#thankYouEmbed').modal('hide');
  }

  /*-------------------------------
  END FUNCTION JOB APLICATION BOX
  ------------------------------- */	

  </script> 
  
  <!-- -------------------end sub sub modal apply now-------------------- --> 
  
  <!-- ----Get Notify bar an email-------- -->
  <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content bgmnone">
        <div class="modal-body mx-3 d-flex justify-content-center" style="padding-left: 0px">
          <div class="col-lg-10 boxgetemail">
              <form id="subcribe-job-form">
                <div class="notify-tittle">
                  <button type="button" id="close-get-notify" class="closemail" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                  <h4>Notify me when new positions are added</h4>
                </div>
                <input type="hidden" name="type" value="sub">
                <input type="hidden" name="notify-option" value="1">
                <div class="d-flex justify-content-center">
                  <input type="email" id="form2" class="form-controlll validate" placeholder="Email Address" name="email" required>
                  <label data-error="wrong" data-success="right" for="form2"></label>
                </div>
                <div class="error-message" id="form2-error" style="display: none">The Value is Required</div>
                <div class="d-flex justify-content-center">
                  <button type="submit" class="btnmail" id="buton-subsi">Subscribe</button>
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
              <button class="btnmail" id="got-it-getnotify" type="button" aria-label="Close" data-bs-dismiss="modal">Got it</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script>
$("#got-it-getnotify").click(function() {
  // Menggunakan jQuery untuk memicu klik pada tombol "#close-get-notify"
  $("#close-get-notify").click();
});

</script>
  <style>
	  .kenek{
    font-weight: 600;
    padding-top: 3px;
    width: 40px;
    height: 40px;
    font-size: 20px;
    margin-left: 10px;
    color: #000;
    background-color: rgb(183 183 183);
    border: hidden;
    border-radius: 5px;
	  }
	  .kenek:hover{
    color: #000000;
    background-color: #6D6D6D;
	  }	  
	  .disabled{
    font-weight: 600;
    padding-top: 3px;
    width: 40px;
    height: 40px;
    font-size: 20px;
    margin-left: 10px;
    color: #fff;
    background-color: rgb(0 0 0);
    border: hidden;
    border-radius: 5px;
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
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
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
  </style>
  
  <!-- ----End Get Notify bar an email-------- -->
  
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@200&display=swap" rel="stylesheet">
  
  <!-------------------------------------------------------------------------------------------------------------------------  
                                Privacy policy
  ------------------------------------------------------------------------------------------------------------------------->
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
                <p>
              
              <a target="_blank" href="https://app.websitepolicies.com/dsar/view/g6hy5ojl" style="font-size: 18px; font-style: bold; border-bottom: 1px solid #446381; color: #446381; ">Submit a data access request</a></p>

              
              <!-- <p><a href="https://app.websitepolicies.com/dsar/view/g6hy5ojl">Submit a data access request</a></p> -->
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

  <!-------------------------------------------------------------------------------------------------------------------------  
                                END Privacy policy
  ------------------------------------------------------------------------------------------------------------------------->

    <?php require 'subscribe.php' ?>


    <style>   
    
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
font-size: 20px;
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
      </style>
      

  
                

<style>
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
</style>


<?php require 'subscribe.php' ?>  
<?php include "terimakasih-sub.php"	?>
<?php include "unsub.php"	?>	
<?php include "footer.php"; ?>          
  
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
  
  <!---------------------------------- 
  Script untuk fungsi get notify email
  ------------------------------------> 
  
<script>
/*-------------------------------------------------------------------------------
Fungsi Pagination Meet Our Team
--------------------------------------------------------------------------------*/	
document.addEventListener("DOMContentLoaded", function() {
  var daftarTim = document.querySelector(".posts-list");
  var anggotaTim = daftarTim.getElementsByClassName("col-lg-4 col-md-6 team");
  var anggotaPerHalaman = 6;
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
    tombolSebelumnya.classList.add("first-page"); // Tambahkan kelas CSS tambahan
  } else {
    tombolSebelumnya.classList.remove("disabled");
    tombolSebelumnya.classList.remove("first-page"); // Hapus kelas CSS jika tidak di halaman pertama
  }

  if (halamanSaatIni === totalHalaman) {
    tombolSelanjutnya.classList.add("disabled");
    tombolSelanjutnya.classList.add("last-page"); // Tambahkan kelas CSS tambahan
  } else {
    tombolSelanjutnya.classList.remove("disabled");
    tombolSelanjutnya.classList.remove("last-page"); // Hapus kelas CSS jika tidak di halaman terakhir
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
});

/*-------------------------------------------------------------------------------
End Fungsi Pagination Meet Our Team
--------------------------------------------------------------------------------*/
	
/*-------------------------------------------------------------------------------
Fungsi Get Notify Email
--------------------------------------------------------------------------------*/
document.querySelector('#modalSubscriptionForm .btnmail').addEventListener('click', function () {
  var emailInput = document.getElementById('form2');
  var emailValue = emailInput.value;
  var errorContainer = document.getElementById('form2-error');
  var tqModal = document.getElementById('TQ');

  if (emailValue.trim() === "") {
    emailInput.classList.add('error');
    errorContainer.style.display = 'block';
    $(tqModal).modal('hide');
  } else {
    emailInput.classList.remove('error');
    errorContainer.style.display = 'none';
    $('#modalSubscriptionForm').modal('hide');
    $('#TQ').modal('show');
  }
});
	
	
    document.getElementById("subcribe-job-form").addEventListener("submit", function(event) {
        event.preventDefault()

        var emailInput = document.getElementById('form2');
        var emailValue = emailInput.value;
        var errorContainer = document.getElementById('form2-error');
        var tqModal = document.getElementById('TQ');

        if (emailValue.value === '') {
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
/*-------------------------------------------------------------------------------
END Fungsi Get Notify Email
--------------------------------------------------------------------------------*/	
	
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

  <script>
/*-------------------------------------------------------------------------------
Fungsi Clear Search
--------------------------------------------------------------------------------*/
function inputkosong() {
    var kotakpencarian = document.querySelector(".kotakcari");
    var resetcari = document.querySelector(".resetcari");
    
    if (kotakpencarian.value === "") {
        resetcari.style.display = "none";
    } else {
        resetcari.style.display = "block";
    }
}
window.onload = function() {
    inputkosong();
};

/*-------------------------------------------------------------------------------
END Fungsi Clear Search
--------------------------------------------------------------------------------*/
		  
	  
        document.addEventListener('DOMContentLoaded', function () {
            const searchForm = document.getElementById('search-form');
            const resetButton = document.getElementById('resetButton');

            // Add click event listener to reset button
            resetButton.addEventListener('click', function () {
                // Clear input value and submit the form to reset filters
                searchForm.querySelector('input[name="cari_kerja"]').value = '';
                searchForm.submit();
            });
        });

  </script>
  
</main>
</body>
</html>