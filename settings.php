<style>
.demo-card-wide.mdl-card {
    width: 95%;
    margin: 1rem;
}

.demo-card-wide>.mdl-card__title {
    color: #fff;
    height: 176px;
    background: url('https://getmdl.io/assets/demos/welcome_card.jpg') center / cover;
}

.demo-card-wide>.mdl-card__menu {
    color: #fff;
}

.mdl-view {
    justify-content: space-between;
    display: flex;
    align-items: center;
}

a:focus {
    box-shadow: none;
}

.radio_wrapper {
    width: 100%;
    align-items: center;
    display: flex;
}

.radio_wrapper .mdl-radio-last {
    margin-left: 2rem;
}

.mdb-title {
    color: rgba(0, 0, 0, .54);
    font-size: 1.2rem;
    padding: 16px;
}

body .mdl-textfield {
    width: 100%;
}

body input.mdl-textfield__input {
    border: none;
    border-bottom: 1px solid rgba(0, 0, 0, .12);
    color: inherit;
}

body input.mdl-textfield__input:focus {
    border: none;
    box-shadow: none;
}

body .editor_wrapper {
    padding: 16px;
}

body .mdl-textfield__label {
    padding-left: 6px;
}

body .wp-picker-container {
    width: 100%;
}
</style>


<?php
    $settings = get_option( 'crp_settings_data' );
    $settings = json_decode(stripslashes($settings), true);
    $settings = get_crp_default_settings($settings);
?>

<div class="demo-card-wide mdl-card mdl-shadow--2dp">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">CONTENT RESTRICTION</h2>
    </div>
    <div class="mdl-card__supporting-text">Restrict user to access the content. Only login user can access the content.
    </div>
    <div class="mdl-card__actions mdl-card--border">

        <div class="mdl-view">
            <label class="mdl-card__supporting-text">Enable Plugin</label>
            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="pluginEnable">
                <input type="checkbox" id="pluginEnable" class="mdl-switch__input"
                    <?php echo filter_var($settings->pluginEnable, FILTER_VALIDATE_BOOLEAN) ? "checked" : ""; ?>>
                <span class="mdl-switch__label"></span>
            </label>
        </div>

        <div class="mdl-view">
            <label class="mdl-card__supporting-text">How many times user can visit page without login?</label>
            <div class="mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input" value="<?php echo $settings->numberOfVisits; ?>" type="text"
                    pattern="-?[0-9]+?" id="numberofTimesUserVisit">
                <label class="mdl-textfield__label" for="numberofTimesUserVisit">Visits...</label>
                <span class="mdl-textfield__error">Input is not a valid number!</span>
            </div>
        </div>

        <div class="mdl-view">
            <label class="mdl-card__supporting-text">Restriction Type</label>
            <div class="radio_wrapper">
                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="customMessageRadio">
                    <input type="radio" id="customMessageRadio" class="mdl-radio__button" name="restrictionType"
                        value="message" <?php echo ($settings->restrictionType == 'message') ? "checked" : ""; ?>>
                    <span class="mdl-radio__label">Custom Message</span>
                </label>

                <label class="mdl-radio mdl-radio-last mdl-js-radio mdl-js-ripple-effect" for="redirectRadio">
                    <input type="radio" id="redirectRadio" class="mdl-radio__button" name="restrictionType"
                        value="redirect" <?php echo ($settings->restrictionType == 'redirect') ? "checked" : ""; ?>>
                    <span class="mdl-radio__label">Redirect</span>
                </label>
            </div>
        </div>

        <h4 class="mdl-card__title-text mdb-title">Restriction Message</h4>

        <label class="mdl-card__supporting-text" style="padding-bottom:0;">Login URL</label>
        <div class="editor_wrapper" style="padding-top:0;">
            <div class="mdl-textfield mdl-js-textfield" style="padding-top:10px;">
                <input class="mdl-textfield__input" value="<?php echo $settings->loginURL; ?>" type="text"
                    pattern="-?(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})?"
                    id="loginURL">
                <label class="mdl-textfield__label" for="loginURL">URL...</label>
                <span class="mdl-textfield__error">Input is not a valid URL!</span>
            </div>
        </div>

        <div class="editor_wrapper">
            <?php wp_editor($settings->restrictionMessage, 'restriction_message', array(
                'textarea_rows' => 4
            )); ?>
        </div>

        <h4 class="mdl-card__title-text mdb-title" style="padding-bottom:0;">Redirect URL</h4>
        <div class="editor_wrapper" style="padding-top:0;">
            <div class="mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input" value="<?php echo $settings->redirectURL; ?>" type="text"
                    pattern="-?(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})?"
                    id="redirectURL">
                <label class="mdl-textfield__label" for="redirectURL">URL...</label>
                <span class="mdl-textfield__error">Input is not a valid URL!</span>
            </div>
        </div>


        <h4 class="mdl-card__title-text mdb-title">Appearance</h4>
        <div class="mdl-view">
            <label class="mdl-card__supporting-text">Color</label>
            <input type="text" id="modalColor" value="<?php echo $settings->modalColor; ?>" class="color_picker"
                data-default-color="#ff0000" />
        </div>

        <div class="mdl-view">
            <label class="mdl-card__supporting-text">Enable Modal Close Button</label>
            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="modalClose">
                <input type="checkbox" id="modalClose" class="mdl-switch__input"
                    <?php echo filter_var($settings->modalClose, FILTER_VALIDATE_BOOLEAN) ? "checked" : ""; ?>>
                <span class="mdl-switch__label"></span>
            </label>
        </div>

        <h4 class="mdl-card__title-text mdb-title">Apply For</h4>
        <div class="checkbox_wrapper" style="padding:14px;">
            <?php
                $post_types = crp_get_post_types( );
                $settings_posttype = $settings->applyFor;
                foreach($post_types as $post_type){
                    $title = str_replace("_", " ", $post_type);
                    $title = ucfirst($title);

                    $checked  = in_array($post_type, $settings_posttype) ? "checked" : "";
                    
                    echo sprintf('<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="applyFor%s">
                        <input type="checkbox" id="applyFor%s" value="%s" class="mdl-checkbox__input" %s>
                        <span class="mdl-checkbox__label">%s</span>
                    </label>', $post_type, $post_type, $post_type, $checked, $title);
                }
            ?>
        </div>


        <div style="text-align:center;padding-top:3rem;padding-bottom:3rem;">
            <button id="updateSettings" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">Update Settings</button>
        </div>

    </div>
</div>


<div id="crp_alert" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action" type="button"></button>
</div>