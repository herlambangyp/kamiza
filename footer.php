<?php

$link_sosmed=mysqli_query( $koneksi, "SELECT * FROM tb_sosmed");

?>
      

  <!-- ======= Footer ======= -->
  <div id="hero" style="height: auto">
  <?php
while($ls = mysqli_fetch_assoc($link_sosmed)) {
?>  
  <footer id="footer">
      <div class="footer-top">
        <div class="container">
          <div class="row" style="        display: flex;
    justify-content: space-between;
    margin-left: 80px;
    flex-wrap: nowrap;">
            <div class="col-lg-3 col-md-6 footer-links">
              <div class="strip"></div>
              <br>
              <br>
              <h4 style="color: #dddddd;" class="custom-heading contact-heading">Contact us</h4>
              <ul>
                <!-- <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li> -->
                
                <li> <i class="bx bx-map"></i> <a href="<?php echo $ls['link_address']; ?>" target="_blank" style="color: white;">Kemizares AB, C/O United Spaces, <br>
                  <br>
                  Pumpgatan 1, 417 55 Gothenburg</a> </li>
                

<li>
  <!-- Contoh tautan dengan garis putih dan spasi -->
  <i class="bi bi-envelope"></i> <a class="my-link" href="<?php echo $ls['link_email']; ?>" target="_blank">contact@kemizares.se</a>
</li>




              </ul>
            </div>
            <div class="col-lg-3 col-md-6 footer-links">
              <div class="strip"></div>
              <br>
              <br>
              <h4 style="color: #dddddd;" class="custom-heading links-heading">Important links</h4>
              <ul>
                <li> <a href="index-available.php#availablepositions">Join us</a></li>
                <li> <a href="index-whatweoffer.php#whatweoffer">What we offer</a></li>
                <li> <a href="index-candidates.php#">Customers & Partners</a></li>
                <li> <a href="#subs" data-toggle="modal" data-target="#subs" id="btn-subs">Subscribe</a></li>
                <li> <a href="#unsub" data-toggle="modal" data-target="#unsub" id="btn-unsubs">Unsubscribe</a></li>
                <li> <a href="superadmin/index.php" target="_blank" id="btn-unsubs">Data Center</a></li>
              </ul>
            </div>
            <div class="col-lg-3 col-md-6 footer-newsletter">
              <div class="strip"></div>
              <br>
              <br>
              <h4 style="color: #dddddd;" class="custom-heading connect-heading">Connect with us</h4>



              <!-- <p> <a href="#PP" data-toggle="modal" data-target="#PP">Privacy Policy</a></p> -->

              
    

              <p>
                <!-- Contoh tautan dengan class my-unique-style -->
                <a style="font-size: 14px; position: relative; top: -10px; " href="#PP" data-toggle="modal" data-target="#PP">Privacy Policy</a>
              </p>


              
<div class="social-links mt-3">
  <a target="_blank" href="<?php echo $ls['link_facebook']; ?>" class="facebook"><i class="bx bxl-facebook"></i></a>
  <a target="_blank" href="<?php echo $ls['link_instagram']; ?>" class="instagram"><i class="bx bxl-instagram"></i></a>
  <a target="_blank" href="<?php echo $ls['link_linkedin']; ?>" class="linkedin"><i class="bx bxl-linkedin"></i></a>
</div>




            </div>
          </div>
        </div>
      </div>
    </footer>
    <?php
}
?>
  </div>
  <!-- End Footer --> 
  
  