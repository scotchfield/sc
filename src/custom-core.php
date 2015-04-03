<?php

require( GAME_CUSTOM_PATH . 'shatteredcity.php' );

require( GAME_CUSTOM_PATH . 'title.php' );

global $ag;
$ag->sc = new ShatteredCity( $ag );
