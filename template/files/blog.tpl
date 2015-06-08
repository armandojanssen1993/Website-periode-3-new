<head>
<link type="text/css" rel="stylesheet" href="template/css/admin_blog.css">
</head>

<div class="jumbotron">
    <h1>Blog</h1>
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

        <!-- Three columns of text below the carousel -->


            <!-- START BLOCK : BLOG -->
            <div id="showblog" class="row">
            <div id="showblog1">
            <div id="showblog2" class="col-lg-16">
                <h2>{TITLE}</h2>
                <div id="showblog3" class="col-lg-16">
                <p>{CONTENT}</p>
                <p><a class="btn btn-default" href="index.php?pageid=6&blogid={BLOGID}" role="button">Lees meer &raquo;</a></p>
                    </div>
                </div>
            </div><!-- /.col-lg-4 -->
            </div>

            <!-- END BLOCK : BLOG -->





        <!-- START BLOCK : DETAILS -->
        <div id="detail" class="col-sm-12 blog-main">

            <div class="blog-post">
                <h2 class="blog-post-title">{TITLE}</h2>
                <p class="blog-post-meta">January 1, 2014 by <a href="#">{USERNAME}</a></p>

                <p>{CONTENT}</p>

                <!-- START BLOCK : COMMENTTOEVOEGEN -->
                <form action="index.php?pageid=7&action=reageer" method="post">
                   <div class="naam"> Naam:<div class="innaam"><input type="text" name="account" placeholder="Naam" value="{ACCOUNT}"readonly></div></div>
                    <br />
                    <label for="editor1" class="col-sm-1 control-label">Comment</label>
                    <div class="col-sm-12"><br>
                        <textarea class="ckeditor"  rows="3" name="comment" id="editor1" placeholder="Plaats je comment hier"></textarea>
                        <br />
                    </div>
                    <input type="hidden" name="blogid" value="{BLOGID}">
                    <input type="submit" class="btn btn-default" name="submit" value="versturen">
                </form>
                <!-- END BLOCK : COMMENTTOEVOEGEN -->


            </div>
            <hr><!-- /.blog-post -->
            <!-- START BLOCK : COMMENT -->
            <div class="well">
            <div><h2>{USER}</h2></div>
            <div>{COMMENT}</div>
                <!-- START BLOCK : ADMIN -->

                <a href="index.php?pageid=7&action=wijzigen&commentid={COMMENTID}">Wijzigen</a> - <a href="index.php?pageid=7&action=verwijderen&commentid={COMMENTID}">Verwijderen</a>

                <!-- END BLOCK : ADMIN -->
            </div>
            <hr>
            <!-- END BLOCK : COMMENT -->


        </div>

        <!-- END BLOCK : DETAILS -->





    </div><!-- /.blog-post -->
</div>


