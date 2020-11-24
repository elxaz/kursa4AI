<?php 
require 'libs/rb.php';
R::setup( 'mysql:host=ec2-54-170-123-247.eu-west-1.compute.amazonaws.com:5432;dbname=dcp0isoi16tdma','frbgbjargntncg', 'f51cd8501cc1d3d8c410b56c0d4302427abb1f3c183f1d443220ac71fe83f6a4' ); 

if ( !R::testconnection() )
{
		exit ('Нет соединения с базой данных');
}

session_start();
