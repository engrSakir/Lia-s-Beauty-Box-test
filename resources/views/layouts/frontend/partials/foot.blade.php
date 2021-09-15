<script   src="{{ asset('assets/frontend/js/jquery-1.12.4.min.js') }}"></script><!-- JQUERY.MIN JS -->
<script   src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script><!-- BOOTSTRAP.MIN JS -->

<script   src="{{ asset('assets/frontend/js/bootstrap-select.min.js') }}"></script><!-- FORM JS -->
<script   src="{{ asset('assets/frontend/js/jquery.bootstrap-touchspin.min.js') }}"></script><!-- FORM JS -->

<script   src="{{ asset('assets/frontend/js/magnific-popup.min.js') }}"></script><!-- MAGNIFIC-POPUP JS -->

<script   src="{{ asset('assets/frontend/js/waypoints.min.js') }}"></script><!-- WAYPOINTS JS -->
<script   src="{{ asset('assets/frontend/js/counterup.min.js') }}"></script><!-- COUNTERUP JS -->
<script   src="{{ asset('assets/frontend/js/waypoints-sticky.min.js') }}"></script><!-- COUNTERUP JS -->

<script  src="{{ asset('assets/frontend/js/isotope.pkgd.min.js') }}"></script><!-- MASONRY  -->

<script   src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script><!-- OWL  SLIDER  -->

<script   src="{{ asset('assets/frontend/js/stellar.min.js') }}"></script><!-- PARALLAX BG IMAGE   -->
<script   src="{{ asset('assets/frontend/js/scrolla.min.js') }}"></script><!-- ON SCROLL CONTENT ANIMTE   -->

<script   src="{{ asset('assets/frontend/js/custom.js') }}"></script><!-- CUSTOM FUCTIONS  -->
<script   src="{{ asset('assets/frontend/js/shortcode.js') }}"></script><!-- SHORTCODE FUCTIONS  -->
<script   src="{{ asset('assets/frontend/js/switcher.js') }}"></script><!-- SWITCHER FUCTIONS  -->

<!-- REVOLUTION JS FILES -->

<script  src="{{ asset('assets/frontend/plugins/revolution/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script  src="{{ asset('assets/frontend/plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script  src="{{ asset('assets/frontend/plugins/revolution/revolution/js/extensions/revolution-plugin.js') }}"></script>

<!-- REVOLUTION SLIDER FUNCTION  ===== -->
<script   src="{{ asset('assets/frontend/js/rev-script-1.js') }}"></script>

<!--sweetalert2 CDN -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--Helper js -->
<script src="{{ asset('assets/js/helper.js') }}"></script>
{{--@jquery--}}
@toastr_js
@toastr_render
<!--Page Lavel code -->
@stack('foot')
