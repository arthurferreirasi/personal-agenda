<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>

<?= $this->Html->css(['todo']) ?>

<div class="row">
    <div class="column column-50">
        <h3>Pendente</h3>
        <ul>
            <?php if (!$toDoEvents->isEmpty()): ?>
                <?php foreach ($toDoEvents as $event): ?>
                    <li>
                        <strong><?= h($event->title) ?></strong><br>
                        <?= h($event->start->format('Y-m-d H:i')) ?>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Nenhum evento futuro.</li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="column column-50">
        <h3>Feito</h3>
        <ul>
            <?php if (!$doneEvents->isEmpty()): ?>
                <?php foreach ($doneEvents as $event): ?>
                    <li>
                        <strong><?= h($event->title) ?></strong><br>
                        <?= h($event->start->format('Y-m-d H:i')) ?>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Nenhum evento passado.</li>
            <?php endif; ?>
        </ul>
    </div>
</div>