<?php 

class PublicAPI {
    
    /**
     * get data from admin api
     * @param string $route example: content/25 
     * @param array $params example: array("status"=>1)
     * @return array
     */
    public function get($route = '', $params = array()) {
        $Curl = get_curl($this->_getCurlOptions());
        $result = $Curl->simple_get(RCMS_URL . $route, $params);
        return $this->processCurlRes($Curl, $result);
    }
    
    /**
     * post data to admin api
     * @param string $route example: content
     * @param array $params example: array("content"=>'base64encodedcontent')
     * @return array
     */
    public function post($route = '', $params = array()) {
        $Curl = get_curl($this->_getCurlOptions());
        $result = $Curl->simple_post(RCMS_URL . $route, json_encode($params));
        return $this->processCurlRes($Curl, $result);
    }
    
    protected function processCurlRes($Curl = null, $result = null) {
        log_message('debug', 'PublicAPI->get curl result ' . print_r($result, true));
        log_message('debug', 'PublicAPI->get curl info'.print_r($Curl->info, true));
        $httpCode = (int) $Curl->info['http_code'];
        $message = str_replace('The requested URL returned error: ' . $httpCode, '', $Curl->error_string);
        if ($httpCode >= 400) {
            throw new Exception((!empty($result) ? $result : $message), $httpCode);
        }
        if (!$result || $result === null) {
            log_message('error', 'processCurlRes '.$Curl->error_string . ': ' . $Curl->error_code);
            throw new Exception($message, (int) $httpCode);
        }
        return json_decode($result, true);
    }
    
    private function _getCurlOptions() {
        $options = array(
            'HTTPHEADER' => array(
                'Content-Type: application/json',
                'Token: admintoken'
            ),
            'FAILONERROR' => 1
        );
        return $options;
    }
    
}
