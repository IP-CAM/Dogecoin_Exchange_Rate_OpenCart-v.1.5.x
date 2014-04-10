<?php  
/*
Copyright (c) 2014 Stephane Bres (jga)
Adapted with <3 by Stephane Bres @StephBres
Donations: DBjYqjDT5exc5HP88cyYQ3PnLRWinuiRF7
Donations: 1PMnrNJQ6BC58YRZrmjo56MfXw3V4k4b7g
Copyright (c) 2013 John Atkinson (jga)

Permission is hereby granted, free of charge, to any person obtaining a copy of this 
software and associated documentation files (the "Software"), to deal in the Software 
without restriction, including without limitation the rights to use, copy, modify, 
merge, publish, distribute, sublicense, and/or sell copies of the Software, and to 
permit persons to whom the Software is furnished to do so, subject to the following 
conditions:

The above copyright notice and this permission notice shall be included in all copies 
or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR 
PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE 
FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR 
OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER 
DEALINGS IN THE SOFTWARE.
*/
class ControllerCommondogecoinUpdate extends Controller {
	public function index() {
		if (extension_loaded('curl')) {
			$data = array();
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency WHERE code = 'DOG'");//Modify DOG by the code of DOGECOIN in your system
						
			if(!$query->row) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "currency (title, code, symbol_right, status) VALUES ('Dogecoin', 'DOG', ' Ɖ', '1')");
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency WHERE code = 'DOG'");
			}
			
			$format = '%Y-%m-%d %H:%M:%S';
			$last_string = $query->row['date_modified'];
			$current_string = strftime($format);
			$last_time = strptime($last_string,$format);
			$current_time = strptime($current_string,$format);
		
			$num_seconds = 3600; //every [this many] seconds, the update should run. 3600 will run every hour
			try{
				if($last_time['tm_year'] != $current_time['tm_year']) {
					$this->runUpdate();
				}
				else if($last_time['tm_yday'] != $current_time['tm_yday']) {
					$this->runUpdate();
				}
				else if($last_time['tm_hour'] != $current_time['tm_hour']) {
					$this->runUpdate();
				}
				else if(($last_time['tm_min']*60)+$last_time['tm_sec'] + $num_seconds < ($current_time['tm_min'] * 60) + $current_time['tm_sec']) {
					$this->runUpdate();
				}
			}
			catch (Exception $e) {
				//
			}
		}
	}
		
	public function runUpdate() {
		static $ch = null;
		if (is_null($ch)) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		}
		curl_setopt($ch, CURLOPT_URL, 'https://www.dogeapi.com/wow/v2/?a=get_current_price&convert_to=USD&amount_doge=1000');
	 
		// run the query
		$res = curl_exec($ch);
		if ($res === false) throw new Exception('Could not get reply: '.curl_error($ch));
		$dec = json_decode($res, true);
		if (!$dec) throw new Exception('Invalid data received, please make sure connection is working and requested API exists');
		$btcdata = $dec;
				
		$currency = "DOG";//Modify the code of DOGECOIN in your system

		$json = curl_exec($ch);
		$data = json_decode($json, true);
		$amount = $data['data']['amount'];
		$amount = $amount * 0.72;// Here we transform Into Euros Delete this line if you only want To convert into USD
		$amount = 1000 / $amount;
				
		if ((float)$amount)
		{
			$value = $amount;
			$this->db->query("UPDATE " . DB_PREFIX . "currency SET value = '" . (float)$value . "', date_modified = '" .  $this->db->escape(date('Y-m-d H:i:s')) . "' WHERE code = '" . $this->db->escape($currency) . "'");
		}
		$this->cache->delete('currency');
	}
}
?>