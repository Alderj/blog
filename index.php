<?php

    require_once 'classe-pessoa.php';
    $p = new Pessoa("crudpdo","localhost","root","");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>CRUD  BASICO</title>
</head>

<body>
    <?php
    if(isset($_POST['nome']))
    {
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        if(!empty($nome) && !empty($telefone) && !empty($email))
        {
            // cadastrar
            if(!$p->cadastrarPessoa($nome, $telefone, $email))
            {
                echo "Email já cadastrado";
            }
        } else {
            echo "Preencha todos os campos";
        }         
    }

    ?>
    <div class="container">
        
        <section id="esquerda">
            <form method="POST">
                <h2>CADASTRAR PESSOA</h2>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome">
                
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" id="telefone">
                
                <label for="email">Email:</label>
                <input type="text" name="email" id="email">
                
                <input type="submit" value="CADASTRAR">
            </form>
        </section>
        
        <section id="direita">
        <table>
                <tr id="titulo">
                    <td>NOME</td>
                    <td>TELEFONE</td>
                    <td colspan="2">EMAIL</td>
                </tr>
            <?php
               $dados = $p->BuscarDados();
               if(count($dados) > 0)
                {
                    for ($i=0; $i < count($dados); $i++)
                    {
                        echo "<tr>";
                        foreach($dados[$i] as $k => $v)
                        {
                            if($k != "id")
                            {
                                echo "<td>".$v."</td>";
                            }
                        }
            ?>
                            <td><a href="">Editar</a><a href="">Excluir</a></td>
            <?php
                        echo "</>";
                    }            
                } else {
                    echo "Ainda não há pessoas cadastradas.";
                }
            ?>  
            </table>
        </section>
    </div>
</body>

</html>