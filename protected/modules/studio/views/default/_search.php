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
    <?php echo $form->labelEx($model,'location',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'location',array('size'=>60,'maxlength'=>128)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'raw_data',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'raw_data',array('size'=>60,'maxlength'=>1024)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'email',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'first_name',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>64)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'gender',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'gender',array('size'=>16,'maxlength'=>16)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'fid',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'fid',array('size'=>60,'maxlength'=>64)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'last_name',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>64)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'link',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>256)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'locale',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'locale',array('size'=>32,'maxlength'=>32)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'name',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'timezone',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'timezone',array('size'=>32,'maxlength'=>32)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'updated_time',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'updated_time',array('size'=>60,'maxlength'=>128)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'verified',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'verified',array('size'=>16,'maxlength'=>16)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'status',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'status',array('size'=>32,'maxlength'=>32)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'original_video',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'original_video',array('size'=>60,'maxlength'=>256)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'composite_video',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'composite_video',array('size'=>60,'maxlength'=>256)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'posting_status',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'posting_status',array('size'=>60,'maxlength'=>64)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'remarks',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'remarks',array('size'=>60,'maxlength'=>128)); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'extra',array('class'=>'control-label')) ; ?>
    <div class="controls">
      <?php echo $form->textField($model,'extra',array('size'=>60,'maxlength'=>256)); ?>
    </div>
  </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->