@extends('layouts.app')
@section('content')
<h1>home</h1>
<h6>hi there is a site</h6>

@endsection
@section('sidebar')
    @parent
    <h3>it is appended from sidebar</h3>
@endsection
