<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nest PHP Framework</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        h1.greet {
            text-transform: capitalize;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <input type="text" name="name">
        <input type="text" name="csrf_token" value="<?php echo e(csrf_token()); ?>">
        <button>Greet!</button>
    </form>

    <?php if(isset($name)): ?>
        <h1 class="greet">Hello <?php echo e($name); ?>!</h1>
    <?php endif; ?>
</body>

</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/framework/resources/views/index.blade.php ENDPATH**/ ?>