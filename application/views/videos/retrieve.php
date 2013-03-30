<div class="row">
    <div class="six columns">
        <div class="row collapse">
            <?php
                if ($this->session->flashdata('video_removed'))
                {
                    echo '<div class="alert-box success">'. $this->session->flashdata('video_removed') .'<a href="" class="close">&times;</a></div>';
                }
            ?>
        </div>
    </div>
</div>

<?php
$this->table->set_heading('#','Title','Status','Category','Location','Original','Final','Duration','Start date','Publish Date','Translators','Proofreaders','Comments','Forum','');

$status = unserialize(VIDEO_STATES);
$type = unserialize(VIDEO_TYPES);

$arr = array(); 
foreach ($translators as $item):
    $arr[ $item->id ] = $item->name;
endforeach;

$i = 1;
foreach ($videos as $item):    
    $list_translators = array();
    $list_proofreaders = array();

    if ( !empty( $item->translator_01 ) )
        $list_translators[] = $arr[$item->translator_01];
    if ( !empty( $item->translator_02 ) )
        $list_translators[] = $arr[$item->translator_02];
    if ( !empty( $item->translator_03 ) )
        $list_translators[] = $arr[$item->translator_03];
    if ( !empty( $item->translator_04 ) )
        $list_translators[] = $arr[$item->translator_04];
    if ( !empty( $item->translator_05 ) )
        $list_translators[] = $arr[$item->translator_05];
    if ( !empty( $item->translator_06 ) )
        $list_translators[] = $arr[$item->translator_06];
    
    if ( !empty( $item->proofreader_01 ) )
        $list_proofreaders[] = $arr[$item->proofreader_01];
    if ( !empty( $item->proofreader_02 ) )
        $list_proofreaders[] = $arr[$item->proofreader_02];
    if ( !empty( $item->proofreader_03 ) )
        $list_proofreaders[] = $arr[$item->proofreader_03];

    $w_l = (!empty($item->working_location)) ? '<a href="'.$item->working_location.'" target="_blank">link</a> - 
                                                <a href="' . $item->working_location . '/transcriptInformation/" target="_blank">info</a>' : '';
    
    $o_l = (!empty($item->original_link)) ? '<a href="'.$item->original_link.'" target="_blank">link</a>' : '';
    $y_l = (!empty($item->youtube_link)) ? '<a href="'.$item->youtube_link.'" target="_blank">link</a>' : '';

    $s_d = (substr($item->start_date, 0, 4) == '0000') ? '': $item->start_date;
    $p_d = (substr($item->publish_date, 0, 4) == '0000') ? '' : $item->publish_date;
    
    $f = (!empty($item->forum_thread)) ? '<a href="'.$item->forum_thread.'" target="_blank">link</a>' : '';

    $this->table->add_row($i, '<strong>'.$item->title.'</strong>', $status[$item->status], $type[$item->type],
                          $w_l, $o_l, $y_l,
                          $item->duration, $s_d, $p_d,
                          implode(", ", $list_translators),
                          implode(", ", $list_proofreaders),
                          $item->comments, $f,
                          anchor("videos/edit/$item->id",'Edit'). ' - ' .anchor("videos/remove/$item->id",'Remove'));
    $i++;
endforeach;

echo $this->table->generate();