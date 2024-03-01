<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    function mostrarMensagem() {

        // Seleciona o modal pelo seu ID
        var modal = document.getElementById("myModal");
        // Mostra o modal

        $(modal).modal('show');
        // Define um temporizador para fechar o modal após 3 segundos (3000 milissegundos)

        setTimeout(function() {
            $(modal).modal('hide');
        }, 3000);
    }
</script>




 <?php

class PainelDeErro
{
    private $mensagem;
    private $tipo;
    
    
    
    public function __construct($mensagem, $tipo)
    {
        $this->mensagem = $mensagem;
        $this->tipo = $tipo;
        
    }

    public function exibirErro()
    {
        echo "<div id='myModal' class='modal fade'>
                   <div class='modal-dialog'>
                       <div class='modal-body'>
                           <div class='{$this->tipo}' role='alert'>
                                {$this->mensagem}
                           </div>
                       </div>
                   </div>
            </div>";
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getMensagem()
    {
        return $this->mensagem;
    }

    
}

$mensagensDeErro = [
    [
        'tipo' => 'alert alert-success',
        'mensagem' => 'Operação bem-sucedida.',
    ],
    [
        'tipo' => 'alert alert-danger',
        'mensagem' => 'Erro ao agendar, data indisponível.',
    ],
    [
        'tipo' => 'alert alert-danger',
        'mensagem' => 'Erro ao cadastro, por favor preencha todos os campos.',
    ],
    [
        'tipo' => 'alert alert-danger',
        'mensagem' => 'Email vazio.',
    ],
    [
        'tipo' => 'alert alert-danger',
        'mensagem' => 'Erro ao logar, email ou senha incorreto.',
    ]
];


?> 

 


