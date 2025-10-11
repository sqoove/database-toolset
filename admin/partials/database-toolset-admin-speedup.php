<?php
if((isset($_POST['dbt-query-speedup'])) && ($_POST['dbt-query-speedup'] === 'true')
&& check_admin_referer('dbt-process-form', 'query-speedup'))
{
    if(isset($_POST['_database_speedup']['options']))
    {
        $action = $this->return_query_speedup(true);
        $notice = array('success', __('Your database has been successfully optimized !!', 'database-toolset'));
    }
}
?>
<div class="wrap">
    <section class="wpdx-wrapper">
        <div class="wpdx-container">
            <div class="wpdx-tabs">
                <?php echo $this->return_plugin_header(); ?>
                <main class="tabs-main">
                    <?php echo $this->return_tabs_menu('tab5'); ?>
                    <section class="tab-section">
                        <?php if(isset($notice)) { ?>
                        <div class="wpdx-notice <?php echo esc_attr($notice[0]); ?>">
                            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                            <span><?php echo esc_attr($notice[1]); ?></span>
                        </div>
                        <?php } else { ?>
                        <div class="wpdx-notice warning">
                            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                            <span><?php echo _e('We recommend that you make a backup of your database before using the options below in order to restore your site in case an error occurs.', 'database-toolset'); ?></span>
                        </div>
                        <?php } ?>
                        <form method="POST">
                            <input type="hidden" name="dbt-query-speedup" value="true" />
                            <?php wp_nonce_field('dbt-process-form', 'query-speedup'); ?>
                            <div class="wpdx-form">
                                <div class="field">
                                    <?php $fieldID = uniqid(); ?>
                                    <span class="label"><?php echo _e('Optimize table WP "options"', 'database-toolset'); ?></span>
                                    <div class="onoffswitch">
                                        <input id="<?php echo esc_attr($fieldID); ?>" type="checkbox" name="_database_speedup[options]" class="onoffswitch-checkbox" />
                                        <label class="onoffswitch-label" for="<?php echo esc_attr($fieldID); ?>">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                    <small><?php echo _e('Do you want to reset the incrementation of your Wordpress "options" table ?', 'database-toolset'); ?></small>
                                </div>
                                <div class="form-footer">
                                    <input type="submit" class="button button-primary button-theme" style="height:45px;" value="<?php _e('Proceed', 'database-toolset'); ?>">
                                </div>
                            </div>
                        </form>
                    </section>
                </main>
            </div>
        </div>
    </section>
</div>