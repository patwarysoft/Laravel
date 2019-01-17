<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>Bootstrap E-commerce Templates</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
      <!-- bootstrap -->
      <link href="{{asset('public/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('public/bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
      <link href="{{asset('public/themes/css/bootstrappage.css')}}" rel="stylesheet">
      <link href="{{asset('public/themes/css/flexslider.css')}}" rel="stylesheet">
      <link href="{{asset('public/themes/css/main.css')}}" rel="stylesheet">

      <script src="{{asset('public/themes/js/jquery-1.7.2.min.js')}}"></script>
      <script src="{{asset('public/bootstrap/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('public/themes/js/superfish.js')}}"></script>
      <script src="{{asset('public/themes/js/jquery.scrolltotop.js')}}"></script>
      <script src='https://www.google.com/recaptcha/api.js'></script>
      @if(isset($tinymce))
      
<script type="text/javascript" src="https://tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script type="text/javascript">

   tinymce.init({
      selector: "textarea",
      theme: "modern",
      setup: function (editor) {
         editor.on('change', function () {
            editor.save();
         });
      },
      plugins: [
         "advlist autolink lists link image charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars code fullscreen",
         "insertdatetime media nonbreaking save table contextmenu directionality",
         "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
      toolbar2: "print preview media | forecolor backcolor emoticons",
      image_advtab: true,
      templates: [
         {title: 'Test template 1', content: 'Test 1'},
         {title: 'Test template 2', content: 'Test 2'}
      ],
      image_title: true,
      convert_urls: false,
      content_css: ""
   });

</script>
      @endif
   </head>
   <body>
      <div id="top-bar" class="container">
         <div class="row">
            <div class="span4">
               <form method="POST" class="search_form">
                  <input type="text" class="input-block-level search-query" Placeholder="eg. T-sirt">
               </form>
            </div>
            <div class="span8">
               <div class="account pull-right">
                  <ul class="user-menu">
                     <li><a href="cart.html">Your Cart</a></li>
                     <li><a href="{{url('/checkout')}}">Checkout</a></li>
                     @guest
                     <li><a href="{{url('/login')}}">Login</a></li>
                     <li><a href="{{url('/register')}}">Register</a></li>
                     @else
                     <li><a href="{{url('/profile')}}">{{ Auth::user()->email }}</a></li>
                     <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
   document.getElementById('logout-form').submit();">
                           Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           {{ csrf_field() }}
                        </form>
                     </li>
                     @endguest
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <div id="wrapper" class="container">
         <section class="navbar main-menu">
            <div class="navbar-inner main-menu">
               <a href="{{url('/')}}" class="logo pull-left"><img src="{{asset('public/themes/images/logo.png')}}" class="site_logo" alt=""></a>
               <nav id="menu" class="pull-right">
                  <ul>
                     @if(isset(Auth::user()->type) && Auth::user()->type > 1)
                     <li><a href="#">Management</a>
                        <ul>
                           <li><a href="{{url('/product-management')}}">Products</a></li>
                           <li><a href="{{url('/category-management')}}">Category</a></li>
                           <li><a href="{{url('/subcategory-management')}}">Sub Category</a></li>
                           <li><a href="{{url('/city-management')}}">City</a></li>
                        </ul>
                     </li>
                     @endif
                     @if(isset($allData))
                     @foreach($allData[0] as $cat)
                     <li><a href="{{url('/')}}/{{Replace($cat->name)}}/{{$cat->id}}">{{$cat->name}}</a>
                        <ul>
                           @foreach($allData[1] as $scat)
                           <li><a href="{{url('/')}}/{{Replace($cat->name)}}//{{Replace($scat->name)}}/{{$scat->id}}">{{$scat->name}}</a>
                           @endforeach
                        </ul>
                     </li>
                     @endforeach
                     @endif
                  </ul>
               </nav>
            </div>
         </section>
         @yield("content")
         <section id="footer-bar">
            <div class="row">
               <div class="span3">
                  <h4>Navigation</h4>
                  <ul class="nav">
                     <li><a href="{{url('/')}}">Homepage</a></li>
                     <li><a href="./about.html">About Us</a></li>
                     <li><a href="./contact.html">Contac Us</a></li>
                     <li><a href="./cart.html">Your Cart</a></li>
                     <li><a href="{{url('/login')}}">Login</a></li>
                  </ul>
               </div>
               <div class="span4">
                  <h4>My Account</h4>
                  <ul class="nav">
                     <li><a href="#">My Account</a></li>
                     <li><a href="#">Order History</a></li>
                     <li><a href="#">Wish List</a></li>
                     <li><a href="#">Newsletter</a></li>
                  </ul>
               </div>
               <div class="span5">
                  <p class="logo"><img src="themes/images/logo.png" class="site_logo" alt=""></p>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. the  Lorem Ipsum has been the industry's standard dummy text ever since the you.</p>
                  <br/>
                  <span class="social_icons">
                     <a class="facebook" href="#">Facebook</a>
                     <a class="twitter" href="#">Twitter</a>
                     <a class="skype" href="#">Skype</a>
                     <a class="vimeo" href="#">Vimeo</a>
                  </span>
               </div>
            </div>
         </section>
         <section id="copyright">
            <span>Copyright 2013 bootstrappage template  All right reserved.</span>
         </section>
      </div>
      <script src="{{asset('public/themes/js/common.js')}}"></script>
      <script src="{{asset('public/themes/js/jquery.flexslider-min.js')}}"></script>
      <script type="text/javascript">
$(function () {
   $(document).ready(function () {
      $('.flexslider').flexslider({
         animation: "fade",
         slideshowSpeed: 4000,
         animationSpeed: 600,
         controlNav: false,
         directionNav: true,
         controlsContainer: ".flex-container" // the container that holds the flexslider
      });
   });
});
      </script>
      <script>
         $(function () {
            $('#form').submit(function (event) {
               var verified = grecaptcha.getResponse();
               if (verified.length === 0) {
                  event.preventDefault();
               }
            });
         });
      </script>
   </body>
</html>