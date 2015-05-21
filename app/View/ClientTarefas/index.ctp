Lista de Ações da API:
<br>
<div>
    <p class="bs-component">
        <?php echo $this->Html->link("Adicionar", "./request_add", array('class' => 'btn btn-success btn-lg btn-block')); ?>
    </p>

    <div class="bs-component" style="margin-bottom: 15px;">
        <div class="btn-group btn-group-justified">
            <?php echo $this->Html->link("Editar", "./request_edit/3", array('class' => 'btn btn-warning btn-lg btn-block')); ?>
            <?php echo $this->Html->link("Deletar", "./request_delete/2", array('class' => 'btn btn-danger btn-lg btn-block')); ?>
        </div>
    </div>
</div>