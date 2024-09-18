/*
 *   Configuração de Saída do Som
 *   0 - Do Controle
 *   1 - Do Painel (Padrao)
 **/

localStorage.clear()
localStorage.setItem('som', 1)
localStorage.setItem('senha', 0)
localStorage.setItem('liberado', 0)

const btnSomControle = document.querySelector('#icon-controle')
const btnSomPainel = document.querySelector('#icon-painel')
const sinoOn =
  '<path fill-rule="evenodd" d="M6 8a6 6 0 1112 0v2.917c0 .703.228 1.387.65 1.95L20.7 15.6a1.5 1.5 0 01-1.2 2.4h-15a1.5 1.5 0 01-1.2-2.4l2.05-2.733a3.25 3.25 0 00.65-1.95V8zm6 13.5A3.502 3.502 0 018.645 19h6.71A3.502 3.502 0 0112 21.5z"></path>'
const sinoOff =
  '<path fill-rule="evenodd" d="M1.22 1.22a.75.75 0 011.06 0l20.5 20.5a.75.75 0 11-1.06 1.06L17.94 19H15.5a3.5 3.5 0 11-7 0H3.518a1.518 1.518 0 01-1.263-2.36l2.2-3.298A3.25 3.25 0 005 11.539V7c0-.294.025-.583.073-.866L1.22 2.28a.75.75 0 010-1.06zM10 19a2 2 0 104 0h-4zM6.5 7.56l9.94 9.94H3.517l-.007-.001-.006-.004-.004-.006-.001-.007.003-.01 2.2-3.298a4.75 4.75 0 00.797-2.635V7.56z"></path><path d="M12 2.5c-1.463 0-2.8.485-3.788 1.257l-.04.032a.75.75 0 11-.935-1.173l.05-.04C8.548 1.59 10.212 1 12 1c3.681 0 7 2.565 7 6v4.539c0 .642.19 1.269.546 1.803l1.328 1.992a.75.75 0 11-1.248.832l-1.328-1.992a4.75 4.75 0 01-.798-2.635V7c0-2.364-2.383-4.5-5.5-4.5z"></path>'

// Configuração Padrão
btnSomControle.innerHTML = sinoOff
btnSomPainel.innerHTML = sinoOn

// Controle de Som
document.querySelector('#btn-som-controle').addEventListener('click', () => {
  console.log('Som Ativado do Controle')
  // Som no Controle
  localStorage.setItem('som', 0)
  // Efeito Icone no Button
  btnSomControle.innerHTML = sinoOn
  btnSomPainel.innerHTML = sinoOff
})

// Controle de Som
document.querySelector('#btn-som-painel').addEventListener('click', () => {
  console.log('Som Ativado no Painel')
  // Som no Painel
  localStorage.setItem('som', 1)
  // Efeito Icone no Button
  btnSomControle.innerHTML = sinoOff
  btnSomPainel.innerHTML = sinoOn
})

// Informando a Senha inicial
document.querySelector('#senha').addEventListener('change', () => {
  let senha = document.querySelector('#senha').value
  console.log('Senha: ' + senha)
  localStorage.setItem('senha', senha)

  // Enviando para os Controles a Senha inicial
  var messageObject1 = {
    painel: 1,
    message: senha
  }
  renderSenha(messageObject1)
  socket.emit('sendMessage', messageObject1)

  var messageObject2 = {
    painel: 2,
    message: senha
  }
  renderSenha(messageObject2)
  socket.emit('sendMessage', messageObject2)
})

// Salvando a Configuração
document.querySelector('#save').addEventListener('click', () => {
  document.querySelector('#setup').className += ' hide'
  document.querySelector('#menus').classList.remove('hide')
})

$('#senha').mask('0000')
