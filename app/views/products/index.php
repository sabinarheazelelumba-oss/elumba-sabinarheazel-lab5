<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products | LavaLust</title>
    <style>
        :root { --ink: #18232b; --paper: #f4f0e8; --orange: #e26d3f; --teal: #236b68; --line: #d8cec0; --muted: #68757a; }
        * { box-sizing: border-box; } body { margin: 0; min-height: 100vh; padding: 44px 22px; color: var(--ink); font-family: Arial, sans-serif; background: radial-gradient(circle at 90% 0, #f8d7bc, transparent 30%), var(--paper); }
        main { width: min(1120px, 100%); margin: auto; } header { display: flex; align-items: end; justify-content: space-between; gap: 22px; margin-bottom: 30px; } .eyebrow { margin: 0 0 10px; color: var(--orange); font-size: .72rem; font-weight: bold; letter-spacing: .18em; text-transform: uppercase; } h1 { margin: 0; font: 700 clamp(2.4rem, 7vw, 5rem)/.9 Georgia, serif; } .intro { max-width: 300px; margin: 0; color: var(--muted); line-height: 1.5; }
        .actions { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; } a, button { display: inline-block; padding: 11px 15px; border: 0; color: white; background: var(--teal); font-weight: bold; text-decoration: none; cursor: pointer; } .secondary { color: var(--ink); background: transparent; border: 1px solid var(--line); } .logout { margin-left: auto; }
        .table-wrap { overflow-x: auto; border: 1px solid var(--line); background: rgba(255,255,255,.65); } table { width: 100%; min-width: 720px; border-collapse: collapse; } th, td { padding: 17px 18px; border-bottom: 1px solid var(--line); text-align: left; } th { color: var(--muted); font-size: .7rem; letter-spacing: .12em; text-transform: uppercase; } td { font-size: .95rem; } td:first-child, td:nth-child(4) { font-weight: bold; } td:first-child { color: var(--orange); } .description { max-width: 320px; color: var(--muted); } .row-actions { display: flex; gap: 8px; align-items: center; } .row-actions form { margin: 0; } .delete { padding: 9px 11px; background: var(--orange); } .empty { padding: 40px; color: var(--muted); text-align: center; }
        @media (max-width: 650px) { body { padding: 28px 14px; } header { align-items: start; flex-direction: column; } .intro { max-width: none; } .actions { flex-wrap: wrap; } .logout { margin-left: 0; } }
    </style>
</head>
<body>
<main>
    <header><div><p class="eyebrow">LavaLust / Inventory</p><h1>Products</h1></div><p class="intro">Authenticated product management backed by Aiven MySQL.</p></header>
    <div class="actions"><a href="<?= site_url('products/create') ?>">Add product</a><form class="logout" method="post" action="<?= site_url('logout') ?>"><button class="secondary" type="submit">Sign out</button></form></div>
    <div class="table-wrap"><table><thead><tr><th>ID</th><th>Product</th><th>Description</th><th>Price</th><th>Quantity</th><th>Created</th><th>Actions</th></tr></thead><tbody>
    <?php if (!empty($products)): foreach ($products as $product): ?><tr>
        <td><?= (int) $product['id'] ?></td><td><?= htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8') ?></td><td class="description"><?= htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8') ?></td><td><?= number_format((float) $product['price'], 2) ?></td><td><?= (int) $product['quantity'] ?></td><td><?= htmlspecialchars($product['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
        <td><div class="row-actions"><a class="secondary" href="<?= site_url('products/edit/' . (int) $product['id']) ?>">Edit</a><form method="post" action="<?= site_url('products/delete/' . (int) $product['id']) ?>" onsubmit="return confirm('Delete this product?');"><button class="delete" type="submit">Delete</button></form></div></td>
    </tr><?php endforeach; else: ?><tr><td class="empty" colspan="7">No products yet. Add the first product to begin.</td></tr><?php endif; ?></tbody></table></div>
</main>
</body>
</html>