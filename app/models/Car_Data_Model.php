<?php

//차량 센서데이터 관련 모델
class Car_Data_Model extends Model {

    public function __construct() {
        // connect do DB
        parent::__construct();
    }

    
    
    //모든차량 설정한 기간에 페이지별 limit 수량까지 데이터를 가져오는 모델
    public function getCarDataPageAllList($start,$end,$limit,$page) {
        $result  = $this->_db->query('
        SELECT * FROM
		    car_row_data AS c
        JOIN
            (SELECT Car_key
            FROM car_row_data 
            WHERE   DATE(Car_reg_date)>=:start AND DATE(Car_reg_date) <=:end ORDER BY Car_reg_date DESC  LIMIT :limit OFFSET :page) AS b
        ON c.Car_key = b.Car_key
        ', [$start,$end,$limit,$page])->results();
        if(!$result) {
            return false;
        }
        return $result;
    }

      //특정차량 설정한 기간에 페이지별 limit 수량까지 데이터를 가져오는 모델
    public function getCarDataPageList($start,$end,$limit,$page,$carList) {
        $carList =$this->_db->arrayToString($carList);
        $result  = $this->_db->query('
        SELECT * FROM
		    car_row_data AS c
        JOIN
            (SELECT Car_key
            FROM car_row_data 
            WHERE  Car_terminal IN ('.$carList.') AND DATE(Car_reg_date)>=:start AND DATE(Car_reg_date) <=:end ORDER BY Car_reg_date DESC  LIMIT :limit OFFSET :page) AS b
        ON c.Car_key = b.Car_key
        ', [$start,$end,$limit,$page])->results();
        if(!$result) {
            return false;
        }
        return $result;
    }

    //전체 차량 정보 row수 (페이지 끝을 설정하기 위함) 가져오는 모델
    public function getCarDataPageAllListCnt($start,$end) {
        $result  = $this->_db->query('
        SELECT Count(Car_key) as cnt
        FROM car_row_data 
        WHERE  DATE(Car_reg_date)>=:START AND DATE(Car_reg_date) <=:end 
        ', [$start,$end])->first();
        if(!$result) {
            return false;
        }
        return $result;
    }

      //특정 차량 정보 row수  (페이지 끊을 설정하기 위함) 가져오는 모델
      public function getCarDataPageListCnt($start,$end, $carList) {
        $carList =$this->_db->arrayToString($carList);
        $result  = $this->_db->query('
        SELECT Count(Car_key) as cnt
        FROM car_row_data Da
        WHERE  Car_terminal IN ('.$carList.') AND DATE(Car_reg_date)>=:START AND DATE(Car_reg_date) <=:end 
        ', [$start,$end])->first();
        if(!$result) {
            return false;
        }
        return $result;
    }


    //차량의 센서데이터 등록하는 모델
    public function addCarData($car) {
        //insert
       $insert = $this->_db->query('
       INSERT INTO car_row_data(
            Car_terminal, DCDC_state, OBC_fail, OBC_Voltage, OBC_Current, OBC_ActuTem
            , BMS_fail, BMS_state, BMS_Voltage, BMS_Current, BMS_SOC, BMS_SOH, MCU_state
            , MCU_fail, MCU_MotToq, MCU_MotSpd, MCU_SPEED, MCU_AcclPos, MCU_BrkState, MCU_MotTem
            , MCU_MCUTem, MCU_MotVoltage, MCU_MotCurrent, GPS_SA, GPS_Latitude, GPS_Longitude
            , GPS_Height, GPS_Speed, MCU_warning, MCU_moduleSt1, MCU_moduleSt2, MCU_VKT
            , Acc_YR, Acc_YACC, Acc_ALA, LDC_Voltage, LDC_Current, LDC_Tem, Car_reg_date, Car_db_date
        )
        VALUES (
            :Car_terminal, :DCDC_state, :OBC_fail, :OBC_Voltage, :OBC_Current, :OBC_ActuTem
            , :BMS_fail, :BMS_state, :BMS_Voltage, :BMS_Current, :BMS_SOC, :BMS_SOH, :MCU_state
            , :MCU_fail, :MCU_MotToq, :MCU_MotSpd, :MCU_SPEED, :MCU_AcclPos, :MCU_BrkState, :MCU_MotTem
            , :MCU_MCUTem, :MCU_MotVoltage, :MCU_MotCurrent, :GPS_SA, :GPS_Latitude, :GPS_Longitude
            , :GPS_Height, :GPS_Speed, :MCU_warning, :MCU_moduleSt1, :MCU_moduleSt2, :MCU_VKT
            ,:Acc_YR, :Acc_YACC, :Acc_ALA, :LDC_Voltage, :LDC_Current, :LDC_Tem, :Car_reg_date, NOW()
        )
       ', [$car["Car_terminal"],$car["DCDC_state"],$car["OBC_fail"],$car["OBC_Voltage"],$car["OBC_Current"],$car["OBC_ActuTem"],$car["BMS_fail"]
       ,$car["BMS_state"],$car["BMS_Voltage"],$car["BMS_Current"],$car["BMS_SOC"],$car["BMS_SOH"],$car["MCU_state"],$car["MCU_fail"]
       ,$car["MCU_MotToq"],$car["MCU_MotSpd"],$car["MCU_SPEED"],$car["MCU_AcclPos"],$car["MCU_BrkState"],$car["MCU_MotTem"],$car["MCU_MCUTem"]
       ,$car["MCU_MotVoltage"],$car["MCU_MotCurrent"],$car["GPS_SA"],$car["GPS_Latitude"],$car["GPS_Longitude"],$car["GPS_Height"],$car["GPS_Speed"]
       ,$car["MCU_warning"],$car["MCU_moduleSt1"],$car["MCU_moduleSt2"],$car["MCU_VKT"],$car["Acc_YR"],$car["Acc_YACC"],$car["Acc_ALA"],$car["LDC_Voltage"]
       ,$car["LDC_Current"],$car["LDC_Tem"],$car["Car_reg_date"]],false);

        if($insert->error()) {
            return false;
        }
        
       //car_recent_data 테이블에는 update 하여 최신데이터를 관리
        $update = $this->_db->query('
        UPDATE car_recent_data
        SET
            DCDC_state=:DCDC_state,
            OBC_fail=:OBC_fail,
            OBC_Voltage=:OBC_Voltage,
            OBC_Current=:OBC_Current,
            OBC_ActuTem=:OBC_ActuTem,
            BMS_fail=:BMS_fail,
            BMS_state=:BMS_state,
            BMS_Voltage=:BMS_Voltage,
            BMS_Current=:BMS_Current,
            BMS_SOC=:BMS_SOC,
            BMS_SOH=:BMS_SOH,
            MCU_state=:MCU_state,
            MCU_fail=:MCU_fail,
            MCU_MotToq=:MCU_MotToq,
            MCU_MotSpd=:MCU_MotSpd,
            MCU_SPEED=:MCU_SPEED,
            MCU_AcclPos=:MCU_AcclPos,
            MCU_BrkState=:MCU_BrkState,
            MCU_MotTem=:MCU_MotTem,
            MCU_MCUTem=:MCU_MCUTem,
            MCU_MotVoltage=:MCU_MotVoltage,
            MCU_MotCurrent=:MCU_MotCurrent,
            GPS_SA=:GPS_SA,
            GPS_Latitude=:GPS_Latitude,
            GPS_Longitude=:GPS_Longitude,
            GPS_Height=:GPS_Height,
            GPS_Speed=:GPS_Speed,
            MCU_warning=:MCU_warning,
            MCU_moduleSt1=:MCU_moduleSt1,
            MCU_moduleSt2=:MCU_moduleSt2,
            MCU_VKT=:MCU_VKT,
            Acc_YR=:Acc_YR,
            Acc_YACC=:Acc_YACC,
            Acc_ALA=:Acc_ALA,
            LDC_Voltage=:LDC_Voltage,
            LDC_Current=:LDC_Current,
            LDC_Tem=:LDC_Tem,
            Car_reg_date=:Car_reg_date
        WHERE Car_terminal=:Car_terminal
        ',[$car["DCDC_state"],$car["OBC_fail"],$car["OBC_Voltage"],$car["OBC_Current"],$car["OBC_ActuTem"],$car["BMS_fail"]
        ,$car["BMS_state"],$car["BMS_Voltage"],$car["BMS_Current"],$car["BMS_SOC"],$car["BMS_SOH"],$car["MCU_state"],$car["MCU_fail"]
        ,$car["MCU_MotToq"],$car["MCU_MotSpd"],$car["MCU_SPEED"],$car["MCU_AcclPos"],$car["MCU_BrkState"],$car["MCU_MotTem"],$car["MCU_MCUTem"]
        ,$car["MCU_MotVoltage"],$car["MCU_MotCurrent"],$car["GPS_SA"],$car["GPS_Latitude"],$car["GPS_Longitude"],$car["GPS_Height"],$car["GPS_Speed"]
        ,$car["MCU_warning"],$car["MCU_moduleSt1"],$car["MCU_moduleSt2"],$car["MCU_VKT"],$car["Acc_YR"],$car["Acc_YACC"],$car["Acc_ALA"],$car["LDC_Voltage"]
        ,$car["LDC_Current"],$car["LDC_Tem"],$car["Car_reg_date"],$car["Car_terminal"]],false);

        if(!$update->error()) {
            return true;
        }
        return false;
       
    }


     //차량 최신 센서 정보 리스트 가져오는 모델 (사용여부 Y , 위치좌표 0이 아닌 데이터)
    public function gerCarCurrentDataList() {
        $result  = $this->_db->query('
        SELECT  i.Car_name,i.Car_terminal, DCDC_state, OBC_fail, OBC_Voltage, OBC_Current, OBC_ActuTem, BMS_fail, BMS_state
        , BMS_Voltage, BMS_Current, BMS_SOC, BMS_SOH, MCU_state, MCU_fail, MCU_MotToq, MCU_MotSpd, MCU_SPEED, MCU_AcclPos, MCU_BrkState
        , MCU_MotTem, MCU_MCUTem, MCU_MotVoltage, MCU_MotCurrent, GPS_SA, GPS_Longitude, GPS_Latitude, GPS_Height, GPS_Speed, MCU_warning
        , MCU_moduleSt1, MCU_moduleSt2, MCU_VKT, Acc_YR, Acc_YACC, Acc_ALA, LDC_Voltage, LDC_Current, LDC_Tem,d.Car_reg_date
        FROM car_recent_data AS d
        INNER JOIN car_info as i
        ON d.Car_terminal = i.Car_terminal
        WHERE i.Car_use = "Y" AND GPS_Longitude != 0
        ')->results();
        if(!$result) {
            return false;
        }
        return $result;
    }

     //차량 기간 검색 (경로) mysql 8.0 미만버전
     public function gerCarPeriodListDetail($carTerminal,$start,$end,$zeroDistance) {
        $this->_db->query('set @prevLongitude := NULL;', [],false);
        $this->_db->query('set @prevLatitude := NULL; ', [],false);
        $this->_db->query('set @prevRegDate := NULL;', [],false);
        $q1 = '
            SELECT Car_terminal,GPS_Longitude,GPS_Latitude,Car_reg_date,ifnull(GPS_distance,0) AS GPS_distance
            ,(case when GPS_distance >(sec*300) or GPS_distance > 1000 then @vrank := @vrank+1 else @vrank := @vrank END) AS Map_group
            FROM
                (SELECT 	Car_terminal,GPS_Longitude,GPS_Latitude,Car_reg_date,lon,lat,regDate2
                            ,TIMESTAMPDIFF(SECOND,regDate2,Car_reg_date) AS sec
                            ,ROUND((6371*acos(cos(radians(GPS_Latitude))*cos(radians(lat))*cos(radians(lon)
                            -radians(GPS_Longitude))+sin(radians(GPS_Latitude))*sin(radians(lat))))*1000,0) AS GPS_distance
                FROM
                    (SELECT Car_terminal, GPS_Longitude, GPS_Latitude, Car_reg_date 
                                    ,@prevLongitude as lon
                                    ,@prevLongitude := GPS_Longitude
                                    ,@prevLatitude as lat
                                    ,@prevLatitude := GPS_Latitude
                                    ,@prevRegDate as regDate2
                                    ,@prevRegDate := Car_reg_date

                        FROM car_row_data 
                        WHERE  Car_terminal =:carTerminal
                        AND (GPS_Latitude >=33 AND GPS_Latitude<=44) AND (GPS_Longitude>=124 AND GPS_Longitude<=132) 
                        AND Car_reg_date >=:start AND  Car_reg_date <=:end
                        ORDER BY Car_reg_date asc
                    ) AS t
                ) AS tb,(SELECT @vrank := 0) AS b
        ';
        if($zeroDistance ==""){
            $q1 = $q1.' WHERE sec IS NULL OR GPS_distance != 0';
        }
        $result  = $this->_db->query($q1,[$carTerminal,$start,$end])->results();
        if(!$result) {
            return false;
        }
        return $result;
    }

        
    //  //차량 기간 검색 (경로) mysql 8.0 이상
    //  public function gerCarPeriodListDetail($carTerminal,$start,$end) {
    //     $result  = $this->_db->query('SELECT carKey,carTerminal,longitude,latitude,regDate,lon,lat,regDate2,sec,ifnull(distance,0) AS distance
    //     ,(case 	when distance >(sec*300) or distance > 1000 then @vrank := @vrank+1
    //                  else @vrank := @vrank
    //                 END
    //     ) AS mapGroup
    //     FROM
    //         (SELECT 	carKey,carTerminal,longitude,latitude,regDate,lon,lat,regDate2
    //                     ,TIMESTAMPDIFF(SECOND,regDate2,regDate) AS sec
    //                     ,ROUND((ST_DISTANCE_SPHERE(point(longitude , latitude), point(lon,lat))),0) AS distance
    //         FROM
    //             (SELECT 	carKey, carTerminal, longitude, latitude, regDate,
    //                         LAG(regDate) OVER(ORDER BY regDate) AS regDate2,
    //                          LAG(longitude) OVER(ORDER BY regDate) AS lon,
    //                          LAG(latitude) OVER(ORDER BY regDate) AS lat
    //             FROM car_row_data 
    //             WHERE  carTerminal =:carTerminal 
    //             AND (latitude >=33 AND latitude<=44) AND (longitude>=124 AND longitude<=132) 
    //             AND regDate >= :start AND  regDate <= :end
                
    //             ORDER BY regDate asc
    //             ) AS t
    //         ) AS tb,(SELECT @vrank := 0) AS b', [$carTerminal,$start,$end])->results();
    //     if(!$result) {
    //     return false;
    //     }
    //     return $result;
    // }

    
}