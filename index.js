// BACKEND
const e = require('express');
const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);
const {Server} = require("socket.io");

const io = new Server(server, {
    cors: {
        // hubungin ke front end
        origin: ['http://127.0.0.1:8000', 'http://localhost:8000']
    }
});

// app.use(cors());

const PORT = process.env.PORT || 3002;

let tempId;
let loggedInUsers = []
let users = [];
let matchuser = [];
let turn = 'X';
let board = ['', '', '', '', '', '', '', '', ''];

io.on('connection', (socket) => {

    if(users.length === 2){
        socket.emit('full')
        return
    }

    if(users.length === 0){
        turn = 'X';
        board = ['', '', '', '', '', '', '', '', ''];
        
    }
    
    socket.on('sendUser', (data)=>{
        // console.log({...data})
        let user = {
            id: socket.id,
            // name: 'Player ' + (users.length + 1),
            symbol: users.length===0 ? 'X' : 'O',
            // number: (users.length + 1),
            // dating_id: tempUsers.dating_id
        };

        user = {...user, ...data};

        socket.emit('setUser', user)

        console.log(user)

        if(users.length === 0){
            users.push(user)
        }

        if(users.length === 1){
            if (users[0].gender != user.gender){
                users.push(user)
            }else{
                console.log('ga masuk')
            }
        }

        if(users.length === 2){
            const male = users.find((u)=> u.gender === '1')
            const female = users.find((u)=> u.gender === '2')

            console.log('titit')

            if (male && female && male.datingCode === female.datingCode){
                // Store ke database
                users= [];
                io.emit('tititBrutal', [male, female])
            }else if (male && female){
                io.emit('start', {
                    users: users,
                    turn:turn,
                    board: board,
                })
        
                io.sockets.emit('turn', turn);
            }
        }
    })

    // socket.on('login', (data)=>{
    //     user = {
    //         datingCode: data.datingCode,
    //         birthDate: data.birthDate,
    //         gender: data.gender,
    //         dating_id: data.dating_id,
    //         formatId: data.dating_id.substring(0,6)
    //     }
    //     console.log(user)
    // })

    // untuk kirim data ke frontend pake emit

    

    socket.on('move', (data)=>{
       board = data.board;
       turn = data.turn;
       io.emit('move', {
        board: board,
        turn: turn,
        i: data.i
       });

       turn = (turn === 'X') ? 'O' : 'X';
       io.sockets.emit('turn', turn);

       let winner = ''
        //Horizontal
       if(board[0] === board[1] && board[1] === board[2] && board[2] === board[0] !== ''){
        winner = board[0];
       }
       if(board[3] === board[4] && board[4] === board[5] && board[5] === board[3] !== ''){
        winner = board[3];
       }
       if(board[6] === board[7] && board[7] === board[8] && board[8] === board[6] !== ''){
        winner = board[6];
       }

       //Vertical
       if(board[0] === board[3] && board[3] === board[6] && board[6] === board[0] !== ''){
        winner = board[0];
       }
       if(board[1] === board[4] && board[4] === board[7] && board[7] === board[1] !== ''){
        winner = board[1];
       }
       if(board[2] === board[5] && board[5] === board[8] && board[8] === board[2] !== ''){
        winner = board[2];
       }

       //Diagonal
       if(board[0] === board[4] && board[4] === board[8] && board[8] === board[0] !== ''){
        winner = board[0];
       }
       if(board[2] === board[4] && board[4] === board[6] && board[6] === board[2] !== ''){
        winner = board[2];
       }

       if(winner !== ''){
        board = ['', '', '', '', '', '', '', '', ''];
        io.emit('winner', `Winner is ${winner}`)
        users = []
       }

        //check kalo draw
        let draw = true;
        for (let i = 0; i < 9; i++){
            if(board[i] === ''){
                draw = false
            }
        }

        if(draw){
            board = ['', '', '', '', '', '', '', '', ''];
            io.emit('winner', 'Draw');
        }
    })

    console.log(users)

    socket.on('disconnect', () => {
        users = users.filter((user) => user.id !== socket.id)
    })
});



// app.get('/coba', (req, res) => {
//   res.render('./resources/views/tictactoe.blade.php');
// });

app.get('/', (req, res) => {
    res.send('<h1>Hello world</h1>');
});

server.listen(PORT, () => {
  console.log('listening on : ' + PORT + '/');
});