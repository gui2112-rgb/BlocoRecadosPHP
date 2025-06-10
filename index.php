
<?php

    // Inclui o arquivo de conexão
    require 'conexao.php';


    // Verifica se o método de requisição é POST
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // Ob
        $nome = htmlspecialchars($_POST['nome']);
        $mensagem = htmlspecialchars($_POST['mensagem']);
        $telefone = htmlspecialchars($_POST['telefone']);

    

      // Cria a instrução SQL para inserir um novo recado 
      $sql = "INSERT INTO recados (nome,mensagem,telefone) VALUES (:nome, :mensagem, :telefone)";

      $stmt = $pdo ->prepare($sql);
      $stmt -> execute ([':nome' => $nome,':mensagem' => $mensagem, ':telefone'=>$telefone]);

    }


    // Realizar uma consulta no banco de dados para trazer os recados
    // FetchALL() retorna todos os resultados em um array 

    $recados = $pdo -> query("Select * from recados order by data_envio DESC")->fetchAll();


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloco de recados</title>
</head>
<body>

    <h1> Deixe seu recado !</h1>
    <!--  Formulario HTML para enviar novos recados -->

    <form method="post" action = ''>

            <!-- Campo de texto para o nome do usuario  -->

            <input type="text" name ="nome" placeholder="Seu nome" require>
            <input type="text" name ="telefone" placeholder="Seu tel" require>
            <textarea name="mensagem" placeholder="Sua mensagem" require></textarea>

            <button type="submit">Enviar</button>
            <br>
            <hr>



    </form>

    <br>
    <h2>Recados Anteriores</h2>

    <?php  if(count($recados)>0): ?>
        <?php foreach($recados as $r): ?>
            <p><strong><?= $r['nome']?></strong><?=$r['mensagem']?></p>
        <?php endforeach;?>

        <?php else: ?>
            <p>Nenhum recado ainda</p>
        <?php endif;?>
    
</body>
</html>