<?php
$id = $this->uri->segment(3);

if ($id==NULL) redirect('videos');

$query = $this->videos_model->get_video($id)->row();
?>
<div class="row">
    <div class="twelve columns">
        <fieldset>
            <legend>Remove Video</legend>

            <?php
                echo form_open("videos/remove/$id");
            ?>
            
            <div class="row">
                <div class="twelve columns">
                    <?php
                        echo form_label('Title');
                        echo form_input(array('id'=>'title','name'=>'title'),set_value('title',$query->title),'autofocus');
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="six columns">
                    <?php echo form_submit('submit','Remove Video','class="button"'); ?>
                </div>
            </div>

            <?php
                echo form_hidden('id',$query->id);
                echo form_close();
            ?>
        </fieldset>
    </div>
</div>
