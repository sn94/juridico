<form id="gastos-search" action="<?= url("grillgastos") ?>" method="post" onsubmit="actualizar_grill_parametros(event)">
    @csrf

    <div class="row mt-2 no-gutters">

        <div class="col-12 col-sm-6 col-md-6  col-xl-4 " style="display: flex;flex-direction: row;align-items: baseline;">
            <label style="width: 150px;">FILTRAR POR:</label>
            {!! Form::select('', $CODGASTO, null, [ 'id'=>'CODGASTO','class'=>'form-control form-control-sm', 'onchange'=>'filtrarPorCodigo(event)'] ) !!}
        </div>



        <div class="col-12 col-sm-6 col-md-6 col-xl-3" style="display: flex;flex-direction: row;align-items: baseline;">
            <label style="width: 100%;">OTROS FILTROS:</label>
            <!--Filtro: ES GASTO POR DEMANDA U OTROS -->
            <select style="height: 28px;  width: 100%;" class="form-control" name="modo" id="">
                <option value="T">TODO</option>
                <option value="D">POR DEMANDAS</option>
                <option value="V">POR VARIOS</option>
                <option value="I">VER INGRESOS</option>
            </select>
        </div>
        <div class="col-12 col-sm-12  col-md-12 col-xl-5" style="display: flex;flex-direction: row;align-items: baseline;">
            <!--Parametros de fecha -->

            <div style="display: flex; flex-direction: row;align-items: baseline;"> 
                <label  class="pr-1" style="font-size: 10pt; font-weight: 600;">DESDE:</label>
                <input class="form-control form-control-sm" type="date" id="Desde" name="Desde">
            </div>

            <div style="display: flex; flex-direction: row;align-items: baseline;">
                <label class="pr-1" style="font-size: 10pt; font-weight: 600;">HASTA: </label>
                <input class="form-control form-control-sm" type="date" id="Hasta" name="Hasta">
            </div>
            <button style="border-radius: 25px;background-color: #fdc673;color: #1a0c00;" type="submit" class="btn btn-sm btn-info mt-1">
                <img src="{{url('assets/img/search18.png')}}">
            </button>
        </div>


    </div>

</form>