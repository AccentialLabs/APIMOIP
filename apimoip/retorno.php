<?php

function logT1($data) {
    $f = fopen('log_trueone_moip', 'a');
    fwrite($f, date('d/m - H:i:s ') . $data . "\n");
    fclose($f);
}

require_once('email.php');
require_once('mask.php');

//conex�o com o servidor
$conect = mysql_connect("lmglmecath661.cpzloprsbsei.sa-east-1.rds.amazonaws.com", "accdbadmin", "ACCdB1000");
//$conect = mysql_connect("localhost", "trueo846", "14t9bj8pOL");
// Caso a conex�o seja reprovada, exibe na tela uma mensagem de erro
if (!$conect)
    die("<h1>Falha na conex�o com o Banco de Dados!</h1>");

// Caso a conex�o seja aprovada, ent�o conecta o Banco de Dados.	
$db = mysql_select_db("accdb_labs");

//logT1("[MOIP] Acessou o arquivo de retorno. \n");
# include de arquivos dependendo do tipo de retorno: transa��o de compra ou cadastramento de empresa
if (!empty($_POST['cod_moip'])) {

    require_once('pagamento.php');
} elseif ($_POST['id_redirecionamento']) {

    require_once('cadastro.php');
} else {
    header('Location:http://trueone.com.br');
}
?>