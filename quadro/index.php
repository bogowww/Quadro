<?php
require_once('../classes/quadro.class.php');
$quadro = new Quadro('',1,'x','x');

$id = isset($_GET['id'])?$_GET['id']:0;
if ($id > 0){
    $dados = $quadro->listar(1,$id);
    $editar = new Quadro($dados[0]['idquadro'],
    $dados[0]['nome']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Quadros</title>
    <style>
        .desenho{
            border:1px solid black;
            display: inline-block;
        }
    </style>
</head>
<body>
    <?php include "../navbar.html"; ?>
    <h1>Cadastro de Quadros</h1>
    <section>
        <form action="acaoquadro.php" method='post'>
            <label for="id">Id:</label>
            <input readonly type="text" name='id' id='id' value='<?php echo isset($editar)?$editar->getId():0 ?>'>
            <label for="nome">Nome:</label>
            <input type="text" name='nome' id='nome' value='<?php if(isset($editar)) echo $editar->getNome(); ?>'>
            <button type="submit" value='salvar' name='acao' id='acao'>Salvar</button>
            <?php  if(isset($editar)){ ?>
                <button type="submit" value='excluir' name='acao' id='acao'>Excluir</button>
            <?php } ?>
        </form>
    </section>
    <hr>
    <?php
        if (isset($editar)) {
            $editar->listarFormas();
        }else{
        $lista = $quadro->listar();
            foreach($lista as $item){
                $q = new Quadro($item['idquadro'],$item['nome']);
                echo '<a draggable="true" href="index.php?id='.$q->getId().'">';
                echo $q->getNome();
                echo '</a><br>';
            }
        }
    ?>
    
</body>
</html>