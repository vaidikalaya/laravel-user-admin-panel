@include('includes.header')

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="recived">
        <div class="acadmic">
          <div class="card mb-3">
              <div class="card-body">
              </div>
          </div>
        </div>
        <div class="student">
          <div class="col d-flex justify-content-center">
              <div class="card ">
                  <div class="d-flex justify-content-center pt-3">
                      <img src="{{asset('assets/images/quantinova-standard1920.png')}}" class="card-img-top" alt="...">
                  </div>
                  <hr>
                  <div class="card-body">
                      <h5 class="card-title text-center">{{$plan->plan_name}}</h5>
                      <h2 class="text-center">₹{{$paybleAmount}}/yr</h2>
                      <p class="text-center">${{$plan->paid_price}}/user</p>
                      <h3 class="text-center">₹{{$plan->paid_price*$plan->conversion_rate}} + 18% GST</h3>
                      <div class="chech d-flex justify-content-center">
                        <form name='razorpayform' action="{{route('payment-process')}}" method="POST">
                          @csrf
                          <input type="hidden" name="razorpay_response" id="razorpay_response">
                          <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                          <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
                          <input type="hidden" name="razorpay_order_id"  id="razorpay_order_id" >
                          <input type="hidden" name="planId" value="{{$plan->id}}">
                          <button id="rzp-button1" type="button">CHECKOUT</button>
                        </form> 
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

var options = @json($jsonData);

options.handler = function (response){
    document.getElementById('razorpay_response').value = response.razorpay_response;
    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
    document.getElementById('razorpay_signature').value = response.razorpay_signature;
    document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
    document.razorpayform.submit();
};

var rzp = new Razorpay(options); 

document.getElementById('rzp-button1').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>
@include('includes.footer')

<style>
  .acadmic .card-body {
      padding: 190px;

  }

  .acadmic .card {
      box-shadow: 0px 10px 10px -5px rgba(0, 0, 0, 0.5);
      margin-top: 408px;
      border-radius: 8px 8px 82px 82px;
      background: #0e9fd6;
  }

  .recived {
      position: relative;
  }

  .student {
      position: absolute;
      top: -71%;
      width: 80%;
      left: 10%;
  }

  .student .card {
      border-radius: 30px;
      box-shadow: 0 0 20px 1px #0e9fd6;
  }

  .chech.d-flex.justify-content-center button {
      box-shadow: 0px 10px 10px -5px rgb(0 0 0 / 50%);
      border: none;
      background: #0e9fd6;
      padding: 11px 116px;
      color: #fff;
      border-radius: 32px;
      font-size: 20px;
      font-weight: 800;
      font-family: revert;
  }

  .card-body h5 {
      text-shadow: 0px 0px 2px;
      font-family: system-ui;
      font-size: 35px;
      font-weight: 900;
      color: #0e9fd6;
  }

  .card-body h2 {
      font-weight: 800;
      padding: 15px 0px;
      font-size: 40px;
      color: #204475;
  }

  .card-body h3 {
      padding-bottom: 30px;
      font-size: 30px;
      font-weight: 800;
      color: #204475;
  }

  .student .card-body {
      padding: 37px 0px;
  }

  nav.navbar.navbar-expand-lg.navbar-light {
      box-shadow: 0 0 3px;
      background: #20447536;
  }

  .card-body p {
      font-weight: 900;
      font-size: 24px;
      color: #f47f43;
  }

  .student img {
      width: 40%;
  }

  ul.navbar-nav.ms-auto.mb-2.mb-lg-0 img {
      width: 50%;
  }

  /* --------MEDIA QUERY START HERE-------- */
  @media all and (min-width:320px) and (max-width:480px) {
      .chech.d-flex.justify-content-center button {
          padding: 11px 49px;
          font-size: 13px;
      }

      .acadmic .card-body {
          padding: 104px;
      }

      .card-body h5 {
          font-size: 22px;
      }

      .card-body h2 {
          padding: 1px 0px;
          font-size: 25px;
      }

      .card-body p {
          font-size: 18px;
      }

      .card-body h3 {
          padding-bottom: 13px;
          font-size: 22px;
      }

      .acadmic .card {
          margin-top: 217px;
          border-radius: 8px 8px 46px 46px;
      }

      .student img {
          width: 57%;
      }

      .student .card-body {
          padding: 14px 0px;
      }

      ul.navbar-nav.ms-auto.mb-2.mb-lg-0 img {
          width: 7%;
      }
  }
</style>