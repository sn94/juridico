<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="author" content="Marx JMoura">
    <meta name="description" content="Admin 4B. Open source and free admin template built on top of Bootstrap 4. Quickly customize with our Sass variables and mixins.">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Sistema de Control de Juicios</title>
    <link rel="icon" href="./favicon.ico">
     <link href="<?= url("app.css") ?>" rel="stylesheet">

     <style>
        .app .app-body .app-sidebar{
             background: #092804;
         }
         .app .app-body .app-sidebar .sidebar-nav > .sidebar-nav-link.collapsed, .app .app-body .app-sidebar .sidebar-nav > li > .sidebar-nav-link.collapsed, .app .app-body .app-sidebar .sidebar-nav > .sidebar-nav-group > .sidebar-nav-link.collapsed {
            background-color: #092804;
            }

        .card-header{
            background-color: #a5efa0;
        }

        table, label, select{
            font-size: 12px !important; 
        }
        table.table td{ padding: 0px !important;}
        
        label{  font-weight: bold;   }
       

/*TABLA RESPONSIVA */
          /* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
    
    td:nth-child(3n) p.ldemandado{
        width: 150px;margin: 0px;
    }
    td:nth-child(4n) p.ldemandado{
        width: 200px;margin: 0px;
    }
   
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
     table{
         width: 100%;
     }
    td:nth-child(3n) p.ldemandado{
        width: 100%;margin: 0px;
    }
    td:nth-child(4n) p.ldemandado{
        width: 100%;margin: 0px;
    }
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
    
}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {

}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {

} 


 
       
     </style>
</head>

<body>
    <div class="app">
        <div class="app-body">
            <div class="app-sidebar sidebar-slide-left">
                <div class="text-right">
                    <button type="button" class="btn btn-sidebar" data-dismiss="sidebar">
                        <span class="x"></span></button>
                </div>
                <div class="sidebar-header">
                    <a href="<?= url("/") ?>"><img src="<?=url("assets/img/balanza.jpg")?>" class="user-photo"></a>
                    <p class="username">Estudio Jurídico Sa.<br><small>Administrator</small>
                    </p>
                </div>
                <ul id="sidebar-nav" class="sidebar-nav">
                 
                    <li class="sidebar-nav-group">
                        <a href="<?=url("ldemandados")?>" class="sidebar-nav-link" ><i class="icon-doc"></i>
                            DEMANDAS</a>
                         
                    </li>
                    
                     
                    <li class="sidebar-nav-group">
                        <a href="#opcinformes" class="sidebar-nav-link" data-toggle="collapse"><i class="icon-pencil"></i> INFORMES</a>
                        <ul id="opcinformes" class="collapse" data-parent="#sidebar-nav">
                            <li><a href="./pages/forms/basic-form.html" class="sidebar-nav-link">Crear filtros</a></li>
                            <li><a href="./pages/forms/multi-step-form.html" class="sidebar-nav-link">Editar filtros</a></li> 
                            <li><a href="<?=url("dema-noti-venc")?>" class="sidebar-nav-link">Notif.vencidas</a></li>
                            <li><a href="/depcta" class="sidebar-nav-link">Dep&oacute;sitos</a></li>
                            <li><a href="/extcta" class="sidebar-nav-link">Extracciones</a></li>
                            <li><a href="./pages/forms/tabbed-form.html" class="sidebar-nav-link">Est. Cta. Extracci&oacute;n</a></li>
                            <li><a href="./pages/forms/multi-step-form.html" class="sidebar-nav-link">Dep&oacute;sitos Emb. prev.</a></li>
                            <li><a href="./pages/forms/tabbed-form.html" class="sidebar-nav-link">Dep&oacute;sitos Liquidaci&oacute;n</a></li>   
                            <li><a href="./pages/forms/tabbed-form.html" class="sidebar-nav-link">Resumen de cuentas</a></li>
                            <li><a href="./pages/forms/multi-step-form.html" class="sidebar-nav-link">Recaudaci&oacute;n</a></li> 
                       
                        </ul>
                    </li>
                    <li class="sidebar-nav-group"><a href="#input-controls" class="sidebar-nav-link" data-toggle="collapse"><i class="icon-note"></i> BANCOS</a>
                        <ul id="input-controls" class="collapse" data-parent="#sidebar-nav">
                            <li><a href="./pages/input-controls/input-date.html" class="sidebar-nav-link">Dep&oacute;sitos/ingresos </a></li>
                            <li><a href="./pages/input-controls/checkbox.html" class="sidebar-nav-link">Extracciones/egresos</a></li>
                            <li><a href="./pages/input-controls/input-group.html" class="sidebar-nav-link">Informes</a></li>
                            <li><a href="./pages/input-controls/input-suggestion.html" class="sidebar-nav-link">Cta.de Banco</a></li>
                            <li><a href="./pages/input-controls/label.html" class="sidebar-nav-link">Dep&oacute;sito</a></li>
                            <li><a href="./pages/input-controls/radio-button.html" class="sidebar-nav-link">Extracci&oacute;n</a></li>
                            <li><a href="./pages/input-controls/toggle-switch.html" class="sidebar-nav-link">Estado de cuenta</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-nav-group"><a href="#layout" class="sidebar-nav-link" data-toggle="collapse"><i class="icon-layers"></i> GASTOS</a>
                        <ul id="layout" class="collapse" data-parent="#sidebar-nav">
                            <li><a href="./pages/layout/sidebar.html" class="sidebar-nav-link">Plan de cta.</a></li>
                            <li><a href="./pages/layout/spinner.html" class="sidebar-nav-link">Gastos por demanda</a></li> 
                        </ul>
                    </li>
                    <li class="sidebar-nav-group"><a href="#reference" class="sidebar-nav-link" data-toggle="collapse"><i class="icon-notebook"></i> AUXILIARES</a>
                        <ul id="reference" class="collapse" data-parent="#sidebar-nav">
 
                            <li><a href="./pages/reference/code-highlight.html" class="sidebar-nav-link">Usuarios</a></li>
                            <li><a href="<?= url("params")?>" class="sidebar-nav-link">Parámetros</a></li>

                            <li><a href="./pages/reference/callout.html" class="sidebar-nav-link">Tabla de notificaci&oacute;n</a></li>
 
                            <li><a href="./pages/reference/code-highlight.html" class="sidebar-nav-link">Cant. d&iacute;as p/vto. Notif </a></li>
                            <li><a href="./pages/reference/callout.html" class="sidebar-nav-link">Origen de las demandas</a></li> 
                        </ul>
                    </li>
                   
                </ul>
                <div class="sidebar-footer"><a href="./pages/content/chat.html" data-toggle="tooltip" title="Support"><i class="fa fa-comment"></i> </a><a href="./pages/content/settings.html" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i> </a><a href="./pages/content/signin.html" data-toggle="tooltip" title="Logout"><i class="fa fa-power-off"></i></a></div>
            </div>
            <div class="app-content">
                <nav class="navbar navbar-expand navbar-light bg-white"><button type="button" class="btn btn-sidebar" data-toggle="sidebar"><i class="fa fa-bars"></i></button>
                    <div class="navbar-brand">EST. JUR&Iacute;DICO &middot;  </div>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="badge badge-pill badge-primary">3</span> <i class="fa fa-bell-o"></i></a>
                            <div class="dropdown-menu dropdown-menu-right"><a href="./pages/content/notification.html" class="dropdown-item"><small class="dropdown-item-title">Lorem ipsum (today)</small><br>
                                    <div>Lorem ipsum dolor sit amet...</div>
                                </a>
                                <div class="dropdown-divider"></div><a href="./pages/content/notification.html" class="dropdown-item"><small class="text-secondary">Lorem ipsum (yesterday)</small><br>
                                    <div>Lorem ipsum dolor sit amet...</div>
                                </a>
                                <div class="dropdown-divider"></div><a href="./pages/content/notification.html" class="dropdown-item"><small class="text-secondary">Lorem ipsum (12/25/2017)</small><br>
                                    <div>Lorem ipsum dolor sit amet...</div>
                                </a>
                                <div class="dropdown-divider"></div><a href="./pages/content/notifications.html" class="dropdown-item dropdown-link">See all notifications</a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    @yield('breadcrumb')
                       
                    </ol>
                </nav>





                <!-- inicio CONTENT-->

                <div class="container-fluid">
                    
                    @yield('content')
                         
                           
                    </div>
                    <!-- END CONTENT -->








            </div>
        </div>
    </div>
  
    <script src="<?=url("app.js")?>"></script>
    <!-- librerias para generar archivos excel -->
    <script src="<?=url("xls.js")?>"></script>
    <!-- inicializacion de las librerias ant.-->
    <script src="<?=url("xls_ini.js")?>"></script>
</body>

</html>