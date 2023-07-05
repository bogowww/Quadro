<?php
abstract class Forma{

    private $id = 0;    // int
    private $lado;      // int
    private $cor;       // string
    private $un;        // string

    public function __construct($pid, $plado, $pcor, $pun){
       $this->setId($pid);
       $this->setLado($plado);
       $this->setCor($pcor);
       $this->setUn($pun);
    }

    public function setUn($un){
        if ($un != '')
           $this->un = $un;
        else
           throw new Exception('Unidade de medida inválida. Selecione uma unidade válida SEU BURRO.'); 
    }


    public function getId(){
       return $this->id;
    }

    public function getUn(){
        return $this->un;
    }
    
    public function getLado(){
       return $this->lado;
    }
    
    public function getCor(){
        return $this->cor;
    }

   
    public function setId($id){
       $this->id = $id;
    }


    public function setLado($lado){
       if ($lado > 0)
           $this->lado = $lado;
       else
           throw new Exception('Lado do quadrado inválido. Informe um valor maior que 0 seu imbecil q q faz um quadrado com 0.');
        
    }

    public function setCor($cor){
       if ($cor != '')
           $this->cor = $cor;
       else
           throw new Exception('ESQUECEU DA COR OH IDIOTA');         
    }
}
  
?>