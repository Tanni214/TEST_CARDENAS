<?php
 #Script que genera un archivo de LOG
 #Recibe argumentos desde input 
 #El primer argumento corresponte al site_ID, 
 #y siguientes es el seller_ID.  
 # @author Tannia Cardenas <tanniacardenas467@gmail.com>

 if( isset($_POST['site_id']) ) {
  $site_ID=$_POST['site_id'];
  }
  if( isset($_POST['seller_id']) ) {
    $seller_ID=$_POST['seller_id'];
  }
  if(isset($site_ID)&&isset($seller_ID)){
    $data = json_decode( file_get_contents("https://api.mercadolibre.com/sites/$site_ID/search?seller_id=$seller_ID"), true );
    $datafilter = [$data'results'];
      foreach($datafilter as $dat){
        $a = $dat['category_id'];
        $dataname = json_decode( file_get_contents("https://api.mercadolibre.com/categories/$a"), true );
        $ar=fopen("output.log","a") or die("problemas en la creacion del archivo");
        echo  "id=" . $dat['id'] . ",". "title=" . $dat['title'] . "," . "category_id=" . $dat['category_id'] .",". "name=" .  $dataname['name'] . "</br>";
        fputs($ar, "id=" . $dat['id'].",". "title=" . $dat['title'].",". "category_id=" . $dat['category_id'] .",".  "name=" . $dataname['name']);
        fputs($ar,"\n");
    }
  }
  
?>