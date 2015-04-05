<?php

class SCTitle {

    public $ag;

    public function __construct( $ag ) {
        $ag->add_state( 'do_page_content', 'title',
            array( $this, 'title_content' ) );

        $this->ag = $ag;
    }

    public function title_content() {
        if ( FALSE != $this->ag->char ) {
            header( 'Location: game-logout.php' );
            exit;
        }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo( GAME_NAME ); ?></title>
    <link rel="stylesheet" href="<?php echo( GAME_CUSTOM_STYLE_URL );
        ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo( GAME_CUSTOM_STYLE_URL );
        ?>sc.css">
    <link href="http://fonts.googleapis.com/css?family=Lato"
          rel="stylesheet" type="text/css">
  </head>
  <body>
<div id="popup" class="invis"></div>
<div class="container">

  <div class="row">
    <div class="col-md-8 text-left">
      <h1>Shattered City</h1>
    </div>
    <div class="col-md-4">

      <form class="form-horizontal" role="form" name="login_form"
            id="login_form" method="post" action="game-login.php">
        <div class="form-group">
          <label for="login_user"
                 class="col-sm-4 control-label">Username</label>
          <div class="col-sm-8">
            <input class="form-control input-sm" name="user"
                   id="login_user" value="" type="text">
          </div>
        </div>
        <div class="form-group">
          <label for="login_pass"
                 class="col-sm-4 control-label">Password</label>
          <div class="col-sm-8">
            <input class="form-control" name="pass"
                   id="login_pass" value="" type="password">
          </div>
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-sm btn-default">Log in!</button>
        </div>
        <input type="hidden" name="state" value="login">
      </form>

    </div>
  </div>

<?php
    $err_obj = array(
        1 => 'Please provide a username.',
        2 => 'Please provide a password.',
        3 => 'Please provide a valid email address.',
        4 => 'That username already exists.',
        5 => 'That email address is already in use.',
        6 => 'That username and password combination does not exist.',
        100 => 'Thanks! Please check your email for a validation link.',
        101 => 'That account is already validated!',
        102 => 'Success! You can now log in.',
    );

    if ( isset( $_GET[ 'notify' ] ) ) {
        $notify = intval( $_GET[ 'notify' ] );
        if ( isset( $err_obj[ $notify ] ) ) {
            echo( '<div class="row text-center alert"><h2>' .
                  $err_obj[ $notify ] . '</h2></div>' );
        }
    }
?>

  <div class="row">

    <div class="col-md-6 text-left">
      <h3>Register for a free account</h3>

      <form class="form-horizontal" name="register_form" id="register_form"
            method="post" action="game-login.php">
        <div class="form-group">
          <label for="register_user"
                 class="col-sm-4 control-label">Username</label>
          <div class="col-sm-8">
            <input class="form-control input-sm" name="user"
                   id="register_user" value="" type="text">
          </div>
        </div>
        <div class="form-group">
          <label for="register_pass"
                 class="col-sm-4 control-label">Password</label>
          <div class="col-sm-8">
            <input class="form-control" name="pass"
                   id="register_pass" value="" type="password">
          </div>
        </div>
        <div class="form-group">
          <label for="register_email"
                 class="col-sm-4 control-label">Email</label>
          <div class="col-sm-8">
            <input class="form-control" name="email"
                   id="register_email" value="" type="text">
          </div>
        </div>
        <div class="text-right">
          <button type="submit"
                  class="btn btn-sm btn-default">Register</button>
        </div>
        <input type="hidden" name="state" value="register">
      </form>

    </div>

    <div class="col-md-2"></div>

    <div class="col-md-4 text-right">
      <h3>Fun, and free!</h3>
      <p>Shattered City is maintained by
<a href="https://twitter.com/scotchfield">@scotchfield</a>
(<a href="https://github.com/scotchfield">github</a>), and built using
the <a href="https://github.com/scotchfield/arcadia">Arcadia open-source web game engine</a>.</p>
    </div>
  </div>

</div>

<script src="<?php echo GAME_CUSTOM_STYLE_URL; ?>popup.js"></script>
<script src="<?php echo GAME_CUSTOM_STYLE_URL; ?>jquery.min.js"></script>
<script src="<?php echo GAME_CUSTOM_STYLE_URL; ?>bootstrap.min.js"></script>

</body>
</html>

<?php
    }

}
