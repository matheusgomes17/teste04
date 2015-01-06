<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('America/Sao_Paulo');
require_once('../src/functionDB.php');
require_once('../src/functionRouter.php');
require_once('../src/functionBusca.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>3º Projeto php Code Education</title>
        <!-- style -->
        <link rel="stylesheet" href="css/style.css"/>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.min.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                                <span class="sr-only">Alterar a navegação</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="home">LOGO</a>
                        </div>
                        <!-- /navbar-header -->
                        <div class="collapse navbar-collapse col-md-6" id="menu">
                            <ul class="nav navbar-nav">
                                <li><a href="home">Home</a></li>
                                <li><a href="empresa">Empresa</a></li>
                                <li><a href="produtos">Produtos</a></li>
                                <li><a href="servicos">Serviços</a></li>
                                <li><a href="contato">Contato</a></li>
                            </ul>                                                 
                            <div class="col-md-5">
                                <div class="input-group">
                                    <form class="form-inline" name="search" method="post" action="busca">
                                        <div class="form-group">
                                            <input type="text" name="buscar" class="form-control" id="" placeholder="">
                                        </div>
                                        <input type="submit" name="submit" value="Buscar" class="btn">
                                    </form>	<!--/form-->
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-4 -->

                            <ul class="nav navbar-nav col-md-1 admin">
                                <li><a href="admin/index.php">Administração</a></li>
                            </ul>
                        </div>
                        <!-- /collapse navbar-collapse -->
                    </div>
                    <!-- /container-fluid -->
                </nav>
                <!-- /nav -->
            </div>
            <!-- /row nav -->
            <div id="content">