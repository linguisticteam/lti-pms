<?php
if ($is_original)
{
    ?>
    <div class="row">
        <div class="large-2 columns">
            <?php echo form_label('Transcribers'); ?>
            <div class="row">
                <div class="small-9 columns">
                    <select id="transcribers" name="transcribers" class="medium">
                        <?php
                        echo '<option value="0"></option>';
                        foreach ($team_members as $item):
                            echo '<option value="' . $item->id . '">' . $item->name . '</option>';
                        endforeach;
                        ?>
                    </select>

                </div>
                <div class="small-3 columns">
                    <button type="button"  id="add_transcriber" name="add_transcriber"  onclick="register_transcriber()" class="small button secondary">Add</button>
                </div>
            </div>

            <div class="row">
                <div class="small-9 columns">
                    <?php
                    echo form_input(array('id' => 'transcriber_name', 'name' => 'transcriber_name'), '');
                    ?>
                </div>
                <div class="small-3 columns">
                    <button type="button" id="add_transcriber_name" name="add_transcriber_name" onclick="register_transcriber_name()" class="small button secondary">Add</button>
                </div>
            </div>

            <div class="row collapse">
                <div class="small-12 columns">
                    <p>
                        <?php
                        $transcribers = $this->members_model->get_members_by_function($query->id, FUNCTION_TRANSCRIBE);

                        if (!empty($transcribers))
                        {
                            echo '<div style="font-size:11px">';
                            foreach ($transcribers as $item):
                                echo '<i class="foundicon-remove style1" onclick="unregister_transcriber_name(' . $item->id . ')"></i> ' . $item->name . '<br /><br />';
                            endforeach;
                            echo '</div>';
                        }

                        $out_transcribers = $this->members_model->get_out_members_by_function($query->id, FUNCTION_TRANSCRIBE);

                        if (!empty($out_transcribers))
                        {
                            echo '<div style="font-size:11px">';
                            foreach ($out_transcribers as $item):
                                echo '<i class="foundicon-remove style1" onclick="unregister_transcriber_name(\'' . $item . '\')"></i> ' . urldecode($item) . '<br /><br />';
                            endforeach;
                            echo '</div>';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="large-2 columns">
            <?php echo form_label('First Proofreaders'); ?>
            <div class="row">
                <div class="small-9 columns">
                    <select id="first_proof" name="first_proof" class="medium">
                        <?php
                        echo '<option value="0"></option>';
                        foreach ($team_members as $item):
                            echo '<option value="' . $item->id . '">' . $item->name . '</option>';
                        endforeach;
                        ?>
                    </select>

                </div>
                <div class="small-3 columns">
                    <button type="button" onclick="register_first_proof()" class="small button secondary">Add</button>
                </div>
            </div>

            <div class="row">
                <div class="small-9 columns">
                    <?php
                    echo form_input(array('id' => 'first_proof_name', 'name' => 'first_proof_name'), '');
                    ?>
                </div>
                <div class="small-3 columns">
                    <button type="button" id="add_first_proof_name" name="add_first_proof_name" onclick="register_first_proof_name()" class="small button secondary">Add</button>
                </div>
            </div>

            <div class="row collapse">
                <div class="small-12 columns">
                    <p>
                        <?php
                        $first_proofs = $this->members_model->get_members_by_function($query->id, FUNCTION_FIRST_PROOFREAD);

                        if (!empty($first_proofs))
                        {
                            echo '<div style="font-size:11px">';
                            foreach ($first_proofs as $item):
                                echo '<i class="foundicon-remove style1" onclick="unregister_first_proof_name(' . $item->id . ')"></i> ' . $item->name . '<br /><br />';
                            endforeach;
                            echo '</div>';
                        }

                        $out_first_proofs = $this->members_model->get_out_members_by_function($query->id, FUNCTION_FIRST_PROOFREAD);

                        if (!empty($out_first_proofs))
                        {
                            echo '<div style="font-size:11px">';
                            foreach ($out_first_proofs as $item):
                                echo '<i class="foundicon-remove style1" onclick="unregister_first_proof_name(\'' . $item . '\')"></i> ' . urldecode($item) . '<br /><br />';
                            endforeach;
                            echo '</div>';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="large-2 columns">
            <?php echo form_label('Timestamp'); ?>
            <div class="row">
                <div class="small-9 columns">
                    <select id="timestamp" name="timestamp" class="medium">
                        <?php
                        echo '<option value="0"></option>';
                        foreach ($team_members as $item):
                            echo '<option value="' . $item->id . '">' . $item->name . '</option>';
                        endforeach;
                        ?>
                    </select>

                </div>
                <div class="small-3 columns">
                    <button type="button" onclick="register_timestamp()" class="small button secondary">Add</button>
                </div>
            </div>

            <div class="row">
                <div class="small-9 columns">
                    <?php
                    echo form_input(array('id' => 'timestamp_name', 'name' => 'timestamp_name'), '');
                    ?>
                </div>
                <div class="small-3 columns">
                    <button type="button" id="add_timestamp_name" name="add_timestamp_name" onclick="register_timestamp_name()" class="small button secondary">Add</button>
                </div>
            </div>

            <div class="row collapse">
                <div class="small-12 columns">
                    <p>
                        <?php
                        $timestamp = $this->members_model->get_members_by_function($query->id, FUNCTION_TIMESTAMP);

                        if (!empty($timestamp))
                        {
                            echo '<div style="font-size:11px">';
                            foreach ($timestamp as $item):
                                echo '<i class="foundicon-remove style1" onclick="unregister_timestamp_name(' . $item->id . ')"></i> ' . $item->name . '<br /><br />';
                            endforeach;
                            echo '</div>';
                        }

                        $out_timestamp = $this->members_model->get_out_members_by_function($query->id, FUNCTION_TIMESTAMP);

                        if (!empty($out_timestamp))
                        {
                            echo '<div style="font-size:11px">';
                            foreach ($out_timestamp as $item):
                                echo '<i class="foundicon-remove style1" onclick="unregister_timestamp_name(\'' . $item . '\')"></i> ' . urldecode($item) . '<br /><br />';
                            endforeach;
                            echo '</div>';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="large-2 columns">
            <?php echo form_label('Final Proofreaders'); ?>
            <div class="row">
                <div class="small-9 columns">
                    <select id="final_proofs" name="final_proofs" class="medium">
                        <?php
                        echo '<option value="0"></option>';
                        foreach ($team_members as $item):
                            echo '<option value="' . $item->id . '">' . $item->name . '</option>';
                        endforeach;
                        ?>
                    </select>

                </div>
                <div class="small-3 columns">
                    <button type="button" onclick="register_final_proof()" class="small button secondary">Add</button>
                </div>
            </div>

            <div class="row">
                <div class="small-9 columns">
                    <?php
                    echo form_input(array('id' => 'final_proof_name', 'name' => 'final_proof_name'), '');
                    ?>
                </div>
                <div class="small-3 columns">
                    <button type="button" id="add_final_proof_name" name="add_final_proof_name" onclick="register_final_proof_name()" class="small button secondary">Add</button>
                </div>
            </div>

            <div class="row collapse">
                <div class="small-12 columns">
                    <p>
                        <?php
                        $final_proofs = $this->members_model->get_members_by_function($query->id, FUNCTION_FINAL_PROOFREAD);

                        if (!empty($final_proofs))
                        {
                            echo '<div style="font-size:11px">';
                            foreach ($final_proofs as $item):
                                echo '<i class="foundicon-remove style1" onclick="unregister_final_proof_name(' . $item->id . ')"></i> ' . $item->name . '<br /><br />';
                            endforeach;
                            echo '</div>';
                        }

                        $out_final_proof = $this->members_model->get_out_members_by_function($query->id, FUNCTION_FINAL_PROOFREAD);

                        if (!empty($out_final_proof))
                        {
                            echo '<div style="font-size:11px">';
                            foreach ($out_final_proof as $item):
                                echo '<i class="foundicon-remove style1" onclick="unregister_final_proof_name(\'' . $item . '\')"></i> ' . urldecode($item) . '<br /><br />';
                            endforeach;
                            echo '</div>';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="large-2 columns">
            <?php echo form_label('Final Review'); ?>
            <div class="row">
                <div class="small-9 columns">
                    <select id="final_review" name="final_review" class="medium">
                        <?php
                        echo '<option value="0"></option>';
                        foreach ($team_members as $item):
                            echo '<option value="' . $item->id . '">' . $item->name . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>

                <div class="small-3 columns">
                    <button type="button" onclick="register_final_review()" class="small button secondary">Add</button>
                </div>
            </div>

            <div class="row">
                <div class="small-9 columns">
                    <?php
                    echo form_input(array('id' => 'final_review_name', 'name' => 'final_review_name'), '');
                    ?>
                </div>
                <div class="small-3 columns">
                    <button type="button" id="add_final_review_name" name="add_final_review_name" onclick="register_final_review_name()" class="small button secondary">Add</button>
                </div>
            </div>

            <div class="row collapse">
                <div class="small-12 columns">
                    <p>
                        <?php
                        $final_review = $this->members_model->get_members_by_function($query->id, FUNCTION_FINAL_REVIEW);

                        if (!empty($final_review))
                        {
                            echo '<div style="font-size:11px">';
                            foreach ($final_review as $item):
                                echo '<i class="foundicon-remove style1" onclick="unregister_final_review_name(' . $item->id . ')"></i> ' . $item->name . '<br /><br />';
                            endforeach;
                            echo '</div>';
                        }

                        $out_final_review = $this->members_model->get_out_members_by_function($query->id, FUNCTION_FINAL_REVIEW);

                        if (!empty($out_final_review))
                        {
                            echo '<div style="font-size:11px">';
                            foreach ($out_final_review as $item):
                                echo '<i class="foundicon-remove style1" onclick="unregister_final_review_name(\'' . $item . '\')"></i> ' . urldecode($item) . '<br /><br />';
                            endforeach;
                            echo '</div>';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="large-2 columns">
        </div>
    </div>
    <?php
}
else
{
    ?>
    <div class="row">
        <div class="large-4 columns">
            <?php echo form_label('Translators'); ?>
            <div class="row">
                <div class="small-9 columns">
                    <select id="translators" name="translators" class="medium">
                        <?php
                        echo '<option value="0"></option>';
                        foreach ($team_members as $item):
                            echo '<option value="' . $item->id . '">' . $item->name . '</option>';
                        endforeach;
                        ?>
                    </select>

                </div>
                <div class="small-3 columns">
                    <button type="button" onclick="register_translator()" class="small button secondary">Add</button>
                </div>
            </div>

            <div class="row">
                <div class="small-9 columns">
                    <?php
                    echo form_input(array('id' => 'translator_name', 'name' => 'translator_name'), '');
                    ?>
                </div>
                <div class="small-3 columns">
                    <button type="button" id="add_translator_name" name="add_translator_name" onclick="register_translator_name()" class="small button secondary">Add</button>
                </div>
            </div>

            <div class="row collapse">
                <div class="small-12 columns">
                    <p>
                        <?php
                        $translators = $this->members_model->get_members_by_function($query->id, FUNCTION_TRANSLATE);

                        if (!empty($translators))
                        {
                            echo '<div style="font-size:11px">';
                            foreach ($translators as $item):
                                echo '<i class="foundicon-remove style1" onclick="unregister_translator_name(' . $item->id . ')"></i> ' . $item->name . '<br /><br />';
                            endforeach;
                            echo '</div>';
                        }

                        $out_translator = $this->members_model->get_out_members_by_function($query->id, FUNCTION_TRANSLATE);

                        if (!empty($out_translator))
                        {
                            echo '<div style="font-size:11px">';
                            foreach ($out_translator as $item):
                                echo '<i class="foundicon-remove style1" onclick="unregister_translator_name(\'' . $item . '\')"></i> ' . urldecode($item) . '<br /><br />';
                            endforeach;
                            echo '</div>';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="large-4 columns">
            <?php echo form_label('Proofreaders'); ?>
            <div class="row">
                <div class="small-9 columns">
                    <select id="proofreaders" name="proofreaders" class="medium">
                        <?php
                        echo '<option value="0"></option>';
                        foreach ($team_members as $item):
                            echo '<option value="' . $item->id . '">' . $item->name . '</option>';
                        endforeach;
                        ?>
                    </select>

                </div>
                <div class="small-3 columns">
                    <button type="button" onclick="register_proofreader()" class="small button secondary">Add</button>
                </div>
            </div>

            <div class="row">
                <div class="small-9 columns">
                    <?php
                    echo form_input(array('id' => 'proofreader_name', 'name' => 'proofreader_name'), '');
                    ?>
                </div>
                <div class="small-3 columns">
                    <button type="button" id="add_proofreader_name" name="add_proofreader_name" onclick="register_proofreader_name()" class="small button secondary">Add</button>
                </div>
            </div>

            <div class="row collapse">
                <div class="small-12 columns">
                    <p>
                        <?php
                        $proofreaders = $this->members_model->get_members_by_function($query->id, FUNCTION_PROOFREAD);

                        if (!empty($proofreaders))
                        {
                            echo '<div style="font-size:11px">';
                            foreach ($proofreaders as $item):
                                echo '<i class="foundicon-remove style1" onclick="unregister_proofreader_name(' . $item->id . ')"></i> ' . $item->name . '<br /><br />';
                            endforeach;
                            echo '</div>';
                        }

                        $out_proofreaders = $this->members_model->get_out_members_by_function($query->id, FUNCTION_PROOFREAD);

                        if (!empty($out_proofreaders))
                        {
                            echo '<div style="font-size:11px">';
                            foreach ($out_proofreaders as $item):
                                echo '<i class="foundicon-remove style1" onclick="unregister_proofreader_name(\'' . $item . '\')"></i> ' . urldecode($item) . '<br /><br />';
                            endforeach;
                            echo '</div>';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="large-4 columns">
        </div>
    </div>

    <?php
}
?>
    <div class="row collapse">
       <div class="small-3 small-centered columns">
           <?php
           $states = unserialize(MEDIA_STATES);
           echo '<p><span class="label" id="currentStatus">Current status: <strong>' . $states[$query->state] . '</strong></span></p>';
           ?>
       </div>
   </div>   
    

<?php
if ($is_original)
{
    ?>
    <div class="row collapse">
        <div class="large-6 small-centered columns">
            <?php
            echo '<div class="button-bar" style="margin: 0px auto;width: 50%;">';
            echo '<ul class="button-group round .even-2">';

            if ($query->state > STATE_OPEN_FOR_TRANSCRIPTION && $query->state < STATE_FINAL_REVIEW_COMPLETED)
                echo '<li><a href="#" id="previous_stage" class="small button secondary">Previous stage</a></li>';
            if ($query->state < STATE_FINAL_REVIEW_COMPLETED)
                echo '<li><a href="#" id="next_stage" class="small button secondary">Next stage</a></li>';
            if ($query->state == STATE_FINAL_REVIEW_COMPLETED)
                echo '<li><a href="#" id="release_video" class="small button success">Release translation</a></li>';
            echo '</ul>';
            echo '</div>'
            ?>
        </div>
    </div>
    <?php
}
else
{
    ?>
    <div class="row collapse">
        <div class="large-6 small-centered columns">
            <?php
            echo '<div class="button-bar" style="margin: 0px auto;width: 50%;">';
            echo '<ul class="button-group round .even-2">';

            if ($query->state > STATE_OPEN_FOR_TRANSLATION && $query->state < STATE_POSTED)
                echo '<li><a href="#" id="previous_stage" class="small button secondary">Previous stage</a></li>';
            if ($query->state < STATE_POSTED)
                echo '<li><a href="#" id="next_stage" class="small button secondary">Next stage</a></li>';
            if ($query->state == STATE_POSTED)
                echo '<li><a href="#" id="move_repository" class="small button success">Move to repository</a></li>';
            echo '</ul>';
            echo '</div>'
            ?>
        </div>
    </div>
    <?php
}
?>

<script>
//    $('#previous_stage').click(function() {
//        $('previous_stage').html('<div><img src="<?php echo base_url(); ?>img/loading.gif"></div>');
//
//        var url = "<?php echo base_url() . 'index.php/videos/previous_stage' ?>";
//
//        $.post(url, {media_id: <?php echo $query->id ?>},
//        function() {
//            $('previous_stage').html('<a href="#" id="previous_stage" class="small button secondary">Previous stage</a>');
//        });
//    });
//    $('#next_stage').click(function() {
//        $('next_stage').html('<div><img src="<?php echo base_url(); ?>img/loading.gif"></div>');
//
//        var url = "<?php echo base_url() . 'index.php/videos/next_stage' ?>";
//
//        $.post(url, {media_id: <?php echo $query->id ?>},
//        function() {
//            $('next_stage').html('<a href="#" id="next_stage" class="small button secondary">Next stage</a>');
//        });
//    });
    
    $('#previous_stage').click(function() {
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/go_to_stage/' . $query->id . '/' . $query->state . '/-1'; ?>";
        return false;
    });
    $('#next_stage').click(function() {
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/go_to_stage/' . $query->id . '/' . $query->state . '/1'; ?>";
        return false;
    });
    $('#release_video').click(function() {
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/release_video/' . $query->id; ?>";
        return false;
    });
    $('#move_repository').click(function() {
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/go_to_stage/' . $query->id . '/' . $query->state . '/1'; ?>";
        return false;
    });

    function register_transcriber()
    {
        var e = document.getElementById("transcribers").value;
        if (e != 0)
            window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/register_member_function/' . $query->id . '/' . FUNCTION_TRANSCRIBE . '/'; ?>" + e + "";
    }
    function register_transcriber_name()
    {
        var e = document.getElementById("transcriber_name").value;
        if (e.length != 0 && e.length < 45)
            window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/register_member_function/' . $query->id . '/' . FUNCTION_TRANSCRIBE . '/'; ?>" + e + "";
    }
    function unregister_transcriber_name(id)
    {
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/unregister_member_function/' . $query->id . '/' . FUNCTION_TRANSCRIBE . '/'; ?>" + id + "";
    }

    function register_first_proof()
    {
        var e = document.getElementById("first_proof").value;
        if (e != 0)
            window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/register_member_function/' . $query->id . '/' . FUNCTION_FIRST_PROOFREAD . '/'; ?>" + e + "";
    }
    function register_first_proof_name()
    {
        var e = document.getElementById("first_proof_name").value;
        if (e.length != 0 && e.length < 45)
            window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/register_member_function/' . $query->id . '/' . FUNCTION_FIRST_PROOFREAD . '/'; ?>" + e + "";
    }
    function unregister_first_proof_name(id)
    {
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/unregister_member_function/' . $query->id . '/' . FUNCTION_FIRST_PROOFREAD . '/'; ?>" + id + "";
    }

    function register_timestamp()
    {
        var e = document.getElementById("timestamp").value;
        if (e != 0)
            window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/register_member_function/' . $query->id . '/' . FUNCTION_TIMESTAMP . '/'; ?>" + e + "";
    }
    function register_timestamp_name()
    {
        var e = document.getElementById("timestamp_name").value;
        if (e.length != 0 && e.length < 45)
            window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/register_member_function/' . $query->id . '/' . FUNCTION_TIMESTAMP . '/'; ?>" + e + "";
    }
    function unregister_timestamp_name(id)
    {
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/unregister_member_function/' . $query->id . '/' . FUNCTION_TIMESTAMP . '/'; ?>" + id + "";
    }

    function register_final_proof()
    {
        var e = document.getElementById("final_proofs").value;
        if (e != 0)
            window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/register_member_function/' . $query->id . '/' . FUNCTION_FINAL_PROOFREAD . '/'; ?>" + e + "";
    }
    function register_final_proof_name()
    {
        var e = document.getElementById("final_proof_name").value;
        if (e.length != 0 && e.length < 45)
            window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/register_member_function/' . $query->id . '/' . FUNCTION_FINAL_PROOFREAD . '/'; ?>" + e + "";
    }
    function unregister_final_proof_name(id)
    {
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/unregister_member_function/' . $query->id . '/' . FUNCTION_FINAL_PROOFREAD . '/'; ?>" + id + "";
    }

    function register_final_review()
    {
        var e = document.getElementById("final_review").value;
        if (e != 0)
            window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/register_member_function/' . $query->id . '/' . FUNCTION_FINAL_REVIEW . '/'; ?>" + e + "";
    }
    function register_final_review_name()
    {
        var e = document.getElementById("final_review_name").value;
        if (e.length != 0 && e.length < 45)
            window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/register_member_function/' . $query->id . '/' . FUNCTION_FINAL_REVIEW . '/'; ?>" + e + "";
    }
    function unregister_final_review_name(id)
    {
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/unregister_member_function/' . $query->id . '/' . FUNCTION_FINAL_REVIEW . '/'; ?>" + id + "";
    }

    function register_translator()
    {
        var e = document.getElementById("translators").value;
        if (e != 0)
            window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/register_member_function/' . $query->id . '/' . FUNCTION_TRANSLATE . '/'; ?>" + e + "";
    }
    function register_translator_name()
    {
        var e = document.getElementById("translator_name").value;
        if (e.length != 0 && e.length < 45)
            window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/register_member_function/' . $query->id . '/' . FUNCTION_TRANSLATE . '/'; ?>" + e + "";
    }
    function unregister_translator_name(id)
    {
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/unregister_member_function/' . $query->id . '/' . FUNCTION_TRANSLATE . '/'; ?>" + id + "";
    }

    function register_proofreader()
    {
        var e = document.getElementById("proofreaders").value;
        if (e != 0)
            window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/register_member_function/' . $query->id . '/' . FUNCTION_PROOFREAD . '/'; ?>" + e + "";
    }
    function register_proofreader_name()
    {
        var e = document.getElementById("proofreader_name").value;
        if (e.length != 0 && e.length < 45)
            window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/register_member_function/' . $query->id . '/' . FUNCTION_PROOFREAD . '/'; ?>" + e + "";
    }
    function unregister_proofreader_name(id)
    {
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/unregister_member_function/' . $query->id . '/' . FUNCTION_PROOFREAD . '/'; ?>" + id + "";
    }

    $(function()
    {
        $('#date_added').datepicker();
        $('#date_added').datepicker('option', 'dateFormat', 'yy-mm-dd');

        $('#date_finished').datepicker();
        $('#date_finished').datepicker('option', 'dateFormat', 'yy-mm-dd');
    });

    function getDuration()
    {
        var hours = document.forms[0]["hours"].value;
        var minutes = document.forms[0]["minutes"].value;
        var seconds = document.forms[0]["seconds"].value;

        document.forms[0]["duration"].value = hours + ":" + minutes + ":" + seconds;
    }
</script>