<?php


class CarDrive extends Controller {  
    
    //메인으로 사용할 모델 불러오는 생성자 함수
    public function __construct() {
        $this->_model = $this->model("Car_Drive_Model");
    }

    //운행일지 메뉴 화면 컨트롤러
    public function index() {
		Request::method('GET', function(){
            $carInfoList =  $this->model("Car_Info_Model")->getCarInfoList();
			$this->view('carDrive/index',$carInfoList);
		});	
	}

    //특정 차량의 마지막 작성한 운행 거리를 가져오는 컨트롤러
    public function getFinalDistance() {
        Request::method('POST', function(){
            $carTerminal = json_decode(file_get_contents("php://input"),true);
            $result = $this->_model->getFinalDistance($carTerminal);
            echo json_encode($result);
         
        });
	} 

    //작성시 작성한 거리가 유효한지 확인하는 컨트롤러
    public function getCheckDistance() {
        Request::method('POST', function(){
            $data = json_decode(file_get_contents("php://input"),true);
            $result = $this->_model->getCheckDistance($data);
            echo json_encode($result);
        });
	} 

    //수정시 수정한 거리가 유효한지 확인하는 컨트롤러
    public function getCheckEditDistance() {
        Request::method('POST', function(){
            $data = json_decode(file_get_contents("php://input"),true);
            $result = $this->_model->getCheckEditDistance($data);
            echo json_encode($result);
        });
	} 

    //운행일지 리스트를 가져오는 컨트롤러
    public function getCarDriveList() {
        Request::method('POST', function(){
            $chk = count($_POST);
            if($chk==0){
                echo json_encode(false);
            }else{
                $start = $_POST["start"];
                $end = $_POST["end"];
                $isAll = $_POST["isAll"];
                if($isAll=="true"){
                    $result = $this->_model->getCarDriveAllList($start,$end);
                }else{
                    $carList = $_POST["carList"];
                    $result = $this->_model->getCarDriveList($start,$end, $carList);
                }
               
                echo json_encode($result);
            }
        });
	} 

    //운행일지를 등록하는 컨트롤러
    public function addCarDrive() {
        Request::method('POST', function(){
            $chk = count($_POST);
            if($chk==0){
                echo json_encode(false);
            }else{
                $result = $this->_model->addCarDrive($_POST);
                echo json_encode($result);
            }
        });
	} 

    //운행일지를 수정하는 컨트롤러
    public function editCarDrive() {
        Request::method('POST', function(){
            $chk = count($_POST);
            if($chk==0){
                echo json_encode(false);
            }else{
                $result = $this->_model->editCarDrive($_POST);
                echo json_encode($result);
            }
        });
	} 

    //운행일지 내역을 삭제하는 컨트롤러
    public function delCarDrive() {
        Request::method('POST', function(){
            $result = false;
            $data = json_decode(file_get_contents("php://input"),true);
            $driveKey = $data["driveKey"];
            $result = $this->_model->delCarDrive($driveKey);
            echo json_encode($result);
        });
    }
   
}