<?php if( $sf_user->isAuthenticated() ) { ?>

<form id="languageForm" action="<?php echo url_for('change_language') ?>">
  <?php echo $form ?>
  <input type="submit" value="ok" />
</form>

<?php } ?>
