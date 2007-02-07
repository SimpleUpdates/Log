--TEST--
Log: Firebug Handler
--FILE--
<?php

require_once 'Log.php';

$conf = array();
print "** UNBUFFERED **\n";
$logger = &Log::singleton('firebug', '', 'PHP', $conf);
$logger->log('Debug',     PEAR_LOG_DEBUG);
$logger->log('Info',      PEAR_LOG_INFO);
$logger->log('Notice',    PEAR_LOG_NOTICE);
$logger->log('Warning',   PEAR_LOG_WARNING);
$logger->log('Error',     PEAR_LOG_ERR);
$logger->log('Critical',  PEAR_LOG_CRIT);
$logger->log('Alert',     PEAR_LOG_ALERT);
$logger->log('Emergency', PEAR_LOG_EMERG);
unset($logger);

print "\n** BUFFERED **\n";
$conf = array('buffering' => true);
$logger = &Log::singleton('firebug', '', 'PHP', $conf);
$logger->log('Debug',     PEAR_LOG_DEBUG);
$logger->log('Info',      PEAR_LOG_INFO);
$logger->log('Notice',    PEAR_LOG_NOTICE);
$logger->log('Warning',   PEAR_LOG_WARNING);
$logger->log('Error',     PEAR_LOG_ERR);
$logger->log('Critical',  PEAR_LOG_CRIT);
$logger->log('Alert',     PEAR_LOG_ALERT);
$logger->log('Emergency', PEAR_LOG_EMERG);
--EXPECT--
** UNBUFFERED **
<script type="text/javascript">console.debug("PHP [debug] Debug");</script>
<script type="text/javascript">console.info("PHP [info] Info");</script>
<script type="text/javascript">console.info("PHP [notice] Notice");</script>
<script type="text/javascript">console.warn("PHP [warning] Warning");</script>
<script type="text/javascript">console.error("PHP [error] Error");</script>
<script type="text/javascript">console.error("PHP [critical] Critical");</script>
<script type="text/javascript">console.error("PHP [alert] Alert");</script>
<script type="text/javascript">console.error("PHP [emergency] Emergency");</script>

** BUFFERED **
<script type="text/javascript">
console.debug("PHP [debug] Debug");
console.info("PHP [info] Info");
console.info("PHP [notice] Notice");
console.warn("PHP [warning] Warning");
console.error("PHP [error] Error");
console.error("PHP [critical] Critical");
console.error("PHP [alert] Alert");
console.error("PHP [emergency] Emergency");
</script>
