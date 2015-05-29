<?php 	
	/*
	$array = array('secureNumbers'=>time());
	$array = json_encode($array);
	$token = base64_encode($array);
	
	//pegando dados da compra efetuada
	$arrayParams = array(
			  'User'=>array(			   			   
			  )			  	 
			 );

	$params = json_encode($arrayParams);	
	$params = array('params'=>$params);		 
	
	$cURL = curl_init('https://secure.trueone.com.br/t1core/users/get/first/'.$token);
						   	
	curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($cURL, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($cURL, CURLOPT_POST, 1);
	curl_setopt($cURL, CURLOPT_POSTFIELDS, $params);
	$resultado = curl_exec($cURL);
	curl_close($cURL);
	
	$base64Decode = base64_decode($resultado);
	$data = json_decode($base64Decode, true);
	echo '<Pre>';print_r($data);exit;
	*/
	
	
	$login = $_POST['login'];
	$cnpj = $_POST['cnpj'];
	$cnpj = mask($cnpj,'##.###.###/####-##');
	
	if(isset($login)){		
		// Aqui vem sua programação para receber as variáveis e tratar, seja gravando ou exibindo.
		
		//fazendo atualizacao do arquivo retorno	
		$sql = mysql_query("UPDATE companies set login_moip='{$login}' where cnpj = '{$cnpj}'");
		
	}
	
?>