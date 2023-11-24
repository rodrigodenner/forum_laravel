@extends('admin.layouts.app')

@section('title', "Detalhes da Dúvida {$support->subject}")

@section('content')
  <!-- component -->
  <div class="flex justify-center min-h-screen">
    <div class="flex flex-col w-3/4 gap-2 p-5 px-10 md:w-3/5">
      <div class="flex justify-between">
        <h1 class="text-lg">Detalhes da Dúvida: <b><u>{{ $support->subject }}</u></b></h1>
        {{-- @can('owner', $support->user['id']) --}}
        <form action="{{ route('supports.destroy', $support->id) }}" method="post">
          @csrf()
          @method('DELETE')
          <button type="submit" class="px-4 py-2 font-bold text-white bg-red-500 border-b-4 border-red-700 rounded
          hover:bg-red-400 hover:border-red-500">Deletar</button>
        </form>
        {{-- @endcan --}}
      </div>
      <ul>
        <li>Status:
          <x-status-support :status="$support->status" />
        </li>
        <li>Descrição: <u>{{ $support->body }}</u></li>
      </ul>

      <!-- Item Container -->
      <div class="flex flex-col gap-3 text-white">

         @forelse ($replies as $reply)
        <div class="flex flex-col gap-4 p-4 rounded dark:bg-gray-900">
          <!-- Profile and Rating -->
          <div class="flex justify-between justify">
            <div class="flex gap-2">
              <div class="text-center bg-red-500 rounded-full w-7 h-7">RD</div>
               <span>{{ $reply['user']['name'] }}</span>
            </div>
          </div>

           <div>
              {{ $reply['content'] }}
          </div>

          <div class="flex justify-between">
             <span>{{ $reply['created_at'] }}</span>
              {{--@can('owner', $reply['user']['id']) --}}
             <form action="{{ route('replies.destroy', [$support->id, $reply['id']]) }}" method="post">
            @csrf()
            @method('DELETE')
            <button type="submit" class="px-4 py-1 text-white bg-red-500 border-b-4 border-red-700 rounded
            hover:bg-red-400 hover:border-red-500">Deletar</button>
            </form>
            {{-- @else --}}

            {{-- @endcan --}}
          </div>
        </div>
         @empty
        <p>No replies</p>
         @endforelse

        <div class="py-4">
          <form action="{{ route('replies.store', $support->id) }}" method="post">
            @csrf
            <input type="hidden" name="support_id" value="{{ $support->id }}">
            <textarea rows="2" name="content" placeholder="Sua resposta" class="w-full resize-none rounded-md border
           border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1]
           focus:shadow-md"></textarea>
            <button type="submit" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700
          transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800
          dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
              Enviar
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
