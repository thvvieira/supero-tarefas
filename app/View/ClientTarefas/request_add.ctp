<div>
    <div class="well bs-component">
        <?php echo $this->Form->create('ClientTarefas', array('url' => array('action' => 'request_add'), 'class' => 'form-horizontal', 'inputDefaults' => array('label' => false))); ?>
        <fieldset>
            <legend>Adicionar</legend>
            <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">Título</label>
                <div class="col-lg-10">
                    <?php
                        echo $this->Form->input('Tarefa.titulo', array(
                            'type' => 'text',
                            'required' => true,
                            'maxlength' => '50',
                            'class' => 'form-control',
                            'placeholder' => 'Título',
                        ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="textArea" class="col-lg-2 control-label">Descrição</label>
                <div class="col-lg-10">
                    <?php
                        echo $this->Form->textarea('Tarefa.descricao', array(
                            'rows' => '3',
                            'required' => true,
                            'class' => 'form-control',
                            'placeholder' => 'Descrição',
                        ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="textArea" class="col-lg-2 control-label">Prioridade</label>
                <div class="col-lg-10">
                    <?php 
                        echo $this->Form->input('Tarefa.prioridade', array(
                            'options' => array(1 => 'Alta', 2 => 'Normal', 3 => 'Baixa'),
                            'class' => 'form-control',
                            'required' => true,
                            'empty' => 'Selecione ...'
                        ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </fieldset>
        <?php echo $this->Form->end(); ?>
    </div>
</div>