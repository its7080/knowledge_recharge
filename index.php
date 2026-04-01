<?php
require __DIR__ . '/data.php';

$totalSubjects = 0;
foreach ($fields as $subjects) {
    $totalSubjects += count($subjects);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Study Fields Directory</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="hero">
    <h1>All Major Study Fields</h1>
    <p>Browse every category and open a dedicated page for each subject.</p>
    <p class="meta">Categories: <?= count($fields) ?> | Subjects: <?= $totalSubjects ?></p>
</header>

<main class="container">
    <?php foreach ($fields as $category => $subjects): ?>
        <section class="card" id="<?= rawurlencode($category) ?>">
            <h2><?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?></h2>
            <p class="count"><?= count($subjects) ?> subjects</p>
            <ul>
                <?php foreach ($subjects as $subject): ?>
                    <?php
                    $query = http_build_query([
                        'category' => $category,
                        'subject' => $subject,
                    ]);
                    ?>
                    <li>
                        <a class="subject-link" href="subject.php?<?= htmlspecialchars($query, ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    <?php endforeach; ?>
</main>
</body>
</html>
