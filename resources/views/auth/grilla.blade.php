<?php

use App\Mobile_Detect;
use App\Helpers\Helper;

$detect= new Mobile_Detect();
if( $detect->isMobile() == false){
  ?>
<style>
  table{
    font-size:16px !important;
  }
</style>

<?php
} 
?>


<table class="table table-striped table-bordered table-responsive">
      <thead class="thead-dark ">
      <th class="pb-0"></th>
      <th class="pb-0"></th>
        <th class="pb-0">NICK</th>
        <th class="pb-0">TIPO</th> 
        <th  class="pb-0">CREACIÓN</th>
        <th  class="pb-0">ULT.ACT.</th>
      <tbody>
        <?php  foreach( $users as $it) :?>
        <tr> 
          <td><a  onclick="borrar_user(event)"  href="<?=url("del-user/".$it->IDNRO)?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
          <td><a  onclick="editar_user(event)" href="<?=url("edit-user/".$it->IDNRO)?>" ><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
          <td>{{$it->nick}}</td>
           <td>{{  $it->tipo=="S" ? "SUPERVISOR":  ($it->tipo=="O" ?"OPERADOR": "USUARIO" )  }}</td>  
           <td>{{ Helper::beautyDate( $it->created_at)}}</td>  
           <td>{{  Helper::beautyDate($it->updated_at) }}</td>  
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>


    <script>
      


      //BORRA origen de demanda
function borrar_user( ev){//Objeto event   DIV tag selector to display   success handler
ev.preventDefault();
let divname="#viewform"; 
if(  ! confirm("SEGURO QUE QUIERE BORRARLO?") ) return;
$.ajax(
     {
       url:  ev.currentTarget.href,
       method: "get", beforeSend: function(){
         $( divname).html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
       },
       success: function(res){
        $( divname).html( "");
           let r= JSON.parse(res);
           if("ok" in r) alert( r.ok); 
            else alert( r.error) ;
            act_grilla();
       },
       error: function(){
         $( divname).html(  "<h6 style='color:red;'>Problemas de conexión</h6>" ); 
       }
     }
   );
}/*****end ajax call* */

 
function editar_user( ev){//Objeto event   DIV tag selector to display   success handler
ev.preventDefault();
let divname="#viewform2";  
$.ajax(
     {
       url:  ev.currentTarget.href,
       method: "get",
      beforeSend: function(){     $( divname).html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
       },
       success: function(res){    $( divname).html( res);   },
       error: function(){ $( divname).html(  "<h6 style='color:red;'>Problemas de conexión</h6>" );       }
     }
   );
}/*****end ajax call* */

    </script>