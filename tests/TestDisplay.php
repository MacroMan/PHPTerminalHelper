<?php

class TestDisplay {

	private $helper;

	public function __construct($helper) {
		//$this->helper = $helper;
		$this->helper = new TerminalHelper(STDERR);
		$this->run();
	}

	private function run() {
		Test::out("Running Display Test");
		Test::sleep();

		$cols = $this->helper->displayGetColumns();
		$lines = $this->helper->displayGetLines();
		Test::out("Found $cols columns and $lines lines");
		Test::sleep();

		Test::out("Clearing line 10");
		$this->fillScreen();
		$this->helper->cursorPositionSet(100, 10);
		$this->helper->displayEraseLine();
		Test::sleep();

		Test::out("Clearing line 20 before cursor");
		$this->fillScreen();
		$this->helper->cursorPositionSet(100, 20);
		$this->helper->displayEraseLineBeforeCursor();
		Test::sleep();

		Test::out("Clearing line 30 before cursor");
		$this->fillScreen();
		$this->helper->cursorPositionSet(100, 30);
		$this->helper->displayEraseLineAfterCursor();
		Test::sleep();

		Test::out("Clearing whole screen after this sleep");
		$this->fillScreen();
		Test::sleep();
		$this->helper->displayEraseScreen();
		Test::sleep();

		Test::out("Scrolling up 20 lines");
		$this->fillScreen();
		$this->helper->displayScrollUp(20);
		Test::sleep();

		Test::out("Scrolling down 10 lines");
		$this->fillScreen();
		$this->helper->displayScrollDown(10);
		Test::sleep();
	}

	private function fillScreen() {
		$lines = $this->helper->displayGetLines();
		$cols = $this->helper->displayGetColumns();
		for ($i = 2; $i <= $lines; $i++) {
			$this->helper->cursorPositionSet(1, $i);
			fwrite(STDERR, str_repeat("=", $cols - 10));
		}
	}

}
