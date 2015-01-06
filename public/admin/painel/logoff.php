<?php

/*
 * @author Matheus Gomes
 * Projeto: Módulo 04 Php Foundation
 * Arquivo: logoff.php
 * Linguagem: php
 * Data: 05/01/2015
 */

// Deloga o usuário
session_start();
unset($_SESSION['loginUser']);
header('Location: ../index.php');
