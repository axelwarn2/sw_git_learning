<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Синхронизация данных</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <div class="main">
        <form action="../services/SyncService.php" method="POST" class="form">
            <div>
                <label for="apikey">Введите ключ API:</label>
                <input type="text" name="apikey" id="apikey" class="input apikey">
            </div>

            <div>
                <label for="crmurl">Введите url к API:</label>
                <input type="text" name="crmurl" id="crmurl" class="input crmurl">
            </div>

            <button type="submit" class="form__submit">Синхронизировать</button>
        </form>
    </div>
</body>
</html>