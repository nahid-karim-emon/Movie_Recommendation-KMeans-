<section id="footer" class="p_3">
  <div class="container-xl">
    <div class="row footer_1">
      <div class="col-md-2">
     <div class="footer_1i">
      <h6 class="text-white fw-bold">LANGUAGE MOVIES</h6>
      <hr class="line mb-4">
      <div class="row footer_1i_small">
      <h6 class="col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">English Movie</a></h6>
      <h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Spanish Movie</a></h6>
      <h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Arabic Movie</a></h6>
      <h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Hindi Movie</a></h6>
      <h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Russian Movie</a></h6>
      <h6 class="mb-0 mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#"> Chinese Movie</a></h6>
      </div>
     </div>
    </div>
    <div class="col-md-4">
     <div class="footer_1i">
      <h6 class="text-white fw-bold">TAG CLOUD</h6>
      <hr class="line mb-4">
      <ul class="mb-0">
       <li class="d-inline-block"><a class="d-block" href="#">Action</a></li>
     <li class="d-inline-block"><a class="d-block" href="#">Adventure</a></li>
     <li class="d-inline-block"><a class="d-block" href="#">Bengali</a></li>
     <li class="d-inline-block"><a class="d-block" href="#">China</a></li>
     <li class="d-inline-block"><a class="d-block" href="#">Drama</a></li>
     <li class="d-inline-block"><a class="d-block" href="#">Music</a></li>
     <li class="d-inline-block"><a class="d-block" href="#">Experiment</a></li>
     <li class="d-inline-block"><a class="d-block" href="#">News</a></li>
     <li class="d-inline-block"><a class="d-block" href="#">Expertize</a></li>
     <li class="d-inline-block"><a class="d-block" href="#">Express</a></li>
     <li class="d-inline-block"><a class="d-block" href="#">Share</a></li>
     <li class="d-inline-block"><a class="d-block" href="#">Sustain</a></li>
     <li class="d-inline-block"><a class="d-block" href="#">Video</a></li>
     <li class="d-inline-block"><a class="d-block" href="#">Youtube</a></li>
      </ul>
     </div>
    </div>
    <div class="col-md-2">
     <div class="footer_1i">
      <h6 class="text-white fw-bold"> Movie Genres </h6>
      <hr class="line mb-4">
      <div class="row footer_1i_small">
      <h6 class="col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Action Movie</a></h6>
      <h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Romantic Movie</a></h6>
      <h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Other Movie</a></h6>
      <h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Comedy Movie</a></h6>
      <h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Drama Movie</a></h6>
      <h6 class="mb-0 mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Classical Movie</a></h6>
      </div>
     
     </div>
    </div>
    <div class="col-md-4">
     <div class="footer_1i">
      <h6 class="text-white fw-bold">SUBSCRIPTION</h6>
      <hr class="line mb-4">
      <p class="text-muted">Subscribe your Email address for latest movies & updates.</p>
      <input class="form-control bg-transparent" placeholder="Enter Email Address" type="text">
      <h6 class="mb-0 mt-4"><a class="button_1 pt-3 pb-3" href="#">Submit <i class="fa fa-check-circle ms-1"></i> </a></h6>
     </div>
    </div>
    </div>
  </div>
 </section>
 
 <section id="footer_b" class="pt-3 pb-3">
  <div class="container-xl">
    <div class="row footer_b1">
    <div class="col-md-8">
     <div class="footer_b1l">
    <p class="mb-0 fs-6 text-muted mt-1">© {{ date('Y') }} @isset($SiteOption) {{ $SiteOption[0]->value }} @endisset. All Rights Reserved | Design by <a class="col_red" href="https://github.com/shahriarabiddut/">Dilruba & Nondita</a></p>
   </div>
    </div>
    <div class="col-md-4">
     <div class="footer_b1r text-end">
     <ul class="social-network social-circle mb-0">
           <li><a href="#" class="icoRss" title="Rss"><i class="fa fa-rss"></i></a></li>
           <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
           <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
           <li><a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
         </ul>
   </div>
    </div>
   </div>
  </div>
 </section>
 
 <script defer>
 window.onscroll = function() {myFunction()};
 
 var navbar_sticky = document.getElementById("navbar_sticky");
 var sticky = navbar_sticky.offsetTop;
 var navbar_height = document.querySelector('.navbar').offsetHeight;
 
 function myFunction() {
   if (window.pageYOffset >= sticky + navbar_height) {
     navbar_sticky.classList.add("sticky")
   document.body.style.paddingTop = navbar_height + 'px';
   } else {
     navbar_sticky.classList.remove("sticky");
   document.body.style.paddingTop = '0'
   }
 }
 </script>
	<script defer src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

 </body>
 
 </html>