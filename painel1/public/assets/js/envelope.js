const emAtendimento = document.querySelector('#atendimento')
const places = document.querySelector('#localidade')
const localidadesAtendidas = document.querySelector('#placesAtendidas')
const btChamar = document.querySelector('#btChamar')
const btRepete = document.querySelector('#btRepete')

//debug
if (somControle == 1) {
  console.log('Som no Painel')
} else {
  console.log('Som no Controle')
}

const vozes = document.querySelector('#tipoVozes')
vozes.innerHTML = '<select id="vozes" size="3" style="display: none"></select>'

// Localidades
const igrejas = window.pimentas

function adicionaIgreja(element) {
  var option = new Option(element)
  const localidades = document.querySelector('#localidades')
  localidades.append(option)
  //console.log(option)
}

function arrayIgreja(element, index, array) {
  //console.log("[" + element[0] + "],[" + element[1]+"]");
  adicionaIgreja(element)
}

igrejas.forEach(arrayIgreja)

// Eventos no Button Chamar
btChamar.addEventListener('click', () => {
  const total_igrejas = localidades.options.length

  if (places.value != '' && total_igrejas > 0) {
    let localidade = places.value

    // Exibe em Atendimento
    emAtendimento.innerHTML = localidade

    places.value = ''

    document.querySelector('#btChamar').focus()

    enviarPainel(emAtendimento.innerText)
    //falar(emAtendimento.innerText)
  } else {
    alert('Selecione uma Localidade')
  }
})

// Evento no Button Repete
btRepete.addEventListener('click', () => {
  //Enviar para o Painel
  enviarPainel(emAtendimento.innerText)
  //falar('Última chamada, ' + emAtendimento.innerText)
})

const enviarPainel = text => {
  var messageObject = {
    painel: 3,
    place: text
  }

  renderPlace(messageObject)
  socket.emit('sendMessage', messageObject)
}

const repete = () => {
  var messageObject = {
    painel: 3,
    place: emAtendimento.innerHTML
  }

  renderPlace(messageObject)
  socket.emit('sendMessage', messageObject)
}

/*
const load = () => {  

  while (places.length) places.remove(0);

  local.forEach(itens =>{   

    let option = document.createElement('option');
    
    option.value = itens[0];
    option.text = itens[1];  

    places.appendChild(option);    
  });

  places.selectedIndex = 0;  
}
*/
