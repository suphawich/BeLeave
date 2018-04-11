@extends('layout.go')

@push('style')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    {{-- <script src="/js/app.js" charset="utf-8"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script>
        new Vue({
            el: '#dashboard',
            data: {
                isShowMenuList: true,
                isShowMenuIcon: false,
                isOverlayToggled: false
            },
            methods: {
                lessMoreMenu: function () {
                    this.isShowMenuList = !this.isShowMenuList;
                    this.isShowMenuIcon = !this.isShowMenuIcon;
                },
                toggleOverlay: function () {
                    this.isOverlayToggled = !this.isOverlayToggled;
                }
            }
        });
    </script>
@endpush

@section('title')
    Dashboard
@endsection
