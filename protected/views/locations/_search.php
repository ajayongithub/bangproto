<div class="wide form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

  <div class="control-group">
    <?php echo $form->labelEx($model,'id',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'id'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'site_name',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'site_name',array('size'=>60,'maxlength'=>128)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'site_type',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'site_type',array('size'=>32,'maxlength'=>32)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'site_code',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'site_code',array('size'=>8,'maxlength'=>8)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'status',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'status',array('size'=>32,'maxlength'=>32)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'remarks',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'remarks',array('size'=>60,'maxlength'=>128)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'mynumbers',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'mynumbers'); ?>
    </div>
  </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->