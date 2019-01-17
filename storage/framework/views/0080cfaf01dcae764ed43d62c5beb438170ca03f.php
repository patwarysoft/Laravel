<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>Bootstrap E-commerce Templates</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
      <!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
      <!-- bootstrap -->
      <link href="<?php echo e(asset('public/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
      <link href="<?php echo e(asset('public/bootstrap/css/bootstrap-responsive.min.css')); ?>" rel="stylesheet">
      <link href="<?php echo e(asset('public/themes/css/bootstrappage.css')); ?>" rel="stylesheet">
      <link href="<?php echo e(asset('public/themes/css/flexslider.css')); ?>" rel="stylesheet">
      <link href="<?php echo e(asset('public/themes/css/main.css')); ?>" rel="stylesheet">

      <script src="<?php echo e(asset('public/themes/js/jquery-1.7.2.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/bootstrap/js/bootstrap.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/themes/js/superfish.js')); ?>"></script>
      <script src="<?php echo e(asset('public/themes/js/jquery.scrolltotop.js')); ?>"></script>
      <script src='https://www.google.com/recaptcha/api.js'></script>
      <?php if(isset($tinymce)): ?>
      <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
      <script>tinymce.init({ selector:'textarea' });</script>
      <?php endif; ?>
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
                     <li><a href="<?php echo e(url('/checkout')); ?>">Checkout</a></li>
                     <?php if(auth()->guard()->guest()): ?>
                     <li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
                     <li><a href="<?php echo e(url('/register')); ?>">Register</a></li>
                     <?php else: ?>
                     <li><a href="<?php echo e(url('/profile')); ?>"><?php echo e(Auth::user()->email); ?></a></li>
                     <li>
                        <a href="<?php echo e(route('logout')); ?>"
                           onclick="event.preventDefault();
   document.getElementById('logout-form').submit();">
                           Logout
                        </a>

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                           <?php echo e(csrf_field()); ?>

                        </form>
                     </li>
                     <?php endif; ?>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <div id="wrapper" class="container">
         <section class="navbar main-menu">
            <div class="navbar-inner main-menu">
               <a href="<?php echo e(url('/')); ?>" class="logo pull-left"><img src="<?php echo e(asset('public/themes/images/logo.png')); ?>" class="site_logo" alt=""></a>
               <nav id="menu" class="pull-right">
                  <ul>
                     <?php if(isset(Auth::user()->type) && Auth::user()->type > 1): ?>
                     <li><a href="#">Management</a>
                        <ul>
                           <li><a href="<?php echo e(url('/product-management')); ?>">Products</a></li>
                           <li><a href="<?php echo e(url('/category-management')); ?>">Category</a></li>
                           <li><a href="<?php echo e(url('/subcategory-management')); ?>">Sub Category</a></li>
                           <li><a href="<?php echo e(url('/city-management')); ?>">City</a></li>
                        </ul>
                     </li>
                     <?php endif; ?>
                     <li><a href="./products.html">Man</a></li>
                     <li><a href="./products.html">Sport</a>
                        <ul>
                           <li><a href="./products.html">Gifts and Tech</a></li>
                           <li><a href="./products.html">Ties and Hats</a></li>
                           <li><a href="./products.html">Cold Weather</a></li>
                        </ul>
                     </li>
                     <li><a href="./products.html">Hangbag</a></li>
                     <li><a href="./products.html">Best Seller</a></li>
                     <li><a href="./products.html">Top Seller</a></li>
                  </ul>
               </nav>
            </div>
         </section>
         <?php echo $__env->yieldContent("content"); ?>
         <section id="footer-bar">
            <div class="row">
               <div class="span3">
                  <h4>Navigation</h4>
                  <ul class="nav">
                     <li><a href="<?php echo e(url('/')); ?>">Homepage</a></li>
                     <li><a href="./about.html">About Us</a></li>
                     <li><a href="./contact.html">Contac Us</a></li>
                     <li><a href="./cart.html">Your Cart</a></li>
                     <li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
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
      <script src="<?php echo e(asset('public/themes/js/common.js')); ?>"></script>
      <script src="<?php echo e(asset('public/themes/js/jquery.flexslider-min.js')); ?>"></script>
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