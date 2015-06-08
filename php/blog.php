<?php
$content = new TemplatePower("template/files/blog.tpl");
$content->prepare();

if(isset($_GET['blogid'])){
    // controleren of alles er is
    $content->newBlock("DETAILS");
    $check_blog = $db->prepare("SELECT count(*) FROM blog
                                    WHERE idBlog = :blogid");
    $check_blog->bindParam(":blogid", $_GET['blogid']);
    $check_blog->execute();

    if($check_blog->fetchColumn() == 1){

        $get_blog = $db->prepare("SELECT b.*, a.Username FROM blog b, accounts a
                                    WHERE b.idBlog = :blogid
                                    AND b.Accounts_idAccounts = a.idAccounts");
        $get_blog->bindParam(":blogid", $_GET['blogid']);
        $get_blog->execute();
        $blog = $get_blog->fetch(PDO::FETCH_ASSOC);

        if(isset($_SESSION['username'])){
            $user = $_SESSION['username'];
        }else{
            $user = NULL;
        }



        $content->assign(array("TITLE" => $blog['Title'],
            "CONTENT" => $blog['Content'],
            "USERNAME" => $blog['Username'],
            "BLOGID" => $blog['idBlog']));

        if(isset($_SESSION['roleid'])){
            $content->newBlock("COMMENTTOEVOEGEN");
            $content->assign("ACCOUNT", $user);
            $content->assign("BLOGID", $blog['idBlog']);
        }

        $check_comment = $db->prepare("SELECT count(*) FROM comments
                                        WHERE Blog_idBlog = :blogid");
        $check_comment->bindParam(":blogid", $_GET['blogid']);
        $check_comment->execute();

        if($check_comment->fetchColumn() > 0){
            $get_comment = $db->prepare("SELECT comments.*, accounts.Username FROM comments, accounts
                                          WHERE Blog_idBlog = :blogid
                                          AND comments.Accounts_idAccounts = accounts.idAccounts");
            $get_comment->bindParam(":blogid", $_GET['blogid']);
            $get_comment->execute();

            while($comment = $get_comment->fetch(PDO::FETCH_ASSOC)) {
                $content->newBlock("COMMENT");
                $content->assign(array("USER" => $comment['Username'],
                    "COMMENT" => $comment['Text']));
                if(isset($_SESSION['roleid'])){
                    $role = $_SESSION['roleid'];
                }
                else{
                    $role = NULL;
                }
                if($role == 2) {
                    $content->newBlock("ADMIN");
                    $content->assign("COMMENTID", $comment['idComments']);
                }
                }

        }
    }else{
        // error
    }

}else{
    $check_blog = $db->query("SELECT count(*) FROM blog");
    if($check_blog->fetchColumn() > 0 ){
        $get_blog = $db->query("SELECT * FROM blog");
        $teller = 0;
        while($blog = $get_blog->fetch(PDO::FETCH_ASSOC)){

            // block van een element oproepen
            $inhoud = $blog['Content'];
            if(strlen($inhoud) > 500){
                $inhoud = substr($blog['Content'], 0, 500). "...";
            }


            $content->newBlock("BLOG");
            $content->assign(array("TITLE" => $blog['Title'],
                "CONTENT" => $inhoud,
                "BLOGID" => $blog['idBlog']));

        }
    }else{
        // geen projecten gevonden
    }
}

