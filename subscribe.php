<!--------------------------------------------------------------------------------------------------------------------
                                  Subscribe Email
  ---------------------------------------------------------------------------------------------------------------------->

<!-- Subscribe Email -->
<div class="modal fade" id="subs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bgmnone">
            <div class="modal-body mx-3 d-flex justify-content-center" style="padding-left: 0px">
                <div class="col-lg-10 boxgetemail">
                    <form id="subscribe-form">
                        <div class="sub-tittle">
                            <button type="button" class="closemail" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4>Select the information you want to subscribe</h4>
                        </div>
                        <input type="hidden" name="type" value="sub">
                        <div class="radio-container">
                            <div class="radio-wrapper">
                                <input type="radio" id="option-position" name="notify-option"
                                       class="form-check-input validate" value="1" required>
                                <label for="option-position" class="form-check-label">I am looking for available
                                    positions</label>
                                <br>
                            </div>
                            <div class="radio-wrapper">
                                <input type="radio" id="option-candidate" name="notify-option"
                                       class="form-check-input validate" value="2" required>
                                <label for="option-candidate" class="form-check-label">I am looking for available
                                    candidates</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="email" id="form3" class="form-controlll validate" name="email"
                                   placeholder="Email Address" required>
                            <label data-error="wrong" data-success="right" for="form3"></label>
                        </div>
                        <div class="error-message" id="form3-error"></div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn-subscribe">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------------------------------------------------------------------------------------
                              End Subscribe Email 
  -------------------------------------------------------------------------------------------------------------------------->

<!----------------------------------------------------------------------------------------------------------------------- 
                              Unsubscribe Email 
  ----------------------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="unsub" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bgmnone">
            <div class="modal-body mx-3 d-flex justify-content-center" style="padding-left: 0px">
                <div class="col-lg-10 box-unsubscribe">
                    <form id="unsubscribe-form">
                        <input type="hidden" name="type" value="unsub">
                        <div class="sub-tittle">
                            <button type="button" class="closemail" id="btnun" data-dismiss="modal"
                                    aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4>Leave your Email address</h4>
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="email" id="form9" class="input-unsubscribe" placeholder="Email Address"
                                   name="email" required>
                            <label data-error="wrong" data-success="right" for="form9"></label>
                        </div>
                        <div class="error-message" id="form9-error">The Value is Required</div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn-unsubscribe" onclick="unsubscribe()">Unsubscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function unsubscribe(){
        var jikakotakemailkosong = document.getElementById("form9");
        var makatulisanerormuncul = document.getElementById("form9-error");
        var bener = true;

        if (jikakotakemailkosong.value === "") {
            makatulisanerormuncul.style.display = "block";
            jikakotakemailkosong.style.borderColor = "#d80027"
            bener = false;
        } else {
            makatulisanerormuncul.style.display = "hide";
            jikakotakemailkosong.style.borderColor = ""
        }

        if (bener) {
            $('#unsubscribe').modal('show');
            makatulisanerormuncul.style.display = "";
            jikakotakemailkosong.style.borderColor = ""
        }

    }

    function resub() {
        document.getElementById("btnun").click();
        document.getElementById("btn-subs").click();
    }
</script>
<style>	
	.btn-subscribe{
	width: 136px;
    background-color: #424242;
    color: #fff;
    height: 35px;
    border: hidden;
    border-radius: 6px;
    position: absolute;
    bottom: 20px;	
	}
	.btn-subscribe:hover{
	background-color: #858585;
	color: #000000;	
	}
	.btn-unsubscribe{
	width: 136px;
    background-color: #424242;
    color: #fff;
    height: 35px;
    border: hidden;
    border-radius: 6px;
    position: relative;
    top: 60px;
	}
	.btn-unsubscribe:hover{
	background-color: #858585;
	color: #000000;	
	}
	.box-unsubscribe{
    background: #FFFFFF;
    width: 540px;
    height: 231px;
	border-radius: 5px;	
}
    .box-unsubscribe h4 {
        margin-top: 4%;
        margin-bottom: 5%;
        text-align: center;
        font-size: 20px;
        font-weight: 600;
        font-family: inter;
    }
	.input-unsubscribe{
    position: relative;
    display: inline-block;
    width: 494px;
    height: 48px;
    top: 25px;
    left: 0px;
    background: #F4F4F4;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    border-radius: 6px;
    padding-left: 20px;
    border: 1px solid #ced4da;
	}

    .input-unsubscribe.error {
        border: red;
    }

    #form3 {
        margin-top: 3%;
    }

    #form9-error {
        top: 55px;
        position: relative;
        display: none;
    }

    .sub-tittle h4 {
        margin-bottom: 0%;
    }

    .radio-container {
        display: flex;
        flex-direction: column;
        align-items: left;
        text-align: left;
        margin-top: -30px;
    }

    .radio-wrapper {
        display: flex;
        align-items: left;
        justify-content: left;
        padding-left: 27%;
    }

    .radio-container .radio-wrapper .form-check-input {
        margin: 0;
    }

    .radio-container .radio-wrapper .form-check-label {
        margin-left: 5px;
    }

    .radio-container .radio-wrapper .form-check-input[type="radio"] {
        width: 16px;
        height: 16px;
        position: relative;
        top: 2px;
        appearance: none;
        border-radius: 50%;
        border: 2px solid #999;
        outline: none;
        cursor: pointer;
    }

    .radio-container .radio-wrapper .form-check-input[type="radio"]:checked {
        background-color: #999;
    }

    .radio-container .radio-wrapper .form-check-input[type="radio"]:checked::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #fff;
    }

    .radio-container .radio-wrapper .form-check-label {
        font-size: 14px;
        font-weight: 400;
        color: #333;
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
		height: 261px;
	border-radius: 5px;	
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

<!--------------------------------------------------------------------------------------------------------------------
                        End Unsubscribe Email
  ---------------------------------------------------------------------------------------------------------------------->