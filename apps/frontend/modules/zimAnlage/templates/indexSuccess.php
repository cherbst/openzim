<p>
<div class="search">
        <h2>Anlage Suchen/Filtern:</h2>
        <form action="<?php echo url_for('anlage_search') ?>" method="get">
                <input type="text" name="query" value="<?php echo $sf_request->getParameter('query') ?>" id="search_keywords" />
                <input type="submit" value="GO" />
                <img id="loader" src="/images/loader.gif" style="vertical-align: middle; display: none" />
                <div class="help">
                        Suche nach Keywords (Name, Ziel, Inhalt, ...)
                </div>
        </form>
</div>
</p>

<h1>ZIM Anlagen</h1>

<table id="zimAnlagen">
  <thead>
    <tr>
      <th>Name</th>
      <th>Ziel</th>
      <th>Inhalt</th>
    </tr>
  </thead>
  <tbody>

  <?php foreach ($zim_anlages as $i => $anlage): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
      <td class="name">
	<?php echo link_to($anlage->getName(), 'zimAnlage/show?id='.$anlage->getId(), $anlage) ?>
      </td>
      <td class="ziel">
        <?php echo $anlage->getInhalt() ?>
      </td>
      <td class="inhalt">
        <?php echo $anlage->getInhalt() ?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<a href="<?php echo url_for('zimAnlage/new') ?>">New</a>

