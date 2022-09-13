<?php

include 'conexion.php';

if ($con) {


  echo "Conexion con base de datos exitosa! ";
  if (file_get_contents('php://input')) {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    echo "aqui llegue";
    //echo $data['fotografias'];
    //echo file_get_contents('php://input');
    $data = $data['fotografias'];

    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
    $DateAndTime = (string) date('mdY-his', time());
    $nomimg = "../capture/images$DateAndTime.png";
    file_put_contents($nomimg, $data);


?>
    <!-- Load TensorFlow.js. This is required to use MobileNet. -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.0.1"> </script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/mobilenet"> </script>
    <!-- Load the MobileNet model. -->

    <!-- Replace this with your image. Make sure CORS settings allow reading the image! -->
    <img id="img1" src="<?php echo $nomimg ?>"></img>
    <div id="results" />

    <!-- Place your code in the script tag below. You can also use an external .js file -->
    <script>
      classifyImg();

      function classifyImg() {
        const img = document.getElementById('img1');
        const r = document.getElementById('results');

        r.innerHTML = '';
        console.log("Classify...");

        img.onload = function() {
          console.log('Wait to load..');
          mobilenet.load().then(model => {
            // Classify the image.
            model.classify(img).then(predictions => {
              for (i in predictions) {
                r.innerHTML = r.innerHTML + '<b>' + predictions[i].className + "</b> - " + predictions[i].probability + "<br/>";
                img.onload = null;
                img.src = 'esp32cam.php';
              }

            });
          });
        }

      }
    </script>
<?php
unlink("$nomimg");
  }
  unlink("../capture/images09132022-043241.png");
} else {
  echo "Falla! conexion con Base de datos ";
}

?>