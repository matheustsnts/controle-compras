<titlte>Excluir um Sorteado</title>
<form action = {{ route('excluir_sorteado', 'id' => $sorteado->id) }} method="POST">
@csrf
<label for="">Tem certeza que você apagar este Sorteado?</label> <br>
<input type="text" name="sorteados" value="{{ $sorteado->sorteados"> <br>
<label for="">Tem certeza que você apagar este Sorteado?</label> <br>
<input type="text" name="produtos" value="{{ $sorteado->produtos"> <br>
<label for="">Tem certeza que você apagar este Sorteado?</label> <br>
<input type="text" name="sorteio_id" value="{{ $sorteado->sorteio_id"> <br>
<button>Sim</button>
</form>