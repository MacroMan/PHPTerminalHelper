<?php

class TerminalHelper {

	/**
	 * @var const COLOR_* Constant shortcuts for the common terminal colors supported in most terminal emulators
	 */
	const COLOR_BLACK = '0',
			COLOR_RED = '1',
			COLOR_GREEN = '2',
			COLOR_YELLOW = '3',
			COLOR_BLUE = '4',
			COLOR_MAGENTA = '5',
			COLOR_CYAN = '6',
			COLOR_WHITE = '7';

	/**
	 * @var const MODE_* Constant shortcuts for the different terminal modes available in most terminal emulators
	 */
	const MODE_SMALL_BW = '0',
			MODE_SMALL_COLOR = '1',
			MODE_STANDARD_BW = '2',
			MODE_STANDARD_COLOR = '3',
			MODE_LARGE_BW = '5',
			MODE_LARGE_COLOR = '4',
			MODE_EXTRA_LARGE_BW = '6';

	/**
	 *
	 * @var boolean|const|instanceOfFopen $escapeSequenceOutput If not false, then used as the first argument in fwrite to send escape sequences to the terminal
	 * @var string $escapeSequencePrefix The string to send to the terminal to initiate an escape sequence
	 */
	private $escapeSequenceOutput, $escapeSequencePrefix = "\033[";

	/**
	 * @param boolean|const|instanceOfFopen $escapeSequenceOutput $escapeSequenceOutput If not false, then used as the first argument in fwrite to send escape sequences to the terminal
	 */
	public function __construct($escapeSequenceOutput = STDERR) {
		$this->escapeSequenceOutput = $escapeSequenceOutput;
	}

	/**
	 * @param boolean|const|instanceOfFopen $output $escapeSequenceOutput If not false, then used as the first argument in fwrite to send escape sequences to the terminal
	 */
	public function setEscapeSequenceOutput($output = STDERR) {
		$this->escapeSequenceOutput = $output;
	}

	/**
	 * @param string $prefix The string to send to the terminal to initiate an escape sequence
	 */
	public function setEscapeSequencePrefix($prefix = "\033[") {
		$this->escapeSequencePrefix = $prefix;
	}

	/**
	 * @access private
	 * @param string $string Body of the escape sequence to send to the terminal
	 * @return string Body of the escape sequence to send to the terminal
	 */
	private function output($string) {
		$output = "$this->escapeSequencePrefix$string";
		if ($this->escapeSequenceOutput) {
			fwrite($this->escapeSequenceOutput, $output);
		}
		return $output;
	}

	/**
	 * @param interger $by Number of lines to move by
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function cursorMoveUp($by = 1) {
		return $this->output("{$by}A");
	}

	/**
	 * @param interger $by Number of lines to move by
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function cursorMoveDown($by = 1) {
		return $this->output("{$by}B");
	}

	/**
	 * @param interger $by Number of columns to move by
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function cursorMoveLeft($by = 1) {
		return $this->output("{$by}D");
	}

	/**
	 * @param interger $by Number of columns to move by
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function cursorMoveRight($by = 1) {
		return $this->output("{$by}C");
	}

	/**
	 * @param interger $by Number of lines to move by
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function cursorMoveUpAndHome($by = 1) {
		return $this->output("{$by}F");
	}

	/**
	 * @param interger $by Number of lines to move by
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function cursorMoveDownAndHome($by = 1) {
		return $this->output("{$by}E");
	}

	/**
	 * @param interger $number The column number to move to
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function cursorColumnSet($number = 1) {
		return $this->output("{$number}G");
	}

	/**
	 * @param integer $columnNumber The column number to move to
	 * @param integer $lineNumber The line/row number to move to
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function cursorPositionSet($columnNumber = 1, $lineNumber = 1) {
		return $this->output("{$lineNumber};{$columnNumber}H");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function cursorPositionSave() {
		return $this->output("s");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function cursorPositionRestore() {
		return $this->output("u");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function cursorHide() {
		return $this->output("?25l");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function cursorShow() {
		return $this->output("?25h");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function cursorBlinkOn() {
		$this->displaySgr("5");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function cursorBlinkOff() {
		$this->displaySgr("25");
	}

	/**
	 * @return string The number of columns currently vsible in the terminal window
	 */
	public function displayGetColumns() {
		return exec("tput cols");
	}

	/**
	 * @return string The number of lines/rows currently vsible in the terminal window
	 */
	public function displayGetLines() {
		return exec("tput lines");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function displayEraseLine() {
		return $this->output("2K");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	private function displayErase($code) {
		return $this->output("{$code}J");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function displayEraseLineAfterCursor() {
		return $this->displayErase("0");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function displayEraseLineBeforeCursor() {
		return $this->displayErase("1");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function displayEraseScreen() {
		return $this->displayErase("2");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function displayScrollUp($by = 1) {
		return $this->output("{$by}S");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function displayScrollDown($by = 1) {
		return $this->output("{$by}S");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function displayModeSet($modeNumber) {
		return $this->output("{$modeNumber}h");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	private function displaySgr($code) {
		return $this->output("{$code}m");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function textReset() {
		return $this->displaySgr("0");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function textBold() {
		return $this->displaySgr("1");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function textBoldOff() {
		return $this->displaySgr("22");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function textUnderline() {
		return $this->displaySgr("4");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function textUnderlineOff() {
		return $this->displaySgr("24");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function textFontSet($fontNumber = 0) {
		if ($fontNumber < 0 || $fontNumber > 9) {
			$fontNumber = 0;
		}
		return $this->displaySgr(10 + $fontNumber);
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function textFontSetDefault() {
		$this->textFontSet(0);
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function textColorSet($colourNumber = 0) {
		if ($colourNumber < 0 || $colourNumber > 7) {
			$colourNumber = 0;
		}
		return $this->displaySgr(30 + $colourNumber);
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 * @todo Get this working
	 */
	/* public function textColorSetRgb($red = 0, $green = 0, $blue = 0) {
	  return $this->displaySgr("38;2;{$red};{$green};{$blue}");
	  } */

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function textColorSetDefault() {
		return $this->displaySgr("39");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function textBackgroundColorSet($colourNumber = 0) {
		if ($colourNumber < 0 || $colourNumber > 7) {
			$colourNumber = 0;
		}
		return $this->displaySgr(40 + $colourNumber);
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 * @todo Get this working
	 */
	/* public function textBackgroundColorSetRgb($red = 0, $green = 0, $blue = 0) {
	  return $this->displaySgr("48;2;{$red};{$green};{$blue}");
	  } */

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function textBackgroundColorSetDefault() {
		return $this->displaySgr("49");
	}

	/**
	 * @return string The escape sequence to send to the terminal if not already sent by $output()
	 */
	public function textColorSwapWithBackgroundColor() {
		return $this->displaySgr("7");
	}

}
