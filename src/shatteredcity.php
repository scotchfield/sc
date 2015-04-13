<?php

class ShatteredCity {

    public $ag;

    public function __construct( $ag ) {
        $ag->add_state( 'set_default_state', FALSE,
            array( $this, 'default_state' ) );
        $ag->add_state( 'game_header', FALSE, array( $this, 'header' ) );
        $ag->add_state( 'game_footer', FALSE, array( $this, 'footer' ) );
        $ag->add_state( 'validate_user', FALSE,
            array( $this, 'validate_user' ) );

        $ag->set_component( 'achievement', new ArcadiaAchievement() );
        $ag->set_component( 'heartbeat', new ArcadiaHeartbeat() );

        $ag->set_component( 'sc_select', new SCSelect( $ag ) );
        $ag->set_component( 'sc_title', new SCTitle( $ag ) );

        $this->ag = $ag;
    }

    public function default_state() {
        if ( FALSE == $this->ag->user ) {
            $this->ag->set_state( 'title' );
        } else if ( FALSE == $this->ag->char ) {
            $this->ag->set_state( 'select' );
        } else {
            $this->ag->set_state( 'profile' );
        }
    }

    public function header() {
        if ( ! strcmp( 'title', $this->ag->get_state() ) ) {
            return;
        }

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo( GAME_NAME ); ?> (<?php echo( $this->ag->get_state() );
    ?>)</title>
    <link rel="stylesheet" href="<?php echo( GAME_CUSTOM_STYLE_URL );
        ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo( GAME_CUSTOM_STYLE_URL );
        ?>sc.css">
    <link href="http://fonts.googleapis.com/css?family=Raleway:400,500"
      rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Oswald:700'
          rel='stylesheet' type='text/css'>
  </head>
  <body>
    <div id="popup" class="invis"></div>
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle"
                  data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo( GAME_URL ); ?>"><?php
              echo( GAME_NAME ); ?></a>
        </div>
<?php
        if ( FALSE != $this->ag->char ) {
            $this->ag->c( 'heartbeat' )->add_heartbeat();
?>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle"
                 data-toggle="dropdown">Character <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?state=profile">Profile</a></li>
                <li><a href="?state=achievements">Achievements</a></li>
                <li class="divider">
                <li><a href="?state=online">Characters Online</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle"
                 data-toggle="dropdown">Map <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?state=map">Current Location</a></li>
                <li class="divider">
                <li><a href="?state=combat">Combat</a></li>
                <li><a href="?state=boss">Boss Battles</a></li>
                <li><a href="?state=vendor">Vendor</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle"
                 data-toggle="dropdown">About <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?state=about">About Shattered City</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="game-logout.php">Log out</a></li>
          </ul>
        </div>
<?php
        }
?>
      </div>
    </div>

    <div class="container">
<?php
    }

    public function footer() {
        if ( ! strcmp( 'title', $this->ag->get_state() ) ) {
            return;
        }

?>
    </div>
    <script src="<?php echo( GAME_CUSTOM_STYLE_URL );
        ?>popup.js"></script>
    <script src="<?php echo( GAME_CUSTOM_STYLE_URL );
        ?>jquery.min.js"></script>
    <script src="<?php echo( GAME_CUSTOM_STYLE_URL );
        ?>bootstrap.min.js"></script>
  </body>
</html>
<?php
    }

    public function validate_user( $args ) {
        if ( ! isset( $args[ 'user_id' ] ) ) {
            return FALSE;
        }

        set_user_max_characters( $args[ 'user_id' ], 1 );

        return TRUE;
    }

}
