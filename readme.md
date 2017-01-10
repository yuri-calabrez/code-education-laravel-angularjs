#Curso Laravel 5.1 com AngularJS na Amazon AWS

##Fase 1 - Laravel
### Clients
Nessa fase do projeto, você deverá apresentar um CRUD completo de nosso model Client.

Sempre lembrando que toda a informação resultante deverá ser exibida para o usuário final como um json.

Não se esqueça de utilizar corretamente os verbos HTTP.

##Fase 2 - Laravel
### Repositories e Services
* Faça o CRUD completo de nossa Entidade Client

* Crie uma nova entidade chamada Project

* Crie o Repository e Service referente a entidade Project, bem como suas validações, gerando um CRUD completo

* Na listagem dos dados, traga também as informações sobre o owner_id e client_id

##Fase 3 - Laravel
### Task e Members
Agora que você está entendendo o processo de relacionamento e disponibilização das APIs relacionadas a Projects, faça:

1) Crie a entidade ProjectTask, com os seguintes campos e disponibilize os endpoints (rotas) project/tasks.
Não se esqueça de criar as migrations, seeds, repositories, services, etc.

- id
- name
- project_id 
- start_date
- due_date
- status
- created_at
- updated_at

2) Crie a entidade ProjectMembers, com os campos:

- project_id
- user_id

Faça o relacionamento com a entidade Project e User para que facilmente possamos ter acesso aos membros de um projeto.

No ProjectService, crie dois métodos:

- addMember: para adicionar um novo member em um projeto
- removeMember: para remover um membro de um projeto
- isMember: para verificar se um usuário é membro de um determinado projeto

Crie um endpoint (rota): /project/{id}/members para ter acesso a todos os membros de um projeto.

##Fase 4 - Laravel
### Finalizando backend

Agora que já temos nossa estrutura montada em relação ao projeto, precisamos finalizar a parte "base" do backend para que possamos iniciar o processo de integração com o AngularJS.

Faça:

* Aplique o processo de Autorização em todos os endpoints de nossa API
* Crie Presenters e Transformers em todos os repositories (deixe exibindo todos os dados por padrão - isso poderá ser mudado quando formos conversar com o Angular)
* Termine o processo de inclusão de arquivos / upload validando possíveis tipos de erros
* Processo de remoção de arquivos do projeto
* Crie um seeder chamado OAuthClientSeeder para gerar pelo menos um client na tabela oauth_clients

##Fase 1 - AngularJs
### Configurando o ambiente de desenvolvimento
Agora que você já viu todo processo de preparação do nosso front-end, você deve reproduzir o mesmo ambiente em seu projeto.

É preciso que ao digitarmos "**gulp watch-dev**", ele realize todas as tarefas descritas para o desenvolvimento e quando

digitarmos "**gulp default**" ou somente "**gulp**", o mesmo gere os arquivos all.js e all.css que será o resultado da união dos arquivos correspondentes.

##Fase 2 - AngularJs
###Realizando autenticação
Agora que já realizamos a autenticação é preciso que você faça a mesma autenticação na rota #/login.

Quando o usuário for autenticado, redirecione-o para #/home. Não se preocupe em restringir o acesso ao #/home quando não estivermos
autenticados.

##Fase 3 - AngularJs
###Primeiros CRUD's

Com o CRUD de client funcionando, você irá fazer os CRUD's de client e project note.

Para as rotas, mantenha o mesmo padrão que usamos no curso:

**Client:**

* Para listar: #/clients
* Para listar um client: #/clients/:id
* Para criar: #/clients/new
* Para editar: #/clients/:id/edit
* Para excluir: #/clients/:id/remove

===============================================================================================

**Project Note:**

* Para listar as notas de um projeto específico: #/project/:id/notes
* Para listar uma nota de um projeto específico: #/project/:id/notes/:idNote
* Para criar uma nota para um projeto específico: #/project/:id/notes/new
* Para editar uma nota: #/project/:id/notes/:idNote/edit
* Para excluir uma nota: #/project/:id/notes/:idNote/remove

Onde está o :id, será o id do projeto e você irá força-lo no URL porque nesta fase não faremos CRUD's de project.
Não se preocupe com os detalhes agora, o importante é que os dois CRUD's funcionem.

 

Obs.: utilize o método skipPresenter() nas consultas do repository por enquanto, para facilitar os CRUD's.