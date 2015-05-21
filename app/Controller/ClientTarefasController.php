<?php

/* 
 * API Tarefas
 */

App::uses('HttpSocket', 'Network/Http');
class ClientTarefasController extends AppController {
  
    public function index(){
        
    }
    
    public function request_add(){
        
        if(!empty($this->request->data)){
 
            $link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_tarefas/add.json';

            $httpSocket = new HttpSocket();
            $response = $httpSocket->post($link, $this->request->data);
            $this->set('response_code', $response->code);
            $this->set('response_body', $response->body);

            $this ->render('/ClientTarefas/request_response');
        }
        
    }
    
    public function request_edit($id = null) {
        if(!$id){
            throw new NotFoundException(__('Tarefa não encontrada ou ID não informado.'));
        }
        
        $link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_tarefas/edit/'.$id.'.json';
        $data = null;

        $httpSocket = new HttpSocket();
        $data['Tarefa']['id'] = $id;
        $data['Tarefa']['prioridade'] = 3; //Baixa
        $response = $httpSocket->put($link, $data);
        
        $this->set('response_code', $response->code);
        $this->set('response_body', $response->body);
        
        $this ->render('/ClientTarefas/request_response');
    }
    
    public function request_delete($id = null) {
        if(!$id){
            throw new NotFoundException(__('Tarefa não encontrada ou ID não informado.'));
        }
        
        $link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_tarefas/delete/'.$id.'.json';
        $data = null;

        $httpSocket = new HttpSocket();
        $response = $httpSocket->delete($link, $data);
        
        $this->set('response_code', $response->code);
        $this->set('response_body', $response->body);
        
        $this ->render('/ClientTarefas/request_response');
    }
    
}
