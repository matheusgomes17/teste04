<h1>PHP-Foundation</h1>

<h2>Projeto Fase 04</h3>

<h3>Área administrativa</h3>

Agora que seu projeto possui diversas páginas de conteúdo que vem diretamente de um banco de dados, você tem o seguinte desafio: Deixar todas essas páginas administráveis =)

Crie uma área restrita (onde você precisa de um login e senha). Nessa área você terá acesso a listagem de todas as páginas. Ao clicar na página, você terá opção de editar seu conteúdo através de um editor online (você pode utilizar um de sua preferência como o ckeditor)...

Depois de fazer as alterações, você pode clicar em salvar, para completar a edição de conteúdo da página correspondente. (No momento do salvar, você dará um update no banco de dados).

Se um usuário não autenticado acessar a URL de administração, ele deverá ser redirecionado para uma tela de login para ele se autenticar.

O usuário e senha de autenticação deverão estar gravados no banco de forma segura.

Crie uma fixture para adicionar o usuário e senha.

PS: Basicamente o que estou exigindo a mais é a utilização do editor online... Conte conosco para lhe ajudar a implementar, mas antes quero que você tente por você mesmo...

PSS: Perceba que ao final desse projeto, você terá um site 100% administrável, ou seja, você fará um CMS simples, mas lembre-se, foi você que fez =)

PSSS: Conte conosco SEMPRE!


<h4>Como usar o website</h4>

- Execute o arquivo "fixtures.php" no terminal para criar o banco de dados.
- O arquivo fixture.php, está configurado para servidor local "localhost" com usuário "<b>root</b>" e password "" e os dados para conectar ao painel de controle são login: "<b>admin</b>" e senha: "<b>1234</b>".
- Para mudar as configurações basta alterar no arquivo "<b>src/config.php</b>" e no arquivo "<b>src/admin/painel/functions/config.php</b>".
- Execute o comando "<b>php -S localhost:8090 -t public</b>" para iniciar o servidor.
