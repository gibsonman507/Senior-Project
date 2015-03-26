<?php     
     $prod = 0;
     $sp = $prod==0?"Senior-Project/":"";    
    define('DEFAULT_LOG',$_SERVER['DOCUMENT_ROOT']."/{$sp}logs/phpweblog-".date('d\-m\-Y').'.log');
    
    //Log Codes:
    //101 - Standard logging
    //102 - Error
    define('DEFAULT_CODE','101');
    
    
    class Logger{
        
        public static function write($msg, $code = DEFAULT_CODE, $file = DEFAULT_LOG){
            $fh = fopen($file,'a') or die("Fatal error in logger");
            
            fwrite($fh,date(\DateTime::ATOM)." -- Code: {$code}:".$msg."\r\n");
            
            fclose($fh);
        }
    }
?>