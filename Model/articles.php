<?php
require_once 'connexio.php';

function inserirArticle($titol, $cos, $userID){
    global $connexio;
    $preparacio = $connexio->prepare("INSERT INTO articles (Titol, Cos, User_ID) VALUES (:titol, :cos, :userID);");
    $preparacio->execute([':titol' => $titol, ':cos' => $cos, ':userID' => $userID]);
}

function modificarArticle($id, $titol, $cos){
    global $connexio;
    $preparacio = $connexio->prepare("UPDATE articles SET Titol=:titol, Cos=:cos WHERE ID=:id;");
    $preparacio->execute([':id' => $id, ':titol' => $titol, ':cos' => $cos]);
}

function eliminarArticle($id){
    global $connexio;
    $preparacio = $connexio->prepare("DELETE FROM articles WHERE id=:id;");
    $preparacio->execute([':id' => $id]);
}

function consultarArticle($id){
    global $connexio;
    $preparacio = $connexio->prepare("SELECT * FROM articles WHERE id=:id;");
    $preparacio->execute([':id' => $id]);
    return $preparacio->fetchAll();
}

function obtenirArticlesPaginats($offset, $rpp){
    global $connexio;
    $preparacio = $connexio->prepare("SELECT * FROM articles LIMIT :limit OFFSET :offset;");
    $preparacio->bindValue(':limit', $rpp, PDO::PARAM_INT);
    $preparacio->bindValue(':offset', $offset, PDO::PARAM_INT);
    $preparacio->execute();
    return $preparacio->fetchAll();
}

function obtenirArticlesUsuariPaginats($offset, $rpp, $usuariID){
    global $connexio;
    $preparacio = $connexio->prepare("SELECT * FROM articles WHERE User_ID=$usuariID LIMIT :limit OFFSET :offset;");
    $preparacio->bindValue(':limit', $rpp, PDO::PARAM_INT);
    $preparacio->bindValue(':offset', $offset, PDO::PARAM_INT);
    $preparacio->execute();
    $resultat = $preparacio->fetchAll();
    return $resultat;
}

function obtenirTotalArticles(){
    global $connexio;
    return $connexio->query("SELECT COUNT(*) FROM articles")->fetchColumn();
}

function obtenirTotalArticlesUsuari($userID){
    global $connexio;
    return $connexio->query("SELECT COUNT(*) FROM articles WHERE User_ID=$userID")->fetchColumn();
}

function existeixArticle($id){
    global $connexio;
    $preparacio = $connexio->prepare('SELECT * FROM articles WHERE ID=:id;');
    $preparacio->execute([':id' => $id]);
    return $preparacio->fetchAll();
}
