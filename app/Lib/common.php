<?php 
	class Common extends Object{
		/**
		 * Shortcut for Session setFlash().
		 *
		 * @param string $msg Mesagge to display
		 * @param string $class Type of message: 'error', 'success', 'alert'. (default 'error')
		 * @param string $id Message id. (default 'flash')
		 * @return void
		 */
		public static function setFlash($msg, $type = 'error', $id = 'flash') {
			if(!is_array($msg)){
				$message = $msg;
			}else{
				$message = '';
                $msg = self::formatArrayRecursive($msg);
				foreach($msg as $row){
					$message .= '<div>'.$row.'</div>';
				}
			}
			$element = 'flash_message';
			switch($type){
				case 'success':
					$class = 'alert alert-success';
					break;
				case 'error':
					$class = 'alert alert-error';
					break;
			}
			$params = compact('class');
	
			CakeSession::write("Message.{$id}", compact('message', 'element', 'params'));
		}
        
        /*
         * convert datetime to new format
         * 
         * @params string $str datetime need convert
         * @params string $fromFormat current datetime format
         * @params string $toFormat new datetime format
         * 
         * @return string
         */
        public static function convertDatetimeFormat($str, $fromFormat, $toFormat = 'Y-m-d H:i:s'){
            $date = date_create_from_format($fromFormat, $str);
            return $date->format($toFormat);
        }
        
        /*
         * display datetime based on timezone
         * 
         * @param string $datetime datetime need to convert
         * 
         * @return string
         */
        public static function displayDatetime($datetime){
        	$timezone = new DateTimeZone(Configure::read('Setting.timezone'));
        	$datetimeFormat = Configure::read('Setting.datetime_format');
        	
			$date = new DateTime($datetime, $timezone);
			
			return $date->format($datetimeFormat);
        }
        
        public function formatArrayRecursive($array) {
            $result = array();
            foreach ($array as $value) {
                if(is_array($value)){
                    $result = array_merge($result, self::formatArrayRecursive($value));
                }else{
                    $result[] = $value;
                }
            }
            return $result;
        }
        
	}	
?>