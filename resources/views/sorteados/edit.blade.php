<titlte>Editar um Sorteado</title>
<form action = {{ route('alterar_sorteado', 'id' => $sorteado->id) }} method="POST">
@csrf
<label for="">Sorteados</label> <br>
<input type="text" name="sorteados"> <br>
<label for="">Produtos</label> <br>
<input type="text" name="produtos"> <br>
<label for="">Sorteio_Id</label> <br>
<input type="text" name="sorteio_id"> <br>
<button>Salvar</button>
</form>
