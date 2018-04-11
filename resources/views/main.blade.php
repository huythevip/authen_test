<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials._head')
</head>

<body>

@include('partials._nav')

<div class="container">

    @include('partials._messages')
    @yield('content')

    @include('partials._footer')

</div> <!-- end of .container -->

@include('partials._javascript')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('scripts')

</body>
</html>
