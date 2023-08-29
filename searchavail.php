<?php
require "function.php";
// $apply = mysqli_query($koneksi, "SELECT * FROM tb_avail_pos");
// $row3 = $apply->fetch_assoc();

$query = $_POST['query'];
$sql = mysqli_query( $koneksi, "SELECT * FROM tb_avail_pos WHERE job_name LIKE '%$query%' OR place LIKE '%$query%' OR date_post LIKE '%$query%' OR end_date LIKE '%$query%' OR type_contract LIKE '%$query%' OR working_hours LIKE '%$query%' OR no_pos LIKE '%$query%' OR salary LIKE '%$query%'" );
// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
//     // Note: You may need to sanitize and validate the input to prevent SQL injection.
//     // For simplicity, we'll assume it's safe in this example.
//     $sql2 = mysqli_query($koneksi, "SELECT * FROM tb_avail_pos WHERE id = '$id'");
//     $row2 = $sql2->fetch_assoc();
//     var_dump($row2);
// }

$count = mysqli_query( $koneksi, "SELECT COUNT(job_name) AS totals FROM tb_avail_pos WHERE job_name LIKE '%$query%' OR place LIKE '%$query%' OR date_post LIKE '%$query%' OR end_date LIKE '%$query%' OR type_contract LIKE '%$query%' OR working_hours LIKE '%$query%' OR no_pos LIKE '%$query%' OR salary LIKE '%$query%'" );

// Periksa apakah query berhasil dijalankan
// if ( mysqli_num_rows( $count ) > 0 ) {
//   // Ambil hasil dari query
//   $data = mysqli_fetch_assoc( $count );
//   $totalCount = $data[ 'totals' ];
// } else {
//   $totalCount = 0;
// }



if ( isset( $_GET[ 'job_name' ] ) ) {
  $job_name = $_GET[ 'job_name' ];
  // Note: You may need to sanitize and validate the input to prevent SQL injection.
  // For simplicity, we'll assume it's safe in this example.
  $apply2 = mysqli_query( $koneksi, "SELECT * FROM tb_avail_pos WHERE job_name = '$job_name'" );

  // var_dump($row3);
}


// if ( isset( $_POST[ 'cari' ] ) ) {
//   $cari_kerja = $_POST[ 'cari_kerja' ];
//   $sql = mysqli_query( $koneksi, "SELECT * FROM tb_avail_pos WHERE 
//   job_name LIKE '%$cari_kerja%' OR place LIKE '%$cari_kerja%' OR date_post LIKE '%$cari_kerja%' OR end_date LIKE '%$cari_kerja%' OR type_contract LIKE '%$cari_kerja%' OR working_hours LIKE '%$cari_kerja%' OR no_pos LIKE '%$cari_kerja%' OR salary LIKE '%$cari_kerja%'" );
// } else {
//   $sql = mysqli_query( $koneksi, "SELECT * FROM tb_avail_pos" );
// }
$team = mysqli_query( $koneksi, "SELECT * FROM tb_team ORDER BY id ASC" );


// if ( isset( $_POST[ 'apply' ] ) ) {
//   $first_name = $_POST[ 'first_name' ];
//   $last_name = $_POST[ 'last_name' ];
//   $email = $_POST[ 'email' ];
//   $phone = $_POST[ 'phone' ];
//   $city = $_POST[ 'city' ];
//   $country = $_POST[ 'country' ];
//   $gender = $_POST[ 'gender' ];
//   $birthdate = $_POST[ 'birthdate' ];
//   $cv = $_POST[ 'cv' ];
//   $other = $_POST[ 'other' ];
//   $linkedin = $_POST[ 'linkedin' ];
//   $mess = $_POST[ 'mess' ];

//   $apply = mysqli_query( $koneksi, "INSERT INTO job_apply (first_name, last_name, email, phone, city, country, gender, birthdate, cv, other, linkedin, mess) VALUES('$first_name', '$last_name', '$email', '$phone', '$city', '$country', '$gender', '$birthdate', '$cv', '$other', '$linkedin', '$mess'" );

//   // Cek apakah query berhasil atau ada error
//   if ( $apply ) {
//     // Jika berhasil
//     echo "Data berhasil disimpan.";
//   } else {
//     // Jika terjadi error
//     echo "Error: " . mysqli_error( $koneksi );
//   }

// }
?>

<?php
$itemsPerPage = 5;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

$offset = ($currentPage - 1) * $itemsPerPage;



// if (isset($_POST['resetBut'])) {
//     // Mengatur nilai pencarian kembali menjadi kosong
//     $inputSimpan = '';
//     echo $inputSimpan;
    
//     // Lakukan query untuk menampilkan data default
//     $sql = mysqli_query($koneksi, "SELECT * FROM tb_avail_pos GROUP BY id DESC LIMIT $offset, $itemsPerPage");
//     $count = mysqli_query($koneksi, "SELECT COUNT(job_name) AS jumlah FROM tb_avail_pos");
// } elseif (isset($_POST['cari'])) {
//   $cari_kerja = $_POST['cari_kerja'];
//   $sql = mysqli_query($koneksi, "SELECT * FROM tb_avail_pos WHERE 
//   job_name LIKE '%$cari_kerja%' OR place LIKE '%$cari_kerja%' OR date_post LIKE '%$cari_kerja%' OR end_date LIKE '%$cari_kerja%' OR type_contract LIKE '%$cari_kerja%' OR working_hours LIKE '%$cari_kerja%' OR no_pos LIKE '%$cari_kerja%' OR salary LIKE '%$cari_kerja%'
//   GROUP BY id DESC LIMIT $offset, $itemsPerPage");
//   $count = mysqli_query($koneksi, "SELECT COUNT(job_name) AS jumlah FROM tb_avail_pos WHERE job_name LIKE '%$cari_kerja%'");
//   $inputSimpan = $_POST['cari_kerja'];
// }else{
//   $sql = mysqli_query($koneksi, "SELECT * FROM tb_avail_pos GROUP BY id DESC LIMIT $offset, $itemsPerPage");
//   $count = mysqli_query($koneksi, "SELECT COUNT(job_name) AS jumlah FROM tb_avail_pos");
//   $inputSimpan = '';
  
// }

  // if (isset($_POST['cari'])) {
  //   // $cari_kerja = $_POST['cari_kerja'];
  //   // $sql = mysqli_query($koneksi, "SELECT * FROM tb_avail_pos WHERE 
  //   // job_name LIKE '%$cari_kerja%' OR place LIKE '%$cari_kerja%' OR date_post LIKE '%$cari_kerja%' OR end_date LIKE '%$cari_kerja%' OR type_contract LIKE '%$cari_kerja%' OR working_hours LIKE '%$cari_kerja%' OR no_pos LIKE '%$cari_kerja%' OR salary LIKE '%$cari_kerja%'
  //   // GROUP BY id DESC LIMIT $offset, $itemsPerPage");
  //   // $count = mysqli_query($koneksi, "SELECT COUNT(job_name) AS jumlah FROM tb_avail_pos WHERE job_name LIKE '%$cari_kerja%'");
  //   // $inputSimpan = $_POST['cari_kerja'];
  // } else {
  //   // $sql = mysqli_query($koneksi, "SELECT * FROM tb_avail_pos GROUP BY id DESC LIMIT $offset, $itemsPerPage");
  //   // $count = mysqli_query($koneksi, "SELECT COUNT(job_name) AS jumlah FROM tb_avail_pos");
  //   // $inputSimpan = '';
  // }



if (mysqli_num_rows($count) > 0) {
    $data = mysqli_fetch_assoc($count);
    $totalCount = $data['totals'];
} else {
    $totalCount = 0;
}

$popup = mysqli_query($koneksi, "SELECT * FROM tb_sosmed");
?>
 <div style="min-height: 1280px">         
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

