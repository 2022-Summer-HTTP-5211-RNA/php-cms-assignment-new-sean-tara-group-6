<?php
/*
//Default MySQL db (Tara's or Adam's db)
$connect = mysqli_connect( 
    "sql206.epizy.com",         //hostname
    "epiz_32048451",            //username
    "jMKWTY5j1Vi",              //pw
    "epiz_32048451_portfolio"   //db name
);
*/

//Sean Trudel's Infinity Free MySQL db

$connect = mysqli_connect( 
    "sql103.epizy.com",         //hostname
    "epiz_31102711",            //username
    "wwTHVjY3l9C5",             //pw
    "epiz_31102711_portfolio"   //db name
);


mysqli_set_charset( $connect, 'UTF8' );