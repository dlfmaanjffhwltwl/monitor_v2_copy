<?php

class Path extends Controller {
	//메인으로 사용할 모델 불러오는 생성자 함수
	public function __construct() {
        $this->_model = $this->model("Car_Data_Model");
    }
	
	//경로 화면 컨트롤러	
	public function index() {
		Request::method('GET', function(){
			$carInfoList =  $this->model("Car_Info_Model")->getCarInfoList();
			$this->view('path/index',$carInfoList);
		});
	}

	//차량경로 검색시 검색정보를 받아 데이터를 전달해주는 컨트롤러	
	public function getPath() {
		Request::method('POST', function(){
			$carTerminal = Input::get("carTerminal");
			$start = Input::get("start");
			$end = Input::get("end");
			$time = Input::get("time");
			$zeroDistance = Input::get("zeroDistance");
			if($time==""){
				$start = $start." 00:00:00";
				$end = $end." 23:59:59";
			}
			$carList = $this->_model->gerCarPeriodListDetail($carTerminal,$start,$end,$zeroDistance);
			echo json_encode($carList);
		});
	}

}