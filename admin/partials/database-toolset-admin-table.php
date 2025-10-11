<?php
if((isset($_GET['action'])) && ($_GET['action'] === 'deleted'))
{
    $notice = array('success', __('The selected SQL backup has been successfully deleted !!', 'database-toolset'));
}

$loadpath = wp_upload_dir();
$filepath = $loadpath["basedir"].'/export/database/';

$has_backup = false;
if(file_exists($filepath))
{
    $count = count(scandir($filepath))-2;
    if($count > 1)
    {
        $has_backup = true;
    }
}
?>
<div class="wrap">
    <section class="wpdx-wrapper">
        <div class="wpdx-container">
            <div class="wpdx-tabs">
                <?php echo $this->return_plugin_header(); ?>
                <main class="tabs-main">
                    <?php echo $this->return_tabs_menu('tab4'); ?>
                    <section class="tab-section">
                        <?php if(isset($notice)) { ?>
                        <div class="wpdx-notice <?php echo esc_attr($notice[0]); ?>">
                            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                            <span><?php echo esc_attr($notice[1]); ?></span>
                        </div>
                        <?php } elseif(isset($has_backup) && ($has_backup === false)) { ?>
                        <div class="wpdx-notice warning">
                            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                            <span><?php echo sprintf(__('You do not have any backup available yet ! You can configure your backup option %s.', 'database-toolset'), '<a href="'.admin_url('admin.php?page=database-toolset-schedule').'">'.__('here', 'database-toolset').'</a>'); ?></span>
                        </div>
                        <?php } ?>
                        <div class="wpdx-datatables">
                            <table id="backups-table" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><?php echo _e('Filename', 'database-toolset'); ?></th>
                                        <th><?php echo _e('Created', 'database-toolset'); ?></th>
                                        <th><?php echo _e('Size', 'database-toolset'); ?></th>
                                        <th><?php echo _e('Type', 'database-toolset'); ?></th>
                                        <th><?php echo _e('Operate', 'database-toolset'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($has_backup === true)
                                    {
                                        if($handle = opendir($filepath))
                                        {
                                            $table = null;
                                            while(false !== ($entry = readdir($handle)))
                                            {
                                                if(($entry != ".") && ($entry != "..") && ($entry != "index.php"))
                                                {
                                                    $filesize = filesize($filepath.$entry);
                                                    $filedate = date("F d Y H:i:s", filemtime($filepath.$entry));

                                                    $i = strrpos($entry,".");
                                                    if(!$i)
                                                    {
                                                        return "SQL";
                                                    }

                                                    $case = strlen($entry) - $i;
                                                    $exts = substr($entry, $i+1, $case);

                                                    $get_upload = wp_upload_dir();
                                                    $get_backup = $get_upload['baseurl'].'/export/database/'.$entry;
                                                    $get_remove = admin_url('admin.php?page=database-toolset-table').'&backup='.$entry.'&action=remove';

                                                    $table = '<tr>';
                                                    $table.= '<td class="wpdx-txtl">'.$entry.'</td>';
                                                    $table.= '<td class="wpdx-txtc">'.$filedate.'</td>';
                                                    $table.= '<td class="wpdx-txtc">'.$this->return_formatted_size($filesize).'</td>';
                                                    $table.= '<td class="wpdx-txtc">'.(($exts === 'gz') ? 'GZIP' : 'SQL').'</td>';
                                                    $table.= '<td class="wpdx-txtc"><a target="_blank" href="'.$get_backup.'" class="button button-primary">'.__('Download', 'database-toolset').'</a> <a href="'.$get_remove.'" class="button button-danger">'.__('Remove', 'database-toolset').'</a></td>';
                                                    $table.= '</tr>';
                                                    echo $table;
                                                }
                                            }

                                            closedir($handle);
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><?php echo _e('Filename'); ?></th>
                                        <th><?php echo _e('Created'); ?></th>
                                        <th><?php echo _e('Size'); ?></th>
                                        <th><?php echo _e('Type'); ?></th>
                                        <th><?php echo _e('Operate'); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </section>
</div>