<?php


class User extends Controller {  
    
    //메인으로 사용할 모델 불러오는 생성자 함수
    public function __construct() {
        $this->_model = $this->model("User_Model");
    }

    //사용자 화면 컨트롤러(단순 화면, carInspection과 비교 함수달라도 밑에 다른함수가 데이터 뿌리면 그값가져옴(다시말해 정보처리))
    public function index() {
		Request::method('GET', function(){
            $userList = $this->_model->getUserList();
            $userLevelList = $this->_model->getUserLevelList();
       
            //userLevelList,userList는 키, $userLevelList,$userList는 값(value)
			$user = ['userLevelList' =>$userLevelList ,'userList' => $userList];
			$this->view('user/index',$user);
		});	
	}

    //사용자 리스트 가져오는 컨트롤러
    //실 데이터 처리는 위가 아니라 여기서
	public function getUserList() {
		Request::method('POST', function(){
            $userList = $this->_model->getUserList();
			echo json_encode($userList);
		});
	}
    

    //사용자 등록 컨트롤러
	public function addUser() {
		Request::method('POST', function(){
            $result = false;
            if(Session::get("userLevel")==1){
                $userId = Input::get("userId");
                $userPw = Input::get("userPw");
                $userPw = password_hash($userPw, PASSWORD_BCRYPT);
                $userName = Input::get("userName");
                $userUse = Input::get("userUse");
                $userLevel = Input::get("userLevel");
                $result = $this->_model->addUser($userId,$userPw,$userName,$userUse,$userLevel);
            }
			echo json_encode($result);
		});
	}

    //사용자 정보 수정 컨트롤러
    public function editUser() {
		Request::method('POST', function(){
            $result = false;
            if(Session::get("userLevel")==1){
                $userId = Input::get("userId");
                $userPw = Input::get("userPw");
                if($userPw != ""){
                    $userPw = password_hash($userPw, PASSWORD_BCRYPT);
                }
                $userName = Input::get("userName");
                $userUse = Input::get("userUse");
                $userLevel = (int)Input::get("userLevel");
                $result = $this->_model->editUser($userId,$userPw,$userName,$userUse,$userLevel);
            }
			echo json_encode($result);
		});
	}

     //사용자 정보 삭제 컨트롤러
     public function delUser() {
		Request::method('POST', function(){
            $result = false;
            $data = json_decode(file_get_contents("php://input"),true);
            $userId = $data["userId"];
            $result = $this->_model->delUser($userId);
			echo json_encode($result);
		});
	}

    //사용자 아이디 중복 확인 컨트롤러
    public function getUserIdCheck() {
		Request::method('POST', function(){
            $result = false;
            $data = json_decode(file_get_contents("php://input"),true);
            $userId = $data["value"];
            $userIdCheck = $this->_model->getUserIdCheck($userId);
            if($userIdCheck->cnt == 0){
                $result = true;
            }
			echo json_encode($result);
		});
	}



}