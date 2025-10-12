# 🧮 Sistema de Gestão de Notas

## 📘 Descrição do Projeto
O **Sistema de Gestão de Notas** é uma aplicação desenvolvida em **PHP para o console (terminal)** que permite o **registro, listagem e análise de notas de estudantes**.  
O objetivo é praticar conceitos fundamentais de programação em PHP, como arrays associativos, funções, estruturas de controle e manipulação de ficheiros.

---

## 🧰 Funcionalidades Principais

O sistema oferece um menu interativo com as seguintes opções:

| Nº | Função | Descrição |
|----|---------|------------|
| 1 | Registrar Estudantes e Notas | Registra novos alunos e suas três notas |
| 2 | Listar Estudantes | Exibe todos os alunos cadastrados com suas notas e médias |
| 3 | Calcular Média Geral | Calcula a média geral da turma |
| 4 | Procurar Estudante | Pesquisa um aluno pelo nome (total ou parcial) |
| 5 | Maior e Menor Nota | Mostra os alunos com as maiores e menores notas |
| 6 | Editar Notas | Permite alterar as notas de um aluno existente |
| 7 | Aprovados e Reprovados | Lista alunos aprovados e reprovados |
| 8 | Alunos com Média >16 ou ≤16 | Classifica alunos conforme sua média |
| 9 | Apagar Aluno | Remove um aluno do sistema pelo nome |
| 10 | Contar Alunos | Mostra o número total de estudantes cadastrados |
| 11 | Dispensados | Exibe alunos com média superior a 16 |
| 12 | Pessimos Alunos | Lista alunos com média abaixo de 10 |
| 13 | Melhores e Piores Alunos | Classifica os melhores, regulares e piores estudantes |
| 0 | Sair | Salva os dados e encerra o programa |

---

## 💾 Persistência de Dados
Os dados são **armazenados num ficheiro de texto (`alunos.txt`)** no mesmo diretório do script.  
Cada linha do ficheiro contém as informações do aluno separadas por **“|”**, no formato:

```
Nome|Turma|Nota1|Nota2|Nota3|Media|Estado
```

Exemplo:
```
Ana Silva|TPW-5|15|18|19|17.3|Dispensado
```

---

## ⚙️ Requisitos Técnicos

- PHP 7.4 ou superior  
- Console/terminal habilitado para entrada de dados via `STDIN`
- Conhecimentos básicos de:
  - Arrays associativos
  - Estruturas de controle (`if`, `switch`, `foreach`, `for`)
  - Funções em PHP
  - Manipulação de ficheiros (`file_put_contents`, `file`, etc.)

---

## 🚀 Como Executar o Projeto

### 1️⃣ **Salvar o arquivo**
Crie um arquivo chamado `sistema_notas.php` e cole o código do projeto dentro.

### 2️⃣ **Executar no terminal**
Abra o terminal na pasta onde o arquivo está salvo e execute:

```bash
php sistema_notas.php
```

### 3️⃣ **Interagir com o menu**
Use os números do menu para escolher a operação desejada.

---

## 🧩 Estrutura do Projeto

```
📂 SistemaGestaoNotas/
│
├── sistema_notas.php     # Código principal do sistema
├── alunos.txt            # Ficheiro onde os dados são salvos
└── README.md             # Documentação do projeto
```

---

## 🧠 Conceitos Praticados

- Estruturas de decisão e repetição  
- Funções personalizadas  
- Arrays associativos  
- Manipulação de ficheiros  
- Entrada e saída no console  
- Organização e modularidade de código  
- Tratamento de erros de entrada  

---

## 🏁 Objetivo Educacional

Este sistema foi desenvolvido **para fins educativos**, ajudando estudantes a compreender como criar um sistema interativo em **PHP puro**, sem frameworks ou banco de dados.

---

## 📜 Licença
Este projeto é de **uso livre para fins acadêmicos** e pode ser modificado e aprimorado para aprendizado.
