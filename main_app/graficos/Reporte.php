<html>
    <head>
        <title>SI_Reportes</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/chartJS/Chart.min.js"></script>
<<<<<<< HEAD
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
=======
        <script type="text/javascript" src="datos/gBarras.js"></script>
        <script type="text/javascript" src="datos/gCircular.js"></script>
>>>>>>> 28cbba1585768ab68de6655223522569b2431e18
    </head>
    <style>
        .caja{
            margin: auto;
<<<<<<< HEAD
            max-width: 150px;
            padding: 10px;
            border: 1px solid #BDBDBD;
        }
        .caja select{
            width: 80%;
=======
            max-width: 250px;
            padding: 20px;
            border: 1px solid #BDBDBD;
        }
        .caja select{
            width: 100%;
>>>>>>> 28cbba1585768ab68de6655223522569b2431e18
            font-size: 16px;
            padding: 5px;
        }
        .resultados{
            margin: auto;
<<<<<<< HEAD
            margin-top: 20px;
            width: 500px;
        }
    </style>
    <!-- Recibe los datos de la consulta 2 -->
    <body> 
    <div class="container">
  <h2 align="center">REPORTE DE GESTIONES EDUCATIVAS</h2>
  <h2 align="center">TECNO @APRENDER</h2>
  <p>-</p>  

  <table class="table table-bordered">
    <thead>
      <tr>
        <th text-align: center;>General</th>
        <th text-align: center;>Gestiones</th>
        <th text-align: center;>Sectores</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <!-- -------------------------------Solo texto--------------------------------->
        <td>
        <p align="center">CENTROS EDUCATIVOS</p>
                <div>
                   <h2 align="center" id="totalCE">  </h2>   <!--  llama al script de total de centros     -->
                </div>
        </td>
           <!-- -------------------------------Solo texto--------------------------------->
        <td>
        <p align="center">TOTAL DE GESTIONES</p> 
                    <div>                        
                    <h2 align="center" id="totalV">  </h2>   <!--  llama al script de total de visitas     -->
                    </div>
        </td>
        <td>john@example.com</td>
      </tr>
      <tr>
        <td>
            <p align="center"><b>Población general por sexo</b></p>   
            <div class="resultados"><canvas id="graficoPoblacion" ></canvas></div>

        </td>
        <!-- ----------------------------------------Grafico de barras------------------------------------>
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
            <div class="resultados"><canvas id="graficoGestiones"></canvas></div>
        </td>
        <td>mary@example.com</td>
      </tr>
      <tr>
        <td>
            <p align="center"><b>Población por área</b></p>   
            <div><canvas id="graficoPoblacionArea"></canvas></div>
        </td>
        <td>Dooley</td>
        <td>july@example.com</td>
      </tr>
    </tbody>
  </table>
</div>
</body>

<!-- ------------------------------------------------------------------------------->
    <script>
            $(document).ready(mostrarResultadosG(2019));  
                function mostrarResultadosG(year){
                    $('.resultadosGestiones').html('<canvas id="graficoGestiones"></canvas>');
                    $.ajax({
                        type: 'POST',
                        url: 'datos/dato1.php',
=======
            margin-top: 40px;
            width: 600px;
        }
        .caja2{
            margin:auto;
            max-width: 250px;
            padding: 20px;                        
        }
    </style>
    <body> 
        <h2 align="center">CANTIDAD DE CENTROS EDUCATIVOS</h2> 
        <div class="caja2">
            <p>Cantidad de centros educativos registrados: <?$totalCE ?></p>
        </div>    


        <h2 align="center">GESTIONES EDUCATIVAS (AÑO Y MES)</h2> 
        <div class="caja">
            <select onChange="mostrarResultados(this.value);">
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
        <div class="resultados"><canvas id="grafico"></canvas></div>

    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <h2>Grafico 2<h2>
                <canvas id="myChart" width="200" height="200"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <h2>Grafico 3<h2>
                <canvas id="myChart2" width="200" height="200"></canvas>
            </div>
        </div>
    </div>
    </body>

    <script>
            $(document).ready(mostrarResultados(2019));  
                function mostrarResultados(year){
                    $('.resultados').html('<canvas id="grafico"></canvas>');
                    $.ajax({
                        type: 'POST',
                        url: 'datos/gBarras.php',
>>>>>>> 28cbba1585768ab68de6655223522569b2431e18
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
<<<<<<< HEAD
                            var contexto = document.getElementById('graficoGestiones').getContext('2d');
=======
                            var contexto = document.getElementById('grafico').getContext('2d');
>>>>>>> 28cbba1585768ab68de6655223522569b2431e18
                            window.Barra = new Chart(contexto).Bar(Datos, { responsive : true });
                            Barra.clear();
                        }
                    });
                    return false;
                }
<<<<<<< HEAD
    </script>
    <!-- ----------------------------------------Total de Visitas-------------------------->
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
  <!-- ----------------------------------------Total de Centros E-------------------------->
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
    <!--------------------------------Grafico de poblacion circular------------------------->
    
    <script>
    <?php include('datos/dato4.php'); ?>
    $(function () {
    var pieChartCanvas = $('#graficoPoblacion').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
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
      }    
      
    ]
    var pieOptions     = {
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
     pieChart.Pie(PieData, pieOptions) 
    })
    </script>
    <!--------------------------------Grafico de poblacion por area------------------------->
    <Script>
    
    </Script>
=======

                function mostrarTotalCE(){

                    $.ajax({
                        type: 'POST',
                        url: 'datos/gCicular.php',
                        data: data,
                        dataType: 'JSON',
                    });
                    return false;
                }
    </script>
>>>>>>> 28cbba1585768ab68de6655223522569b2431e18
</html>