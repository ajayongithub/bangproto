<div class="form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>

    <?php
    $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-details-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    ));

    echo $form->errorSummary($model);
    ?>
    
      <div class="control-group">
        <?php echo $form->labelEx($model,'location',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'location',array('size'=>60,'maxlength'=>128)); ?>
          <div class="help-inline"><?php echo $form->error($model,'location'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'raw_data',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'raw_data',array('size'=>60,'maxlength'=>1024)); ?>
          <div class="help-inline"><?php echo $form->error($model,'raw_data'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'email',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
          <div class="help-inline"><?php echo $form->error($model,'email'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'first_name',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>64)); ?>
          <div class="help-inline"><?php echo $form->error($model,'first_name'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'gender',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'gender',array('size'=>16,'maxlength'=>16)); ?>
          <div class="help-inline"><?php echo $form->error($model,'gender'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'fid',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'fid',array('size'=>60,'maxlength'=>64)); ?>
          <div class="help-inline"><?php echo $form->error($model,'fid'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'last_name',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>64)); ?>
          <div class="help-inline"><?php echo $form->error($model,'last_name'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'link',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>256)); ?>
          <div class="help-inline"><?php echo $form->error($model,'link'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'locale',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'locale',array('size'=>32,'maxlength'=>32)); ?>
          <div class="help-inline"><?php echo $form->error($model,'locale'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'name',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
          <div class="help-inline"><?php echo $form->error($model,'name'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'timezone',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'timezone',array('size'=>32,'maxlength'=>32)); ?>
          <div class="help-inline"><?php echo $form->error($model,'timezone'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'updated_time',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'updated_time',array('size'=>60,'maxlength'=>128)); ?>
          <div class="help-inline"><?php echo $form->error($model,'updated_time'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'verified',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'verified',array('size'=>16,'maxlength'=>16)); ?>
          <div class="help-inline"><?php echo $form->error($model,'verified'); ?>
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
        <?php echo $form->labelEx($model,'original_video',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'original_video',array('size'=>60,'maxlength'=>256)); ?>
          <div class="help-inline"><?php echo $form->error($model,'original_video'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'composite_video',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'composite_video',array('size'=>60,'maxlength'=>256)); ?>
          <div class="help-inline"><?php echo $form->error($model,'composite_video'); ?>
</div>
        </div>
      </div>
        
      <div class="control-group">
        <?php echo $form->labelEx($model,'posting_status',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'posting_status',array('size'=>60,'maxlength'=>64)); ?>
          <div class="help-inline"><?php echo $form->error($model,'posting_status'); ?>
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
        <?php echo $form->labelEx($model,'extra',array('class'=>'control-label')) ; ?>
        <div class="controls">
          <?php echo $form->textField($model,'extra',array('size'=>60,'maxlength'=>256)); ?>
          <div class="help-inline"><?php echo $form->error($model,'extra'); ?>
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