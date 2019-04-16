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
    //public function beforeFilter(Event $event) {
    //    if (in_array($this->request->action, ['getEtickets'])) {
    //        $this->eventManager()->off($this->Csrf);
    //    }
    //}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $etickets = $this->paginate($this->Etickets);
        $title = 'Listado de Invitados a Cena';
        $this->set(compact('etickets', 'title'));
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
            $data['qr'] = $data['name'].$data['surname'];
            $eticket = $this->Etickets->patchEntity($eticket, $data);
           
            if ($result = $this->Etickets->save($eticket)) {
                $this->Flash->success(__('Invitado añadido correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $result = $this->Etickets->save($eticket);
            $this->Flash->error(__('El invitado no se pudo añadir correctamente, intente nuevamente.'));
        }
        $this->set(compact('eticket'));
    }

    public function getEtickets(){
        $this->autoRender = false;
        $this->request->allowMethod(['post','get']);
        $etickets = $this->Etickets->find('all');
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
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eticket = $this->Etickets->get($id);
        if ($this->Etickets->delete($eticket)) {
            $this->Flash->success(__('The eticket has been deleted.'));
        } else {
            $this->Flash->error(__('The eticket could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
