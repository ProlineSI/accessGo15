<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Etickets Controller
 *
 * @property \App\Model\Table\EticketsTable $Etickets
 *
 * @method \App\Model\Entity\Eticket[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EticketsController extends AppController
{
    

    
    public function tableDespuesCena()
    {
        $title = 'Listado de Invitados a Después de Cena';
        $actions = '<div class="pull-right" style = "margin: 5px 10px 0 0;">
                        <div class="btn-group" role="group">
                            <button type="button" class="actions-group-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                
                                <span class="glyphicon glyphicon-menu-hamburger cog"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <a href="/accessGo15/etickets/add" class="añadir-invitados">Añadir Invitados</a>
                            </ul>
                        </div>
                    </div>';
        $this->set(compact('title','actions'));
    }
    public function tableCena()
    {
        $title = 'Listado de Invitados a Cena';
        $actions = '<div class="pull-right" style = "margin: 5px 10px 0 0;">
                        <div class="btn-group" role="group">
                            <button type="button" class="actions-group-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">

                                <span class="glyphicon glyphicon-menu-hamburger cog"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <a href="/accessGo15/etickets/add" class="añadir-invitados">Añadir Invitados</a>
                            </ul>
                        </div>
                    </div>';
        $this->set(compact('title', 'actions'));
    }

    public function ingresadosCena()
    {
        $title = 'Listado de invitados a Cena que ya llegaron';
        $this->set(compact('title'));
    }

    public function ingresadosDespuesCena()
    {
        $title = 'Listado de invitados a Después de Cena que ya llegaron';
        $this->set(compact('title'));
    }
    /**
     * View method
     *
     * @param string|null $id Eticket id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eticket = $this->Etickets->get($id, [
            'contain' => []
        ]);

        $this->set('eticket', $eticket);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eticket = $this->Etickets->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if(!isset($data['quantity'])){
                $data['quantity'] = 1;
            }
            $data['qr'] = $data['name'].$data['surname'];
            $session = $this->request->session();
            $data['user'] = $session->read()['Auth']['User'];
            $event = $this->Etickets->Events->find()->where(['user_id' => $data['user']['id']])->first();
            $data['event_id'] = $event->id;
            $eticket = $this->Etickets->patchEntity($eticket, $data);
           
            if ($result = $this->Etickets->save($eticket)) {
                $this->Flash->success(__('Invitado añadido correctamente.'));

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('El invitado no se pudo añadir correctamente, intente nuevamente.'));
        }
        $this->set(compact('eticket'));
    }

    public function getEticketsDespCena(){
        $this->autoRender = false;
        $this->request->allowMethod(['post','get']);
        $session = $this->request->session();
        $data['user'] = $session->read()['Auth']['User'];
        $event = $this->Etickets->Events->find()->where(['user_id' => $data['user']['id']])->first();
        $etickets = $this->Etickets->find('all')->where(['type' => 'despuesDeCena', 'event_id' => $event->id]);
        $resultJ = json_encode($etickets);
                $this->response->type('json');
                $this->response->body($resultJ);
                return $this->response;
    }

    public function getEticketsCena(){
        $this->autoRender = false;
        $this->request->allowMethod(['post','get']);
        $session = $this->request->session();
        $data['user'] = $session->read()['Auth']['User'];
        $event = $this->Etickets->Events->find()->where(['user_id' => $data['user']['id']])->first();
        $etickets = $this->Etickets->find('all')->where(['type' => 'cena', 'event_id' => $event->id]);
        $resultJ = json_encode($etickets);
                $this->response->type('json');
                $this->response->body($resultJ);
                return $this->response;
    }

    public function getEticketsCenaIngresados(){
        $this->autoRender = false;
        $this->request->allowMethod(['post','get']);
        $etickets = $this->Etickets->find('all')->where(['type' => 'cena'])->where(['scanned' => true]);
        $resultJ = json_encode($etickets);
                $this->response->type('json');
                $this->response->body($resultJ);
                return $this->response;
    }

    public function getEticketsDespCenaIngresados(){
        $this->autoRender = false;
        $this->request->allowMethod(['post','get']);
        $etickets = $this->Etickets->find('all')->where(['type' => 'despuesDeCena'])->where(['scanned' => true]);
        $resultJ = json_encode($etickets);
                $this->response->type('json');
                $this->response->body($resultJ);
                return $this->response;
    }
    

    /**
     * Edit method
     *
     * @param string|null $id Eticket id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eticket = $this->Etickets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eticket = $this->Etickets->patchEntity($eticket, $this->request->getData());
            if ($this->Etickets->save($eticket)) {
                $this->Flash->success(__('The eticket has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The eticket could not be saved. Please, try again.'));
        }
        $this->set(compact('eticket'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Eticket id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {   
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->getData();
        $eticket = $this->Etickets->get($data['id']);
        if ($this->Etickets->delete($eticket)) {
            $resultJ = json_encode(['result' => 'Invitado eliminado']);
                            $this->response->type('json');
                            $this->response->body($resultJ);
                            return $this->response;
        } else {
            $resultJ = json_encode(['errors' => 'No se puedo eliminar invitado']);
                            $this->response->type('json');
                            $this->response->body($resultJ);
                            return $this->response;
        }
    }

    
}