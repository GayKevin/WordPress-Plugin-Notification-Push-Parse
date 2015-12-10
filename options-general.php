<?php
/**
 * User: Kévin Gay
 * Date: 10/12/2015
 * Time: 14:17
 */

    $array = split('\\\\', dirname(__FILE__));
    $folder = $array[count($array) - 1];

    if (isset($_POST["AppRest"])){
        $option = get_option("AppRest");
        if (isset($option)) { update_option("AppRest", $_POST["AppRest"]); }
        else { add_option("AppRest", $_POST["AppRest"]); }
    }

    if (isset($_POST["RestKey"])){
        $option = get_option("AppRest");
        if (isset($option)) { update_option("RestKey", $_POST["RestKey"]); }
        else { add_option("RestKey", $_POST["RestKey"]); }
    }

    if (isset($_POST["MasterKey"])){
        $option = get_option("MasterKey");
        if (isset($option)) { update_option("MasterKey", $_POST["MasterKey"]); }
        else { add_option("MasterKey", $_POST["MasterKey"]); }
    }

?>

<div class="wrap">
    <h1><?php echo esc_html( $title ); ?></h1>

    <form method="post" action="">
        <table class="form-table">
            <tr>
                <th scope="row"><label for="AppRest">App Rest</label></th>
                <td><input name="AppRest" type="text" id="AppRest" value="<?php echo get_option("AppRest"); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th scope="row"><label for="RestKey">Rest Key</label></th>
                <td><input name="RestKey" type="text" id="RestKey" value="<?php echo get_option("RestKey"); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th scope="row"><label for="MasterKey">Master Rest</label></th>
                <td><input name="MasterKey" type="text" id="MasterKey" value="<?php echo get_option("MasterKey"); ?>" class="regular-text" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>

</div>