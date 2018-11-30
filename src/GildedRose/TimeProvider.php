<?php

interface TimeProvider {

	public function getCurrentTime(): DateTime;

}