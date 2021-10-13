<footer class="site-footer footer-light">
    <!-- COLL-TO ACTION START -->
    <div class="section-full overlay-wraper bg-primary" style="background-image:url(assets/frontend/images/background/bg-7.png);">

        <div class="section-content ">
            <!-- COLL-TO ACTION START -->
            <div class="wt-subscribe-box">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-8">
                            <div class="call-to-action-left p-tb20 p-r50">
                                  <!--<h4 class="text-uppercase m-b10">We are ready to build your dream tell us more about your project</h4>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor.</p>-->
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="call-to-action-right p-tb30">
                                <a href="{{ url('/contact-us') }}" class="site-button-secondry text-uppercase radius-sm font-weight-600">
                                    Contact us
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER BLOCKES START -->
    <div class="footer-top overlay-wraper">
        <div class="overlay-main"></div>
        <div class="container">
            <div class="row">
                <!-- ABOUT COMPANY -->
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget_about">
                        <h4 class="widget-title">About Company</h4>
                        <div class="logo-footer clearfix p-b15">
                            <a href="{{ url('/') }}"><img src="{{ asset('assets/frontend/images/logo.png') }}" width="230" height="67" alt=""/></a>
                        </div>
                      <p>
                        {!! html_entity_decode(get_static_option('about')) !!}
                       </p>
                    </div>
                </div>
                <!-- RESENT POST -->
              <!--  <div class="col-md-3 col-sm-6">
                    <div class="widget recent-posts-entry-date">
                        <h4 class="widget-title">Resent Post</h4>
                        <div class="widget-post-bx">
                            <div class="bdr-light-blue widget-post clearfix  bdr-b-1 m-b10 p-b10">
                                <div class="wt-post-date text-center text-uppercase text-white p-t5">
                                    <strong>20</strong>
                                    <span>Mar</span>
                                </div>
                                <div class="wt-post-info">
                                    <div class="wt-post-header">
                                        <h6 class="post-title"><a href="blog-single.html">Blog title first </a></h6>
                                    </div>
                                    <div class="wt-post-meta">
                                        <ul>
                                            <li class="post-author"><i class="fa fa-user"></i>By Admin</li>
                                            <li class="post-comment"><i class="fa fa-comments"></i> 28</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="bdr-light-blue widget-post clearfix  bdr-b-1 m-b10 p-b10">
                                <div class="wt-post-date text-center text-uppercase text-white p-t5">
                                    <strong>30</strong>
                                    <span>Mar</span>
                                </div>
                                <div class="wt-post-info">
                                    <div class="wt-post-header">
                                        <h6 class="post-title"><a href="blog-single.html">Blog title first </a></h6>
                                    </div>
                                    <div class="wt-post-meta">
                                        <ul>
                                            <li class="post-author"><i class="fa fa-user"></i>By Admin</li>
                                            <li class="post-comment"><i class="fa fa-comments"></i> 29</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="bdr-light-blue widget-post clearfix  bdr-b-1 m-b10 p-b10">
                                <div class="wt-post-date text-center text-uppercase text-white p-t5">
                                    <strong>31</strong>
                                    <span>Mar</span>
                                </div>
                                <div class="wt-post-info">
                                    <div class="wt-post-header">
                                        <h6 class="post-title"><a href="blog-single.html">Blog title first </a></h6>
                                    </div>
                                    <div class="wt-post-meta">
                                        <ul>
                                            <li class="post-author"><i class="fa fa-user"></i>By Admin</li>
                                            <li class="post-comment"><i class="fa fa-comments"></i> 30</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
                <!-- USEFUL LINKS -->
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget_services">
                        <h4 class="widget-title">Useful links</h4>
                        <ul>
                            <li><a href="{{ url('/about') }}">About</a></li>
                            <li><a href="{{ url('/service') }}">Services</a></li>
                            <li><a href="{{ url('/booking') }}">Booking</a></li>
                        </ul>
                    </div>
                </div>
                <!-- NEWSLETTER -->
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget_newsletter">
                        <h4 class="widget-title">Newsletter</h4>
                        <div class="newsletter-bx">
                            <form role="search" method="post">
                                <div class="input-group">
                                    <input name="news-letter" class="form-control" placeholder="ENTER YOUR EMAIL" type="text">
                                    <span class="input-group-btn">
                                            <button type="submit" class="site-button"><i class="fa fa-paper-plane-o"></i></button>
                                        </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- SOCIAL LINKS -->
                    <div class="widget widget_social_inks">
                        <h4 class="widget-title">Social Links</h4>
                        <ul class="social-icons social-square social-darkest">
                            <li><a href="{{ get_static_option('facebook') }}" class="fa fa-facebook"></a></li>
                            <li><a href="{{ get_static_option('twitter') }}" class="fa fa-twitter"></a></li>
                            <li><a href="{{ get_static_option('linkedin') }}" class="fa fa-linkedin"></a></li>
                            <li><a href="{{ get_static_option('rss') }}" class="fa fa-rss"></a></li>
                            <li><a href="{{ get_static_option('youtube') }}" class="fa fa-youtube"></a></li>
                            <li><a href="{{ get_static_option('instagram') }}" class="fa fa-instagram"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER COPYRIGHT -->
    <div class="footer-bottom overlay-wraper">
        <div class="overlay-main"></div>
        <div class="constrot-strip"></div>
        <div class="container p-t30">
            <div class="row">
                <div class="wt-footer-bot-left">
                    <span class="copyrights-text">© {{ date('Y') }} {{ config('app.name') }} All Rights Reserved. Developed By <a href="https://www.iciclecorporation.com/" target="_blank">Icicle Corporation</a>.</span>
                </div>
                <div class="wt-footer-bot-right">
                    <ul class="copyrights-nav pull-right">
                        <li><a href="javascript:void(0);">Terms  & Condition</a></li>
                        <li><a href="javascript:void(0);">Privacy Policy</a></li>
                        <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
