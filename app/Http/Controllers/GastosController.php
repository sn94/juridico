<?php

namespace App\Http\Controllers;

use App\Arreglo_extrajudicial;
use App\Banc_mov;
use App\Bancos;
use App\Codigo_gasto;
use App\CodigoGasto;
use App\Demanda;
use App\Demandados;
use App\Gastos;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\pdf_gen\PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GastosController extends Controller
{


    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }

    public function index(Request $request)
    {

        $dato = Gastos::addSelect([
            'CODIGO' => Codigo_gasto::select('CODIGO')
                ->whereColumn('IDNRO', 'gastos.CODIGO')
        ])->paginate(20);


        //Totales
        $totales = Gastos::select(DB::raw('if(SUM(IMPORTE) is null, 0, SUM(IMPORTE)) AS IMPORTE, METODO, FLAG'))
            ->groupBy("METODO")
            ->groupBy("FLAG")
            ->get();
        // dd( $totales);



        if ($request->ajax()) {
            if ($dato->count())
                return view("gastos.grilla", ["movi" =>  $dato, "totales" => $totales]);
            else
                echo "<h6>SIN REGISTROS</h6>";
        } else
            return view(
                "gastos.index",
                [
                    "movi" =>  $dato,  "totales" => $totales, "TITULO" => "GASTOS", "url_agregar" => url("gasto"),
                    "CODGASTO" => DB::table("cod_gasto")->pluck('DESCRIPCION', 'IDNRO'),
                    "breadcrumbcolor" => "#fdc673 !important;"
                ]
            );
    }



    public function ordenar(Request $request, $columna, $sentido)
    {

        $orden = $sentido == "A" ? "ASC" : "DESC";
        $dato = Gastos::addSelect([
            'CODIGO' => Codigo_gasto::select('CODIGO')
                ->whereColumn('IDNRO', 'gastos.CODIGO')
        ])->orderBy($columna, $orden)->paginate(20);


            //Totales
            $totales = Gastos::select(DB::raw('if(SUM(IMPORTE) is null, 0, SUM(IMPORTE)) AS IMPORTE, METODO, FLAG'))
                ->groupBy("METODO")
                ->groupBy("FLAG")
                ->get();


        if ($request->ajax()) {
            if ($dato->count())
                return view("gastos.grilla", ["movi" =>  $dato, "totales"=>  $totales]);
            else
                echo "<h6>SIN REGISTROS</h6>";
        } else {
            return view(
                "gastos.index",
                [
                    "movi" =>  $dato, "TITULO" => "GASTOS", "totales"=>  $totales, "url_agregar" => url("gasto"),
                    "CODGASTO" => DB::table("cod_gasto")->pluck('DESCRIPCION', 'IDNRO'),
                    "breadcrumbcolor" => "#fdc673 !important;"
                ]
            );
        }
    }

    public function cargar(Request $request, $ope = "A", $id = "")
    {

        if (sizeof($request->all())  > 0) {
            $banco = null;
            if ($ope == "A")   $banco = new Gastos();
            if ($ope == "M")   $banco = Gastos::find($request->input("IDNRO"));

            $Datos =  $request->input();
            //CONVERTIR A NEGATIVO SI ES INGRESO
            if ($Datos["SIGNO"] == "-") {
                $Datos['FLAG'] = "INGRESO";
                //ignorar codigo de gasto
                $Datos =  array_diff_key($Datos, ['CODIGO' => '']);
                $Datos["IMPORTE"] =  (-1) *  $Datos["IMPORTE"];
            }


            $banco->fill($Datos);
            $banco->save();
            $mensaje = ($ope == "A") ?  "SE CARGÓ UN GASTO." : "GASTO EDITADO";
            echo json_encode(array("ok" => $mensaje));
        } else {
            //Preparar parametros
            //Lista de codigo de gastos
            $cod_gastos = DB::table("cod_gasto")->pluck('DESCRIPCION', 'IDNRO');
            $ruta =   $ope == "A" ? url("gasto")  :  url("gasto/M");
            if ($ope == "A")
                return view(
                    "gastos.form",
                    ['OPERACION' => $ope,   'RUTA' => $ruta,   'CODGASTO' => $cod_gastos, "breadcrumbcolor" => "#fdc673 !important;"]
                );
            if ($ope == "M") {
                $el_gasto = Gastos::find($id);
                //El gasto fue por demanda u otros
                if (is_null($el_gasto->ID_DEMA))  //POR VARIOS
                    return view(
                        "gastos.form",
                        [
                            'OPERACION' => $ope,   'RUTA' => $ruta,   'CODGASTO' => $cod_gastos,
                            'dato' => $el_gasto, "breadcrumbcolor" => "#fdc673 !important;"
                        ]
                    );
                else { //POR DEMANDA
                    $detalles_dema = DB::table("demandas2")->select("demandas2.CI", "COD_EMP", "DEMANDA", "TITULAR")->join("demandado", "demandado.CI", "=", "demandas2.CI")
                        ->where("demandas2.IDNRO",   $el_gasto->ID_DEMA)
                        ->first();
                    return view(
                        "gastos.form",
                        [
                            'OPERACION' => $ope,   'RUTA' => $ruta,   'CODGASTO' => $cod_gastos, "demanda" => $detalles_dema,
                            'dato' => $el_gasto, "breadcrumbcolor" => "#fdc673 !important;"
                        ]
                    );
                }
            }
        }
    }




    public function borrar($idnro)
    {
        $d =     Gastos::find($idnro)->delete();
        echo json_encode(array("IDNRO" => $idnro));
    }



    public function filtrarPorCodigo(Request $request, $codigo)
    {
        $dato = Gastos::addSelect([
            'CODIGO' => Codigo_gasto::select('CODIGO')
                ->whereColumn('IDNRO', 'gastos.CODIGO')
        ])->where("CODIGO", $codigo)->paginate(20);
        if ($request->ajax()) {
            return view("gastos.grilla", ["movi" =>  $dato]);
        } else {
            return view(
                "gastos.index",
                [
                    "movi" =>  $dato, "TITULO" => "GASTOS", "url_agregar" => url("gasto"),
                    "breadcrumbcolor" => "#fdc673 !important;"
                ]
            );
        }
    }

    private function listar_datos_segun_param($request, $PAGINACION = TRUE)
    {

        $dato = null;
        if (!strcasecmp($request->method(), "post")) {

            //Filtro por mo
            $modo = $request->input("modo");
            // Filtro de fecha
            $desde = $request->input("Desde");
            $hasta = $request->input("Hasta");

            $query = Gastos::addSelect([
                'COD_GASTO' => Codigo_gasto::select('CODIGO')
                    ->whereColumn('IDNRO', 'gastos.CODIGO')
            ])
                ->addSelect([
                    'COD_EMP' => Demanda::select('COD_EMP')
                        ->whereColumn('IDNRO', 'gastos.ID_DEMA')
                ]);

            if ($desde != ""  && $hasta != "") $query->whereDate("FECHA", ">=", $desde)->whereDate("FECHA", "<=", $hasta);
            if ($modo == "D")  $query->where("ID_DEMA", "<>", "NULL");
            if ($modo == "V")  $query->whereNull('ID_DEMA');
            if ($modo == "I")  $query->where('gastos.IMPORTE', "<", "0"); //por ingreso
            $dato = $query; //->paginate(20); 

        } else {
            //$dato= Gastos::paginate(20);  
            $dato =  Gastos::addSelect([
                'CODIGO' => Codigo_gasto::select('CODIGO')
                    ->whereColumn('IDNRO', 'gastos.CODIGO')
            ]); //->paginate(20); 
        }

        if ($PAGINACION == TRUE) return $dato->paginate(20);
        else  return $dato->get();
    }

    public function listar(Request $request)
    {
        $dato = $this->listar_datos_segun_param($request);
        if ($request->ajax()) {
            //Totales
            $totales = Gastos::select(DB::raw('if(SUM(IMPORTE) is null, 0, SUM(IMPORTE)) AS IMPORTE, METODO, FLAG'))
                ->groupBy("METODO")
                ->groupBy("FLAG")
                ->get(); 
            return view("gastos.grilla", ["movi" =>  $dato, 'totales'=>  $totales]);
        } else {
            return view(
                "gastos.index",
                [
                    "movi" =>  $dato, "TITULO" => "GASTOS", "url_agregar" => url("gasto"),
                    "CODGASTO" => DB::table("cod_gasto")->pluck('DESCRIPCION', 'IDNRO'),
                    "breadcrumbcolor" => "#fdc673 !important;"
                ]
            );
        }
    }






    //tcpdf
    //para clases css referenciarlas mediante comillas dobles

    public function reporte(Request $request,  $tipo = "xls")
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $Movi =  $this->listar_datos_segun_param($request, FALSE);

        if ($tipo == "xls") {
            echo json_encode($Movi);
        } else {

            //Pdf format
            //Preparar variables que representan montos
            $desde = "";
            $hasta = "";
            if ($request->getMethod(true) == "POST") {
                $desde = $request->input("Desde");
                $hasta = $request->input("Hasta");
            }

            if ($desde != "") {
                $desde = Helper::beautyDate($desde);
                $hasta = Helper::beautyDate($hasta);
            }
            $TITULO_DE_PDF = "INFORME DE CAJA ";

            if ($desde != ""   &&   $hasta != "")  $TITULO_DE_PDF .= "DESDE EL $desde HASTA EL $hasta ";


            $html = <<<EOF
        <style>
            .text-center{
                text-align: center;
            }
            .text-left{
                text-align: left;
            }
            .text-right{
                text-align: right;
            }
            .codigo{
                width: 65px;
            }
            .fecha{
                width:70px;
                text-align: left;
            }
            .comprobante{
                width: 110px;
            }
            .detalle{
                width: 200px;
                text-align: center;
            }
            .importe{
                width:100px;
                text-align: right;
            }
            tr.cabecera{
                font-size: 7pt;
                background-color: #c2fcca;
                font-weight: bold;
            }
            
            tr.cuerpo{
                color: #363636;
                font-size: 9px;
                font-weight: bold;
            }
            
            tr.pie td{ 
                border-top: 1px solid black;
                color: #0f0f0f;
                font-weight: bold;
                font-size: 11px; 
            }
            tr.pie th{ 
                border-top: 1px solid black;
                color: #0f0f0f;
                font-weight: bold;
                font-size: 11px; 
            }
        </style>
        <h6>$TITULO_DE_PDF </h6>

        EOF;


            /********/

            $TOTAL_INGRESOS = 0;
            $TOTAL_EGRESOS = 0;
            $TOTAL_I_EFE = 0;
            $TOTAL_I_CHE = 0;
            $TOTAL_I_GIRO = 0;
            $TOTAL_E_EFE = 0;
            $TOTAL_E_CHE = 0;
            $TOTAL_E_GIRO = 0;
            /*****totales
             * ***** */

            foreach ($Movi as $mo) :
                /**TOTALES ** */

                if ($mo->FLAG == "INGRESO") {
                    $TOTAL_INGRESOS += $mo->IMPORTE;
                    if ($mo->METODO == "EFECTIVO") $TOTAL_I_EFE += $mo->IMPORTE;
                    if ($mo->METODO == "CHEQUE") $TOTAL_I_CHE += $mo->IMPORTE;
                    if ($mo->METODO == "GIRO_TIGO") $TOTAL_I_GIRO += $mo->IMPORTE;
                } else {
                    $TOTAL_EGRESOS += $mo->IMPORTE;
                    if ($mo->METODO == "EFECTIVO") $TOTAL_E_EFE += $mo->IMPORTE;
                    if ($mo->METODO == "CHEQUE") $TOTAL_E_CHE += $mo->IMPORTE;
                    if ($mo->METODO == "GIRO_TIGO") $TOTAL_E_GIRO += $mo->IMPORTE;
                }
            endforeach;
            $html .=  <<<EOF
            <table class="tabla">
            <tr class="cuerpo"><th class="text-right">INGRESOS</th><th class="text-right">EFECTIVO</th><th class="text-right">CHEQUE</th><th class="text-right">GIRO_TIGO</th></tr>
            <tr  class="cuerpo pie" ><th  class="text-right"> $TOTAL_INGRESOS</th><th class="text-right"> $TOTAL_I_EFE </th><th class="text-right">$TOTAL_I_CHE</th><th class="text-right">$TOTAL_I_GIRO</th></tr>
            </table>
            <table class="tabla">
            <tr class="cuerpo"> <th class="text-right"  >EGRESOS</th> <th class="text-right">EFECTIVO</th><th class="text-right">CHEQUE</th><th class="text-right">GIRO_TIGO</th></tr>
            <tr class="cuerpo pie"> <th  class="text-right"> $TOTAL_EGRESOS</th><th class="text-right"> $TOTAL_E_EFE </th><th class="text-right">$TOTAL_E_CHE</th><th class="text-right">$TOTAL_E_GIRO</th></tr>
            </table>
            <br><br>
            EOF;
            $html .= <<<EOF
        <table class="tabla">
        <thead>
        <tr class="cabecera"><th class="codigo">CODIGO</th><th class="fecha">FECHA</th><th class="comprobante">COMPROBANTE</th><th class="detalle">DETALLES</th><th class="importe">IMPORTE</th><th class="text-center">MOV.</th></tr>
        </thead>
        <tbody>
        EOF;


            foreach ($Movi as $mo) :


                //con formato
                $f_MONTO = Helper::number_f($mo->IMPORTE);
                $gooddate = Helper::beautyDate($mo->FECHA);
                $MOTIVO =    $mo->DETALLE1 . "-" . $mo->DETALLE2;
                $f_FLAG = $mo->FLAG;
                //$MOTIVO=  (is_null( $mo->ID_DEMA) )? "VARIOS": ("COD-EMP: ".$mo->COD_EMP);
                $html .= "<tr class=\"cuerpo\"> <td class=\"codigo\">{$mo->COD_GASTO}</td><td class=\"fecha\">{$gooddate}</td><td class=\"comprobante\">{$mo->NUMERO}</td><td class=\"detalle\">{$MOTIVO}</td><td  class=\"importe\">{$f_MONTO}</td> <td  class=\"text-center\">{$f_FLAG}</td> </tr> ";
            endforeach;


            $total = $Movi->sum("IMPORTE");
            //con formato
            $f_total = Helper::number_f($total);

            $html .= <<<EOF
        <br>
        <tr class="pie"><td  class="codigo"></td><td class="fecha"></td><td class="comprobante">TOTAL</td><td class="detalle"></td><td class="importe">$f_total</td> <td></td> </tr> 
        </tbody>
        </table> 
        EOF;

            if ($tipo == "PRINT") {
                echo $html;
            } else {
                //echo $html;
                $tituloDocumento = "GASTOS_INGRESOS-" . date("d") . "-" . date("m") . "-" . date("yy") . "-" . rand();
                $pdf = new PDF();
                $pdf->prepararPdf("$tituloDocumento.pdf", $tituloDocumento, "");
                $pdf->generarHtml($html);
                $pdf->generar();
            }
        } //End pdf format option


    } //End reporte function




    public function demandas($CI)
    {
        $titular = Demandados::where("CI", $CI)->first();
        if (is_null($titular)) {
            return view("gastos.demanda_chooser", ['error' => "NO SE REGISTRA ESE NUMERO DE CEDULA"]);
        } else {
            $dato_titular =  $titular->TITULAR;
            $demanda = Demanda::select('IDNRO', 'COD_EMP', 'DEMANDA', 'BANCO', 'CTA_BANCO')->where("CI", $CI)->get();
            return view("gastos.demanda_chooser", ['demandas' => $demanda, 'TITULAR' => $dato_titular]);
        }
    }
    //CODIGO DE COMPATIBILIDAD
    public function  importar_registros()
    {


        //Obtener instancias de movimiento de cuenta
        //Actualizar el campo IDBANCO de los mismos
        $Bancos = Bancos::get();
        DB::beginTransaction();
        try {

            foreach ($Bancos as $banco) {
                $idnro =  $banco->IDNRO;
                $movs = Banc_mov::where("CUENTA", $banco->CUENTA)->get();
                foreach ($movs as $movimiento) {
                    $movimiento->IDBANCO = $idnro;
                    $val = $movimiento->save();

                    echo "$val<br>";
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo json_encode(array('error' => "Hubo un error al guardar uno de los datos<br>$e"));
        }
    }




    public function asignarCodigoGasto()
    {

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $reg = Gastos::get();
        foreach ($reg as $item) {
            $desc = $item->CODIGO;
            $idnro = Codigo_gasto::where("CODIGO", $desc)->first();
            if (!is_null($idnro)) {
                $id_ = $idnro->IDNRO;
                $item->CODIGO = $id_;
                $item->save();
            }
        }
    }
}
