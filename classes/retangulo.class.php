<?php
require_once('../classes/forma.class.php');
require_once ('../classes/database.class.php');

class Retangulo extends Forma{
    private $lado2;
    private $quadro;

    public function __construct($id, $lado1, $lado2, $cor, $un, $qd){
        parent::__construct($id, $lado1, $cor, $un);
        $this->setLado2($lado2);
        $this->setQuadro($qd);
    }


    public function getQuadro(){
        return $this->quadro;
    }
    public function getLado1(){
        return parent::getLado();
    }

    public function getLado2(){
        return $this->lado2;
    }


    public function setQuadro($qd){
        $this->quadro = $qd;
    }
    
    public function setLado1($lado1){
        if ($lado1 > 0){
            parent::setLado($lado1);
        }else
            throw new Exception('Valor para o lado 1 inválido.');
    }

    public function setLado2($lado2){
        if ($lado2 > 0){
            $this->lado2 = $lado2;
        }else
            throw new Exception('Valor para o lado 2 inválido.');
    }


    public function inserir(){
        $sql = 'INSERT INTO retangulo (altura, base, cor, un, idquadro)
                     VALUES (:altura, :base, :cor, :un, :idquadro)';
        $params = array(':altura'=>$this->getLado1(),
                        ':base'=>$this->getLado2(),
                        ':cor'=>$this->getCor(),
                        ':idquadro'=>$this->getQuadro(),
                        ':un'=>$this->getUn());
        Database::executar($sql, $params);
    }

    public function excluir(){
        $sql = 'DELETE FROM retangulo 
                 WHERE idretangulo = :id';         
        $params = array(':id'=>$this->getId());         
        return Database::executar($sql, $params);
    }
    public function editar(){
        $sql = 'UPDATE retangulo
                   SET altura = :altura,
                       base = :base,
                       cor  = :cor,
                       un   = :un,
                       idquadro = :idquadro
                 WHERE   idretangulo = :id';
        $params = array(':id'=>$this->getId(),
                        ':altura'=> $this->getLado1(),
                        ':base'=>$this->getLado2(),
                        ':cor'=> $this->getCor(),
                        ':idquadro'=>$this->getQuadro(),
                        ':un'=> $this->getUn());
       return Database::executar($sql, $params);
       
    }
    public function desenhar(){
        $desenho = "<div draggable='true' class='desenho' 
                    style='width:{$this->getLado2()}{$this->getUn()};
                     height:{$this->getLado1()}{$this->getUn()};
                     background-color:{$this->getCor()}'></div>";
        return $desenho;
     }
    public function listar($tipo = 0, $info = ''){
        $sql = 'SELECT * FROM retangulo';
        switch($tipo){
            case 1: $sql .= ' WHERE idretangulo = :info'; break;
            case 2: $sql .= ' WHERE cor like :info';  break;
            case 3: $sql .= ' WHERE idquadro = :info'; break;
        }           
        $params = array();
        if ($tipo > 0)
            $params = array(':info'=>$info);         
        return Database::listar($sql, $params);
     }
     public function calcularArea(){
        return $this->getLado()*$this->getLado();
       }
  
       public function calcularPerimetro()
      {
          return 4 * $this->getLado();
      }
}
?>