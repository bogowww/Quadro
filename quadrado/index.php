<?php
require_once('../classes/quadrado.class.php');
require_once('../classes/quadro.class.php');
$quadrado = new Quadrado('',1,'x','x', 0);

$id = isset($_GET['id'])?$_GET['id']:0;
if ($id > 0){
    $dados = $quadrado->listar(1,$id);
    $editar = new Quadrado($dados[0]['idquadrado'],$dados[0]['lado'],$dados[0]['cor'],$dados[0]['un'],$dados[0]['idquadro']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Quadrados</title>
    <style>
        .desenho{
            border:1px solid black;
            display: inline-block;
        }
    </style>
</head>
<body>
    <?php include "../navbar.html"; ?>
    <h1>Cadastro de Quadrados</h1>
    <section>
        <form action="acaoquadrado.php" method='post'>
            <label for="id">Id:</label>
            <input readonly type="text" name='id' id='id' value='<?php echo isset($editar)?$editar->getId():0 ?>'>
            <label for="lado">Lado:</label>
            <input type="text" name='lado' id='lado' value='<?php if(isset($editar)) echo $editar->getLado(); ?>'>
            <label for="un">UN:</label>
            <select name='un' id='un'>
                <option value=''>Selecione</option>
                <option value='cm' <?php  if(isset($editar)) if ($editar->getUn() == 'cm') echo 'selected'; ?> >Centímetros</option>
                <option value='px' <?php  if(isset($editar)) if ($editar->getUn() == 'px') echo 'selected'; ?>  >Pixel</option>
                <option value='%' <?php  if(isset($editar)) if ($editar->getUn() == '%') echo 'selected'; ?> >Porcentagem</option>
                <option value='vh' <?php  if(isset($editar)) if ($editar->getUn() == 'vh') echo 'selected'; ?> >View Port Height</option>
                <option value='vw' <?php  if(isset($editar)) if ($editar->getUn() == 'vw') echo 'selected'; ?> >View Port Width</option>
            </select>
            <label for="quadro">Quadro:</label>
            
            <select name="quadro" id="quadro">
                <?php
                    $quadro = new Quadro('', '');
                    $q = $quadro->listar();
                    foreach ($q as $qd) {
                        echo "<option value='{$qd["idquadro"]}'>{$qd["nome"]}</option> ";
                    }
                ?>
            </select>
            <label for="cor">Cor:</label>
            <input type="color" name='cor' id='cor' value='<?php  if($editar) echo $editar->getCor(); ?>'>
            <button type="submit" value='salvar' name='acao' id='acao'>Salvar</button>
            <?php  if(isset($editar)){ ?>
                <button type="submit" value='excluir' name='acao' id='acao'>Excluir</button>
            <?php } ?>
        </form>
    </section>
    <hr>

    <?php
        
        $lista = $quadrado->listar();
        foreach($lista as $item){
            $q = new Quadrado($item['idquadrado'],$item['lado'],$item['cor'],$item['un'],$item['idquadro']);
            echo '<a draggable="true" href="index.php?id='.$q->getId().'">';
            echo $q->desenhar();
            echo '</a>';
        }
    ?>


    
</body>
</html>