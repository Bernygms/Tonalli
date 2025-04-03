<?php  include("templates/menu.php"); ?>


<!--=================================
page-title-->

<section class="page-title bg-overlay-black-60 parallax" data-jarallax='{"speed": 0.6}' style="background-image: url(images/bg/slide64.jpg);">
  <div class="container">
    <div class="row"> 
      <div class="col-lg-12"> 
        <div class="page-title-name">
          <h1>Contact</h1>
          <p>We know the secret of your success</p>
        </div>
        <ul class="page-breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
          <li><span>Contact</span> </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!--=================================
page-title -->

<!--=================================
page-title -->

<section class="page-section-pt">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title line center text-center">
          <h6 class="subtitle">We're Good At </h6>
          <h2 class="title">Get In Touch With Us</h2>
        </div>
      </div>
    </div>
    <div class="row theme-bg top-info">
      <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="feature-text">
          <div class="feature-icon">
            <span class="ti-direction-alt"></span>
          </div>
          <div class="feature-info">
            <h5 class="text-back">17504 Carlton Cuevas Rd,</h5>
            <p class="mb-0">Gulfport, MS, 39503</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="feature-text">
          <div class="feature-icon">
            <span class="ti-headphone-alt"></span>
          </div>
          <div class="feature-info">
            <h5 class="text-back">+(704) 279-1249</h5>
            <p class="mb-0">Mon-Fri 8:30am-6:30pm</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="feature-text">
          <div class="feature-icon">
            <span class="ti-email"></span>
          </div>
          <div class="feature-info">
            <h5 class="text-back">letstalk@webster.com</h5>
            <p class="mb-0">24 X 7 online support</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--=================================
page-title -->

<section class="page-section-pt white-bg contact-3 o-hidden clearfix">
  <div class="container-fluid pos-r">
    <div class="row  full-height">
      <div class="col-lg-6 map-side g-map" id="map" data-type='black'>
        <div class="contact-map">
        </div>       
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row justify-content-end">
      <div class="col-lg-5"> 
        <div class="contact-3-info page-section-ptb">
          <div class="clearfix">
            <div class="section-title mb-0"> 
              <h6>let's work together</h6>
              <h2 class="title-effect">Contact Us</h2>
            </div>
            <p class="mb-50">It would be great to hear from you! If you got any questions, please do not hesitate to send us a message. We are looking forward to hearing from you! We reply within <span class="tooltip-content" data-original-title="Mon-Fri 10am–7pm (GMT +1)" data-toggle="tooltip" data-placement="top"> 24 hours!</span></p>
            <div id="formmessage">Success/Error Message Goes Here</div>
            <form id="contactform" role="form" method="post" action="php/contact-form.php">
              <div class="contact-form clearfix">
                <div class="section-field">
                  <input id="name" type="text" placeholder="Name*" class="form-control"  name="name">
                </div> 
                <div class="section-field">
                  <input type="email" placeholder="Email*" class="form-control" name="email">
                </div>
                <div class="section-field">
                  <input type="text" placeholder="Phone*" class="form-control" name="phone">
                </div>
                <div class="section-field textarea">
                  <textarea class="input-message form-control" placeholder="Comment*"  rows="7" name="message"></textarea>
                </div>
                  <!-- Google reCaptch-->
                <div class="g-recaptcha section-field clearfix" data-sitekey="[Add your site key]"></div>
                <div class="section-field submit-button">
                  <input type="hidden" name="action" value="sendEmail"/>
                  <button id="submit" name="submit" type="submit" value="Send" class="button"><span> Send message </span> <i class="fa fa-paper-plane"></i></button>
                </div>
              </div> 
            </form>
            <div id="ajaxloader" style="display:none"><img class="mx-auto mt-30 mb-30 d-block" src="../../images/pre-loader/loader-02.svg" alt=""></div>
          </div>          
        </div>
      </div>
    </div>
  </div>
</section>
  
<?php  include("templates/footer.php"); ?>