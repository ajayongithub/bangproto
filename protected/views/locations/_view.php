<div class="view">

    <h2><?php echo CHtml::encode($data->getAttributeLabel('site_name')); ?>:</h2>
<h2><?php echo CHtml::link(CHtml::encode($data->site_name), array('view', 'id' => $data->id)); ?></h2>

    <?php
    if (!empty($data->site_type)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('site_type')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->site_type);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->site_code)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('site_code')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->site_code);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->status)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->status);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->remarks)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('remarks')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->remarks);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->mynumbers)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('mynumbers')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->mynumbers);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
</div>