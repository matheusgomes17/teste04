$(document).ready(function () {
    $("#formularioContato").validate({
        // Define as regras
        rules: {
            nome: {
                // Nome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, minlength: 2
            },
            email: {
                // Email será obrigatório (required) e precisará ser um e-mail válido (email)
                required: true, email: true
            },
            assunto: {
                // Assunto será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, minlength: 2
            },
            mensagem: {
                // Mensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, minlength: 2
            }
        },
        // Define as mensagens de erro para cada regra
        messages: {
            nome: {
                required: "Digite o seu nome",
                minLength: "O seu nome deve conter, no mínimo, 2 caracteres"
            },
            email: {
                required: "Digite o seu e-mail para contato",
                email: "Digite um e-mail válido"
            },
            assunto: {
                required: "Digite o assunto",
                minLength: "A sua mensagem deve conter, no mínimo, 2 caracteres"
            },
            mensagem: {
                required: "Digite a sua mensagem",
                minLength: "A sua mensagem deve conter, no mínimo, 2 caracteres"
            }
        }
    });
});