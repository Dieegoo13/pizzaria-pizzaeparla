const menubar = document.getElementById("menu");

function clickMenu() {
    // Se o menu estiver oculto, mostre-o, caso contrário, oculte-o
    if (menubar.style.display === 'flex' || menubar.style.display === '') {
        menubar.style.display = 'none'; // Oculta o menu se já estiver aberto
    } else {
        menubar.style.display = 'flex'; // Mostra o menu se estiver oculto
    }
}