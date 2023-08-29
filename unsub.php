<div class="modal fade" id="unsubscribe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-right: 0.75rem;
    animation-iteration-count: 1;
    animation-duration: 300ms;">
  <div class="modal-dialog" role="document">
    <div class="modal-content bgmnone">
      <div class="modal-body mx-3 d-flex justify-content-center" style="padding-left: 0px">
        <div class="col-lg-10 boxunsub">
          <div class="notify-tittle align-content-center">
            <button type="button" class="closemail" onclick="tutupunsub()" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            <br>
            <h4>You have successfully unsubscribed!</h4>
            <h6>You have been successfully unsubscribed from email<br>
              communication. If you did this in error, you may<br>
resubscribe by clicking
              the button below</h6>
          </div>
          <div class="d-flex justify-content-center" style="margin-top: 41px;">
            <button class="btnresub" id="btnresub" data-toggle="modal" data-target="#subs" onclick="tutupunsub()">Resubscribe</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
		
	.boxunsub{	
    background: #FFFFFF;
    width: 540px;
    height: 231px;
	border-radius: 5px;	
	}
	.boxunsub h4{
    font-family: 'Mulish';
    font-style: normal;
    font-weight: 600;
    font-size: 24px;
    line-height: 30px;
    text-transform: capitalize;
    color: #000000;
    text-align: center;
    margin-bottom: 20px;
	}
	
	.boxunsub h6{
font-family: 'Mulish';
font-style: normal;
font-weight: 400;
font-size: 18px;
line-height: 23px;
text-align: center;
color: #000000;

	}
	.btnresub{
    width: 136px;
    background-color: #424242;
    color: #fff;
    height: 35px;
    border: hidden;
    border-radius: 7px;
    position: relative;
    top: -20px;
	}	
</style>	
<script>

document.getElementById("btnresub").addEventListener("click", function() {
document.getElementById("btnun").click();
});

</script>
