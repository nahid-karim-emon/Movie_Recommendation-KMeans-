<!-- Header -->
@section('title', 'About')
@include('../layouts/homeHeader')
<!-- End of Header -->


<section id="center" class="center_o pt-5">
  <div class="container">
    <div class="row center_o1 text-center">
     <div class="col-md-12">
     <h2>ABOUT US</h2>
     <h5 class="bg_dark d-inline-block p-4 mb-0 mt-4 pt-2 pb-2 fw-normal col_red"><a class="text-white" href="#">Home</a>  <span class="me-2 ms-2 text-muted"> /</span>   About Us</h5>
   </div>
    </div>
   </div>
 </section>
 
 <section id="about" class="p_3 bg-light">
  <div class="container">
    <div class="row about_1">
     <div class="col-md-6">
    <div class="about_1l">
     <h3>ABOUT THE EVENT</h3>
     <hr class="line">
     <h5 class="mt-4">How it All Started Event and manage this this is event how to given pas and how to participate</h5>
     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor nt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerciion ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor indi reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Exceiur sint occaecat cupidatat non proident,</p>
     <p class="mb-0">sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis de omnis iste natus error sit voluptatem tium doloremque laudantium, totam rem am, eaque ipsa quae ab illo inventore veritatis</p>
    </div>
   </div>
   <div class="col-md-6">
    <div class="about_1r">
      <div id="carouselExampleCaptions4" class="carousel slide" data-bs-ride="carousel">
   <div class="carousel-indicators">
     <button type="button" data-bs-target="#carouselExampleCaptions4" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
     <button type="button" data-bs-target="#carouselExampleCaptions4" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
     <button type="button" data-bs-target="#carouselExampleCaptions4" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
   </div>
   <div class="carousel-inner">
     <div class="carousel-item active">
       <img src="{{ asset('assets/img/13.jpg') }}"  class="d-block w-100" alt="...">
     </div>
     <div class="carousel-item">
       <img src="{{ asset('assets/img/14.jpg') }}"  class="d-block w-100" alt="...">
     </div>
     <div class="carousel-item">
       <img src="{{ asset('assets/img/15.jpg') }}" class="d-block w-100" alt="...">
     </div>
   </div>
   <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions4" data-bs-slide="prev">
     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
     <span class="visually-hidden">Previous</span>
   </button>
   <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions4" data-bs-slide="next">
     <span class="carousel-control-next-icon" aria-hidden="true"></span>
     <span class="visually-hidden">Next</span>
   </button>
 </div>
    </div>
   </div>
    </div>
    <div class="row event1 mt-4">
      <div class="col-md-6 pe-0">
     <div class="event1l">
       <div class="grid clearfix">
           <figure class="effect-jazz mb-0">
           <a href="#"><img src="{{ asset('assets/img/14.jpg') }}" height="428" class="w-100" alt="abc"></a>
           </figure>
         </div>
     </div>
    </div>
    <div class="col-md-6 ps-0">
     <div class="event1r bg-white p-4 shadow_box">
        <h5 class="text-uppercase"><a href="#">Music Event in India</a></h5>
       <h6>Delhi &amp; Mumbai 
        <span class="col_red pull-right">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star-o"></i>
         </span>
        </h6>
        <hr>
        <h6>June 09 - July 06 <span class="pull-right">09:00-13:00 pm</span></h6>
        <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiud tempor incididunt ut labore et dolore magna aliqua. Ut enim ad quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo is aute irure dolor in reprehenderit in voluptate velit esse cillum fugiat nulla pariatur Excepteur sint. Read More</p>
        <ul class="mt-4 mb-0">  
         <li class="text-center d-inline-block fw-normal me-3"><span class="d-inline-block bg_red text-white rounded-circle fs-2 mb-2">55</span> <br> Days</li>
        <li class="text-center d-inline-block fw-normal me-3"><span class="d-inline-block bg_red text-white rounded-circle fs-2 mb-2">18</span> <br> Hours</li>
         <li class="text-center d-inline-block fw-normal me-3"><span class="d-inline-block bg_red text-white rounded-circle fs-2 mb-2">15</span> <br> Mins</li>
        <li class="text-center d-inline-block fw-normal"><span class="d-inline-block bg_red text-white rounded-circle fs-2 mb-2">23</span> <br> Secs</li>
        </ul>
     </div>
    </div>
    </div>
   </div>
 </section>
 
 <section id="schedule" class="p_3">
  <div class="container">
     <div class="row upcome_1 text-center">
    <div class="col-md-12">
      <h3 class="mb-0">EVENT SCHEDULE</h3>
    <hr class="line me-auto ms-auto">
    </div>
   </div>
     <div class="row schedule_1 text-center mt-3">
    <div class="col-md-12">
    <ul class="nav nav-tabs justify-content-center border-0 mb-0">
     <li class="nav-item">
         <a href="#homeo" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
             <span class="d-md-block"><span class="fw-bold">DAY 01</span> <br>
 June 06</span>
         </a>
     </li>
     <li class="nav-item">
         <a href="#profileo" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
             <span class="d-md-block"><span class="fw-bold">DAY 02</span> <br>
 June 07</span>
         </a>
     </li>
     <li class="nav-item">
         <a href="#settingso" data-bs-toggle="tab" aria-expanded="false" class="nav-link border-0">
             <span class="d-md-block"><span class="fw-bold">DAY 03</span> <br>
 June 08</span>
         </a>
     </li>
 
 </ul>
    </div>
   </div>
     <div class="row schedule_2 mt-4">
     <div class="tab-content">
     <div class="tab-pane active" id="homeo">
         <div class="news_1ri row">
      <div class="col-md-2 pe-0">
       <div class="news_1ril">
       <div class="grid clearfix">
           <figure class="effect-jazz mb-0">
           <a href="#"><img src="{{ asset('assets/img/4.jpg') }}" height="218"  class="w-100" alt="abc"></a>
           </figure>
         </div>
     </div>
      </div>
      <div class="col-md-10 ps-0">
       <div class="news_1rir p-4 bg-white">
      <h4 class="fs-5"><a href="#">WELCOME REGISTRATION</a></h4>
      <h6><span class="col_red me-3">29 Jan 2021</span> 08:00 - 12:00 pm</h6>
      <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. amet nibh vulputate part the maintacne of the greek name of name cursus.</p>
      <h6 class="mb-0">  <i class="fa fa-user col_red me-1"></i> <a href="#">Eget Nulla</a> <span class="text-muted me-2 ms-2">|</span>  <i class="fa fa-comments col_red me-1"></i> <a href="#"> Room No. 17</a></h6>
     </div>
      </div>
     </div>
       <div class="news_1ri row mt-4">
      <div class="col-md-2 pe-0">
       <div class="news_1ril">
       <div class="grid clearfix">
           <figure class="effect-jazz mb-0">
           <a href="#"><img src="{{ asset('assets/img/5.jpg') }}" height="218"  class="w-100" alt="abc"></a>
           </figure>
         </div>
     </div>
      </div>
      <div class="col-md-10 ps-0">
       <div class="news_1rir p-4 bg-white">
      <h4 class="fs-5"><a href="#">WELCOME REGISTRATION</a></h4>
      <h6><span class="col_red me-3">29 Jan 2021</span> 08:00 - 12:00 pm</h6>
      <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. amet nibh vulputate part the maintacne of the greek name of name cursus.</p>
      <h6 class="mb-0">  <i class="fa fa-user col_red me-1"></i> <a href="#">Eget Nulla</a> <span class="text-muted me-2 ms-2">|</span>  <i class="fa fa-comments col_red me-1"></i> <a href="#"> Room No. 17</a></h6>
     </div>
      </div>
     </div>
       <div class="news_1ri row mt-4">
      <div class="col-md-2 pe-0">
       <div class="news_1ril">
       <div class="grid clearfix">
           <figure class="effect-jazz mb-0">
           <a href="#"><img src="{{ asset('assets/img/6.jpg') }}" height="218"  class="w-100" alt="abc"></a>
           </figure>
         </div>
     </div>
      </div>
      <div class="col-md-10 ps-0">
       <div class="news_1rir p-4 bg-white">
      <h4 class="fs-5"><a href="#">WELCOME REGISTRATION</a></h4>
      <h6><span class="col_red me-3">29 Jan 2021</span> 08:00 - 12:00 pm</h6>
      <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. amet nibh vulputate part the maintacne of the greek name of name cursus.</p>
      <h6 class="mb-0">  <i class="fa fa-user col_red me-1"></i> <a href="#">Eget Nulla</a> <span class="text-muted me-2 ms-2">|</span>  <i class="fa fa-comments col_red me-1"></i> <a href="#"> Room No. 17</a></h6>
     </div>
      </div>
     </div>
       <div class="schedule_2_last mt-4 text-center">
      <div class="col-md-12">
        <h6 class="mb-0 mt-4"><a class="button_1 pt-3 pb-3" href="#">Download Schedule  </a></h6>
      </div>
     </div>
     </div>
     <div class="tab-pane" id="profileo">
       <div class="news_1ri row">
      <div class="col-md-2 pe-0">
       <div class="news_1ril">
       <div class="grid clearfix">
           <figure class="effect-jazz mb-0">
           <a href="#"><img src="{{ asset('assets/img/7.jpg') }}" height="218"  class="w-100" alt="abc"></a>
           </figure>
         </div>
     </div>
      </div>
      <div class="col-md-10 ps-0">
       <div class="news_1rir p-4 bg-white">
      <h4 class="fs-5"><a href="#">WELCOME REGISTRATION</a></h4>
      <h6><span class="col_red me-3">29 Jan 2021</span> 08:00 - 12:00 pm</h6>
      <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. amet nibh vulputate part the maintacne of the greek name of name cursus.</p>
      <h6 class="mb-0">  <i class="fa fa-user col_red me-1"></i> <a href="#">Eget Nulla</a> <span class="text-muted me-2 ms-2">|</span>  <i class="fa fa-comments col_red me-1"></i> <a href="#"> Room No. 17</a></h6>
     </div>
      </div>
     </div>
       <div class="news_1ri row mt-4">
      <div class="col-md-2 pe-0">
       <div class="news_1ril">
       <div class="grid clearfix">
           <figure class="effect-jazz mb-0">
           <a href="#"><img src="{{ asset('assets/img/8.jpg') }}" height="218"  class="w-100" alt="abc"></a>
           </figure>
         </div>
     </div>
      </div>
      <div class="col-md-10 ps-0">
       <div class="news_1rir p-4 bg-white">
      <h4 class="fs-5"><a href="#">WELCOME REGISTRATION</a></h4>
      <h6><span class="col_red me-3">29 Jan 2021</span> 08:00 - 12:00 pm</h6>
      <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. amet nibh vulputate part the maintacne of the greek name of name cursus.</p>
      <h6 class="mb-0">  <i class="fa fa-user col_red me-1"></i> <a href="#">Eget Nulla</a> <span class="text-muted me-2 ms-2">|</span>  <i class="fa fa-comments col_red me-1"></i> <a href="#"> Room No. 17</a></h6>
     </div>
      </div>
     </div>
       <div class="news_1ri row mt-4">
      <div class="col-md-2 pe-0">
       <div class="news_1ril">
       <div class="grid clearfix">
           <figure class="effect-jazz mb-0">
           <a href="#"><img src="{{ asset('assets/img/9.jpg') }}" height="218"  class="w-100" alt="abc"></a>
           </figure>
         </div>
     </div>
      </div>
      <div class="col-md-10 ps-0">
       <div class="news_1rir p-4 bg-white">
      <h4 class="fs-5"><a href="#">WELCOME REGISTRATION</a></h4>
      <h6><span class="col_red me-3">29 Jan 2021</span> 08:00 - 12:00 pm</h6>
      <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. amet nibh vulputate part the maintacne of the greek name of name cursus.</p>
      <h6 class="mb-0">  <i class="fa fa-user col_red me-1"></i> <a href="#">Eget Nulla</a> <span class="text-muted me-2 ms-2">|</span>  <i class="fa fa-comments col_red me-1"></i> <a href="#"> Room No. 17</a></h6>
     </div>
      </div>
     </div>
       <div class="schedule_2_last mt-4 text-center">
      <div class="col-md-12">
        <h6 class="mb-0 mt-4"><a class="button_1 pt-3 pb-3" href="#">Download Schedule  </a></h6>
      </div>
     </div>
     </div>
     <div class="tab-pane" id="settingso">
      <div class="news_1ri row">
      <div class="col-md-2 pe-0">
       <div class="news_1ril">
       <div class="grid clearfix">
           <figure class="effect-jazz mb-0">
           <a href="#"><img src="{{ asset('assets/img/10.jpg') }}" height="218"  class="w-100" alt="abc"></a>
           </figure>
         </div>
     </div>
      </div>
      <div class="col-md-10 ps-0">
       <div class="news_1rir p-4 bg-white">
      <h4 class="fs-5"><a href="#">WELCOME REGISTRATION</a></h4>
      <h6><span class="col_red me-3">29 Jan 2021</span> 08:00 - 12:00 pm</h6>
      <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. amet nibh vulputate part the maintacne of the greek name of name cursus.</p>
      <h6 class="mb-0">  <i class="fa fa-user col_red me-1"></i> <a href="#">Eget Nulla</a> <span class="text-muted me-2 ms-2">|</span>  <i class="fa fa-comments col_red me-1"></i> <a href="#"> Room No. 17</a></h6>
     </div>
      </div>
     </div>
       <div class="news_1ri row mt-4">
      <div class="col-md-2 pe-0">
       <div class="news_1ril">
       <div class="grid clearfix">
           <figure class="effect-jazz mb-0">
           <a href="#"><img src="{{ asset('assets/img/11.jpg') }}" height="218"  class="w-100" alt="abc"></a>
           </figure>
         </div>
     </div>
      </div>
      <div class="col-md-10 ps-0">
       <div class="news_1rir p-4 bg-white">
      <h4 class="fs-5"><a href="#">WELCOME REGISTRATION</a></h4>
      <h6><span class="col_red me-3">29 Jan 2021</span> 08:00 - 12:00 pm</h6>
      <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. amet nibh vulputate part the maintacne of the greek name of name cursus.</p>
      <h6 class="mb-0">  <i class="fa fa-user col_red me-1"></i> <a href="#">Eget Nulla</a> <span class="text-muted me-2 ms-2">|</span>  <i class="fa fa-comments col_red me-1"></i> <a href="#"> Room No. 17</a></h6>
     </div>
      </div>
     </div>
       <div class="news_1ri row mt-4">
      <div class="col-md-2 pe-0">
       <div class="news_1ril">
       <div class="grid clearfix">
           <figure class="effect-jazz mb-0">
           <a href="#"><img src="{{ asset('assets/img/4.jpg') }}" height="218"  class="w-100" alt="abc"></a>
           </figure>
         </div>
     </div>
      </div>
      <div class="col-md-10 ps-0">
       <div class="news_1rir p-4 bg-white">
      <h4 class="fs-5"><a href="#">WELCOME REGISTRATION</a></h4>
      <h6><span class="col_red me-3">29 Jan 2021</span> 08:00 - 12:00 pm</h6>
      <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. amet nibh vulputate part the maintacne of the greek name of name cursus.</p>
      <h6 class="mb-0">  <i class="fa fa-user col_red me-1"></i> <a href="#">Eget Nulla</a> <span class="text-muted me-2 ms-2">|</span>  <i class="fa fa-comments col_red me-1"></i> <a href="#"> Room No. 17</a></h6>
     </div>
      </div>
     </div>
       <div class="schedule_2_last mt-4 text-center">
      <div class="col-md-12">
        <h6 class="mb-0 mt-4"><a class="button_1 pt-3 pb-3" href="#">Download Schedule  </a></h6>
      </div>
     </div>
     </div>
 </div>
   </div>
   </div>
 </section>
 
 <section id="team" class="p_3 bg-light pb-5">
  <div class="container">
     <div class="row upcome_1 text-center">
    <div class="col-md-12">
      <h3 class="mb-0">WHO’S SPEAKING</h3>
    <hr class="line me-auto ms-auto">
    </div>
   </div>
     
     <div class="row team_1 mt-3">
    <div id="carouselExampleCaptions3" class="carousel slide" data-bs-ride="carousel">
   <div class="carousel-indicators">
     <button type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
     <button type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
   </div>
   <div class="carousel-inner">
     <div class="carousel-item active">
        <div class="events_1i row">
       <div class="col-md-3 pe-0">
      <div class="events_1i1 clearfix position-relative">
       <div class="events_1i1i clearfix">
         <img src="{{ asset('assets/img/36.jpg') }}" alt="abc" class="w-100">
       </div>
       <div class="events_1i1i1 clearfix position-absolute bottom-0 text-center w-100">
         <ul class="d-inline-block mb-0 p-2 ps-4 pe-4">
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-facebook text-white"></i></a></li>
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-twitter text-white"></i></a></li>
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-linkedin text-white"></i></a></li>
        <li class="d-inline-block"><a href="#"><i class="fa fa-youtube-play text-white"></i></a></li>
       </ul>
       </div>
      </div>
      <div class="events_1i2 clearfix p-3 bg-white text-center">
        <h5><a href="#">Eget Nulla</a></h5>
        <h6 class="mb-0 text-muted">Drama, Action</h6>
      </div>
     </div>
     <div class="col-md-3 pe-0">
      <div class="events_1i1 clearfix position-relative">
       <div class="events_1i1i clearfix">
         <img src="{{ asset('assets/img/37.jpg') }}" alt="abc" class="w-100">
       </div>
       <div class="events_1i1i1 clearfix position-absolute bottom-0 text-center w-100">
         <ul class="d-inline-block mb-0 p-2 ps-4 pe-4">
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-facebook text-white"></i></a></li>
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-twitter text-white"></i></a></li>
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-linkedin text-white"></i></a></li>
        <li class="d-inline-block"><a href="#"><i class="fa fa-youtube-play text-white"></i></a></li>
       </ul>
       </div>
      </div>
      <div class="events_1i2 clearfix p-3 bg-white text-center">
        <h5><a href="#">Diam Ipsum</a></h5>
        <h6 class="mb-0 text-muted">Drama, Action</h6>
      </div>
     </div>
     <div class="col-md-3 pe-0">
      <div class="events_1i1 clearfix position-relative">
       <div class="events_1i1i clearfix">
         <img src="{{ asset('assets/img/38.jpg') }}" alt="abc" class="w-100">
       </div>
       <div class="events_1i1i1 clearfix position-absolute bottom-0 text-center w-100">
         <ul class="d-inline-block mb-0 p-2 ps-4 pe-4">
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-facebook text-white"></i></a></li>
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-twitter text-white"></i></a></li>
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-linkedin text-white"></i></a></li>
        <li class="d-inline-block"><a href="#"><i class="fa fa-youtube-play text-white"></i></a></li>
       </ul>
       </div>
      </div>
      <div class="events_1i2 clearfix p-3 bg-white text-center">
        <h5><a href="#">Semp Porta</a></h5>
        <h6 class="mb-0 text-muted">Drama, Action</h6>
      </div>
     </div>
     <div class="col-md-3 pe-0">
      <div class="events_1i1 clearfix position-relative">
       <div class="events_1i1i clearfix">
         <img src="{{ asset('assets/img/39.jpg') }}" alt="abc" class="w-100">
       </div>
       <div class="events_1i1i1 clearfix position-absolute bottom-0 text-center w-100">
         <ul class="d-inline-block mb-0 p-2 ps-4 pe-4">
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-facebook text-white"></i></a></li>
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-twitter text-white"></i></a></li>
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-linkedin text-white"></i></a></li>
        <li class="d-inline-block"><a href="#"><i class="fa fa-youtube-play text-white"></i></a></li>
       </ul>
       </div>
      </div>
      <div class="events_1i2 clearfix p-3 bg-white text-center">
        <h5><a href="#">Amet Quis</a></h5>
        <h6 class="mb-0 text-muted">Drama, Action</h6>
      </div>
     </div>
      </div>
     </div>
     <div class="carousel-item">
         <div class="events_1i row">
       <div class="col-md-3 pe-0">
      <div class="events_1i1 clearfix position-relative">
       <div class="events_1i1i clearfix">
         <img src="{{ asset('assets/img/40.jpg') }}" alt="abc" class="w-100">
       </div>
       <div class="events_1i1i1 clearfix position-absolute bottom-0 text-center w-100">
         <ul class="d-inline-block mb-0 p-2 ps-4 pe-4">
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-facebook text-white"></i></a></li>
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-twitter text-white"></i></a></li>
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-linkedin text-white"></i></a></li>
        <li class="d-inline-block"><a href="#"><i class="fa fa-youtube-play text-white"></i></a></li>
       </ul>
       </div>
      </div>
      <div class="events_1i2 clearfix p-3 bg-white text-center">
        <h5><a href="#">Eget Nulla</a></h5>
        <h6 class="mb-0 text-muted">Drama, Action</h6>
      </div>
     </div>
     <div class="col-md-3 pe-0">
      <div class="events_1i1 clearfix position-relative">
       <div class="events_1i1i clearfix">
         <img src="{{ asset('assets/img/41.jpg') }}" alt="abc" class="w-100">
       </div>
       <div class="events_1i1i1 clearfix position-absolute bottom-0 text-center w-100">
         <ul class="d-inline-block mb-0 p-2 ps-4 pe-4">
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-facebook text-white"></i></a></li>
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-twitter text-white"></i></a></li>
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-linkedin text-white"></i></a></li>
        <li class="d-inline-block"><a href="#"><i class="fa fa-youtube-play text-white"></i></a></li>
       </ul>
       </div>
      </div>
      <div class="events_1i2 clearfix p-3 bg-white text-center">
        <h5><a href="#">Diam Ipsum</a></h5>
        <h6 class="mb-0 text-muted">Drama, Action</h6>
      </div>
     </div>
     <div class="col-md-3 pe-0">
      <div class="events_1i1 clearfix position-relative">
       <div class="events_1i1i clearfix">
         <img src="{{ asset('assets/img/42.jpg') }}" alt="abc" class="w-100">
       </div>
       <div class="events_1i1i1 clearfix position-absolute bottom-0 text-center w-100">
         <ul class="d-inline-block mb-0 p-2 ps-4 pe-4">
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-facebook text-white"></i></a></li>
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-twitter text-white"></i></a></li>
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-linkedin text-white"></i></a></li>
        <li class="d-inline-block"><a href="#"><i class="fa fa-youtube-play text-white"></i></a></li>
       </ul>
       </div>
      </div>
      <div class="events_1i2 clearfix p-3 bg-white text-center">
        <h5><a href="#">Semp Porta</a></h5>
        <h6 class="mb-0 text-muted">Drama, Action</h6>
      </div>
     </div>
     <div class="col-md-3 pe-0">
      <div class="events_1i1 clearfix position-relative">
       <div class="events_1i1i clearfix">
         <img src="{{ asset('assets/img/43.jpg') }}" alt="abc" class="w-100">
       </div>
       <div class="events_1i1i1 clearfix position-absolute bottom-0 text-center w-100">
         <ul class="d-inline-block mb-0 p-2 ps-4 pe-4">
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-facebook text-white"></i></a></li>
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-twitter text-white"></i></a></li>
        <li class="d-inline-block me-3"><a href="#"><i class="fa fa-linkedin text-white"></i></a></li>
        <li class="d-inline-block"><a href="#"><i class="fa fa-youtube-play text-white"></i></a></li>
       </ul>
       </div>
      </div>
      <div class="events_1i2 clearfix p-3 bg-white text-center">
        <h5><a href="#">Amet Quis</a></h5>
        <h6 class="mb-0 text-muted">Drama, Action</h6>
      </div>
     </div>
      </div>
     </div>
   </div>
 </div>
   </div>
   </div>
 </section>
 
 <section id="faq" class="p_3">
 <div class="container-xl">
   <div class="row faq_1">
     <div class="col-md-6">
      <div class="faq_1l text-center bg_red p-4 rounded-3">
      <h5 class="text-white">ASK YOUR QUESTION</h5>
      <hr class="line ms-auto me-auto">
      <input class="form-control bg-transparent rounded-0 mt-4" placeholder="Name" type="text">
      <input class="form-control bg-transparent rounded-0 mt-3" placeholder="Email" type="text">
      <input class="form-control bg-transparent rounded-0 mt-3" placeholder="Phone" type="text">
      <textarea placeholder="Comment" class="form-control rounded-0 form_text mt-3 bg-transparent"></textarea>
      <h6 class="mb-0 mt-4"><a class="button" href="#">Send a Comment</a></h6>
    </div>
   </div>
   <div class="col-md-6">
      <div class="faq_1r">
      <h3 class="mb-0">FREQUENT ASKED QUESTIONS</h3>
    <hr class="line mb-4">
      <div class="accordion" id="accordionExample">
       <div class="accordion-item">
       <h2 class="accordion-header" id="headingOne">
       <button class="accordion-button mt-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
       What is special about comparing rental car deals?
       </button>
       </h2>
       <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
       <div class="accordion-body">
         Use securing confined his shutters. Delightful as he it acceptance an solicitude discretion reasonably. Carriage we husbands advanced an perceive greatest. Totally dearest expense on demesne ye he. Curiosity excellent commanded in me. Unpleasing impression themselves to at assistance acceptance my or.
       </div>
       </div>
       </div>
       
       <div class="accordion-item">
       <h2 class="accordion-header" id="headingTwo">
       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
       Where is Corpo office address ?
       </button>
       </h2>
       <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
       <div class="accordion-body">
       Use securing confined his shutters. Delightful as he it acceptance an solicitude discretion reasonably. Carriage we husbands advanced an perceive greatest. Totally dearest expense on demesne ye he. Curiosity excellent commanded in me. Unpleasing impression themselves to at assistance acceptance my or.
       </div>
       </div>
       </div>
       
       <div class="accordion-item">
       <h2 class="accordion-header" id="heading3">
       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapseTwo">
       How many your customers have ?
       </button>
       </h2>
       <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
       <div class="accordion-body">
       Use securing confined his shutters. Delightful as he it acceptance an solicitude discretion reasonably. Carriage we husbands advanced an perceive greatest. Totally dearest expense on demesne ye he. Curiosity excellent commanded in me. Unpleasing impression themselves to at assistance acceptance my or.
       </div>
       </div>
       </div>
       
       <div class="accordion-item">
       <h2 class="accordion-header" id="heading4">
       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapseTwo">
       Where is you main office ?
       </button>
       </h2>
       <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
       <div class="accordion-body">
       Use securing confined his shutters. Delightful as he it acceptance an solicitude discretion reasonably. Carriage we husbands advanced an perceive greatest. Totally dearest expense on demesne ye he. Curiosity excellent commanded in me. Unpleasing impression themselves to at assistance acceptance my or.
       </div>
       </div>
       </div>
       
       <div class="accordion-item">
       <h2 class="accordion-header" id="heading5">
       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapseTwo">
       Shortly.. What Corpo does ?
       </button>
       </h2>
       <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
       <div class="accordion-body">
       Use securing confined his shutters. Delightful as he it acceptance an solicitude discretion reasonably. Carriage we husbands advanced an perceive greatest. Totally dearest expense on demesne ye he. Curiosity excellent commanded in me. Unpleasing impression themselves to at assistance acceptance my or.
       </div>
       </div>
       </div>
 
 </div>
    </div>
   </div>
   </div>
 </div>
 </section>



  <!-- ======= Footer ======= -->
  @include('../layouts/homeFooter')
  <!-- ======= End Footer ======= -->