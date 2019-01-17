<?php $__env->startSection("content"); ?>
<section  class="homepage-slider" id="home-slider">
  <div class="flexslider">
    <ul class="slides">
      <li>
        <img src="<?php echo e(asset('public/themes/images/carousel/banner-1.jpg')); ?>" alt="" />
      </li>
      <li>
        <img src="<?php echo e(asset('public/themes/images/carousel/banner-2.jpg')); ?>" alt="" />
        <div class="intro">
          <h1>Mid season sale</h1>
          <p><span>Up to 50% Off</span></p>
          <p><span>On selected items online and in stores</span></p>
        </div>
      </li>
    </ul>
  </div>			
</section>
<section class="header_text">
  We stand for top quality templates. Our genuine developers always optimized bootstrap commercial templates. 
  <br/>Don't miss to use our cheap abd best bootstrap templates.
</section>
<section class="main-content">
  <div class="row">
    <div class="span12">													
      <div class="row">
        <div class="span12">
          <h4 class="title">
            <span class="pull-left"><span class="text"><span class="line">Feature <strong>Products</strong></span></span></span>
            <span class="pull-right">
              <a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
            </span>
          </h4>
          <div id="myCarousel" class="myCarousel carousel slide">
            <div class="carousel-inner">
              <?php $c = 1; ?>
              <?php $__currentLoopData = $allData[2]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pdt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($c%4==1): ?>
              <div class="<?php echo e(($c==1)?"active ":""); ?>item">
                <ul class="thumbnails">			
              <?php endif; ?>									
                  <li class="span3">
                    <div class="product-box">
                      <span class="sale_tag"></span>
                      <p><a href="<?php echo e(url('/')); ?>/<?php echo e(Replace($pdt->cname)); ?>/<?php echo e(Replace($pdt->scname)); ?>/<?php echo e(Replace($pdt->id)); ?>/<?php echo e(Replace($pdt->title)); ?>"><img src="<?php echo e(url('/')); ?>/<?php echo e(pictureHelper($pdt->id, $pdt->picture1, $pdt->picture2, $pdt->picture3)); ?>" alt="" /></a></p>
                      <a href="<?php echo e(url('/')); ?>/<?php echo e(Replace($pdt->cname)); ?>/<?php echo e(Replace($pdt->scname)); ?>/<?php echo e(Replace($pdt->id)); ?>/<?php echo e(Replace($pdt->title)); ?>" class="title"><?php echo e($pdt->title); ?></a><br/>
                      <p class="price"><?php echo discount($pdt->price, $pdt->discount); ?></p>
                    </div>
                  </li>
                  <?php if($c%4==0): ?>
                </ul>
              </div>
              <?php endif; ?>
              <?php $c++ ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
            </div>							
          </div>
        </div>						
      </div>
      <br/>

      <div class="row feature_box">						
        <div class="span4">
          <div class="service">
            <div class="responsive">	
              <img src="themes/images/feature_img_2.png" alt="" />
              <h4>MODERN <strong>DESIGN</strong></h4>
              <p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer.</p>									
            </div>
          </div>
        </div>
        <div class="span4">	
          <div class="service">
            <div class="customize">			
              <img src="themes/images/feature_img_1.png" alt="" />
              <h4>FREE <strong>SHIPPING</strong></h4>
              <p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer.</p>
            </div>
          </div>
        </div>
        <div class="span4">
          <div class="service">
            <div class="support">	
              <img src="themes/images/feature_img_3.png" alt="" />
              <h4>24/7 LIVE <strong>SUPPORT</strong></h4>
              <p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer.</p>
            </div>
          </div>
        </div>	
      </div>		
    </div>				
  </div>
</section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make("master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>