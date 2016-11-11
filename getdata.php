  <?php
  $postdata = file_get_contents("php://input");
      $request = json_decode($postdata);
      $id=$request->reg;
    $curl = curl_init();
    curl_setopt ($curl, CURLOPT_URL, "http://transportapi.herokuapp.com/details?regno=$id");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec ($curl);
    curl_close ($curl);
    echo $result;
 ?>