<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $telefone = trim($_POST["telefone"] ?? "");
    $mensagem = trim($_POST["mensagem"] ?? "");

    // Validação simples
    if (empty($nome) || empty($email) || empty($mensagem)) {
        echo json_encode(["success" => false, "message" => "Por favor, preencha todos os campos obrigatórios."]);
        exit;
    }

    // E-mail de destino
    $to = "seuemail@dominio.com"; // Troque para seu e-mail real
    $subject = "Nova mensagem de contato do site";
    $body = "Nome: $nome\nEmail: $email\nTelefone: $telefone\nMensagem:\n$mensagem";
    $headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";

    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(["success" => true, "message" => "Mensagem enviada com sucesso!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao enviar mensagem. Tente novamente mais tarde."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método de requisição inválido."]);
}
?> 