//Selecionar o Tipo de exame
$('button[name=btn-sortear]').click(function () {

    var tipo_exame_id = $(this).val();
    $('select[name=exames]').empty();

    $.get('/sorteados/sorteado/teste', function (
        users) {
        console.log(`${users['name']}`)

        $('.result-sorteio').html(
            `
                        <div class="card">


            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Departamento</th>
                            <th>Produto </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>${users['name']}</td>
                            <td>${users['departamentos'][0]['nome']}</td</td>
                            <td>Teste</td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
                    `
        );
    });
});