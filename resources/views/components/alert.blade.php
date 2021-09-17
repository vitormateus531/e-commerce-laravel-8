<div class="pb-10">
    @if(Session::has('sucesso'))
    <div class="mt-10 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Sucesso!</strong>
        <span class="block sm:inline">{{Session::get('sucesso')}}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        </span>
    </div>
    @elseif(Session::has('error'))
    <div class="mt-10 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Erro!</strong>
        <span class="block sm:inline">{{Session::get('error')}}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        </span>
    </div>
    @endif
</div>