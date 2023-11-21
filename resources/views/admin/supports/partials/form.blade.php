<x-alert />
@csrf()
<input type="text" placeholder="Assunto" name="subject" value="{{ $support->subject ?? old('subject') }}" class="block w-full px-4 py-3 mt-4 mb-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
<textarea name="body" cols="30" rows="5" placeholder="Descrição" class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">{{ $support->body ?? old('body') }}</textarea>
<button type="submit" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">Enviar</button>
