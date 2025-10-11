<?php
if((isset($_GET['status'])) && ($_GET['status'] === 'updated'))
{
    $notice = array('success', __('Your settings have been successfully updated.', 'database-toolset'));
}
elseif((isset($_GET['status'])) && ($_GET['status'] === 'error'))
{
    if((isset($_GET['type'])) && ($_GET['type'] === 'email'))
    {
        $notice = array('wrong', __('Your email address is not valid !!', 'database-toolset'));
    }
    elseif((isset($_GET['type'])) && ($_GET['type'] === 'unknown'))
    {
        $notice = array('wrong', __('An unknown error occured !!', 'database-toolset'));
    }
}
?>
<div class="wrap">
    <section class="wpdx-wrapper">
        <div class="wpdx-container">
            <div class="wpdx-tabs">
                <?php echo $this->return_plugin_header(); ?>
                <main class="tabs-main">
                    <?php echo $this->return_tabs_menu('tab3'); ?>
                    <section class="tab-section">
                        <?php if(isset($notice)) { ?>
                        <div class="wpdx-notice <?php echo esc_attr($notice[0]); ?>">
                            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                            <span><?php echo esc_attr($notice[1]); ?></span>
                        </div>
                        <?php } elseif((isset($opts['status']) && ($opts['status']) === 'off')) { ?>
                        <div class="wpdx-notice warning">
                            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                            <span><?php echo _e('You have not set up your backup options ! In order to do so, please use the below form.', 'database-toolset'); ?></span>
                        </div>
                        <?php } else { ?>
                        <div class="wpdx-notice info">
                            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                            <span><?php echo _e('Your plugin is properly configured ! You can change at anytime your backup options using the below form.', 'database-toolset'); ?></span>
                        </div>
                        <?php } ?>
                        <form method="POST">
                            <input type="hidden" name="dbt-update-option" value="true" />
                            <?php wp_nonce_field('dbt-referer-form', 'query-option'); ?>
                            <div class="wpdx-form">
                                <div class="field">
                                    <?php $fieldID = uniqid(); ?>
                                    <span class="label"><?php echo _e('Backup Manager', 'database-toolset'); ?></span>
                                    <div class="onoffswitch">
                                        <input id="<?php echo esc_attr($fieldID); ?>" type="checkbox" name="_database_toolset[status]" class="onoffswitch-checkbox input-status" <?php if((isset($opts['status'])) && ($opts['status'] === 'on')) { echo 'checked="checked"';} ?>/>
                                        <label class="onoffswitch-label" for="<?php echo esc_attr($fieldID); ?>">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                    <small><?php echo _e('You can use the above toggle button to enable or disable the backup manager at anytime.', 'database-toolset'); ?></small>
                                </div>
                                <div id="handler-status" class="subfield <?php if((isset($opts['status'])) && ($opts['status'] === 'on')) { echo 'show'; } ?>">
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('GZIP Compression', 'database-toolset'); ?></span>
                                        <div class="onoffswitch">
                                            <input id="<?php echo esc_attr($fieldID); ?>" type="checkbox" name="_database_toolset[gzip]" class="onoffswitch-checkbox" <?php if((isset($opts['gzip'])) && ($opts['gzip'] === 'on')) { echo 'checked="checked"';} ?>/>
                                            <label class="onoffswitch-label" for="<?php echo esc_attr($fieldID); ?>">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                        <small><?php echo _e('Do you want to compress your backup using Gzip in order to reduce the file size ?', 'database-toolset'); ?></small>
                                    </div>
                                    <div class="field">
                                        <?php $fieldID = uniqid(); ?>
                                        <span class="label"><?php echo _e('Notification', 'database-toolset'); ?></span>
                                        <div class="onoffswitch">
                                            <input id="<?php echo esc_attr($fieldID); ?>" type="checkbox" name="_database_toolset[notify]" class="onoffswitch-checkbox input-notify" <?php if((isset($opts['notify'])) && ($opts['notify'] === 'on')) { echo 'checked="checked"';} ?>/>
                                            <label class="onoffswitch-label" for="<?php echo esc_attr($fieldID); ?>">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                        <small><?php echo _e('Do you want to receive a notification by email every time a new backup has been created ?', 'database-toolset'); ?></small>
                                    </div>
                                    <div id="handler-notify" class="subfield <?php if((isset($opts['notify'])) && ($opts['notify'] === 'on')) { echo 'show'; } ?>">
                                        <div class="field">
                                            <?php $fieldID = uniqid(); ?>
                                            <span class="label"><?php echo _e('Email Address', 'database-toolset'); ?><span class="redmark">(<span>*</span>)</span></span>
                                            <input type="email" id="<?php echo $fieldID ?>" name="_database_toolset[email]" placeholder="<?php echo _e('Enter your email address', 'database-toolset'); ?>" value="<?php if((isset($opts['email'])) && ($opts['email'] !== 'none')) { echo stripslashes($opts['email']); } ?>" autocomplete="OFF" />
                                            <small><?php echo _e('Enter the email address to which you want to receive the notifications.', 'database-toolset'); ?></small>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <span class="label"><?php echo _e('Schedule', 'database-toolset'); ?></span>
                                        <label class="radiobox">
                                            <span><?php echo _e('Never', 'database-toolset'); ?></span>
                                            <input type="radio" id="<?php echo $fieldID ?>" name="_database_toolset[crontab]" value="never" class="common" <?php if((isset($opts['crontab'])) && ($opts['crontab'] === 'never')) { echo 'checked="checked"';} elseif(!isset($opts['crontab'])) { echo 'checked="checked"';} ?>/>
                                            <span class="checkmark"></span>
                                        </label>
                                        <hr/>
                                        <?php
                                        $crontime = array
                                        (
                                            '5min' => __('Every 5 minutes', 'database-toolset'),
                                            '15min' => __('Every 15 minutes', 'database-toolset'),
                                            '30min' => __('Every 30 minutes', 'database-toolset'),
                                            '60min' => __('Every 60 minutes', 'database-toolset'),
                                            '6h' => __('Every 6 hours', 'database-toolset'),
                                            '12h' => __('Every 12 hours', 'database-toolset'),
                                            '24h' => __('Every 24 hours', 'database-toolset'),
                                            '7d' => __('Once weekly', 'database-toolset')
                                        );

                                        foreach($crontime as $cronkey => $cronval)
                                        {
                                            $fieldID = uniqid();
                                            $output = '<div class="break-05"><!-- Line Break 05px --></div>';
                                            $output.= '<label class="radiobox">';
                                            $output.= '<span>'.$cronval.'</span>';
                                            $output.= '<input type="radio" id="'.$fieldID.'" name="_database_toolset[crontab]" value="'.$cronkey.'" class="common" '.(((isset($opts['crontab'])) && ($opts['crontab'] === $cronkey)) ? 'checked="checked"' : '').' />';
                                            $output.= '<span class="checkmark"></span>';
                                            $output.= '</label>';
                                            $output.= '<hr/>';
                                            echo $output;
                                        }

                                        ?>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <input type="submit" class="button button-primary button-theme" style="height:45px;" value="<?php _e('Update Settings', 'database-toolset'); ?>">
                                </div>
                            </div>
                        </form>
                    </section>
                </main>
            </div>
        </div>
    </section>
</div>