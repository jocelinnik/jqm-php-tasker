<?php

include "config.php";
include "functions.php";
include "DB.php";
include "Task.php";

$t = new Task();
$tasks = $t->getByStatus("0");

$tasks_list = "";
foreach($tasks as $task){
    $tasks_list .= "<li id='{$task->id}'>{$task->title}</li>";
}

?>

<div data-role="page">
    <div data-role="header">
        <h1>Tarefas</h1>
        <a href="taskAdd.php" class="ui-btn ui-btn-right">Adicionar</a>
        <a href="logout.php" class="ui-btn ui-btn-left">Logout</a>
    </div>

    <div data-role="content">
        <ul id="list" data-role="listview">
            <?php echo $tasks_list; ?>
        </ul>
    </div>

    <script>
        $("#list").on("swiperight", function(event){
            let li = $(this);
            let span = li.children();
            let idTask = li.attr("id");
            console.log("Excluindo " + span.html());
            $(this).animate({
                marginLeft: parseInt($(this).css("marginLeft"), 10)===0 ? $(this).outerWidth() : 0
            }).fadeOut("fast", function(){
                li.remove();
            });

            //completa a tarefa
            $.ajax({
                url: "doCompleteTask.php?taskId=" + idTask,
                success: function(result){
                    console.log(result);
                }
            });
        });
    </script>
</div>