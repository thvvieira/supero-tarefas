<?php

/* 
 * Controller
 * Rest Tarefas
 * API CRUD
 */

class RestTarefasController extends AppController {
    
    public $uses = array('Tarefa');
    
    public function index() {
         $tarefas = $this->Tarefa->find('all');
         $this->set(array(
            'tarefas' => $tarefas,
            '_serialize' => array('tarefas')
        ));
    }
    public function add() {
        $this->Tarefa->create();
        if ($this->Tarefa->save($this->request->data)) {
             $message = 'Tarefa cadastrada com sucesso.';
        } else {
            $message = 'Erro';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
    public function edit($id) {
         $this->Tarefa->id = $id;
         if ($this->Tarefa->save($this->request->data)) {
             $message = 'Tarefa atualizada com sucesso.';
        } else {
            $message = 'Erro.';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
    public function delete($id) {
        if ($this->Tarefa->delete($id)) {
            $message = 'Tarefa deletada com sucesso.';
        } else {
            $message = 'Erro';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
    
}
