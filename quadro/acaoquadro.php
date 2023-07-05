<?php
$id = isset($_POST['id'])?$_POST['id']:0;
$nome = isset($_POST['nome'])?$_POST['nome']:0;
$acao = isset($_POST['acao'])?$_POST['acao']:'';
if ($acao == 'salvar'){
    try{
        require_once('../classes/quadro.class.php');
        $quadro = new Quadro($id,$nome);
        if ($id > 0)
            $quadro->editar();
        else
            $quadro->inserir();
        header('location:index.php');   

    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
}else if($acao == 'excluir'){
    try{
        require_once('../classes/quadro.class.php');
        $quadro = new Quadro($id,$nome);
        $quadro->excluir();
        header('location:index.php');   

    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
}
?>  