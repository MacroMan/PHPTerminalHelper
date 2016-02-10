<?php

class TestMode {

	private $helper;

	public function __construct($helper) {
		//$this->helper = $helper;
		$this->helper = new TerminalHelper(STDERR);
		$this->run();
	}

	private function run() {
		Test::out("Running Mode Test");
		Test::sleep();

		Test::out("MODE_SMALL_BW");
		$this->helper->displayModeSet(TerminalHelper::MODE_SMALL_BW);
		$this->fillScreen();
		Test::sleep();

		Test::out("MODE_SMALL_COLOR");
		$this->helper->displayModeSet(TerminalHelper::MODE_SMALL_COLOR);
		$this->fillScreen();
		Test::sleep();

		Test::out("MODE_STANDARD_BW");
		$this->helper->displayModeSet(TerminalHelper::MODE_STANDARD_BW);
		$this->fillScreen();
		Test::sleep();

		Test::out("MODE_STANDARD_COLOR");
		$this->helper->displayModeSet(TerminalHelper::MODE_STANDARD_COLOR);
		$this->fillScreen();
		Test::sleep();

		Test::out("MODE_LARGE_BW");
		$this->helper->displayModeSet(TerminalHelper::MODE_LARGE_BW);
		$this->fillScreen();
		Test::sleep();

		Test::out("MODE_LARGE_COLOR");
		$this->helper->displayModeSet(TerminalHelper::MODE_LARGE_COLOR);
		$this->fillScreen();
		Test::sleep();

		Test::out("MODE_EXTRA_LARGE_BW");
		$this->helper->displayModeSet(TerminalHelper::MODE_EXTRA_LARGE_BW);
		$this->fillScreen();
		Test::sleep();
	}

	private function fillScreen() {
		$this->helper->textColorSet(2);
		$this->helper->textBackgroundColorSet(1);
		$lines = $this->helper->displayGetLines();
		$cols = $this->helper->displayGetColumns();
		for ($i = 2; $i <= $lines; $i++) {
			$this->helper->cursorPositionSet(1, $i);
			fwrite(STDERR, str_repeat("=", $cols - 10));
		}
	}

}
