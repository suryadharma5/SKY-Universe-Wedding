@extends('template.main')

@section('content')
    <div class="content w-100 h-100 p-0 d-flex flex-column justify-content-center align-items-center">
        <h3 class="fw-bold text-white">Tic Tac Toe</h3>
        <small class="text-white mb-3" id="message">Message</small>
        <div class="board d-flex align-items-center" style="width: 180px; height: 180px;">
            
        </div>
    </div>

    <script>
        // FRONTEND
        var userLogin = @json(Auth::user());
        console.log('tes' + userLogin)
        let user = null
        let users = []
        let turn = ''
        let board = [];

    
        // import { io } from "socket.io-client";


        var socket = io('http://localhost:3002', [
            {
                transports: ['websocket'],
            }
        ])
        
        
        socket.on('connect', ()=>{
            board = []
            document.getElementById('message').innerHTML = 'Waiting Other Player'
            socket.emit('sendUser', userLogin)
        })

        if(userLogin){
            socket.emit('login', userLogin)
        }

        socket.on('full', ()=>{
            document.getElementById('message').innerHTML = 'Room is Full'
        })

        socket.on('setUser', (data)=>{
            user = data;
            console.log(user)
        })

        socket.on('start', (data)=>{
            users = data.users;
            turn = data.turn;
            board = data.board;
            document.getElementById('message').innerHTML = `You are ${user.name} and your symbol is '${user.symbol}'` 
            renderBoard();
        })

        socket.on('turn', (data)=>{
            turn = data;
            document.getElementById('message').innerHTML = `Your symbol is ${user.symbol} and It's ${turn}'s turn`
        })

        socket.on('move', (data)=>{
            board = data.board,
            turn= data.turn;
            renderBoard()
        })

        socket.on('winner', (data)=>{
            board = ['', '', '', '', '', '', '', '', ''];
            document.getElementById('message').innerHTML = `${data}`
            setTimeout(() => {
                console.log('aa')
                window.location.reload();
            }, 3);
        
            // socket.emit('start', )
        })

        socket.on('disconnect', ()=>{
            document.getElementById('message').innerHTML = 'Disconnected'
        })

        window.onload= ()=> {
            // if(userLogin){
            //     socket.emit('login', userLogin)
            // }
            renderBoard();
        }

        const renderBoard = ()=> {
            let boardDiv = document.querySelector('.board')
            let boardHTML = '';
        
            for(let i=0 ; i < board.length; i++){
                boardHTML += `<div class="box border border-2 pt-3 fw-bold text-center ${board[i] === 'O' ? 'bg-primary' : board[i] === 'X' ? 'bg-success' : ''} text-white" style="min-width: 60px;min-height: 60px;max-width: 60px;max-height: 60px;font-size: 1.5rem" onclick="handleClick(${i})">${board[i]}</div>`
            }
        
            boardDiv.innerHTML= boardHTML
        }

        const handleClick = (i) => {
            console.log(turn)
            if(board[i] === ''){
                if(turn === user.symbol){
                    board[i] = user.symbol;
                    socket.emit('move', {
                        board: board,
                        turn: turn,
                    i: i,
                    })
                }
            }
            // if(board[i] === '' && turn === user.symbol){
            //         board[i] = user.symbol;
            //         socket.emit('move', {
            //             board: board,
            //             turn: turn,
            //         i: i,
            //         })
            
            // }
        }

    </script>
@endsection



<style>
    .content{
        background-color: #0e1726
    }

    #aming{
        display: none;
    }   

    .board{
        display: flex;
        flex-wrap: wrap;
    }

    .box:hover{
        cursor: pointer;
    }
</style>
{{-- <script src="/js/main.js"></script> --}}

