@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/phpunit
<<<<<<< HEAD
SET COMPOSER_RUNTIME_BIN_DIR=%~dp0
=======
SET COMPOSER_BIN_DIR=%~dp0
>>>>>>> origin/New-FakeMain
php "%BIN_TARGET%" %*
