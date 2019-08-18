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
        if($this->Auth->user()){
            $session = $this->request->session();   
            $data['user'] = $session->read()['Auth']['User'];
            $event = $this->Etickets->Events->find()->where(['user_id' => $data['user']['id']])->first();
            $fecha_event = $event->endTime;
            $fecha_event = $fecha_event->format('Y-m-d H:i:s');
            $fecha_event = new \DateTime($fecha_event);
            $fecha_event->add(new \DateInterval('P1D'));
            $fecha_event = strtotime($fecha_event->format('Y-m-d H:i:s'));
            $dateTimeZone =  new \DateTimeZone('America/Argentina/Buenos_Aires');
            $today = (new \DateTime('now', $dateTimeZone));
            $today = strtotime($today->format('Y-m-d H:i:s'));
            if($this->Auth->user() && ($today >= $fecha_event) && !($this->request->action === 'getStats')){
                return $this->redirect(['controller' => 'Events', 'action' => 'finishedEvent']);
            }
        }
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
            if ($eticket->scanned == 0) {
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
            }else {
                $resultJ = json_encode(['errors' => 'El invitado ya ingresó, no se puede eliminar']);
                                $this->response->type('json');
                                $this->response->body($resultJ);
                                return $this->response;
            }
        }
    }

    public function getStats(){
        //Comprueba si el evento termino
        $session = $this->request->session();   
        $data['user'] = $session->read()['Auth']['User'];
        $event = $this->Etickets->Events->find()->where(['user_id' => $data['user']['id']])->first();
        $fecha_event = $event->endTime;
        $fecha_event = $fecha_event->format('Y-m-d H:i:s');
        $fecha_event = new \DateTime($fecha_event);
        $fecha_event->add(new \DateInterval('P1D'));
        $fecha_event = strtotime($fecha_event->format('Y-m-d H:i:s'));
        $dateTimeZone =  new \DateTimeZone('America/Argentina/Buenos_Aires');
        $today = (new \DateTime('now', $dateTimeZone));
        $today = strtotime($today->format('Y-m-d H:i:s'));
        if(($today >= $fecha_event)){
            $title_finished = ' - Terminado';
        }else{
            $title_finished = '';
        }
        //Stats
        $user_id = $this->request->session()->read()['Auth']['User']['id'];
        $event = $this->Etickets->Events->find()->where(['user_id' => $user_id])->first();
        /* Invitados a cena */
        $etickets_inv_cena = $this->Etickets->find()->where(['event_id' => $event->id, 'type' => 'cena'])->all();
        $etickets_inv_cena_tot = 0;
        foreach($etickets_inv_cena as $eticket){
            $etickets_inv_cena_tot += $eticket->quantity;
        }
        /* Invitados a cena confirmados */
        $etickets_inv_cena_confirm = $this->Etickets->find()->where(['event_id' => $event->id, 'type' => 'cena'])->all();
        $etickets_inv_cena_confirm_tot = 0;
        foreach($etickets_inv_cena_confirm as $eticket){
            $etickets_inv_cena_confirm_tot += $eticket->confirmation;
        }
        /* Invitados desp de cena confirmados */
        $etickets_inv_desp_cena_confirm = $this->Etickets->find()->where(['event_id' => $event->id, 'type' => 'despuesDeCena', 'confirmation' >= 1])->all();
        $etickets_inv_desp_cena_confirm_tot = 0;
        foreach($etickets_inv_desp_cena_confirm as $eticket){
            $etickets_inv_desp_cena_confirm_tot += $eticket->quantity;
        }
        /* Invitados desp de cena */
        $etickets_desp_cena = $this->Etickets->find()->where(['event_id' => $event->id, 'type' => 'despuesDeCena'])->all();
        $etickets_desp_cena_tot = 0;
        foreach($etickets_desp_cena as $eticket){
            $etickets_desp_cena_tot += $eticket->quantity;
        }
        /* Escaneados Cena */
        $etickets_esc_cena = $this->Etickets->find()->where(['event_id' => $event->id, 'type' => 'cena', 'scanned' => 1])->all();
        $etickets_esc_cena_tot = 0;
        foreach($etickets_esc_cena as $eticket){
            $etickets_esc_cena_tot += $eticket->scanCount;
        }
        /* Escaneados Desp Cena */
        $etickets_esc_desp_cena = $this->Etickets->find()->where(['event_id' => $event->id, 'type' => 'despuesDeCena', 'scanned' => 1])->all();
        $etickets_esc_desp_cena_tot = 0;
        foreach($etickets_esc_desp_cena as $eticket){
            $etickets_esc_desp_cena_tot += $eticket->scanCount;
        }
        /* Faltantes esc Cena */
        $etickets_falt_esc_cena = $this->Etickets->find()->where(['event_id' => $event->id, 'type' => 'cena', 'confirmation' >= 1])->all();
        $etickets_falt_esc_cena_tot = 0;
        foreach($etickets_falt_esc_cena as $eticket){
            $etickets_falt_esc_cena_tot += (($eticket->confirmation) - ($eticket->scanCount));
        }
        /* Faltantes esc Desp Cena */
        $etickets_falt_esc_desp_cena = $this->Etickets->find()->where(['event_id' => $event->id, 'type' => 'despuesDeCena', 'confirmation' >= 1])->all();
        $etickets_falt_esc_desp_cena_tot = 0;
        foreach($etickets_falt_esc_desp_cena as $eticket){
            $etickets_falt_esc_desp_cena_tot += (($eticket->confirmation) - ($eticket->scanCount));
        }
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $date = $dias[date('w',strtotime($event->startTime))];
        $title = $date.' '.date('d',strtotime($event->startTime)).' - Evento de '.$event->name.''.$title_finished;
        $total_invitados = $etickets_inv_cena_tot + $etickets_desp_cena_tot;
        $total_confirmados = $etickets_inv_cena_confirm_tot + $etickets_inv_desp_cena_confirm_tot;
        $total_ingresados = $etickets_esc_cena_tot + $etickets_esc_desp_cena_tot;
        $total_pendientes = $etickets_falt_esc_cena_tot + $etickets_falt_esc_desp_cena_tot;
        if($total_confirmados == 0){
            $porcentaje_presentes = 0;
            $porcentaje_ausentes = 100;
        }else{
            $porcentaje_presentes = round($total_ingresados/$total_confirmados, 3) * 100;
            $porcentaje_ausentes = round(($total_pendientes)/$total_confirmados, 3) * 100;
        }
        if(($event->startTime <= new \DateTime()) and ($event->endTime >= new \DateTime())){
            $actions = '<a href="/etickets/getStats" title="Actualizar Estadísticas"><span class="glyphicon glyphicon-repeat refresh"></span></a>' .
                        '<a href="#" title="Mostrar todas las estadísticas" onClick="showStats()"><span class="glyphicon glyphicon-resize-full refresh"></span></a>' ;
        }else{
            $actions = '<a href="/etickets/getStats" title="Actualizar Estadísticas"><span class="glyphicon glyphicon-repeat refresh"></span></a>';
        }
        //$resultJ = json_encode(array('event_name' => $event->name,
        //                            'invitados-a-cena' => $etickets_inv_cena_tot, 
        //                            'invitados-desp-de-cena' => $etickets_desp_cena_tot, 
        //                            'escaneados-Cena' => $etickets_esc_cena_tot, 
        //                            'escaneados-Desp-Cena' => $etickets_esc_desp_cena_tot, 
        //                            'faltantes-esc-Cena' => $etickets_falt_esc_cena_tot, 
        //                            'faltantes-esc-Desp-Cena' => $etickets_falt_esc_desp_cena_tot));
        //$this->response->type('json');
        //$this->response->body($resultJ);
        //return $this->response;
        $this->set(compact('event','title', 'etickets_inv_cena_tot', 
                                    'etickets_desp_cena_tot', 
                                    'etickets_esc_cena_tot', 
                                    'etickets_esc_desp_cena_tot', 
                                    'etickets_falt_esc_cena_tot', 
                                    'etickets_falt_esc_desp_cena_tot', 
                                    'etickets_inv_cena_confirm_tot', 
                                    'etickets_inv_desp_cena_confirm_tot', 
                                    'total_invitados', 
                                    'total_confirmados', 
                                    'total_ingresados', 
                                    'total_pendientes', 'actions',
                                    'porcentaje_presentes', 
                                    'porcentaje_ausentes'));
    }


    public function validateQr($qr = null, $event_id = null){
        $this->autoRender = false;
        $dateTimeZone =  new \DateTimeZone('America/Argentina/Buenos_Aires');
        $horaActual = new \DateTime("now",$dateTimeZone);
        $horaActual = strtotime($horaActual->format('Y-m-d H:i:s'));
        $eticket = $this->Etickets->find()
                                  ->where(['qr' => $qr])
                                  ->contain(['Events']);
                                 ;
     
                          
        if ($eticket->count() == 0){
            $error = ['response'=>'error','detalle'=>'E-ticket invalido o inexistente'];
            return $error;
        }else{
            $eticket = $eticket->first();
            $eticket->event->startTime = strtotime($eticket->event->startTime->format('Y-m-d H:i:s'));
            $eticket->event->endTime = strtotime($eticket->event->endTime->format('Y-m-d H:i:s'));
            $restScans = $eticket->quantity - $eticket->scanCount;
            if($restScans == 0 ){
                $error = ['response'=>'error','detalle'=>'Límite de escaneos superado'];
                return $error;
            }
            if($eticket->event->startTime > $horaActual){
                $error = ['response'=>'error','detalle'=>'El evento no ha comenzado'];
                return $error;
            }                      
            
            if($horaActual > $eticket->event->endTime){
                $error = ['response'=>'error','detalle'=>'El evento ya ha finalizado'];
                return $error;
            }    
            
            if($eticket->event->id != $event_id){
                $error = ['response'=>'error','detalle'=>'El E-ticket no pertenece a este evento'];
                return $error;
            }    

            
            $eticket->scanned = 1 ;
            $eticket->scanCount = $eticket->scanCount + 1;
            $restScans = $restScans - 1;
            if($this->Etickets->save($eticket)){
                $success = ['response'=>'success',
                'detalle'=>['tipo' => $eticket->type,
                            'nombre'=>$eticket->name,
                            'apellido'=>$eticket->surname,
                            'mesa'=>$eticket->mesa,
                            'quantity'=>$eticket->quantity,
                            'restScans'=>$restScans]];
               
                return $success;
            }
            
        }
        
     
    }


    public function ingresarBackOffice(){
        $this->autoRender = false;
        $this->request->allowMethod(['post','get']);
        $data = $this->request->getData();
        $qr = $data['qr'];
        $event_id = $data['event_id'];
        $dateTimeZone =  new \DateTimeZone('America/Argentina/Buenos_Aires');
        $horaActual = new \DateTime("now",$dateTimeZone);
        $horaActual = strtotime($horaActual->format('Y-m-d H:i:s'));
        $eticket = $this->Etickets->find()
                                  ->where(['qr' => $qr])
                                  ->contain(['Events']);
                                 ;
        if ($eticket->count() == 0){
            $resultJ = json_encode(['errors' => 'Qr invalido o inexistente']);
                                $this->response->type('json');
                                $this->response->body($resultJ);
                                return $this->response;
        }else{
            $eticket = $eticket->first();
            $eticket->event->startTime = strtotime($eticket->event->startTime->format('Y-m-d H:i:s'));
            $eticket->event->endTime = strtotime($eticket->event->endTime->format('Y-m-d H:i:s'));
            $restScans = $eticket->quantity - $eticket->scanCount;
            if($restScans == 0 ){
                $resultJ = json_encode(['errors' => 'Límite de escaneos superado']);
                                $this->response->type('json');
                                $this->response->body($resultJ);
                                return $this->response;
            }
            if($eticket->event->startTime > $horaActual){
                $resultJ = json_encode(['errors' => 'El evento no ha comenzado']);
                                $this->response->type('json');
                                $this->response->body($resultJ);
                                return $this->response;
            }                      
            
            if($horaActual > $eticket->event->endTime){
                $resultJ = json_encode(['errors' => 'El evento ya ha finalizado']);
                                $this->response->type('json');
                                $this->response->body($resultJ);
                                return $this->response;
            }    
            
            if($eticket->event->id != $event_id){
                $resultJ = json_encode(['errors' => 'El QR no pertenece a este evento']);
                                $this->response->type('json');
                                $this->response->body($resultJ);
                                return $this->response;
            }    

            if($eticket->confirmation == 0){
                $eticket->confirmation = 1;
            }
            $eticket->scanned = 1 ;
            $eticket->scanCount = $eticket->scanCount + $data['quantity'];
            $restScans = $restScans - $data['quantity'];
            if($this->Etickets->save($eticket)){
                $resultJ = json_encode(['result' => "Ingresado: $eticket->name $eticket->surname, accesos restantes: $restScans"]);
                                $this->response->type('json');
                                $this->response->body($resultJ);
                                return $this->response;
            }
            
        }
        
     
    }

    
}