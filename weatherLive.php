<?php
//cid=101010100&callback=cb
  $callback = isset($_GET['callback']) ? $_GET['callback'] : '';

  if (!isset($_GET['cid']) || strlen($_GET['cid'])!=9 || !ctype_digit($_GET['cid'])) {
    $body = '<h3>城市代码不合法！</h3>';
  }
  else {
    $body = getlivedata($callback,$_GET["cid"]);
  }
  echo $body;

  function getlivedata($callback,$cid) {
    if (!function_exists('curl_init')) {
      do {
        $data = file_get_contents('http://www.weather.com.cn/data/sk/'.$cid.'.html');
      } while ($data == '');
    }
    else {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'http://www.weather.com.cn/data/sk/'.$cid.'.html');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
      do {
        $data = curl_exec($ch);
      } while ($data == '');
      curl_close($ch);
    }
    $data = json_decode($data, TRUE);
    $data = json_encode($data['weatherinfo']);

    if (!empty($callback)) {
      $jsonp = $callback . '(' . $data . ')';
      return $jsonp;
    }
  }

?>