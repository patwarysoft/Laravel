<?php $__env->startSection("content"); ?>
<section class="main-content">				
   <div class="row">
      <div class="span9">					
         <h4 class="title"><span class="text"><strong>Your</strong> Cart</span></h4>
         <table class="table table-striped">
            <thead>
               <tr>
                  <th>Image</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Unit Price</th>
                  <th>Total</th>
                  <th>Remove</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $total = 0;
               ?>
               <?php $__currentLoopData = $allPdt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php
               $spdt = Session::get("pdtId");
               $sqty = Session::get("qtyId");                  
               $index = array_search($value->id, $spdt);
               $total += checkoutPrice($value->price, $value->discount, $sqty[$index]);
               ?>                  
               <tr>                  
                  <td><a href="product_detail.html"><img alt="" src="<?php echo e(url('/')); ?>/<?php echo e(pictureHelper($value->id, $value->picture1, $value->picture2, $value->picture3)); ?>" class="img-responsive" width="250px"></a></td>
                  <td><?php echo e($value->title); ?></td>
                  <td><input type="text" value="<?php echo e($sqty[$index]); ?>" class="input-mini"></td>
                  <td>$<?php echo e(checkoutPrice($value->price, $value->discount, 1)); ?></td>
                  <td>$<?php echo e(checkoutPrice($value->price, $value->discount, $sqty[$index])); ?></td>
                  <td>
                     <form action="<?php echo e(url('/cart-remove')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="ids" value="<?php echo e($value->id); ?>" />
                        <input type="submit" name="del" value="Remove" class="btn btn-danger" />
                     </form>
                  </td>
               </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><strong>$<?php echo e($total); ?></strong></td>
               </tr>		  
            </tbody>
         </table>
         <?php if(isset(Auth::user()->type)): ?>
         <form action="<?php echo e(url('/purchase')); ?>" method="get">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="shipping_id" id="shipping_id" value="0" />
            <select name='addr_type' id="addr_type" class="form-control">
               <option value='1'>New Address</option>
               <option value='2'>Existing Address</option>
            </select>
            <div id="new_addr">
               <input type="text" name="fn" class="form-control" /> <br /> <br />
               <textarea name="addr" class="form-control"></textarea> <br /> <br />
               <input type="text" name="contact" class="form-control" /> <br /> <br />
            </div>
            <div id="ex_addr">

            </div>
            <input type="submit" name="sub" class="btn btn-success" value="Submit Order" />
         </form>
         <?php else: ?>
         <h4>For purchase, You need to <button><a href="<?php echo e(url('/')); ?>/login">Login</a></button></h4>

         <?php endif; ?>
      </div>
      <div class="span3 col">
         <div class="block">	
            <ul class="nav nav-list">
               <li class="nav-header">SUB CATEGORIES</li>
               <li><a href="products.html">Nullam semper elementum</a></li>
               <li class="active"><a href="products.html">Phasellus ultricies</a></li>
               <li><a href="products.html">Donec laoreet dui</a></li>
               <li><a href="products.html">Nullam semper elementum</a></li>
               <li><a href="products.html">Phasellus ultricies</a></li>
               <li><a href="products.html">Donec laoreet dui</a></li>
            </ul>
            <br/>
            <ul class="nav nav-list below">
               <li class="nav-header">MANUFACTURES</li>
               <li><a href="products.html">Adidas</a></li>
               <li><a href="products.html">Nike</a></li>
               <li><a href="products.html">Dunlop</a></li>
               <li><a href="products.html">Yamaha</a></li>
            </ul>
         </div>
         <div class="block">
            <h4 class="title">
               <span class="pull-left"><span class="text">Randomize</span></span>
               <span class="pull-right">
                  <a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
               </span>
            </h4>
            <div id="myCarousel" class="carousel slide">
               <div class="carousel-inner">
                  <div class="active item">
                     <ul class="thumbnails listing-products">
                        <li class="span3">
                           <div class="product-box">
                              <span class="sale_tag"></span>												
                              <a href="product_detail.html"><img alt="" src="themes/images/ladies/2.jpg"></a><br/>
                              <a href="product_detail.html" class="title">Fusce id molestie massa</a><br/>
                              <a href="#" class="category">Suspendisse aliquet</a>
                              <p class="price">$261</p>
                           </div>
                        </li>
                     </ul>
                  </div>
                  <div class="item">
                     <ul class="thumbnails listing-products">
                        <li class="span3">
                           <div class="product-box">												
                              <a href="product_detail.html"><img alt="" src="themes/images/ladies/4.jpg"></a><br/>
                              <a href="product_detail.html" class="title">Tempor sem sodales</a><br/>
                              <a href="#" class="category">Urna nec lectus mollis</a>
                              <p class="price">$134</p>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>						
      </div>
   </div>
</section>		
<script>
   $(document).ready(function () {
      $("#ex_addr").hide();
      $("body").on("change", "#addr_type", function(){
         var val = parseInt($(this).val());
         if (val == 1) {
            $("#new_addr").show();
            $("#ex_addr").hide();
         } else {
            $("#ex_addr").show();
            $("#new_addr").hide();
            
            $.ajax({
               url: "<?php echo e(url('/')); ?>/load-address",
               type: 'GET',
               data: {},
               success: function (msg) {
                  $("#ex_addr").html(msg);
               }
            });
         }
      });
      $("body").on("click", ".address", function(){
         $("#shipping_id").val($(this).attr("id"));
         $(".address").removeClass("address-active");
         $(this).addClass("address-active");
      });
   });
</script>
<style>
   .address {
    float: left;
    padding: 15px;
    margin: 0 15px 15px 0;
    background: #eee;
    border-radius: 5px;
    cursor: pointer;
    min-width: 200px;
}
.address:hover, .address-active{
   background: #ccc;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>