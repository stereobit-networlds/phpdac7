@echo off
rem path=%path%;\php\;\GitHub\phpdac7

cd \GitHub\phpdac7\agents
php agentds.dpc.php %1 %2 %3 %4 %5 %6
cd \GitHub\phpdac7\bin


rem pause