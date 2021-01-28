# Sistema Locadora


### Instalação
- Baixar o repositorio e rodar o comando para gerar as dependencias.
```
$ composer install
``` 
- Rodar o comando para instalar as dependencias js, css e etc
```bash
# Para quem usa Yarn
$ yarn

# Para quem usa npm
$ npm install
```

- Para criar as tabelas no banco de dados e rodar os seeds
```
$ php artisan migrate --seed
```
- O comando acima irá gerar a seed de usuários e uma seed de veiculos.
- Implementei uma funcinalidade que pega os veículos direto da tabela FIPE.
- Esse comando pode demorar alguns segundos mais que os outros
- Os seeds são gerados pela factory da biblioteca Faker que cria usuários aleatórios, 
é preciso ir na tabela users e utilizar algum dos usuários criados.
## A senha padrão para todos os usuários gerados pelo Seeder é: "password123"

### Objetivo 
- [x] Desenvolver um sistema para gerenciar uma locadora de veículos. Deve ser possível
listar/criar/editar/remover usuários, assim como veículos. Deve ser possível criar, editar e remover
reservas de veículos. Um veículo só pode estar reservado para um usuário por vez. Um usuário pode
reservar diversos carros ao mesmo tempo.
- [x] Deseja-se uma visão (relatório/tabela) que exiba para um determinado veículo qual a sua
reserva/disponibilidade para cada dia de determinado mês.

### Requisitos técnicos
- [x] O sistema deve armazenar o nome e o CPF dos usuários, assim como a data e quem foram inseridos no
banco de dados.
- [x] O sistema deve armazenar o modelo, marca, ano e a placa do veículo.
- [x] O sistema deve armazenar as reservas realizadas.

- [x] Todos os dados inseridos pelo operador do sistema devem ser validados.
- [ ]Criar um evento que será disparado quando um carro for reservado. Esse evento deverá escrever no
arquivo de log do framework Laravel (utilizando a facade \Log), a id do usuário e a id do veículo
reservado.
- [ ] Criar um Job e programá-lo para execução duas vezes por dia. O método handle do Job pode permanecer
vazio.
- [x] O repositório deve conter as migrações das tabelas do sistema.
- [x] Deve ser observado o padrão MVC.
- [x] Deve ser observado o devido tratamento de erros.
- [x] Deve ser utilizado o Laravel Mix para compilação de dependências.
- [x] Utilize o bootstrap (https://getbootstrap.com/) para construção do front-end.
- [x] Utilizar a versão 8 do framework Laravel.

### Orientações

- [x] A interface do sistema deve ser a mais simples possível. Concentre-se nos requisitos técnicos e não na
estética das páginas.
- [x] É desejável (mas não obrigatório) que o sistema contenha funcionalidade para inserir/remover dados
fictícios, para facilitação do teste.
- [x] Utilizar o sistema de autenticação do próprio Laravel.
- [ ] Uso de componentes em Vue JS é desejável.
- [x] O uso de bibliotecas terceiras é desejável, desde que respeitados os critérios já citados neste documento.
- [x] É desejável que o código seja comentado quando o trecho de código não for óbvio.
- [x] É desejável que o repositório contenha Docblocks em todos os métodos.
- [x] O projeto deve ser entregue via link de repositório no github.

