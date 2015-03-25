---
title: PHP User Group Limburg and Eindhoven
layout: layout/html
---

<?php foreach ($posts as $post) : ?>
<div class="row-fluid">
  <div class="span12">
    <h2><a href="<?= $post["url"] ?>"><?= $post["title"] ?></a></h2>
    <p><?= $post["html"] ?></p>
  </div>
</div>
<p class="bg-primary">Published on <?= $post["date"] ?></p>
<hr />
<?php endforeach; ?>