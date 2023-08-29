<?php
require "function.php";
$contact = mysqli_query($koneksi, "SELECT * FROM tb_sosmed");
$link_sosmed=mysqli_query( $koneksi, "SELECT * FROM tb_sosmed");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Kemizares-contact</title>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
<script type="text/javascript">
   (function(){
      emailjs.init("VEp8twZX8sFbxdNw4");
   })();
</script>

<!-- Template Main CSS File -->
<link href="assets/css/style.css" rel="stylesheet">

<!-- =======================================================
* Template Name: Squadfree - v4.11.0
* Template URL: https://bootstrapmade.com/squadfree-free-bootstrap-template-creative/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
======================================================== -->
</head>

<body>
<!-------------------------------------------------------------------------------------------------------------------- 
Header 
---------------------------------------------------------------------------------------------------------------------->

<!-- ======= Header ======= -->
<header id="header" class="fixed-top header-transparent" style="margin-bottom: 0px;">
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

  var imgElement = document.querySelector('img[alt="close"]');
  imgElement.click();

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

<!-------------------------------------------------------------------------------------------------------------------- 
End Header 
----------------------------------------------------------------------------------------------------------------------> 

<!-------------------------------------------------------------------------------------------------------------------- 
Contact Modal 
---------------------------------------------------------------------------------------------------------------------->
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
	
.kontak {
position: relative;
background: linear-gradient(0deg, #FFFFFF -30%, #121212 81.77%, #000000 94.27%)#000000;
margin-bottom: -90px;
}

.kontak-content {
background-color: #fefefe;
margin-bottom: 10%;
margin-top: 18%;
padding: 2%;
border: 1px solid #888;
width: 1293px;
max-width: 100%;
display: flex;
z-index: 10;
position: relative;
}

.kontak-left {
flex: 1;
text-align: left;
width: 100%;
max-width: 807px;
margin-left: 7%;
}

.kontak-right {
flex: 1;
text-align: left;
color: #FFFFFF;
width: 100%;
max-width: 486px;
margin-left: 13.5%;
}
.kontak-right ul {
margin-top: 37%;
margin-bottom: 20px;
font-family: mulish;
font-size: 15px;
line-height: 1.2;
margin-left: 9%;
}

.kontak-right li {
margin-bottom: 62px;
list-style: none;
display: flex;
align-items: center;
}

.kontak-right .keterangan {
margin-right: 8%;
font-size: 25px;
margin-top: -13px;
}

.kontak-title {
text-align: center;
font-family: 'Mulish';
font-style: normal;
font-weight: 700;
font-size: 48px;
line-height: 60px;
letter-spacing: 0.05em;
color: #000000;
}
.kontak-title-kanan {

font-family: 'Mulish';
font-style: normal;
font-weight: 700;
font-size: 32px;
text-align: center;
letter-spacing: 0.05em;
color: #FFFFFF;
margin-left: 20px;			

}		

.kontak-subtitle {
margin-bottom: 10px;
}

.kontak-label {
text-align: left;
display: block;
margin-bottom: 5px;
margin-left: 1.6%;
color: #000000;
}

.kontak-input {
width: 520px;
padding: 8px;
margin-bottom: 45px;
border-top: hidden;
border-left: hidden;
border-right: hidden;
background-color: transparent;
border-width: 1px;
}
.kontak-area{
width: 520px;
padding: 35px;
margin-bottom: 45px;
background-color: transparent;
}
::placeholder{
color: #000000;
}
.kontak-area::placeholder{
color: #969393;
}

.kontak-button {
width: 100px;
max-width: 100%;			
height: 36px;
max-height: 100%;
margin-left: 40% ;
background: rgba(0, 0, 0, 0.7);
opacity: 0.6;
border-radius: 6px;
border: hidden;
font-family: 'Inter';
font-style: normal;
font-weight: 600;
font-size: 14px;
align-items: center;
text-align: center;
letter-spacing: 0.5px;
color: #FFFFFF;

}

.kontak-button:hover {
background-color: #AFADAD;
color: #000000;
}
.gambarmaps {
position: absolute;
top: 20%;
left: 50%;
transform: translate(-50%, -50%);
z-index: 0;
width: 100%;
filter: grayscale(1);	
}
.kontak-content{
border: hidden;
background: linear-gradient(to right, #d9d9d9 63%, rgb(0, 0, 0, 0.8) 37%);
font-family: mulish;
}
	.social-icon{
		position: relative;
		left: 11%;
		bottom: 5%;
	}
.social-icon a {
display: inline-block;
margin-top: 25%;
    font-size: 18px;
    display: inline-block;
    background: #cbcbcb;
    color: #000;
    line-height: 1;
    padding: 9px 0;
    margin-right: 43px;
    border-radius: 50%;
    text-align: center;
    width: 38px;
    height: 36px;
    transition: 0.3s;
	
}
	.social-icon a:hover{
		    background: #0c0c0c;
    color: #fff;
    text-decoration: none;
	}	

.facebook img{
max-height: 30px;
max-width: 30px;
margin-right: 60px;
margin-left: 0px;
}
.instagram img{
max-height: 30px;
max-width: 30px;
margin-right: 60px;	
}
.linkedine img{
max-height: 30px;
max-width: 30px;
}

.bgmnone {
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
max-width: 106px;
background-color: #424242;
color: #fff;
height: 35px;
margin-top: 36px;
border: hidden;
border-radius: 7px;
margin-bottom: 4.5%;
}
	.btnmail p{
		    top: 50%;
    text-align: center;
    left: 50%;
    transform: translate(-50%, -50%);
    position: relative;
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
.invalid-feedback{
margin-top: -8%;
margin-bottom: 7%;
}
.invalid-input::placeholder {
color: #D80027;
}

</style>
<div id="kontak" class="kontak d-flex justify-content-center"> <img src="assets/img/maps.png" alt="" class="gambarmaps d-flex justify-content-center align-content-center">
  <div class="kontak-content">
    <div class="kontak-left">
      <div class="kontak-title">Get in Touch</div>
      <div class="kontak-subtitle" style="text-align: right; padding-top: 3%;">Mandatory Field*</div>
      <label class="kontak-label" for="name"></label>
      <input class="kontak-input" type="text" id="nameid" placeholder="Name*" required>
      <div class="invalid-feedback" id="nameFeedback"></div>
      <label class="kontak-label" for="email"></label>
      <input class="kontak-input" type="email" id="emailid" placeholder="Email*" required>
      <div class="invalid-feedback" id="emailFeedback"></div>
      <label class="kontak-label" for="phone"></label>
      <input class="kontak-input" type="tel" id="numberid" placeholder="Phone Number" required>
      <div class="invalid-feedback" id="phoneFeedback"></div>
      <label class="kontak-label" for="message" id="message">Message*</label>
      <textarea class="kontak-area" type="text"  id="kotak-pesan"></textarea>
      <button class="kontak-button" onclick="submitForm()" >Submit</button>
    </div>
    <?php foreach($contact as $cc) {?>
  <?php
while($ls = mysqli_fetch_assoc($link_sosmed)) {
?>	  
    <div class="kontak-right">
      <div class="kontak-title-kanan">Contact Information</div>
      <ul>
        <li> <i class="bx bx-map keterangan"></i> <a href="<?= $cc['link_address']?>" target="_blank" style="color: white;">
          <p>Kemizares AB, C/O United Spaces, <br>
            Pumpgatan 1, 417 66 Gothenburg</p>
          </a> </li>
        <li> <i class="bi bi-envelope keterangan"></i> <a style="color: white;" href="<?= $cc['link_email']?>">
          <p><u>contact@kemizares.se</u></p>
          </a> </li>
      </ul>
      <div class="social-icon mt-3 d-flex justify-content-center"> 
  <a target="_blank" href="<?php echo $ls['link_facebook']; ?>" class="facebook"><i class="bx bxl-facebook"></i></a>
  <a target="_blank" href="<?php echo $ls['link_instagram']; ?>" class="instagram"><i class="bx bxl-instagram"></i></a>
  <a target="_blank" href="<?php echo $ls['link_linkedin']; ?>" class="linkedin"><i class="bx bxl-linkedin"></i></a>
		</div>
    </div>
    <?php }?>	  
    <?php }?>
  </div>
</div>
<div class="modal fade" id="reg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bgmnone">
      <div class="modal-body mx-3 d-flex justify-content-center" style="padding-left: 0px">
        <div class="col-lg-10 boxTQ">
		 <button type="button" class="butonclose" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true" style="position: relative;right: 85px;color: black;top: -3px;">&times;</span> </button>
          <div class="notify-tittle align-content-center"> <img class="align-self-center" src="assets/img/STRA.png" alt=""><br>
            <h4>Thank you for contacting us!</h4>
            <h6>Your question has been sent to us. You will hear from us soon.</h6>
          </div>
          <div class="d-flex justify-content-center">
			  <a href="index.php" class="btnmail"><p>Got it</p></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
function submitForm() {
var params = {
    from_name : document.getElementById("nameid").value,
    user_email : document.getElementById("emailid").value,
    user_number : document.getElementById("numberid").value,
    message : document.getElementById("message").value
}

var nameInput = document.getElementById("nameid");
var emailInput = document.getElementById("emailid");
var phoneInput = document.getElementById("numberid");
var nameFeedback = document.getElementById("nameFeedback");
var emailFeedback = document.getElementById("emailFeedback");
var phoneFeedback = document.getElementById("phoneFeedback");
var pesan = document.getElementById("message");
var KotakPesan = document.getElementById("kotak-pesan");
	
var bener = true;



if (nameInput.value === "") {
nameInput.classList.add("is-invalid");
nameFeedback.textContent = "The value is required";
nameInput.style.borderColor = "#D80027";
nameInput.classList.add("invalid-input");
bener = false;
} else {
nameInput.classList.remove("is-invalid");
nameFeedback.textContent = "";
nameInput.style.borderColor = "";
nameInput.classList.remove("invalid-input");
}

if (emailInput.value === "") {
emailInput.classList.add("is-invalid");
emailFeedback.textContent = "The value is required";
emailInput.style.borderColor = "#D80027";
emailInput.classList.add("invalid-input");
bener = false;
} else {
emailInput.classList.remove("is-invalid");
emailFeedback.textContent = "";
emailInput.style.borderColor = "";
emailInput.classList.remove("invalid-input");
}

if (KotakPesan.value === "") {
  KotakPesan.classList.add("is-invalid");
  pesan.style.color = "#D80027";
  KotakPesan.style.borderColor = "#D80027";
  bener = false;
}
 else {
KotakPesan.classList.remove("is-invalid");
KotakPesan.placeholder = "";
pesan.style.color = "";
KotakPesan.style.borderColor = "";
}

if (bener) {
var myModal = new bootstrap.Modal(document.getElementById("reg"));
myModal.show();
emailjs.send("service_hdr563m", "template_g5d5wfs", params).then(function (res) {
    // alert("Success!" + res.status);
})

nameInput.value = "";
emailInput.value = "";
phoneInput.value = "";
pesan.value = "";
KotakPesan.placeholder = "";	

}
}
</script>  

<!-------------------------------------------------------------------------------------------------------------------- 
End Contact Modal 
---------------------------------------------------------------------------------------------------------------------->

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
      
<main id="main">
         
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.id.min.js">
</script>
<script>
</script>

<!-- Template Main JS File --> 
<script src="assets/js/main.js"></script>

<script>
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

</body>
</html>