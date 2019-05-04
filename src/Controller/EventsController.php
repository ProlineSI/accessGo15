<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 *
 * @method \App\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventsController extends AppController
{

    public function editEvent()
    {
        $session = $this->request->session();
        $data['user'] = $session->read()['Auth']['User'];
        $event = $this->Events->find()->where(['user_id' => $data['user']['id']])->first();
        $event = $this->Events->get($event->id, [
            'contain' => []
        ]);
        
        $title = "Configuración del Evento";
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $event['wp_msg'] = $data['wp_msg'];
            $event['cena_time'] = $data['cena_time']['hour'].':'. $data['cena_time']['minute'];
            $event['despCena_time'] = $data['despCena_time']['hour'].':'. $data['despCena_time']['minute'];
            if ($this->Events->save($event)) {
                $this->Flash->success(__('Configuración guardada correctamente.'));

                return $this->redirect(['action' => 'editEvent']);
            }
            $this->Flash->error(__('Error al guardar la configuración. Intente nuevamente.'));
        }
        
        $this->set(compact('event', 'title'));
    }
}
