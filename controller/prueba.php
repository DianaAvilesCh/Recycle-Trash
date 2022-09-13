<?php

  echo "Conexion con base de datos exitosa! ";

?>
    <!-- Load TensorFlow.js. This is required to use MobileNet. -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.0.1"> </script>
    <script src="../Modelo/model2.json"> </script>
    <!-- Load the MobileNet model. -->

    <!-- Replace this with your image. Make sure CORS settings allow reading the image! -->
    <img id="img1" src="../capture/images09132022-085916.png"></img>
    <div id="results" />

    <!-- Place your code in the script tag below. You can also use an external .js file -->
    <script>
      classifyImg();

      function classifyImg() {
        const img = document.getElementById('img1');
        const r = document.getElementById('results');

        r.innerHTML = '';
        console.log("Classify...");
        var n = 0;
        var clase = '';
        img.onload = function() {
          console.log('Wait to load..');
          model2.json.load().then(model => {
            // Classify the image.
            model.classify(img).then(predictions => {
              for (i in predictions) {
                n = predictions[0].probability;
                clase= predictions[0].className;
                if(predictions[i].probability > n)
                {
                  n=predictions[i].probability;
                  clase = predictions[i].className;
                }
                img.onload = null;
                img.src = 'esp32cam.php';
              }
              r.innerHTML = r.innerHTML + '<b>' + clase + "</b> - " + n + "<br/>";
            });
          });
        }
      }
    </script>
<?php

?>