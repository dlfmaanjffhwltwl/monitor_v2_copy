<?php


class Login extends Controller {

	//메인으로 사용할 모델 불러오는 생성자 함수
    public function __construct() {
        $this->_model = $this->model("User_Model");
    }

    //로그인 화면 컨트롤러
	public function index() {
		Request::method('GET', function(){
		    // Load the view
			$this->view('login/index');
		});
	}

	//로그인시 아이디,비번 체크하여 세션에 정보를 넣는 컨트롤러	
	public function login() {
		Request::method('POST', function(){
			$result = 0;
			$userId = Input::get("userId");
            $userPw = Input::get("userPw");
			$user = $this->_model->getUser($userId);
			if($user){
				$result = 1;
				$saveUse = $user->User_use;
				$savePw = $user->User_pw;
				$saveLevel = $user->User_level;
				if($saveUse=="N"){
					$result = 2;
				}else{
					$match = password_verify($userPw, $savePw);
					if($match){
						$result = 3;
						Session::put("userId", $userId);
						Session::put("userLevel", $saveLevel);
					}
				}
			}
			echo json_encode($result);
		});
	}

	//로그아웃 컨트롤러	
	public function logout() {
		Request::method('GET', function(){
			Session::delete("userId");
			Session::delete("userLevel");
			Redirect::to("./");
		});
	}
}