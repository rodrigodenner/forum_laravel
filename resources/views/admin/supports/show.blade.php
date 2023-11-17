@extends('admin.layouts.app')

@section('title', "Detalhes da Dúvida")

@section('header')

<h1 class="text-lg text-black-500">
  Detalhes da Dúvida <strong> <u>{{ $support->subject }}</u> </strong>
</h1>

@endsection

@section('content')

<ul>
  <li> Assunto: {{$support->subject}} </li>
  <li> Status: {{getStatusSupport($support->status)}} </li>
  <li> Descrição: {{$support->body}} </li>
</ul>


<form action="{{route('supports.destroy',$support->id)}}" method="POST">
@csrf
@method('DELETE')
<button type="submit" class="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded">Deletar</button>
</form>

@endsection




