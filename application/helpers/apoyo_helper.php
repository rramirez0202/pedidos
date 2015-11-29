<?php
function Today()
{
	$fecha=getdate();
	return $fecha["year"]."-".($fecha["mon"]<10?0:"").$fecha["mon"]."-".($fecha["mday"]<10?0:"").$fecha["mday"];
}
function Hoy()
{
	return DateToMx(Today());
}
function DateToMySQL($fecha)
{
	if(strlen($fecha)==10)
		return substr($fecha,6,4)."-".substr($fecha,3,2)."-".substr($fecha,0,2);
	return "";
}
function DateToMx($fecha)
{
	if(strlen($fecha)==10)
		return substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,0,4);
	return "";
}
function AddDays($fecha,$dias)
{
	$fecha=date_create($fecha);
	date_add($fecha, date_interval_create_from_date_string($dias.' days'));
	return date_format($fecha, 'Y-m-d');
}
function Hora()
{
	$fecha=getdate();
	return 
		($fecha["hours"]<10?"0":"").	$fecha["hours"].":".
		($fecha["minutes"]<10?"0":"").	$fecha["minutes"].":".
		($fecha["seconds"]<10?"0":"").	$fecha["seconds"];
}
?>