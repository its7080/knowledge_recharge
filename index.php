<?php
$topics = [
    [
        'title' => 'PHP Syntax',
        'description' => 'Every PHP statement ends with a semicolon.',
        'code' => "<?php\necho 'Hello W3 Learner!';\n?>"
    ],
    [
        'title' => 'Variables',
        'description' => 'Variables in PHP start with a $ sign.',
        'code' => "<?php\n$name = 'Student';\necho \"Welcome $name\";\n?>"
    ],
    [
        'title' => 'If Else',
        'description' => 'Control flow lets you run different blocks.',
        'code' => "<?php\n$score = 80;\nif ($score >= 50) {\n    echo 'Pass';\n} else {\n    echo 'Fail';\n}\n?>"
    ],
    [
        'title' => 'Loops',
        'description' => 'Use loops to repeat actions.',
        'code' => "<?php\nfor ($i = 1; $i <= 3; $i++) {\n    echo $i . '<br>';\n}\n?>"
    ],
];

$submittedName = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submittedName = trim($_POST['name'] ?? '');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Learning Project</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="hero">
        <h1>Learn PHP (Raw Project)</h1>
        <p>A simple W3Schools-style PHP starter project with examples.</p>
    </header>

    <main class="container">
        <section class="card">
            <h2>Try a Simple Form</h2>
            <form method="post" action="">
                <label for="name">Your Name</label>
                <input id="name" name="name" type="text" placeholder="Enter your name" required>
                <button type="submit">Submit</button>
            </form>

            <?php if ($submittedName !== null): ?>
                <p class="result">
                    Hello, <strong><?= htmlspecialchars($submittedName, ENT_QUOTES, 'UTF-8') ?></strong>!
                    Nice to meet you.
                </p>
            <?php endif; ?>
        </section>

        <section class="card">
            <h2>PHP Basics</h2>
            <?php foreach ($topics as $topic): ?>
                <article class="topic">
                    <h3><?= htmlspecialchars($topic['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p><?= htmlspecialchars($topic['description'], ENT_QUOTES, 'UTF-8') ?></p>
                    <pre><code><?= htmlspecialchars($topic['code'], ENT_QUOTES, 'UTF-8') ?></code></pre>
                </article>
            <?php endforeach; ?>
        </section>
    </main>
</body>
</html>
