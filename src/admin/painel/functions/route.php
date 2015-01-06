<?php

/*
 * @author Matheus Gomes
 * Projeto: Módulo 04 Php Foundation
 * Arquivo: route.php
 * Linguagem: php
 * Data: 05/01/2015
 */

function route() {
    $route = parse_url("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    $path = $route['path'];
    $path = explode('/', $path);
    $pagina = $path[3];
    $permission = array('alterarPages', 'listarPages');
    if (empty($pagina)) {
        return("pages/listarPages.php");
    } elseif ($pagina == 'alterarPages') {
        return("pages/alterarPages.php");
    } elseif ($pagina == 'gravar') {
        return("pages/gravar.php");
    } else {
        return("pages/listarPages.php");
    }
}
