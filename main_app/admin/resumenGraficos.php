<?php
session_start();
if(!isset($_SESSION["usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
      header("Location: ../../index.php");
  }
  //  elseif ($_SESSION['tipo'] !== 1) {  //debe ser tipo administrador
  //        header("Location: ../../index.php");
  //      }

?>

<html>
    <head>
        <title>SI_Reportes</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <script  src="../../js/acercade.js"></script>
        <script  src="../../js/reporte_graficos.js"></script>
        <script src="../../vendor/moment-with-locales.min.js"></script>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" media="screen" href="../../css/style_forms.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
        <script type="text/javascript" src="../graficos/js/chartJS/Chart.min.js"></script>
        
     </head>
    <style>
        .caja{
            margin: auto;
            max-width: 150px;
            padding: 10px;
            border: 1px solid #BDBDBD;
        }
        .caja select{
            width: 80%;
            font-size: 16px;
            padding: 5px;
        }
        .gGrande{
            margin: auto;
            margin-top: 20px;
            width: 400px;
        }
        .gMediano{
            margin: auto;
            margin-top: 20px;
            width: 240px;
            height:200px;
        }

        .gGigante{
            margin: auto;
            margin-top: 20px;
            width: 400px;
            height:300px;
        }
        .footer {
            grid-area: footer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
            background-color: #648ca6;
            font-size:18;
            color:#fff;
        }

    </style>
    <!-- Recibe los datos de la consulta 2 -->
    <!-- <body style="background-color:#fff";>  -->
    <body> 
    <div class="row" id="encForm">
        <div class="col-sm-12">
            <div class="">
            <div class="d-flex flex-row">
                <div class="p-2 border-logo"><img class ="logo" src="../../images/logo-tecnoaprender.png" alt="logo tecnoaprender"></div>
                <div class="p-2 align-self-center"><span class="tit-header-opt">Resumen datos Tecno Aprender</span></div>
                <div id="divInfo" class="p-2 ml-auto logout"></div>
                <!-- <div class="p-2 ml-auto logout"><a id="btnInicio" href="index.php"><i class= "fas fa-home"></i> Inicio</a></div> -->
            </div>
            <div class="d-flex justify-content-end">
                <div id="divUsuario" class="p-2 logout"></div>
                <div id="divSalir" class="p-2 logout"></div>
            </div>
            </div>
        </div>
    </div> 
    <br>
    <div class="container container-fluid">    
        <table  class="table table-bordered"; style="background-color:#fff"; >
        <thead>
        <tr>
            <th><p align="center"><b>INSTITUCIONES</b></p></th>
            <th><p align="center"><b>POBLACIÓN</b></p></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <!-- -------------------------------Solo texto--------------------------------->
            <td valign="top">
                <div>
                    <?php include('../graficos/datos/dato3.php'); ?> 
                    <font size="3" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><h1 align="center"><b><?php echo $totalInstituciones[0]?></h1></p>
                    <font size="3" face="Georgia, Arial" color="#585858"><p align="center"><b> Instituciones</b></font>
                </div>
            </td>
            <!-- -------------------------------Solo texto--------------------------------->
            <td valign="top">        
                <div>  
                    <?php include('../graficos/datos/dato4.php'); ?> 
                    <font size="3" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><h1 align="center"><b><?php echo $totalP = $hombres[0]+$mujeres[0]?></h1></p>
                    <font size="3" face="Georgia, Arial" color="#585858"><p align="center"><b> Beneficiados</b></font>
                </div>
                        
            </td>
        </tr>
        <tr>
            <td valign="top"> 
            <font size="3" face="Georgia, Arial" color="#585858"><p align="center"><b>Instituciones por Tipo</b></p></font>
            <?php include('../graficos/datos/dato7.php'); ?> 
            <div class="gMediano"><canvas id="graficoInstitucionesTipo" ></canvas></div>


            <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b> Preescolar:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $tipoCE_1[0]?></b>

            <font size="2" face="Georgia, Arial" color="#585858"><b>- Escuela:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $tipoCE_2[0]?></b>

            <font size="2" face="Georgia, Arial" color="#585858"><b>- Unidad pedagógica:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $tipoCE_3[0]?></b></p>

            <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b> CINDEA:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $tipoCE_4[0]?></b>

            <font size="2" face="Georgia, Arial" color="#585858"><b>- Liceo/Colegio:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $tipoCE_5[0]?></b>

            <font size="2" face="Georgia, Arial" color="#585858"><b>- Colegio Técnico:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $tipoCE_6[0]?></b></p>

            <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b>Enseñanza especial:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $tipoCE_7[0]?></b>

            <font size="2" face="Georgia, Arial" color="#585858"><b> - Nocturno:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $tipoCE_8[0]?></b>

            <font size="2" face="Georgia, Arial" color="#585858"><b> - IPEC:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $tipoCE_9[0]?></b></p>

            <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b> Marco Tulio:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $tipoCE_10[0]?></b></font>

                <!-- ------------------------------Grafico de poblacion circular----------------------- -->                
                <script>                
                    $(function () {
                    var canvasGrafico = $('#graficoInstitucionesTipo').get(0).getContext('2d')
                    var grafico       = new Chart(canvasGrafico)
                        var datosGrafico  = [
                    {
                        value    : <?php echo $tipoCE_1[0] ?>,
                        color    : '#0080FF',
                        highlight: '#0080FF',
                        label    : 'JARDIN DE NIÑOS',
                    },
                    {
                        value    : <?php echo $tipoCE_2[0] ?>,
                        color    : '#088A85',
                        highlight: '#088A85',
                        label    : 'ESCUELA',
                    },
                    {
                        value    : <?php echo $tipoCE_3[0] ?>,
                        color    : '#FA58D0',
                        highlight: '#FA58D0',
                        label    : 'UNIDAD PEDAGOGICA',
                    },
                    {
                        value    : <?php echo $tipoCE_4[0] ?>,
                        color    : '#4B8A08',
                        highlight: '#4B8A08',
                        label    : 'CINDEA',
                    },
                    {
                        value    : <?php echo $tipoCE_5[0] ?>,
                        color    : '#D7DF01',
                        highlight: '#D7DF01',
                        label    : 'LICEO/COLEGIO',
                    },
                    {
                        value    : <?php echo $tipoCE_6[0] ?>,
                        color    : '#2E9AFE',
                        highlight: '#2E9AFE',
                        label    : 'COLEGIO TECNICO',
                    },
                    {
                        value    : <?php echo $tipoCE_7[0] ?>,
                        color    : '#886A08',
                        highlight: '#886A08',
                        label    : 'ENSEÑANZA ESPECIAL',
                    },
                    {
                        value    : <?php echo $tipoCE_8[0] ?>,
                        color    : '#DF3A01',
                        highlight: '#DF3A01',
                        label    : 'NOCTURNO',
                    },
                    {
                        value    : <?php echo $tipoCE_9[0] ?>,
                        color    : '#FE2E2E',
                        highlight: '#FE2E2E',
                        label    : 'IPEC',
                    },
                    {
                        value    : <?php echo $tipoCE_10[0] ?>,
                        color    : '#E2A9F3',
                        highlight: '#E2A9F3',
                        label    : 'MARCO TULIO'
                    }]
                    
                    var opcionesGrafico     = {
                    segmentShowStroke: true,
                    responsive       : true,
                    segmentStrokeColor: "#fff",
                    segmentStrokeWidth: 2,
                    percentageInnerCutout: 0, // This is 0 for Pie charts
                    animationSteps: 100,
                    animationEasing: "easeOutBounce",
                    animateRotate: true,
                    animateScale: false,
                   
                    legendTemplate       : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
                    }
                        grafico.Pie(datosGrafico, opcionesGrafico) 
                    })

                    Chart.defaults.global.legend = { enabled: false};
                </script>  
            
            </td>

            <td valign="top">
                <font size="3" face="Georgia, Arial" color="#585858"><p align="center"><b>Población por sexo</b></p></font>
                <?php include('../graficos/datos/dato4.php'); ?> 

                <div class="gMediano"><canvas id="graficoPoblacion" ></canvas></div>        
                <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b> Hombres:</b></font>
                <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $hombres[0]?></b></font>

                <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b> Mujeres:</b></font>
                <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $mujeres[0]?></b></p></font>
                <!--------------------------------Grafico de poblacion circular------------------------->    
                
                <script>                
                    $(function () {
                    var canvasGrafico = $('#graficoPoblacion').get(0).getContext('2d')
                    var grafico       = new Chart(canvasGrafico)
                    var datosGrafico  = [
                    {
                        value    : <?php echo $hombres[0]; ?>,
                        color    : '#f56954',
                        highlight: '#f56954',
                        label    : 'HOMBRES'
                    },
                    {
                        value    : <?php echo $mujeres[0]; ?>,
                        color    : '#00a65a',
                        highlight: '#00a65a',
                        label    : 'MUJERES'
                    }]

                    var opcionesGrafico     = {
                    segmentShowStroke    : true,
                    segmentStrokeColor   : '#fff',
                    segmentStrokeWidth   : 2,
                    percentageInnerCutout: 0, // This is 0 for Pie charts
                    animationSteps       : 100,
                    animationEasing      : 'easeOutBounce',
                    animateRotate        : true,
                    animateScale         : true,
                    responsive           : true,
                    maintainAspectRatio  : true,
                    legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
                    }
                        grafico.Pie(datosGrafico, opcionesGrafico) 
                    })
                </script>
            </td>
        </tr>

        <tr>
            <!-- --------------------------------------------------------------------------------------------- -->
            <td valign="top">    
            <?php include('../graficos/datos/dato8.php'); ?> 

            <font size="3" face="Georgia, Arial" color="#585858"><p align="center"><b>Instituciones por provincia</b></p></font>
            <div class="gGrande"><canvas id="graficoInstitucionesProvincia"></canvas></div>

            <br>

            <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b> San José:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $provincia_1[0]?></b>

            <font size="2" face="Georgia, Arial" color="#585858"><b>- Alajuela:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $provincia_2[0]?></b>

            <font size="2" face="Georgia, Arial" color="#585858"><b>- Cartago:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $provincia_3[0]?></b></p>

            <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b> Heredia:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $provincia_4[0]?></b>

            <font size="2" face="Georgia, Arial" color="#585858"><b>- Guanacaste:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $provincia_5[0]?></b>

            <font size="2" face="Georgia, Arial" color="#585858"><b>- Puntarenas</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $provincia_6[0]?></b></p>

            <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b>Limón:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $provincia_7[0]?></b>

            <!-- --- -->
       
            <script>
                $(function () {
                    var lineChartData = {
                    labels  : ['San José', 'Alajuela', 'Cartago', 'Heredia', 'Guanacaste', 'Puntarenas', 'Limón'], 
                    datasets: [
                        {
                        label               : 'Provincia',
                        fillColor           : 'rgba(210, 214, 222, 1)',
                        strokeColor         : 'rgba(210, 214, 222, 1)',
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : [ "<?php echo $provincia_1[0] ?>",
                                                "<?php echo $provincia_2[0] ?>",
                                                "<?php echo $provincia_3[0] ?>",
                                                "<?php echo $provincia_4[0] ?>",
                                                "<?php echo $provincia_5[0] ?>",
                                                "<?php echo $provincia_6[0] ?>",
                                                "<?php echo $provincia_7[0] ?>"]
                        }                   
                    ]
                    }
                
                    var lineChartCanvas          = $('#graficoInstitucionesProvincia').get(0).getContext('2d')
                    var lineChart                = new Chart(lineChartCanvas)

                    var lineChartOptions = {
                    showScale               : true, 
                    scaleShowGridLines      : true,
                    scaleGridLineColor      : 'rgba(0,0,0,.05)',
                    scaleGridLineWidth      : 1,
                    scaleShowHorizontalLines: true,
                    scaleShowVerticalLines  : true,
                    bezierCurve             : true,
                    bezierCurveTension      : 0.3,
                    pointDot                : true,
                    pointDotRadius          : 4,
                    pointDotStrokeWidth     : 1,
                    pointHitDetectionRadius : 20,
                    datasetStroke           : true,
                    datasetStrokeWidth      : 2,
                    datasetFill             : true,
                    legendTemplate          :  "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
                    maintainAspectRatio     : true,
                    responsive              : true
                    }                
                    lineChartOptions.datasetFill = false
                    lineChart.Line(lineChartData, lineChartOptions)
                })
            </script>
            </td>
            
            <!-- --------------------------------------------------------------------------------------------- -->
            <td valign="top">                
            <font size="3" face="Georgia, Arial" color="#585858"><p align="center"><b>Población por área</b></p></font>    
            <?php include('../graficos/datos/dato5.php'); ?>

            <div class="gGrande"><canvas  id="graficoPoblacionArea"></canvas></div>
            <br>
            <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b> Preescolar:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $modalidad1[0]?></b>

            <font size="2" face="Georgia, Arial" color="#585858"><b> - Escuela:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $modalidad2[0]?></b></p>

            <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b> Unidad pedagógica:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $modalidad3[0]?></b>

            <font size="2" face="Georgia, Arial" color="#585858"><b> - CINDEA:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $modalidad4[0]?></b></p>

            <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b>Liceo/Colegio:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $modalidad5[0]?></b>

            <font size="2" face="Georgia, Arial" color="#585858"><b> - Colegio Técnico:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $modalidad6[0]?></b></p>

            <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b>Enseñanza especial:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $modalidad7[0]?></b>

            <font size="2" face="Georgia, Arial" color="#585858"><b> - Nocturno:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $modalidad8[0]?></b></p>

            <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b>IPEC:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $modalidad9[0]?></b>

            <font size="2" face="Georgia, Arial" color="#585858"><b> - Marco Tulio:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $modalidad10[0]?></b></p>
            
                <Script>                
                    $(function () {
                        var barChartData = 
                        {
                            labels  : ['Preescolar', 'Escuela','UP', 'CINDEA', 'Liceo/Colegio', 'Colegio T', 'Enseñanza E', 'Nocturno', 'IPEC','Marco T'],
                            datasets: 
                            [
                                {
                                label               : 'Jardin de niños',
                                fillColor           : 'rgba(210, 214, 222, 1)',
                                strokeColor         : 'rgba(210, 214, 222, 1)',
                                pointColor          : 'rgba(210, 214, 222, 1)',
                                pointStrokeColor    : '#c1c7d1',
                                pointHighlightFill  : '#fff',
                                pointHighlightStroke: 'rgba(220,220,220,1)',
                                data                : [ "<?php echo $modalidad1[0] ?>",
                                                        "<?php echo $modalidad2[0] ?>",
                                                        "<?php echo $modalidad3[0] ?>",
                                                        "<?php echo $modalidad4[0] ?>",
                                                        "<?php echo $modalidad5[0] ?>",
                                                        "<?php echo $modalidad6[0] ?>",
                                                        "<?php echo $modalidad7[0] ?>",
                                                        "<?php echo $modalidad8[0] ?>",
                                                        "<?php echo $modalidad9[0] ?>",
                                                        "<?php echo $modalidad10[0] ?>"]
                                }                           
                            ]
                        }
                        var barChartCanvas                   = $('#graficoPoblacionArea').get(0).getContext('2d')
                        var barChart                         = new Chart(barChartCanvas)
                        var barChartData                     = barChartData
                        barChartData.datasets[0].fillColor   = '#10a65a' //esto determina la cantidad de series
                        barChartData.datasets[0].strokeColor = '#00a65a'
                        barChartData.datasets[0].pointColor  = '#00a65a'

                        var barChartOptions                  = {
                        scaleBeginAtZero        : true,
                        scaleShowGridLines      : true,
                        scaleGridLineColor      : 'rgba(0,0,0,.05)',
                        scaleGridLineWidth      : 1,
                        scaleShowHorizontalLines: true,
                        scaleShowVerticalLines  : true,
                        barShowStroke           : true,
                        barStrokeWidth          : 2,
                        barValueSpacing         : 5,
                        barDatasetSpacing       : 5,
                        legendTemplate          :  "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
                        responsive              : true,
                        maintainAspectRatio     : true
                        }
                    
                        barChartOptions.datasetFill = false
                        barChart.Bar(barChartData, barChartOptions) 
                    })
            </Script>              
            </td>
        </tr>
        </tbody>
    </table>
    </div>


    <div class="container container-fluid">  
    <table  class="table table-bordered"; style="background-color:#fff"; >
        <thead>
        <tr>
            <th><p align="center"><b>PROYECTOS TECNOAPRENDER</b></p></th>
            <th><p align="center"><b>GESTIONES</b></p></th>
        </tr>
        </thead>
        <tbody>

        <tr>
        <td>
                <div>
                    <?php include('../graficos/datos/dato9.php'); ?> 
                    <font size="3" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><h1 align="center"><b><?php echo $totalIniciativas[0]?></h1></p>
                    <font size="3" face="Georgia, Arial" color="#585858"><p align="center"><b> Proyectos TecnoAprender</b></font>
                </div>
        </td>
        <td>
        <div>
                    <?php include('../graficos/datos/dato2.php'); ?> 

                    <font size="3" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><h1 align="center"><b><?php echo $totalGestiones[0] ?></h1></p>
                    <font size="3" face="Georgia, Arial" color="#585858"><p align="center"><b> Gestiones educativas</b></font>
        </div>
        </td>
        </tr>


            <tr>
            <td valign="top"> 
            <font size="3" face="Georgia, Arial" color="#585858"><p align="center"><b>Proyectos por Tipo</b></p></font>
            <?php require_once('../graficos/datos/datosProyectos.php'); ?> 
            
            <div class="gGigante"><canvas id="graficoProyectos" ></canvas></div>

 <?php
 $longitud = count($tipoProyecto);

for($i=0; $i<$longitud; $i=$i+2)
{

            $nombreProyecto[] =  $tipoProyecto[$i + 1];
            $cantProyecto[] =  $tipoProyecto[$i];
           // echo $valores;
?>
            
            <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b> <?php  echo $tipoProyecto[$i+1];?>:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo implode( ",", $tipoProyecto[$i] );?>  ---</b></p>


<?php
}
?>
                    
                <!-- --------------------------------Grafico de proyectos------------------------->                
                <script>                
                    $(function () {
                    var canvasGrafico = $('#graficoProyectos').get(0).getContext('2d')
                    
                    var grafico       = new Chart(canvasGrafico)
                    
                        var datosGrafico  = [

                            <?php
                                $longitud = count($nombreProyecto);                        
                                for($i=0; $i<$longitud; $i++)
                        {                              
                            ?>
                  
                  {
                        value    : <?php echo implode( ",", $cantProyecto[$i] ); ?>,
                        color    : color= "#" + Math.floor(Math.random()*16777215).toString(16),
                        highlight: color,
                        label    : '<?php echo $nombreProyecto[$i];?>'
                    },
                    <?php }?>

                   
                   
                    ]
                    
  

                    var opcionesGrafico     = {
                    segmentShowStroke: true,
                    responsive       : true,
                    segmentStrokeColor: "#fff",
                    segmentStrokeWidth: 2,
                    percentageInnerCutout: 0, // This is 0 for Pie charts
                    animationSteps: 100,
                    animationEasing: "easeOutBounce",
                    animateRotate: true,
                    animateScale: false,
                   
                    legendTemplate       : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
                    }
                        grafico.Pie(datosGrafico, opcionesGrafico) 
                    })

                    Chart.defaults.global.legend = { enabled: false};
                </script>  
            
            </td>
            
            <td valign="top"> 
            <font size="3" face="Georgia, Arial" color="#585858"><p align="center"><b>Gestiones por tipo</b></p></font>
            <?php include('../graficos/datos/dato6.php'); ?> 
            <div class="gGigante"><canvas id="graficoTiposGestion" ></canvas></div>


            <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b> Administrativas:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $gestion1[0]?></b></p>

            <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b> Pedagógicas:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $gestion2[0]?></b></p>

            <font size="2" face="Georgia, Arial" color="#585858"><p align="center"><b> Técnicas:</b></font>
            <font size="2" face="Bookman Old Style, Book Antiqua, Garamond" color="#151515"><b><?php echo $gestion3[0]?></b></p>
                <!--------------------------------Grafico de poblacion circular------------------------->                
                <script>                
                    $(function () {
                    var canvasGrafico = $('#graficoTiposGestion').get(0).getContext('2d')
                    var grafico       = new Chart(canvasGrafico)
                    var datosGrafico  = [
                    {
                        value    : <?php echo $gestion1[0] ?>,
                        color    : '#FA58D0',
                        highlight: '#FA58D0',
                        label    : 'ADMINISTRATIVAS'
                    },
                    {
                        value    : <?php echo $gestion2[0] ?>,
                        color    : '#2E9AFE',
                        highlight: '#2E9AFE',
                        label    : 'PEDAGÓGICAS'
                    },
                    {
                        value    : <?php echo $gestion3[0] ?>,
                        color    : '#D7DF01',
                        highlight: '#D7DF01',
                        label    : 'TÉCNICAS'
                    }]
                    
                    var opcionesGrafico     = {
                    segmentShowStroke: true,
                    responsive       : true,
                    segmentStrokeColor: "#fff",
                    segmentStrokeWidth: 2,
                    percentageInnerCutout: 0, // This is 0 for Pie charts
                    animationSteps: 100,
                    animationEasing: "easeOutBounce",
                    animateRotate: true,
                    animateScale: false,
                    legendTemplate       : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
                    }
                        grafico.Pie(datosGrafico, opcionesGrafico) 
                    })
                </script>
            </td>
            
        </tr>

        <tr>
        <td></td>
        <td valign="top">
            <font size="3" face="Georgia, Arial" color="#585858"><p align="center"><b>Gestiones educativas por año y mes</b></p></font>   
                <div class="caja">
                    <select onChange="mostrarResultadosG(this.value);">
                        <?php
                            for($i=2000;$i<2022;$i++){
                                if($i == 2020){
                                    echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                }else{
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            }
                        ?>     
                    </select>
                </div>
                <div class="gGrande"><canvas id="graficoGestiones"></canvas></div>
            <!--------------------------------------------------------------------------------->
                <script>
                            $(document).ready(mostrarResultadosG(2020));  
                            
                                function mostrarResultadosG(year){
                                    
                                    $('.resultadosGestiones').html('<canvas id="graficoGestiones"></canvas>');
                                   
                                    $.ajax({
                                        type: 'POST',
                                        url: '../graficos/datos/dato1.php',
                                        data: 'year='+year,
                                        dataType: 'JSON',
                                        success:function(data){
                                           // console.log("HOla");
                                            var Datos = {
                                                    labels : ['Enero', 'Febrero', 'Marzo', 'Abril', 'mayo','Junio','Julio','Agostp','Septiembre','Octubre','Noviembre','Diciembre'],
                                                    datasets : [
                                                        {
                                                            fillColor : 'rgba(91,228,146,0.6)', //COLOR DE LAS BARRAS
                                                            strokeColor : 'rgba(57,194,112,0.7)', //COLOR DEL BORDE DE LAS BARRAS
                                                            highlightFill : 'rgba(73,206,180,0.6)', //COLOR "HOVER" DE LAS BARRAS
                                                            highlightStroke : 'rgba(66,196,157,0.7)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
                                                            data : data
                                                            
                                                        }
                                                    ]
                                                }
                                            var contexto = document.getElementById('graficoGestiones').getContext('2d');
                                           
                                            window.Barra = new Chart(contexto).Bar(Datos, { responsive : true });
                                           Barra.clear();
                                        },
                                        error: function() {
                                            console.log("No se ha podido obtener la información");
    }


                                    });
                                    return true;
                                }
                    </script>
        
            </td>
        </tr>
       
        </tbody>
        </table>
</div>

<footer class="footer">
    <div >&copy; 2019 DRTE</div>
    <div >Departamento de Investigación, desarrollo e implementación</div>
</footer>
</body>

</html>