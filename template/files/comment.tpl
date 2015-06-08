<!-- START BLOCK : 1 -->
{MELDING}
<meta http-equiv="refresh" content="2; url=index.php?pageid=6&blogid={BLOGID}" />
<!-- END BLOCK : 1 -->

<!-- START BLOCK : 2 -->
{MELDING}
<meta http-equiv="refresh" content="2; url=index.php?pageid=1" />
<!-- END BLOCK : 2 -->

<!-- START BLOCK : 3 -->
<meta http-equiv="refresh" content="0; url=index.php?pageid=1" />
<!-- END BLOCK : 3-->
<head>
    <link type="text/css" rel="stylesheet" href="template/css/admin_blog.css">
</head>

<div class="jumbotron">
    <h1>Comment Admin</h1>
</div>

<div class="col-sm-12 blog-main">

    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Library</a></li>
        <li class="active">Data</li>
    </ol>
    <div class="blog-post">


        <!-- START BLOCK : MELDING -->

        <div class="alert alert-info" role="alert">
            <p>{MELDING}</p>
        </div>
        <!-- END BLOCK : MELDING -->

        <!-- START BLOCK : MELDING2 -->

        <div class="alert alert-info" role="alert">
            <p>{MELDING}</p>
            <meta http-equiv="refresh" content="2; url=index.php?pageid=6">
        </div>
        <!-- END BLOCK : MELDING2 -->

        <!-- Three columns of text below the carousel -->
<!-- blog -->
<!-- START BLOCK : COMMENTWIJZIGEN -->
<form action="{ACTION}" method="post">
    <div class="naam"> Naam:<div class="innaam"><input type="text" name="account" placeholder="Naam" value="{ACCOUNT}"{READONLY}></div></div>
    <div class="text"> Comment:<div class="intext"><textarea name="comment" placeholder="Plaats je comment hier">{COMMENT}</textarea></div></div>
    <input type="hidden" name="commentid" value="{COMMENTID}">
    <input type="hidden" name="blogid" value="{BLOGID}">
    <button type="submit" class="btn btn-default">{BUTTON}</button>
</form>
<!-- END BLOCK : COMMENTWIJZIGEN -->


        <!-- START BLOCK : COMMENTVERWIJDEREN -->
        <form action="{ACTION}" method="post">
            <div class="naam"> Naam:<div class="innaam"><input type="text" name="account" placeholder="Naam" value="{ACCOUNT}" readonly></div></div>
            <div class="text"> Comment:<div class="intext"><textarea name="comment" placeholder="Plaats je comment hier" readonly>{COMMENT}</textarea></div></div>
            <input type="hidden" name="commentid" value="{COMMENTID}">
            <input type="hidden" name="blogid" value="{BLOGID}">
            <button type="submit" class="btn btn-default" name="verwijder">{BUTTON}</button>
        </form>
        <!-- END BLOCK : COMMENTVERWIJDEREN -->

        <!-- START BLOCK : MELDING BLOG -->
            {MELDING}
        <meta http-equiv="refresh" content="2; url=index.php?pageid=7&action=wijzigen&commentid={COMMENTID}">
        <!-- END BLOCK : MELDING BLOG -->