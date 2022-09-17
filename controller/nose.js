async function init() {

    //model =  await tf.loadModel('indexeddb://my-model-1');
    model = await tf.loadLayersModel('../Modelo/model.json');
    //model =  await tf.loadModel('tfjsversion/model.json');
    console.log('model loaded from storage');

    const img = document.getElementById('img1');
    const r = document.getElementById('results');

    r.innerHTML = '';
    console.log("Classify...");
    var n = 0;
    var clase = '';
    img.onload = function () {
        console.log('Wait to load..');
        model.load().then(model => {
            // Classify the image.
            model.classify(img).then(predictions => {
                for (i in predictions) {
                    n = predictions[0].probability;
                    clase = predictions[0].className;
                    if (predictions[i].probability > n) {
                        n = predictions[i].probability;
                        clase = predictions[i].className;
                    }
                    img.onload = null;
                    img.src = 'esp32cam.php';
                }
                console.log("HOLA"+ clase+ "que hace"+n);
                r.innerHTML = r.innerHTML + '<b>' + clase + "</b> - " + n + "<br/>";
            });
        });
    }
}
