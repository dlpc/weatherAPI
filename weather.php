<?php
  /*jsonp 参数
  * cid=101010100&callback=callback
  */
  $city = '';
  $body = '<h3>城市代码不合法！</h3>';
  $callback = isset($_GET['callback']) ? $_GET['callback'] : '';

  if (isset($_GET['cid']) && strlen($_GET['cid'])==9 && ctype_digit($_GET['cid'])) {
    $forecast = getforecast($_GET['cid']);
    if ($forecast) {      
      $city = $forecast['city'];
      $body = printbody($callback,$forecast);
    }
  }
  echo $body;

  function getforecast($cityid) {
    if (!function_exists('curl_init')) {
      $forecast = file_get_contents('http://m.weather.com.cn/data/'.$cityid.'.html');
    }
    else {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'http://m.weather.com.cn/data/'.$cityid.'.html');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
      $forecast = curl_exec($ch);
      curl_close($ch);
    }
    $forecast = json_decode($forecast, TRUE);
    if ($forecast) {
      return json_encode($forecast['weatherinfo']);
    }
    return false;
  }

  function printbody($callback,$forecast) {
    if (!empty($callback)) {
   		$jsonp = $callback . '(' . $forecast . ')';
      return $jsonp;
	  }
  }

?>
