<?php
  class jsonRPCClient {
    public $debug;
    private $uri;
    private $id;
    private $notification = false;
    public function __construct($uri, $debug = false) {
        $this->uri = $uri;
        empty($proxy) ? $this->proxy = '' : $this->proxy = $proxy;
        empty($debug) ? $this->debug = false : $this->debug = true;
        $this->debugclone = $debug;
    }
    public function __call($method, $params) {
         if(!is_scalar($method)) { throw new Exception("Method name has no scalar value."); }
         if(is_array($params)) {
            $params = array_values($params);
         } else { throw new Exception("Params must be given as array."); }
         $this->id = rand(0,99999);
         if($this->notification) { $currentId = NULL; } else { $currentId = $this->id; }
         $request = array( 'method' => $method, 'params' => $params, 'id' => $currentId );
         $request = json_encode($request);
         $this->debug && $this->debug .= "\n".'**** Client Request ******'."\n".$request."\n".'**** End of Client Request *****'."\n";
         $opts = array('http' => array( 'method' => 'POST', 'header' => 'Content-type: application/json', 'content' => $request )); 
         $context = stream_context_create($opts);
         if($fp = fopen($this->uri, 'r', false, $context)) {
            $response = ''; while($row=fgets($fp)) { $response .= trim($row)."\n"; }
            $this->debug && $this->debug .= '**** Server response ****'."\n".$response."\n".'**** End of server response *****'."\n\n";
            $response = json_decode($response, true);
         } else { throw new Exception('Unable to connect to'. $this->uri); }
         if($this->debug) { echo nl2br($this->debug); }
         if(!$this->notification) {
           if($response['id'] != $currentId) { throw new Exception('Incorrect response ID (request ID: '. $currentId . ', response ID: '. $response['id'].')'); }
           if(!is_null($response['error'])) { throw new Exception('Request error: '. $response['error']); }
           $this->debug = $this->debugclone; return $response['result'];
         } else { return true; }
    }
    public function setRPCNotification($notification) { empty($notification) ? $this->notification = false : $this->notification = true; return true; }
  }
?>