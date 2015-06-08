<?php
$content = new TemplatePower("template/files/login.tpl");
$content->prepare();

$content->newBlock("LOGINFORM");


if(isset($_SESSION['accountid'])){
    // is al ingelogd, dus niks doen
    $content->newBlock("MELDING");
    $content->assign("MELDING", "Je bent al ingelogd");
}else {
    if (!empty($_POST['gnaam']) AND !empty($_POST['password'])) {
        // formulier is verstuurd

        $get_pw = $db->prepare("SELECT Password FROM accounts
                            WHERE Username = :user");
        $get_pw->bindParam(":user", $_POST['gnaam']);
        $get_pw->execute();

        $hash = $get_pw->fetch(PDO::FETCH_ASSOC);

        $check_user = $db->prepare("SELECT count(*) FROM accounts a, users u
                                    WHERE a.Users_idUsers = u.idUsers
                                    AND a.Username = :username
                                    AND a.Password = :password");
        $check_user->bindParam(":username", $_POST['gnaam']);

        $password = $hash['Password'];
        if (password_verify($_POST['password'], $password)) {
            $check_user->bindParam(":password", $password);
            $check_user->execute();

//        $password = sha1($_POST['password']);
//        $check_user->bindParam(":password", $password);
//        $check_user->execute();
            if ($check_user->fetchColumn() == 1) {
                // gebruiker gevonden
                $get_user = $db->prepare("SELECT a.*, u.* FROM accounts a, users u
                                    WHERE a.Users_idUsers = u.idUsers
                                    AND a.Username = :username
                                    AND a.Password = :password");
                $get_user->bindParam(":username", $_POST['gnaam']);
                $get_user->bindParam(":password", $password);
                $get_user->execute();

                $user = $get_user->fetch(PDO::FETCH_ASSOC);
                $_SESSION['accountid'] = $user['idAccounts'];
                $_SESSION['username'] = $user['Username'];
                $_SESSION['roleid'] = $user['Role_idRole'];
                $content->newBlock("MELDING");
                $content->assign("MELDING", "Je bent ingelogd");
            }
        } else {
            // formulier niet verstuurd. Form laten zien
            $errors->newBlock("ERRORS");
            $errors->assign("ERROR", "Combinatie username + password klopt niet");
            $content->newBlock("LOGINFORM");
            $content->assign("USERNAME", $_POST['gnaam']);
        }
    }



}