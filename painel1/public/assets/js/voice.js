/* API SpeechSynthesis */

const vozSelecionada = document.querySelector('#vozes')
const utterance = new SpeechSynthesisUtterance()

const setTextMessage = text => {
  utterance.text = text
}

const speakText = () => {
  speechSynthesis.speak(utterance)
}

const falar = texto => {
  console.log(texto)
  setTextMessage(texto)
  speakText()
}

// Escolhendo Vozes

let voices = []

const setVoice = event => {

  const selectedVoice = voices.find(voice => voice.name === event.target.value)
  utterance.voice = selectedVoice
  //speechSynthesis.speak(utterance)
}

speechSynthesis.addEventListener('voiceschanged', () => {
  if ($('#vozes').length) {
    voices = speechSynthesis.getVoices()

    voices.forEach(({ name, lang }) => {
      if (lang == 'pt-BR') {
        const option = document.createElement('option')

        option.value = name
        option.textContent = `${lang} | ${name} `

        vozSelecionada.appendChild(option)
      }
    })

    // Visual
    vozSelecionada.selectedIndex = 2

    // Seleciona a voz do google pt-br manualmente
    utterance.voice = voices[14] // Linux - 14 | Win - 16
    //console.log(voices)
  }
})

if ($('#vozes').length) {
  vozSelecionada.addEventListener('change', setVoice)
}
