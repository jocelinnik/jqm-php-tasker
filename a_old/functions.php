<?php

function ShowDialog($caption, $text, $page=""){
    $link = "";
    if($page!="") $link = "<a href='$page' class='ui-btn'>Ok</a>";

    return "
        <div data-role='page' data-dialog='true'>
            <div data-role='header'>
                <h1> {$caption} </h1>
            </div>

            <div data-role='content'>
                {$text}
                {$link}
            </div>
        </div>
    ";
}

?>