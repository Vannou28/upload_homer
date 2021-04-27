<?php
use function PHPSTORM_META\type;
// Je vérifie si le formulaire est soumis comme d'habitude
if($_SERVER['REQUEST_METHOD'] === "POST"){ 
    // Securité en php
    // chemin vers un dossier sur le serveur qui va recevoir les fichiers uploadés (attention ce dossier doit être accessible en écriture)
    $uploadDir = 'public/uploads/';
    // le nom de fichier sur le serveur est ici généré à partir du nom de fichier sur le poste du client (mais d'autre stratégies de nommage sont possibles)
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    // Je récupère l'extension du fichier
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    
    // Les extensions autorisées
    $extensions_ok = ['jpg','jpeg','png','webp'];
    // Le poids max géré par PHP par défaut est de 2M
    $maxFileSize = 1048576;
    
    // Je sécurise et effectue mes tests

    /****** Si l'extension est autorisée *************/
    if( (!in_array($extension, $extensions_ok ))){
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png !';
    }

    /****** On vérifie si l'image existe et si le poids est autorisé en octets *************/
    if( file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize)
    {
    $errors[] = "Votre fichier doit faire moins de 1M !";
    }
    
}
?>
<link rel="stylesheet" href="style.css">
<?php if (!empty($errors)){?>
<ul>
    <?php foreach ($errors as $error){?>
        <li class = "messageErreur"><?=$error?></li>
    <?php } ?>
    <ul>
<?php } else{

   move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);?>

    <H1>Licence</H1>
    <section>
        <img class="picture"src='<?=$uploadFile?>'>
                    
        <div class="names">
            <div class="firstname">Homer</div>
            <div class="lastname">Simpson</div>
            <div class="age">43ans</div> 
        </div>                          
    </section>

<?php } ?>

    
