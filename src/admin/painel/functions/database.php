<?php

/*
 * @author Matheus Gomes
 * Projeto: Módulo 04 Php Foundation
 * Arquivo: database.php
 * Linguagem: php
 * Data: 05/01/2015
 */

// Função conectar DB
function conectarDb() {
    require_once __DIR__ . "/../../../config.php";
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

// Função listar DB
function listar($tabela) {
    $pdo = conectarDb();

    try {
        $listar = $pdo->prepare("SELECT * FROM $tabela");
        $listar->execute();
        $dados = $listar->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | Linha: {$e->getLine()}");
    }
    return $dados;
}

// Função deletar DB
function deletar($tabela, $id) {
    $pdo = conectarDb();

    try {
        $deletar = $pdo->prepare("DELETE FROM {$tabela} WHERE id = :id");
        $deletar->bindValue(":id", $id);
        $deletar->execute();
    } catch (PDOException $e) {
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | Linha: {$e->getLine()}");
    }
}

// Função listar pelo id DB
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

function atualizar() {
    if (isset($_POST['alterar'])) {
        $id = addslashes(trim($_POST['id']));
        $pagina = addslashes(trim($_POST['pages']));
        $titulo = addslashes(trim($_POST['titulo']));
        $contPrinc = addslashes(trim($_POST['principal']));
        $conteudo = addslashes(trim($_POST['editor1']));

        try {
            $pdo = conectarDb();
            $atualizar = $pdo->prepare("UPDATE pages SET pages = :pages, conteudo_titulo = :conteudo_titulo, "
                    . "conteudo_principal = :conteudo_principal, conteudo_content = :conteudo_content WHERE id = :id");
            $atualizar->bindValue(":pages", $pagina);
            $atualizar->bindValue(":conteudo_titulo", $titulo);
            $atualizar->bindValue(":conteudo_principal", $contPrinc);
            $atualizar->bindValue(":conteudo_content", $conteudo);
            $atualizar->bindValue(":id", $id);
            $atualizar->execute();
        } catch (PDOException $e) {
            die("Error: Código: {$e->getCode()} <br> Mensagem: {$e->getMessage()} <br>  Arquivo: {$e->getFile()} <br> Linha: {$e->getLine()}");
        }
    } else {
        echo "ERROR: Erro ao alterar!";
    }
}

// Função cadastrar DB
function cadastrar($tabela, $dadosCadastrar) {
    $pdo = conectarDb();
    $campos = count($dadosCadastrar);

    try {
        $cadastrar = $pdo->prepare("INSERT INTO {$tabela} (nome, email, senha) VALUES (?, ?, ?)");
        for ($i = 0; $i < $campos; $i ++):
            $cadastrar->bindValue($i + 1, $dadosCadastrar[$i]);
        endfor;
        $cadastrar->execute();
    } catch (PDOException $e) {
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | Linha: {$e->getLine()}");
    }
}

// função para cryptografia de senha
function passCrypt($senha) {
    $senhaCrypt = password_hash($senha, PASSWORD_DEFAULT);
    return $senhaCrypt;
}

// função para pegar senha
function password() {
    $dados = listar('admin');
    foreach ($dados as $key => $value) {
        return $value['senha'];
    }
}

// Função logar no painel administrativo
function logarsistema($user) {
    $pdo = conectarDb();
    try {
        $login = $pdo->prepare("SELECT * FROM admin WHERE login = :login");
        $login->bindValue(":login", $user);
        $login->execute();
        return ($login->rowCount() == 1) ? true : false;
    } catch (PDOException $e) {
        die("Error: Código: {$e->getCode()} <br> Mensagem: {$e->getMessage()} <br>  Arquivo: {$e->getFile()} <br> Linha: {$e->getLine()}");
    }
}
