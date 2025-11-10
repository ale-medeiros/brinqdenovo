<?php
$secret = "R3b3c4@310819Brinq";

// validação do GitHub
$headers = getallheaders();
$payload = file_get_contents("php://input");
$signature = "sha256=" . hash_hmac("sha256", $payload, $secret);

if (!hash_equals($signature, $headers["X-Hub-Signature-256"] ?? "")) {
  http_response_code(403);
  exit("Acesso negado");
}

// executa git pull
exec('cd ~/domains/brinqdenovo.com.br/public_html && git pull 2>&1', $output);
echo implode("\n", $output);
?>