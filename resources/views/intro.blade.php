@extends("master")
@section("content")
<section  class="homepage-slider" id="home-slider">
  <div class="flexslider">
    <ul class="slides">
      <li>
        <img src="{{asset('public/themes/images/carousel/banner-1.jpg')}}" alt="" />
      </li>
      <li>
        <img src="{{asset('public/themes/images/carousel/banner-2.jpg')}}" alt="" />
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
              @foreach($allData[2] as $pdt)
              @if($c%4==1)
              <div class="{{($c==1)?"active ":""}}item">
                <ul class="thumbnails">			
              @endif									
                  <li class="span3">
                    <div class="product-box">
                      <span class="sale_tag"></span>
                      <p><a href="{{url('/')}}/{{Replace($pdt->cname)}}/{{Replace($pdt->scname)}}/{{Replace($pdt->id)}}/{{Replace($pdt->title)}}"><img src="{{url('/')}}/{{pictureHelper($pdt->id, $pdt->picture1, $pdt->picture2, $pdt->picture3)}}" alt="" /></a></p>
                      <a href="{{url('/')}}/{{Replace($pdt->cname)}}/{{Replace($pdt->scname)}}/{{Replace($pdt->id)}}/{{Replace($pdt->title)}}" class="title">{{$pdt->title}}</a><br/>
                      <p class="price">{!! discount($pdt->price, $pdt->discount) !!}</p>
                    </div>
                  </li>
                  @if($c%4==0)
                </ul>
              </div>
              @endif
              <?php $c++ ?>
              @endforeach
              
            </div>							
          </div>
           {{$masud->links()}}
        </div>						
      </div>
      <br/>
      
      <div class="row">
        <div class="span12">
          <h4 class="title">
            <span class="pull-left"><span class="text"><span class="line">Best <strong>Selling</strong></span></span></span>
            <span class="pull-right">
              <a class="left button" href="#myCarousel2" data-slide="prev"></a><a class="right button" href="#myCarousel2" data-slide="next"></a>
            </span>
          </h4>
          <div id="myCarousel2" class="myCarousel carousel slide">
            <div class="carousel-inner">
              <?php $c = 1; ?>
              @foreach($allData[3] as $pdt)
              @if($c%4==1)
              <div class="{{($c==1)?"active ":""}}item">
                <ul class="thumbnails">			
              @endif									
                  <li class="span3">
                    <div class="product-box">
                      <span class="sale_tag"></span>
                      <p><a href="{{url('/')}}/{{Replace($pdt->cname)}}/{{Replace($pdt->scname)}}/{{Replace($pdt->id)}}/{{Replace($pdt->title)}}"><img src="{{url('/')}}/{{pictureHelper($pdt->id, $pdt->picture1, $pdt->picture2, $pdt->picture3)}}" alt="" /></a></p>
                      <a href="{{url('/')}}/{{Replace($pdt->cname)}}/{{Replace($pdt->scname)}}/{{Replace($pdt->id)}}/{{Replace($pdt->title)}}" class="title">{{$pdt->title}}</a><br/>
                      <p class="price">{!! discount($pdt->price, $pdt->discount) !!}</p>
                    </div>
                  </li>
                  @if($c%4==0)
                </ul>
              </div>
              @endif
              <?php $c++ ?>
              @endforeach
              
            </div>							
          </div>
           {{$masud->links()}}
        </div>						
      </div>
      
      <br />

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


@endsection

