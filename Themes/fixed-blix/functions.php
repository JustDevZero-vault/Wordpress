<?php
    if ( function_exists('register_sidebar') )
        register_sidebar(array(
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h2><em>',
            'after_title' => '</em></h2>',
        ));


    $themename = 'Blix';
    $shortname = 'blix';
    $options = array (
        array(
            'type' => 'open'
        ),
        array(
            'name' => 'Layout',
            'id' => $shortname.'_layout',
            'type' => 'select',
            'options' => array('Fixed Width', 'Fluid Width'),
            'std' => 'Fixed Width'
        ),
        array(
            'name' => 'Sidebar',
            'desc' => 'Show sidebar on pages.',
            'id' => $shortname.'_sidebar',
            'type' => 'checkbox',
            'std' => false
        ),
        array(
            'name' => 'Page Navigation',
            'desc' => 'Navigation menu location of additional pages other than the \'about\', \'archives\', and \'contact\' pages.',
            'id' => $shortname.'_navigation_location',
            'type' => 'select',
            'options' => array('Horizontal Menu', 'Sidebar'),
            'std' => 'Horizontal Menu'
        ),
        array(
            'name' => 'Sub-Pages',
            'desc' => 'Hide sub-pages in navigation menu.',
            'id' => $shortname.'_navigation_hide_subpages',
            'type' => 'checkbox',
            'std' => false
        ),
        array(
            'type' => 'close'
        )
    );

    function blix_add_admin() {
        global $themename, $shortname, $options;

        if ( $_GET['page'] == basename(__FILE__) ) {
            if ( 'save' == $_REQUEST['action'] ) {
                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
                header('Location: themes.php?page=functions.php&saved=true');
                die;
            } else if( 'reset' == $_REQUEST['action'] ) {
                foreach ($options as $value) {
                    delete_option( $value['id'] ); }
                header('Location: themes.php?page=functions.php&reset=true');
                die;
            }
        }
        add_theme_page($themename.' Options', ''.$themename.' Options', 'edit_themes', basename(__FILE__), 'blix_admin');
    }

    function blix_admin() {
        global $themename, $shortname, $options;

        if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
        if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
?>
    <div class="wrap">
    <h2><?php echo $themename; ?> settings</h2>
    <form method="post">

<?php
    foreach ($options as $value) {
        switch ( $value['type'] ) {
            case 'open':
?>
        <table width="100%" border="0" style="background-color:#eef5fb; padding:10px;">
<?php
                break;
            case 'close':
?>
        </table><br />
<?php
                break;
            case 'title':
?>
        <table width="100%" border="0" style="background-color:#dceefc; padding:5px 10px;">
            <tr>
                <td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
            </tr>
<?php
                break;
            case 'text':
?>
            <tr>
                <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != '') { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
            </tr>
            <tr><td><small><?php echo $value['desc']; ?></small></td></tr>
            <tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr>
            <tr><td colspan="2">&nbsp;</td></tr>
<?php
                break;
            case 'textarea':
?>
            <tr>
                <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != '') { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?></textarea></td>
            </tr>
            <tr><td><small><?php echo $value['desc']; ?></small></td></tr>
            <tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr>
            <tr><td colspan="2">&nbsp;</td></tr>
<?php
                break;
            case 'select':
?>
            <tr>
                <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
            </tr>
            <tr><td><small><?php echo $value['desc']; ?></small></td></tr>
            <tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr>
            <tr><td colspan="2">&nbsp;</td></tr>
<?php
                break;
            case 'checkbox':
?>
            <tr>
                <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"><? if(get_settings($value['id'])){ $checked = 'checked="checked"'; }else{ $checked = ''; } ?>
                    <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                </td>
            </tr>
            <tr><td><small><?php echo $value['desc']; ?></small></td></tr>
            <tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr>
            <tr><td colspan="2">&nbsp;</td></tr>
<?php
                break;
        }
    }
?>

        <p class="submit">
            <input name="save" type="submit" value="Save changes" />
            <input type="hidden" name="action" value="save" />
        </p>
    </form>
    <form method="post">
        <p class="submit">
            <input name="reset" type="submit" value="Reset" />
            <input type="hidden" name="action" value="reset" />
        </p>
    </form>

<?php
}

    add_action('admin_menu', 'blix_add_admin');
?>
