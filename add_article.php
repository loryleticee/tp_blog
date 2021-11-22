<?php
session_start();
require_once("../config/config.php");
//CONNEXION BDD
$username = "root";
$password = ""; 
$host = "localhost"; //localhost 
$db = "blog";
$port = "3306";

$option = [
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
];

$dsn = "mysql:host=$host;dbname=$db;charset=utf8;port=$port";

try {
    $connexion = new \PDO($dsn, $username, $password, $option);
} catch (\PDOException $error) {
    $message = $error->getMessage();
    var_dump($message);
    die("Erreur lors de ma connexion PDO");
}

//CONTROLLER
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    
    
    if ($_GET['type'] === "add") {
        if(!isset(
            $_POST['user_id'],
            $_POST['title'],
            $_POST['content'],
            $_POST['categorie'],
            )) {
                header("Location:" . $domaine . "/vues/article/add.php?error=un parametre manque à la requete");
                return;
            }
            
            $isValid = checkAddParams($_POST['user_id'], $_POST['title'],  $_POST['content'], $_POST['categorie']);
            
        }
        
}   

//MODEL

function checkAddParams($user_id, $title, $content, $categorie) {
    global $error;
    $user_id =  htmlspecialchars(strip_tags($user_id));
    $title =  htmlspecialchars(strip_tags($title));
    $content =  htmlspecialchars(strip_tags($content));
    $categorie =  htmlspecialchars(strip_tags($categorie));

    if ( empty($user_id) || empty($title) ||  empty($content) || empty($categorie)) {
        $error["message"] .= "Veuillez remplir tous les champs. Merci ! </br>";
        $error["exist"] = true;

        return $error;
    }

    insertArticle($user_id, $title, $content, $categorie);
}

function insertArticle($user_id, $title, $content, $categorie) {
    global $connexion;
    global $domaine;
    $query = $connexion->prepare("INSERT INTO `article` (`title`, `content`, `user_id`) VALUES (:title, :content, :user_id) ");
    $reponse = $query->execute(['title' => $title, 'content' => $content, 'user_id' => $user_id]);

    if($reponse) {
       header("location: ".$domaine. "/vues/articles/articles.php");
       return;
    } else {
        header("Location:" . $domaine . "/vues/article/add.php?error=une erreur est survenu lors de l'ajout de l'article");
        return;
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('./vues/templates/head.php'); ?>
</head>

<body>
    <?php include_once('./vues/templates/header.php'); ?>
    <main id="main">
        <form action="?type=add" method="POST" id="form-control">
            <input type="hidden" name="user_id" id="user_id" value="<?php if(isset($_SESSION['user']['id'])) { echo $_SESSION['user']['id']; } ?>">
            <div>
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" required />
            </div>
            <div>
                <label for="content">Ici le contenu de l'article </label>
                <textarea name="content" id="content" required></textarea>
            </div>
            <div>
                <select name="categorie" id="categorie">
                    <option value="1">Héros</option>
                    <option value="2">Avengers</option>
                    <option value="3">Méchants</option>
                </select>
            </div>
            <div id="login_button">
                <input type="submit" value="Ajouter l'article" />
            </div>
            <span>
                <small id="error">
                    <?php if (isset($_GET['error'])) {
                        echo $_GET['error'];
                    } ?>
                </small>
            </span>
        </form>
    </main>

</body>

<?php include_once('./vues/templates/footer.php'); ?>

</html>