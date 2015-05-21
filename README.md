# API de tarefas com CakePHP e Mysql, formulário para add, exemplo de listagem no CakePHP, e exemplo de Drag and Drop para alteração de prioridades, listagem, e exclusão 
##Configurações básicas:

Copiar e colar o conteudo todo para o apache (pasta supero-tarefas)

Copiar a pasta dragndrop para uma pasta separada dentro do apache

1- Alterar o arquivo DATABASE.PHP (app/Config) para as suas configurações do banco de dados;

```go
public $default = array(
    'datasource' => 'Database/Mysql',
    'persistent' => false,
    'host' => 'localhost:PORTA',
    'login' => 'USUARIO',
    'password' => 'senha',
    'database' => 'tarefas',
    'prefix' => '',
);
```

2- No phpMyAdmin criar uma tabela "tarefas", SCHEME disponivel na raiz do projeto: tarefas_tarefas.sql

Obs.: Prioridade: 1 Alta, 2 Normal, 3 Baixa.

##Acessando a aplicação:

Acessar lista de tarefas: ```http://localhost:81/supero-tarefas/```

Testar API - adicionar (formulário): ```http://localhost:81/supero-tarefas/ClientTarefas```

Copiar a pasta dragndrop para uma pasta separada dentro do apache

Testar API - drag and drop (listar e excluir): ```http://localhost:81/dragndrop```

