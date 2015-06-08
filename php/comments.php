<?php

$content = new TemplatePower("template/files/comment.tpl");
$content->prepare();


//function chose($content){
//
//    if(isset($blogid)){
//        $content->newBlock("1");
//        $content->assign("MELDIGN", "Uw comment is toegevoegd");
//    }elseif(isset($productid)){
//        $content->newBlock("2");
//        $content->assign("MELDIGN", "Uw comment is toegevoegd");
//    }else{
//        $content->newBlock("3");
//    }
//}

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}else{
    $action = NULL;
}

if(isset($_SESSION['roleid'])) {
    if ($_SESSION['roleid']) {



        switch ($action) {

            case "reageer":

                    if (!empty($_POST['comment'])
                    ) // insert
                    {
                        if (isset($_POST['blogid'])) {
                            $productid = NULL;
                            $blogid = $_POST['blogid'];
                        } elseif (isset($_POST['productid'])) {
                            $productid = $_POST['productid'];
                            $blogid = NULL;
                        } else {
                            $content->newBlock("3");
                        }
                        if (isset($_SESSION['accountid'])) {
                            $accountid = $_SESSION['accountid'];
                        } else {
                            $accountid = $_POST['account'];
                        }

                        if (isset($_SESSION['roleid'])) {


                        $insert_comment = $db->prepare("INSERT INTO comments SET
                                                  Text = :comment,
                                                  Accounts_idAccounts = :accountid,
                                                  Blog_idBlog = :blogid,
                                                  Products_idProducts = :productsid");
                        $insert_comment->bindParam(":comment", $_POST['comment']);
                        $insert_comment->bindParam(":accountid", $accountid);
                        $insert_comment->bindParam(":blogid", $blogid);
                        $insert_comment->bindParam(":productsid", $productid);
                        $insert_comment->execute();
                    }
                        if (isset($blogid)) {
                            $content->newBlock("1");
                            $content->assign("MELDING", "Uw comment is toegevoegd");
                            $content->assign("BLOGID", $blogid);
                        } elseif (isset($productid)) {
                            $content->newBlock("2");
                            $content->assign("MELDING", "Uw comment is toegevoegd");
                        } else {
                            $content->newBlock("3");
                        }
                        //chose($content);


                        $blogid = $db->lastInsertId();


                } else {
                        echo "Ja doei";
                    }



                break;

            case "wijzigen":

                if (isset($_POST['commentid'])) {
                    $update_comment = $db->prepare("UPDATE comments SET Text = :text
                                                      WHERE idComments = :commentsid");
                    $update_comment->bindParam(":text", $_POST['comment']);
                    $update_comment->bindParam(":commentsid", $_POST['commentid']);
                    $update_comment->execute();
                    $content->newBlock("MELDING BLOG");
                    $content->assign("MELDING", "Comment is gewijzigd");
                    $content->assign("COMMENTID", $_POST['commentid']);

                } else {

                    $get_comments = $db->prepare("SELECT comments.*, accounts.* FROM comments, accounts
                                      WHERE comments.Accounts_idAccounts=accounts.idAccounts
                                      AND idComments = :commentid");
                    $get_comments->bindParam(":commentid", $_GET['commentid']);
                    $get_comments->execute();

                    $comment = $get_comments->fetch(PDO::FETCH_ASSOC);

                    $content->newBlock("COMMENTWIJZIGEN");
                    $content->assign("ACTION", "index.php?pageid=7&action=wijzigen");
                    $content->assign("BUTTON", "Wijzigen Comment");

                    $content->assign(array(
                        "ACCOUNTID" => $comment['idAccounts'],
                        "COMMENTID" => $comment['idComments'],
                        "COMMENT" => $comment['Text'],
                        "ACCOUNT" => $comment['Username'],
                        "READONLY" => "readonly"
                    ));


                }


                break;
            case "verwijderen":

                if(isset($_GET['commentid']))
                {
                    $check_comment = $db->prepare("SELECT count(*) FROM comments WHERE idComments = :commentid");
                    $check_comment->bindParam(":commentid", $_GET['commentid']);
                    $check_comment->execute();
                    if($check_comment->fetchColumn() == 1){
                        $get_comment = $db->prepare("SELECT comments.*, accounts.*, blog.idBlog FROM comments, accounts, blog
                                      WHERE  comments.Accounts_idAccounts = accounts.idAccounts
                                      AND comments.idComments = :commentid");
                        $get_comment->bindParam(":commentid", $_GET['commentid']);
                        $get_comment->execute();
                        $comment = $get_comment->fetch(PDO::FETCH_ASSOC);
                        $content->newBlock("COMMENTVERWIJDEREN");
                        $content->assign(array(
                            "ACTION" =>  "index.php?pageid=7&action=verwijderen",
                            "BUTTON" => "Verwijderen comment",
                            "COMMENTID" => $comment['idComments'],
                            "ACCOUNT" => $comment['Username'],
                            "COMMENT" => $comment['Text']));
                    }else{
                        $errors->newBlock("ERRORS");
                        $errors->assign("ERROR", "Deze comment bestaat niet. Hoe ben je hier gekomen???");
                    }
                }elseif(isset($_POST['commentid'])){
                    // formulier verstuurd
                    $delete = $db->prepare("DELETE FROM comments WHERE idComments = :commentid");
                    $delete->bindParam(":commentid", $_POST['commentid']);
                    $delete->execute();
                    $content->newBlock("MELDING2");
                        $content->assign("MELDING", "Comment is verwijderd");
                }else{
                    $errors->newBlock("ERRORS");
                    $errors->assign("ERROR", "Deze comment bestaat helemaal niet. Hoe ben je hier gekomen???");
                }

//        $get_comment = $db->prepare("DELETE FROM comments
//                                        WHERE idComments = :commentid");
//        $get_comment->bindParam(":commentid", $_GET['commentid']);
//        $get_comment->execute();

//                if (isset($_GET['commentid'])) {
//                    $check_comment = $db->prepare("SELECT count(*) FROM comments WHERE idComments = :commentid");
//                    $check_comment->bindParam(":commentid", $_GET['commentid']);
//                    $check_comment->execute();
//                    if ($check_comment->fetchColumn() == 1) {
//                        $get_comment = $db->prepare("SELECT comments.*, accounts.Username FROM comments, accounts
//                                      WHERE comments.Accounts_idAccounts = accounts.idAccounts
//                                          AND idComments = :commentid");
//                        $get_comment->bindParam(":commentid", $_GET['commentid']);
//                        $get_comment->execute();
//                        $comment = $get_comment->fetch(PDO::FETCH_ASSOC);
//                        $content->newBlock("COMMENTVERWIJDEREN");
//                        $content->assign("ACTION", "index.php?pageid=7&action=verwijderen");
//                        $content->assign("BUTTON", "Verwijder comment");
//                        $content->assign(array(
//                            "COMMENTID" => $comment['idComments'],
//                            "ACCOUNT" => $comment['Username'],
//                            "COMMENT" => $comment['Text']
//                        ));
//                    }else{
//                        $get_comment = $db->prepare("DELETE FROM comments
//                                        WHERE idComments = :commentid");
//                        $get_comment->bindParam(":commentid", $_GET['commentid']);
//                        $get_comment->execute();
//                    }}
//                        }
//
//
//                    } else {
//                        $errors->newBlock("ERRORS");
//                        $errors->assign("ERROR", "Er is iets fout gegaan met het ophalen van een blog");
//                    }
//                } elseif (isset($_POST['commentid'])) {
//                    if (isset($_POST['verwijder'])) {
//
//                        // formulier verstuurd
//                        $delete = $db->prepare("DELETE FROM comments WHERE idComments = :commentid");
//                        $delete->bindParam(":commentid", $_POST['commentid']);
//                        $delete->execute();
//
//                        $content->newBlock("MELDING2");
//                        $content->assign("MELDING", "comment is verwijderd, u wordt nu teruggestuurd naar het tabblad Overzicht");
//                    } elseif (isset($_POST['annuleren'])) {
//                        $content->newBlock("MELDING2");
//                        $content->assign("MELDING", "U wordt nu teruggestuurd naar het tabblad Overzicht");
//                    } else {
//                    }
//
//                } else {
//                    $errors->newBlock("ERRORS");
//                    $errors->assign("ERROR", "Comment is niet verwijderd");
//                }
                break;



            default:

        }}}