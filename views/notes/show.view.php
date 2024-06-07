<?php require base_path("views/partials/header.php"); ?>

<?php require base_path("views/partials/nav.php"); ?>

<?php require base_path("views/partials/banner.php"); ?>

<main>
  <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <p><?= htmlspecialchars($note['body']) ?></p>
    <br>
    <a href="/notes" class='underline' style="background-color: #909090; padding:5px; border:2px solid black; border-radius: 7px">go back</a>
  </div>
</main>

<?php require base_path("views/partials/footer.php"); ?>

