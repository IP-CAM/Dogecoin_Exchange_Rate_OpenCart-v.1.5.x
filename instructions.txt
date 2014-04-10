Dogecoin Exchange Rate

OpenCart Extension

Adapted by Stephane Bres @StephBres

Donations: DBjYqjDT5exc5HP88cyYQ3PnLRWinuiRF7

Donations: 1PMnrNJQ6BC58YRZrmjo56MfXw3V4k4b7g


This product is offered with no warranty and is currently supported only for Opencart versions listed below

* 1.5.0
* 1.5.0.2
* 1.5.0.3
* 1.5.0.4
* 1.5.0.5
* 1.5.1
* 1.5.1.1
* 1.5.1.2
* 1.5.1.3
* 1.5.2
* 1.5.2.1
* 1.5.3.1
* 1.5.4
* 1.5.4.1
* 1.5.5
* 1.5.5.1

===INSTALLATION===
Installation is a two step process.  You must upload dogecoin_update.php and you must modify index.php .
  
STEP 1) Upload dogecoin_update.php:
Place dogecoin_update.php in the folder [OpenCart]/catalog/controller/common

STEP 2) Modify index.php:
Add the following lines to the index.php file in the base directory of your Opencart root folder.

After:
// SEO URL's
$controller->addPreAction(new Action('common/seo_url'));	

Add:
// Update Currencies
$controller->addPreAction(new Action('common/dogecoin_update'));

Much wow!  Please contact stephanejrbres@gmail.com with any issues you may have.

Copyright (c) 2014 Stephane Bres (jga)
Copyright (c) 2013 John Atkinson (jga)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
