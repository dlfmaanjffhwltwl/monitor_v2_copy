<?php

class Car_Statistics_Model extends Model {

    //통계 관련 모델
    public function __construct() {
        // connect do DB
        parent::__construct();
    }

    public function showselect(){
        $result  = $this->_db->query('
        SELECT Car_terminal, Car_use, Car_number, Car_name, Car_content, Car_reg_date
        FROM car_info
        ')->results();
        if(!$result) {
            return false;
        }
        return $result;
    }

    //날짜별 마지막 데이터 추출하여 테이블을 생성하는 모델
    public function carByDayDateCreate(){
        $truncate  = $this->_db->query('
        TRUNCATE TABLE car_statistics
        ',[],false);
       if($truncate->error()) {
            return false;
        }

        $insert  = $this->_db->query('
        INSERT INTO car_statistics
        (Car_key, Car_terminal, MCU_VKT, MCU_BrkState, Acc_ALA, Car_reg_date)
        SELECT Car_key, Car_terminal, MCU_VKT, MCU_BrkState, Acc_ALA, max(Car_reg_date) AS Car_reg_date
                        FROM car_row_data
                        GROUP BY DATE(Car_reg_date),Car_terminal 
                        ORDER BY Car_terminal,Car_reg_date
        ',[],false);
       if(!$insert->error()) {
            return true;
        }
        
    }

    //최근 차량 단말기번호와 차량이름을 가져오는 모델
    public function getRecentCarNumberInfo(){
        $result = $this->_db->query('
        SELECT r.Car_Terminal,i.Car_Name FROM car_recent_data AS r
        INNER JOIN car_info AS i
        ON r.Car_Terminal = i.Car_Terminal
        ')->results();
        if(!$result) {
            return false;
        }
        return $result;
    }
    
    //최초 운행일과 마지막 운행일을 가져오는 모델
     public function getMaxMinDate() {
        $result  = $this->_db->query('
        SELECT  Date(MIN(Car_reg_date)) AS min ,Date(MAX(Car_reg_date)) AS max
	    FROM car_row_data
        ')->first();
        if(!$result) {
            return false;
        }
        return $result;
    }



    //날짜 나열 하는 모델 (minDate~maxDate까지 날짜 나열) mysql 8.0미만
    public function getDateList($minDate,$maxDate) {
        $minDate2 = $minDate;
        $result  = $this->_db->query('
        SELECT 
        DATE_FORMAT(DATE_ADD(:minDate, INTERVAL seq - 1 DAY), "%Y-%m-%d") AS dt
        FROM (SELECT @num := @num + 1 AS seq
              FROM information_schema.tables a
                 , information_schema.tables b
                 , (SELECT @num := 0) c
             ) T
        WHERE seq <=  DATEDIFF(:maxDate, :minDate2) + 1;
        ',[$minDate,$maxDate,$minDate2])->results();
        if(!$result) {
            return false;
        }
        return $result;
    }



    //날짜 나열 하는 모델 (minDate~maxDate까지 날짜 나열) mysql 8.0이상
    // public function getDateList($minDate,$maxDate) {
    //     $result  = $this->_db->query('
    //     WITH RECURSIVE cte  AS (
    //         SELECT date_format(:minDate,"%Y-%m-%d") AS dt FROM DUAL
    //         UNION ALL
    //         SELECT date_add(dt,INTERVAL 1 DAY) FROM cte
    //         WHERE dt < :maxDate
    //     )
    //     SELECT dt FROM cte
    //     ',[$minDate,$maxDate])->results();
    //     if(!$result) {
    //         return false;
    //     }
    //     return $result;
    // }

    
    //차량 날짜별 최종운행시간에 해당하는 거리 가져오는 모델
    public function gerCarDateDistance() {
        $result  = $this->_db->query('
        SELECT Car_Key, Car_Terminal, MCU_VKT, max(Car_reg_date) AS regDate, DATE(Car_reg_date) AS regDay
	    FROM car_row_data 
        GROUP BY DATE(Car_reg_date),Car_Terminal 
	    ORDER BY Car_Terminal,regDay
        ')->results();
        if(!$result) {
            return false;
        }
        return $result;
    }

     //차량 특정 기간동안 날짜별 최종운행시간에 해당하는 거리 가져오는 모델
      public function gerCarDatePeriodDistance($startDate,$endDate) {
        $result  = $this->_db->query('
        SELECT carKey, carTerminal, distance, max(regDate) AS regDate, DATE(regDate) AS regDay
        FROM car_row_data
        WHERE DATE(regdate) >=:startDate AND DATE(regdate) <=:endDate
        GROUP BY DATE(regdate),carTerminal 
        ORDER BY carTerminal,regDay
        ',[$startDate,$endDate])->results();
        if(!$result) {
            return false;
        }
        return $result;
    }

    //차량별 마지막 운행거리 가져오는 모델
    public function gerCarRecentDistance() {
        $result  = $this->_db->query('
        SELECT  Car_terminal, MAX(MCU_VKT) AS Distance 
        FROM car_statistics
        GROUP BY Car_terminal 
        ')->results();
        if(!$result) {
            return false;
        }
        return $result;
    }

    //차량별 마지막 브레이크 입력상태
    public function getCarRecentBreak(){
        $result  = $this->_db->query('
        SELECT  Car_terminal, MAX(MCU_BrkState) AS break 
        FROM car_statistics
        GROUP BY Car_terminal 
        ')->results();
        if(!$result) {
            return false;
        }
        return $result;
    }


    //차량별 마지막 횡가속도 입력상태
    public function getCarRecentAcc_ALA(){
        $result  = $this->_db->query('
        SELECT  Car_terminal, MAX(Acc_ALA) AS Acc_ALA 
        FROM car_statistics
        GROUP BY Car_terminal 
        ')->results();
        if(!$result) {
            return false;
        }
        return $result;
    }

    //차량별 마지막 종가속도 입력상태
    public function getCarRecentAcc_YACC(){
        $result = $this -> _db ->query('
        SELECT  Car_terminal, MAX(Acc_YACC) AS Acc_YACC
        FROM car_row_data
        GROUP BY Car_terminal 
        ')->results();
        if(!$result){
            return false;
        }
        return $result;
    }

    //차량별 마지막 요레이트 입력상태
    public function getCarRecentAcc_YR(){
        $result = $this -> _db ->query('
        SELECT  Car_terminal, MAX(Acc_YR) as Acc_YR
        FROM car_row_data
        GROUP BY Car_terminal  
        ')->results();
        if(!$result){
            return false;
        }
        return $result;
    }

    
    
    //차량별 특정기간동안 가져오는 종가속도
    public function getAcc_YACCPeriod($start,$end){
        $result = $this->_db->query('
        SELECT Car_terminal, ROUND(MAX(Acc_YACC)-MIN(Acc_YACC),2) As Acc_YACC
        FROM car_row_data
        WHERE Date(Car_reg_date)>=:start AND Date(Car_reg_date)<=:end
        GROUP BY Car_terminal
        ',[$start,$end])->results();
        if(!$result){
            return false;
        }
        return $result;
    }

    

    //차량별 특정기간동안 가져오는 요레이트
    public function getAcc_YRPeriod($start,$end){
        $result = $this->_db->query('
        SELECT Car_terminal, ROUND(MAX(Acc_YR)-MIN(Acc_YR),2) as Acc_YR
        FROM car_row_data
        WHERE Date(Car_reg_date)>=:start AND Date(Car_reg_date)<=:end
        GROUP BY Car_terminal
        ',[$start,$end])->results();
        if(!$result){
            return false;
        }
        return $result;
    }
    
   //차량별 특정기간 동안  운행거리 가져오는 모델
    public function gerCarPeriodDistance($start,$end) {
        $result  = $this->_db->query('
        SELECT  Car_terminal, Round(MAX(MCU_VKT)-MIN(MCU_VKT),2) AS Distance 
        FROM car_statistics
          WHERE Date(Car_reg_date)>=:start AND Date(Car_reg_date)<=:end
        GROUP BY Car_terminal 
        ', [$start,$end])->results();
        if(!$result) {
            return false;
        }
        return $result;
    }

    //차량별 특정기간 동안 브레이크 입력 횟수 가져오는 모델
    public function getBreakPeriod($start,$end){
        $result = $this->_db->query('
        SELECT Car_terminal, ROUND(MAX(MCU_BrkState)-MIN(MCU_BrkState),2) AS break
        FROM car_statistics
        WHERE Date(Car_reg_date)>=:start AND Date(Car_reg_date)<=:end
        GROUP BY Car_terminal
        ', [$start,$end])->results();
        if(!$result){
            return false;
        }
        return $result;
    }

    //차량병 특정기간 동안 횡가속도 입력 값 가져오는 모델
    public function getAcc_ALAPeriod($start,$end){
        $result = $this->_db->query('
        SELECT Car_terminal, ROUND(MAX(Acc_ALA)-MIN(Acc_ALA),2) As Acc_ALA
        FROM car_statistics
        WHERE Date(Car_reg_date)>=:start AND Date(Car_reg_date)<=:end
        GROUP BY Car_terminal
        ',[$start,$end])->results();
        if(!$result){
            return false;
        }
        return $result;
    }

    
    //차량 전체기간 동안 운행일수 가져오는 모델
    public function getCarNumberOfDays() {
        $result  = $this->_db->query('
        SELECT Car_terminal, COUNT(Car_key) as NumberOfDays
        FROM car_statistics
        GROUP BY Car_terminal
        ')->results();
        if(!$result) {
            return false;
        }
        return $result;
    }


    //차량 특정기간 동안 운행일수 가져오는 모델
    public function getCarPeriodNumberOfDays($start,$end) {
        $result  = $this->_db->query('
        SELECT Car_terminal, COUNT(Car_key) as NumberOfDays
        FROM car_statistics
        WHERE Date(Car_reg_date) >=:start AND  Date(Car_reg_date) <=:end
        GROUP BY Car_terminal
         ', [$start,$end])->results();
        if(!$result) {
            return false;
        }
        return $result;
    }

    //차량 전체기간 동안 가속페달 입력값 가져오는 모델
    public function getCarRecentAcclPos(){
        $result = $this->_db->query('
        SELECT 
            IF(c.category = 90, "90이상", c.category) AS category,
            IFNULL(b.cnt, 0) AS cnt,
            IFNULL(ROUND(b.acclPos, 2), 0) AS acclPos
        FROM 
            (
                SELECT -10 AS category UNION SELECT 0 UNION SELECT 10
                UNION SELECT 20 UNION SELECT 30 UNION SELECT 40
                UNION SELECT 50 UNION SELECT 60 UNION SELECT 70 UNION SELECT 80 UNION SELECT 90
            ) c
        LEFT JOIN
            (
                SELECT 
                    CONCAT(
                        CASE 
                            WHEN MCU_AcclPos BETWEEN 1 AND 9 THEN 0
                            WHEN MCU_AcclPos BETWEEN 10 AND 19 THEN 10
                            WHEN MCU_AcclPos BETWEEN 20 AND 29 THEN 20
                            WHEN MCU_AcclPos BETWEEN 30 AND 39 THEN 30
                            WHEN MCU_AcclPos BETWEEN 40 AND 49 THEN 40
                            WHEN MCU_AcclPos BETWEEN 50 AND 59 THEN 50
                            WHEN MCU_AcclPos BETWEEN 60 AND 69 THEN 60
                            WHEN MCU_AcclPos BETWEEN 70 AND 79 THEN 70
                            WHEN MCU_AcclPos BETWEEN 80 AND 89 THEN 80
                            WHEN MCU_AcclPos > 89 THEN 90
                        END
                    ) AS category,
                    COUNT(MCU_AcclPos) AS cnt,
                    ROUND(
                        COUNT(*) / (
                            SELECT COUNT(Car_key) 
                            FROM car_row_data 
                            WHERE MCU_AcclPos > 0
                        ), 4
                    ) * 100 AS acclPos
                FROM car_row_data
                WHERE MCU_AcclPos > 0
                GROUP BY category
            ) b ON c.category = b.category
        ORDER BY c.category
        ')->results();
        if(!$result){
            return false;
        }
        return $result;
    }

    //차량 전체기간 동안 차량속도 빈도를 가져오는 모델 mysql 8.0미만
    public function getCarSpeed() {
        $result  = $this->_db->query('
        SELECT if(c.category=90,"90이상",c.category) AS category ,ifnull(b.cnt,0) AS cnt,ifnull(round(b.speed,2),0)  AS speed
        FROM 
            (
                SELECT -10 AS category UNION SELECT 0 UNION SELECT 10
                UNION SELECT 20 UNION SELECT 30 UNION SELECT 40
                UNION SELECT 50 UNION SELECT 60 UNION SELECT 70 UNION SELECT 80 UNION SELECT 90
                ) c
        LEFT JOIN
            (SELECT category,cnt,ROUND(cnt/(
                SELECT count(Car_key) FROM car_row_data 
                                WHERE MCU_SPEED > 0
                ),4)*100 AS speed
            FROM 
                (SELECT 
                    CONCAT( case when MCU_SPEED BETWEEN  1 AND 9 then 0
                            when MCU_SPEED between  10 AND 19 then 10
                            when MCU_SPEED between 20 AND 29 then 20
                            when MCU_SPEED between  30 AND 39 then 30
                            when MCU_SPEED between  40 AND 49 then 40
                            when MCU_SPEED between  50 AND 59 then 50
                            when MCU_SPEED between  60 AND 69 then 60
                            when MCU_SPEED BETWEEN  70 AND 79 then 70
                            when MCU_SPEED BETWEEN  80 AND 89 then 80
                            when MCU_SPEED >89 then 90
                            end) AS category,
                            count(MCU_SPEED) AS cnt
                FROM car_row_data 
                WHERE MCU_SPEED > 0
                GROUP BY category) t
            ) b
        ON c.category = b.category
        ORDER BY c.category')->results();
        if(!$result) {
            return false;
        }
        return $result;
    }

    //차량 전체기간 동안 차량속도 빈도를 가져오는 모델 mysql 8.0이상
    // public function getCarSpeed() {
    //     $result  = $this->_db->query('SELECT if(c.category=90,"90이상",c.category) AS category ,ifnull(b.cnt,0) AS cnt,ifnull(round(b.speed,2),0)  AS speed
    //     FROM 
    //         (WITH RECURSIVE cte  AS (
    //             SELECT -10 AS category
    //             UNION ALL
    //             SELECT category+10 FROM cte
    //             WHERE category <90
    //         )SELECT category FROM cte) c
    //     LEFT JOIN
    //         (SELECT category,cnt,round(cnt/(SUM(cnt) OVER()),4)*100 AS speed
    //          FROM 
    //             (SELECT 
    //                 CONCAT( case when carSpeed BETWEEN  1 AND 9 then 0
    //                         when carSpeed between  10 AND 19 then 10
    //                         when carSpeed between 20 AND 29 then 20
    //                         when carSpeed between  30 AND 39 then 30
    //                         when carSpeed between  40 AND 49 then 40
    //                         when carSpeed between  50 AND 59 then 50
    //                         when carSpeed between  60 AND 69 then 60
    //                         when carSpeed BETWEEN  70 AND 79 then 70
    //                         when carSpeed BETWEEN  80 AND 89 then 80
    //                         when carSpeed >89 then 90
    //                         end) AS category,
    //                         count(carSpeed) AS cnt
    //             FROM car_row_data 
    //             WHERE carSpeed > 0
    //             GROUP BY category) t
    //         ) b
    //     ON c.category = b.category
    //     ORDER BY c.category')->results();
    //     if(!$result) {
    //         return false;
    //     }
    //     return $result;
    // }


    // 차량 특정 기간 동안 가속 페달 입력값 빈도를 가져오는 모델
    public function getAcclPosPeriod($startDate, $endDate) {
        $result = $this->_db->query('
        SELECT 
            IF(c.category = 90, "90이상", c.category) AS category,
            IFNULL(b.cnt, 0) AS cnt,
            IFNULL(ROUND(b.acclPos, 2), 0) AS acclPos
        FROM 
            (
                SELECT -10 AS category UNION SELECT 0 UNION SELECT 10
                UNION SELECT 20 UNION SELECT 30 UNION SELECT 40
                UNION SELECT 50 UNION SELECT 60 UNION SELECT 70 UNION SELECT 80 UNION SELECT 90
            ) c
        LEFT JOIN
            (
                SELECT 
                    CONCAT(
                        CASE 
                            WHEN MCU_AcclPos BETWEEN 1 AND 9 THEN 0
                            WHEN MCU_AcclPos BETWEEN 10 AND 19 THEN 10
                            WHEN MCU_AcclPos BETWEEN 20 AND 29 THEN 20
                            WHEN MCU_AcclPos BETWEEN 30 AND 39 THEN 30
                            WHEN MCU_AcclPos BETWEEN 40 AND 49 THEN 40
                            WHEN MCU_AcclPos BETWEEN 50 AND 59 THEN 50
                            WHEN MCU_AcclPos BETWEEN 60 AND 69 THEN 60
                            WHEN MCU_AcclPos BETWEEN 70 AND 79 THEN 70
                            WHEN MCU_AcclPos BETWEEN 80 AND 89 THEN 80
                            WHEN MCU_AcclPos > 89 THEN 90
                        END
                    ) AS category,
                    COUNT(MCU_AcclPos) AS cnt,
                    ROUND(
                        COUNT(*) / (
                            SELECT COUNT(Car_key) 
                            FROM car_row_data 
                            WHERE MCU_AcclPos > 0
                        ), 4
                    ) * 100 AS acclPos
                FROM car_row_data 
                WHERE GPS_Speed > 0 and Date(Car_reg_date) >= :startDate AND Date(Car_reg_date) <= :endDate
                GROUP BY category
            ) b
        ON c.category = b.category
        ORDER BY c.category;
        ', [$startDate,$endDate])->results();
        if (!$result) {
            return false;
        }
        return $result;
    }
    
    //차량 특정기간 동안 차량속도 빈도를 가져오는 모델 mysql 8.0미만
    public function getCarPeriodSpeed($startDate,$endDate) {
        $result  = $this->_db->query('
        SELECT if(c.category=90,"90이상",c.category) AS category, ifnull(b.cnt,0) AS cnt, ifnull(round(b.speed,2),0) AS speed
        FROM 
            (
                SELECT -10 AS category UNION SELECT 0 UNION SELECT 10
                UNION SELECT 20 UNION SELECT 30 UNION SELECT 40
                UNION SELECT 50 UNION SELECT 60 UNION SELECT 70 UNION SELECT 80 UNION SELECT 90
            ) c
        LEFT JOIN
            (SELECT category, cnt, ROUND(cnt / (
                SELECT count(Car_key) FROM car_row_data 
                WHERE MCU_SPEED > 0
            ), 4) * 100 AS speed
            FROM 
                (SELECT 
                    CONCAT(CASE 
                            WHEN MCU_SPEED BETWEEN 1 AND 9 THEN 0
                            WHEN MCU_SPEED BETWEEN 10 AND 19 THEN 10
                            WHEN MCU_SPEED BETWEEN 20 AND 29 THEN 20
                            WHEN MCU_SPEED BETWEEN 30 AND 39 THEN 30
                            WHEN MCU_SPEED BETWEEN 40 AND 49 THEN 40
                            WHEN MCU_SPEED BETWEEN 50 AND 59 THEN 50
                            WHEN MCU_SPEED BETWEEN 60 AND 69 THEN 60
                            WHEN MCU_SPEED BETWEEN 70 AND 79 THEN 70
                            WHEN MCU_SPEED BETWEEN 80 AND 89 THEN 80
                            WHEN MCU_SPEED > 89 THEN 90
                            END) AS category,
                            count(MCU_SPEED) AS cnt
                FROM car_row_data 
                WHERE GPS_Speed > 0 and Date(Car_reg_date) >= :startDate AND Date(Car_reg_date) <= :endDate
                GROUP BY category) t
            ) b
        ON c.category = b.category
        ORDER BY c.category
        ',[$startDate,$endDate])->results();
        if(!$result) {
            return false;
        }
        return $result;
    }



    //차량 특정기간 동안 차량속도 빈도를 가져오는 모델 mysql 8.0이상
    // public function getCarPeriodSpeed($start,$end) {
    //     $result  = $this->_db->query('SELECT if(c.category=90,"90이상",c.category) AS category ,ifnull(b.cnt,0) AS cnt,ifnull(round(b.speed,2),0) AS speed
    //     FROM 
    //         (WITH RECURSIVE cte  AS (
    //             SELECT -10 AS category
    //             UNION ALL
    //             SELECT category+10 FROM cte
    //             WHERE category <90
    //         )SELECT category FROM cte) c
    //     LEFT JOIN
    //         (SELECT category,cnt,round(cnt/(SUM(cnt) OVER()),4)*100 AS speed
    //          FROM 
    //             (SELECT 
    //                 CONCAT( case when carSpeed BETWEEN  1 AND 9 then 0
    //                         when carSpeed between  10 AND 19 then 10
    //                         when carSpeed between 20 AND 29 then 20
    //                         when carSpeed between  30 AND 39 then 30
    //                         when carSpeed between  40 AND 49 then 40
    //                         when carSpeed between  50 AND 59 then 50
    //                         when carSpeed between  60 AND 69 then 60
    //                         when carSpeed BETWEEN  70 AND 79 then 70
    //                         when carSpeed BETWEEN  80 AND 89 then 80
    //                         when carSpeed >89 then 90
    //                         end) AS category,
    //                         count(carSpeed) AS cnt
    //             FROM car_row_data 
    //             WHERE carSpeed > 0 and Date(regDate) >=:start AND  Date(regDate) <=:end
    //             GROUP BY category) t
    //         ) b
    //     ON c.category = b.category
    //     ORDER BY c.category',[$start,$end])->results();
    //     if(!$result) {
    //         return false;
    //     }
    //     return $result;
    // }


    //전체기간 차량 Rpm-Torque 데이터를 가져오는 모델
    public function getRpmTorque($carTerminal) {
        $result;
        $q1 = '
        SELECT Car_terminal, MCU_MotToq, MCU_MotSpd, COUNT(*) as cnt
        FROM (
            SELECT Car_terminal, MCU_MotToq, MCU_MotSpd, CONCAT(Car_terminal, MCU_MotToq, MCU_MotSpd) AS con
            FROM car_row_data
            WHERE (MCU_MotToq > 0 OR MCU_MotSpd > 0)
        ';
        $q2 = ' AND Car_terminal = :carTerminal';
        $q3 = ' ) c GROUP BY con ORDER BY Car_terminal';
        if ($carTerminal == "all") {
            $result = $this->_db->query($q1 . $q3)->results();
        } else {
            $result = $this->_db->query($q1 . $q2 . $q3, [':carTerminal' => $carTerminal])->results();
        }
        if (!$result) {
            return false;
        }
        return $result;
    }
    
    //특정기간 차량 Rpm-Torque 데이터를 가져오는 모델
    public function getRpmTorquePeriod($startDate, $endDate,$carTerminal) {
        $result;
        $q1 = '
        SELECT Car_terminal, MCU_MotToq, MCU_MotSpd, COUNT(*) as cnt
        FROM (
            SELECT Car_terminal, MCU_MotToq, MCU_MotSpd, CONCAT(Car_terminal, MCU_MotToq, MCU_MotSpd) AS con
            FROM car_row_data
            WHERE (MCU_MotToq > 0 OR MCU_MotSpd > 0)
            AND Car_reg_date >= :startDate
            AND Car_reg_date <= :endDate
        ';
        $q2 = ' AND Car_terminal = :carTerminal';
        $q3 = ' ) c GROUP BY con ORDER BY Car_terminal';
        
        if ($carTerminal == "all") {
            $result = $this->_db->query($q1 . $q3, [':startDate' => $startDate, ':endDate' => $endDate])->results();
        } else {
            $result = $this->_db->query($q1 . $q2 . $q3, [':carTerminal' => $carTerminal, ':startDate' => $startDate, ':endDate' => $endDate])->results();
        }
        
        if (!$result) {
            return false;
        }
        
        return $result;
    }

}