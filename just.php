<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="base.css">
    <link rel="stylesheet" href="just.css">
    <title>Justificativas Enviadas - JustCode</title>
</head>
<body>
    <header class="cabecalho">
        <h1 class="h1">JustCode</h1>
    </header>

    <div class="container">
        <div class="lista">
            <h1 class="lista_h1">Lista de Justificativas</h1>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Data</th>
                            <th>Período Inicial</th>
                            <th>Período Final</th>
                            <th>Justificativa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("conecta.php");

                        $comando = $pdo->prepare("SELECT * FROM justificativas");
                        $resultado = $comando->execute();
                        while($linha = $comando->fetch())
                        {
                            $id = $linha['id'];
                            $data = $linha['data'];
                            $nova_data = date("d/m/Y", strtotime($data));
                            $inicial = $linha['periodo_inicial'];
                            $final = $linha['periodo_final'];
                            $just = $linha['justificativa'];
                            echo("
                            <tr>
                                <td><a href='baixar_pdf.php?id=$id'>$id</a></td>
                                <td>$nova_data</td>
                                <td>$inicial</td>
                                <td>$final</td>
                                <td>$just</td>
                            </tr>
                            ");
                        }
                        ?>
                    </tbody>
                </table>
        </div>
    </div>

    <footer class="rodape"></footer>
</body>
</html>