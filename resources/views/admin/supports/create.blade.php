@extends('admin.layouts.app')
@section('title','Nova Duvida')

@section('header')
<h1 class="text-lg text-black-500">Nova Dúvida</h1>
@endsection


@section('content')


<form action="{{route('supports.store')}}" method="POST">
 @include('admin.supports.partials.form')
</form>

@endsection



