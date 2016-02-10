<?php

class TestCursor {

	private $helper;

	public function __construct($helper) {
		//$this->helper = $helper;
		$this->helper = new TerminalHelper(STDERR);
		$this->run();
	}

	private function run() {
		Test::out("Running Cursor Test");
		Test::sleep();

		Test::out("Turning blink off (not well supported, but easier to see test if it works)");
		$this->helper->cursorBlinkOff();
		Test::sleep();

		Test::out("Moving to 20, 10");
		$this->helper->cursorPositionSet(20, 10);
		Test::sleep();

		Test::out("Moving to 30, 15");
		$this->helper->cursorPositionSet(30, 15);
		Test::sleep();

		Test::out("Moving up 2");
		$this->helper->cursorMoveUp(2);
		Test::sleep();

		Test::out("Moving right 4");
		$this->helper->cursorMoveRight(4);
		Test::sleep();

		Test::out("Moving down 5");
		$this->helper->cursorMoveDown(5);
		Test::sleep();

		Test::out("Moving left 7");
		$this->helper->cursorMoveleft(7);
		Test::sleep();

		Test::out("Moving up 3 and home");
		$this->helper->cursorMoveUpAndHome(3);
		Test::sleep();

		Test::out("Moving right 56");
		$this->helper->cursorMoveRight(56);
		Test::sleep();

		Test::out("Moving down 5 and home");
		$this->helper->cursorMoveDownAndHome(5);
		Test::sleep();

		Test::out("Moving to column 70");
		$this->helper->cursorColumnSet(70);
		Test::sleep();

		Test::out("Saving cursor position and moving the cursor to 10, 10");
		$this->helper->cursorPositionSave();
		$this->helper->cursorPositionSet(10, 10);
		Test::sleep();

		Test::out("Restoring the cursor position");
		$this->helper->cursorPositionRestore();
		Test::sleep();

		Test::out("Hiding the cursor and moving to 20, 20");
		$this->helper->cursorHide();
		$this->helper->cursorPositionSet(20, 20);
		Test::sleep();

		Test::out("Showing the cursor again");
		$this->helper->cursorShow();
		Test::sleep();

		Test::out("Turning blink on");
		$this->helper->cursorBlinkOn();
		Test::sleep();
	}

}
