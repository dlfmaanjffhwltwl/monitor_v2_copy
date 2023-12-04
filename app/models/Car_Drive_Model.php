<?php

class Car_Drive_Model extends Model {

    //차량 운행정보 관련 모델
    public function __construct() {
        // connect do DB
        parent::__construct();
    }


    // //운행일지 등록하는 모델
    // public function addCarDrive($drive) {
    //     $userId = Session::get("userId");
    //     $insert  = $this->_db->query('
    //     INSERT INTO car_drive
    //     (Drive_car_terminal, Drive_driver, Drive_purpose, Drive_significant, Drive_date, Drive_before_distance, Drive_after_distance, Drive_reg_user, Drive_reg_date)
    //     VALUES (:driveCarTerminal,:driveDriver,:drivePurpose,:driveSignificant,:driveDate,:driveBeforeDistance,:driveAfterDistance,:driveRegUser,NOW(),Drivereport)
    //     ',[$drive["driveCarTerminal"],$drive["driveDriver"],$drive["drivePurpose"],$drive["driveSignificant"],$drive["driveDate"],
    //     $drive["driveBeforeDistance"],$drive["driveAfterDistance"],$userId],false);
    //    if(!$insert->error()) {
    //         return true;
    //     }
    //     return false;
    // }
        //운행일지 등록하는 모델
            public function addCarDrive($drive) {
            $userId = Session::get("userId");
        // Drive_report 테이블에 Drivereport 값을 추가합니다.
            $insert = $this->_db->query('
            INSERT INTO car_drive
            (Drive_car_terminal, Drive_driver, Drive_purpose, Drive_significant, Drive_date, Drive_before_distance, Drive_after_distance, Drive_reg_user, Drive_reg_date, Drive_report)
            VALUES (:driveCarTerminal, :driveDriver, :drivePurpose, :driveSignificant, :driveDate, :driveBeforeDistance, :driveAfterDistance, :driveRegUser, NOW(), :driveReport)
            ', [
            $drive["driveCarTerminal"], $drive["driveDriver"], $drive["drivePurpose"], $drive["driveSignificant"], $drive["driveDate"],
            $drive["driveBeforeDistance"], $drive["driveAfterDistance"], $userId, $drive["driveReport"]
            ], false);

            if (!$insert->error()) {
            return true;
        }

        return false;
    }

    //운행일지 수정하는 모델
    public function editCarDrive($drive) {
        $driveRegUser = Session::get("userId");
        $insert  = $this->_db->query('
        UPDATE car_drive
        SET
            Drive_car_terminal=:driveCarTerminal,
            Drive_driver=:driveDriver,
            Drive_purpose=:drivePurpose,
            Drive_significant=:driveSignificant,
            Drive_date=:driveDate,
            Drive_before_distance=:driveBeforeDistance,
            Drive_after_distance=:driveAfterDistance,
            Drive_reg_user=:driveRegUser,
            Drive_reg_date=NOW()
        WHERE Drive_key=:driveKey
        ',[$drive["driveCarTerminal"],$drive["driveDriver"],$drive["drivePurpose"],$drive["driveSignificant"],$drive["driveDate"],
        $drive["driveBeforeDistance"],$drive["driveAfterDistance"],$driveRegUser,$drive["driveKey"]],false);
        if(!$insert->error()) {
            return true;
        }
        return false;
    }


    //운행일지 삭제하는 모델
    public function delCarDrive($driveKey) {
        $insert  = $this->_db->query('
        DELETE FROM car_drive WHERE Drive_key=:driveKey
        ',[$driveKey],false);
        if(!$insert->error()) {
            return true;
        }
        return false;
    }
    

    //마지막에 작성한 주행거리 가져오는 모델
    public function getFinalDistance($carTerminal) {
        $result  = $this->_db->query('
        SELECT MAX(Drive_after_distance) AS driveAfterDistance
        FROM car_drive  WHERE Drive_car_terminal =:carTerminal
        ', [$carTerminal])->first();
        if(!$result) {
            return false;
        }
        return $result;
    }

    //주행거리 중복 체크 (등록일때) 하는 모델
    public function getCheckDistance($data) {
        $result  = $this->_db->query('
        SELECT Drive_key, Drive_car_terminal, Drive_driver, Drive_purpose, Drive_significant, Drive_date, Drive_before_distance
        , Drive_after_distance, Drive_reg_user, Drive_reg_date
        FROM car_drive WHERE Drive_car_terminal =:driveCarTerminal AND  (Drive_before_distance <:afterDistance AND Drive_after_distance >:beforeDistance )
        ', [$data["driveCarTerminal"],$data["afterDistance"],$data["beforeDistance"]])->results();
        if(!$result) {
            return false;
        }
        return $result;
    }


    //주행거리 중복 체크 (수정일때) 하는 모델
    public function getCheckEditDistance($data) {
        $result  = $this->_db->query('
        SELECT Drive_key, Drive_car_terminal, Drive_driver, Drive_purpose, Drive_significant, Drive_date, Drive_before_distance
        , Drive_after_distance, Drive_reg_user, Drive_reg_date
        FROM car_drive WHERE Drive_car_terminal =:driveCarTerminal AND  (Drive_before_distance <:afterDistance AND Drive_after_distance >:beforeDistance )  
        AND Drive_key != :driveKey
        ', [$data["driveCarTerminal"],$data["afterDistance"],$data["beforeDistance"],$data["driveKey"]])->results();
        if(!$result) {
            return false;
        }
        return $result;
    }

    
    //모든차량  특정기간 운행일지 가져오는 모델
    public function getCarDriveAllList($start,$end) {
        $result  = $this->_db->query('
        SELECT d.Drive_key, d.Drive_car_terminal, d.Drive_driver, d.Drive_purpose, d.Drive_significant, d.Drive_date
        , d.Drive_before_distance, d.Drive_after_distance,d.Drive_distance, d.Drive_reg_user,CONCAT(ifnull(u.User_name,"")
        ," ","(",d.Drive_reg_user,")") AS Drive_reg_user_info,d.Drive_reg_date 
        From
            (SELECT Drive_key, Drive_car_terminal, Drive_driver, Drive_purpose, Drive_significant, Drive_date, Drive_before_distance
            , Drive_after_distance,(Drive_after_distance-Drive_before_distance)AS Drive_distance, Drive_reg_user, Drive_reg_date
            FROM car_drive
            WHERE DATE(Drive_reg_date)>=:START AND DATE(Drive_reg_date) <=:end) d
        LEFT JOIN car_user u
        ON d.Drive_reg_user = u.User_Id
        ', [$start,$end])->results();
        if(!$result) {
            return false;
        }
        return $result;
    }
        

    //특정차량 특정기간 운행일지 가져오는 모델
    public function getCarDriveList($start,$end,$carList) {
        $carList =$this->_db->arrayToString($carList);
        $result  = $this->_db->query('
        SELECT d.Drive_key, d.Drive_car_terminal, d.Drive_driver, d.Drive_purpose, d.Drive_significant, d.Drive_date
        , d.Drive_before_distance, d.Drive_after_distance,d.Drive_distance, d.Drive_reg_user,CONCAT(ifnull(u.User_name,"")
        ," ","(",d.Drive_reg_user,")") AS Drive_reg_user_info,d.Drive_reg_date 
        From
            (SELECT Drive_key, Drive_car_terminal, Drive_driver, Drive_purpose, Drive_significant, Drive_date, Drive_before_distance
            , Drive_after_distance,(Drive_after_distance-Drive_before_distance)AS Drive_distance, Drive_reg_user, Drive_reg_date
            FROM car_drive
            WHERE Drive_car_terminal IN ('.$carList.') AND DATE(Drive_reg_date)>=:START AND DATE(Drive_reg_date) <=:end) d
        LEFT JOIN car_user u
        ON d.Drive_reg_user = u.User_Id
        ', [$start,$end])->results();
        if(!$result) {
            return false;
        }
        return $result;
    }
    

    


    
}