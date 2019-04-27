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

    public function editMsg()
    {
        $session = $this->request->session();
        $data['user'] = $session->read()['Auth']['User'];
        $event = $this->Events->find()->where(['user_id' => $data['user']['id']])->first();
        $event = $this->Events->get($event->id, [
            'contain' => []
        ]);
        
        $title = "Editar mensaje personalizado para Whatsapp";
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('Mensaje guardado correctamente.'));

                return $this->redirect(['action' => 'editMsg']);
            }
            $this->Flash->error(__('Error al guardar Mensaje. Intente nuevamente. '));
        }
        
        $this->set(compact('event', 'title'));
    }
}
