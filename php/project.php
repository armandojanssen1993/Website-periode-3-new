<?php
$content = new TemplatePower("template/files/project.tpl");
$content->prepare();
if(isset($_GET['projectid'])){
    // controleren of alles er is
    $content->newBlock("DETAILS");
    $check_project = $db->prepare("SELECT count(*) FROM products
                                    WHERE idProducts = :projectid");
    $check_project->bindParam(":projectid", $_GET['projectid']);
    $check_project->execute();
    if($check_project->fetchColumn() == 1){
        $get_project = $db->prepare("SELECT p.*, a.Username FROM products p, accounts a
                                    WHERE p.idProducts = :projectid
                                    AND p.Accounts_idAccounts = a.idAccounts");
        $get_project->bindParam(":projectid", $_GET['projectid']);
        $get_project->execute();
        $project = $get_project->fetch(PDO::FETCH_ASSOC);
        $content->assign(array("TITLE" => $project['Title'],
            "CONTENT" => $project['Content'],
            "USERNAME" => $project['Username']));
        if(isset($_SESSION['accountid'])){
            $content->newBlock("COMMENTFORM");
            $content->assign("PROJECTID", $project['idProducts']);
            if (!empty($_POST['comment'])) {
                // heb comment ingevuld
                $insert_comment = $db->prepare("INSERT INTO comments SET
                        Text = :comment ,
                        Accounts_idAccounts = :accountid,
                        Products_idProducts = :lullo");
                $insert_comment->bindParam(":comment", $_POST['comment']);
                $insert_comment->bindParam(":accountid", $_SESSION['accountid']);
                $insert_comment->bindParam(":lullo", $_POST['projectid']);
                $insert_comment->execute();
                $content->newBlock("MELDING");
                $content->assign("MELDING", "Comment toegevoegd");
            }
        }
        // comments ophalen
        $check_comments = $db->prepare("SELECT count(*) FROM comments
                                      WHERE Products_idProducts = :projectid");
        $check_comments->bindParam(":projectid", $_GET['projectid']);
        $check_comments->execute();
        if($check_comments->fetchColumn() > 0){
            // ik heb comments !!!!!!
            $get_comments = $db->prepare("SELECT comments.*, accounts.Username
                                          FROM comments, accounts
                                          WHERE comments.Products_idProducts = :projectid
                                          AND comments.Accounts_idAccounts = accounts.idAccounts");
            $get_comments->bindParam(":projectid", $_GET['projectid']);
            $get_comments->execute();
            while($comments = $get_comments->fetch(PDO::FETCH_ASSOC)){
                $content->newBlock("COMMENT");
                $content->assign(array("USERNAME" => $comments['Username'],
                    "COMMENT" => $comments['Text']));
            }
        }
    }else{
        // error
    }
}else{
    $check_projects = $db->query("SELECT count(*) FROM products");
    if($check_projects->fetchColumn() > 0 ){
        $get_projects = $db->query("SELECT * FROM products");
        $teller = 0;
        while($projects = $get_projects->fetch(PDO::FETCH_ASSOC)){
            $teller++;
            if($teller % 3 == 1){
                // div openen
                $content->newBlock("BEGIN");
            }
            // block van een element oproepen
            $projectcontent = substr($projects['Content'], 0, 150)." ...";
            $content->newBlock("PROJECT");
            $content->assign(array("TITLE" => $projects['Title'],
                "CONTENT" => $projectcontent,
                "PROJECTID" => $projects['idProducts']));
            if($teller % 3 == 0){
                // div sluiten
                $content->newBlock("END");
            }
        }
    }else{
        // geen projecten gevonden
    }
}
