@include('includes.header',['page_css'=>'pricing-style.css'])
    
    <nav class="navbar fixed-top bg-white border-bottom shadow-sm">
        <div class="container">
    
            <a class="btn d-md-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
            <svg viewBox="0 0 448 512" width="20px" height="20px"><path d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z"></svg>
            </a>

            <a href="" class="me-auto navbar-brand">
                <img src="{{asset('assets/images/logo-bottom.png')}}" alt="logo" height="35">
            </a>
        
            <div class="dropdown">
                <a class="dropdown-toggle text-primary2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Hello
                </a>
            <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="/my/dashboard">{{auth()->user()->firstname.' '.auth()->user()->lastname}}</a></li>
                @role('Admin')
                    <li><a class="dropdown-item" href="/admin/dashboard">Admin Dashboard</a></li>
                @endrole
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
            </ul>
            </div>

        </div>
    </nav>

    <div class="heading">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 mt-5">
              <h1>Choose a plan</h1>
              <p>Start a free 7 day trial, or get started with our free plan.</p>
            </div>
          </div>
        </div>
    </div>

    <div class="container-fluid">
    <div class="sc">
        <p class="text-end">Above Price are in US$</p>
        <p class="above">Pharma/Biotech <span class="arrow arrow-bottom">(Free Trail)</span> Contact Us</p>
        <div class="table-responsive">
        <table class="table border-0">
            <thead>
                <tr class="heading">
                    <th class="started"></th>
                    @foreach ($plans as $plan)
                    <th><strong>{{$plan->plan_name}}</strong></th>
                    @endforeach
                </tr>
            </thead>
            <tbody>

                <tr class="secound">
                    <th scope="row" class="gts"></th>
                    @foreach ($plans as $plan)
                        <td class="pt-4">
                            @if($plan->plan_slug==='free')
                                <span class="user">${{$plan->actual_price}}/user</span><br>
                                <span class="text">Doctor/Student</span>
                            @else 
                                <span class="text">${{$plan->actual_price}}/user</span><br>
                                <span class="user">
                                    {{$rsPrice=$plan->actual_price*$plan->conversion_rate}}
                                    +
                                    {{$plan->tax.'%'}}
                                </span><br>
                                <span class="text">
                                    Rs.{{round(($rsPrice+($rsPrice*$plan->tax/100)))}}/user
                                </span><br>
                            @endif
                        </td>
                    @endforeach
                </tr>

                <tr class="buy-buttons">
                    <th scope="row"></th>
                    @foreach ($plans as $plan)
                        @if($plan->plan_slug==='free')
                            <td class="right">
                                <form action="/checkout" method="post">
                                    @csrf
                                    <input type="hidden" name="plan" value="{{$plan->plan_slug}}">
                                    <button type="submit"><b>Register free</b></button>
                                </form>
                            </td>
                        @else
                            <td class="right">
                                <form action="/checkout" method="post">
                                    @csrf
                                    <input type="hidden" name="plan" value="{{$plan->plan_slug}}">
                                    <button class="free" type="submit">Buy</button>
                                </form>
                            </td>
                        @endif
                    @endforeach
                </tr>

                <tr class="renova">
                    <th scope="row"><img src="{{asset('assets/images/RE_NOVA.png')}}" alt="" style="width:35%;"></th>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                </tr>

                <tr class="advance">
                    <th scope="row">Advance search</th>
                    <td class="right">30 Searches</td>
                    <td class="right">200 Searches</td>
                    <td class="right">Unlimited</td>
                    
                    <td class="right">Unlimited</td>
                    <td class="right">Unlimited</td>
                </tr>

                <tr>
                    <th scope="row">Analytics </th>
                    <td class="right">30 Searches</td>
                    <td class="right">200 Searches</td>
                    <td class="right">Unlimited</td>
                    <td class="right">Unlimited</td>
                    <td class="right">Unlimited</td>
                </tr>
                <tr class="renova">
                    <th scope="row"><img src="{{asset('assets/images/SO_NOVA.png')}}" alt="" style="width:35%;"></th>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                </tr>
                <tr class="renova">
                    <th scope="row"><img src="{{asset('assets/images/JNL.png')}}" alt="" style="width:15%;"></th>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <th scope="row">Access Paper</th>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></i></td>
                    <td class="right"><i class="fas fa-check"></i></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <th scope="row">Submit paper</th>
                    <td class="right"><i class="fa-regular fa-circle-xmark paint"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                </tr>
                <tr class="renova">
                    <th scope="row"><img src="{{asset('assets/images/STA_NOVA.png')}}" alt="" style="width:35%;"></th>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <th scope="row">Create Study</th>
                    <td class="right"> 1 for 15 days</td>
                    <td class="right"> 1 for 15 days</td>
                    <td class="right">Unlimited</td>
                    <td class="right">Unlimited</td>
                    <td class="right">Unlimited</td>
                </tr>
                <tr>
                    <th scope="row">Multicenter study</th>
                    <td class="right"><i class="fa-regular fa-circle-xmark  paint"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <th scope="row">Monitoring</th>
                    <td class="right"><i class="fa-regular fa-circle-xmark  paint"></i></td>
                    <td class="right"><i class="fa-regular fa-circle-xmark paint"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <th scope="row">Statistics</th>
                    <td class="right"><i class="fa-regular fa-circle-xmark  paint"></i></i></td>
                    <td class="right"><i class="fa-regular fa-circle-xmark  paint"></i></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                    <td class="right"><i class="fas fa-check"></i></td>
                </tr>
                <tr class="footer-1">
                    <td></td>
                    <td class="fw-bold"></td>
                    <td class="fw-bold"></td>
                    <td class="fw-bold"></td>
                    <td class="fw-bold"></td>
                    <td class="fw-bold"></td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    </div>


    <div class="accordion-body">
        <div class="accordion">
            <h1>Frequently Asked Questions</h1>
            <hr>
            <div class="container">
                <div class="label">Can i try QuantiNova for free?</div>
                <div class="content">Yes, Your QuantiNova membership may start with a 7 free trial.</div>
            </div>
            <hr>
            <div class="container">
                <div class="label">When does my free trial End?</div>
                <div class="content">Your QuantiNova membership may start with a free trial. The free trial period of your membership lasts for one week.
                    Whenever you’re ready to buy, hit “Subscribe Now” from within your trial to purchase.           
                </div>
            </div>
            <hr>
            <div class="container">
                <div class="label">What payment options do you accept?</div>
                <div class="content">All payments are processed by a third-party payment processing service. It currently accepts all major credit and debit card networks (Visa, Mastercard, American Express, and RuPay), Netbanking, UPI payments (BHIM, Gpay, PhonePe, WhatsApp, etc.), and Payment wallets (Mobikwik, Freecharge, and Ola Money).</div>
            </div>
            <hr>
            <div class="container">
                <div class="label">What is your refund policy?</div>
                <div class="content">If for any reason, you're not satisfied with your purchase, simply let us know within 7 days and we'll be happy to issue you a refund.
                New users with a fresh subscription can claim a complete refund within seven days of payment.
                When you subscribe to any of the paid subscriptions of QuantiNova, your subscription will auto-renew with each billing cycle. If you do not wish to renew your subscription, make sure you cancel it before the renewal date.
                Transaction charges will be non-refundable. <a href="https://quantinova.ai/refund-policy">Learn More</a>
                </div>
            </div>
            <hr>
        </div>
    </div>
  
    <div class="demo">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2>Schedule A Demo</h2>
                    <p>Come With Us And See How We Can Become Your Companion To Provide You Healthcare Research Data
                        On <br>Your Fingertips With Informative Insights.
                    </p>
                    <div class="d-flex justify-content-center">
                        <button type="button">Click here</button>
                    </div>
                    <span class="support d-flex justify-content-center">Questions? Contact us at   <a href="" class="text-dark ps-2 fw-bold">support@quantinova.ai</a></span>
                </div>
            </div>
        </div>
    </div>
 
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="fot pt-5 pb-5">
                    <div class="footer-logo">
                        <a href=""> <img src="{{asset('assets/images/logo-bottom.png')}}" alt="" title=""></a>
                    </div>
                    <div class="footer-p">
                        <p>A Product of  <b>AI QunatiNova Inc.</b><br>400 Tradecenter Drive, Ste 5900,Woburn MA 01801.<br>Tel :  +13023579981| Email: info@quantinova.ai</p>
                    </div>
                    <div class="footer-2p pt-3">
                        <p>India Partner <b>ADI Biosolution</b><br>E 47 Phase 8 Industrial Area, Mohali Punjab 160071<br>Tel :  +91 97790 25032| Email: info@adibiosolution.com</p>
                    </div>
                    <div class="ancher pt-3">
                        <a href="https://quantinova.ai/terms-and-conditions/" title="">Terms of use |</a>
                        <a href="https://quantinova.ai/privacy-policy" title="">Privacy Policy |</a>
                        <a href="https://quantinova.ai/refund-policy/" title="">Refund policy</a>
                    </div>
                    <hr>
                    <div class="footer-copy">
                        <p>Copyright © 2021. QuantiNova  All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('includes.footer')