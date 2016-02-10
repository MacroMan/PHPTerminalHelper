<?php

include_once 'TerminalHelper.php';
include_once 'tests/TestCursor.php';
include_once 'tests/TestDisplay.php';
include_once 'tests/TestColor.php';
include_once 'tests/TestMode.php';

class Test {

	public function __construct() {
		$helper = new TerminalHelper(STDERR);
		//new TestCursor($helper);
		//new TestDisplay($helper);
		//new TestColor($helper);
		new TestMode($helper);
		$helper->textReset();
	}

	public static function out($txt) {
		fwrite(STDERR, "\033[s\033[2J\033[1;1H{$txt}\033[u");
	}

	public static function sleep() {
		sleep(2);
	}

}

$test = new Test();
