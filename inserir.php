<?php

include("conecta.php");

$datahoje = $_POST["date"];
$periodo_inicial = $_POST["period_initial"];
$periodo_final = $_POST["period_end"];
$justificativa = $_POST["justification"];

if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) 
{
    echo("TEste");
	$fileTmpPath = $_FILES['document']['tmp_name'];
    $fileType = $_FILES['document']['type'];
    $fileContent = file_get_contents($fileTmpPath);

    // Valida o tipo do arquivo
    if ($fileType === 'application/pdf') 
    {

        // Prepara e executa a inserção
        $stmt = $pdo->prepare("INSERT INTO justificativas(id,`data`,periodo_inicial,periodo_final,justificativa,documento) VALUES ('',:datahoje,:periodo_inicial,:periodo_final,:justificativa,:documento)");
        
        $stmt->bindParam(':datahoje', $datahoje);
        $stmt->bindParam(':periodo_inicial', $periodo_inicial);
        $stmt->bindParam(':periodo_final', $periodo_final);
        $stmt->bindParam(':justificativa', $justificativa);
        $stmt->bindParam(':documento', $fileContent, PDO::PARAM_LOB);

        $stmt->execute();
        header("location: inicial.html"); 

               
    } 
    else 
    {
        echo "Por favor, envie um arquivo PDF.";
    }
}

?>