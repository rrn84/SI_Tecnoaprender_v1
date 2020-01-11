<html>
    <head>
        <title>SI_Reportes</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/chartJS/Chart.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
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
            width: 500px;
        }
        .gMediano{
            margin: auto;
            margin-top: 20px;
            width: 300px;
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
    <body style="background-color:#fff;""> 
    <div class="container">
    
    <h2 align="center">REPORTE DE GESTIONES EDUCATIVAS</h2>
    <h2 align="center">TECNO @APRENDER</h2>
  
    <table class="table table-bordered">
    <thead>
      <tr>
        <th><p align="center"><b>INSTITUCIONES</b></p></th>
        <th><p align="center"><b>POBLACIÓN</b></p></th>
        <th><p align="center"><b>GESTIONES</b></p></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <!-- -------------------------------Solo texto--------------------------------->
        <td>
                
                <div>                
                   <font color="#2E2E2E"><b><h1 align="center" id="totalCE"></h1></b></font>   <!--  llama al script de total de centros     -->
                   <p align="center">Instituciones</p>
                </div>
        <!---------------------------------Total de Centros E-------------------------->
                <script>
                    var tmp;
                    $.ajax({
                    type:'POST',
                    url: 'datos/dato3.php',
                    dataType: 'text',
                    success: function(data)
                        {
                            tmp= data;  
                            // Obtiene el valor del Json y lo formatea                      
                            var str = tmp.replace(/[.T*+o?t^a$l{:}()"|[\]\\]/g,'')
                            document.getElementById("totalCE").innerHTML = str;                        
                        }
                    });      
                </script>
        </td>
           <!-- -------------------------------Solo texto--------------------------------->
        <td>        
            <div>                
                   <font color="#2E2E2E"><b><h1 align="center" id="totalB"></h1></b></font>   <!--  llama al script de total de centros     -->
                   <p align="center">Beneficiados</p>
            </div>
        <!---------------------------------Total de Centros E-------------------------->
                <script>
                    var tmp;
                    $.ajax({
                    type:'POST',
                    url: 'datos/dato7.php',
                    dataType: 'text',
                    success: function(data)
                        {
                            tmp= data;  
                            // Obtiene el valor del Json y lo formatea                      
                            var str = tmp.replace(/[.T*+o?t^a$l{:}()"|[\]\\]/g,'')
                            document.getElementById("totalB").innerHTML = str;                        
                        }
                    });      
                </script>
        </td>

        <td>
        <div>                        
            <font color="#2E2E2E"><b><h1 align="center" id="totalV"></h1></b></font>  <!--  llama al script de total de visitas     -->
            <p align="center">Gestiones educativas</p> 
            </div>
        <!--------------------------------------Total de Visitas-------------------------->
            <script>
                var tmp;
                $.ajax({
                type:'POST',
                url: 'datos/dato2.php',
                dataType: 'text',
                success: function(data)
                    {
                        tmp= data;  
                        // Obtiene el valor del Json y lo formatea                      
                        var str = tmp.replace(/[.T*+o?t^a$l{:}()"|[\]\\]/g,'')
                        document.getElementById("totalV").innerHTML = str;                        
                    }
                });      
            </script>
        </td>
      </tr>
      <tr>
        <td> 
        
        </td>

        <td>
        <p align="center"><b>Población general por sexo</b></p>  
            <?php include('datos/dato4.php'); ?> 

            <div class="gMediano"><canvas id="graficoPoblacion" ></canvas></div>
            <br><br>
            <p align="center"><?php echo "Hombres: "; echo $hombres[0]?></p>
            <p align="center"><?php echo "Mujeres: "; echo $mujeres[0]?></p>
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
                    label    : 'Hombres'
                },
                {
                    value    : <?php echo $mujeres[0]; ?>,
                    color    : '#00a65a',
                    highlight: '#00a65a',
                    label    : 'Mujeres'
                }]

                var opcionesGrafico     = {
                segmentShowStroke    : true,
                segmentStrokeColor   : '#fff',
                segmentStrokeWidth   : 2,
                percentageInnerCutout: 50, // This is 0 for Pie charts
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

        <td>
        <p align="center"><b>Gestiones educativas por año y mes</b></p> 
            <div class="caja">
                <select onChange="mostrarResultadosG(this.value);">
                    <?php
                        for($i=2000;$i<2021;$i++){
                            if($i == 2019){
                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                            }else{
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                        }
                    ?>      |   "qwa    
                    +-|"
                </select>
            </div>
            <div class="gGrande"><canvas id="graficoGestiones"></canvas></div>
        <!--------------------------------------------------------------------------------->
            <script>
                        $(document).ready(mostrarResultadosG(2019));  
                            function mostrarResultadosG(year){
                                $('.resultadosGestiones').html('<canvas id="graficoGestiones"></canvas>');
                                $.ajax({
                                    type: 'POST',
                                    url: 'datos/dato1.php',
                                    data: 'year='+year,
                                    dataType: 'JSON',
                                    success:function(data){
                                        var Datos = {
                                                labels : ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'],
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
                                    }
                                });
                                return false;
                            }
                </script>

        </td>
      </tr>

      <tr>
        <td>
            
        </td>

        <td>
        <p align="center"><b>Población por área</b></p>   
            <div class="gGrande"><canvas  id="graficoPoblacionArea"></canvas></div>
            <?php include('datos/dato5.php'); ?>
            <Script>                
                $(function () {
                    var barChartData = 
                    {
                        labels  : ['JARDIN DE NIÑOS', 'ESCUELA','UNIDAD PEDAGOGICA', 'CINDEA', 'LICEO/COLEGIO', 'COLEGIO TECNICO', 'ENSEÑANZA ESPECIAL', 'NOCTURNO', 'IPEC','MARCO TULIO'],
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
                    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                    responsive              : true,
                    maintainAspectRatio     : true
                    }
                
                    barChartOptions.datasetFill = false
                    barChart.Bar(barChartData, barChartOptions) 
                })
        </Script>              
        </td>

        <td>
        <p align="center"><b>Tipos de gestiones</b></p>  
        <?php include('datos/dato6.php'); ?> 
        <div class="gMediano"><canvas id="graficoTiposGestion" ></canvas></div>

        <p align="center"><?php echo "Administrativas: ";  echo $gestion1[0]?></p>
        <p align="center"><?php echo "Pedagógicas    : ";  echo $gestion2[0]?></p>
        <p align="center"><?php echo "Técnicas       : ";  echo $gestion3[0]?></p>
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
                    label    : 'Administrativas'
                },
                {
                    value    : <?php echo $gestion2[0] ?>,
                    color    : '#2E9AFE',
                    highlight: '#2E9AFE',
                    label    : 'Pedagógicas'
                },
                {
                    value    : <?php echo $gestion3[0] ?>,
                    color    : '#D7DF01',
                    highlight: '#D7DF01',
                    label    : 'Tecnicas'
                }]
                
                var opcionesGrafico     = {
                segmentShowStroke: true,
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
    </tbody>
  </table>
</div>
<footer class="footer">
    <div >&copy; 2019 DRTE</div>
    <div >Departamento de Investigación, desarrollo e implementación</div>
</footer>
</body>

</html>