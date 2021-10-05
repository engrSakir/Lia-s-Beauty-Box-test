{{-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

</div> --}}

  <!-- SECTION CONTENT START -->
  <div class="section-full p-t80 p-b50">
    <div class="container">
        <div class="section-content">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="section-content bg-gray">
                        <div class="contact-home-right p-a30 d-flex justify-content-center">
                            <div>
                                <h1>{{ config('app.name') }}</h1>
                            </div>

                            <div>
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
</div>
<!-- SECTION CONTENT END -->
