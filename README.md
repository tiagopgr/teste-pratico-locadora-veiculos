# Sistema Locadora

###Objetivo 
Desenvolver um sistema para gerenciar uma locadora de veículos. Deve ser possível
listar/criar/editar/remover usuários, assim como veículos. Deve ser possível criar, editar e remover
reservas de veículos. Um veículo só pode estar reservado para um usuário por vez. Um usuário pode
reservar diversos carros ao mesmo tempo.
Deseja-se uma visão (relatório/tabela) que exiba para um determinado veículo qual a sua
reserva/disponibilidade para cada dia de determinado mês.

### Requisitos técnicos
O sistema deve armazenar o nome e o CPF dos usuários, assim como a data e quem foram inseridos no
banco de dados.
O sistema deve armazenar o modelo, marca, ano e a placa do veículo.
O sistema deve armazenar as reservas realizadas.

Todos os dados inseridos pelo operador do sistema devem ser validados.
Criar um evento que será disparado quando um carro for reservado. Esse evento deverá escrever no
arquivo de log do framework Laravel (utilizando a facade \Log), a id do usuário e a id do veículo
reservado.
Criar um Job e programá-lo para execução duas vezes por dia. O método handle do Job pode permanecer
vazio.
O repositório deve conter as migrações das tabelas do sistema.
Deve ser observado o padrão MVC.
Deve ser observado o devido tratamento de erros.
Deve ser utilizado o Laravel Mix para compilação de dependências.
Utilize o bootstrap (https://getbootstrap.com/) para construção do front-end.
Utilizar a versão 8 do framework Laravel.

### Orientações

A interface do sistema deve ser a mais simples possível. Concentre-se nos requisitos técnicos e não na
estética das páginas.
É desejável (mas não obrigatório) que o sistema contenha funcionalidade para inserir/remover dados
fictícios, para facilitação do teste.
Utilizar o sistema de autenticação do próprio Laravel.
Uso de componentes em Vue JS é desejável.
O uso de bibliotecas terceiras é desejável, desde que respeitados os critérios já citados neste documento.
É desejável que o código seja comentado quando o trecho de código não for óbvio.
É desejável que o repositório contenha Docblocks em todos os métodos.
O projeto deve ser entregue via link de repositório no github.

