// // FRONTEND
// let user = null
// let users = []
// let turn = ''
// let board = [];
// // var userData = @json(Auth::user());
// // import { io } from "socket.io-client";


// var socket = io('http://localhost:3002', [
//     {
//         transports: ['websocket'],
//     }
// ])

// socket.on('connect', ()=>{
//     user = null
//     board = []
//     document.getElementById('message').innerHTML = 'Waiting Other Player'
// })

// socket.on('full', ()=>{
//     document.getElementById('message').innerHTML = 'Room is Full'
// })

// socket.on('setUser', (data)=>{
//     user = data;
//     console.log(user)
// })

// socket.on('start', (data)=>{
//     users = data.users;
//     turn = data.turn;
//     board = data.board;
//     // document.getElementById('message').innerHTML = `You are ${user.name} and your symbol is '${user.symbol}'` 
//     renderBoard();
// })

// socket.on('turn', (data)=>{
//     turn = data;
//     document.getElementById('message').innerHTML = `Your symbol is ${user.symbol} and It's ${turn}'s turn`
// })

// socket.on('move', (data)=>{
//     board = data.board,
//     turn= data.turn;
//     renderBoard()
// })

// socket.on('winner', (data)=>{
//     board = ['', '', '', '', '', '', '', '', ''];
//     document.getElementById('message').innerHTML = `${data}`
//     setTimeout(() => {
//         console.log('aa')
//         window.location.reload();
//     }, 3);

//     // socket.emit('start', )
// })

// socket.on('disconnect', ()=>{
//     document.getElementById('message').innerHTML = 'Disconnected'
// })

// window.onload= ()=> {
//     renderBoard();
// }

// const renderBoard = ()=> {
//     let boardDiv = document.querySelector('.board')
//     let boardHTML = '';

//     for(let i=0 ; i < board.length; i++){
//         boardHTML += `<div class="box border border-2 pt-3 fw-bold text-center ${board[i] === 'O' ? 'bg-primary' : board[i] === 'X' ? 'bg-success' : ''} text-white" style="min-width: 60px;min-height: 60px;max-width: 60px;max-height: 60px;font-size: 1.5rem" onclick="handleClick(${i})">${board[i]}</div>`
//     }

//     boardDiv.innerHTML= boardHTML
// }

// const handleClick = (i) => {
//     console.log(turn)
//     if(board[i] === ''){
//         if(turn === user.symbol){
//             board[i] = user.symbol;
//             socket.emit('move', {
//                 board: board,
//                 turn: turn,
//             i: i,
//             })
//         }
//     }
// }