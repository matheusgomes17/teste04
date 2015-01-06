<?php

/*
 * @author Matheus Gomes
 * Projeto: Módulo 03 Php Foundation
 * Arquivo: fixture.php
 * Linguagem: php
 * Data: 04/01/2015
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('America/Sao_Paulo');
require_once './src/functionDB.php';
require_once './src/config.php';

try {
    echo "##### Executando Fixtures #####\n";
    $dbName = DB_BASE;
    $tableName = DB_TABLE;
    $sqlBD = "CREATE DATABASE IF NOT EXISTS `{$dbName}` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; USE `{$dbName}`";
    echo (executaSQL($sqlBD, null)) ? '- Banco de dados criado com sucesso!' . chr(13) . chr(10) : '- Erro ao tentar criar o banco de dados!' . chr(13) . chr(10);

    $sqlCriaPaginas = "DROP TABLE IF EXISTS `{$tableName}`;
CREATE TABLE IF NOT EXISTS `{$tableName}` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `pages` VARCHAR(50) NOT NULL,
  `conteudo_titulo` VARCHAR(250) NOT NULL,
  `conteudo_principal` TEXT NOT NULL,
  `conteudo_content` TEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;";
    echo (executaSQL($sqlCriaPaginas, null)) ? '- Tabela ' . $tableName . ' criada com sucesso!' . chr(13) . chr(10) : '- Erro ao tentar criar a tabela ' . $tableName . '!' . chr(13) . chr(10);

    $sqlPaginasInsert = "INSERT INTO `{$tableName}` (`id`, `pages`, `conteudo_titulo`, `conteudo_principal`, `conteudo_content`) VALUES
(1, 'home', '3º Projeto - PHP FOUNDATION', 'Página Home', 'Todo conteúdo principal'),
(2, 'empresa', 'Nome da Empresa', 'Página Sobre a Empresa', 'Todo conteúdo'),
(3, 'produtos', 'Página Sobre Produtos', 'Página Sobre Produtos', 'Todo conteúdo'),
(4, 'serviços', 'Página Sobre Serviços', 'Página Sobre Serviços', 'Todo conteúdo'),
(5, '404', 'ERROR: 404', 'ERRO: A página não existe', 'Volte para a <a href=\"home\">Home</a>');";
    echo (executaSql($sqlPaginasInsert)) ? '- Registros inseridos na tabela ' . $tableName . ' com sucesso! ' . chr(13) . chr(10) : '- Erro ao tentar inserir registro na tabela ' . $tableName . '!' . chr(13) . chr(10);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}

try {
    $dbName = DB_BASE;
    $tableName = DB_ADMIN_TABLE;
    $sqlBD = "CREATE DATABASE IF NOT EXISTS `{$dbName}` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; USE `{$dbName}`";
    echo (executaSQL($sqlBD, null)) ? '- Banco de dados atualizado com sucesso!' . chr(13) . chr(10) : '- Erro ao tentar criar o banco de dados!' . chr(13) . chr(10);

    $sqlCriaPaginas = "DROP TABLE IF EXISTS `{$tableName}`;
CREATE TABLE IF NOT EXISTS `{$tableName}` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;";
    echo (executaSQL($sqlCriaPaginas, null)) ? '- Tabela ' . $tableName . ' criada com sucesso!' . chr(13) . chr(10) : '- Erro ao tentar criar a tabela ' . $tableName . '!' . chr(13) . chr(10);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}

//Função para pegar a senha digitada e cadastrar no banco de dados cryptografada
function passCrypt($senha) {
    $senhaCrypt = password_hash($senha, PASSWORD_DEFAULT);
    return $senhaCrypt;
}

//Função para executar um comando SQL
function executaSql($sql) {
    $conn = conectarDb();
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute();
    return ($res) ? true : false;
}

$cadastarDados = array('admin', 'admin@email.com', passCrypt('123456'));
cadastrarDbAdmin('admin', $cadastarDados);
echo "- Registros inseridos com na tabela admin sucesso!\n";
echo "##### Concluido #####\n";
