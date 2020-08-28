<div data-role="page">
    <div data-role="header">
        <a href="tasks.php" class="ui-btn" data-rel="back">Voltar</a>
        <h1>Adicionar Tarefa</h1>
    </div>

    <div data-role="content">
        <form action="doAddTask.php" method="post">
            <div class="ui-field-contain">
                <label for="title">Título:</label>
                <input type="text" name="title" id="title" value="<?php echo $_POST['title']; ?>">
            </div>

            <input type="submit" value="Enviar">
        </form>
    </div>
</div>