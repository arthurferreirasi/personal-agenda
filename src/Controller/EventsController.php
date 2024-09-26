<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use SebastianBergmann\Environment\Console;

class EventsController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Email');
    }

    public function index()
    {
        $query = $this->Events->find();
        $events = $this->paginate($query);

        $this->set(compact('events'));
    }

    public function calendar()
    {
        $query = $this->Events->find();
        $events = $this->paginate($query);

        $this->set(compact('events'));
    }

    public function view($id = null)
    {
        $event = $this->Events->get($id, contain: []);
        $this->set(compact('event'));
    }

    public function add()
    {
        $event = $this->Events->newEmptyEntity();
        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('Evento adicionado com sucesso!'));
                $this->addEventNotification();

                return $this->redirect('/');
            }
            $this->Flash->error(__('Erro ao criar o evento. Por favor, tente novamente.'));
        }

        $title = $this->request->getQuery('title');
        $start = $this->request->getQuery('start');
        $end = $this->request->getQuery('end');
        $allDay = $this->request->getQuery('all_day');

        $this->set(compact('event', 'title', 'start', 'end'));
        $this->set('isModal', true);
    }

    public function edit($id = null)
    {
        $event = $this->Events->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('Evento alterado com sucesso!'));

                return $this->redirect('/');
            }
            $this->Flash->error(__('Erro ao editar o evento. Por favor, tente novamente.'));
        }
        $this->set(compact('event'));
        $this->set('isModal', true);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('Evento deletado com sucesso!'));
        } else {
            $this->Flash->error(__('O evento não pode ser criado. Por favor, tente novamnete.'));
        }

        return $this->redirect('/');
    }

    public function todo()
    {
        $now = new \DateTime();

        $toDoEvents = $this->Events->find('all')
            ->where(['start >' => $now])
            ->order(['start' => 'ASC'])
            ->all();

        $doneEvents = $this->Events->find('all')
            ->where(['start <=' => $now])
            ->order(['start' => 'DESC'])
            ->all();

        $this->set(compact('toDoEvents', 'doneEvents'));
    }


    public function addEventNotification()
    {
        if ($this->request->is('post')) {
            $eventData = $this->request->getData();

            $to = Configure::read('EmailTransport.default.username');
            $subject = 'Lembrete de Evento';
            $body = 'Seu evento "' . $eventData['title'] . '" está programado.';

            if ($this->Email->sendEmail($to, $subject, $body)) {
                $this->Flash->success('Evento criado e lembrete enviado!');
            } else {
                $this->Flash->error('Evento criado, mas o lembrete não foi enviado.');
            }
        }
    }

    public function getEvents()
    {
        $this->autoRender = false;
        $events = $this->Events->find('all')->toArray();
        $data = [];

        foreach ($events as $event) {
            $data[] = [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start->i18nFormat('yyyy-MM-dd HH:mm:ss'),
                'end' => $event->end->i18nFormat('yyyy-MM-dd HH:mm:ss')
            ];
        }

        echo json_encode($data);
        return;
    }

    public function fetchEvents()
    {
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json');

        $events = $this->Events->find('all')->toArray();

        $eventData = [];
        foreach ($events as $event) {
            $eventData[] = [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start->format('Y-m-d H:i:s'),
                'end' => $event->end ? $event->end->format('Y-m-d H:i:s') : null,
                'all_day' => (bool) $event->allDay
            ];
        }

        $this->response = $this->response->withStringBody(json_encode($eventData));
    }

}
