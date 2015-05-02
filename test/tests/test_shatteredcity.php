<?php

class TestShatteredCity extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $ag = new ArcadiaGame();

        $ag->set_component( 'common', new ArcadiaCommon() );
        $ag->set_component( 'db',
            new ArcadiaDb( DB_ADDRESS, DB_NAME, DB_USER, DB_PASSWORD ) );
        $ag->set_component( 'user', new ArcadiaUser( $ag ) );

        $this->ag = $ag;
        $this->sc = new ShatteredCity( $ag );
    }

    public function tearDown() {
        unset( $this->sc );
        unset( $this->ag );
    }

    /**
     * @covers ShatteredCity::__construct
     */
    public function test_sc_new() {
        $this->assertNotNull( $this->sc );
    }

}
