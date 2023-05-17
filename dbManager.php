<?php

    function createMysqlConnection()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "webboard";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    function insertUser( $userName, $email, $password)
    {
        $isSuccess = false;
        //Prepared Statement
        $conn = createMysqlConnection();

        $sql = "INSERT INTO users (user_id, user_name, user_email, user_password)
        VALUES (0, ?, ?, ?)";

        // prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $userName, $email ,$password);

        $isSuccess = $stmt->execute();

        $stmt->close();
        $conn->close();
        return $isSuccess;
    }

    function checkUserNameDB($userName){
        $isEixts = false; 
        //Prepared Statement
        $conn = createMysqlConnection();
        $sql = "SELECT * FROM `users` WHERE `user_name`=?;";

        // prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $userName);

        $isSuccess = $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0)
        {
            $isEixts = true;
        }

        $stmt->close();
        $conn->close();

        return $isEixts;
    }

    function checkEmailDB($email){
        $isEixts = false; 
        //Prepared Statement
        $conn = createMysqlConnection();
        $sql = "SELECT * FROM `users` WHERE `user_email`=?;";

        // prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);

        $isSuccess = $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0)
        {
            $isEixts = true;
        }

        $stmt->close();
        $conn->close();

        return $isEixts;
    }

    function getLoginUser($email, $password)
    {
        //Prepared Statement
        $conn = createMysqlConnection();
        $sql = "SELECT * FROM `users` WHERE `user_email`=? AND `user_password`=?;";

        //prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);

        $isSuccess = $stmt->execute();
        $result = $stmt->get_result();
    
        if($result->num_rows == 1)
        {
            $row = $result->fetch_assoc();
            $userData = array( "user_id"=>$row["user_id"],
                                "user_name"=>$row["user_name"],
                                "user_email"=>$row["user_email"] );

            $stmt->close();
            $conn->close();
            return $userData;
        }
        else
        {
            $stmt->close();
            $conn->close();
            return null;
        }
    }

    function insertBoard( $userId, $topic, $content)
    {
        //Prepared Statement
        $conn = createMysqlConnection();

        $sql = "INSERT INTO boards (board_id, user_id, topic, content)
        VALUES (0, ?, ?, ?)";

        // prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $userId, $topic ,$content);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    }

    function getLastestBoardId()
    {
         //Prepared Statement
         $conn = createMysqlConnection();
         $sql = "SELECT * FROM `boards` ORDER BY board_id DESC LIMIT 0,1;";
         $stmt = $conn->prepare($sql);
         $stmt->execute();
         $result = $stmt->get_result();

         $boradId ="";
         if($result->num_rows == 1)
         {
             $row = $result->fetch_assoc();
             $boradId = $row["board_id"];
         }

        $stmt->close();
        $conn->close();

        return $boradId;
    }


    function insertImg($boradId, $file_name)
    {
        //Prepared Statement
        $conn = createMysqlConnection();

        $sql = "INSERT INTO image (img_no, board_id, file_name)
        VALUES (0, ?, ?)";
        // prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $boradId, $file_name);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    }

    function getImgBoard($boradId)
    {
        //Prepared Statement
        $conn = createMysqlConnection();
        $sql = "SELECT * FROM `image` WHERE `board_id`=? ;";

        //prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $boradId);

        $isSuccess = $stmt->execute();
        $result = $stmt->get_result();
    
        if($result->num_rows > 0)
        {
            $imgBoard = array();
            while( $row = $result->fetch_assoc())
            {
                array_push($imgBoard, $row["file_name"]);
            }

            $stmt->close();
            $conn->close();
            return $imgBoard;
        }
        else
        {
            $stmt->close();
            $conn->close();
            return null;
        }
    }

    function getUserName($id){

        $conn = createMysqlConnection();
        $sql = "SELECT * FROM `users` WHERE `user_id` = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $userName="";
        if($result->num_rows == 1){

            $row = $result->fetch_assoc();
            $userName = $row["user_name"];
        }
        else
        {
            $userName = null;
        }

        $stmt->close();
        $conn->close();
        return $userName;
    }

    function getAlltopic(){
        //Prepared Statement
        $conn = createMysqlConnection();
        $sql = "SELECT * FROM `boards`;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $topic = array();
        if($result->num_rows > 0)
        {
            while( $row = $result->fetch_assoc())
            {
                $topic_row = array(
                    "boardId"=>$row["board_id"],
                    "user_id"=>$row["user_id"],
                    "topic" =>$row["topic"],
                    "userName" => getUserName($row["user_id"])
                );

                array_push($topic, $topic_row);
            }         
        }

        $stmt->close();
        $conn->close();
        return $topic;
    }

    function getTopicUser($userId)
    {
        //Prepared Statement
        $conn = createMysqlConnection();
        $sql = "SELECT * FROM `boards` WHERE `user_id`=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $topic = array();
        if($result->num_rows > 0)
        {
            while( $row = $result->fetch_assoc())
            {
                $topic_row = array(
                    "boardId"=>$row["board_id"],
                    "topic" =>$row["topic"]
                );

                array_push($topic, $topic_row);
            }         
        }

        $stmt->close();
        $conn->close();
        return $topic;
    }

    function getTopicById($boardId)
    {
     
        $conn = createMysqlConnection();
        $sql = "SELECT * FROM `boards` WHERE `board_id` = ? ;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $boardId);
        $stmt->execute();
        $result = $stmt->get_result();

        $topic = array();

        if($result->num_rows == 1){

            $row = $result->fetch_assoc();
            $topic = array("boardId"=>$row["board_id"],
                            "ownerId"=>$row["user_id"],
                            "header"=>$row["topic"],
                            "content"=>$row["content"],
                            "ownerName"=>getUserName($row["user_id"]));
        }
        else
        {
            $topic = null;
        }
        $stmt->close();
        $conn->close();
        return $topic;
    }

    function insertNewComment($boardId, $userId, $comment)
    {
        //Prepared Statement
        $conn = createMysqlConnection();

        $sql = "INSERT INTO comment (comment_id, board_id, user_id, comment_txt)
        VALUES (0, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $boardId, $userId, $comment);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    function getAllCommentBoard($boardId){
        $conn = createMysqlConnection();
        $sql = "SELECT * FROM `comment` WHERE `board_id` = ? ;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $boardId);
        $stmt->execute();
        $result = $stmt->get_result();

        $comments = array();

        if($result->num_rows > 0){

            while($row = $result->fetch_assoc())
            {
                $comment_row = array(
                                    "commentId" => $row["comment_id"],
                                    "userNameComment" => getUserName($row["user_id"]),
                                    "comment" => $row["comment_txt"]
                                );

                array_push($comments, $comment_row);
            }
        }
        else
        {
            $comments = null;
        }

        $stmt->close();
        $conn->close();
        return $comments;
    }

    function deleteBoardData($boardId)
    {
        $conn = createMysqlConnection();
        $sql = "DELETE FROM boards WHERE board_id = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $boardId);
        $stmt->execute();

        $sql = "DELETE FROM image WHERE board_id = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $boardId);
        $stmt->execute();

        $sql = "DELETE FROM comment WHERE board_id = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $boardId);
        $stmt->execute();
        
        $stmt->close();
        $conn->close();
    }

?>