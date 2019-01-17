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
                  <td><a href="product_detail.html"><img alt="" src="themes/images/ladies/9.jpg"></a></td>
                  <td><?php echo e($value->title); ?></td>
                  <td><input type="text" value="<?php echo e($sqty[$index]); ?>" class="input-mini"></td>
                  <td>$<?php echo e(checkoutPrice($value->price, $value->discount, 1)); ?></td>
                  <td>$<?php echo e(checkoutPrice($value->price, $value->discount, $sqty[$index])); ?></td>
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
            
            <?php else: ?>
            <p>For purchase, You need to <a href="<?php echo e(url('/')); ?>/login">login</a></p>
          
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make("master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>