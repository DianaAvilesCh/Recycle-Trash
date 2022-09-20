<?php
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
   //$nomimg = "../capture/images09142022-071619.png";
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
</head>
<body>
<script type="text/javascript">
  postimg('<?php echo $nomimg?>');
    function postimg(img){
      window.location.href ="prediction.php?image=" + img;
    }
</script>
</body>
</html>