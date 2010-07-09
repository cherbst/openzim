<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('anlage/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('anlage/index') ?>">Back to list</a>
          &nbsp;<a href="<?php echo url_for('anlage/export?id='.$form->getObject()->getId()) ?>">Export</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'anlage/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
  </table>

<?php echo $form->renderHiddenFields() ?>
<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE INFO') ?></p>
<div class="msg_content">
<table>
    <tbody>
      <?php echo $form['zeit']->renderRow() ?>
      <?php echo $form['ziel']->renderRow() ?>
      <?php echo $form['methode']->renderRow() ?>
      <?php echo $form['rolle_tm']->renderRow() ?>
      <?php echo $form['material']->renderRow() ?>
      <?php echo $form['kofferinfo']->renderRow() ?>
    </tbody>
  </table>
</div></div>

<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE INAHLT') ?></p>
<div class="msg_content">
<table>
    <tbody>
      <?php echo $form['tip']->renderRow() ?>
      <?php echo $form['kurzinhalt']->renderRow() ?>
      <?php echo $form['inhalt']->renderRow() ?>
    </tbody>
  </table>  
</div></div>

<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE BILDER') ?></p>
<div class="msg_content">
<table>
    <tbody>
      <?php foreach ($form['Bilder'] as $bild): ?>
          <?php echo $bild['path']->renderRow(array('width' => 100)) ?>
          <?php echo $bild['caption']->renderRow() ?>
      <?php endforeach; ?>
      <?php foreach ($form['neueBilder'] as $bild): ?>
          <?php echo $bild['path']->renderRow() ?>
          <?php echo $bild['caption']->renderRow() ?>
      <?php endforeach; ?>
    </tbody>
  </table>  
</div></div>

<div class="msg_list">
<p class="msg_head"><?php echo __('ANLAGE ANHÄNGE') ?></p>
<div class="msg_content">
  <table>
    <tbody>
      <?php foreach ($form['Anhaenge'] as $anhang): ?>
          <?php echo $anhang['path']->renderRow(array('width' => 100)) ?>
      <?php endforeach; ?>
      <?php echo $form['neuerAnhang']['path']->renderRow() ?>
    </tbody>
  </table>  
</div></div>

<table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('anlage/index') ?>">Back to list</a>
          &nbsp;<a href="<?php echo url_for('anlage/export?id='.$form->getObject()->getId()) ?>">Export</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'anlage/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
</table>

</form>
