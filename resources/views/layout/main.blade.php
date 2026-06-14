<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free"> 
    
@include('layout.head')

<body> <!--begin::App Wrapper-->
    <div class="layout-wrapper layout-content-navbar">

        <!-- Layout container -->
        <div class="layout-container">

            <!-- Sidebar -->
            @include('layout.sidebar')

            <div class="layout-page">

                <!-- Navbar -->
                @include('layout.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!-- / Content -->

                    <div class="content-backdrop fade"></div>
                </div>
                @include('layout.footer')
            </div>
        </div>
    </div>
    @include('layout.script')
</body><!--end::Body-->

</html>
