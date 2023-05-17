<?php

    require_once("dbManager.php");

    if(isset($_GET['board_id']))
    {
        $boardId = $_GET['board_id'];
        $img = getImgBoard($boardId);

        if($img != null)
        {
            for($i=0; $i < count($img); $i++)
            {
                $file_path = "uploads/".$img[$i];
                echo "<div class='col-md-4'>";
                echo "<div class='card mb-4 box-shadow'>";
                echo "<img class='card-img-top' style='height: 300px; width: 100%; display: block;' src='".$file_path."' data-holder-rendered='true'>";
                echo "</div>";
                echo "</div>";
            }
        }
    }

?>