<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post-it Submission</title>
</head>
<body>
    <h1>Ajouter un Post-it</h1>
    
    <form action="process.php" method="POST">
        <label for="nom">Texte du Post-it :</label><br>
        <textarea id="nom" name="nom" rows="4" cols="50" required></textarea><br><br>
        
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>
