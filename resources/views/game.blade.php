@extends('template.main')

@section('content')
    <div id="app">
        <h1>Tic Tac Toe</h1>
        <div id="board" class="text-center">
            <div class="cell" data-position="0">X</div>
            <div class="cell" data-position="1">X</div>
            <div class="cell" data-position="2">X</div>
            <div class="cell" data-position="3">X</div>
            <div class="cell" data-position="4">X</div>
            <div class="cell" data-position="5">X</div>
            <div class="cell" data-position="6">X</div>
            <div class="cell" data-position="7">X</div>
            <div class="cell" data-position="8">X</div>  
        </div>
    </div>

    <style>
        .cell{
            display: flex;
            width:50px;
            height: 50px;
            border: solid black 1px;
            font-size: 1.2rem;
            align-items: center;
            justify-content: center;
        }

        .cell:hover{
            cursor: pointer;
        }

        #board{
            display: flex;
            width: 150px;
            height: 150px;
            flex-wrap: wrap;
        }
    </style>
    <script src="/js/game.js"></script>
    {{-- <script>
        const channel = window.Echo.private('tic-tac-toe');

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
    </script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
@endsection