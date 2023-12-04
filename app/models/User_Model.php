<?php

//사용자 관련 모델
class User_Model extends Model {

    public function __construct() {
        // connect do DB
        parent::__construct();
    }

 

    //사용자 정보 등록하는 모델
    public function addUser($userId,$userPw,$userName,$userUse,$userLevel) {
        $insert  = $this->_db->query('
        INSERT INTO car_user
        (User_Id, User_pw, User_name, User_use, User_level, User_reg_date)
	    VALUES (:userId, :userPw, :userName, :userUse, :userLevel, NOW())
        ',[$userId,$userPw,$userName,$userUse,$userLevel],false);
       if(!$insert->error()) {
            return true;
        }
        return false;
    }


    //사용자 정보 수정하는 모델
    public function editUser($userId,$userPw,$userName,$userUse,$userLevel) {
        $query ='
        UPDATE car_user
        SET
            User_name=:userName,
            User_use=:userUse,
            User_level=:userLevel
        WHERE User_Id=:userId
        ';
        $params = [$userName,$userUse,$userLevel,$userId];
        if($userPw !=""){
            $query ='
            UPDATE car_user
            SET
                User_name=:userName,
                User_pw=:userPw,
                User_use=:userUse,
                User_level=:userLevel
            WHERE User_Id=:userId
            ';
            $params = [$userName,$userPw,$userUse,$userLevel,$userId];
        }
        $insert  = $this->_db->query($query,$params,false);
       if(!$insert->error()) {
            return true;
        }
        return false;
    }


    //사용자 정보 삭제하는 모델
    public function delUser($userId) {
        $insert  = $this->_db->query('
        DELETE FROM car_user WHERE User_Id=:userId
        ',[$userId],false);
        if(!$insert->error()) {
            return true;
        }
        return false;
    }

    
    //특정 사용자 정보 가져오는 모델
    public function getUser($userId) {
        $result  = $this->_db->query('
        SELECT User_Id,User_pw, User_name, User_use, User_level, User_reg_date
	    FROM car_user WHERE User_Id=:userId
        ',[$userId])->first();
        if(!$result) {
            return false;
        }
        return $result;
    }



    //전체 사용자 정보 가져오는 모델
    public function getUserList() {
        $result  = $this->_db->query('
        SELECT u.User_Id, u.User_name, u.User_use, u.User_level,l.Level_name, u.User_reg_date
        FROM car_user AS u
        INNER JOIN car_user_level AS l
        ON  u.User_level = l.Level_key
        ORDER BY u.User_reg_date DESC 
        ')->results();
        if(!$result) {
            return false;
        }
        return $result;
    }

    //사용자 권한 정보를 가져오는 모델
    public function getUserLevelList() {
        $result  = $this->_db->query('
        SELECT Level_key, Level_name
        FROM car_user_level
        ORDER BY Level_key desc
        ')->results();
        if(!$result) {
            return false;
        }
        return $result;
    }
    

    //사용자 아이디 중복체크 하는 모델
    public function getUserIdCheck($userId) {
        $result  = $this->_db->query('
        SELECT count(User_Id) as cnt
        FROM car_user
        WHERE User_Id =:userId
        ',[$userId])->first();
        if(!$result) {
            return false;
        }
        return $result;
    }
    
}