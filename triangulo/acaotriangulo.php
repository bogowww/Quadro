<?php
$id = isset($_POST['id'])?$_POST['id']:0;
$lado1 = isset($_POST['lado1'])?$_POST['lado1']:0;
$lado2 = isset($_POST['lado2'])?$_POST['lado2']:0;
$lado3 = isset($_POST['lado3'])?$_POST['lado3']:0;
$qd = isset($_POST['quadro'])?$_POST['quadro']:0;
$cor = isset($_POST['cor'])?$_POST['cor']:'';
$un = isset($_POST['un'])?$_POST['un']:'';
$acao = isset($_POST['acao'])?$_POST['acao']:'';

if ($acao == 'salvar'){
    try{
        require_once('../classes/triangulo.class.php');
        $triangulo = new Triangulo($id,$lado1,$lado2,$lado3,$cor,$un,$qd);
        if ($id > 0)
            $triangulo->editar();
        else
            $triangulo->inserir();
        header('location:index.php');   

    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
}else if($acao == 'excluir'){
    try{
        require_once('../classes/triangulo.class.php');
        $triangulo = new Triangulo($id,$lado1,$lado2,$lado3,$cor,$un,$qd);
        $triangulo->excluir();
        header('location:index.php');   

    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
}

?>