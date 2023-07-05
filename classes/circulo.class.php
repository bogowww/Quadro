<?php
require_once ('../classes/forma.class.php');
require_once ('../classes/database.class.php');
    
class Circulo extends Forma{
    private $quadro;
    private $raio;

     
    public function __construct($id, $raio, $cor, $un, $qd){
        $this->setQuadro($qd);
        parent::__construct($id, $raio, $cor, $un);
    }


     public function setQuadro($qd){
            $this->quadro = $qd;
    }


    public function getQuadro(){
        return $this->quadro;
    }

    public function setRaio($raio){
        $this->raio = $raio;
    }


    public function getRaio(){
        return $this->raio;
    }

     public function inserir(){
         $sql = 'INSERT INTO circulo (raio, cor, un, idquadro)
                      VALUES (:raio, :cor, :un, :idquadro)';
         $params = array(':raio'=>$this->getLado(),
                         ':cor'=>$this->getCor() ,
                         ':idquadro'=>$this->getQuadro() ,
                         ':un'=>$this->getUn());
        
        return Database::executar($sql, $params);
     }

     public function editar(){
         $sql = 'UPDATE circulo
                    SET raio = :raio,
                        cor  = :cor,
                        un   = :un,
                        idquadro = :idquadro
                  WHERE   idcirculo = :id';
         $params = array(':id'=>$this->getId(),
                         ':raio'=> $this->getLado(),
                         ':cor'=> $this->getCor(),
                         ':idquadro'=>$this->getQuadro(),
                         ':un'=> $this->getUn());

        return Database::executar($sql, $params);
        
     }

     public function excluir(){
        $sql = 'DELETE FROM circulo 
                 WHERE idcirculo = :id';         
        $params = array(':id'=>$this->getId());         
        return Database::executar($sql, $params);
    }

     public function listar($tipo = 0, $info = ''){
        $sql = 'SELECT * FROM circulo';
        switch($tipo){
            case 1:
                 $sql .= ' WHERE idcirculo = :info';
                  break;
            case 2:
                 $sql .= ' WHERE cor like :info';
                   break;
            case 3:
                 $sql .= ' WHERE idquadro = :info';
                  break;

        }           
        $params = array();
        if ($tipo > 0) {
            $params = array(':info' => $info);
        }

        return Database::listar($sql, $params);
    }

     public function desenhar(){
        $desenho = "<div draggable='true' class='desenho' 
                    style='width: {$this->getLado()}{$this->getUn()};
                    height: {$this->getLado()}{$this->getUn()};
                    border-radius: 50%;
                    background-color: {$this->getCor()};'></div>";
        return $desenho;
     }

     public function calcularArea(){
      return $this->getLado()*$this->getLado();
     }

     public function calcularPerimetro()
    {
        return 2 * pi() * $this->getRaio();
    }

}

?>