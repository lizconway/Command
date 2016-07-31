<?php
/*
* Author: Elizabeth Conway
* Assignment: WE4.0 Server-side Web Development, Digital Skills Academy
* Student ID: D11122173
* Date : 2016/07/31
* Ref: https://en.wikipedia.org/wiki/Ten_Commandments
*/

 /**
  * TxtView - a View in the MVC architecture.
  * It is responsible for generating JSON output for the translations
  * $translations is the data sent by the CommandCtrl->getTranslations() function
  *
  * @author liz
  *
  */

/**
 * JSON verified using JSONLint and JSON Formatter
 *  http://jsonlint.com/ and https://jsonformatter.curiousconcept.com/
 * for ECMA-404, RFC 7159 and RFC 4627
 */
$this->output
->set_content_type('application/json')
->set_output(json_encode($translations[0]));
?>