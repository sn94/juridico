<form id="paraform" action="<?= url("nparam") ?>" method="post" onsubmit="ajaxCall(event)">

{{csrf_field()}}

<div class="container p-1">
    
<div class="form-group">
              <label >DESCRIPCIÓN:</label>
              <input  name="DESCR"  type="text"  class="form-control form-control-sm">
          </div>
          <div class="form-group">
              <label >VALOR:</label>
              <input     name="VALOR"  type="text"  class="form-control form-control-sm">
          </div>
          <button type="submit" class="btn btn-sm btn-info">GUARDAR</button>

</div>

</form>
<script>

function ajaxCall( ev){//Objeto event   DIV tag selector to display   success handler
ev.preventDefault();
let divname="#viewform"; 
 $.ajax(
     {
       url:  ev.target.action,
       method: "post",
       data: $("#"+ev.target.id).serialize(),
       headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
       beforeSend: function(){
         $( divname).html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
       },
       success: function(res){
           let r= JSON.parse(res);
           if("ok" in r)
            $( divname).html( `<div class="alert alert-success">
            <h6>${ r.ok}</h6>
            </div>`);
            else
            $( divname).html( `<div class="alert alert-danger">
            <h6>${ r.error}</h6>
            </div>`);
            $("#formparam").modal('hide');
            act_grilla();
       },
       error: function(){
         $( divname).html(  "<h6 style='color:red;'>Problemas de conexión</h6>" ); 
       }
     }
   );
}/*****end ajax call* */







</script>