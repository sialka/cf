const socket = io(ip.io)
const somControle = localStorage.getItem('som')

console.log(socket)

//debug
if (somControle == 1) {
  console.log('Som no Painel')
} else {
  console.log('Som no Controle')
}

/** Identificando o Painel */

if (document.querySelector('button') != null) {
  //const bt = document.querySelector('button');
  if (document.querySelector('button').style.display == 'none') {
    const form = document.querySelectorAll('p')
    const panel1 = document.querySelector('.cor-ficha')
    const panel2 = document.querySelector('.cor-reserva')

    const painelFicha = document.querySelector('#painel-ficha')
    const painelReserva = document.querySelector('#painel-reserva')

    painelFicha.innerHTML = localStorage.getItem('senha')
    painelReserva.innerHTML = localStorage.getItem('senha')

    panel1.innerText = title.panel1
    panel2.innerText = title.panel2

    /** Removendo as animações / Painel Ficha */
    form[0].addEventListener('animationend', event => {
      form[0].classList.remove('wobble-hor-bottom')
      const painelFicha = document.querySelector('#painel-ficha')

      // Falando no painel
      if (somControle == 1 && document.querySelector('#painel') != null) {
        console.log('Painel Ficha: falar')
        falar('Senha ' + painelFicha.innerHTML + ', Conferência de Ficha.')
      }
    })

    /** Removendo as animações / Painel Reserva */
    form[1].addEventListener('animationend', event => {
      form[1].classList.remove('wobble-hor-bottom')
      const painelReserva = document.querySelector('#painel-reserva')

      // Falando no painel
      if (somControle == 1 && document.querySelector('#painel') != null) {
        console.log('Painel Reserva: falar')
        falar('Senha ' + painelReserva.innerHTML + ', Reserva de Roupa.')
      }
    })
  }
}

/** Beep */
/*
function beep(){

  const controll = document.querySelector(".squares");

  // Se tiver no Painel emite som.
  if (controll) { 

    //https://marcgg.com/blog/2016/11/01/javascript-audio/
    const context = new AudioContext();

    const o = context.createOscillator();

    o.type = "triangle";
    o.connect(context.destination);
    o.start();
    setTimeout(function(){ 
            o.stop();
    }, 500);

  }
}*/

/** Renderizar mensagem dos controles Ficha e Reserva */
function renderSenha(message) {
  console.log('Enviando: ' + message.message)

  // Controle de Ficha
  if (message.painel == 1) {
    //waitButton();
    if (document.querySelector('#painel-ficha') != null) {
      const painelFicha = document.querySelector('#painel-ficha')
      //beep();
      // Falando no controle

      if (somControle == 0 && document.querySelector('#painel') == null) {
        console.log('Controle Ficha: falar')
        falar('Senha ' + message.message + ', Conferência de Ficha.')
      }

      painelFicha.innerHTML = message.message
      painelFicha.classList.add('wobble-hor-bottom')
    }
  }

  // Controle de Reserva
  if (message.painel == 2) {
    //waitButton();
    if (document.querySelector('#painel-reserva') != null) {
      const painelReserva = document.querySelector('#painel-reserva')
      //beep();
      //falar('Senha, ' + message.message + 'Reserva de Roupas.')

      if (somControle == 0 && document.querySelector('#painel') == null) {
        console.log('Controle Reserva: falar')
        falar('Senha ' + message.message + ', Reserva de Roupa.')
      }

      painelReserva.innerHTML = message.message
      painelReserva.classList.add('wobble-hor-bottom')
    }
  }
}

/** Socket */
socket.on('previousMessages', function (messages) {
  for (message of messages) {
    renderSenha(message)
  }
})

socket.on('receivedMessage', function (message) {
  renderSenha(message)
})

/** Submit (CHAMAR) */
$('#btnSubmit').submit(function (event) {
  event.preventDefault()

  // Identifica o Controle de Fichas
  if (document.getElementById('form-ficha')) {
    const message = document.getElementById('painel-ficha').innerText

    if (message.length) {
      var messageObject1 = {
        painel: 1,
        message: message
      }

      renderSenha(messageObject1)

      socket.emit('sendMessage', messageObject1)
    }
  }

  // Identificando o Controle Reserva
  if (document.getElementById('form-reserva')) {
    var message = document.getElementById('painel-reserva').innerText

    if (message.length) {
      var messageObject2 = {
        painel: 2,
        message: message
      }

      renderSenha(messageObject2)

      socket.emit('sendMessage', messageObject2)
    }
  }
})
