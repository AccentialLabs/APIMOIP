<?php

/**
  include_once 'examples.php';

  exampleBasicInstructions();
  exampleFull();
  exampleQueryParcels();
 * 

include_once "autoload.inc.php";

$moip = new Moip();
$moip->setEnvironment('teste');
$moip->setCredential(array(
    'key' => 'SKMQ5HKQFTFRIFQBJEOROIGM70I6QVIN9KA5YIWB',
    'token' => 'WOA4NBQ2AUMHJQ2NJIA6Q6X4ECXHFJUR'
));

$moip->setUniqueID(false);
$moip->setValue('100.00');
$moip->setReason('Teste do Moip-PHP');

$moip->validate('Basic');

$moip->send();
echo '<Pre>';
print_r($moip->getAnswer());
*/

include_once "autoload.inc.php";
if($_GET){
 	

  $moip = new Moip();
    $moip->setEnvironment('sandbox');
    $moip->setCredential(array(
        'key' => 'SKMQ5HKQFTFRIFQBJEOROIGM70I6QVIN9KA5YIWB',
        'token' => 'WOA4NBQ2AUMHJQ2NJIA6Q6X4ECXHFJUR'
    ));

    
 	$moip->setUniqueID('6');
    $moip->setValue('100.00');
    $moip->setReason('OUTROS TESTES AGAGAGAG');

    $moip->setPayer(array('name' => 'Nome Sobrenome',
        'email' => 'email@cliente.com.br',
        'payerId' => 'id_usuario',
        'billingAddress' => array('address' => 'Rua do Zézinho Coração',
            'number' => '45',
            'complement' => 'z',
            'city' => 'São Paulo',
            'neighborhood' => 'Palhaço Jão',
            'state' => 'SP',
            'country' => 'BRA',
            'zipCode' => '01230-000',
            'phone' => '(11)8888-8888')));
    $moip->validate('Identification');
   

    $moip->send();
    $token = $moip->getAnswer()->token;
  /*  echo '<Pre>';
    print_r($moip->getAnswer());
    

    echo '<Pre>';
    print_r($moip->send());
    
    echo '<Pre>';
    print_r($moip->getXML());
    
    
    //echo "<Br>".$token;exit;
*/
    //header('LOCATION:https://desenvolvedor.moip.com.br/sandbox/Instrucao.do?token='.$token);
    
}
//echo $token;exit;
?>
<!DOCTYPE html>
<html lang="pt-br">
  <header>
    <title>Transparente Teste</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />
  </header>

  <body>

    <div class="row-fluid">
      <div class="span1">&nbsp;</div>
      <div class="span10">

        <div class="page-header">
          <h1>Pagamento Transparente</h1>
          <br>
          
          <!-- 
          <h3>Token da Instru&ccedil;&atilde;o que deseja executar</h3>
          <input type="text" id="token" class="span6">
          <div id="MoipWidget" data-token="02K0Y1I2T0R5D1N0V1W5B03320Z9R0I7K8B080T000P0C090P4P410R5X503" callback-method-success="sucesso" callback-method-error="erroValidacao"></div>
          <button class="btn" id="trocar-token">Aplicar Token</button>
		- -->
 		<div id="MoipWidget" data-token="<?php echo $token; ?>" callback-method-success="sucesso" callback-method-error="erroValidacao"></div>       

       </div><!-- FIM HEADER -->
        
        <ul id="tabs" class="nav nav-tabs">
          <li><a href="#card" data-toggle="tab">Pagamento com Cart&atilde;o</a></li>
          <li><a href="#vault" data-toggle="tab">Pagamento com Cofre</a></li>
          <li><a href="#boleto" data-toggle="tab">Pagamento com Boleto</a></li>
          <li><a href="#debito" data-toggle="tab">Pagamento com D&eacute;bito</a></li>
          <li><a href="#parcelamento" data-toggle="tab">Calculo Parcelamento</a></li>
        </ul>

        <!-- Exibe Resultado -->
        <div id="resultado" class="alert">
        </div>

        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade" id="card">
              <div class="well">
                <label>Parcelas:</label>
                <input type="text" id="Parcelas" name="Parcelas" value="1" size="2">

                <label>Institui&ccedil;&atilde;o:</label>
                <select id="instituicao">
                  <option value="Visa">Visa</option>
                  <option value="Mastercard">Mastercard</option>
                  <option value="AmericanExpress">AmericanExpress</option>
                  <option value="Invalido">Invalido</option>
                </select>

                <label>Numero do Cart&atilde;o:</label>
                <input type="text" id="Numero" name="Numero" value="4073020000000002">

                <label>Expira&ccedil;&atilde;o:</label>
                <input type="text" id="Expiracao" name="Expiracao" value="10/13" size="5">

                <label>CVV:</label>
                <input type="text" id="CodigoSeguranca" name="CodigoSeguranca" value="123" size="4">

                <label>Portador:</label>
                <input type="text" id="Portador" name="Portador" value="Lyoto Machida">

                <label>CPF:</label>
                <input type="text" id="CPF" name="CPF" value="888.457.824-84">

                <label>Data Nascimento:</label>
                <input type="text" id="DataNascimento" name="DataNascimento" value="17/11/1988"><br>

                <label>Telefone:</label>
                <input type="text" id="Telefone" name="Telefone" value="(12)9999-9999"><br>

                <label></label>
                <button id="sendToMoip" class="btn"> Enviar para o Moip</button>
              </div>
            </div>

            <div class="tab-pane fade" id="vault">
              <div class="well">
                <label>Parcelas:</label>
                <input type="text" id="Parcelas" name="Parcelas" value="1" size="2">

                <label>Cofre:</label>
                <input type="text" id="Cofre" name="Cofre" value="07e3b5df-652d-48d7-8f37-be355f3824b3">

                <label>CVV:</label>
                <input type="text" id="CodigoSeguranca" name="CodigoSeguranca" value="123" size="4"/><br>

                <button id="sendToCofre" class="btn"> Enviar para o Moip </button>
              </div>
            </div>

            <div class="tab-pane fade" id="boleto">
              <div class="well">
                <input type="button" id="boleto" class="btn" value="Boleto Banc&aacute;rio">
                
              </div>
            </div>
            <div id="link-boleto">
            </div>	

            <div class="tab-pane fade" id="debito">
              <div class="well">
                <input type="button" class="btn" id="debit" value="D&eacute;bito">               
              </div>
            </div><!-- debito -->
			<div id="link-debito">
            </div>
             
            <div class="tab-pane fade" id="parcelamento">
              <div class="well">
                <label>Informe a Bandeira para calcular a taxa:</label>
                <select id="instituicao-calc-parcela">
                  <option value="Visa">Visa</option>
                  <option value="Mastercard">Mastercard</option>
                </select>
                <br>
                <button class="btn" id="calcular-btn">Calcular</button>
              </div>
            </div>
        </div>

        <hr>
      </div>
      <div class="span1">&nbsp;</div>

    </div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-tab.js"></script>
    <script type="text/javascript" src="js/bootstrap-modal.js"></script>
    <script type="text/javascript" src="google-code-prettify/prettify.js"></script>
    <script type='text/javascript' src="https://desenvolvedor.moip.com.br/sandbox/transparente/MoipWidget-v2.js"></script>
    <script type="text/javascript" src="js/transparente.js"></script>
  </body>
</html>
