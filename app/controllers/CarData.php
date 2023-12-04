<?php


class CarData extends Controller {  
    
    //메인으로 사용할 모델 불러오는 생성자 함수
    public function __construct() {
        $this->_model = $this->model("Car_Data_Model");
    }
    
   //데이터 메뉴 화면 컨트롤러
    public function index() {
		Request::method('GET', function(){
            $carInfoList =  $this->model("Car_Info_Model")->getCarInfoList();
			$this->view('carData/index',$carInfoList);
		});	
	}

    //차량 센서데이터를 INSERT하는 컨트롤러 추후 차량에서 데이터를 보낼때 해당 주소로 보내면 된다 https://루트주소/addCarData
    public function addCarData() {
		Request::method('POST', function(){
            $car = json_decode(file_get_contents("php://input"),true);
            $this->_model->addCarData($car);
            echo json_encode(true);
		});
        
	} 

    //csv다운클릭했을때 최대값 (현 5만개)까지 페이지별 검색해서 정보를 가져오는 컨트롤러
    public function getAllData() {
        Request::method('POST', function(){
            $data = json_decode(file_get_contents("php://input"),true);
            $isPage = $data["isPage"];
            $isAll = $data["isAll"];
            $start = $data["startDay"];
            $end = $data["endDay"];
            $page = $data["page"];
            $limit = $data["limit"];
            if( $isPage){
                $result = $this->_model->getCarDataPageAllList($start,$end,$limit,$page);
            }else{
                $result = $this->_model->getCarDataPageAllList($start,$end,$limit,$page);
            }

            echo json_encode($result);
        });
	} 

    //자동차 센서 데이터를 불러오는 함수 (모든차량인지 선택된차량만 인지 확인 하고 페이지별 호출하게 된다) 
    public function getCarDataList() {
        Request::method('POST', function(){
            $chk = count($_POST);
            $dee  = $_POST;
            if($chk==0){
                echo json_encode(false);
            }else{
                $totalCnt  = null;
                $carDataList =null;
                $carList = null;
                $qwqwr = $_POST;
                $start = $_POST["startDay"];
                $end = $_POST["endDay"];
                $draw = $_POST["draw"];
                $limit = (int)$_POST["length"];
                $page = (int)$_POST["start"];
                $isAll = $_POST["isAll"];
                if($draw=="1"){ //처음실행
                    if($isAll=="true"){
                        $totalCnt = $this->_model->getCarDataPageAllListCnt($start,$end)->cnt;
                    }else{
                        $carList = $_POST["carList"];
                        $totalCnt = $this->_model->getCarDataPageListCnt($start,$end,$carList)->cnt;
                    }
                }else{
                    $totalCnt =  (int)$_POST["recordsTotal"];
                }
                if($isAll=="true"){
                    $carDataList = $this->_model->getCarDataPageAllList($start,$end,$limit,$page);
                }else{
                    $carList = $_POST["carList"];
                    $carDataList = $this->_model->getCarDataPageList($start,$end,$limit,$page,$carList);
                }
                $result = ["draw" => $draw,"recordsTotal" => $totalCnt,"recordsFiltered" =>$totalCnt,"data" =>$carDataList ];
                echo json_encode($result);;
            }
        });
	} 


    //sse 통신 (차량의 최신 센서데이터만 가져와 프론트에 전달)
    public function carCurrentDataList() {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: text/event-stream; charset=utf-8');
        header('Cache-Control: no-cache');
        $carList = $this->_model->gerCarCurrentDataList();
        echo "retry:2000\ndata: " . json_encode($carList) . "\n\n";
        flush();
	} 
    

}