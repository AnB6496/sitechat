
<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=chat', 'root', '');
if(isset($_POST['pseudo']) AND isset($_POST['message']) AND !empty($_POST['pseudo']) 
AND !empty($_POST['message'])) 
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $message = htmlspecialchars($_POST['message']);
    $insertmsg = $bdd->prepare('INSERT INTO chat(pseudo, message) VALUES(?, ?)'); 
    $insertmsg->execute(array($pseudo, $message));
}
else{
    echo '<script>alert("Veuillez entrer un pseudo ou un message")</script>';
}

?>
<html>
    <head>
        <title>Chat de Matthias</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <form method="post" action=""> 
            <input type="text" name="pseudo" placeholder="PSEUDO" />
            <br/>
            <br/>
            <textarea
             type="text" name="message" placeholder="MESSAGE" width="200" height="200"></textarea><br/>
            <input type="submit" value="Envoyer" /><br/>
            <?php 
            $allmsg = $bdd->query('SELECT * FROM chat ORDER BY id DESC');
            
            while($msg = $allmsg->fetch())
            {
            ?>
            <b><?php echo $msg['pseudo'] ?>: </b> <code><?php echo $msg['message'] ?></code> <br />
            <?php 
            }
            ?>
        </form>  
    </body>
</html>