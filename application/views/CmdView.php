<?php
/* echo "<h1>Commandments</h1>";
var_dump($commandments[0]); */

/**
 * JSON verified using JSONLint and JSON Formatter
 *  http://jsonlint.com/ and https://jsonformatter.curiousconcept.com/
 * for ECMA-404, RFC 7159 and RFC 4627
 */
$this->output
->set_content_type('application/json')
->set_output(json_encode($commandments[0]));
?>