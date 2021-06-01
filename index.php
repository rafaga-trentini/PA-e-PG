<!DOCTYPE html>
<?php
    
    $a1 = isset($_POST['a1']) ? $_POST['a1'] : 0;
    $razao = isset($_POST['razao']) ? $_POST['razao'] : 0;
    $quantElementos = isset($_POST['quantElementos']) ? $_POST['quantElementos'] : 0;
    $paOuPg = isset($_POST['paOuPg']) ? $_POST['paOuPg'] : "";
    $nomeArquivo = (isset($_POST['nomeArquivo']) ? $_POST['nomeArquivo'] : "") .".json";

    if($paOuPg == "pa"){
        $resultado = [];
        for($k = 1; $k <= $quantElementos; $k++){
            $resultado[$k] = $a1 + ($k - 1) * $razao;
        }

    } else if($paOuPg == "pg"){
        $resultado = [];
        for($k = 1; $k <= $quantElementos; $k++){
            $resultado[$k] = $a1 * pow($razao, ($k - 1));
        }
    }

    $dadosJson = array (
        "a1" => $a1,
        "razao" => $razao,
        "quantElementos" => $quantElementos,
        "paOuPg" => $paOuPg,
        "resultado" => $resultado
    );

    $json = json_encode($dadosJson);
    $arquivoJson = fopen($nomeArquivo, 'w');
    fwrite($arquivoJson, $json);
    fclose($arquivoJson);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>

    .label {
        margin-top: 5px;
    }

    .titulo {
        font-size: 28px;
        position: relative;
        left: 20%;
    }

    .div-criar-json {
        width: 20%;
        position: relative;
        top: 25px;
        left: 25px;
        align-items: center;
    }

    .criar-arquivo-json {
        display: flex;
        flex-direction: column;
        align-items: left;
    }

    .div-upload-json {
        width: 20%;
        position: relative;
        top: 25px;
        left: 25px;;
        align-items: center;
    }

</style>
<body>
    <div style="width: 100%;">
        <div class="div-criar-json">
            <h1 class="titulo">Gerar Json</h1>
            <form action="" method="post" class="criar-arquivo-json">
                <label for="a1" class="label">Informe o a1(Valor inicial): </label>
                <input type="text" name="a1" id="a1">

                <label for="razao" class="label">Informe a razão: </label>
                <input type="text" name="razao" id="razao">

                <label for="quantElementos" class="label">Informe a quantidade de elementos: </label>
                <input type="text" name="quantElementos" id="quantElementos">

                <label for="paOuPg" class="label">Informe se é pa ou pg: </label>
                <select name="paOuPg" id="paOuPg">
                    <option value=""></option>
                    <option value="pa">PA</option>
                    <option value="pg">PG</option>
                </select>

                <label for="nomeArquivo" class="label">Informe o nome do arquivo: </label>
                <input type="text" name="nomeArquivo" id="nomeArquivo">

                <input type="submit" class="label" name="submit" id="submit" value="Gerar Json">
            </form>
        </div>

        <div class="div-upload-json">
            <h1>Upload Json</h1>
            <form action="" method="post">
                <input type="file" name="uploadJson">
                <input type="submit" class="label" name="submitUpload" id="submitUpload" value="Upload Arquivo">
            </form>
        </div>
    </div>
</body>
</html>