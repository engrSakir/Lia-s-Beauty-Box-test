@extends('layouts.frontend.app')
@section('content')
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
@endsection
@push('head')
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
@endpush
@push('foot')


@endpush
