<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in | LavaLust Products</title>
    <style>
        :root { --ink: #18232b; --paper: #f4f0e8; --orange: #e26d3f; --teal: #236b68; --line: #d8cec0; }
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; display: grid; place-items: center; padding: 24px; color: var(--ink); font-family: Georgia, 'Times New Roman', serif; background: radial-gradient(circle at 15% 10%, #f9d5b9, transparent 32%), linear-gradient(135deg, var(--paper), #dce9e1); }
        main { width: min(430px, 100%); padding: 42px; background: rgba(255,255,255,.8); border: 1px solid var(--line); box-shadow: 14px 14px 0 rgba(35,107,104,.13); }
        .eyebrow { margin: 0 0 12px; color: var(--orange); font: 700 .72rem/1.2 Arial, sans-serif; letter-spacing: .18em; text-transform: uppercase; }
        h1 { margin: 0 0 10px; font-size: clamp(2.2rem, 9vw, 3.6rem); line-height: .95; }
        p { color: #52616a; line-height: 1.5; }
        label { display: block; margin: 20px 0 7px; font: 700 .78rem Arial, sans-serif; letter-spacing: .08em; text-transform: uppercase; }
        input { width: 100%; padding: 13px 14px; border: 1px solid var(--line); background: #fffdf8; color: var(--ink); font: 1rem Georgia, serif; }
        button { width: 100%; margin-top: 24px; padding: 14px; border: 0; background: var(--teal); color: white; font: 700 .9rem Arial, sans-serif; letter-spacing: .08em; text-transform: uppercase; cursor: pointer; }
        .error { padding: 11px 13px; border-left: 4px solid var(--orange); background: #fbe4d8; color: #8d321d; }
    </style>
</head>
<body>
    <main>
        <p class="eyebrow">LavaLust / Laboratory 05</p>
        <h1>Welcome back.</h1>
        <p>Sign in to manage the product inventory connected to Aiven MySQL.</p>
        <?php if (!empty($error)): ?><p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
        <form method="post" action="<?= site_url('login') ?>">
            <label for="username">Username</label>
            <input id="username" name="username" required autocomplete="username">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required autocomplete="current-password">
            <button type="submit">Sign in</button>
        </form>
    </main>
</body>
</html>