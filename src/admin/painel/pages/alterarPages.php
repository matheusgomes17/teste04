<?php
/*
 * @author Matheus Gomes
 * Projeto: Módulo 04 Php Foundation
 * Arquivo: alterarPages.php
 * Linguagem: php
 * Data: 05/01/2015
 */

// Faz as alteração nas páginas
$idDaPagina = $_GET['id'];
$pages = listarId('pages', $idDaPagina);
?>
<div class="col-md-9">
    <div class="box">
        <div class="box-header list-group-item active">
            <?php
            if (isset($_POST['alterar'])) {
                atualizar();
                echo "<h3>Página alterada com sucesso!</h3>";
                $refresh = '<meta http-equiv="refresh" content="1; index.php" />';
                exit($refresh);
            }
            ?>
            <?php echo "Página: <strong>" . $pages['pages'] . "</strong> | ID: <strong>" . $pages['id'] . "</strong>"; ?>
        </div>
        <div class=" box-table">
            <form name="form" method="post" action="">
                <input type="hidden" name="id" value="<?php echo strtolower($pages['id']); ?>">
                <div class="form-group">
                    <label>Pagina</label>
                    <input type="text" class="form-control" name="pages" value="<?php echo strtolower($pages['pages']); ?>">
                </div>
                <div class="form-group">
                    <label>Titulo</label>
                    <input type="text" class="form-control" name="titulo" value="<?php echo $pages['conteudo_titulo']; ?>">
                </div>
                <div class="form-group">
                    <label>Conteúdo Principal</label>
                    <input type="text" class="form-control" name="principal" value="<?php echo $pages['conteudo_principal']; ?>">
                </div>
                <div class="form-group">
                    <label>Conteúdo</label>
                    <textarea type="text" class="form-control" name="editor1" value="<?php echo $pages['conteudo_content']; ?>" placeholder="<?php echo $pages['conteudo_content']; ?>"></textarea>
                </div>
                <button class="btn btn-info" type="submit" name="alterar">Alterar</button>
            </form>
        </div>
    </div>
</div>