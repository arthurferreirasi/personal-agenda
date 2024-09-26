<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<?= $this->Html->css(('modal-form')) ?>
<div class="row">
    <div class="column column-80">
        <div class="events-form-content">
            <?= $this->Form->create($event) ?>
            <fieldset>
                <legend><?= __('Criar Evento') ?></legend>
                <?php
                echo $this->Form->control('title');
                echo $this->Form->control('start', ['type' => 'datetime-local']);
                echo $this->Form->control('end', ['type' => 'datetime-local']);
                echo $this->Form->control('all_day', ['type' => 'checkbox']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Salvar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>