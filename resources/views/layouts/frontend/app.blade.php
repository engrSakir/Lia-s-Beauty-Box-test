<!DOCTYPE html>

<html lang="en">
<head>
@include('layouts.frontend.partials.head')
</head>

<body id="bg">

<div class="page-wraper">
    <!-- HEADER START -->
    @include('layouts.frontend.partials.header')
    <!-- HEADER END -->

    <!-- CONTENT START -->
    <div class="page-content">
    @yield('content')
    </div>
    <!-- CONTENT END -->

    <!-- FOOTER START -->
    @include('layouts.frontend.partials.footer')
    <!-- FOOTER END -->

    <!-- BUTTON TOP START -->
    <button class="scroltop"><span class=" iconmoon-house relative" id="btn-vibrate"></span>Top</button>

</div>


<!-- LOADING AREA START ===== -->
<div class="loading-area">
    <div class="loading-box"></div>
    <div class="loading-pic">
        <div class="cssload-container">
            <div class="cssload-progress cssload-float cssload-shadow">
                <div class="cssload-progress-item"></div>
            </div>
        </div>
    </div>
</div>
<!-- LOADING AREA  END ====== -->
<!-- JAVASCRIPT  FILES ========================================= -->
@include('layouts.frontend.partials.foot')

{{-- <!-- STYLE SWITCHER  ======= -->
@include('layouts.frontend.partials.style-switcher')
<!-- STYLE SWITCHER END ==== --> --}}
</body>
</html>
