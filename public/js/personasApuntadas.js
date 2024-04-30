// Suponiendo que tienes un array de usuarios llamado 'users'
const users = ['Usuario1', 'Usuario2', 'Usuario3'];

const userList = document.querySelector('.user-list');

// Función para mostrar la lista de usuarios
function mostrarUsuarios() {
    userList.innerHTML = ''; // Limpiar lista antes de mostrarla de nuevo
    users.forEach(user => {
        const listItem = document.createElement('li');
        listItem.textContent = user;
        userList.appendChild(listItem);
    });
}

// Asignar evento click al botón para mostrar la lista de usuarios
const verListadoBtn = document.querySelector('.ver-listado');
verListadoBtn.addEventListener('click', () => {
    mostrarUsuarios();
});
