<head>
  <link href="prueba.css">
  <script src="prueba.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js" integrity="sha512-s/XK4vYVXTGeUSv4bRPOuxSDmDlTedEpMEcAQk0t/FMd9V6ft8iXdwSBxV0eD60c6w/tjotSlKu9J2AAW1ckTA==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.1.1/jspdf.umd.min.js" integrity="sha512-/Am09zlYshHgRizY3RkConGj4BsYIdb8mS7r5XAXw0rTiLgGSHzpUHTQBhinWR32C/KzLr749J1xuORzT2JnRA==" crossorigin="anonymous"></script>
</head>

<body>
  <button onclick="genPDF();"> Generar Pdf</button>
  <div id="testDiv" style="width: 100%;">
  </div>
</body>

<script>
document.addEventListener("DOMContentLoaded", () => {
  let divImagenes = document.getElementById("testDiv");

  for (let index = 0; index < 20; index++) {
    let aleatory = Math.floor(Math.random() * 101);
    let img = document.createElement("img");
    img.src = `https://picsum.photos/id/${aleatory}/1200/1200`;
    img.style.display = "block";
    img.style.marginTop = "5px";
    img.style.marginBottom = "5px";
    img.style.width = "100%";
    divImagenes.appendChild(img);
  }
});
function genPDF() {
  const { jsPDF } = window.jspdf;
  html2canvas(document.getElementById("testDiv"), {
    useCORS: true,
    onrendered: (canvas) => {
      let doc = new jsPDF("p", "mm", "a4");

      //Obtengo la dimensión en pixeles en base a la documentación
      // https://github.com/MrRio/jsPDF/blob/ddbfc0f0250ca908f8061a72fa057116b7613e78/jspdf.js#L59
      let a4Size = {
        w: convertPointsToUnit(595.28, "px"),
        h: convertPointsToUnit(841.89, "px")
      };

      let canvastoPrint = document.createElement("canvas");
      let ctx = canvastoPrint.getContext("2d");
      canvastoPrint.width = a4Size.w;
      canvastoPrint.height = a4Size.h;

      // Como mi ancho es mas grande y lo redimencionare, tomo cuanto corresponde esos 595 de el total de mi imagen
      let aspectRatioA4 = a4Size.w / a4Size.h;
      let rezised = canvas.width / aspectRatioA4;

      let printed = 0,
        page = 0;
      while (printed < canvas.height) {
        //Tomo la imagen en proporcion a el ancho y alto.
        ctx.drawImage(
          canvas,
          0,
          printed,
          canvas.width,
          rezised,
          0,
          0,
          a4Size.w,
          a4Size.h
        );
        var imgtoPdf = canvastoPrint.toDataURL("image/png");
        let width = doc.internal.pageSize.getWidth();
        let height = doc.internal.pageSize.getHeight();
        if (page == 0) {
          // si es la primera pagina, va directo a doc
          doc.addImage(imgtoPdf, "JPEG", 0, 0, width, height);
        } else {
          // Si no ya tengo que agregar nueva hoja.
          let page = doc.addPage();
          page.addImage(imgtoPdf, "JPEG", 0, 0, width, height);
        }
        ctx.clearRect(0, 0, canvastoPrint.width, canvastoPrint.height); // Borro el canvas
        printed += rezised; //actualizo lo que ya imprimi
        page++; // actualizo mi pagina
      }

      doc.save("test.pdf");
    }
  });

  function convertPointsToUnit(points, unit) {
    // Unit table from https://github.com/MrRio/jsPDF/blob/ddbfc0f0250ca908f8061a72fa057116b7613e78/jspdf.js#L791
    var multiplier;
    switch (unit) {
      case "pt":
        multiplier = 1;
        break;
      case "mm":
        multiplier = 72 / 25.4;
        break;
      case "cm":
        multiplier = 72 / 2.54;
        break;
      case "in":
        multiplier = 72;
        break;
      case "px":
        multiplier = 96 / 72;
        break;
      case "pc":
        multiplier = 12;
        break;
      case "em":
        multiplier = 12;
        break;
      case "ex":
        multiplier = 6;
      default:
        throw "Invalid unit: " + unit;
    }
    return points * multiplier;
  }
}
</script>