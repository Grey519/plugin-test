<?php $form_results = handle_form_submission(); ?>
<div class="form-wrapper">
    <div class="form-header">
        <h2>Envoyer un message</h2>
    </div>
    <div class="form-body">
        <form method="post">

            <?php form_error($form_results); ?>
            <div class="form-content">
                <div class="form-row">
                    <input type="text" name="msgTitle" placeholder="Titre" required>
                </div>
                <div class="form-row">
                    <textarea name="msgText" placeholder="Texte" required></textarea>
                </div>
            </div>
            <div class="form-actions">
                <input type="submit" name="sendMsg" value="Envoyer">
                <?php wp_nonce_field('message_form_nonce', 'message_form_nonce'); ?>
            </div>
        </form>
    </div>
</div>