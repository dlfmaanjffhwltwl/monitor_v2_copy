<?php

//차량정보 관련 모델
class Car_Info_Model extends Model {

    public function __construct() {
        // connect do DB
        parent::__construct();
    }

 

    //차량정보 등록 하는 모델
    public function addCarInfo($carTerminal,$carNumber,$carName,$carContent,$carUse) {
        $insert  = $this->_db->query('
        INSERT INTO car_info
        (Car_terminal, Car_use, Car_number, Car_name, Car_content, Car_reg_date)
        VALUES (:carTerminal,:carUse, :carNumber, :carName, :carContent, NOW())
        ',[$carTerminal,$carUse,$carNumber,$carName,$carContent],false);
        if($insert->error()){
            return false;
        }

        $insert2  = $this->_db->query('
        INSERT INTO car_recent_data
        (Car_terminal, DCDC_state, OBC_fail, OBC_Voltage, OBC_Current, OBC_ActuTem, BMS_fail, BMS_state, BMS_Voltage, BMS_Current, BMS_SOC, BMS_SOH, MCU_state, MCU_fail, MCU_MotToq, MCU_MotSpd, MCU_SPEED, MCU_AcclPos, MCU_BrkState, MCU_MotTem, MCU_MCUTem, MCU_MotVoltage, MCU_MotCurrent, GPS_SA, GPS_Latitude, GPS_Longitude, GPS_Height, GPS_Speed, MCU_warning, MCU_moduleSt1, MCU_moduleSt2, MCU_VKT, Acc_YR, Acc_YACC, Acc_ALA, LDC_Voltage, LDC_Current, LDC_Tem, Car_reg_date)
        VALUES (:carTerminal, "", "", 0, 0, 0, "", "", 0, 0, 0, 0, "", "", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "", 0, 0, 0, 0, 0, 0, 0, 0, 0, NOW())
        ',[$carTerminal],false);
   
        if(!$insert2->error()) {
            return true;
        }

        return false;
    }

    //차량정보 수정 하는 모델
    public function editCarInfo($carTerminal,$carNumber,$carName,$carContent,$carUse) {
        $insert  = $this->_db->query('UPDATE car_info
        SET
            Car_use=:carUse,
            Car_number=:carNumber,
            Car_name=:carName,
            Car_content=:carContent,
            Car_reg_date=NOW()
        WHERE Car_terminal=:carTerminal',[$carUse,$carNumber,$carName,$carContent,$carTerminal],false);
        if(!$insert->error()) {
            return true;
        }
        return false;
    }


    //차량정보 삭제 하는 모델
    public function delCarInfo($carTerminal) {
        $results = ['result' => true, 'data' => null ];
        $delete  = $this->_db->query('
        DELETE FROM car_info WHERE Car_terminal=:carTerminal
        ',[$carTerminal],false);
        if($delete->error()) {
            $results['result'] = false;
            $results['data'] = $delete->errormsg();
        }

        $delete2  = $this->_db->query('
        DELETE FROM car_recent_data WHERE Car_terminal=:carTerminal
        ',[$carTerminal],false);
        if($delete2->error()) {
            $results['result'] = false;
            $results['data'] = $delete2->errormsg();
        }
        return $results;
    }


    //차량정보 리스트 가져오는 모델
    public function getCarInfoList() {
        $result  = $this->_db->query('
        SELECT Car_terminal, Car_use, Car_number, Car_name, Car_content, Car_reg_date
        FROM car_info
        ')->results();
        if(!$result) {
            return false;
        }
        return $result;
    }


    //차량등록 정보 다시한번 체크
    public function getCarInfoAddCheck($carTerminal,$carNumber,$carName) {
        $result  = $this->_db->query('
        SELECT COUNT(Car_terminal) AS cnt
        FROM car_info 
        WHERE Car_terminal=:carTerminal OR Car_number =:carNumber OR Car_name =:carName
        ',[$carTerminal,$carNumber,$carName])->first();
        if(!$result) {
            return false;
        }
        return $result;
    }

    //차량수정 정보 다시한번 체크하는 모델 (단말기번호,차번호,차이름등 중복)
    public function getCarInfoEditCheck($carTerminal,$carNumber,$carName) {
        $result  = $this->_db->query('
        SELECT COUNT(Car_terminal) AS cnt
        FROM car_info 
        WHERE not Car_terminal =:carTerminal AND (Car_number =:carNumber OR Car_name =:carName) 
        ',[$carTerminal,$carNumber,$carName])->first();
        if(!$result) {
            return false;
        }
        return $result;
    }
    
    //차량 정보 체크 하는 모델 (단말기번호,차번호,차이름등 중복)
    public function getCarInfoCheck($name,$value) {
        $result  = $this->_db->query('
        SELECT count('.$name.') as cnt
        FROM car_info
        WHERE '.$name.' =:value
        ',[$value])->first();
        if(!$result) {
            return false;
        }
        return $result;
    }
    
}