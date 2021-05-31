<!DOCTYPE html>
<?php
    
    $a1 = isset($_POST['a1']) ? $_POST['a1'] : 0;
    $razao = isset($_POST['razao']) ? $_POST['razao'] : 0;
    $quantElementos = isset($_POST['quantElementos']) ? $_POST['quantElementos'] : 0;
    $paOuPg = isset($_POST['paOuPg']) ? $_POST['paOuPg'] : "";
    $nomeArquivo = (isset($_POST['nomeArquivo']) ? $_POST['nomeArquivo'] : "") .".json";
    $resultado = array();

    $dadosJson = array (
        "a1" => $a1,
        "razao" => $razao,
        "quantElementos" => $quantElementos,
        "paOuPg" => $paOuPg,
        "resultado" => $resultado
    );

    if($paOuPg == "pa"){
        calcularPA($a1, $razao, $quantElementos);

    } else if($paOuPg == "pg"){
        calcularPG($a1, $razao, $quantElementos);
    }

    function calcularPA($a1, $razao, $quantElementos){

        for($k = 1; $k <= $quantElementos; $k++){
            $resultado[$k] = $a1 + ($k - 1) * $razao;
        }
    }

    function calcularPG($a1, $razao, $quantElementos){

        for($k = 1; $k <= $quantElementos; $k++){
            $resultado[$k] = $a1 * pow($razao, ($k - 1));
        }
    }

    $json = json_encode($dadosJson);
    $arquivoJson = fopen($nomeArquivo, 'w');
    fwrite($arquivoJson, $json);
    fclose($arquivoJson);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>

    .div-criar-json {
        width: 20%;
        position: relative;
        top: 25px;
        left: 25px;
    }

    .criar-arquivo-json {
        display: flex;
        flex-direction: column;
        align-items: left;
    }

    .label {
        margin-top: 5px;
    }

</style>
<body>
    
    <div class="div-criar-json">
        <form action="" method="post" class="criar-arquivo-json">
            <label for="a1" class="label">Informe o a1(Valor inicial): </label>
            <input type="text" name="a1" id="a1">

            <label for="a1" class="label">Informe a razão: </label>
            <input type="text" name="razao" id="razao">

            <label for="a1" class="label">Informe a quantidade de elementos: </label>
            <input type="text" name="quantElementos" id="quantElementos">

            <label for="a1" class="label">Informe se é pa ou pg: </label>
            <select name="paOuPg" name="paOuPg" id="paOuPg">
                <option value=""></option>
                <option value="pa">PA</option>
                <option value="pg">PG</option>
            </select>

            <label for="nomeArquivo" class="label">Informe o nome do arquivo: </label>
            <input type="text" id="nomeArquivo">

            <input type="submit" class="label" name="submit1" id="submit1" value="Gerar Json">
        </form>

    </div>

    <?php
        
    ?>
</body>
</html>