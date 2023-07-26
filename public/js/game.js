const channel = window.Echo.channel('tic-tac-toe');

// Listen for the "update-game" event
channel.listen('.update-game', (data) => {
    updateBoard(data.position, data.player);
});

function updateBoard(position, player) {
    // Update the board based on the data received
    const cell = document.querySelector(`[data-position="${position}"]`);
    cell.textContent = player;
}

const cells = document.querySelectorAll('.cell');

cells.forEach(cell => {
    cell.addEventListener('click', () => {
        const position = cell.getAttribute('data-position');
        const player = 'X'; // Assuming the current player is X, you can change this logic based on your game flow
        // Kirim langkah ke server menggunakan AJAX
        axios.post('/move', { position, player })
            .then(response => {
                // Jika langkah berhasil, server akan broadcast event dan updateBoard akan dipanggil secara otomatis.
                console.log(response.data.message);
            })
            .catch(error => {
                console.error(error);
            });
    });
});