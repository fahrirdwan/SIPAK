<!DOCTYPE html>
<html lang="en">

<head>
 @include('partials.app.header')
</head>

<body class="hold-transition sidebar-mini layout-fixed"></body>
    <div class="wrapper">
        <x-navbar />
        @if(Auth::user()->id_role === 1)
        <x-sidebar-admin />
        @elseif(Auth::user()->id_role === 2)
        <x-sidebar-user />
        @endif
        <div class="content-wrapper">
            @include('partials.app.breadcrumb')
            <section class="content">
                @yield('content')
            </section>
        </div>

        <footer class="main-footer">
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    @include('partials.app.footer')
</body>

</html>