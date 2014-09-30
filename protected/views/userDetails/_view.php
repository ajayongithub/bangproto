<div class="view">

    <h2><?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id' => $data->id)); ?></h2>

    <?php
    if (!empty($data->location)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->location);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->raw_data)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('raw_data')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->raw_data);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->email)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::mailto($data->email);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->first_name)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->first_name);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->gender)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->gender);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->fid)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('fid')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->fid);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->last_name)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->last_name);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->link)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('link')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo Awecms::formatUrl($data->link,true);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->locale)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('locale')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->locale);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->timezone)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('timezone')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->timezone);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->updated_time)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('updated_time')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->updated_time);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->verified)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('verified')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->verified);
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
    if (!empty($data->original_video)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('original_video')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->original_video);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->composite_video)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('composite_video')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->composite_video);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->posting_status)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('posting_status')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->posting_status);
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
    if (!empty($data->extra)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('extra')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->extra);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
</div>