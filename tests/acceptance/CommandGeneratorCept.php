<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('generate a command.');

$I->runShellCommand('php artisan commander:generate Acme/Bar/FooCommand --properties="bar, baz" --base="tests/tmp"');

$I->openFile('tests/tmp/Acme/Bar/FooCommand.php');
$I->seeFileContentsEqual(str_replace("\r", '', file_get_contents("tests/acceptance/stubs/FooCommand.stub")));

$I->seeInShellOutput('All done!');
