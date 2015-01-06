<?php

if (!isset($_POST['send'])) {
    echo "<section>
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <div class=\"jumbotron\">
                        <h1>Contato</h1>
                        <form name=\"form\" method=\"post\">
                            <div class=\"form-group\">
                                <label>Nome</label>
                                <input type=\"text\" class=\"form-control\" name=\"nome\" placeholder=\"Digite seu nome\">
                            </div>
                            <div class=\"form-group\">
                                <label>E-mail</label>
                                <input type=\"email\" class=\"form-control\" name=\"email\" placeholder=\"Digite seu e-mail\">
                            </div>
                            <div class=\"form-group\">
                                <label>Assunto</label>
                                <input type=\"text\" class=\"form-control\" name=\"assunto\" placeholder=\"Digite o assunto\">
                            </div>
                            <div class=\"form-group\">
                                <label>Mensagem</label>
                                <textarea class=\"form-control\" rows=\"3\" name=\"mensagem\" placeholder=\"Escreva sua mensagem\"></textarea>
                            </div>
                            <button class=\"btn btn-default\" type=\"submit\" name=\"send\">Enviar Dados</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /row section -->
        </section>
        <!-- /section -->";
} else {
    $nome = htmlspecialchars(strip_tags($_POST['nome']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $assunto = htmlspecialchars(strip_tags($_POST['assunto']));
    $mensagem = htmlspecialchars(strip_tags($_POST['mensagem']));
    $refresh = '<meta http-equiv="refresh" content="0; contato" />';

    if ($nome != '' && $email != '' && $assunto != '' && $mensagem != '') {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script type="text/javascript">alert("E-mail inválido!.")</script>';
            exit($refresh);
        } elseif (!filter_var($email, FILTER_SANITIZE_EMAIL)) {
            echo '<script type="text/javascript">alert("E-mail inválido!.")</script>';
            exit($refresh);
        } else {
            echo "<div class=\"jumbotron\"><h1>Dados enviados com sucesso</h1>";
            echo "<div class=\"page-header\"><h2>Abaixo seguem os dados que você enviou</h2></div>";
            echo "<h2>Nome: {$nome}</h2><h2>E-mail: {$email}</h2><h2>Assunto: {$assunto}</h2><h2>Mensagem: {$mensagem}</h2></div></div>";
        }
    } else {
        echo '<script type="text/javascript">alert("Prencha todos os campos!")</script>';
        exit($refresh);
    }
}