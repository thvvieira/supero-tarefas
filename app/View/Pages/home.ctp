<div class="text-right">
    <a class="btn btn-info" id="trash" href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true"></a>
    <a class="btn btn-success" href="#">Adicionar</a>
</div>
<br>
<table class="table table-striped table-hover ">
      <tr>
        <th>#</th>
        <th>Título</th>
        <th>Descrição</th>
        <th>Prioridade</th>
        <th class="text-right">Ações</th>
      </tr>
      <?php foreach ($tarefas as $tarefa){ ?>
      <tr id="t<?php echo $tarefa['Tarefa']['id']?>">
        <td><?php echo $tarefa['Tarefa']['id']?></td>
        <td><?php echo $tarefa['Tarefa']['titulo']?></td>
        <td><?php echo $tarefa['Tarefa']['descricao']?></td>
        <?php if($tarefa['Tarefa']['prioridade'] === '1'){?>
            <td>
                <span class="label label-danger"><?php echo 'ALTA' ?></span>
            </td>
        <?php } elseif($tarefa['Tarefa']['prioridade'] === '2'){ ?>
            <td class="text-warning">
                <span class="label label-warning"><?php echo 'NORMAL'; ?></span>
            </td>
        <?php }else{?>
             <td>
                <?php echo 'BAIXA'; ?>
            </td>
        <?php }?>
        <td class="text-right">
            <a class="btn btn-warning disabled" href="#">Editar</a>&nbsp;&nbsp;&nbsp;
            <a class="btn btn-danger delete-item" id="<?php echo $tarefa['Tarefa']['id']?>" href="#">Deletar<br><small>Clique e arraste para a lixeira</small></a>
        </td>
      </tr>
      <?php } ?>
  </table>
<hr>
<?php
    echo $this->Html->script("views/pages/home");
