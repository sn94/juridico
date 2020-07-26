 
    <table id="demandadostable" class="table table-responsive table-bordered table-striped">
      <thead class="thead-dark">
          <tr> <th></th> <th>CI</th>  <th >TITULAR</th> <th>DOMICILIO</th> <th>TELÉFONO</th> </tr>
      </thead>
      <tbody>
      <?php foreach( $lista as $item): ?>
          <tr> 
        <td > <p class="ldemandado" ><a href="<?=url("demandas-by-ci/".$item->CI)?>" >VER</a></p>  </td>  
        <td > <p class="ldemandado" > <?=$item->CI?> </p> </td>
        <td > <p class="ldemandado"   ><?= $item->TITULAR?></p></td> 
        <td  > <p  class="ldemandado" ><?= $item->DOMICILIO?></p></td>  
        <td  ><p class="ldemandado" ><?= $item->TELEFONO?></p></td>   
      </tr>
      <?php  endforeach; ?>
      </tbody>
      </table>

     
    <!--  style="width: 150px;margin:0px;"-->