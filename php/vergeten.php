<?php
include_once('include/function.php');

$content = new TemplatePower("template/files/vergeten.tpl");
$content->prepare();

if(isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = NULL;
}


switch($action){
    case "2":
        $content->newBlock("VERGETENFORM");
        $content->assign("OPTION", $_GET['option']);
        break;
    case "3":
        if(isset($_POST['option'])){
            // welke option hebben we.

            if($_POST['option'] == 1){
                // option 1: sturen we username
                $check_account = $db->prepare("SELECT count(u.idUsers)
                        FROM users u, accounts a WHERE u.Email = :email
                        AND u.idUsers = a.Users_idUsers");
                $check_account->bindParam(":email", $_POST['email']);
                $check_account->execute();

                if($check_account->fetchColumn() == 1) {
                    // gebruiker gevonden
                    $get_account = $db->prepare("SELECT a.*, u.*
                        FROM users u, accounts a WHERE u.Email = :email
                        AND u.idUsers = a.Users_idUsers");
                    $get_account->bindParam(":email", $_POST['email']);
                    $get_account->execute();
                }
                $user = $get_account->fetch(PDO::FETCH_ASSOC);

                $content->newBlock("GET_USER");
                $content->assign("USER", $user['Username']);

            }


            elseif($_POST['option'] == 2){
                // option2 : zetten we een hash in de db


                // account verkrijgen
                $check_account = $db->prepare("SELECT count(u.idUsers)
                        FROM users u, accounts a WHERE u.Email = :email
                        AND u.idUsers = a.Users_idUsers");
                $check_account->bindParam(":email", $_POST['email']);
                $check_account->execute();

                if($check_account->fetchColumn() == 1){
                    // gebruiker gevonden
                    $get_account = $db->prepare("SELECT a.*, u.*
                        FROM users u, accounts a WHERE u.Email = :email
                        AND u.idUsers = a.Users_idUsers");
                    $get_account->bindParam(":email", $_POST['email']);
                    $get_account->execute();

                    $account = $get_account->fetch(PDO::FETCH_ASSOC);

                    $hash = hashgenerator();
                    $insert_hash = $db->prepare("UPDATE accounts
                                SET Reset = :hash
                                WHERE idAccounts = :accountid ");
                    $insert_hash->bindParam(":hash", $hash);
                    $insert_hash->bindParam(":accountid", $account['idAccounts']);
                    $insert_hash->execute();

                    $content->newBlock("RESET_HASH");
                    $content->assign("RESET", $hash);




                }else{
                    // er is geen gebruiker met dat mail adres
                }

                //







                // mail sturen met link


            }elseif($_POST['option'] == 3)
            {




                // account verkrijgen
                $check_account = $db->prepare("SELECT count(u.idUsers)
                        FROM users u, accounts a WHERE u.Email = :email
                        AND u.idUsers = a.Users_idUsers");
                $check_account->bindParam(":email", $_POST['email']);
                $check_account->execute();

                if($check_account->fetchColumn() == 1) {
                    // gebruiker gevonden
                    $get_account = $db->prepare("SELECT a.*, u.*
                        FROM users u, accounts a WHERE u.Email = :email
                        AND u.idUsers = a.Users_idUsers");
                    $get_account->bindParam(":email", $_POST['email']);
                    $get_account->execute();

                    $account = $get_account->fetch(PDO::FETCH_ASSOC);

                    $hash = hashgenerator();
                    $insert_hash = $db->prepare("UPDATE accounts
                                SET Reset = :hash
                                WHERE idAccounts = :accountid ");
                    $insert_hash->bindParam(":hash", $hash);
                    $insert_hash->bindParam(":accountid", $account['idAccounts']);
                    $insert_hash->execute();

                    $content->newBlock("GET_ALL");
                    $content->assign("RESET", $hash);
                    $content->assign("USER", $account['Username']);


                }


                    // option 3: sturen we username
                //             zetten we een hash in de db
                // mail sturen met link
            }else{
                // error
            }



            // mail sturen
        }else{

        }




        break;
    case "4":

        if(isset($_GET['reset'])){
            $check_hash = $db->prepare("SELECT count(Reset) FROM accounts
                                          WHERE Reset = :reset");
            $check_hash->bindParam(":reset", $_GET['reset']);
            $check_hash->execute();

            if($check_hash->fetchColumn() == 1){
                $get_hash = $db->prepare("SELECT * FROM accounts
                                          WHERE Reset = :reset  ");
                $get_hash->bindParam(":reset", $_GET['reset']);
                $get_hash->execute();

                $user = $get_hash->fetch(PDO::FETCH_ASSOC);


               $content->newBlock("RESET_PASSWORD");
                $content->assign("RESET", $user['idAccounts']);

//                $update_wachtwoord
            }
            else{
                echo "error";
            }

        }





//                    $content->newBlock("RESET_PASSWORD");
//                    $content->assign()
//
//                }else{
//                    echo "doei";
//                }

        break;
    case "5":
        $option = [

            'cost' => 12,
        ];
        $password = password_hash($_POST['pass1'], PASSWORD_BCRYPT, $option);


        if(!empty($_POST['pass1']) && !empty($_POST['pass2'])){
            if($_POST['pass1'] == $_POST['pass2']){
               $update_password = $db->prepare("UPDATE accounts SET Reset = NULL, Password = :pass1
                                                  WHERE idAccounts = :idaccounts");
                $update_password->bindParam(":pass1", $password);
                $update_password->bindParam(":idaccounts", $_POST['accountid']);
                $update_password->execute();
            }else{
                echo "FUCK!!!";
            }

        }
        break;
    default:

}


