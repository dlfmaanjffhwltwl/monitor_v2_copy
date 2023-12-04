<?php 

/*
 * App core class
 * Gets URL and loads controller
 * url 확인 및 컨트롤러로 연결
 */

class App {

	private $_controller 	= '';
	private $_method 		= 'index';
	private $_params 		= array();
	
	public function __construct() {
		$url = $this->getURL();
		$endUrl;			//주소 마지막부분 
		if($url !=null){
			foreach($url as $u) {
				$endUrl = $u;
		   }
		}
		// addCarData는 차량 센서를 받는 컨트롤러로 어디서는 접근 가능 
		if($url !=null && $endUrl=="addCarData"){
			$this->_controller = ucwords($url[0]);
				unset($url[0]);
		}else{	//아닐 경우 
			if(!Session::exists("userId") ){		//로그인 안되어 있다면 어떤 주소를 입력해도 로그인 페이지로
				$this->_controller = "Login";
			}else{									//로그인이 되어 있다면
				$this->_controller = "Home";
				if(Session::get("userLevel")==2 && $url){		//권한레벨 2(사용자)이면 사용자 메뉴 사용불가
					if($url[0]=="user"){
						Redirect::to("./");
					}
				}
				if ($url && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {	//컨트롤러명에 해당하는 파일이 있다면 진행
					$this->_controller = ucwords($url[0]);
					unset($url[0]);
				}
			}
		}
	


		// Require controller
		require_once '../app/controllers/' . $this->_controller . '.php';

		// Create new controller object
		$this->_controller = new $this->_controller;

		// Check, if the method is given in the URL
		if(isset($url[1])) {
			// Check, if method exists inside the controller class
			if(method_exists($this->_controller, $url[1])) {
				$this->_method = $url[1];
				unset($url[1]);
			}else{
				Redirect::to("./");
			}
		}

		// Get params from the URL
		$this->_params = $url ? array_values($url) : array();

		// Call method from the controller class, pass the params
		call_user_func_array(array($this->_controller, $this->_method), $this->_params);
	}

	private function getURL() {
		if (isset($_GET['url'])) {

			// Trim right slash
			$url = rtrim($_GET['url'], '/');
			// Sanitize URL string
			$url = filter_var($url, FILTER_SANITIZE_URL);
			// Convert into array
			$url = explode('/', $url);

			return $url;
		}
	}
}