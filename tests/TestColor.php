<?php

class TestColor {

	private $helper;

	public function __construct($helper) {
		//$this->helper = $helper;
		$this->helper = new TerminalHelper(STDERR);
		$this->run();
	}

	private function run() {
		Test::out("Running Color Test");
		Test::sleep();

		for ($font = 0; $font <= 7; $font++) {
			for ($bg = 0; $bg <= 7; $bg++) {
				$this->helper->textColorSet($font);
				$this->helper->textBackgroundColorSet($bg);
				fwrite(STDERR, "Color $font on BG $bg");
				$this->helper->textReset();
				fwrite(STDERR, "\n");
			}
		}

		fwrite(STDERR, "\n");
		$this->helper->textColorSet(0);
		$this->helper->textBackgroundColorSet(7);
		fwrite(STDERR, "Normal color  ");
		$this->helper->textColorSwapWithBackgroundColor();
		fwrite(STDERR, "  Inverted colours");
		$this->helper->textColorSetDefault();
		$this->helper->textBackgroundColorSetDefault();
		fwrite(STDERR, "\nThese colours are back to the defaults\n\n");
	}

}
