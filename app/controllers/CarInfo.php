<?php


class CarInfo extends Controller {  
    //메인으로 사용할 모델 불러오는 생성자 함수
    public function __construct() {
        $this->_model = $this->model("Car_Info_Model");
    }

    //차량정보 메뉴 화면 컨트롤러
    public function index() {
		Request::method('GET', function(){
		    // Load the view
            $carInfoList = $this->_model->getCarInfoList();
			$this->view('carInfo/index',$carInfoList);
		});	
	}

    //차량정보 등록하는 컨트롤러
	public function addCarInfo() {
		Request::method('POST', function(){
            $result = false;
            if(Session::get("userLevel")==1){
                $carTerminal = Input::get("Car_terminal");
                $carNumber = Input::get("Car_number");
                $carName = Input::get("Car_name");
                $carContent = Input::get("Car_content");
                $carUse = Input::get("Car_use");
              
                $carInfoCheck = $this->_model->getCarInfoAddCheck($carTerminal,$carNumber,$carName);
                if($carInfoCheck->cnt == 0){
                    $result = $this->_model->addCarInfo($carTerminal,$carNumber,$carName,$carContent,$carUse);
                }
            }
            echo json_encode($result);
		});
	}

    //차량정보 수정하는 컨트롤러 (유저권한이 1레벨인 관리자만 수정가능)
    public function editCarInfo() {
		Request::method('POST', function(){
            $result = false;
            if(Session::get("userLevel")==1){
                $carTerminal = Input::get("Car_terminal");
                $carNumber = Input::get("Car_number");
                $carName = Input::get("Car_name");
                $carContent = Input::get("Car_content");
                $carUse = Input::get("Car_use");
               
                $carInfoCheck = $this->_model->getCarInfoEditCheck($carTerminal,$carNumber,$carName);
                if($carInfoCheck->cnt == 0){
                    $result = $this->_model->editCarInfo($carTerminal,$carNumber,$carName,$carContent,$carUse);
                }

            } 
			echo json_encode($result);
		});
	}

     //차량정보 삭제하는 컨트롤러 (유저권한이 1레벨인 관리자만 삭제가능)
     public function delCarInfo() {
		Request::method('POST', function(){
            $result = false;
            if(Session::get("userLevel")==1){
                $data = json_decode(file_get_contents("php://input"),true);
                $carTerminal = $data["carTerminal"];
                $result = $this->_model->delCarInfo($carTerminal);
            }
			echo json_encode($result);
		});
	}

    //차량 정보를 확인하는 컨트롤러 (차량 단말기번호, 차량번호, 차량이름이 중복되지 않도록)
    public function getCarInfoCheck() {
		Request::method('POST', function(){
            $result = false;
            $data = json_decode(file_get_contents("php://input"),true);
            $name = $data["name"];
            $value = $data["value"];
            $carInfoCheck = $this->_model->getCarInfoCheck($name,$value);
            if($carInfoCheck->cnt == 0){
                $result = true;
            }
			echo json_encode($result);
		});
	}


}