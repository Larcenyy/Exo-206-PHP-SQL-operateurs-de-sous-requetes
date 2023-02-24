<?php

class DbPDO
{
    private static string $server = 'localhost';
    private static string $username = 'root';
    private static string $password = '';
    private static string $database = 'live_sql';
    private static ?PDO $db = null;

    public static function connect(): ?PDO {
        if (self::$db == null){
            try {
                self::$db = new PDO("mysql:host=".self::$server.";dbname=".self::$database, self::$username, self::$password);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Erreur de la connexion à la dn : " . $e->getMessage();
                die();
            }
        }
        return self::$db;

    }

    public static function oneExo(): void
    {
        $req = self::$db->prepare('SELECT * FROM user');
        $check = $req->execute();
        if ($check){
            foreach ($req as $item){
                echo $item['username'] . "<br>";
                echo "<hr>";
            }
        }
    }
    public static function twoExo(): void
    {
        $req = self::$db->prepare('SELECT * FROM article');
        $check = $req->execute();
        if ($check){
            foreach ($req as $item){
                echo $item['titre'] . "<br>";
            }
        }
    }
    public static function threeExo(): void
    {
        $req = self::$db->prepare("SELECT username FROM user
        WHERE id = ANY (SELECT user_fk FROM article WHERE contenu LIKE '%poterie')");

        $check = $req->execute();
        if ($check){
            foreach ($req->fetchAll() as $item){
                echo $item["username"] . " parle de poterie dans un article<br>";
            }
        }
        else{
            echo "problème";
        }
    }

    public static function fourExo(): void
    {
        $req = self::$db->prepare('SELECT * FROM user
        WHERE EXISTS(SELECT * FROM article WHERE article.user_fk = user.id)');
        $check = $req->execute();
        if ($check){
            echo "<pre>";
            print_r($req->fetchAll());
            echo "</pre>";
        }
    }
    public static function fiveExo(): void
    {
        $req = self::$db->prepare('SELECT * FROM user
        WHERE EXISTS(SELECT * FROM article WHERE article.user_fk = :id)');
        $id = 6;
        $req->bindParam(":id", $id);
        $check = $req->execute();
        if ($check){
            echo "<pre>";
            print_r($req->fetchAll());
            echo "</pre>";
        }
    }
}