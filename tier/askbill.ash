create askbill
call askbill
render http www.e-basis.gr/e-Enterprise.php?action=xml 1
render q
#render quit //inside ASKBILL
uncall askbill
quit
exit