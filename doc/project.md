# PAINEL PIEDADE (CAKEPHP)

## DORES

1. CHAMAR OS ATENDIMENTOS POR SENHA
2. RELACIONAR SENHA COM IGREJA
4. PAINEL 1: EXIBIR SENHAS - STATUS: ATENDIDO,PENDENTE
3. PAINEL 2: EXIBIR APENAS AS IGREJAS QUE SERÃO CHAMADAS - STATUS: ?

## MODELAGEM

ENTIDADES:

SENHA:
- NUMERO 
- LOCALIDADE
- CARTAO
- STATUS

LOCALIDADE:
- NOME

PAINEL1:
- LISTA: SENHAS{}

PAINEL2:
- LISTA: SENHAS{}

## ROADMAP 1

## ROADMAP 2 

---

# REGRAS DE NEGÓCIO

**Adm**

1. Chamar senhas: 1 a (?) +-29 

ToDo: 
- Criar Testes
- confirmar ultima senha 
- deixar parametrizado no a ultima senha no sistema

2. Identificar Senha

ToDo:
- Testar junto 2 e 3
- Criar Testes

3. Painel

ToDo:
- Criar Testes

**Painel:**

- a cada +- (3seg) verifica a tabela fila_setor4 (where status = true)
    **Execução:**
    - chamar função que deverar direcionar o fluxo
    
- se tiver senhas: prioriza chamar todas as senhas
    **Execução:**
    - devolver array com todas as senhas [1,2,3]
    - o painel deve chamar todas as senhas com intervalo de 3 segundos
    
- se não tiver senhas exibir no painel o status das senhas identificadas
    **Execução:**
    - receber os dados
    - exibir os dados de 3 em 3

1. (fluxo) 
Verificar se tem senhas para chamar [fila: 1, 2, 3, 4]
    - Sim: Pegar todas as senhas e ir chamando
    - Não: Pula para o fluxo 2
2. (fluxo) 
Exibir no painel o status das senhas identificadas por ciclo 3 por vez

**Ciclos:**

- A cada ciclo tem +-3 segundos
- no 1o. ciclo: verifica fluxo 1 (prioridade)
- no 2o. ciclo: sem senha p/ chamar exibe o status das senhas [1,2,3]
- no 3o. ciclo: verifica fluxo 1 (prioridade) 
- no 4o. ciclo: sem senha p/ chamar exibe o status das senhas [4,5,6]
etc...

**2. ENDPOINTS**

1. Chamar Senha - Conferencia de Ficha.

   verbo: PUT
endpoint: http://localhost:3000/ficha/1
    body: { senha: 1, tipo: 'ficha' }

X. Receber Definições de Senhas

   verbo: GET
endpoint: http://localhost:3000/senhas
Resposta: 
  senhas: {
    { senha: 1, localidade: 'BAIRRO DOS PIMENTAS', status_ficha_id: 1, status_envelope_id: 1 },
    { senha: 1, localidade: 'BAIRRO DOS PIMENTAS', ficha: 1, envelope: 1 },
    { senha: 1, localidade: 'BAIRRO DOS PIMENTAS', ficha: 1, envelope: 1 },
}


## DEFINIÇÕES

**DB**

1. db MySQL

Tabelas: (Fase 1)
    
    **ADM**
    
    **users**
    - id: int primary key auto_incremnt
    - nome varchar(50) not null
    - username varchar(50) not null
    - email varchar(255) not null
    - password varchar(255) not null
    - perfil_id tinyint not null
    - status tinyint not null 
    - created timestamp
    - modified timestamp

    **PAINEL**
    
    **fila_setor4:** 
    - id: int primary key
    - senha int not null
    - tipo int not null
    - status bolean default false
    - created timestamp
    
    **painel_setor4:**
    - id: int primary key
    - senha: int not noll
    - localidade int not null
    - status_ficha int not null
    - status_envelope int not null
    - created timestamp
    - modified timestamp
    
    **localidades_setor4**
    - id: int primary key
    - localidade varchar(255) not null
    - status bolean default true
    - created timestamp
    - modified timestamp

---
## FRONT-END

Login -> Admin Senhas: ( Chamar | Identificar Senhas )
      -> Painel
      

**PAINEL FLUXO**

1. START // Prepara as row dos painel

ToDo: 

Gerar um layout que compreende as duas situações: 
- chamar senha
- status de senhas

2. CARREGAR // Direciona o fluxo: senha ou painel 

TESTE

Gerar os dados na controller fixo 
