
<script>
                    $('#previous_stage2').click(function() {
                        window.location = "<?php echo base_url() . 'languages/' . $team->langcode . '/videos/go_to_stage/' . $query->id . '/' . $query->state . '/-1'; ?>";
                        return false;
                    });
                    $('#next_stage2').click(function() {
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