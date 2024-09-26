<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */

?>
<?= $this->Html->css(('modal-form')) ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var topNav = document.getElementById("topNav");
        var sideNav = document.getElementById("sideNav");

        if (topNav) {
            topNav.style.display = "none";
        }
        sideNav.style.display = "none";

    });

</script>
<div class="row">
    <div class="column column-80">
        <div class="events-form-content">
            <?= $this->Form->create($event) ?>
            <fieldset>
                <legend><?= __('Edit Event') ?></legend>
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
        <button class="delete-btn">
            <?= $this->Form->postLink(
                __('Excluir'),
                ['action' => 'delete', $event->id],
                ['confirm' => __('Tem certeza que deseja deletar este evento?', $event->id)]
            ) ?>
        </button>
    </div>
</div>