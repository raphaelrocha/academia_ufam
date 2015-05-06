<?php
//include 'PHPMailer.php';
date_default_timezone_set('America/Manaus');
require_once("PHPMailer.php");
mb_internal_encoding("UTF-8");
mb_http_output( "UTF-8" );
ob_start("mb_output_handler");
$date = new DateTime();


function SomarData($data, $dias, $meses = 0, $ano = 0)
{
	//passe a data no formato yyyy-mm-dd
	$data = explode("-", $data);
	$newData = date("Y-m-d", mktime(0, 0, 0, $data[1] + $meses, $data[2] + $dias, $data[0] + $ano) );
	return $newData;
}

echo "Iniciando o contador de faltas em ".$date->format("Y/m/d")." ás ".$date->format("H:i:s")."</br>";

$hora = $date->format("H:i:s");
$data = $date->format("Y-m-d");
$ano = $date->format('Y');
$mes = $date->format('m');
$dia = $date->format('d');
$nomeDia = date("D", mktime(0, 0, 0, $mes, $dia, $ano));
$nomeDiaPtb;
$nomeDiaPtbFormatado;
if($nomeDia=="Mon"){
	$nomeDiaPtb="segunda";
	$nomeDiaPtbFormatado = "Segunda-Feira";
}else if($nomeDia=="Tue"){
	$nomeDiaPtb="terca";
	$nomeDiaPtbFormatado = "Terça-Feira";
}else if($nomeDia=="Wed"){
	$nomeDiaPtb="quarta";
	$nomeDiaPtbFormatado = "Quarta-Feira";
}else if($nomeDia=="Thu"){
	$nomeDiaPtb="quinta";
	$nomeDiaPtbFormatado = "Quinta-Feira";
}else if($nomeDia=="Fri"){
	$nomeDiaPtb="sexta";
	$nomeDiaPtbFormatado = "Sexta-Feira";
}else if($nomeDia=="Sat"){
	$nomeDiaPtb="sabado";
	$nomeDiaPtbFormatado = "Sábado";
}else if($nomeDia=="Sun"){
	$nomeDiaPtb="domingo";
	$nomeDiaPtbFormatado = "Domingo";
}

$conecta = mysql_connect("localhost", "academia_user", "mysqlPAPS2015") or print (mysql_error());
mysql_select_db("ACADEMIA_DB", $conecta) or print(mysql_error());
print "Conexão e Seleção do Banco OK!</br>";

$sqlAcademia = "SELECT CODIGO_CONFIG, DATA_FIM FROM ACADEMIA WHERE SITUACAO='ativo'";
$CodAcad = mysql_query($sqlAcademia, $conecta);


echo "hoje: ".$data."<br/>";

$amanha = SomarData($data,1);
echo "amanhã: ".$amanha."<br/>";
$codigoPerfilAtivo;
$dataFimPerfilAtivo;

while($getCod = mysql_fetch_array($CodAcad)) {
	$codigoPerfilAtivo=$getCod['CODIGO_CONFIG'];
	$dataFimPerfilAtivo = $getCod['DATA_FIM'];
}
echo "Código do perfil ativo: ".$codigoPerfilAtivo."</br>";
echo "Data final do perfil ativo: ".$dataFimPerfilAtivo."</br>";

$sql = "SELECT MATRICULA, NOME, EMAIL FROM
((USUARIO INNER JOIN AGENDA ON (USUARIO.MATRICULA=AGENDA.MAT_USUARIO))
INNER JOIN HORARIO ON (AGENDA.ID_HORARIO=HORARIO.ID))
INNER JOIN ACADEMIA ON (HORARIO.ID_ACADEMIA=ACADEMIA.CODIGO_CONFIG)
WHERE ACADEMIA.CODIGO_CONFIG='".$codigoPerfilAtivo."' AND HORARIO.DIASEMANA='".$nomeDiaPtb."'";

$result = mysql_query($sql, $conecta) or die (mysql_error());

while($consulta = mysql_fetch_array($result)) {
	$mat = $consulta['MATRICULA'];
	//echo "Matricula: $mat $nomeDiaPtb $data</br>";
	$sqlContaFaltas = "SELECT CONTA_FALTAS ('".$mat."','".$nomeDiaPtb."','".$data."','".$codigoPerfilAtivo."') AS RET";
	echo $sqlContaFaltas." ";
	$retContaFalta = mysql_query($sqlContaFaltas, $conecta);
	//echo $retContaFalta."</br>";
	while($VAR = mysql_fetch_array($retContaFalta)) {
		$RET_FALTA=$VAR['RET'];
		if ($RET_FALTA==1){
			echo "[PERDEU A VAGA]</br>";
			$nome = $consulta['NOME'];
			$to = $consulta['EMAIL'];
			$from = "sistemas@icomp.ufam.edu.br";
			$subject = utf8_decode("ACADEMIA UFAM - HORÁRIO DESMARCADO");
			$message = "<html>
							<h2>Academia UFAM</h2>
							Olá $nome.
							<br/>
							Esta é uma menssagem automática, não responda.
							<br/>
							<br/>
							Devido as constantes faltas, seu horário de <b>$nomeDiaPtbFormatado</b> foi desmarcado.
							<br/>
							Evite marcar um horário que você não irá usar, pois outros podem precisar.
							<br/>
							<br/>
							Clique <a href='http://sistemas.icomp.ufam.edu.br/academia/index.php?r=site/login'>aqui</a> para acessar o sistema.
							<br/>
							Ou cole esse link no seu navegador. [http://sistemas.icomp.ufam.edu.br/academia/index.php?r=site/login]
							<br/>
							<br/>
							Obrigado.
							<br/>
							<br/>
						</html>";
			$mail = new PHPMailer();
			$mail->SetFrom($from, 'no-reply - Academia UFAM');
			$mail->Subject = $subject;
			$mail->MsgHTML($message);
			$mail->AddAddress($to, "");
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "ssl";
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465;
			$mail->Username = 'sistemas@icomp.ufam.edu.br';
			$mail->Password = 'Si102030';


			if(!$mail->Send()) {
				echo "Erro no envio do e-mail: " . $mail->ErrorInfo."</br>";
			}else{
				echo "e-mail de alerta envido para: ".$to."</br>";
			}
		}else{
			echo "</br>";
		}
	}
}

//echo "</br>";
if($amanha>$dataFimPerfilAtivo){
	echo "Data limite atingida, desativar perfil.";
	$sqlDesativa = "UPDATE ACADEMIA
						SET SITUACAO = 'inativo'
						WHERE SITUACAO = 'ativo'";
	$resultDesativa = mysql_query($sqlDesativa, $conecta);
}else{
	echo "Data limite nao foi atingida, nao desativar perfil.";
}
echo "</br>";
mysql_free_result($result);

mysql_close($conecta);

?>
