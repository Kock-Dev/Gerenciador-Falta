<?php

include("conecta.php");

// Defina o ID do PDF a ser baixado
$id = $_GET['id']; // Você pode substituir isso por $_GET['id'] quando estiver em produção

try {
    // Busca o PDF no banco de dados
    $stmt = $pdo->prepare("SELECT documento FROM justificativas WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    $pdf = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($pdf) {
        // Verifique se o conteúdo do arquivo PDF é válido
        if ($pdf['documento'] !== false) {
            // Define os cabeçalhos para download
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $id . '.pdf"');
            header('Content-Length: ' . strlen($pdf['documento']));
            echo $pdf['documento'];
            exit;
        } else {
            echo "Erro ao ler o conteúdo do PDF.";
        }
    } else {
        echo "PDF não encontrado.";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
