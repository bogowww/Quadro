<?php

class Database{
    public static function conectar(){
        try{
            require_once('../config/config.inc.php');
            $conexao = new PDO(MYSQL_DSN,MYSQL_USUARIO,MYSQL_SENHA );
            return $conexao;
        }catch(PDOException $e){
            echo "Erro ao conectar com o banco de dados $e. Verifique os parâmetros de configuração.";
        }
    }

    public static function executar($sql,$params = array()){
        $conexao = self::conectar();
        $comando = self::preparar($conexao, $sql, $params);
        return $comando->execute();
    }
    
    public static function listar($query, $params = []) {
        try {
            $pdo = self::conectar();
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return null;
        }
    }    

    public static function preparar($conexao, $sql, $params = array()){
        $comando = $conexao->prepare($sql);
        foreach($params as $chave=>$valor){
            $comando->bindValue($chave,$valor);
        }
        return $comando;
    }
}


?>