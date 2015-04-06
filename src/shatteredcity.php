<?php

class ShatteredCity {

    public $ag;

    public function __construct( $ag ) {
        $ag->add_state( 'set_default_state', FALSE,
            array( $this, 'default_state' ) );

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

}
