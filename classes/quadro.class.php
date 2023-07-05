<?php
require_once ('../classes/circulo.class.php');
require_once ('../classes/database.class.php');
require_once ('../classes/quadrado.class.php');
require_once ('../classes/retangulo.class.php');
require_once ('../classes/triangulo.class.php');
class Quadro{
    private $id;
    private $nome;
    private $formas;
    
    public function __construct($id, $nome){
        $this->setId($id);
        $this->setNome($nome);
        $this->formas = array();
    }

    

    public function setId($id){
        $this->id = $id;
    }

    public function setNome($nome){
         $this->nome = $nome; 
    }

    
    
    public function getNome(){
        return $this->nome;
    }

    public function getId(){
        return $this->id;
    }
    
    public function addForma(Forma $forma){
        $this->formas[] = $forma;
    }

    public function listarFormas(){
        
        $circulo = new Circulo("", 1, "x", "x",0);
        $lista = $circulo->listar(3, $this->getId());
        foreach($lista as $item){
            $q = new Circulo($item['idcirculo'],$item['raio'],$item['cor'],$item['un'],$item['idquadro']);
            echo $q->desenhar();
        }

        
        $quadrado = new Quadrado('',1,'x','x',0);
        $lista = $quadrado->listar(3, $this->getId());
        foreach($lista as $item){
            $q = new Quadrado($item['idquadrado'],$item['lado'],$item['cor'],$item['un'],$item['idquadro']);
            echo $q->desenhar();
        }

        
        $retangulo = new Retangulo('',1,1,'x','x',0);
        $lista = $retangulo->listar(3, $this->getId());
        foreach($lista as $item){
            $q = new Retangulo($item['idretangulo'],$item['altura'],$item['base'],$item['cor'],$item['un'],$item['idquadro']);
            echo $q->desenhar();
        }

        
        $triangulo = new Triangulo('',1,1,1,'x','x',0);
        $lista = $triangulo->listar(3, $this->getId());
        foreach($lista as $item){
            $q = new Triangulo($item['idtriangulo'],$item['lado1'],$item['lado2'],$item['lado3'],$item['cor'],$item['un'],$item['idquadro']);
            echo $q->desenhar();
        }

    }
    public function inserir(){
        $sql = 'INSERT INTO quadro (nome)
                     VALUES (:nome)';
        $params = array(':nome'=>$this->getNome());
       
       return Database::executar($sql, $params);
    }

    public function excluir(){
        $sql = 'DELETE FROM quadro 
                 WHERE idquadro = :id';         
        $params = array(':id'=>$this->getId());         
        return Database::executar($sql, $params);
    }

    public function editar(){
        $sql = 'UPDATE quadro
                   SET nome = :nome
                 WHERE   idquadro = :id';
        $params = array(':id'=>$this->getId(),
                        ':nome'=> $this->getNome());
       return Database::executar($sql, $params);
       
    }
    public function listar($tipo = 0, $info = ''){
        $sql = 'SELECT * FROM quadro';
        switch($tipo){
            case 1: $sql .= ' WHERE idquadro = :info'; break;
        }           
        $params = array();
        if ($tipo > 0)
            $params = array(':info'=>$info);         
        return Database::listar($sql, $params);
     }
}

?>