<x-mail::message>
# Dúvida Respondida

Assunto da dúvida: <strong><u>{{ $reply->support_id }}</u></strong> <br>
<hr>
{{ $reply->content }}

<x-mail::button :url="route('replies.index', $reply->support_id)">
Ver
</x-mail::button>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
