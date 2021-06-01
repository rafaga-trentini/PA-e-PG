<!DOCTYPE html>
<?php
    
    $a1 = isset($_POST['a1']) ? $_POST['a1'] : 0;
    $razao = isset($_POST['razao']) ? $_POST['razao'] : 0;
    $quantElementos = isset($_POST['quantElementos']) ? $_POST['quantElementos'] : 0;
    $paOuPg = isset($_POST['paOuPg']) ? $_POST['paOuPg'] : "";
    $nomeArquivo = (isset($_POST['nomeArquivo']) ? $_POST['nomeArquivo'] : "") .".json";

    $arquivoDoUpload = isset($_POST['uploadJson']) ? $_POST['uploadJson'] : "";

    if($paOuPg == "pa"){
        $resultado = array();
        for($k = 1; $k <= $quantElementos; $k++){
            $resultado[$k] = $a1 + ($k - 1) * $razao;
        }
        $dadosJson = array (
            "a1" => $a1,
            "razao" => $razao,
            "quantElementos" => $quantElementos,
            "paOuPg" => $paOuPg,
            "resultado" => $resultado
        );
        gerarJson($dadosJson, $nomeArquivo);

    } else if($paOuPg == "pg"){
        $resultado = array();
        for($k = 1; $k <= $quantElementos; $k++){
            $resultado[$k] = $a1 * pow($razao, ($k - 1));
        }
        $dadosJson = array (
            "a1" => $a1,
            "razao" => $razao,
            "quantElementos" => $quantElementos,
            "paOuPg" => $paOuPg,
            "resultado" => $resultado
        );
        gerarJson($dadosJson, $nomeArquivo);
    }

    function gerarJson($dadosJson, $nomeArquivo) {
        $json = json_encode($dadosJson);
        $arquivoJson = fopen($nomeArquivo, 'w');
        fwrite($arquivoJson, $json);
        fclose($arquivoJson);
    }
    
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
                <input type="file" name="uploadJson" id="uploadJson">
                <input type="submit" class="label" name="submitUpload" id="submitUpload" value="Upload Arquivo">
            </form>

            <?php
                if(file_exists($arquivoDoUpload)) {
                    $pegarValoresJson = file_get_contents($arquivoDoUpload);
                    $dadosUploadJson = json_decode($pegarValoresJson);

                    echo "<br>A1(Valor inicial): ".$dadosUploadJson->a1;
                    echo "<br>Razão: ".$dadosUploadJson->razao;
                    echo "<br>Quantidade de elementos: ".$dadosUploadJson->quantElementos;
                    echo "<br>PA ou PG: ".$dadosUploadJson->paOuPg;
                    echo "<br>Resultados progressão: ";
                    foreach($dadosUploadJson->resultado as $valor) {
                        echo $valor." ";
                    }

                    $soma = 0;
                    foreach($dadosUploadJson->resultado as $valor) {
                        $soma = $soma + $valor;
                    }

                    $media = $soma / $dadosUploadJson->quantElementos;

                    $mediana = 0;
                    if ($dadosUploadJson->quantElementos % 2 == 0) {
                        $mediana = ($dadosUploadJson->resultado[$dadosUploadJson->quantElementos / 2 - 1] + $dadosUploadJson->resultado[$dadosUploadJson->quantElementos / 2]) / 2;
                    } else {
                        $cont = 0;
                        $array = array();
                        foreach($dadosUploadJson->resultado as $valor) {
                            $array[$cont] = $valor;
                            $cont += 1;
                        }
                        $mediana = $array[intdiv($dadosUploadJson->quantElementos, 2)];
                    }

                    echo "<br>Somatória: ".$soma;
                    echo "<br>Média: ".$media;
                    echo "<br>Mediana: ".$mediana;

                    $arquivoDoUpload = "";
                } else {
                    echo "<br>Arquivo não encontrado";
                }
            ?>

        </div>
    </div>
</body>
</html>