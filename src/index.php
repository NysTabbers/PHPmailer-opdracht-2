<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <form action="../mailer.php" method="POST">
        <input type="text" class="form-control" id="name" placeholder="Naam" name="naam" required>
        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
        <textarea class="form-control" id="omschrijving" rows="4" placeholder="Omschrijf uw probleem hier..." name="omschrijving" required></textarea>
        <button type="submit" class="btn btn-primary">Verstuur</button>
    </form>
</body>

</html>