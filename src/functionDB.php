<?php
/*
 * @author Matheus Gomes
 * Projeto: Módulo 03 Php Foundation
 * Arquivo: functionDB.php
 * Linguagem: php
 * Data: 04/01/2015
 * 
 * Funções PDO - Banco de Dados 
 */

// Conectar ao banco de dados
function conectarDb() {
    require_once 'config.php';
    try {
        $dns = DB_TYPE . ":host=" . DB_HOST . ";dbname=INFORMATION_SCHEMA";
        $pdo = new \PDO($dns, DB_USER, DB_PASS);
        $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = :dbname";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':dbname', DB_BASE);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $stmt = null;

        if ($result == 0) {
            $dbName = DB_BASE;
            $sql = "CREATE DATABASE IF NOT EXISTS `{$dbName}` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $pdo = null;
            $dns = null;
            $stmt = null;
        }

        $dns = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_BASE . ';charset=utf8';

        $conn = new \PDO($dns, DB_USER, DB_PASS);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (\PDOException $e) {
        die('Erro código: ' . $e->getCode() . ": " . $e->getMessage());
    }
}

// Cadastrar dados na tabela do banco de dados
function cadastrarDb($tabela, $dadosCadastrar) {
    $pdo = conectarDb();
    $campos = count($dadosCadastrar);
    try {
        $cadastrar = $pdo->prepare("INSERT INTO {$tabela} (pages, conteudo_titulo, conteudo_principal,conteudo_content) VALUES (?, ?, ?,?)");
        for ($i = 0; $i < $campos; $i ++):
            $cadastrar->bindValue($i + 1, $dadosCadastrar[$i]);
        endfor;
        $cadastrar->execute();
    } catch (PDOException $e) {
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | Linha: {$e->getLine()}");
    }
}

function cadastrarDbAdmin($tabela, $dadosCadastrar)
{
    $pdo = conectarDb();
    $campos = count($dadosCadastrar);
    
    try {
        $cadastrar = $pdo->prepare("INSERT INTO {$tabela} (login, email, senha) VALUES (?, ?, ?)");
        for ($i = 0; $i < $campos; $i ++):
            $cadastrar->bindValue($i+1, $dadosCadastrar[$i]);
        endfor;
        $cadastrar->execute();
    } catch (PDOException $e) {
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | Linha: {$e->getLine()}");
    }
}

// Listar dados da tabela do banco de dados
function listarDb($tabela) {
    $pdo = conectarDb();

    try {
        $listar = $pdo->prepare("SELECT * FROM $tabela");
        $listar->execute();
        $dados = $listar->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $exc->getTraceAsString();
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | Linha: {$e->getLine()}");
    }
    return $dados;
}

// Listar dados na tabela pelo ID
function listarId($tabela, $id) {
    $pdo = conectarDb();

    try {
        $listarPeloId = $pdo->prepare("SELECT * FROM {$tabela} WHERE id = :id");
        $listarPeloId->bindValue(":id", $id);
        $listarPeloId->execute();
        $dados = $listarPeloId->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $exc->getTraceAsString();
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | Linha: {$e->getLine()}");
    }
    return $dados;
}

// Atualizar dados na tabela do banco de dados
function atualizarDb($tabela, $dadosAtualizar, $id) {
    $pdo = conectarDb();

    try {
        $atualizar = $pdo->prepare("UPDATE {$tabela} SET conteudo = ? WHERE id = ?");
        $atualizar->bindValue(1, $dadosAtualizar['conteudo']);
        $atualizar->bindValue(2, $id);
        $atualizar->execute();
    } catch (PDOException $e) {
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | Linha: {$e->getLine()}");
    }
}

// Deletar dados pelo ID na tabela do banco de dados
function deletarDb($tabela, $id) {
    $pdo = conectarDb();

    try {
        $deletar = $pdo->prepare("DELETE FROM {$tabela} WHERE id = :id");
        $deletar->bindValue(":id", $id);
        $deletar->execute();
    } catch (PDOException $e) {
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | Linha: {$e->getLine()}");
    }
}

// Listar páginas pelo ID na tabela do banco de dados
function listarPages($tabela, $pages) {
    $pdo = conectarDb();

    try {
        $listarPeloId = $pdo->prepare("SELECT * FROM {$tabela} WHERE pages = :pages");
        $listarPeloId->bindValue(":pages", $pages);
        $listarPeloId->execute();
        $dados = $listarPeloId->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $exc->getTraceAsString();
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | Linha: {$e->getLine()}");
    }
    return $dados;
}
