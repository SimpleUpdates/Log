<?php

require_once 'PEAR/PackageFileManager.php';
require_once 'Console/Getopt.php';

$version = '1.8.5';
$notes = <<<EOT
The 'sql' handler now enforces a maximum 'ident' length of 16 characters.

The 'sql' handler can now use a user-defined sequence.
EOT;

$changelog = <<<EOT
The 'sql' handler now enforces a maximum 'ident' length of 16 characters.

The 'sql' handler can now use a user-defined sequence (via the 'sequence' configuration parameter).  This allows each log table to use its own sequence.  You will need to take appropriate steps to preserve your sequence numbering if that is important to your site; the ID sequence will be reinitialized to 0 the first time this updated handler is used.  You may also need to explicitly drop the 'log_id_seq' sequence before using this new code.
EOT;

$package = new PEAR_PackageFileManager();

$result = $package->setOptions(array(
    'package'           => 'Log',
    'summary'           => 'Logging utilities',
    'version'           => $version,
    'state'             => 'stable',
    'license'           => 'PHP License',
    'filelistgenerator' => 'cvs',
    'ignore'            => array('package.php', 'phpdoc.sh'),
    'notes'             => $notes,
    'changelognotes'    => $changelog,
    'changelogoldtonew' => false,
	'simpleoutput'		=> true,
    'baseinstalldir'    => '/',
    'packagedirectory'  => ''));

if (PEAR::isError($result)) {
    echo $result->getMessage();
    die();
}

$package->addMaintainer('jon', 'lead', 'Jon Parise', 'jon@php.net');

$package->addDependency('php', '4.3.0', 'ge', 'php');
$package->addDependency('DB', false, 'has', 'pkg', true);
$package->addDependency('sqlite', false, 'has', 'ext', true);

if ($_SERVER['argv'][1] == 'commit') {
    $result = $package->writePackageFile();
} else {
    $result = $package->debugPackageFile();
}

if (PEAR::isError($result)) {
    echo $result->getMessage();
    die();
}
