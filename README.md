# TerminalHelper
A helper utility for terminal written in PHP that gives very easy access to native escape sequences to allow changing of color and also control of the cursor and display modes

This should run fine on most *nix and OSx environments and also on Windows as long as ANSI.SYS is installed. See https://en.wikipedia.org/wiki/ANSI.SYS

@author MacroMan (David Wakelin) - davidwakelin.co.uk

@licence GNU GENERAL PUBLIC LICENSE v2 - See LICENSE

@usage - Include the class in your script. Create a new instance to start the progress bar and call update(); to update it.

@example
```php
include('TerminalHelper.php');
$helper = new TerminalHelper();

// echo some text
echo "This is some text\n";

// Change to text and bg color before the next echo
$helper->textColorSet(TerminalHelper::COLOR_GREEN);
$helper->textBackgroundColorSet(TerminalHelper::COLOR_WHITE);

// This text will be green on a white background
echo "This is some colored text";

// Remember to reset the text before exiting, other wise the terminal will still be colored
$helper->textReset();
````

