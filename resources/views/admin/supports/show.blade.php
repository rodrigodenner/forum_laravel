<h1>Detalhes da Duvida {{$support->id}}</h1>

<ul>
  <li> Assunto: {{$support->subject}} </li>
  <li> Status: {{getStatusSupport($support->status)}} </li>
  <li> Descrição: {{$support->body}} </li>
</ul>

<form action="{{route('supports.destroy',$support->id)}}" method="POST">
@csrf
@method('DELETE')
<button type="submit">Deletar</button>
</form>
