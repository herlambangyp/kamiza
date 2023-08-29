<?php
require "function.php";
// echo "TESSSSSSSSSSSSSSSSSSSSSSSSS";
      
      // Query untuk mengambil data dari database

      $query = $_POST['query'];


    $sql = "SELECT * FROM tb_candidate WHERE job_name LIKE '%$query%' OR skill LIKE '%$query%' OR avail LIKE '%$query%' OR loc LIKE '%$query%' OR experience LIKE '%$query%'";
    $result = mysqli_query($koneksi, $sql);

    
  // Eksekusi query untuk menghitung keseluruhan data
  $countQuery = "SELECT COUNT(*) as totals FROM tb_candidate WHERE job_name LIKE '%$query%' OR skill LIKE '%$query%' OR avail LIKE '%$query%' OR loc LIKE '%$query%'  OR experience LIKE '%$query%'";
  $countResult = mysqli_query($koneksi, $countQuery);
  $rowCount = mysqli_fetch_assoc($countResult)['totals'];

    


    ?>
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
                    <a class="btn btn-view" href="superadmin/view_pdf.php?idv=<?= $row['id']; ?>" target="_blank">CV</a>
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
