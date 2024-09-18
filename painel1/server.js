const express = require('express');
const path = require('path');
const app = express();
const server = require('http').createServer(app);
const os = require( 'os' );
const port = 3001;

// Identificando o Ip 
const interfaces = os.networkInterfaces();
const addresses = [];
for (let k in interfaces) {  
    for (let k2 in interfaces[k]) {
        let address = interfaces[k][k2];
        if (address.family === 'IPv4' && !address.internal) {
            addresses.push(address.address);
        }
    }
}

// CORS
const options ={
  cors:true,  
  origins:[`http://${addresses[0]}:${port}`],
 }

const io = require("socket.io")(server, options);

app.use(express.static(path.join(__dirname, 'public')));
app.set('views', path.join(__dirname, 'public'));
app.engine('html', require('ejs').renderFile);
app.set('view engine', 'html');

app.use('/', (req, res)=> {
  res.render('index.html');
});

// armazenando conversas
let messages = [];

// tipo de conexão do usuario 
io.on('connection', socket => {  
  socket.emit('previousMessages', messages)
  socket.on('sendMessage', data => {    
    messages.push(data);
    // Enviando conversas para o frontend
    socket.broadcast.emit('receivedMessage', data);
  });
});

const time = () => {
  return new Date().toISOString().replace(/T/, ' ').replace(/\..+/, '') + " | ";
};

time();
time();

const falar = texto => {
  console.log(texto)
  setTextMessage(texto)
  speakText()
}

server.listen(port, () => {  
  console.log('+----------------------------------------------+');
  console.log('|      CCB Painel de Atendimento - v2 2022     |');
  console.log('+----------------------------------------------+');
  console.log(`${time()} Servidor: Funcionando`);
  console.log(`${time()}       IP: ${addresses[0]}`);  
  console.log(`${time()}    Porta: ${port}`);        
  console.log('+----------------------------------------------+');
});