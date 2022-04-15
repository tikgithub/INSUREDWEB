@extends('layouts.public_layout')
@section('content')
<div class="pt-5"></div>
    {{Session::get("errors")}}
@endsection