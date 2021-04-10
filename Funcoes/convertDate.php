<?php
function convertDate($data){
    //Converte a data para o formato BR
    $d = explode('-', $data);
    return $d[2]."/".$d[1]."/".$d[0];
}