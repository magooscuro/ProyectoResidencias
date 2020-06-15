@extends('dashboard.master')
@section('content')
@include('dashboard.partials.validation-error')



<form action="{{route("user.store")}}" method="POST">
@include('dashboard.user._form',['pasw' => true])
</form>
@endsection

