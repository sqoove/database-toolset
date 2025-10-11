<?php
$allowed = array
(
    "posts-revision", "posts-draft", "posts-autodraft", "posts-changeset", "comments-moderated", "comments-spam", "comments-trash",
    "orphan-postmeta", "orphan-commentmeta", "orphan-relationships", "orphan-transient-feed"
);

if((isset($_POST['dbt-query-cleanup'])) && (in_array($_POST['dbt-query-cleanup'], $allowed)))
{
    if(($_POST['dbt-query-cleanup'] === 'posts-revision')
    && check_admin_referer('dbt-process-form', 'posts-revision-delete'))
    {
        $action = $this->return_query_cleanup('posts-revision');
        $notice = array('success', __('All post revisions have been removed !!', 'database-toolset'));
    }

    if(($_POST['dbt-query-cleanup'] === 'posts-draft')
    && check_admin_referer('dbt-process-form', 'posts-draft-delete'))
    {
        $action = $this->return_query_cleanup('posts-draft');
        $notice = array('success', __('All post drafts have been removed !!', 'database-toolset'));
    }

    if(($_POST['dbt-query-cleanup'] === 'posts-autodraft')
    && check_admin_referer('dbt-process-form', 'posts-autodraft-delete'))
    {
        $action = $this->return_query_cleanup('posts-autodraft');
        $notice = array('success', __('All post autodrafts have been removed !!', 'database-toolset'));
    }

    if(($_POST['dbt-query-cleanup'] === 'posts-changeset')
    && check_admin_referer('dbt-process-form', 'posts-changeset-delete'))
    {
        $action = $this->return_query_cleanup('posts-changeset');
        $notice = array('success', __('All customize changeset post have been removed !!', 'database-toolset'));
    }

    if(($_POST['dbt-query-cleanup'] === 'comments-moderated')
    && check_admin_referer('dbt-process-form', 'comments-moderated-delete'))
    {
        $action = $this->return_query_cleanup('comments-moderated');
        $notice = array('success', __('All moderated comments have been removed !!', 'database-toolset'));
    }

    if(($_POST['dbt-query-cleanup'] === 'comments-spam')
    && check_admin_referer('dbt-process-form', 'comments-spam-delete'))
    {
        $action = $this->return_query_cleanup('comments-spam');
        $notice = array('success', __('All spam comments have been removed !!', 'database-toolset'));
    }

    if(($_POST['dbt-query-cleanup'] === 'comments-trash')
    && check_admin_referer('dbt-process-form', 'comments-trash-delete'))
    {
        $action = $this->return_query_cleanup('comments-trash');
        $notice = array('success', __('All trash comments have been removed !!', 'database-toolset'));
    }

    if(($_POST['dbt-query-cleanup'] === 'orphan-postmeta')
    && check_admin_referer('dbt-process-form', 'orphan-postmeta-delete'))
    {
        $action = $this->return_query_cleanup('orphan-postmeta');
        $notice = array('success', __('All orphan postmeta have been removed !!', 'database-toolset'));
    }

    if(($_POST['dbt-query-cleanup'] === 'orphan-commentmeta')
    && check_admin_referer('dbt-process-form', 'orphan-commentmeta-delete'))
    {
        $action = $this->return_query_cleanup('orphan-commentmeta');
        $notice = array('success', __('All orphan commentmeta have been removed !!', 'database-toolset'));
    }

    if(($_POST['dbt-query-cleanup'] === 'orphan-relationships')
    && check_admin_referer('dbt-process-form', 'orphan-relationships-delete'))
    {
        $action = $this->return_query_cleanup('orphan-relationships');
        $notice = array('success', __('All orphan relationships have been removed !!', 'database-toolset'));
    }

    if(($_POST['dbt-query-cleanup'] === 'orphan-transient-feed')
    && check_admin_referer('dbt-process-form', 'orphan-transient-feed-delete'))
    {
        $action = $this->return_query_cleanup('orphan-transient-feed');
        $notice = array('success', __('All dashboard transient feed have been removed !!', 'database-toolset'));
    }
}
elseif((isset($_POST['dbt-query-cleanup'])) && ($_POST['dbt-query-cleanup'] === 'all')
&& check_admin_referer('dbt-process-form', 'cleanup-all'))
{
    foreach($allowed as $taskname)
    {
        $action = $this->return_query_cleanup($taskname);
    }

    $notice = array('success', __('All redundant data have been removed !!', 'database-toolset'));
}

?>
<div class="wrap">
    <section class="wpdx-wrapper">
        <div class="wpdx-container">
            <div class="wpdx-tabs">
                <?php echo $this->return_plugin_header(); ?>
                <main class="tabs-main">
                    <?php echo $this->return_tabs_menu('tab1'); ?>
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
                                        <th style="width:80%" scope="col" class="wpdx-txtl"><?php _e('Type', 'database-toolset'); ?></th>
                                        <th style="width:10%" scope="col" class="wpdx-txtc"><?php _e('Count', 'database-toolset'); ?></th>
                                        <th style="width:10%" scope="col" class="wpdx-txtc"><?php _e('Operate', 'database-toolset'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="the-list">
                                    <tr class="alternate">
                                        <td class="column-name wpdx-txtl">
                                            <?php _e('Revision', 'database-toolset'); ?>
                                        </td>
                                        <td class="column-name wpdx-txtc">
                                            <?php echo $this->return_query_count('posts-revision'); ?>
                                        </td>
                                        <td class="column-name">
                                            <form method="POST" class="table-form">
                                                <input type="hidden" name="dbt-query-cleanup" value="posts-revision" />
                                                <?php wp_nonce_field('dbt-process-form', 'posts-revision-delete'); ?>
                                                <input type="submit" class="button button-primary" value="<?php _e('Remove', 'database-toolset'); ?>" />
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="column-name wpdx-txtl">
                                            <?php _e('Draft', 'database-toolset'); ?>
                                        </td>
                                        <td class="column-name wpdx-txtc">
                                            <?php echo $this->return_query_count('posts-draft'); ?>
                                        </td>
                                        <td class="column-name">
                                            <form method="POST" class="table-form">
                                                <input type="hidden" name="dbt-query-cleanup" value="posts-draft" />
                                                <?php wp_nonce_field('dbt-process-form', 'posts-draft-delete'); ?>
                                                <input type="submit" class="button button-primary" value="<?php _e('Remove', 'database-toolset'); ?>" />
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="alternate">
                                        <td class="column-name wpdx-txtl">
                                            <?php _e('Auto Draft', 'database-toolset'); ?>
                                        </td>
                                        <td class="column-name wpdx-txtc">
                                            <?php echo $this->return_query_count('posts-autodraft'); ?>
                                        </td>
                                        <td class="column-name">
                                            <form method="POST" class="table-form">
                                                <input type="hidden" name="dbt-query-cleanup" value="posts-autodraft" />
                                                <?php wp_nonce_field('dbt-process-form', 'posts-autodraft-delete'); ?>
                                                <input type="submit" class="button button-primary" value="<?php _e('Remove', 'database-toolset'); ?>" />
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="column-name">
                                            <?php _e('Customize Changeset', 'database-toolset'); ?>
                                        </td>
                                        <td class="column-name wpdx-txtc">
                                            <?php echo $this->return_query_count('posts-changeset'); ?>
                                        </td>
                                        <td class="column-name">
                                            <form method="POST" class="table-form">
                                                <input type="hidden" name="dbt-query-cleanup" value="posts-changeset" />
                                                <?php wp_nonce_field('dbt-process-form', 'posts-changeset-delete'); ?>
                                                <input type="submit" class="button button-primary" value="<?php _e('Remove', 'database-toolset'); ?>" />
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="alternate">
                                        <td class="column-name wpdx-txtl">
                                            <?php _e('Moderated Comments', 'database-toolset'); ?>
                                        </td>
                                        <td class="column-name wpdx-txtc">
                                            <?php echo $this->return_query_count('comments-moderated'); ?>
                                        </td>
                                        <td class="column-name">
                                            <form method="POST" class="table-form">
                                                <input type="hidden" name="dbt-query-cleanup" value="comments-moderated" />
                                                <?php wp_nonce_field('dbt-process-form', 'comments-moderated-delete'); ?>
                                                <input type="submit" class="button button-primary" value="<?php _e('Remove', 'database-toolset'); ?>" />
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="column-name wpdx-txtl">
                                            <?php _e('Spam Comments', 'database-toolset'); ?>
                                        </td>
                                        <td class="column-name wpdx-txtc">
                                            <?php echo $this->return_query_count('comments-spam'); ?>
                                        </td>
                                        <td class="column-name">
                                            <form method="POST" class="table-form">
                                                <input type="hidden" name="dbt-query-cleanup" value="comments-spam" />
                                                <?php wp_nonce_field('dbt-process-form', 'comments-spam-delete'); ?>
                                                <input type="submit" class="button button-primary" value="<?php _e('Remove', 'database-toolset'); ?>" />
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="alternate">
                                        <td class="column-name wpdx-txtl">
                                            <?php _e('Trash Comments', 'database-toolset'); ?>
                                        </td>
                                        <td class="column-name wpdx-txtc">
                                            <?php echo $this->return_query_count('comments-trash'); ?>
                                        </td>
                                        <td class="column-name">
                                            <form method="POST" class="table-form">
                                                <input type="hidden" name="dbt-query-cleanup" value="comments-trash" />
                                                <?php wp_nonce_field('dbt-process-form', 'comments-trash-delete'); ?>
                                                <input type="submit" class="button button-primary" value="<?php _e('Remove', 'database-toolset'); ?>" />
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="column-name wpdx-txtl">
                                            <?php _e('Orphan Postmeta', 'database-toolset'); ?>
                                        </td>
                                        <td class="column-name wpdx-txtc">
                                            <?php echo $this->return_query_count('orphan-postmeta'); ?>
                                        </td>
                                        <td class="column-name">
                                            <form method="POST" class="table-form">
                                                <input type="hidden" name="dbt-query-cleanup" value="orphan-postmeta" />
                                                <?php wp_nonce_field('dbt-process-form', 'orphan-postmeta-delete'); ?>
                                                <input type="submit" class="button button-primary" value="<?php _e('Remove', 'database-toolset'); ?>" />
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="alternate">
                                        <td class="column-name wpdx-txtl">
                                            <?php _e('Orphan Commentmeta', 'database-toolset'); ?>
                                        </td>
                                        <td class="column-name wpdx-txtc">
                                            <?php echo $this->return_query_count('orphan-commentmeta'); ?>
                                        </td>
                                        <td class="column-name">
                                            <form method="POST" class="table-form">
                                                <input type="hidden" name="dbt-query-cleanup" value="orphan-commentmeta" />
                                                <?php wp_nonce_field('dbt-process-form', 'orphan-commentmeta-delete'); ?>
                                                <input type="submit" class="button button-primary" value="<?php _e('Remove', 'database-toolset'); ?>" />
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="column-name wpdx-txtl">
                                            <?php _e('Orphan Relationships', 'database-toolset'); ?>
                                        </td>
                                        <td class="column-name wpdx-txtc">
                                            <?php echo $this->return_query_count('orphan-relationships'); ?>
                                        </td>
                                        <td class="column-name">
                                            <form method="POST" class="table-form">
                                                <input type="hidden" name="dbt-query-cleanup" value="orphan-relationships" />
                                                <?php wp_nonce_field('dbt-process-form', 'orphan-relationships-delete'); ?>
                                                <input type="submit" class="button button-primary" value="<?php _e('Remove', 'database-toolset'); ?>" />
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="alternate">
                                        <td class="column-name">
                                            <?php _e('Orphan Transient Feed', 'database-toolset'); ?>
                                        </td>
                                        <td class="column-name wpdx-txtc">
                                            <?php echo $this->return_query_count('orphan-transient-feed'); ?>
                                        </td>
                                        <td class="column-name">
                                            <form method="POST" class="table-form">
                                                <input type="hidden" name="dbt-query-cleanup" value="orphan-transient-feed" />
                                                <?php wp_nonce_field('dbt-process-form', 'orphan-transient-feed-delete'); ?>
                                                <input type="submit" class="button button-primary" value="<?php _e('Remove', 'database-toolset'); ?>" />
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-footer">
                                <form method="POST">
                                    <input type="hidden" name="dbt-query-cleanup" value="all" />
                                    <?php wp_nonce_field('dbt-process-form', 'cleanup-all'); ?>
                                    <input type="submit" class="button button-primary button-theme" style="height:45px;" value="<?php _e('Remove All', 'database-toolset'); ?>" />
                                </form>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </section>
</div>