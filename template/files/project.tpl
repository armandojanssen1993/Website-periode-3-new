
<div class="jumbotron">
    <h1>Projecten</h1>
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
        <!-- START BLOCK : BEGIN -->
        <div class="row">
            <!-- END BLOCK : BEGIN -->

            <!-- START BLOCK : PROJECT -->
            <div class="col-lg-4">
                <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
                <h2>{TITLE}</h2>
                <p>{CONTENT}</p>
                <p><a class="btn btn-default" href="index.php?pageid=9&projectid={PROJECTID}" role="button">View details &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <!-- END BLOCK : PROJECT -->

            <!-- START BLOCK : END -->
        </div><!-- /.row -->
        <!-- END BLOCK : END -->



        <!-- START BLOCK : DETAILS -->
        <div class="col-sm-12 blog-main">

            <div class="blog-post">
                <h2 class="blog-post-title">{TITLE}</h2>
                <p class="blog-post-meta">January 1, 2014 by <a href="#">{USERNAME}</a></p>

                <p>{CONTENT}</p>
                <hr>

                <!-- START BLOCK : COMMENT -->
                <div class="well">
                    <small>Posted By <strong>{USERNAME}</strong></small>
                    <p>{COMMENT}</p>
                </div>

                <!-- END BLOCK : COMMENT -->

                <!-- START BLOCK : COMMENTFORM -->
                <form class="form-horizontal" action="index.php?pageid=7&projectid={PROJECTID}" method="post">
                    <div class="form-group">
                        <label for="editor1" class="col-sm-2 control-label">Comment</label>
                        <div class="col-sm-10">
                            <textarea class="form-control"  rows="3" name="comment" id="editor1" placeholder="Comment">{COMMENT}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="hidden" value="{PROJECTID}" name="projectid">
                            <button type="submit" class="btn btn-default">Plaats Comment</button>
                        </div>
                    </div>
                </form>

                <!-- END BLOCK : COMMENTFORM -->




            </div><!-- /.blog-post -->


        </div>
        <!-- END BLOCK : DETAILS -->


    </div><!-- /.blog-post -->
</div>
