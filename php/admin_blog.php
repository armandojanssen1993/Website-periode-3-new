<?php

$content = new TemplatePower("template/files/admin_blog.tpl");
$content->prepare();

if(isset($_SESSION['roleid'])) {
    if ($_SESSION['roleid'] == 2) {

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}else{
    $action = NULL;
}




        switch ($action) {
            case "toevoegen":
                if (!empty($_POST['titel'])
                    && !empty($_POST['content'])
                ) // insert
                {

                    $accountid = $_SESSION['accountid'];


                    $insert_blog = $db->prepare("INSERT INTO blog SET
                                                  Title = :titel,
                                                  Content = :content,
                                                  Accounts_idAccounts = :accountid");
                    $insert_blog->bindParam(":titel", $_POST['titel']);
                    $insert_blog->bindParam(":content", $_POST['content']);
                    $insert_blog->bindParam(":accountid", $accountid);

                    $insert_blog->execute();

                    // insert


                    $blogid = $db->lastInsertId();
                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Blog is toegevoegd");


                } else {
                    // formulier
                    $content->newBlock("BLOGFORM");
                    $content->assign("ACTION", "index.php?pageid=3&action=toevoegen");
                    $content->assign("BUTTON", "Toevoegen Blog");
                    $content->assign("USERNAME", $_SESSION['username']);
                }
                break;
            case "wijzigen":

                if (isset($_POST['blogid'])) {
                    $update_blog = $db->prepare("UPDATE blog SET Title = :titel,
                                                      Content = :content
                                                      WHERE idBlog = :idblog");
                    $update_blog->bindParam(":titel", $_POST['titel']);
                    $update_blog->bindParam(":content", $_POST['content']);
                    $update_blog->bindParam(":idblog", $_POST['blogid']);
                    $update_blog->execute();
                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Blog is gewijzigd");

                } else {

                    $get_blog = $db->prepare("SELECT blog.*, accounts.* FROM blog, accounts
                                      WHERE blog.Accounts_idAccounts=accounts.idAccounts
                                      AND idBlog = :blogid");
                    $get_blog->bindParam(":blogid", $_GET['blogid']);
                    $get_blog->execute();

                    $blog = $get_blog->fetch(PDO::FETCH_ASSOC);

                    $content->newBlock("BLOGWIJZIGEN");
                    $content->assign("ACTION", "index.php?pageid=3&action=wijzigen");
                    $content->assign("BUTTON", "Wijzigen Blog");

                    $content->assign(array(
                        "BLOGID" => $blog['idBlog'],
                        "ACCOUNTID" => $blog['idAccounts'],
                        "TITEL" => $blog['Title'],
                        "USERNAME" => $blog['Username'],
                        "CONTENT" => $blog['Content']
                    ));


                }


                break;
            case "verwijderen":


//
//        $get_blog = $db->prepare("DELETE FROM blog
//                                        WHERE idBlog = :blogid");
//        $get_blog->bindParam(":blogid", $_GET['blogid']);
//        $get_blog->execute();
//
                if (isset($_GET['blogid'])) {
                    $check_blog = $db->prepare("SELECT count(*) FROM blog WHERE idBlog = :blogid");
                    $check_blog->bindParam(":blogid", $_GET['blogid']);
                    $check_blog->execute();
                    if ($check_blog->fetchColumn() == 1) {
                        $get_blog = $db->prepare("SELECT blog.*, accounts.* FROM blog, accounts
                                      WHERE blog.Accounts_idAccounts = accounts.idAccounts
                                          AND idBlog = :blogid");
                        $get_blog->bindParam(":blogid", $_GET['blogid']);
                        $get_blog->execute();
                        $blog = $get_blog->fetch(PDO::FETCH_ASSOC);
                        $content->newBlock("BLOGDELETE");
                        $content->assign(array(
                            "ACTION" => "index.php?pageid=3&action=verwijderen",
                            "BLOGID" => $blog['idBlog'],
                            "ACCOUNTID" => $blog['idAccounts'],
                            "TITEL" => $blog['Title'],
                            "USERNAME" => $blog['Username'],
                            "CONTENT" => $blog['Content']
                        ));
                        if (isset($_POST['verwijder'])) {
//                    $content->assign(array(
//                        "ACTION" =>  "index.php?pageid=3&action=verwijderen"));

                        }


                    } else {
                        $errors->newBlock("ERRORS");
                        $errors->assign("ERROR", "Er is iets fout gegaan met het ophalen van een blog");
                    }
                } elseif (isset($_POST['blogid'])) {
                    if (isset($_POST['verwijder'])) {

                        // formulier verstuurd
                        $delete = $db->prepare("DELETE FROM blog WHERE idBlog = :blogid");
                        $delete->bindParam(":blogid", $_POST['blogid']);
                        $delete->execute();

                        $content->newBlock("MELDING");
                        $content->assign("MELDING", "Blog is verwijderd, u wordt nu teruggestuurd naar het tabblad Overzicht");
                    } elseif (isset($_POST['annuleren'])) {
                        $content->newBlock("MELDING");
                        $content->assign("MELDING", "U wordt nu teruggestuurd naar het tabblad Overzicht");
                    } else {
                    }

                } else {
                    $errors->newBlock("ERRORS");
                    $errors->assign("ERROR", "Blog is niet verwijderd");
                }
                break;

            default:

                $content->newBlock("BLOGLIST");
                if (!empty($_POST['search'])) {
                    $get_blog = $db->prepare("SELECT blog.Content,
                                    blog.Title,
                                    blog.idBlog,
                                    accounts.Username
                                  FROM accounts, blog
                                  WHERE blog.Accounts_idAccounts = accounts.idAccounts
                                  AND (blog.Title LIKE :search
                                  OR blog.Content LIKE :search2
                                  OR accounts.Username LIKE :search3)
                                  ");
                    $search = "%" . $_POST['search'] . "%";
                    $get_blog->bindParam(":search", $search);
                    $get_blog->bindParam(":search2", $search);
                    $get_blog->bindParam(":search3", $search);
                    $get_blog->execute();

                    $content->assign("SEARCH", $_POST['search']);
                } else {
                    $get_blog = $db->query("SELECT blog.Content,
                                    blog.Title,
                                    blog.idBlog,
                                    accounts.Username
                                  FROM accounts, blog
                                  WHERE blog.Accounts_idAccounts = accounts.idAccounts");
                }


                while ($blog = $get_blog->fetch(PDO::FETCH_ASSOC)) {
                    $content->newBlock("BLOGROW");
                    $inhoud = $blog['Content'];
                   if(strlen($inhoud) > 30){
                      $inhoud = substr($blog['Content'], 0, 25). "...";
                   }

                    $content->assign(array(
                        "TITEL" => $blog['Title'] = substr($blog['Title'], 0, 30),
                        "GEBRUIKERSNAAM" => $blog['Username'],
                        "CONTENT" => $inhoud,
                        "BLOGID" => $blog['idBlog']
                    ));


                }

        }
    }else{
        $errors->newBlock("ERRORS");
        $errors->assign("ERROR", "Je hebt niet de rechten!");
    }
}
else{
    $errors->newBlock("ERRORS");
    $errors->assign("ERROR", "Je bent niet ingelogd!");
}