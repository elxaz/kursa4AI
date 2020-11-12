<?php 
require 'libs/rb.php';
R::setup( 'mysql:host=localhost;dbname=ICS-media','root', '' ); 

if ( !R::testconnection() )
{
		exit ('Нет соединения с базой данных');
}

session_start();