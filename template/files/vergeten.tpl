
<div class="jumbotron">
    <h1>Vergeten??????</h1>
</div>

<div class="col-sm-8 blog-main">

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

        <!-- START BLOCK : RESET_HASH -->
        <a href="index.php?pageid=8&action=4&reset={RESET}">Klik hier om je wachtwoord te wijzigen!!!</a>
        <input type="hidden" name="reset" value="{RESET}">

        <!-- END BLOCK : RESET_HASH -->

        <!-- START BLOCK : GET_USER -->

        <h2>Uw gebruikersnaam is {USER}</h2>

        <!-- END BLOCK : GET_USER -->


        <!-- START BLOCK : GET_ALL -->
        <h2>Uw gebruikersnaam is {USER}</h2>

        <p><a href="index.php?pageid=8&action=4&reset={RESET}">Klik hier om je wachtwoord te wijzigen!!!</a>
        </p>
        <!-- END BLOCK : GET_ALL -->

        <!-- START BLOCK : RESET_PASSWORD -->

        <form  action="index.php?pageid=8&action=5" method="post">
            <div class="form-group">
                <label for="Pass1" class="col-sm-4 control-label">Wachtwoord</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="inputpass1" placeholder="Password" name="pass1">
                </div>
                <div class="form-group">
                    <label for="Pass2" class="col-sm-4 control-label">Herhaal wachtwoord</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="inputpass2" placeholder="Password" name="pass2">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <input type="hidden" value="{RESET}" name="accountid">
                            <button type="submit" class="btn btn-default" name="resetpw">Reset</button>
                        </div>
                    </div>
                    </div>
                </div>
        </form>
        <!-- END BLOCK : RESET_PASSWORD -->

        <!-- START BLOCK : VERGETENFORM -->
        <form class="form-horizontal" action="index.php?pageid=8&action=3" method="post">
            <div class="form-group">
                <label for="inputemail" class="col-sm-4 control-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="inputemail" placeholder="Email" name="email">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <input type="hidden" name="option" value="{OPTION}">
                    <button type="submit" class="btn btn-default">Verzend</button>
                </div>
            </div>
        </form>
        <!-- END BLOCK : VERGETENFORM -->








    </div><!-- /.blog-post -->
</div>

<div class="col-sm-3 col-sm-offset-1 blog-sidebar">

    <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
    </div>
    <div class="sidebar-module">
        <h4>Archives</h4>
        <ol class="list-unstyled">
            <li><a href="#">March 2014</a></li>
            <li><a href="#">February 2014</a></li>
            <li><a href="#">January 2014</a></li>
            <li><a href="#">December 2013</a></li>
            <li><a href="#">November 2013</a></li>
            <li><a href="#">October 2013</a></li>
            <li><a href="#">September 2013</a></li>
            <li><a href="#">August 2013</a></li>
            <li><a href="#">July 2013</a></li>
            <li><a href="#">June 2013</a></li>
            <li><a href="#">May 2013</a></li>
            <li><a href="#">April 2013</a></li>
        </ol>
    </div>
    <div class="sidebar-module">
        <h4>Elsewhere</h4>
        <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
        </ol>
    </div>
</div>