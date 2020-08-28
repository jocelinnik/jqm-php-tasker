function exibirModal(pagina, configs){
    let janela = `
        <div data-role='page' data-rel='dialog' id='popup'>
            <div data-role='header'>
                <h1>${configs.titulo}</h1>
            </div>
            <div data-role='content'>
                ${configs.mensagem}
                <a href='${configs.botao}' class='ui-btn'>Ok</a>
            </div>
        </div>
    `;

    $(pagina).append(janela);
    $('#popup').dialog();
}