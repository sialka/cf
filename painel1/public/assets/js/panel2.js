const socket = io(ip.io)
const somControle = localStorage.getItem('som')

/** Identificando o Painel */
const painel = document.querySelector('#atendimento')
const panelTitle = document.querySelector('#panel')

/** Removendo as animações */
painel.addEventListener('animationend', event => {
  painel.classList.remove('bounce-in-fwd')

  console.log('Painel ' + somControle)
  if (somControle == 1 && document.querySelector('#panel') != null) {
    console.log('Chamando Igreja (Painel): ' + painel.innerHTML)
    falar(painel.innerHTML)
  }
})

if (panelTitle) {
  // Titulo Atendimento Cartão
  panelTitle.innerText = title.panel3
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

    o.type = "sine";
    o.frequency.value = 830.6
    o.connect(context.destination);
    o.start();
    setTimeout(function(){ 
            o.stop();
    }, 100);

  }
}*/

/** Renderizar */
function renderPlace(message) {
  if (message.painel == 3) {
    //beep();

    if (somControle == 0 && document.querySelector('#panel') == null) {
      console.log('Chamando Igreja (Controle): ' + message.place)
      falar(message.place)
    }

    painel.innerHTML = message.place
    painel.classList.add('bounce-in-fwd')
  }
}

/** Socket */
socket.on('previousMessages', function (messages) {
  for (message of messages) {
    renderPlace(message)
  }
})

socket.on('receivedMessage', function (message) {
  renderPlace(message)
})
