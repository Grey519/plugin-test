<?php
function handle_form_submission()
{
    $result = [];
    if (isset($_POST['sendMsg'])) {
        if (!isset($_POST['message_form_nonce']) || !wp_verify_nonce($_POST['message_form_nonce'], 'message_form_nonce')) {
            $result['nonce_error'] = 'Nonce verification failed.';
        } else {
            $msg_title = sanitize_text_field($_POST['msgTitle']);
            $msg_text = sanitize_textarea_field($_POST['msgText']);
            $errors = new WP_Error();
            if (empty($msg_title)) {
                $errors->add('empty_title', 'Champ Titre est vide');
            }
            if (empty($msg_text)) {
                $errors->add('empty_text', 'Champ texte est vide');
            }
            if (msg_existe($msg_title)) {
                $errors->add('title_exist', 'Titre existe');
            }
            if ($errors->has_errors()) {
                $result['form_errors'] = $errors->get_error_messages();
            } else {
                if (add_message($msg_title, $msg_text)) {
                    if (send_msg($msg_title, $msg_text)) {
                        $result['success'] = 'Message sent successfully!';
                    }
                }
            }
        }
    }

    return $result;
}

function add_message($title, $text)
{
    $post_data = [
        'post_title' => $title,
        'post_content' => $text,
        'post_type' => 'message',
        'post_status' => 'publish',
    ];
    $post_id = wp_insert_post($post_data);
    if ($post_id) {
        return $post_id;
    } else {
        return false;
    }
}

function send_msg($msg_title, $msg_text)
{
    $admin_email = get_option('admin_email');
    $sender = get_option('blogname');

    $subject = "Vous avez un nouvel message";

    $message = "Bonjour Admin,";
    $message .= "<br/>";
    $message .= "<br/>";
    $message .= "Titre de message : " . $msg_title . "<br/>";
    $message .= "Text de message : " . $msg_text . "<br/>";
    $message .= "<br/>";
    $message .= "Cordialement Condidat";

    $headers[] = 'MIME-Version: 1.0' . "\r\n";
    $headers[] = 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers[] = "X-Mailer: PHP \r\n";
    $headers[] = 'From: ' . $sender . ' <' . $admin_email . '> ' . "\r\n";

    $mail = wp_mail($admin_email, $subject, $message, $headers);

    return $mail;
}
function msg_existe_old($title)
{
    $post_type = 'message';
    $args = [
        'post_type' => $post_type,
        'post_status' => 'any',
        'posts_per_page' => 1,
        'name' => $title,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        return true;
    } else {
        return false;
    }
}

function msg_existe($title)
{
    $query_args = [
        'post_type' => 'message',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'title' => $title,
        'fields' => 'ids',
    ];
    $query = new WP_Query($query_args);
    $exists = $query->have_posts();
    wp_reset_postdata();

    return $exists;
}

function form_error($form_results)
{
    if (isset($form_results['nonce_error'])) {
        echo '<div class="form-error">' . esc_html($form_results['nonce_error']) . '</div>';
    }
    if (isset($form_results['form_errors'])) {
        echo '<div class="form-error">';
        foreach ($form_results['form_errors'] as $error_message) {
            echo '<p>' . esc_html($error_message) . '</p>';
        }
        echo '</div>';
    }
    if (isset($form_results['success'])) {
        echo '<div class="form-success">' . esc_html($form_results['success']) . '</div>';
    }
}