<html>
    <head>
        <title>SI_Reportes</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/chartJS/Chart.min.js"></script>
    </head>
    <style>
        .caja{
            margin: auto;
            max-width: 250px;
            padding: 20px;
            border: 1px solid #BDBDBD;
        }
        .caja select{
            width: 100%;
            font-size: 16px;
            padding: 5px;
        }
        .resultados{
            margin: auto;
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
    </body>

    <script>
            $(document).ready(mostrarResultados(2019));  
                function mostrarResultados(year){
                    $('.resultados').html('<canvas id="grafico"></canvas>');
                    $.ajax({
                        type: 'POST',
                        url: 'datos/procesar.php',
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
                            var contexto = document.getElementById('grafico').getContext('2d');
                            window.Barra = new Chart(contexto).Bar(Datos, { responsive : true });
                            Barra.clear();
                        }
                    });
                    return false;
                }
    </script>
</html>