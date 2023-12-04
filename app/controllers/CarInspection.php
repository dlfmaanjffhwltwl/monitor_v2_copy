<?php


class CarInspection extends Controller {  
    
    public function __construct() {
        $this->_model = $this->model("Car_inspection_Model");
    }


    public function index() {
		Request::method('GET', function(){
            $carInfoList =  $this->model("Car_Info_Model")->getCarInfoList();
			$this->view('carinspection/index',$carInfoList);
		});	
	}

    //데이터 변수에 담고 데이터변수는 getCarInspection에 result에 담음
    //점검일자 리스트 가져오는 컨트롤러
    // public function getCarInspection(){
    //     Request::method('POST', function(){
    //         $chk = count($_POST);
    //         if($chk==0){
    //             echo json_encode(false);
    //         }else{
    //             $start = $_POST["start"];
    //             $end = $_POST["end"];
    //             $isAll = $_POST["isAll"];
    //             if($isAll == "true"){
    //                 $result = $this->_model->getCarInspection($start,$end);
    //             }else{
    //                 $carList = $_POST["carList"];
    //                 $result = $this->_model->getCarDriveList($start,$end,$carList);
    //             }
    //             echo json_encode($result);
    //         }
    //     });
    // }
    
    //변경전 점검일자 가져오는 컨트롤러
    public function getCarInspection(){
        Request::method('POST', function(){
            $data = json_decode(file_get_contents("php://input"),true);
            $result = $this->_model->getCarInspection($data);
            echo json_encode($result);
        });
    }
    
    //특정 차량의 마지막 작성한 운행 거리를 가져오는 컨트롤러
    public function getFinalDistance(){
        Request::method('POST', function(){
            $carTerminal = json_decode(file_get_contents("php://input"),true);
            $result = $this->_model->getFinalDistance($carTerminal);
            echo json_encode($result);
        });
    }
    
    //작성시 작성한 거리가 유효한지 확인하는 컨트롤러
    public function getCheckDistance(){
        Request::method('POST', function(){
           $data = json_decode(file_get_contents("php://input"),true);
           $result = $this -> _model->getCheckDistance($data);
           echo json_encode($result);
        });
    }

    //수정시 수정한 거리가 유효한지 확인하는 컨트롤러
    public function getCheckEditDistance(){
        Request::method('POST',function(){
            $data = json_decode(file_get_contents("php://input"),true);
            $result = $this->_model->getCheckEditDistance($data);
            echo json_encode($result);
        });
    }

    
    
}