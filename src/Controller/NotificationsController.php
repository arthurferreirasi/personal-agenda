<?php
declare(strict_types=1);
namespace App\Controller;

use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

class NotificationsController extends AppController
{
    public function index()
    {
        $this->autoRender = false;
        $eventsTable = TableRegistry::getTableLocator()->get('Events');

        $currentTime = new \DateTime();

        $events = $eventsTable->find()
            ->where([
                'start <=' => $currentTime,
                'end >=' => $currentTime,
                'notified' => false
            ])
            ->all();

        $notifications = [];

        foreach ($events as $event) {
            $notifications[] = [
                'title' => 'Evento Iniciado',
                'body' => 'O evento ' . $event->nome . ' começou!',
                'icon' => '/favicon.ico'
            ];

            $event->notified = true;
            $eventsTable->save($event);
        }

        $this->response = $this->response->withType('application/json')
            ->withStringBody(json_encode(['notifications' => $notifications]));
        return $this->response;
    }

}
