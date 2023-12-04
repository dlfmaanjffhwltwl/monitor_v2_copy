<?php


class Statistics extends Controller {

	//메인으로 사용할 모델 불러오는 생성자 함수
	public function __construct() {
        $this->_model = $this->model("Car_Statistics_Model");
    }

	//통계 화면 컨트롤러
	public function index() {
		Request::method('GET', function(){
			$carInfoList =  $this->model("Car_Info_Model")->getCarInfoList();
			$place = ['carInfoList' => $carInfoList];
			$this->view('statistics/index',$place);
		});
	}

	//rpmTorque 의 select 검색 컨트롤러
	public function showselect() {
		Request::method('POST', function(){
			$data = $this->model("Car_Statistics_Model")->showselect();
			echo json_encode($data);
			//error_log(json_encode($data));
		});
	}

	


	//주행거리(선) 데이터 만들어 주는 함수
	function dateLineGroup($dateList,$carDistance,$recentData,$isAll=true,$start="",$end=""){
		$hashMap =null;
		for($i=0; $i<count($recentData); $i++){
			$carTerminal = $recentData[$i]->Car_Terminal;
			$mapArray = array();
			$val = null;
			for($j=0; $j<count($dateList); $j++){
				$chk =false;
				$map =null;
				$dt = $dateList[$j]->dt;
				for($k=0; $k<count($carDistance); $k++){
					$cTerminal = $carDistance[$k]->Car_Terminal;
					$regDay = $carDistance[$k]->regDay;
					if($carTerminal == $cTerminal && $regDay==$dt){
						$val =  $carDistance[$k]->MCU_VKT;
						$chk = true;
					}
				}
				if($isAll){
					$map["date"] = $dt;
					$map["distanceLine"] = $val;
					$map["driving"]=$chk;
					array_push($mapArray, $map);
				}else{
					$dtTime = strtotime($dt);
					$startTime= strtotime($start);
					$endTime= strtotime($end);
					if($dtTime >=$startTime && $dtTime <=$endTime){
						$map["date"] = $dt;
						$map["distanceLine"] = $val;
						$map["driving"]=$chk;
						array_push($mapArray, $map);
					}
				}
			}
			//검증
			if(!$isAll){
				$nullCnt =0;
				for($k=0; $k<count($mapArray); $k++){
					$distance = $mapArray[$k]["distanceLine"];
					if($distance==null){
						$nullCnt++;
					}
				}
				if($nullCnt==count($mapArray)){
					continue;
				}
			}

			$hashMap[$carTerminal] = $mapArray;
		}
		return $hashMap;
	}

	
	//처음 가져오는 데이터
	public function getDataFirst() {
		Request::method('POST', function(){
			$this->_model-> carByDayDateCreate();
			$carDistance = $this->_model->gerCarRecentDistance();
			echo json_encode($carDistance);
		});
	}

	//처음 가져오는 제동관련 데이터
	public function getBreakDataFirst(){
		Request::method('POST', function(){
			$this->_model-> carByDayDateCreate();
			$break = $this->_model->getCarRecentBreak();
			echo json_encode($break);
		});
	}

	//처음가져오는 자세관련데이터
	public function getPostureDataFirst(){
		Request::method('POST', function(){
			$this->_model-> carByDayDateCreate();
			$posture = $this->_model->getCarRecentAcc_ALA();
			echo json_encode($posture);
		});
	}

	
	//프론트에서 선택한 그래프 종류에 따라 데이터를 가져오는 컨트롤러 (항목별 전체기간일때 아닐때로 구분)
	public function getData() {
		Request::method('POST', function(){
		 	$searchData = json_decode(file_get_contents("php://input"),true);
			$table = $searchData["table"];
			$graph = $searchData["graph"];
			$carTerminal = $searchData["carTerminal"];
			$periodType = $searchData["periodType"];
			if($table == "carTable"){
				if($graph=="Distance"){							//주행거리
					if($periodType=="전체기간"){
						$result = $this->_model->gerCarRecentDistance();
					}else{
						$startDate = $searchData["startDate"];
						$endDate = $searchData["endDate"];
						$result = $this->_model->gerCarPeriodDistance($startDate,$endDate);
					}
				}else if($graph=="distanceLine"){				//주행거리(선)
					$date = $this->_model->getMaxMinDate();
					$minDate = $date->min;
					$maxDate = $date->max;
					$dateList = $this->_model->getDateList($minDate,$maxDate);
					$recentData = $this->_model->getRecentCarNumberInfo();
					$carDistance = $this->_model->gerCarDateDistance();
					if($periodType=="전체기간"){
						$result = $this->dateLineGroup($dateList,$carDistance,$recentData);
					}else{
						$startDate = $searchData["startDate"];
						$endDate = $searchData["endDate"];
						$result = $this->dateLineGroup($dateList,$carDistance,$recentData,false,$startDate,$endDate);
					}
				}else if($graph=="NumberOfDays"){			//운행일수
					if($periodType=="전체기간"){
						$result = $this->_model->getCarNumberOfDays();
					}else{
						$startDate = $searchData["startDate"];
						$endDate = $searchData["endDate"];
						$result = $this->_model->getCarPeriodNumberOfDays($startDate,$endDate);
					}
				}else if($graph=="speed"){					//차속빈도
					if($periodType=="전체기간"){
						$result = $this->_model->getCarSpeed();
					}else{
						$startDate = $searchData["startDate"];
						$endDate = $searchData["endDate"];
						$result = $this->_model->getCarPeriodSpeed($startDate,$endDate);
					}
				}else if($graph=="rpmTorque"){				//Rpm-Torque 
					if($periodType=="전체기간"){
						$result = $this->_model->getRpmTorque($carTerminal);
					}else{
						$startDate = $searchData["startDate"];
						$endDate = $searchData["endDate"];
						$carTerminal = $searchData["carTerminal"];
						$result = $this->_model->getRpmTorquePeriod($startDate,$endDate,$carTerminal);
					}
				}
			}else if($table == "breakTable"){	//breakTable일경우
				if($graph=="break"){					//브레이크 입력상태		
					if($periodType=="전체기간"){		
						$result = $this->_model->getCarRecentBreak();
					}else{
						$startDate = $searchData["startDate"];
						$endDate = $searchData["endDate"];
						$result = $this->_model->getBreakPeriod($startDate,$endDate);
					}
				}
				else if($graph == "acclPos"){				//가속페달 입력 값
					if($periodType == "전체기간"){
						$result = $this->_model->getCarRecentAcclPos();
					}else{
						$startDate = $searchData["startDate"];
						$endDate = $searchData["endDate"];
						$result = $this->_model->getAcclPosPeriod($startDate,$endDate);
					}
				}
			}else if($table == "postureTable"){
				if($graph=="Acc_ALA"){							//횡가속도
					if($periodType=="전체기간"){
						$result = $this->_model->getCarRecentAcc_ALA();
					}else{
						$startDate = $searchData["startDate"];
						$endDate = $searchData["endDate"];
						$result = $this->_model->getAcc_ALAPeriod($startDate,$endDate);
					}
				}
				else if($graph =="Acc_YACC"){	//종가속도
					if($periodType=="전체기간"){
						$result = $this->_model->getCarRecentAcc_YACC();
					}else{
						$startDate = $searchData["startDate"];
						$endDate = $searchData["endDate"];
						$result = $this->_model->getAcc_YACCPeriod($startDate,$endDate);
					}
				}
				else if($graph =="Acc_YR"){	//요레이트
					if($periodType=="전체기간"){
						$result = $this->_model->getCarRecentAcc_YR();
					}else{
						$startDate = $searchData["startDate"];
						$endDate = $searchData["endDate"];
						$result = $this->_model->getAcc_YRPeriod($startDate,$endDate);
					}
				}
			}
			echo json_encode($result);
		});
	}
	
}	