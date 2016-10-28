<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">

<?php foreach ($css_files ?? [] as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>

<title>tank_auth / groceryCRUD サンプルコード</title>
</head>

<body>

<?= $content ?>

<?php foreach ($js_files ?? [] as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
</body>
</html>
