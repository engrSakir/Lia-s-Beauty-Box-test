@extends('layouts.frontend.app')
@push('title') Beauty Salon @endpush
@section('content')
    <div id="rev_slider_1050_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="webproduct-light"
        data-source="gallery" style="background-color:transparent;padding:10px;">
        <!-- START REVOLUTION SLIDER 5.4.1 fullscreen mode -->
        <div id="rev_slider_1050_1" class="slider-dots rev_slider fullscreenbanner" style="display:none;"
            data-version="5.4.1">
            <ul>
                @foreach ($banners as $banner)
                    <!-- SLIDE  -->
                    <li data-index="rs-293{{ $loop->iteration + 7 }}" data-transition="slideleft"
                        data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default"
                        data-easeout="default" data-masterspeed="default" data-thumb="{{ asset($banner->image) }}"
                        data-rotate="0" data-fsslotamount="7" data-saveperformance="off" data-title=""
                        data-param1="Additional Text" data-param2="" data-param3="" data-param4="" data-param5=""
                        data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset($banner->image) }}" alt="" data-bgposition="top center" data-bgfit="cover"
                            data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                        <!-- LAYERS -->


                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption WebProduct-Title   tp-resizeme" id="slide-2938-layer-01"
                            data-x="['left','left','left','left']" data-hoffset="['30','30','20','20']"
                            data-y="['middle','middle','top','top']" data-voffset="['-80','-80','200','130']"
                            data-fontsize="['57','55','55','45']" data-lineheight="['65','65','65','65']" data-width="none"
                            data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on"
                            data-frames='[{"from":"x:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":1000,"ease":"Power2.easeOut"},{"delay":"wait","speed":1500,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                            data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]"
                            data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 11;
                                    white-space: nowrap;
                                    text-transform:uppercase;">
                            <div class="text-secondry"> {{ $banner->secondary_text }}</div>
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption WebProduct-SubTitle   tp-resizeme" id="slide-2938-layer-02"
                            data-x="['left','left','left','left']" data-hoffset="['30','30','20','20']"
                            data-y="['middle','middle','top','top']" data-voffset="['0','0','280','180']"
                            data-fontsize="['55','55','55','45']" data-lineheight="['75','75','75','75']" data-width="none"
                            data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on"
                            data-frames='[{"from":"x:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":1250,"ease":"Power2.easeOut"},{"delay":"wait","speed":1500,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                            data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]"
                            data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 12;
                                    white-space: nowrap;
                                    text-transform:uppercase;
                                   font-weight: 700;
                                    ">
                            <div class="text-secondry">
                                {{ $banner->primary_text }}
                            </div>
                        </div>

                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption WebProduct-Content   tp-resizeme" id="slide-2938-layer-03"
                            data-x="['left','left','left','left']" data-hoffset="['30','30','20','20']"
                            data-y="['middle','middle','top','top']" data-voffset="['80','80','380','250']"
                            data-fontsize="['21','21','24','18']" data-lineheight="['28','28','32','26']"
                            data-width="['700','700','700','300']" data-height="['none','none','76','68']"
                            data-whitespace="normal" data-type="text" data-responsive_offset="on"
                            data-frames='[{"from":"x:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":1500,"ease":"Power2.easeOut"},{"delay":"wait","speed":1500,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                            data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]"
                            data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                            style="z-index: 13; white-space: normal;">
                            <div class="text-secondry">{{ $banner->short_description }}</div>
                        </div>

                        <!-- LAYER NR. 4 -->
                        <div class="tp-caption tp-resizeme" id="slide-2938-layer-04" data-x="['left','left','left','left']"
                            data-hoffset="['30','30','20','20']" data-y="['middle','middle','top','top']"
                            data-voffset="['180','180','480','400']" data-width="none" data-height="none"
                            data-whitespace="nowrap" data-type="button"
                            data-actions='[{"event":"click","action":"jumptoslide","slide":"rs-2939","delay":""}]'
                            data-responsive_offset="on" data-responsive="on" data-frames='[
                                    {"from":"y:100px(R);opacity:0;","speed":2000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},
                                    {"delay":"wait","speed":1000,"to":"y:-50px;opacity:0;","ease":"Power2.easeInOut"}
                                    ]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]"
                            data-paddingright="[40,40,40,40]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                            style="z-index:13; text-transform:uppercase; font-weight:700;">
                            <a href="{{ $banner->link }}" class="site-button radius-sm button-lg">View More</a>
                        </div>
                        <!-- LAYER NR. 5 -->

                        <!--<div class="tp-caption tp-resizeme" id="slide-2938-layer-05" data-x="['left','left','left','left']"
                            data-hoffset="['240','240','200','200']" data-y="['middle','middle','top','top']"
                            data-voffset="['180','180','480','400']" data-width="none" data-height="none"
                            data-whitespace="nowrap" data-type="button"
                            data-actions='[{"event":"click","action":"jumptoslide","slide":"rs-2939","delay":""}]'
                            data-responsive_offset="on" data-responsive="on" data-frames='[
                                    {"from":"y:100px(R);opacity:0;","speed":2000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},
                                    {"delay":"wait","speed":1000,"to":"y:-50px;opacity:0;","ease":"Power2.easeInOut"}
                                    ]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]"
                            data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[40,40,40,40]"
                            style="z-index:13; text-transform:uppercase; font-weight:700;">
                            <a href="javascript:;" class="site-button-secondry radius-sm button-lg">More detail</a>
                        </div>-->

                    </li>
                    <!-- SLIDE  -->
              
                @endforeach
            </ul>

        </div>
    </div>
    <!-- SLIDER END -->

    <!-- WELCOME SECTION START -->
    <div class="section-full p-tb100 bg-bottom-center bg-full-width bg-no-repeat"
        style="background-image:url(assets/frontend/images/background/bg-1.png);">
        <div class="container ">
            
            <div class="section-content text-center about-spa">
               <!-- <div class="row">
                    <div class="m-b30">
                        <div class="section-head">
                            <h3 class="text-uppercase">Brand Video</h3>
                            <div class="wt-separator-outer">
                                <div class="wt-separator style-icon">
                                    <i class="fa fa-leaf text-black"></i>
                                    <span class="separator-left bg-primary"></span>
                                    <span class="separator-right bg-primary"></span>
                                </div>
                            </div>
                        </div>
                        <div class="embed-responsive embed-responsive-16by9"><iframe width="560" height="315"
                                src="https://www.youtube.com/embed/iwGH5S70CmE"></iframe></div>
                    </div>
                </div>-->
                <div class="row">
                    <div class="col-md-4 col-sm-4 m-b30">
                        <div class="wt-icon-box-wraper p-a30 center">
                            <div class="wt-icon-box-md radius bg-secondry m-b20 circle-line-effect">
                                <span class="icon-cell text-white"><span class="flaticon-female-hairs"></span></span>
                            </div>
                            <div class="icon-content">
                                <h4 class="wt-tilte font-weight-500"> Bridal Makeup</h4>
                                <p class="text-secondry"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 m-b30">
                        <div class="wt-icon-box-wraper p-a30 center">
                            <div class="wt-icon-box-md radius bg-secondry m-b20 circle-line-effect">
                                <span class="icon-cell text-white"><span class="flaticon-scissors"></span></span>
                            </div>
                            <div class="icon-content">
                                <h4 class="wt-tilte font-weight-500">Hair Treatment</h4>
                                <p class="text-secondry"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 m-b30">
                        <div class="wt-icon-box-wraper p-a30 center">
                            <div class="wt-icon-box-md radius bg-secondry m-b20 circle-line-effect">
                                <span class="icon-cell text-white"><span class="flaticon-shaving"></span></span>
                            </div>
                            <div class="icon-content">
                                <h4 class="wt-tilte font-weight-500">Skin & Beauty Care</h4>
                                <p class="text-secondry"></p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- WELCOME COMPANY SECTION END -->
    <!-- Service SECTION START  -->
    <div class="section-full bg-white p-t80 p-b120">
        <div class="container">
            <!-- TITLE START-->
            <div class="section-head text-center">
                <h1><span class="text-primary">Our</span> Services</h1>
                <div class="wt-separator-outer">
                    <div class="wt-separator style-icon">
                        <i class="fa fa-leaf text-black"></i>
                        <span class="separator-left bg-primary"></span>
                        <span class="separator-right bg-primary"></span>
                    </div>
                </div>
                <p></p>
            </div>
            <!-- TITLE END-->
            <div class="tab-content">
                <!-- Block 1 -->
                <div id="pricing-item1" class="pricing-tab-content-block tab-pane active active-arrow">
                    <div class="section-content p-t50">
                        <!-- TABS DEFAULT NAV LEFT -->
                        <div class="wt-tabs vertical bg-tabs">
                            <ul class="nav nav-tabs">
                                @foreach ($serviceCategories as $serviceCategory)
                                    <li class=" @if ($loop->first) active @endif "><a data-toggle="tab"
                                            href="#service-category-{{ $serviceCategory->id }}">{{ $serviceCategory->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content p-l50">
                                @foreach ($serviceCategories as $serviceCategory)
                                    <div id="service-category-{{ $serviceCategory->id }}"
                                        class="tab-pane @if ($loop->first) active @endif ">
                                        <div class="pricing-tab-inner">
                                            <div class="row">
                                                @foreach ($serviceCategory->services as $service)
                                                    <div class="col-md-4 col-sm-4 p-tb15">
                                                        <div class="wt-box bg-white text-center">
                                                            <div class="wt-media ">
                                                                <a href="javascript:void(0);">
                                                                    <img width="200"
                                                                        src="{{ asset($service->image ?? 'uploads/images/no_image.png') }}"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="wt-info p-a30 bg-gray">
                                                                <h4 class="wt-title m-t0"><a
                                                                        href="javascript:void(0);">{{ $service->name }}</a>
                                                                </h4>
                                                                <p>{!! $service->description !!}</p>
                                                                <a href="{{ route('serviceDetails', $service->slug) }}"
                                                                    class="site-button ">Book
                                                                    Now <i class="fa fa-angle-double-right"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service SECTION END  -->
    <!-- OUR SPECIAL OFFER SECTION END  -->
   <!-- <div class="section-full bg-primary">
        <div class="container-fluid bg-top-right bg-no-repeat bg-full-height special-offer-block no-col-gap"
            style="background-image: url('{{ asset(get_static_option('offer_image')) }}');">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="section-content special-offer-outer bg-primary radius  p-tb60">
                        <div class="special-offer radius p-tb60">
                            <div class="wt-left-part special-offer-in">
                                <div class="wt-box p-r100 text-white">
                                    <h1>{{ get_static_option('offer_title') }}</h1>
                                    <h2 class="text-uppercase">{{ get_static_option('offer_subtitle') }}</h2>
                                    <p>{{ get_static_option('offer_details') }}</p>
                                    <a href="{{ get_static_option('offer_link') }}"
                                        class="site-button text-uppercase radius-sm font-weight-700 button-lg">view
                                        packages</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-0">
                    <div class="section-content">
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!-- OUR SPECIAL OFFER SECTION END  -->

    <!-- OUR GALLERY SECTION END  -->
    <div class="section-content text-center about-spa">
                <div class="row">
                    <div class="m-b30">
                        <div class="section-head">
                            <h3 class="text-uppercase">Brand Video</h3>
                            <div class="wt-separator-outer">
                                <div class="wt-separator style-icon">
                                    <i class="fa fa-leaf text-black"></i>
                                    <span class="separator-left bg-primary"></span>
                                    <span class="separator-right bg-primary"></span>
                                </div>
                            </div>
                        </div>
                        <div class="embed-responsive embed-responsive-16by9"><iframe width="560" height="315"
                                src="{{ get_static_option('brand_link') }}"></iframe></div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
        <!-- OUR GALLERY CONTENT END  -->

        <!-- CONTACT US SECTION END  -->
        <div class="section-full p-tb80">
            <div class="container equal-wraper no-col-gap">

                <!-- TITLE START -->
                <div class="section-head text-center">
                    <h1><span class="text-primary"> Contact</span> Us</h1>
                    <div class="wt-separator-outer ">
                        <div class="wt-separator style-icon">
                            <i class="fa fa-leaf text-black"></i>
                            <span class="separator-left bg-primary"></span>
                            <span class="separator-right bg-primary"></span>
                        </div>
                    </div>
                </div>
                <!-- TITLE END -->

                <div class="row conntact-home bg-gray">
                    <div class="col-md-4 col-sm-6 contact-home-left bg-no-repeat bg-primary bg-left-center"
                        style="background-image:url(assets/frontend/images/background/contact-map.png);">
                        <div class="section-content">
                            <div class="p-a50">

                                <div class="wt-icon-box-wraper left p-b20 text-white">
                                    <span class="icon-lg">
                                        <span class="flaticon-placeholder"></span>
                                    </span>
                                    <div class="icon-content">
                                        <h4 class="m-b5">Address</h4>
                                        <span class="font-12">{{ get_static_option('address') }}</span>
                                    </div>
                                </div>

                                <div class="wt-icon-box-wraper left p-b20 text-white">
                                    <span class="icon-lg">
                                        <span class="flaticon-envelope"></span>
                                    </span>
                                    <div class="icon-content">
                                        <h4 class="m-b5">Email</h4>
                                        <span class="font-12">{{ get_static_option('email') }} </span><br>
                                    </div>
                                </div>

                                <div class="wt-icon-box-wraper left p-b20 text-white">
                                    <span class="icon-lg">
                                        <span class="flaticon-smartphone"></span>
                                    </span>
                                    <div class="icon-content">
                                        <h4 class="m-b5">Phone</h4>
                                        <span class="font-12">{{ get_static_option('mobile') }}</span><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-6">
                        <div class="section-content bg-gray">
                            <div class="contact-home-right p-a30">
                                <h5 class="text-uppercase font-26 p-b20 font-weight-400">GET IN TOUCH</h5>
                                <form class="cons-contact-form2" method="post" action="{{ url('contact-us') }}">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input name="name" type="text" required class="form-control"
                                                placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input name="email" type="email" class="form-control" required
                                                placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-book"></i></span>
                                            <input name="phone" type="text" class="form-control" required
                                                placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon v-align-t"><i
                                                    class="fa fa-pencil"></i></span>
                                            <textarea name="message" class="form-control" rows="4" placeholder="Message"
                                                required></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="site-button skew-icon-btn radius-sm">
                                        <span class="font-weight-700 inline-block text-uppercase p-lr15">Submit</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- CONTACT US OFFER SECTION END  -->
    @endsection

    @push('head')

    @endpush

    @push('foot')

    @endpush
