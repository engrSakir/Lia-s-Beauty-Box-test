@extends('layouts.frontend.app')
@push('title') About @endpush
@section('content')
<style>
   .wt-tabs .social-icons li{
       padding:2px;
   }
    .wt-tabs .fa-facebook {
			  background: #3B5998;
			  padding:22px;
			  font-size:20px;
			  color:white;
			  border-radius:50%;
			}

			
			.wt-tabs .fa-youtube {
			  background: #bb0000;
			  padding:20px;
			  font-size:20px;
			  color:white;
			  border-radius:50%;
			}

			.wt-tabs .fa-instagram {
			  background: #8a3ab9;
			  padding:20px;
			  font-size:20px;
			  color:white;
			  border-radius:50%;
			}
</style>
    <!-- INNER PAGE BANNER -->
   <!-- <div class="wt-bnr-inr overlay-wraper"
        style="background-image:url({{ asset('assets/frontend/images/banner/product-banner.jpg') }});">
        <div class="overlay-main bg-black opacity-07"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
            </div>
        </div>
    </div>-->
    <!-- INNER PAGE BANNER END -->

    <!-- BREADCRUMB ROW -->
    <div class="bg-gray-light p-tb20">
        <div class="container">
            <ul class="wt-breadcrumb breadcrumb-style-2">
                <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="{{ route('about') }}"> About</a></li>
            </ul>
        </div>
    </div>
    <!-- BREADCRUMB ROW END -->

    <!-- SECTION CONTENT START -->
    <div class="section-full p-tb100">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-6 col-xs-100pc">
                    <div class="about-com-pic">
                        <img src="{{ asset('assets/frontend/images/lianaz.jpg') }}" alt=""
                            class="img-responsive">
                    </div>
                </div>
                <div class="col-md-7 col-sm-7 col-xs-6 col-xs-100pc">
                    <div class="section-head text-left">
                        <h3 class="text-uppercase">Lia Naz Ahmed </h3>
                        <div class="wt-separator-outer">
                            <div class="wt-separator style-icon">
                                <i class="fa fa-leaf text-black"></i>
                                <span class="separator-left bg-primary"></span>
                                <span class="separator-right bg-primary"></span>
                            </div>
                        </div>
<p>Lia Naz Ahmed  is one of Bangladesh’s most celebrated beauty experts with an unrivalled reputation in bridal makeup. She is a woman entrepreneur and contributed a lot for this beauty and grooming industry .Lia Naz Ahmed received her  Honours degree, before changing gears and finding her true vocation in the art of make-up. Her love for make-up developed into her passion once she completed a make-up course from  Bangkok, Thailand. This was followed by numerous beauty and grooming workshops conducted by internationally reputed experts from Asia and Europe.</p>
    
   <p>Synonymous with exquisite bridal makeup, Lia’s Beauty Box  is the most sought-after salon by today’s health and beauty conscious women. Since 2015, we have been providing best-in-class beauty care, with a complete range of services catering to the needs of a diverse group of customers. Today, we are best known for mastering the art of crafting beauty with strokes of personal care.</p>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12 col-xs-12">
                    
                                    <div class="wt-tabs tabs-default border" style="float:right">
                                        <ul class="social-icons social-circle">
                            <li><a href="{{ get_static_option('facebook') }}" class="fa fa-facebook"></a></li>
                           <!-- <li><a href="{{ get_static_option('twitter') }}" class="fa fa-twitter"></a></li>
                            <li><a href="{{ get_static_option('linkedin') }}" class="fa fa-linkedin"></a></li>
                            <li><a href="{{ get_static_option('rss') }}" class="fa fa-rss"></a></li>-->
                            <li><a href="{{ get_static_option('youtube') }}" class="fa fa-youtube"></a></li>
                            <li><a href="{{ get_static_option('instagram') }}" class="fa fa-instagram"></a></li>
                        </ul>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SECTION CONTENT END -->
    
@endsection

@push('head')
    
@endpush

@push('foot')
    
@endpush

