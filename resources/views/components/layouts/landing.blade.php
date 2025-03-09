<!DOCTYPE html>
<html lang="en">
<head>
    @include('components.layouts.landing.meta')
    <!-- #title -->
    <title>Charifund | Nonprofit NGO Fundraising HTML5 Template</title>

    @include('components.layouts.landing.styles')

</head>
<body>
<!--[if lt IE 9]>
<p class="browserupgrade">
    You are using an <strong>outdated</strong> browser. Please
    <a href="https://browsehappy.com/">upgrade your browser</a> to improve
    your experience and security.
</p>
<![endif]-->
<div class="page-wrapper">
    <!-- ==== preloader start ==== -->
    @include('components.layouts.landing.preloader')
    <!-- ==== / preloader end ==== -->
    <!-- ==== topbar start ==== -->
    @include('components.layouts.landing.topbar')
    <!-- ==== / topbar end ==== -->
    <!-- ==== header start ==== -->
    @include('components.layouts.landing.header')
    <!-- ==== / header end ==== -->
    <!-- ==== mobile menu start ==== -->
    @include('components.layouts.landing.mobile-menu')
    <!-- ==== / mobile menu end ==== -->
    <!-- ==== search popup start ==== -->
    @include('components.layouts.landing.global-search')
    <!-- ==== / search popup end ==== -->
    <!-- ==== banner section start ==== -->
    @if(isset($slot))
        {{$slot}}
    @else
        @yield('content')
    @endif
    <!-- ==== footer start ==== -->
    @include('components.layouts.landing.footer')
    <!-- ==== / footer end ==== -->
    <!-- ==== custom cursor start ==== -->
    <div class="mouseCursor cursor-outer"></div>
    <div class="mouseCursor cursor-inner"></div>
    <!-- ==== / custom cursor end ==== -->
    <!-- ==== scroll to top start ==== -->
    <button class="progress-wrap" aria-label="scroll indicator" title="back to top">
        <span></span>
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </button>
    <!-- ==== / scroll to top end ==== -->

</div>
@include('components.layouts.landing.scripts')
</body>
</html>
