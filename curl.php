<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body style="text-align: center;">
        <?php
        $get_parametr = [];
        if (!empty($_GET)) {
            $get_parametr = $_GET;
        }
        $param = [];
        if (!empty($get_parametr)) {
            foreach ($get_parametr as $key => $value) {
                if (htmlspecialchars($key) == 'site') {
                    $site = htmlspecialchars($value);
                }else if (htmlspecialchars($key) == 'method') {
                    $method = htmlspecialchars($value);
                }else{
                    $param[htmlspecialchars($key)] = htmlspecialchars($value);
                }
                
            }
            
            if (isset($site) && isset($method)) {
                
                
                if ($method == 'get') {
                    $get = '';
                    foreach ($param as $key => $value) {
                        $get .= $key . '=' . $value . '&';
                    }
                    
                    $site .= '?' . $get;
                }
                if (!empty($param)) {
                    conect_api($site, $method, $param);
                } else {
                    conect_api($site, $method);
                }
            } else {
                echo "Неправильные данные!";
            }
        }

        function conect_api($url, $method, $param) {
            $link = $url;
            $curl = curl_init();
            
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
            curl_setopt($curl, CURLOPT_URL, $link);

            if ($method == 'post') {
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                if (!empty($param)) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($param));
                }
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            }

            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt');
            curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt'); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            $out = curl_exec($curl); 
          
            $code = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
            
            curl_close($curl);


            $code = (int) $code;
            $errors = array(
                301 => 'Moved permanently',
                400 => 'Bad request',
                401 => 'Unauthorized',
                403 => 'Forbidden',
                404 => 'Not found',
                500 => 'Internal server error',
                502 => 'Bad gateway',
                503 => 'Service unavailable'
            );
            try {
                #Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
                if ($code != 200 && $code != 204)
                    throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error', $code);
            } catch (Exception $E) {
                die('Ошибка: ' . $E->getMessage() . PHP_EOL . 'Код ошибки: ' . $E->getCode());
            }
            /*
              Данные получаем в формате JSON, поэтому, для получения читаемых данных,
              нам придётся перевести ответ в формат, понятный PHP
             */
            $Response = json_decode($out, true);
         

            echo $Response;
        }
        ?>
    </body>
</html>