<?php 

$cod_moip = $_POST['cod_moip'];

//logT1("[moip: {$cod_moip}] chegou no retorno \n");

if(isset($cod_moip)){
	//header("HTTP/1.0 200 OK");

	$id_transacao 			= $_POST['id_transacao'];
	$valor 					= $_POST['valor'];
	$status_pagamento 		= $_POST['status_pagamento'];
	$forma_pagamento 		= $_POST['forma_pagamento'];
	$tipo_pagamento 		= $_POST['tipo_pagamento'];
	$email_consumidor 		= $_POST['email_consumidor'];

	$paymentMethods = array(
		'BoletoBancario' => array(
			'Bradesco' => 1
		),
		'CartaoDeCredito' => array(
			'Visa' => 4,
			'Mastercard' => 2,
			'AmericanExpress' => 5
		)
	);

	$checkoutId = $_POST['id_transacao'];

	$update = array();

	if($_POST['tipo_pagamento'] == 'CartaoDeCredito') {

		$update['payment_method_id'] = $paymentMethods[$_POST['tipo_pagamento']][$_POST['cartao_bandeira']];

	} else if($_POST['tipo_pagamento'] == 'BoletoBancario') {

		$update['payment_method_id'] = $paymentMethods['BoletoBancario']['Bradesco'];
	}

	// tratando valor da compra
	$valorInteiro = substr($_POST['valor'], 0, -2);
	$valorDecimal = substr($_POST['valor'], -2);
	$valor = $valorInteiro.'.'.$valorDecimal;

	$update['total_value'] = $valor;
	$update['transaction_moip_code'] = $_POST['cod_moip'];
	$update['installment'] = $_POST['parcelas'];
	$update['payment_state_id'] = $_POST['status_pagamento'];

	//logT1("[moip: {$cod_moip}] params:".var_dump($update)." \n");

	$updateQuery = '';
	foreach($update as $key => $value) {
		$updateQuery .= "{$key}='{$value}', ";
	}
	$updateQuery = substr($updateQuery, 0, -2);
	
	//logT1("[moip: {$cod_moip}] query: {$updateQuery} \n");

	//fazendo atualizacao do arquivo retorno	
	$sql = mysql_query("UPDATE checkouts set {$updateQuery} where id = {$checkoutId}");
	if($sql) {
		//logT1("[moip: {$cod_moip}] salvou. \n");
	} else {
		//logT1("[moip: {$cod_moip}] nгo salvou \n");
	}
	
	
	$array = array('secureNumbers'=>time());
	$array = json_encode($array);
	$token = base64_encode($array);
	
	//pegando dados da compra efetuada
	$arrayParams = array(
			  'Checkout'=>array(			   
			   'conditions' => array('Checkout.id'=>$checkoutId)
			  ),'Company'=>array(), 
			  	'User'=>array(),
			  	'Offer'=>array(),
			   	'PaymentMethod'=>array()			  	 
			 );

	$jsonParams = json_encode($arrayParams);
	$params = array('params' => $jsonParams);
	
	$cURL = curl_init('https://secure.trueone.com.br/t1core/companies/get/first/'.$token);
						   	
	curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($cURL, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($cURL, CURLOPT_POST, true);
	curl_setopt($cURL, CURLOPT_POSTFIELDS, $params);
	$resultado = curl_exec($cURL);
	curl_close($cURL);
	
	$base64Decode = base64_decode($resultado);
	$data = json_decode($base64Decode, true);
	
	enviaEmail($status_pagamento, $id_transacao, $valor, $data);
		
}else{
	header("HTTP/1.0 404 Not Found");
	//Aqui vem sua programaзгo para exibir alguma coisa, pois nesse caso o POST nгo retornou nenhum cуdigo MoIP.
}

?>