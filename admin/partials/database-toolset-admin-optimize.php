<?php
if((isset($_POST['dbt-query-optimize'])) && ($_POST['dbt-query-optimize'] === 'true')
&& check_admin_referer('dbt-process-form', 'query-optimize'))
{
    $action = $this->return_query_optimize();
    $notice = array('success', __('Your database has been successfully optimized !!', 'database-toolset'));
}
?>
<div class="wrap">
    <section class="wpdx-wrapper">
        <div class="wpdx-container">
            <div class="wpdx-tabs">
                <?php echo $this->return_plugin_header(); ?>
                <main class="tabs-main">
                    <?php echo $this->return_tabs_menu('tab2'); ?>
                    <section class="tab-section">
                        <?php if(isset($notice)) { ?>
                        <div class="wpdx-notice <?php echo esc_attr($notice[0]); ?>">
                            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                            <span><?php echo esc_attr($notice[1]); ?></span>
                        </div>
                        <?php } ?>
                        <div class="wpdx-table">
                            <table class="widefat">
                                <thead>
                                    <tr>
                                        <th style="width:90%" scope="col" class="wpdx-txtl"><?php _e('Table', 'database-toolset'); ?></th>
                                        <th style="width:10%" scope="col" class="wpdx-txtc"><?php _e('Size', 'database-toolset'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="the-list">
                                <?php
                                $total_size = 0;
                                $class_name = "class='alternate'";

                                $table = null;
                                $query = 'SHOW TABLE STATUS FROM `'.DB_NAME.'`';
                                $fetch = $wpdb->get_results($query);

                                foreach($fetch as $row)
                                {
                                    $table_size = $row->Data_length + $row->Index_length;
                                    $table_size = $table_size / 1024;
                                    $table_size = sprintf("%0.3f", $table_size);

                                    $every_size = $row->Data_length + $row->Index_length;
                                    $every_size = $every_size / 1024;
                                    $total_size += $every_size;

                                    $table.= '<tr '.$class_name.'>';
                                    $table.= '<td class="column-name wpdx-txtl">'.$row->Name.'</td>';
                                    $table.= '<td class="column-name wpdx-txtc">'.$table_size.' KB'.'</td>';
                                    $table.= '</tr>';

                                    $class_name = (empty($class_name)) ? "class='alternate'" : "";
                                }

                                echo $table;

                                ?>
                                </tbody>
                                <tfoot>
                                    <tr class="total">
                                        <th style="font-size:14px;" scope="col" class="wpdx-txtl"><b><?php _e('Total', 'database-toolset'); ?></b></th>
                                        <th style="font-size:14px;" scope="col" class="wpdx-txtc"><b><?php echo sprintf("%0.3f", $total_size).' KB'; ?></b></th>
                                    </tr>
                                    <?php
                                    if((isset($_POST['dbt-query-totalsize'])) && (is_numeric($_POST['dbt-query-totalsize'])))
                                    {
                                        $oldsize = $_POST['dbt-query-totalsize'];
                                        $savsize = ($total_size - $oldsize);

                                        $tbody = '<tr class="query">';
                                        $tbody.= '<th style="font-size:14px;" scope="col" class="wpdx-txtl"><b>'.__('Saved Space', 'database-toolset').'</b></th>';
                                        $tbody.= '<th style="font-size:14px;" scope="col" class="wpdx-txtc"><b>'.sprintf("%0.3f", $savsize).' KB'.'</b></th>';
                                        $tbody.= '</tr>';
                                        echo $tbody;
                                    }
                                    ?>
                                </tfoot>
                            </table>
                            <div class="form-footer">
                                <form method="POST">
                                    <input type="hidden" name="dbt-query-optimize" value="true" />
                                    <input type="hidden" name="dbt-query-totalsize" value="<?php echo $total_size; ?>" />
                                    <?php wp_nonce_field('dbt-process-form', 'query-optimize'); ?>
                                    <input type="submit" class="button button-primary button-theme" style="height:45px;" value="<?php _e('Optimize', 'database-toolset'); ?>" />
                                </form>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </section>
</div>