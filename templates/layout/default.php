<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */

$cakeDescription = 'Personal Agenda';
$username = 'Test Name';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['calendar', 'fonts', 'default']) ?>

    <?= $this->Html->script('/fullcalendar/index.global.min.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <nav class="top-nav" id="topNav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><img src=""><span>Agenda </span>Pessoal</a>
        </div>
        <div class="user-profile">
            <span><?= $username ?></span>
        </div>
    </nav>
    <div class="layout">
        <div class="side-nav" id="sideNav">
            <ul class="nav-links">
                <li><a href="#calendar" class="active">Calendário</a></li>
                <li><a href="#planner">Planner</a></li>
                <li><a href="#notifications">Notificações</a></li>
            </ul>
        </div>

        <main class="main">
            <div class="container">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (Notification.permission !== "granted") {
                Notification.requestPermission();
            }
        });
    </script>
</body>

</html>