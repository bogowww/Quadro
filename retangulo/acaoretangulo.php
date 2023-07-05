<?php
$id = isset($_POST['id'])?$_POST['id']:0;
$lado1 = isset($_POST['lado1'])?$_POST['lado1']:0;
$lado2 = isset($_POST['lado2'])?$_POST['lado2']:0;
$cor = isset($_POST['cor'])?$_POST['cor']:'';
$qd = isset($_POST['quadro'])?$_POST['quadro']:'';
$un = isset($_POST['un'])?$_POST['un']:'';
$acao = isset($_POST['acao'])?$_POST['acao']:'';
if ($acao == 'salvar'){
    try{
        require_once('../classes/retangulo.class.php');
        $retangulo = new Retangulo($id,$lado1,$lado2,$cor,$un,$qd);
        if ($id > 0)
            $retangulo->editar();
        else
            $retangulo->inserir();
        header('location:index.php');   

    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
}else if($acao == 'excluir'){
    try{
        require_once('../classes/retangulo.class.php');
        $retangulo = new Retangulo($id,$lado1,$lado2,$cor,$un,$qd);
        $retangulo->excluir();
        header('location:index.php');   

    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
}
?>  