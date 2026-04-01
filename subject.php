<?php
require __DIR__ . '/data.php';

$category = isset($_GET['category']) ? trim((string) $_GET['category']) : '';
$subject = isset($_GET['subject']) ? trim((string) $_GET['subject']) : '';

$categoryExists = array_key_exists($category, $fields);
$subjectExists = $categoryExists && in_array($subject, $fields[$category], true);
$validPage = $categoryExists && $subjectExists;

$subjectsInCategory = $validPage ? $fields[$category] : [];
$subjectIndex = $validPage ? array_search($subject, $subjectsInCategory, true) : false;
$prevSubject = ($validPage && $subjectIndex > 0) ? $subjectsInCategory[$subjectIndex - 1] : null;
$nextSubject = ($validPage && $subjectIndex < count($subjectsInCategory) - 1) ? $subjectsInCategory[$subjectIndex + 1] : null;

function subjectUrl(string $category, string $subject): string
{
    return 'subject.php?' . http_build_query([
        'category' => $category,
        'subject' => $subject,
    ]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $validPage ? htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') : 'Subject not found' ?> | Study Fields</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="hero">
    <h1><?= $validPage ? htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') : 'Subject not found' ?></h1>
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="index.php">Home</a>
        <?php if ($validPage): ?>
            <span>›</span>
            <span><?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?></span>
            <span>›</span>
            <span><?= htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') ?></span>
        <?php endif; ?>
    </nav>
</header>

<main class="subject-layout">
    <?php if ($validPage): ?>
        <article class="card subject-card">
            <h2>About this subject</h2>
            <p>
                <strong><?= htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') ?></strong>
                is listed under the
                <strong><?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?></strong>
                category.
            </p>
            <p>Use the navigation below to move through subjects in this category.</p>

            <div class="subject-nav">
                <?php if ($prevSubject !== null): ?>
                    <a class="btn" href="<?= htmlspecialchars(subjectUrl($category, $prevSubject), ENT_QUOTES, 'UTF-8') ?>">← <?= htmlspecialchars($prevSubject, ENT_QUOTES, 'UTF-8') ?></a>
                <?php else: ?>
                    <span class="btn disabled">← Start of category</span>
                <?php endif; ?>

                <?php if ($nextSubject !== null): ?>
                    <a class="btn" href="<?= htmlspecialchars(subjectUrl($category, $nextSubject), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($nextSubject, ENT_QUOTES, 'UTF-8') ?> →</a>
                <?php else: ?>
                    <span class="btn disabled">End of category →</span>
                <?php endif; ?>
            </div>
        </article>

        <aside class="card list-card">
            <h3><?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?> subjects</h3>
            <ul>
                <?php foreach ($subjectsInCategory as $categorySubject): ?>
                    <li>
                        <?php if ($categorySubject === $subject): ?>
                            <span class="current-subject"><?= htmlspecialchars($categorySubject, ENT_QUOTES, 'UTF-8') ?></span>
                        <?php else: ?>
                            <a class="subject-link" href="<?= htmlspecialchars(subjectUrl($category, $categorySubject), ENT_QUOTES, 'UTF-8') ?>">
                                <?= htmlspecialchars($categorySubject, ENT_QUOTES, 'UTF-8') ?>
                            </a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>
    <?php else: ?>
        <article class="card subject-card">
            <h2>Invalid subject link</h2>
            <p>The requested subject or category was not found. Please return to the main directory and select a valid subject.</p>
            <a class="btn" href="index.php">Back to all categories</a>
        </article>
    <?php endif; ?>
</main>
</body>
</html>
