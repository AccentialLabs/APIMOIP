<?php
include("phpmailer/class.phpmailer.php");
function enviaEmail($status, $id, $valor, $array_dados){
	$mensagem = montaMensagem($status);
	$checkoutDate = date('d/m/Y - H:i', time($array_dados['Checkout']['date']));
	$body = <<<EOD


<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="UTF-8">

<TITLE>Modelo de Email</TITLE>

<!--###META TAGS###-->
<META NAME="DESCRIPTION" CONTENT="" />
<META NAME="KEYWORDS" CONTENT="" />

<body>
<font face="Myriad Pro, Arial" color="#535353">
	<table cellpadding="0" cellspacing="0" align="center" width="760px" background="background-conteudo.gif">
		<tr>
			<td bgColor="#333333" colspan="3">

				<table cellpadding="0" cellspading="0" width="98%">
					<tr>
						<td><img src="http://localhost/work/x_portal_teste/img/adv/Adventa%20Logo/Adventa-2.png" width="100"></td>
						<td align="right"><font color="#ffffff" size="2"><em>{$checkoutDate}</em></font></td>
					</tr>
				</table>

			</td>
		</tr>
		<tr>
			<td width="5px" bgColor="#ffa800"></td>
			<td height="91px" bgColor="#535353" width="92px"><img src="https://secure.trueone.com.br/t1core/img/email/icone-destaque-titulo.gif"></td>
			<td height="91px" background="background-titulo.gif">
				&nbsp;&nbsp;&nbsp;<font size="5"><em><strong>Compra Efetuada</strong></font><br>
				&nbsp;&nbsp;&nbsp;<font size="3">sua compra foi efetuada</em></font>
			</td>
		</tr>
		<tr>
			<td width="3px" bgColor="#ffa800"></td>
			<td colspan='2' align="center" >



				<table cellpadding="5" cellspacing="0" width="100%">
					<tr>
						<td>

<p><em>Caro Sr(a). <strong>{$array_dados['User']['name']}</strong></em>,</p>
<p>Seu pedido foi recebido com sucesso!</p>
<p>Confira as informa��es abaixo que constam no seu <strong>pedido n� {$array_dados['Checkout']['id']}</strong> realizado em <strong>{$checkoutDate}</strong>:</p>

<p>
Forma de Pagamento:  <strong>{$array_dados['PaymentMethod']['type']}</strong>
<br>
Parcelas: <strong>{$array_dados['Checkout']['installment']}</strong>
<br>
Total Frete <strong>R$ {$array_dados['Checkout']['shipping_value']}</strong>
<br>
Total Pedido <strong style="color:#F00;">R$ {$array_dados['Checkout']['total_value']}</strong>
</p>
 

</td>
</tr>
	<tr>
		<td bgColor="#535353"><font size="5" color="#FFF"><strong><em>Produtos</em></strong></font></td>
	</tr>
	<tr>
	<td>

		<table cellpadding="5" cellspacing="0" width="100%" align="center">
					<tr>
						<td align="left">{$array_dados['Offer']['title']}</td>
						<td align="left">{$array_dados['Checkout']['amount']} unidade</td>						
					</tr>														
					<tr>
						<td colspan="3" align="right"><font size="3"><strong>R$ {$array_dados['Checkout']['unit_value']}</strong></font></td>
					</tr>

		</table>

 </td>
</tr>
	<tr>
		<td bgColor="#535353"><font size="5" color="#FFF"><strong><em>Entrega</em></strong></font></td>
	</tr>
	<tr>
	<td>
<p>O endere�o de entrega informado/selecionado por voc� foi:</p>
 

<p>
<strong>Endereco</strong><br>
{$array_dados['Checkout']['address']}, {$array_dados['Checkout']['number']} {$array_dados['Checkout']['complement']}<br>
Bairro {$array_dados['Checkout']['district']} - {$array_dados['Checkout']['city']} - {$array_dados['Checkout']['state']}<br>
CEP {$array_dados['Checkout']['zip_code']}							
</p>


<font size="1">
<p>	
<strong>IMPORTANTE!</strong><br><br>

O Prazo de Entrega de {$array_dados['Checkout']['delivery_time']} dias passar� a contar a partir da confirma��o do pagamento e ser� realizado pela pr�pria {$array_dados['Company']['fancy_name']}. O Adventa n�o realiza, nem se responsabiliza pela entrega de produtos comercializados atrav�s do seu aplicativo ou site. Se tiver d�vidas, por favor, consulte os Termos e Condi��es de Uso dispon�veis em nosso site.
<br>
Se seu pedido possui mais de um item, estes podem ser enviados separadamente, de acordo com a disponibilidade do estoque da Empresa anunciante.
	
</p>
</font>


	</tr>
	<tr>
		<td bgColor="#535353"><font size="5" color="#FFF"><strong><em>Status</em></strong></font></td>
	</tr>
	<tr>
		<td>
<strong style="color:#F00;">{$mensagem}</strong>		
Se preferir, voc� tamb�m pode entrar em contato diretamente com a Empresa anunciante. Os dados de contato s�o:
</p>
 

<p>
<font size="2">	
	<strong>{$array_dados['Company']['fancy_name']}</strong><br>
	{$array_dados['Company']['address']}, {$array_dados['Company']['number']} {$array_dados['Company']['complement']}<br>
Bairro {$array_dados['Company']['district']} - {$array_dados['Company']['city']} - {$array_dados['Company']['state']}<br>
CEP {$array_dados['Company']['zip_code']}	
	Telefone: {$array_dados['Company']['phone']}<br>
	e-Mail: <a href="mailto:{$array_dados['Company']['email']}">{$array_dados['Company']['email']}</a>
</font>
</p>
	
<font size="1">	
<p>
Para sua seguran�a, a institui��o financeira pode realizar a an�lise de dados cadastrais; portanto, mantenha seus dados atualizados no site. Para verificar ou atualizar seus dados, acesse o portal <a href="http://www.adventa.com.br" target="_blank">www.adventa.com.br</a>
</p>
 
<p>
A qualquer momento, voc� pode acompanhar o andamento do seu pedido pelo portal Adventa acessando <a href="http://www.adventa.com.br" target="_blank">www.adventa.com.br</a> no menu Minhas Compras. Clique aqui para verificar agora.
</p>
 
<p>
Se precisar, entre em contato com nossa central de atendimento. Nosso hor�rio de atendimento � de segunda a sexta das 8 �s 18h.
</p>
</font>


						</td>
					</tr>
				</table>


			</td>
		</tr>		


		<tr>
			<td width="5px" bgColor="#ffa800"></td>
			<td colspan="2" align="center">
<br><br><br>
				<table cellpadding="0" cellspacing="0" width="95%">
					<tr>
						<td width="180px" align="center"><img src="https://secure.trueone.com.br/t1core/img/email/trueOne.png"></td>
						<td colspan="2">
							<em>
							<font size="3">
							atenciosamente,<br>
							<strong>Equipe Adventa</strong><br>
							<a href=""><font color="#ffa800">contato@adventa.com.br</font><br>
							<a href=""><font color="#ffa800">www.adventa.com.br</font></a>
							</font>
							</em>
						</td>
					</tr>
				</table>
<br><br><br>
			</td>
		</tr>
		<tr>
			<td bgColor="#333333" colspan="3" height="4"></td>
		</tr>
	</table>
</font>

</body>
</html>

	

EOD;


	// Inicia a classe PHPMailer
	$mail = new PHPMailer();
	
	// Define os dados do servidor e tipo de conex�o
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsSMTP(); // Define que a mensagem ser� SMTP
	$mail->Host = "email-smtp.us-east-1.amazonaws.com"; // Endere�o do servidor SMTP
	$mail->SMTPAuth = true; // Usa autentica��o SMTP? (opcional)
	$mail->Username = 'AKIAIFKETSYDUHGWV4LQ'; // Usu�rio do servidor SMTP
	$mail->Password = 'Alufqo6T7T9mQIGciHL1oHDSKyRfMrnK7+AvX+xlKWn0'; // Senha do servidor SMTP
	
	// Define o remetente
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->From = "contato@adventa.com.br"; // Seu e-mail
	$mail->FromName = "Adventa"; // Seu nome
	
	// Define os destinat�rio(s)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->AddAddress($array_dados['User']['email'], $array_dados['User']['name']);
	//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
	//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // C�pia Oculta
	
	// Define os dados t�cnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail ser� enviado como HTML
	//$mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)
	
	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->Subject  = "Contato - Adventa"; // Assunto da mensagem
	$mail->Body = $body;
	//$mail->Body = "Este � o corpo da mensagem de teste, em <b>HTML</b>! <br /> <img src="http://i2.wp.com/blog.thiagobelem.net/wp-includes/images/smilies/icon_smile.gif?w=625" alt=":)" class="wp-smiley" height="15" width="15"> ";
	//$mail->AltBody = "Este � o corpo da mensagem de teste, em Texto Plano! \r\n <img src="http://i2.wp.com/blog.thiagobelem.net/wp-includes/images/smilies/icon_smile.gif?w=625" alt=":)" class="wp-smiley" height="15" width="15"> ";
	
	// Define os anexos (opcional)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
	
	// Envia o e-mail
	$enviado = $mail->Send();
	
	// Limpa os destinat�rios e os anexos
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
	
	// Exibe uma mensagem de resultado
	if ($enviado) {
	echo "E-mail enviado com sucesso!";
	} else {
	echo "N�o foi poss�vel enviar o e-mail.<br /><br />";
	echo "<b>Informa��es do erro:</b> <br />" . $mail->ErrorInfo;
	}
		
}



function montaMensagem($status){
	switch($status){
		case "1":
			//mensagem do moip - Pagamento j� foi realizado por�m ainda n�o foi creditado na Carteira MoIP recebedora (devido ao floating da forma de pagamento)
			$mensagem = "O seu pagamento j� foi realizado por�m ainda n�o foi creditado na Carteira MoIP recebedora";
		break;
		case "2":
			//mensagem do moip - Pagamento est� sendo realizado ou janela do navegador foi fechada (pagamento abandonado)
			$mensagem = "Estamos aguardando a realiza��o do pagamento";
		break;
		case "3":
			//mensagem do moip - Boleto foi impresso e ainda n�o foi pago
			$mensagem = "O seu Boleto foi impresso, aguardamos o pagamento";
		break;
		case "4":
			//mensagem do moip - Pagamento j� foi realizado e dinheiro j� foi creditado na Carteira MoIP recebedora
			$mensagem = "O seu pagamento foi realizado com sucesso. - CONCLUIDO";
		break;
		case "5":
			//mensagem do moip - Pagamento foi cancelado pelo pagador, institui��o de pagamento, MoIP ou recebedor antes de ser conclu�do
			$mensagem = "A Tua compra foi cancelada, para maiores informa��es entre em contato com o administrador do site";
		break;
		case "6":
			//mensagem do moip - Pagamento foi realizado com cart�o de cr�dito e autorizado, por�m est� em an�lise pela Equipe MoIP. N�o existe garantia de que ser� conclu�do
			$mensagem = "O seu pagamento foi realizado com cart�o de cr�dito e autorizado, por�m est� em an�lise pela Equipe MoIP.";
		break;
		case "7":
			//mensagem do moip - Pagamento foi estornado pelo pagador, recebedor, institui��o de pagamento ou MoIP
			$mensagem = "O seu Pagamento foi estornado, para maiores informa��es consulte o administrador do site";
		break;
		case "8":
			//mensagem do moip - Pagamento est� em revis�o pela equipe de Disputa ou por Chargeback (Deprecated)
			$mensagem = "O seu Pagamento est� em revis�o pela equipe de Disputa ou por Chargeback";
		break;
		case "9":
			//mensagem do moip - Pagamento foi reembolsado diretamente para a carteira MoIP do pagador pelo recebedor do pagamento ou pelo MoIP
			$mensagem = "Ocorreu um erro nO seu pagamento";
		break;		
		case "14":
			//mensagem do moip - INICIO DO PAGAMENTO
			$mensagem = "O Pagamento foi iniciado, esta agora em analise pela equipe do MOIP - ADVENTA";
		break;		
		default:
			$mensagem = "Ocorreu um erro no pagamento! Contate o Administrador do site";
		break;
	}
	
	return $mensagem;
}
?>