<?php
    include("conecta.php");

    $user = $_POST['user'];
    $senha = $_POST['password'];

    $comando = $pdo->prepare("SELECT * FROM usuarios WHERE nome = '$user' AND senha='$senha'");
    $resultado = $comando->execute();
    $achou = 0;
    while($linha = $comando->fetch()) {
        $achou = 1;
    }
    if ($achou == 1){
        header("location: just.php"); 
    }
    else {
        header("location: adm.html");
    }
?>