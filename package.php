<?php

require_once 'PEAR/PackageFileManager2.php';
PEAR::setErrorHandling(PEAR_ERROR_DIE);

$desc = <<<EOT
The Log framework provides an abstracted logging system. It supports logging to console, file, syslog, SQL, Sqlite, mail, and mcal targets. It also provides a subject - observer mechanism.
EOT;

$version = '1.9.4';
$notes = <<<EOT
If a 'DB' class already exists, the SQL handler won't attempt to require DB.php. (Bug 6214)
When creating the Log instance in factory(), return a proper reference to the object. (Bug 5261)
When preparing the MDB2 statement, mark it as MDB2_PREPARE_MANIP. (Bug 6323)
If the desired Log class already exists (because the caller has supplied it
from some custom location), simply instantiate and return a new instance. (Mads Danquah)
EOT;

$package = new PEAR_PackageFileManager2();

$result = $package->setOptions(array(
    'filelistgenerator' => 'cvs',
    'changelogoldtonew' => false,
    'simpleoutput'		=> true,
    'baseinstalldir'    => '/',
    'packagefile'       => 'package2.xml',
    'packagedirectory'  => '.'));

if (PEAR::isError($result)) {
    echo $result->getMessage();
    die();
}

$package->setPackage('Log');
$package->setPackageType('php');
$package->setSummary('Logging utilities');
$package->setDescription($desc);
$package->setChannel('pear.php.net');
$package->setLicense('PHP License', 'http://www.php.net/license/3_01.txt');
$package->setAPIVersion('1.0.0');
$package->setAPIStability('stable');
$package->setReleaseVersion($version);
$package->setReleaseStability('stable');
$package->setNotes($notes);
$package->setPhpDep('4.3.0');
$package->setPearinstallerDep('1.4.3');
$package->addMaintainer('lead',  'jon', 'Jon Parise', 'jon@php.net');
$package->addIgnore(array('package.php', 'phpdoc.sh', 'package.xml', 'package2.xml'));
$package->addPackageDepWithChannel('optional', 'DB', 'pear.php.net', '1.3');
$package->addPackageDepWithChannel('optional', 'MDB2', 'pear.php.net', '2.0.0RC1');
$package->addExtensionDep('optional', 'sqlite');

$package->generateContents();
$package1 = &$package->exportCompatiblePackageFile1();

if ($_SERVER['argv'][1] == 'commit') {
    $result = $package->writePackageFile();
    $result = $package1->writePackageFile();
} else {
    $result = $package->debugPackageFile();
    $result = $package1->debugPackageFile();
}

if (PEAR::isError($result)) {
    echo $result->getMessage();
    die();
}
