@extends('layouts.app')

@section('app')
<div style="display:flex;flex-direction:column;min-height:100vh">
    @include('partials.header')
    <main style="flex:1">
        @yield('content')
    </main>
    @include('partials.footer')
</div>
@endsection
