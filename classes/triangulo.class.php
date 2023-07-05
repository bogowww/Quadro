<?php
require_once ('../classes/forma.class.php');
require_once ('../classes/database.class.php');
class Triangulo extends Forma{
    private $lado1;
    private $lado2;
    private $lado3;
    private $quadro;

    public function __construct($id, $lado1, $lado2, $lado3, $cor, $un, $qd){
        parent::__construct($id, $lado1, $cor, $un);
        $this->setLado2($lado2);
        $this->setLado3($lado3);
        $this->setQuadro($qd);
    }

    public function inserir(){
        $sql = 'INSERT INTO triangulo (lado1, lado2, lado3, cor, un, idquadro)
                     VALUES (:lado1, :lado2, :lado3, :cor, :un, :idquadro)';
        $params = array(':lado1'=>$this->getLado1(),
                        ':lado2'=>$this->getLado2(),
                        ':lado3'=>$this->getLado3(),
                        ':cor'=>$this->getCor(),
                        ':idquadro'=>$this->getQuadro(),
                        ':un'=>$this->getUn());
        Database::executar($sql, $params);
    }

    public function excluir(){
        $sql = 'DELETE FROM triangulo 
                 WHERE idtriangulo = :id';         
        $params = array(':id'=>$this->getId());         
        return Database::executar($sql, $params);
    }
    public function editar(){
        $sql = 'UPDATE triangulo
                   SET lado1 = :lado1,
                       lado2 = :lado2,
                       lado3 = :lado3,
                       cor  = :cor,
                       un   = :un,
                       idquadro = :idquadro
                 WHERE   idtriangulo = :id';
        $params = array(':id'=>$this->getId(),
                        ':lado1'=> $this->getLado1(),
                        ':lado2'=>$this->getLado2(),
                        ':lado3'=>$this->getLado3(),
                        ':cor'=> $this->getCor(),
                        ':idquadro'=>$this->getQuadro(),
                        ':un'=> $this->getUn());
       return Database::executar($sql, $params);
       
    }

    public function calcularPerimetro() {
        return $this->lado1 + $this->lado2 + $this->lado3;
    }

    public function calcularArea() {
        $semiperimetro = $this->calcularPerimetro() / 2;
        $area = sqrt($semiperimetro * ($semiperimetro - $this->lado1) * ($semiperimetro - $this->lado2) * ($semiperimetro - $this->lado3));
        return $area;
    }

    public function setLado1($lado1){
        if ($lado1 > 0){
            parent::setLado($lado1);
        }else
            throw new Exception('Valor para o lado 1 inválido.');
    }

    public function getLado1(){
        return parent::getLado();
    }

    public function setLado2($lado2) {
        $this->lado2 = $lado2;
    }

    public function getLado2() {
        return $this->lado2;
    }

    public function setLado3($lado3) {
        $this->lado3 = $lado3;
    }

    public function getLado3() {
        return $this->lado3;
    }
    public function listar($tipo = 0, $info = ''){
        $sql = 'SELECT * FROM triangulo';
        switch($tipo){
            case 1: $sql .= ' WHERE idtriangulo = :info'; break;
            case 2: $sql .= ' WHERE cor like :info';  break;
            case 3: $sql .= ' WHERE idquadro = :info'; break;
        }           
        $params = array();
        if ($tipo > 0)
            $params = array(':info'=>$info);         
        return Database::listar($sql, $params);
     }
    public function desenhar(){
    $desenho = "<div style='width: 0; 
                    height: 0; 
                    border-left: {$this->getLado1()}{$this->getUn()} solid transparent; 
                    border-right: {$this->getLado2()}{$this->getUn()} solid transparent; 
                    border-bottom: {$this->getLado3()}{$this->getUn()} solid {$this->getCor()};'>
                </div>";
    return $desenho;
    }
    public function setQuadro($qd){
        $this->quadro = $qd;
    }

    public function getQuadro(){
        return $this->quadro;
    }
}
?>