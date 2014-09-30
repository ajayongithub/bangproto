<div class="form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>

    <?php
    $form=$this->beginWidget('CActiveForm', array(
    'id'=>'locations-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    ));

    echo $form->errorSummary($model);
    ?>
    
      <div class="control-group">
        <?php echo $form->labelEx($model,'site_name',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'site_name',array('size'=>60,'maxlength'=>128)); ?>
          <div class="help-inline"><?php echo $form->error($model,'site_name'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'site_type',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'site_type',array('size'=>32,'maxlength'=>32)); ?>
          <div class="help-inline"><?php echo $form->error($model,'site_type'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'site_code',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'site_code',array('size'=>8,'maxlength'=>8)); ?>
          <div class="help-inline"><?php echo $form->error($model,'site_code'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'status',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'status',array('size'=>32,'maxlength'=>32)); ?>
          <div class="help-inline"><?php echo $form->error($model,'status'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'remarks',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'remarks',array('size'=>60,'maxlength'=>128)); ?>
          <div class="help-inline"><?php echo $form->error($model,'remarks'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'mynumbers',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'mynumbers'); ?>
          <div class="help-inline"><?php echo $form->error($model,'mynumbers'); ?>
</div>
        </div>
      </div>
        
  <div class="form-actions">
    <?php
        echo CHtml::submitButton(Yii::t('app', 'Save'),array('class'=>'btn btn-success'));
        echo '&nbsp;';
        echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			                                                'submit' => 'javascript:history.go(-1)',
			                                                'class'  => 'btn btn-inverse'
			                                                )
			                                              );
        $this->endWidget(); ?>
  </div>
</div> <!-- form -->