--TEST--
Log: _extractMessage()
--FILE--
<?php

require_once 'Log.php';

$conf = array('lineFormat' => '%2$s [%3$s] %4$s');
$logger = &Log::singleton('console', '', 'ident', $conf);

/* Logging a regular string. */
$logger->log('String');

/* Logging a bare object. */
class BareObject {}
$logger->log(new BareObject());

/* Logging an object with a getMessage() method. */
class GetMessageObject { function getMessage() { return "getMessage"; } }
$logger->log(new GetMessageObject());

/* Logging an object with a toString() method. */
class ToStringObject { function toString() { return "toString"; } }
$logger->log(new ToStringObject());

/* Logging an object with a __toString() method using casting. */
class CastableObject { function __toString() { return "__toString"; } }
$logger->log(new CastableObject());

/* Logging a PEAR_Error object. */
require_once 'PEAR.php';
$logger->log(new PEAR_Error('PEAR_Error object', 100));

/* Logging an array. */
$logger->log(array(1, 2, 'three' => 3));

--EXPECT--
ident [info] String
ident [info] BareObject Object
(
)

ident [info] getMessage
ident [info] toString
ident [info] __toString
ident [info] PEAR_Error object
ident [info] Array
(
    [0] => 1
    [1] => 2
    [three] => 3
)
