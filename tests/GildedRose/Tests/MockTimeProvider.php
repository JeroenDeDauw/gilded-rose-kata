<?php

namespace GildedRose\Tests;

use TimeProvider;
/*
 * Interface for use during the test - we would inject the test
 * times to be played by the test suite
 * This mock will provider a flow simulator for time passing
 * It contains a scheduler
 */
class MockTimeProvider implements TimeProvider {

    /**
     * @todo
     * MockTimeProvider constructor.
     * @param $start - start day to process
     * @param $end - end day to process
     */
    public function __construct($start, $end) {

	}

	public function getCurrentTime(): \DateTime {

	}

}