rem @echo off
rem createprocess /w=2000 /term tier.bat %1 %2 %3 %4 %5 %6
rem createprocess /v /w=5000 /f=CREATE_NO_WINDOW tier.bat %1 %2 %3 %4 %5 %6
createprocess /v /w=2000 /f=CREATE_NEW_CONSOLE tier.bat %1 %2 %3 %4 %5 %6
rem pause