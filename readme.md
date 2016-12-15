#Curso Laravel 5.1 com AngularJS na Amazon AWS

##Fase 1 - Clients
Nessa fase do projeto, você deverá apresentar um CRUD completo de nosso model Client.

Sempre lembrando que toda a informação resultante deverá ser exibida para o usuário final como um json.

Não se esqueça de utilizar corretamente os verbos HTTP.

##Fase 2 - Repositories e Services
* Faça o CRUD completo de nossa Entidade Client

* Crie uma nova entidade chamada Project

* Crie o Repository e Service referente a entidade Project, bem como suas validações, gerando um CRUD completo

* Na listagem dos dados, traga também as informações sobre o owner_id e client_id

##Fase 3 - Task e Members
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