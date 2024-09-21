<?php
/*
Template Name: Contacts
*/
?>

<?php get_header(); ?>

<main class="contacts">
    <div class="container">
        <h1 class="contacts__h1 h1">
            Контакти
        </h1>
        <div class="contacts__info">
            <?php 
              $contacts_pod = pods('contacts');
              if ($contacts_pod->exists()) {
                $email = $contacts_pod->field('email');
                $phone = $contacts_pod->field('phone');
              }
            ?>
            <p><strong>Телефон:</strong> <?php echo esc_html($phone) ?></p>
            <p><strong>Email:</strong> <?php echo esc_html($email) ?></p>
        </div>
    </div>
</main>

<?php get_footer(); ?>