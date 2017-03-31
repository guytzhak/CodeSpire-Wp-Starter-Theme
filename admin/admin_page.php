<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** Create New Post taxonomy **/
if(isset($_POST['tax_name']) && !empty($_POST['tax_name'])) {
    $name = sanitize_text_field($_POST['tax_name']);
}
if(isset($_POST['tax_names']) && !empty($_POST['tax_names'])) {
    $names = sanitize_text_field($_POST['tax_names']);
}
if(isset($_POST['tax_slug']) && !empty($_POST['tax_slug'])) {
    $slug = sanitize_text_field($_POST['tax_slug']);
}
if(isset($_POST['post_type_to_tax']) && !empty($_POST['post_type_to_tax'])) {
    $post_type = sanitize_text_field($_POST['post_type_to_tax']);
}

$option_name = 'cs_taxonomies';
$cs_taxonomies = get_option($option_name);
$array_tax = $cs_taxonomies;

if(isset($_POST['tax_name']) && !empty($_POST['tax_name'])) {
    if(isset($_POST['tax_names']) && !empty($_POST['tax_names'])) {
        if(isset($_POST['tax_slug']) && !empty($_POST['tax_slug'])) {
            if(isset($_POST['post_type_to_tax']) && !empty($_POST['post_type_to_tax'])) {
                $array_tax[$slug] = array(
                    'name' => __( $name, 'cs' ),
                    'names' => __( $names, 'cs' ),
                    'slug' => __( $slug, 'cs' ),
                    'post_type' => $post_type,
                );
            }
        }
    }
}

if ( get_option( $option_name ) !== false ) {
    // The option already exists, so update it.
    update_option($option_name, $array_tax);
 
} else {
 
    // The option hasn't been created yet, so add it with $autoload set to 'no'.
    $deprecated = null;
    $autoload = 'no';
    add_option( $option_name, $array_tax, $deprecated, $autoload );
}

//End Create New Post taxonomy

/** Create New Post type **/
if(isset($_POST['post_type_name']) && !empty($_POST['post_type_name'])) {
    $name = sanitize_text_field($_POST['post_type_name']);
}
if(isset($_POST['post_type_names']) && !empty($_POST['post_type_names'])) {
    $names = sanitize_text_field($_POST['post_type_names']);
}
if(isset($_POST['post_type_slug']) && !empty($_POST['post_type_slug'])) {
    $slug = sanitize_text_field($_POST['post_type_slug']);
}

$option_name = 'cs_post_types';
$cs_post_types = get_option($option_name);
$array = $cs_post_types;

if(isset($_POST['post_type_slug']) && !empty($_POST['post_type_slug'])) {
    if(isset($_POST['post_type_names']) && !empty($_POST['post_type_names'])) {
        if(isset($_POST['post_type_name']) && !empty($_POST['post_type_name'])) {
            $array[$slug] = array(
                'name' => __( $name, 'cs' ),
                'names' => __( $names, 'cs' ),
                'slug' => __( $slug, 'cs' ),
            );
        }
    }
}

if ( get_option( $option_name ) !== false ) {
    // The option already exists, so update it.
    update_option($option_name, $array);
 
} else {
 
    // The option hasn't been created yet, so add it with $autoload set to 'no'.
    $deprecated = null;
    $autoload = 'no';
    add_option( $option_name, $array, $deprecated, $autoload );
}

//End Create New Post Type


?>

<div id="cs_page">
    <h1><?php _e('ברוכים הבאים לניהול התבנית שלך!'); ?></h1>
    <div class="msg first blue">
        <div class="content">
            <p><?php echo esc_html('אנו בחטיבת הפיתוח CodeSpire תחת הסטודיו לעיצוב ומיתוג MoZi שמחים להציג בפניך את האתר החדש שלך! כל ההגדרות שלך מוכנות בהחלט!'); ?></p>
            <p><?php echo esc_html('אם בכל זאת תחליט כי ברצונך לשנות משהו, תוכל לעשות זאת מעמוד זה.'); ?></p>
            <p><?php echo esc_html('אז, התחל בזהיירות ושיהיה בהצלחה! :)'); ?></p>
        </div>
    </div>
    
    <div id="options">
        <div class="create_post_types option">
            <div class="post_types_list">
                <h2><?php echo esc_html('רשימת סוגי פוסטים'); ?></h2>
                <?php 
                $post_types_class = new CodeSpire_Post_Types;
                $post_types_class->cs_add_post_types();
                echo $post_types_class->display_list_post_types();
                ?>
                <h3><?php echo esc_html('הוספת סוג פוסט חדש'); ?></h3>
                <div class="new_item item">
                    <form method="POST">
                    <label for="post_type_name"><?php echo esc_html('הזן שם'); ?></label>
                    <input type="text" value="" id="post_type_name" name="post_type_name" placeholder="הזן שם">
                    <label for="post_type_names"><?php echo esc_html('הזן שם ברבים'); ?></label>
                    <input type="text" value="" id="post_type_names" name="post_type_names" placeholder="הזן שם ברבים">
                    <label for="post_type_slug"><?php echo esc_html('הזן מזהה ייחודי'); ?></label>
                    <input type="text" value="" id="post_type_slug" name="post_type_slug" placeholder="הזן מזהה ייחודי">
                    <span>* מזהה ייחודי באותיות אנגלית קטנות בלבד, ללא רווחים.</span>
                    <input type="submit" value="הוסף!">
                    </form>
                </div>
            </div>
        </div>
        
        <div class="create_taxonomies option">
            <div class="tax_list">
                <h2><?php echo esc_html('רשימת הטקסונומיות שלך'); ?></h2>
                <?php 
                $post_types_class = new CodeSpire_Post_Types;
                echo $post_types_class->display_list_post_types();
                
                ?>
                <h3><?php echo esc_html('הוספת טקסונומיה חדשה'); ?></h3>
                <div class="new_item item">
                    <form method="POST">
                        <div class="form_elm">
                            <label for="tax_name"><?php echo esc_html('הזן שם'); ?></label>
                            <input type="text" value="" id="tax_name" name="tax_name" placeholder="הזן שם">
                        </div>
                        <div class="form_elm">
                            <label for="tax_names"><?php echo esc_html('הזן שם ברבים'); ?></label>
                            <input type="text" value="" id="tax_names" name="tax_names" placeholder="הזן שם ברבים">
                        </div>
                        <div class="form_elm">
                            <label for="tax_slug"><?php echo esc_html('הזן מזהה ייחודי'); ?></label>
                            <input type="text" value="" id="tax_slug" name="tax_slug" placeholder="הזן מזהה ייחודי">
                            <span>* מזהה ייחודי באותיות אנגלית קטנות בלבד, ללא רווחים.</span>
                        </div>
                        <div class="form_elm">
                            <label for="post_type_to_tax"><?php echo esc_html('שיוך לסוגי פוסטים'); ?></label>
                            <?php echo $post_types_class->display_selectlist_post_types(); ?>
                            <span>* שיוך לסוגי פוסטים ספציפים. אחד או יותר.</span>
                        </div>
                        <div class="form_elm">
                            <input type="submit" value="הוסף!">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>