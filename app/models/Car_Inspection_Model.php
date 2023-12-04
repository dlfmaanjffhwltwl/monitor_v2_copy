<?php

class Car_Inspection_Model extends Model {

    //차량 운행정보 관련 모델
    public function __construct() {
        // connect do DB
        parent::__construct();
    }

    // // 수정할 쿼리
    // public function getCarInspection($start,$end) {
    //     $results = $this->_db->query('
    //     SELECT
    //         MAX(ci.car_Inspection_key) AS car_Inspection_key,
    //         ci.Inspection_car_terminal,
    //         MAX(ci.car_Inspection_content) AS car_Inspection_content,
    //         MAX(DATE_FORMAT(ci.car_Inspection_reg_date, "%Y-%m-%d")) AS car_Inspection_reg_date,
    //         MAX(ci.car_report) AS car_report,
    //         crd.DCDC_state,
    //         crd.MCU_warning,
    //         crd.OBC_fail,
    //         crd.BMS_fail
    //     FROM
    //         car_inspection ci
    //     LEFT JOIN
    //         car_row_data crd ON ci.Inspection_car_terminal = crd.Car_terminal
    //     WHERE ci.car_report = "N" AND DATE(ci.car_Inspection_reg_date) >= :start AND DATE(ci.car_Inspection_reg_date) <= :end
    //     GROUP BY
    //         ci.Inspection_car_terminal
    //     ',[$start,$end])->results();
    
    //     if (!$results) {
    //         return false;
    //     }
    
    //     return $results;
    // }


    //수정전 쿼리
    public function getCarInspection() {
        $results = $this->_db->query('
        SELECT
            MAX(ci.car_Inspection_key) AS car_Inspection_key,
            ci.Inspection_car_terminal,
            MAX(ci.car_Inspection_content) AS car_Inspection_content,
            MAX(DATE_FORMAT(ci.car_Inspection_reg_date, "%Y-%m-%d")) AS car_Inspection_reg_date,
            MAX(ci.car_report) AS car_report,
            crd.DCDC_state,
            crd.MCU_warning,
            crd.OBC_fail,
            crd.BMS_fail
        FROM
            car_inspection ci
        LEFT JOIN
            car_row_data crd ON ci.Inspection_car_terminal = crd.Car_terminal
        WHERE ci.car_report = "N"
        GROUP BY
            ci.Inspection_car_terminal
        ',)->results();
    
        if (!$results) {
            return false;
        }
        return $results;
    }
    

    //점검일지 등록하는 모델
    public function addCarInspection($drive) {
        $userId = Session::get("userId");
        $insert  = $this->_db->query('
        INSERT INTO car_drive
        (Drive_car_terminal, Drive_driver, Drive_purpose, Drive_significant, Drive_date, Drive_before_distance, Drive_after_distance, Drive_reg_user, Drive_reg_date)
        VALUES (:driveCarTerminal,:driveDriver,:drivePurpose,:driveSignificant,:driveDate,:driveBeforeDistance,:driveAfterDistance,:driveRegUser,NOW())
        ',[$drive["driveCarTerminal"],$drive["driveDriver"],$drive["drivePurpose"],$drive["driveSignificant"],$drive["driveDate"],
        $drive["driveBeforeDistance"],$drive["driveAfterDistance"],$userId],false);
       if(!$insert->error()) {
            return true;
        }
        return false;
    }

    

    //점검일지 수정하는 모델
    public function editCarInspection($drive) {
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


    //점검일지 삭제하는 모델
    public function delCarInspection($driveKey) {
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
    
    //참고용 쿼리(실험용)
    public function TestingTest(){
        $result = $this->_db->query('
        SELECT d.Drive_key, d.Drive_car_terminal, d.Drive_driver, d.Drive_purpose, d.Drive_significant, d.Drive_date,
        d.Drive_before_distance, d.Drive_after_distance, d.Drive_distance, d.Drive_reg_user,CONCAT(ifnull(u.User_name,"")
        ," ","(",d.Drive_reg_user,")") AS Drive_reg_user_info, d.Drive_reg_date
        FROM
            (SELECT Drive_key, Drive_car_terminal, Drive_driver, Dirve_purpose, Drive_significant, Drive_date, Drive_before,distance,
            Drive_after_distance,(Drive_after_distance - Drive_before_Distance)AS Drive_distance, Drive_reg_user, Drive_reg_date
            FROM car_drive
            WHERE DATE(Drive_reg_date)>= :START AND DATE(Drive_reg_date) <: end) d
            LEFT JOIN car_user u
            ON d.Drive_reg_user = u.User_Id
        ', [$start,$end])->results();
        if(!$result){
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
    

    // 점거일지 insert update 구상해야함
    // //컨트롤러쪽도 손봐야 할듯. 
    // public function insertAndUpdateCarDataFromJoinedQuery($drive) {
    //     $insertQuery = '
    //         INSERT INTO car_inspection (car_Inspection_key, Inspection_car_terminal, car_Inspection_content, car_Inspection_reg_date, car_report)
    //         VALUES (:carInspectionKey, :carTerminal, :carInspectionContent, :carInspectionRegDate, :carReport)
    //         ON DUPLICATE KEY UPDATE
    //         car_Inspection_content = VALUES(car_Inspection_content),
    //         car_Inspection_reg_date = VALUES(car_Inspection_reg_date),
    //         car_report = VALUES(car_report)
    //     ';
    
    //     $this->_db->query($insertQuery, [
    //         'carInspectionKey' => $carInspectionKey,
    //         'carTerminal' => $carTerminal,
    //         'carInspectionContent' => $carInspectionContent,
    //         'carInspectionRegDate' => $carInspectionRegDate,
    //         'carReport' => $carReport
    //     ]);
    
    //     // car_row_data 테이블 업데이트
    //     $updateQuery = '
    //         UPDATE car_row_data
    //         SET DCDC_state = :DCDCState,
    //             MCU_warning = :MCUWarning,
    //             OBC_fail = :OBCFail,
    //             BMS_fail = :BMSFail
    //         WHERE Car_terminal = :carTerminal
    //     ';
    
    //     $this->_db->query($updateQuery, [
    //         'DCDCState' => $DCDCState,
    //         'MCUWarning' => $MCUWarning,
    //         'OBCFail' => $OBCFail,
    //         'BMSFail' => $BMSFail,
    //         'carTerminal' => $carTerminal
    //     ]);
    
    //     return $this->_db->lastInsertId(); // 삽입된 행의 ID를 반환
    // }
    
    // // 사용 예시
    // $results = getCarInspection();
    // foreach ($results as $result) {
    //     insertAndUpdateCarDataFromJoinedQuery($result['car_Inspection_key'], $result['Inspection_car_terminal'], $result['car_Inspection_content'], $result['car_Inspection_reg_date'], $result['car_report'], $result['DCDC_state'], $result['MCU_warning'], $result['OBC_fail'], $result['BMS_fail']);
    // }

}