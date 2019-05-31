<?php
function consulta_paginada( $conn, $query, $pag_num, $pag_size )
{
	try {
		$primera = ( $pag_num - 1 ) * $pag_size + 1;
		$ultima  = $pag_num * $pag_size;
		$consulta_paginada = 
			 "SELECT * FROM ( "
				."SELECT ROWNUM RNUM, AUX.* FROM ( $query ) AUX "
				."WHERE ROWNUM <= :ultima"
			.") "
			."WHERE RNUM >= :primera";

		$stmt = $conn->prepare( $consulta_paginada );
		$stmt->bindParam( ':primera', $primera );
		if(isset($_POST["id"])){
			$stmt->bindParam(":paciente",$_POST["id"]);
		}
		$stmt->bindParam( ':ultima',  $ultima  );
		//var_dump($_POST["id"]);exit;
		$stmt->execute();
		
		return $stmt;
	}	
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
} 

function total_consulta( $conn, $query )
{
	try {
		$total_consulta = "SELECT COUNT(*) AS TOTAL FROM ($query)";

		$stmt = $conn->prepare($total_consulta);
		if(isset($_POST["id"])){
			$stmt->bindParam(":paciente",$_POST["id"]);
		}
		$stmt->execute();
		$result = $stmt->fetch();
		$total = $result['TOTAL'];
		return  $total;
	}
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
} 
?>
