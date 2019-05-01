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
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
       
    }
    

    
    public function tableDespuesCena()
    {
        $title = 'Invitados a Después de Cena';
        $actions = '<div class="pull-right" style = "margin: 5px 10px 0 0;">
                        <div class="btn-group" role="group">
                            <button type="button" class="actions-group-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                
                                <span class="glyphicon glyphicon-menu-hamburger cog"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <a href="/etickets/add" class="añadir-invitados">Añadir Invitados</a>
                                
                            </ul>
                        </div>
                    </div>';
        $session = $this->request->session();
        $data['user'] = $session->read()['Auth']['User'];
        $event = $this->Etickets->Events->find()->where(['user_id' => $data['user']['id']])->first();
        $this->set(compact('title','actions', 'event'));
    }
    public function tableCena()
    {
        $title = 'Invitados a Cena';
        $actions = '<div class="pull-right" style = "margin: 5px 10px 0 0;">
                        <div class="btn-group" role="group">
                            <button type="button" class="actions-group-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">

                                <span class="glyphicon glyphicon-menu-hamburger cog"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <a href="/etickets/add" class="añadir-invitados">Añadir Invitados</a>
                            </ul>
                        </div>
                    </div>';
        $session = $this->request->session();
        $data['user'] = $session->read()['Auth']['User'];
        $event = $this->Etickets->Events->find()->where(['user_id' => $data['user']['id']])->first();
        $this->set(compact('title', 'actions', 'event'));
    }

    public function ingresadosCena()
    {
        $title = 'Invitados a Cena que ya ingresaron ';
        $this->set(compact('title'));
    }

    public function ingresadosDespuesCena()
    {
        $title = 'Invitados Después de Cena que ya ingresaron ';
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
        $session = $this->request->session();
        $data['user'] = $session->read()['Auth']['User'];
        $event = $this->Etickets->Events->find()->where(['user_id' => $data['user']['id']])->first();
        $etickets = $this->Etickets->find()->where(['type' => 'cena', 'event_id' => $event->id, 'scanned' => true]);
        $resultJ = json_encode($etickets);
                $this->response->type('json');
                $this->response->body($resultJ);
                return $this->response;
    }

    public function getEticketsDespCenaIngresados(){
        $this->autoRender = false;
        $this->request->allowMethod(['post','get']);
        $session = $this->request->session();
        $data['user'] = $session->read()['Auth']['User'];
        $event = $this->Etickets->Events->find()->where(['user_id' => $data['user']['id']])->first();
        $etickets = $this->Etickets->find()->where(['type' => 'despuesDeCena', 'event_id' => $event->id, 'scanned' => true]);
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
        $title = 'Editar Invitado';
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eticket = $this->Etickets->patchEntity($eticket, $this->request->getData());
            if ($this->Etickets->save($eticket)) {
                $this->Flash->success(__('El invitado se edito correctamente'));

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The eticket could not be saved. Please, try again.'));
        }
        $this->set(compact('eticket', 'title'));
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
        if($eticket){
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




    public function validateQr($qr = null, $event_id = null){
        $dateTimeZone =  new \DateTimeZone('America/Argentina/Buenos_Aires');
        $horaActual = new \DateTime("now",$dateTimeZone);
        $eticket = $this->Etickets->find()
                                  ->where(['qr' => $qr])
                                  ->contain(['Events']);
                                 ;
     
                          
        if ($eticket->count() == 0){
            $error = ['response'=>'error','detalle'=>'Qr invalido o inexistente.'];
            return $error;
        }else{
            $eticket = $eticket->first();
            if($eticket->event->startTime > $horaActual){
                $error = ['response'=>'error','detalle'=>'El evento no ha comenzado'];
                return $error;
            }                      
            
            if($horaActual > $eticket->event->endTime){
                $error = ['response'=>'error','detalle'=>'El evento ya ha finalizado'];
                return $error;
            }    
            
            if($eticket->event->id != $event_id){
                $error = ['response'=>'error','detalle'=>'El QR no pertenece a este evento, colado!'];
                return $error;
            }    

            if($eticket->scanned > 0 ){
                $error = ['response'=>'error','detalle'=>'El QR ya ha sido escaneado'];
                return $error;
            }
            $eticket->scanned = 1 ;
            if($this->Etickets->save($eticket)){
                $success = ['response'=>'success',
                'detalle'=>['tipo' => $eticket->type,
                            'nombre'=>$eticket->name,
                            'apellido'=>$eticket->surname,
                            'mesa'=>$eticket->mesa,
                            'hora' => $eticket->event->endTime->format('Y-m-d H:i:s')]];
               
                return $success;
            }
            
        }
        
     
    }

    
}