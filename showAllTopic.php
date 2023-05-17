<?php

    require_once("dbManager.php");

    echo "<h2 class='py-3'>กระทู้ ทั้งหมด</h2>";

    $topics =getAlltopic();
    for($i=0; $i < count($topics); $i++)
    {
        $topic_name = $topics[$i]["topic"];
        $userName = $topics[$i]["userName"];
        $boardId = $topics[$i]["boardId"];
        $url = "topicView.php?return=".$boardId;

        echo "<a href='".$url."' class='list-group-item list-group-item-action d-flex gap-3 py-3' aria-current='true'>";
        echo "<img src='asset/651140.png' alt='twbs' width='32' height='32' class='rounded-circle flex-shrink-0'>";
        echo "<div class='d-flex gap-2 w-100 justify-content-between'>";
        echo "<div>";
        echo "<h5 class='mb-0'>".$topic_name."</h5>";
        echo "<p class='mb-0 opacity-75'>User:".$userName."</p>";
        echo "</div>";
        echo "</div>";
        echo "</a>";
    }

?>