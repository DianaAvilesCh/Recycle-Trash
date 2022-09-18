<?php
include 'conexion.php';
if ($con) {
 //if post of arduino
 if (file_get_contents('php://input')) {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $data = $data['fotografias'];

    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
    $DateAndTime = (string) date('mdY-his', time());
    $nomimg = "../capture/images$DateAndTime.png";
    file_put_contents($nomimg, $data);
    //$nomimg = "../capture/images09142022-071430.png";

    ?>
    <!-- Load TensorFlow.js.-->
    </br>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@3.20.0/dist/tf.min.js"></script>
    
    <!-- Replace this with your image. Make sure CORS settings allow reading the image! -->
    <img id="img1" crossorigin='anonymous' src="<?php echo $nomimg?>"></img>
    <div id="results" />
    
    <script>
      init();

      async function init() {
    
        //model =  await tf.loadModel('indexeddb://my-model-1');
        model = await tf.loadGraphModel('../Model/model.json');
    
        //model =  await tf.loadModel('tfjsversion/model.json');
        console.log('model loaded from storage');
    
        input = document.getElementById("img1");
        const tensor = await tf.browser.fromPixels(input).resizeNearestNeighbor([256,256]).toFloat()
        pred = model.predict(tf.reshape(tensor, [1, 256, 256, 3]))
        pred.print()
        console.log("End of predict function")
        //This array is encoded with index i = corresponding emotion. In dataset, 0 = Angry, 1 = Disgust, 2 = Fear, 3 = Happy, 4 = Sad, 5 = Surprise and 6 = Neutral
        category = ['cardboard', 'glass', 'metal', 'paper', 'plastic', 'trash']
        //At which index in tensor we get the largest value ?
        pred.data()
          .then((data) => {
            console.log(data)
            output = document.getElementById("results")
            output.innerHTML = ""
            max_val = -1
            max_val_index = -1
            for (let i = 0; i < data.length; i++) {
              if (data[i] > max_val) {
                max_val = data[i]
                max_val_index = i
              }
            }
            CATEGORY_DETECTED = category[max_val_index]
            output.innerHTML = CATEGORY_DETECTED;
            const cont = output.innerHTML;
            window.location.assign("./d1.php?id="+cont)
            })
      }
      
    </script>
    <?php

  }//fin del if post

} else {//else de si falla conexion
  echo "Falla! conexion con Base de datos ";
}

?>