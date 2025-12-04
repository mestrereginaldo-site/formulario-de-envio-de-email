<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Coleta e sanitiza os dados do formulário
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $assunto = htmlspecialchars($_POST['assunto']);
    $mensagem = htmlspecialchars($_POST['mensagem']);

    // 2. Configurações do e-mail
    $destinatario = "contato@contratosexpresso.com.br"; // Substitua pelo seu endereço de e-mail
    $assunto_email = "Nova mensagem de contato: $assunto";
    
    $corpo_email = "
        <html>
        <head>
          <title>Contato do Site</title>
        </head>
        <body>
          <h2>Detalhes do Contato</h2>
          <p><strong>Nome:</strong> $nome</p>
          <p><strong>E-mail:</strong> $email</p>
          <p><strong>Mensagem:</strong><br>$mensagem</p>
        </body>
        </html>
    ";

    // 3. Cabeçalhos para formatar o e-mail como HTML
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $nome <$email>" . "\r\n";

    // 4. Envia o e-mail
    if (mail($destinatario, $assunto_email, $corpo_email, $headers)) {
        echo "<h1>E-mail enviado com sucesso!</h1>";
        echo "<p>Obrigado por entrar em contato, $nome. Em breve responderemos.</p>";
        echo "<a href='index.html'>Voltar ao formulário</a>";
    } else {
        echo "<h1>Erro ao enviar e-mail.</h1>";
        echo "<p>Por favor, tente novamente mais tarde.</p>";
        echo "<a href='index.html'>Voltar ao formulário</a>";
    }

} else {
    // Se a página for acessada diretamente sem POST
    echo "Acesso inválido ao script de envio.";
}
?>
