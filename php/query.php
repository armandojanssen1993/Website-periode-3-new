<?php
                                                  include('query.php');


                $blog = selectQuery($db, $blog, $comments, $_GET['blogid']);
                                                  include('query.php');


                $blog = selectQuery($db, $blog, $comments, $_GET['blogid']);
                                                  include('query.php');


                $blog = selectQuery($db, $blog, $comments, $_GET['blogid']);
                                                  include('query.php');


                $blog = selectQuery($db, $blog, $comments, $_GET['blogid']);


/*
  SELECT blog.*, accounts.* FROM blog, accounts
                                      WHERE blog.Accounts_idAccounts=accounts.idAccounts
                                      AND idBlog = :blogid
*/
function selectQuery($db, $tabellen, $param)
{
    $selq = "SELECT ";

    $s = "";
    foreach ($tabellen as $arr) {
        $s = $s . ($arr .".* ,");
    }

    $selq .= rtrim($s, ',');

    $selq .= " FROM";
    echo "--> " . $selq . " <--" ;

    $t = "";
    foreach ($tabellen as $tab) {
            $t .= $tab;
    }


    /*
    $selq .= "FROM";

     foreach ($tabellen as $arr) {
         $selq = $selq . ($arr . ",");
     }

    //where vergelijking


    $getResults = $db->prepare($selq);
    $getResults->bindParam(":param", $param);
    $getResults->execute();

    $results = $getResults->fetch(PDO::FETCH_ASSOC);

    return results;

    */
}