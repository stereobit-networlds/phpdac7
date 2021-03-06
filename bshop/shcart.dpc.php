<?php
$__DPCSEC['SHCART_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("SHCART_DPC")) && (seclevel('SHCART_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("SHCART_DPC",true);

$__DPC['SHCART_DPC'] = 'shcart';

require_once(_r('bshop/storebuffer.lib.php'));
require_once(_r('bshop/mchoice.dpc.php'));
require_once(_r('libs/sha256.lib.php'));

//$__LOCALE['SHCART_DPC'][27]='_CHKOUT;Checkout;Ταμείο';
//echo _lc('shcart',27,2);
$al = getlocal();
$cart_checkout = localize('_CHKOUT', $al);
$cart_order = localize('_ORDER', $al);
$cart_recalc = localize('_RECALC', $al);
$cart_submit = localize('_SUBMITORDER', $al);	
$cart_cancel = localize('_CANCELORDER', $al);
$cart_submit2 = localize('_SUBMITORDER2', $al);
//echo $cart_checkout . '>';

$__EVENTS['SHCART_DPC'][0]= "viewcart"; 					 	 
$__EVENTS['SHCART_DPC'][1]= "clearcart";
$__EVENTS['SHCART_DPC'][2]= "loadcart";
$__EVENTS['SHCART_DPC'][3]= "removefromcart";
$__EVENTS['SHCART_DPC'][4]= "printcart";
$__EVENTS['SHCART_DPC'][5]= $cart_checkout;
$__EVENTS['SHCART_DPC'][6]= $cart_order;
$__EVENTS['SHCART_DPC'][7]= $cart_recalc;
$__EVENTS['SHCART_DPC'][8]= $cart_submit;	
$__EVENTS['SHCART_DPC'][9]= $cart_cancel;
$__EVENTS['SHCART_DPC'][10]= "transcart";
$__EVENTS['SHCART_DPC'][11]= "fastpick";
$__EVENTS['SHCART_DPC'][12]= "sship";
$__EVENTS['SHCART_DPC'][13]= "calc";
$__EVENTS['SHCART_DPC'][14]= $cart_submit2;
$__EVENTS['SHCART_DPC'][15]= "cart-checkout";
$__EVENTS['SHCART_DPC'][16]= "cart-order";
$__EVENTS['SHCART_DPC'][17]= "cart-submit";
$__EVENTS['SHCART_DPC'][18]= "cart-cancel";
$__EVENTS['SHCART_DPC'][19]= "addtocart"; 
$__EVENTS['SHCART_DPC'][20]= "carttransport";
$__EVENTS['SHCART_DPC'][21]= "cartpayment";
$__EVENTS['SHCART_DPC'][22]= "cartaddress";
$__EVENTS['SHCART_DPC'][23]= "cartcustomer";
$__EVENTS['SHCART_DPC'][24]= "cartcustselect";
$__EVENTS['SHCART_DPC'][25]= "cartinvoice";
$__EVENTS['SHCART_DPC'][26]= "cartguestuser";
$__EVENTS['SHCART_DPC'][27]= "cartguestreg";
$__EVENTS['SHCART_DPC'][28]= "clickaway";

$__ACTIONS['SHCART_DPC'][0]= "viewcart";
$__ACTIONS['SHCART_DPC'][1]= "clearcart";
$__ACTIONS['SHCART_DPC'][2]= "loadcart"; 
$__ACTIONS['SHCART_DPC'][3]= "removefromcart";
$__ACTIONS['SHCART_DPC'][4]= "printcart";
$__ACTIONS['SHCART_DPC'][5]= $cart_checkout;
$__ACTIONS['SHCART_DPC'][6]= $cart_order;
$__ACTIONS['SHCART_DPC'][7]= $cart_recalc;
$__ACTIONS['SHCART_DPC'][8]= $cart_submit;	
$__ACTIONS['SHCART_DPC'][9]= $cart_cancel;	
$__ACTIONS['SHCART_DPC'][10]= 'transcart';
$__ACTIONS['SHCART_DPC'][11]= "fastpick";
$__ACTIONS['SHCART_DPC'][12]= "sship";
$__ACTIONS['SHCART_DPC'][13]= "calc";
$__ACTIONS['SHCART_DPC'][14]= $cart_submit2;
$__ACTIONS['SHCART_DPC'][15]= "cart-checkout";
$__ACTIONS['SHCART_DPC'][16]= "cart-order";
$__ACTIONS['SHCART_DPC'][17]= "cart-submit";
$__ACTIONS['SHCART_DPC'][18]= "cart-cancel";
$__ACTIONS['SHCART_DPC'][19]= "addtocart"; 
$__ACTIONS['SHCART_DPC'][20]= "carttransport";
$__ACTIONS['SHCART_DPC'][21]= "cartpayment";
$__ACTIONS['SHCART_DPC'][22]= "cartaddress";
$__ACTIONS['SHCART_DPC'][23]= "cartcustomer";
$__ACTIONS['SHCART_DPC'][24]= "cartcustselect";
$__ACTIONS['SHCART_DPC'][25]= "cartinvoice";
$__ACTIONS['SHCART_DPC'][26]= "cartguestuser";
$__ACTIONS['SHCART_DPC'][27]= "cartguestreg";
$__ACTIONS['SHCART_DPC'][28]= "clickaway";

$__LOCALE['SHCART_DPC'][0]='SHCART_DPC;My Cart;Καλάθι Αγορών';
$__LOCALE['SHCART_DPC'][1]='_GRANDTOTAL;Grand Total;Γενικό Σύνολο';
$__LOCALE['SHCART_DPC'][2]='loginorregister;Login or Register for a new account;Παρακαλώ προχωρείστε στις απαιτούμενες ενέργειες!';
$__LOCALE['SHCART_DPC'][3]='_IWAY;Notice of pay;Τυπος Παραστατικού';
$__LOCALE['SHCART_DPC'][4]='_INVOICE;Invoice;Τιμολόγιο';
$__LOCALE['SHCART_DPC'][5]='_APODEIXI;Receipt;Αποδειξη';
$__LOCALE['SHCART_DPC'][6]='_DELIVADDRESS;Delivery Address;Παράδοση σε αλλη διευθυνση';
$__LOCALE['SHCART_DPC'][7]='_TAX;Tax;ΦΠΑ';
$__LOCALE['SHCART_DPC'][8]='_NO;No;Οχι';
$__LOCALE['SHCART_DPC'][9]='_FASTPICK;Fast pick;Γρήγορη Συλλογή';
$__LOCALE['SHCART_DPC'][10]='_FASTPICKON;Fast pick is ON;Η Γρήγορη Συλλογή είναι ON';
$__LOCALE['SHCART_DPC'][11]='_FASTPICKOFF;Fast pick is OFF;Η Γρήγορη Συλλογή είναι OFF';
$__LOCALE['SHCART_DPC'][12]='_TOTAL;Subtotal;Σύνολο';
$__LOCALE['SHCART_DPC'][13]='_FCOST;Total;Πληρωτέο';
$__LOCALE['SHCART_DPC'][13]='_SHIPCOST;Shipping cost;Κόστος μεταφορικών';
$__LOCALE['SHCART_DPC'][14]='_SHIPWEIGHT;Weight;Τα αντικείμενα στο καλάθι σας ζυγίζουν';
$__LOCALE['SHCART_DPC'][15]='_KG;Kg;Κιλά';
$__LOCALE['SHCART_DPC'][16]='_SHIPZONE;Shipping Zone;Ζώνη αποστολής';
$__LOCALE['SHCART_DPC'][17]='_PARCELOF;Parcel;Δέμα βάρους';
$__LOCALE['SHCART_DPC'][18]='_CONTINUESHOP;Continue shopping;Συνέχισε τις αγορές';
$__LOCALE['SHCART_DPC'][19]='_CLEARCARTITEMS;Remove all items;Άδειασε το καλάθι';
$__LOCALE['SHCART_DPC'][20]='_ADDCARTITEM;Add item;Στο καλάθι'; //_INCART db var
$__LOCALE['SHCART_DPC'][21]='_REMCARTITEM;Remove;Αφαίρεση';
$__LOCALE['SHCART_DPC'][22]='_SUBMITORDER2;Submit Order;Τέλος Συναλλαγής';
$__LOCALE['SHCART_DPC'][23]='_TRANSPRINT;Print;Εκτύπωση';
$__LOCALE['SHCART_DPC'][24]='_ORDERSUBJECT;Order No ;Παραγγελία No ';
$__LOCALE['SHCART_DPC'][25]='_MYCART;My Cart;Καλάθι';
$__LOCALE['SHCART_DPC'][26]='_VIEWCART;View cart;Καλάθι';
$__LOCALE['SHCART_DPC'][27]='_CHECKOUT;Checkout;Ταμείο';

$__LOCALE['SHCART_DPC'][28]='Eurobank;Credit card;Πιστωτική κάρτα'; //used by mchoice param
$__LOCALE['SHCART_DPC'][29]='Piraeus;Credit card;Πιστωτική κάρτα'; //used by mchoice param
$__LOCALE['SHCART_DPC'][30]='Paypal;Credit card;Πιστωτική κάρτα'; //used by mchoice param
$__LOCALE['SHCART_DPC'][31]='PayOnsite;Pay on site;Πληρωμή στο κατάστημά μας';//used by mchoice param
$__LOCALE['SHCART_DPC'][32]='BankTransfer;Direct Bank transfer;Κατάθεση σε τραπεζικό λογαριασμό';//used by mchoice param
$__LOCALE['SHCART_DPC'][33]='PayOndelivery;Cash on delivery;Αντικαταβολή';//used by mchoice param

$__LOCALE['SHCART_DPC'][34]='Invoice;Invoice;Τιμολόγιο';//used by mchoice param
$__LOCALE['SHCART_DPC'][35]='Receipt;Receipt;Απόδειξη';//used by mchoice param
/*
$__LOCALE['SHCART_DPC'][36]='CompanyDelivery;Our Delivery Service;Διανομή με όχημα της εταιρείας (εντός θεσσαλονίκης)';
$__LOCALE['SHCART_DPC'][37]='Logistics;3d Party Logistic Service;Μεταφορική εταιρεία';//used by mchoice param
$__LOCALE['SHCART_DPC'][38]='Courier;Courier;Courier';//used by mchoice param
$__LOCALE['SHCART_DPC'][39]='CustomerDelivery;Self Service;Παραλαβή απο το κατάστημα μας';//used by mchoice param
$__LOCALE['SHCART_DPC'][40]='PayOnCompanyDelivery;Pay at delivery;Πληρωμή κατα την παράδοση (εντός θεσσαλονίκης)';
*/
$__LOCALE['SHCART_DPC'][38]='Courier;Courier;Courier';//used by mchoice param

$__LOCALE['SHCART_DPC'][41]='_RESET;Reset;Καθαρισμός';
$__LOCALE['SHCART_DPC'][42]='_EMPTY;Empty;Αδειο';
$__LOCALE['SHCART_DPC'][43]='_BLN3;Clear Cart;Αδειασμα Καλαθιού';
$__LOCALE['SHCART_DPC'][44]='_BLN2;Remove from Cart;Αφαίρεση απο το Καλάθι';
$__LOCALE['SHCART_DPC'][45]='_BLN1;Add to Cart;Προσθήκη στο Καλάθι';
$__LOCALE['SHCART_DPC'][46]='_MSG16;Prices does not include taxes;Οι τιμές δεν συμπεριλαμβάνουν ΦΠΑ 19%';
$__LOCALE['SHCART_DPC'][47]='_MSG15;Your cart is full;Το καλάθι σας είναι γεμάτο';
$__LOCALE['SHCART_DPC'][48]='_MSG14;Your order submited successfully! Thank you!;Η παραγγελία σας εκτελέστηκε επιτυχώς !';
$__LOCALE['SHCART_DPC'][49]='_QTY;Qty;Τεμ.';
$__LOCALE['SHCART_DPC'][50]='_PRICE;Price;Τιμή';
$__LOCALE['SHCART_DPC'][51]='_DESCR;Description;Περιγραφή';
$__LOCALE['SHCART_DPC'][52]='_STOTAL;sTotal;Σύνολο';
$__LOCALE['SHCART_DPC'][53]='_TOTAL;Total;Σύνολο';
$__LOCALE['SHCART_DPC'][54]='_RECALC;Recalculate;Υπολογισμός';
$__LOCALE['SHCART_DPC'][55]='_CHKOUT;Check Out;Ταμείο';
$__LOCALE['SHCART_DPC'][56]='_ORDER;Order;Επιβεβαίωση';
$__LOCALE['SHCART_DPC'][57]='_CANCELORDER;Cancel;Ακύρωση';
$__LOCALE['SHCART_DPC'][58]='_SUBMITORDER;Submit Order;Ολοκλήρωση Συναλλαγής';
$__LOCALE['SHCART_DPC'][59]='_PRINT;Print;Εκτύπωση';
$__LOCALE['SHCART_DPC'][60]='_CLOSE;Close;Κλείσιμο';
$__LOCALE['SHCART_DPC'][61]="_ACCDENIED;Υou don't have the appropriate priviliges.;Δεν έχετε το απαραίτητο δικαίωμα.";
$__LOCALE['SHCART_DPC'][62]='_CONTENTS;Contents;Περιεχόμενα';
$__LOCALE['SHCART_DPC'][63]='_NOTAVAL;Not available;Μη διαθέσιμο';
$__LOCALE['SHCART_DPC'][64]='_TAX;Tax;Φόρος';
$__LOCALE['SHCART_DPC'][65]='_SHIPCOST;Shipping Cost;Έξοδα αποστολής';
$__LOCALE['SHCART_DPC'][66]='_DISCOUNT;Discount;Εκπτωση';
$__LOCALE['SHCART_DPC'][67]='_FCOST;Final cost;Πληρωτέο';
$__LOCALE['SHCART_DPC'][68]='_BOXTYPE;Box;Συσκ.';
$__LOCALE['SHCART_DPC'][69]='_CART;Shop Cart;Καλάθι Αγορών';
$__LOCALE['SHCART_DPC'][70]='_RWAY;Shipping:;Τρόπος Αποστολής';
$__LOCALE['SHCART_DPC'][71]='_RWAY1;By Car;Οδικώς';
$__LOCALE['SHCART_DPC'][72]='_RWAY2;Courier;Courier';
$__LOCALE['SHCART_DPC'][73]='_RWAY3;ELTA;ΕΛΤΑ';
$__LOCALE['SHCART_DPC'][74]='_PWAY;Pay with:;Τρόπος Πληρωμής';
$__LOCALE['SHCART_DPC'][75]='_PWAY1;Trust my account;Χρέωση του λογαριασμου μου';
$__LOCALE['SHCART_DPC'][76]='_PWAY2;Cash on delivery;Αντικαταβολή';
$__LOCALE['SHCART_DPC'][77]='_PWAY3;VISA;VISA';
$__LOCALE['SHCART_DPC'][78]='_ENDOK;Thank you! Your order submited successfully with Order No :;Ευχαριστούμε ! Η παραγγελία σας εκτελέστηκε επιτυχώς με αριθμό Παραγγελίας :';
$__LOCALE['SHCART_DPC'][79]='_SXOLIA;Comments;Σχόλια;';
$__LOCALE['SHCART_DPC'][80]='_CARTERROR;Transaction error;Λαθος εκτελεσης;';
$__LOCALE['SHCART_DPC'][81]='_STOCKOUT; is out of stock; δεν υπαρχει επαρκές απόθεμα;';
$__LOCALE['SHCART_DPC'][82]='_INPUTERR;Invalid entry;Λανθασμένη ποσότητα;';
$__LOCALE['SHCART_DPC'][83]='_couponvalid;Valid coupon;Ενεργοποίηση κουπονιού;';
$__LOCALE['SHCART_DPC'][84]='_couponinvalid;Invalid coupon;Το κουπόνι δεν είναι έγκυρο;';
$__LOCALE['SHCART_DPC'][85]='_pointsused;Use loyalty points;Χρήση πόντων επιβράβευσης;';
$__LOCALE['SHCART_DPC'][86]='_discount;Discount;Έκπτωση;';
$__LOCALE['SHCART_DPC'][87]='_coupon;Coupon;Κουπόνι;';
$__LOCALE['SHCART_DPC'][88]='_usedpointsdiscount;Used points discount;Έκπτωση χρήσης πόντων;';
$__LOCALE['SHCART_DPC'][89]='_totalcartdiscount;Cart total discount;Έκπτωση συνολικής αξίας;';
$__LOCALE['SHCART_DPC'][90]='_pointstoset;Loyalty points;Πόντοι επιβράβευσης;';
$__LOCALE['SHCART_DPC'][91]='_invalidemail;Invalid e-mail;Το e-mail δεν είναι έγκυρο;';
$__LOCALE['SHCART_DPC'][92]='_invalidname;Invalid name;Το όνομα δεν συμπληρώθηκε;';
$__LOCALE['SHCART_DPC'][93]='_invalidaddress;Invalid address;Η διεύθυνση δεν συμπληρώθηκε;';
$__LOCALE['SHCART_DPC'][94]='_invalidpostcode;Invalid postcode;Ο ταχ. κωδικός δεν συμπληρώθηκε;';
$__LOCALE['SHCART_DPC'][95]='_invalidcountry;Invalid country;Η πόλη,χώρα δεν συμπληρώθηκε;';
$__LOCALE['SHCART_DPC'][96]='_invalidphone;Invalid phone number;Ο αριθμός τηλεφώνου δεν συμπληρώθηκε;';
$__LOCALE['SHCART_DPC'][97]='_guesterr;Guest details;Συμπλήρωση στοιχείων;';
$__LOCALE['SHCART_DPC'][98]='_LOADED;Loaded;Ανακτήθηκε;';
$__LOCALE['SHCART_DPC'][99]='_SUBMITORDER2;Submit Order;Τέλος Συναλλαγής;';
$__LOCALE['SHCART_DPC'][100]='_EMAIL;e-Mail;e-Mail;';
$__LOCALE['SHCART_DPC'][101]='_CLICKAWAY;Click Away;Click Away;';
$__LOCALE['SHCART_DPC'][102]='_CARTAWAYTEXT;Click away enabled;Η διαδικασία click away ενεργοποίηθηκε';
$__LOCALE['SHCART_DPC'][103]='_CLICKAWAYENABLE;Enable the ClickAway procedure;Ενεργοποιήσετε την διαδικασία ClickAway;';
$__LOCALE['SHCART_DPC'][104]='_DELIVERYADDRESS;Delivery Address;Διεύθυνση αποστολής';
$__LOCALE['SHCART_DPC'][105]='_NOTES;Order notes;Παρατηρήσεις';
$__LOCALE['SHCART_DPC'][106]='_TERMSTEXT;I’ve read and accept the ;Με την αποστολή της παραπάνω φόρμας αποδέχεστε τους ';
$__LOCALE['SHCART_DPC'][107]='_TERMSTITLE;Terms and Conditions;Όρους χρήσης';
$__LOCALE['SHCART_DPC'][108]='_BILLINGDETAILS;Billing Details;Στοιχεία χρέωσης';
$__LOCALE['SHCART_DPC'][109]='_EMPTYCART;Υour cart is empty;Αδειο καλάθι';
$__LOCALE['SHCART_DPC'][110]='_ONESTEPREGISTRATION;One step registration;Eγγραφή σε ένα βήμα';
$__LOCALE['SHCART_DPC'][111]='_FATCARTREGISTRATION;Registration form;Εισάγετε τα στοιχεία σας';
$__LOCALE['SHCART_DPC'][112]='_invalidpayway;Payment type not selected;Επιλέξτε τρόπο πληρωμής';
$__LOCALE['SHCART_DPC'][113]='_CARTERROR;Error during cart submition;Η συναλλαγή δεν εκτελέστηκε';
$__LOCALE['SHCART_DPC'][114]='_TERMSAPPROVE;Approve the terms and conditions;Επικυρώστε τους όρους χρήσης';
$__LOCALE['SHCART_DPC'][115]='_CREATEACCOUNTOPTION;Create Account;Να κρατηθούν τα στοιχεία για επόμενη παραγγελία';
$__LOCALE['SHCART_DPC'][116]='_CREATEACCOUNTOPTIONREJECTED;Remove your account;Διαγραφή των στοιχείων σας';
$__LOCALE['SHCART_DPC'][117]='_ADDMSG1;There is no stock;Δεν υπάρχει απόθεμα στο προιον';
$__LOCALE['SHCART_DPC'][118]='_pqtycolor;Color;Χρώμα';
$__LOCALE['SHCART_DPC'][119]='_pqtysize;Size;Μέγεθος';
$__LOCALE['SHCART_DPC'][120]='_pqtysizecolor;Dim;Μέγεθος-Χρώμα';
$__LOCALE['SHCART_DPC'][121]='_ITEMQTYSELECT;Select item attribute;Επιλέξτε χαρακτηριστικό είδους';

$__PARSECOM['SHCART_DPC']['quickview']='_VIEWCART_';

$__DPCEXT['SHCART_DPC']='showsymbol';

/*when include this class file add code for event/action
  switch (event) {
	case evnt1 : require_once(_r('traits/shcart-evnt1.trait.php'));
				 break;	
	case evnt2 : ...
    default    : none 	
  }
  class shcart {
	  use evnt1 as samename;
	  ...
  }	  
*/	  

class shcart extends storebuffer {
	
	use systemlib;

	var $path, $lan, $autopay, $test2pay;
	var $uniname2, $status, $qtytotal;
	var $liveupdate, $moneysymbol, $maxcart;
	var $allowqtyover, $mailerror, $submiterror, $sxolia, $continue_button;
    var $rejectqty, $checkout, $order, $submit, $cancel, $recalc;
	var $detailqty, $stock_msg, $overitem, $ignoreqtyzero;
	var $mytaxcost, $myfinalcost, $qtytototal, $total;
	var $mydiscount, $myshippingcost, $mypaymentcost, $mytransportcost;
	var $discount, $shippingcost, $paymentcost, $transportcost;

	var $urlpath, $user, $aftersubmitgoto, $aftercancelgoto, $onSuccessGotoTitle;
	var $todo, $quicktax,$showtaxretail,$is_reseller, $cartlinedetails, $notallowremove;
	var $cartloopdata, $looptotals, $shipcalcmethod, $s_enc, $t_enc, $itemclick, $imagex, $imagey;
	var $cartprintwin, $itemscount, $supershipping, $shipzone, $shipmethods, $parcelunit, $parcelweight;
    var $submit2, $url, $printout, $print_title, $cartsumitems, $ordermailsubject;
	
    var $rewrite, $readonly, $minus, $plus, $removeitemclass, $maxlenght;
    var $twig_invoice_template_name;//, $appname, $mtrackimg; 
    var $agentIsIE, $baseurl, $fastpick, $fastpickbutton, $continue_shopping_goto_cmd;
	var $loyalty, $ppolicynotes, $isValidCoupon, $cusrid;	
	
	static $staticpath, $myf_button_class, $myf_button_submit_class;	
	
	var $process, $_NOTAVAL, $shclass, $fastcart, $testcart, $superfastcart, $superfasterror , $clickaway;
	protected $clickaway_id, $clikaway_date, $clickaway_apikey, $clickaway_url, $clickaway_return, $clickaway_signature, $clickawaycode;
	protected $selectsql, $itemqtyselect_misattr, $backorders;
	
    public function __construct($p=null) {
		$UserName = GetGlobal('UserName');
		$UserSecID = GetGlobal('UserSecID');	
		$this->userLevelID = (((decode($UserSecID))) ? (decode($UserSecID)) : 0);		
		$this->user = decode($UserName);
		
		$this->shclass = defined('SHKATALOGMEDIA_DPC') ? 'shkatalogmedia' : 'shkatalog';
		$this->selectsql = "itmname,price0,price1,price2,pricepc,ypoloipo1,ypoloipo2,uniname2,uni2uni1,uniida";
		
		//cookie store id
	    $this->cusrid = md5($_SERVER['REMOTE_ADDR']); //$this->user ? md5($this->user) : md5($_SERVER['REMOTE_ADDR']);	
		
		storebuffer::__construct('cart');
		
		$this->lan = getlocal();		
		$this->title = localize('SHCART_DPC',$this->lan);				
		
		self::$staticpath = paramload('SHELL','urlpath');
		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');

		//$this->baseurl = paramload('SHELL','urlbase');
		//$this->baseurl = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
		//$this->baseurl.= (strstr($_SERVER['HTTP_HOST'], 'www')) ? $_SERVER['HTTP_HOST'] : 'www.' . $_SERVER['HTTP_HOST'];
		$this->baseurl = _v('cmsrt.httpurl');
		$this->url = $this->baseurl; 		
		
		$this->minus = remote_paramload('SHCART','minusqtyclass',$this->path);
		$this->plus = remote_paramload('SHCART','plusqtyclass',$this->path);
		$this->removeitemclass = remote_paramload('SHCART','removeitemclass',$this->path);		
		$this->print_title = remote_paramload('SHCART','printtitle',$this->path); 			
		$this->cartlinedetails = remote_paramload('SHCART','cartlinedetails',$this->path);		
		$this->quicktax = remote_paramload('SHCART','viewtaxfp',$this->path);
		$this->showtaxretail = remote_paramload('SHCART','showtaxretail',$this->path);			
		$this->itemscount = remote_paramload('SHCART','itemscount',$this->path);		
		$this->supershipping = remote_paramload('SHCART','supershipping',$this->path);	
		$this->shipzone = remote_arrayload('SHCART','shipzone',$this->path);	   	  
		$this->shipmethods = remote_arrayload('SHCART','shipmethods',$this->path);
		$this->parcelunit = remote_arrayload('SHCART','parcelunit',$this->path);	   	  
		$this->parcelweight = remote_arrayload('SHCART','parcelweight',$this->path);		
		$this->carterror_mail = remote_paramload('SHCART','carterr',$this->path);
		$this->cartsend_mail = remote_paramload('SHCART','cartsender',$this->path);
		$this->cartreceive_mail = remote_paramload('SHCART','cartreceiver',$this->path); 		
		$this->itemclick = remote_paramload('SHCART','itemclick',$this->path);
		$this->imagex = remote_paramload('SHCART','imagex',$this->path);	
		$this->imagey = remote_paramload('SHCART','imagey',$this->path);	
		$this->cartprintwin = remote_arrayload('SHCART','printwin',$this->path);
		$this->uniname2 = remote_paramload('SHCART','uniname2',$this->path);
		//$this->liveupdate = remote_paramload('SHCART','liveupdate',$this->path);
		$this->allowqtyover = remote_paramload('SHCART','allowqtyover',$this->path);
		$this->rejectqty = remote_paramload('SHCART','rejectzeroqty',$this->path);
		$this->detailqty = remote_paramload('SHCART','overqty2detail',$this->path);
		$this->ignoreqtyzero = remote_paramload('SHCART','ignoreqty0',$this->path);
		$this->maxqty = remote_paramload('SHCART','maxqty',$this->path);
		$this->autopay = (remote_paramload('SHCART','auto',$this->path)>0) ? 1 : null;
		$this->bypass_qty = (remote_paramload('SHCART','showqty',$this->path)>0) ? true : false;
		$this->readonly = remote_paramload('SHCART','qtyreadonly',$this->path);
		$this->continue_shopping_goto_cmd = remote_paramload('SHCART','continuegoto', $this->path); 
		$this->ordermailsubject = remote_paramload('SHCART','ordermailsubject',$this->path);
		$this->aftersubmitgoto = remote_paramload('SHCART','aftersubmitgoto',$this->path);
		$this->aftercancelgoto = remote_paramload('SHCART','cancelgoto',$this->path);
		$this->onSuccessGotoTitle = remote_paramload('SHCART','onsuccessgototitle',$this->path);
		$this->test2pay = remote_paramload('SHCART','test2pay',$this->path);
		
		$rw = remote_paramload('SHCART','rewrite',$this->path);
		$this->rewrite = $rw ? 1 : 0;		
	   
		$mxlen = remote_paramload('SHCART','maxlength',$this->path);
		$this->maxlength = $mxlen ? $mxlen : 3;	 		
		
		$dc = remote_paramload('SHCART','decimals',$this->path);
		$this->dec_num = $dc ? $dc : 2;
		$tx = remote_paramload('SHCART','taxcostpercent',$this->path);	   
		$this->tax = $tx ? $tx : null;
		
		//fixed shipping cost
		$sx = remote_paramload('SHCART','shipcost',$this->path);	   
		$this->shippingcost = GetSessionParam('shipcost') ? GetSessionParam('shipcost') : $sx;	   
		$this->shipcalcmethod = remote_arrayload('SHCART','shipcalcmethod',$this->path);
		
		//payment cost based on payment choosen
		$this->paymentcost = GetSessionParam('paycost');
		//transport cost based on transport choosen
		$this->transportcost = GetSessionParam('transcost');		

		//price per client else cart discount global
		$percentoffperclient = remote_arrayload('SHCART','priceoffperclient',$this->path);
		$this->discount  = $percentoffperclient[$this->userLevelID];
		//$this->discount = $discount?$discount:remote_arrayload('CART','discount',$this->path);

		$rm = remote_paramload('SHCART','notallowremove',$this->path);
		$this->notallowremove = $rm ? $rm : 0;	
		
		$this->continue_button = 1; 	
		
        $this->checkout    = trim(localize('_CHKOUT',$this->lan));				 	
        $this->order       = trim(localize('_ORDER',$this->lan));
	    $this->submit      = trim(localize('_SUBMITORDER',$this->lan));
		$this->submit2 	   = trim(localize('_SUBMITORDER2',$this->lan));		
	    $this->cancel      = trim(localize('_CANCELORDER',$this->lan));
	    $this->recalc      = trim(localize('_RECALC',$this->lan));			
					
		$this->total = (double) 0.0;
  	    $this->qtytotal = GetSessionParam('qty_total');    
        $this->moneysymbol = "&" . paramload('CART','cursymbol') . ";";  
		$this->maxcart = paramload('CART','maxcart');	
		$this->mailerror = null;
		$this->submiterror = null;
		$this->sxolia = null;	
		$this->stock_msg = null;
		$this->overitem = null;
		$this->todo = null;	
		$this->cartloopdata = null;   
		$this->looptotals = null;	
		$this->ppolicynotes = null;	
		$this->isValidCoupon = GetSessionParam('coupon') ? true : false;

		$this->status = GetSessionParam('cartstatus') ? GetSessionParam('cartstatus') : 0;			
		$this->total = floatval(GetSessionParam('subtotal'));
		$this->qty_total = GetSessionParam('qty_total');	   
		
		$this->myfinalcost = floatval(GetSessionParam('total'));		
		$this->myshippingcost = 0;  //floatval(GetSessionParam('myshippingcost'));	   
		$this->mytaxcost = 0;  //floatval(GetSessionParam('mytaxcost'));	
		$this->mydiscount = 0;  //floatval(GetSessionParam('mydiscount'));		
		$this->mypaymentcost = 0;
		$this->mytransportcost = 0;
		
		$this->printout = GetSessionParam('printout') ? GetSessionParam('printout') : null;	  
		$this->transaction_id = GetSessionParam('TransactionID') ? GetSessionParam('TransactionID') : null;
		$this->is_reseller = GetSessionParam('RESELLER');	
		
		$this->_NOTAVAL = localize('_ZEROVAL',$this->lan) ?
						  localize('_ZEROVAL',$this->lan) :	
		                  localize('_NOTAVAILABLE',$this->lan);
			
		$useragent = $_SERVER["HTTP_USER_AGENT"];		
		$this->agentIsIE = (strpos($useragent, 'Trident') !== false) ? '1' : '0';	 //ie 11 
		
		$bc1= remote_paramload('SHCART','buttonclass',$this->path);
		$bc2 = remote_paramload('SHCART','buttonclass2',$this->path); /*single product view*/
		self::$myf_button_class = (($bc2) && (GetReq('id'))) ? $bc2 : $bc1;
	   
		$myf_submit = remote_paramload('SHCART','buttonclasssubmit',$this->path);
		self::$myf_button_submit_class = $myf_submit ? $myf_submit : 'myf_button';		  

		$this->loyalty = _m('cms.paramload use ESHOP+loyalty'); 

		//click away
		$this->clickaway_url = remote_paramload('CLICKAWAY','service',$this->path); //'https://app.ekatanalotis.gov.gr/api/mobile/v2/ed840ad545884deeb6c6b699176797ed/context/';
		$this->clickaway_webid = remote_paramload('CLICKAWAY','webid',$this->path); //'0c2c45028b3f4f52b6cdf5392c981ccb'; //null ;//web id
		$this->clickaway_apikey = remote_paramload('CLICKAWAY','apikey',$this->path); //'ed078e5a4d5b484da5c63318f83e5842';
		$this->clickaway_date = date('Y-m-d h:i:s');	
		$this->clickaway = $this->clickaway_apikey ? true : false;
		
		$_caway = GetReq('clickawaycode') ?? false; //manual last step						
		$this->clickawaycode = GetSessionParam('clickacode') ?? $_caway;	
		
		//cart params
		$this->payFastPresel = remote_paramload('SHCART','payfastselection',$this->path);
		$this->fastcart = remote_paramload('SHCART','fastcart',$this->path);
		$this->superfastcart = remote_paramload('SHCART','superfastcart',$this->path);		
		$this->testcart = remote_paramload('SHCART','testcart',$this->path);
		$this->superfasterror = null;
		
		$this->fastpickbutton = remote_paramload('SHCART','fastpickbutton',$this->path);
		$this->fastpick = GetSessionParam('fastpick') ? true : false;	

		$this->itemqtyselect_misattr = false;
		$this->backorders = remote_paramload('SHCART','backorders',$this->path);		
		
		//select invoice per cart mode
		$this->twig_invoice_template_name = $this->superfastcart ?
											str_replace('.', $this->lan . '.', 'invoicesuperfast.htm'):
											str_replace('.', $this->lan . '.', 'invoice.htm');
		//echo $this->twig_invoice_template_name; 			
	  
		if ($this->maxqty<0) // || ($this->readonly)) { //free style
			$this->javascript(); //ONLY WHEN DEFAULT VIEW EVENT ??		
		
		if ((defined('PROCESS_DPC')) && ($p))	{
			//echo $p;
			//$this->process = new Process\process($this, $p, GetReq('t'));	
			$this->process = new process($this, $p, GetReq('t'));	
		}
		//echo base64_encode(serialize($this->buffer));
		//echo serialize($this->buffer);
		//echo json_encode($this->buffer);	
    }
	
	//called by controller after event
	public function processEvent($event=null) { 
		//echo 'Event:',$event;
		if ((defined('PROCESS_DPC')) &&
		    /*(is_object($this->process))*/
		    /*($this->process instanceof Process\process)) { */
			($this->process instanceof process)) { 
			//echo 'z';
			$this->process->isFinished($event);
		}	
	}	

    public function event($event) {
		global $pushTokens;
		global $cart_checkout, $cart_order, $cart_recalc, $cart_submit, $cart_cancel, $cart_submit2;

		switch ($event) {
			
			case 'clickaway'    :   if (GetGlobal('UserID'))
										$ret = $this->clickaway_event();
									else 
										$this->todo = 'loginorregister';
									break;
			
			case "cartguestreg"  :  $ret = $this->fastcart ? $this->guestFastRegistration() : $this->guestRegistration();
									die($ret); 
									break;			
			
			case "cartguestuser" :  die($this->guestDetails()); 
									break;
			
			case "cartinvoice"   :  die($this->invoiceDetails());
									break;	
									
			case "cartcustomer"  : 	die($this->customerDetails());
									break;			
			
			case "cartaddress"   : 	die($this->addressDetails());
									break;				
			
			case "carttransport" : 	die($this->payway2());
									break;	
									
			case "cartpayment"   : 	die($this->payDetails());
									break;

			case "cartcustselect":  if (defined('SHCUSTOMERS_DPC'))  {
										//shcustomer selcus alias for cart
										_m('shcustomers.deactivatecustomers');//make all decative
										_m('shcustomers.activatecustomer use '.GetReq('customerway')); //activate selected
										$this->is_reseller = _m('shcustomers.is_reseller');//change type of customer
									}
									$this->jsBrowser();
			                        break;									
			
			case "addtocart"     : 	if ($pushTokens) {
										
										$this->apiCartAdd(GetReq('id'));
										
										//$tokens[0] = array('itmname'=>'default page','itmurl'=>'.','itmdescr'=>'default description','price'=>'0');
										$tokens = array();
										$this->loopcartTokens($tokens);
										_m('cmsrt.pushTokens use ' . bin2hex(bzcompress(json_encode($tokens, 9))));
										break;
									}
									//else
										
									if ($this->addtocart()) {

										$this->js_storeCart();
									}
									else {
										//missing attr shows popup frame item to select
										if (($this->itemqtyselect_misattr) && ($id = GetReq('a'))) {
											
											$cat = GetReq('cat');
											$cmd = 'kshowx'; //_v($this->shclass . '.kshowcmd');
											$url = _v('cmsrt.httpurl') . '/';
											$url.= _m("cmsrt.url use t=$cmd&cat=$cat&id=$id");
											//echo $url;
											//<phpdac>jsdialog.zdialogFrame use https://en.m.wikipedia.org/wiki/Big_data</phpdac>
											$this->jsDialogAjax($url);
										}	
									}	
									
									$this->jsBrowser();
									$this->fbjs();
									break;					 	
									
			case "removefromcart": 	if ($pushTokens) {
										
										$this->apiCartRemove(GetReq('id'));
										SetSessionParam('cartstatus',0); 
										$this->status = 0;
										
										//$tokens[0] = array('itmname'=>'default page','itmurl'=>'.','itmdescr'=>'default description','price'=>'0');
										$tokens = array();
										$this->loopcartTokens($tokens);
										_m('cmsrt.pushTokens use ' . bin2hex(bzcompress(json_encode($tokens, 9))));
										break;
									}
									//else
									$p = $this->remove(); 
									SetSessionParam('cartstatus',0); 
									$this->status = 0;
									
									$this->jsDialog($p, localize('_BLN2', $this->lan));	
									$this->js_storeCart();
									
									$this->jsBrowser();
									$this->fbjs();
									break;
									
			case "clearcart"     : 	if ($pushTokens) {
										
										$this->apiCartClear();
										SetSessionParam('cartstatus',0); 
										$this->status = 0;	
										
										//$tokens[0] = array('itmname'=>'default page','itmurl'=>'.','itmdescr'=>'default description','price'=>'0');
										$tokens = array();
										$this->loopcartTokens($tokens);
										_m('cmsrt.pushTokens use ' . bin2hex(bzcompress(json_encode($tokens, 9))));
										break;
									}
									//else
										
									$this->clear(); 
									SetSessionParam('cartstatus',0); 
									$this->status = 0;			

									$this->jsDialog(localize('_BLN3', $this->lan), localize('_CART', $this->lan));	
									//$this->js_cleanCart(); //moved to clear()
									
									$this->jsBrowser();
									$this->fbjs();
									break;	
									
			case "loadcart"      : 	if ($load = $this->loadcart()) { 
										SetSessionParam('cartstatus',0); 
										$this->status = 0; 
										
										//$this->js_cleanCart(); //moved to loadcart()
										
										if (GetReq('ajax')) //ajax call cookie restore
											die(localize('_LOADED', $this->lan));
									
										$this->jsDialog(localize('_BLN1', $this->lan), localize('_CART', $this->lan));
									}
									$this->jsBrowser();
									$this->fbjs();
									break;			  
								 
			case $this->recalc   :
			case $cart_recalc    :
			case 'calc'          : 	//for auto select and calc reason
									SetSessionParam('cartstatus',0); 
									$this->recalculate(); 
									
									$this->js_storeCart();
									
									$this->jsBrowser();
									$this->fbjs();
									break;	  
	  
			case "sship"         :	break; //echo GetReq('czone'),'>'; 
			case "transcart" 	 :  break;			
	   
			case "printcart"     : 	$prn = $this->printorder();
									SetSessionParam('ordercart',null);//COMMENT IT, NOT RE-RENDER
									SetSessionParam('orderdetails',null);//COMMENT IT, NOT RE-RENDER
									echo $prn; 
									exit;
			
			case $cart_cancel    :	
			case $this->cancel   : 	SetSessionParam('cartstatus',0); 
									$this->status = 0; 

									if ($goto = $this->aftercancelgoto) {
										$h = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
										header("Location: ". $h . $goto); 
										exit;
									}

									$this->jsBrowser();	
									$this->fbjs();	
									break;								 
						
			case _lc('shcart',27,1):
			case _lc('shcart',27,2):			
			case 'cart-checkout' : 
			case $cart_checkout  :
			case $this->checkout : 	if (!GetGlobal('UserID')) {
										if ($this->recalculate()) { //recalc include calc shipping
											
											$this->todo = $this->fastcart ? 'fastcart' : 'loginorregister';
											$this->js_storeCart(); //re-save when step
										}
									}
									else {
										if ($this->recalculate()) { //recalc include calc shipping
											
											SetSessionParam('cartstatus',1); 
											$this->status = 1; 

											$this->js_storeCart(); //re-save when step
										
											$this->loopcartdata = $this->loopcart();
											$this->looptotals = $this->foot();
										
											$this->analytics('cartcheckout');
										}
									}  
									
									$this->jsBrowser();
									$this->fbjs();
									break;
			case 'cart-order'    :
			case $cart_order     :
			case $this->order    : 	if (!GetGlobal('UserID')) { //never here with guest user auto-login
			
										/*if ($this->fastcart) {
											echo 'fastcart status 2<br>';
											echo GetParam('payway') .'-'. GetReq('payway') . '<br>';
											echo GetParam('addressway') .'-'. GetParam('sxolia') . '<br>';
											echo GetParam('guestname') .'-'. GetParam('guestemail') . '<br>';
										}
										else*/
											die('Invalid operation 0x00f');
									}
									else { //guest user auto login / normal logedin user
										/*if ($this->fastcart) {
											echo 'fastecart ON<br>';
										}
										echo GetParam('payway') .'-'. GetReq('payway') . '<br>';
										echo GetParam('addressway') .'-'. GetParam('sxolia') . '<br>';
										echo GetParam('guestname') .'-'. GetParam('guestemail') . '<br>';										
										*/
									}
									
									if ($this->recalculate()) { //recalc include calc shipping
									
										SetSessionParam('cartstatus',2); 
										$this->status = 2; 
									
										//hold post params (ver2 of tokens do not save - ajax calls)
										SetSessionParam('payway', GetParam('payway'));
										SetSessionParam('roadway', GetParam('roadway'));
										SetSessionParam('customerway', GetParam('customerway'));
										SetSessionParam('addressway', GetParam('addressway'));
										SetSessionParam('invway', GetParam('invway'));
										SetSessionParam('sxolia', GetParam('sxolia'));
										
										//$this->calculate_shipping(); //deprecated
										//$this->calcShipping();
									
										$this->loopcartdata = $this->loopcart();
										$this->looptotals = $this->foot();
									
										$this->jsBrowser();
										$this->analytics('cartorder');
									}
									break;
			case 'cart-submit'   :						 
			case $this->submit2  :
			case $cart_submit    :	
			case $cart_submit2   :	
			case $this->submit   : 	if (!GetGlobal('UserID')) { 
			
										if ($this->superfastcart) {
											//echo 'SUPER fastcart status 3<br>';
											//echo GetParam('payway') .'-'. GetReq('payway') . '<br>';
											//echo GetParam('addressway') .'-'. GetParam('sxolia') . '<br>';
											//echo GetParam('guestname') .'-'. GetParam('guestemail') . '<br>';		

											if ($this->superfasterror = $this->guestSuperFastCheck($_POST)) {
												$this->jsDialog($this->superfasterror, localize('_CART', $this->lan));
												
												//set cart status to 1
												SetSessionParam('cartstatus',1);
												$this->status = 1; 
												return;
											}											
											//else continue
											
											//save user/customer
											$this->guestSuperFastRegistration();
											
											//in case of user selection of no-account 
											//js to redirect to url /dologout after 3sec of success page
											if (!GetParam('createaccount')) {
												//success page has link to gdpr tools
											}	
										}
										else
											die('Invalid operation 0x0ff');
									} 	
									
									//no page refresh / recalc include calc shipping
									if ($this->recalculate() && $this->getcartCount()>0) {
										
										SetSessionParam('cartstatus',3);
										$this->status = 3; 		
										
										//$this->calculate_shipping();	//deprecated
										//$this->calcShipping();
										
										$this->loopcartdata = $this->loopcart();
										$this->looptotals = $this->foot();

										$this->dispatch_pay_engines();	
									}
									break;
						 
			case "fastpick"      : 	if ($this->fastpick==false) {
										SetSessionParam('fastpick','on');
										$this->fastpick = true;
									}	
									else  {
										SetSessionParam('fastpick',null);
										$this->fastpick = false;
									}
									$msg = $this->fastpick ? localize('_FASTPICKON',$this->lan) : localize('_FASTPICKOFF',$this->lan);
									$this->jsDialog($msg, localize('_CART', $this->lan));									
									
									$this->jsBrowser();
									$this->fbjs();
			case 'viewcart'      :						  
			default              : 	if ($pushTokens) {
										//$tokens[0] = array('itmname'=>'default page','itmurl'=>'.','itmdescr'=>'default description','price'=>'0');
										$tokens = array();
										$this->loopcartTokens($tokens);
										_m('cmsrt.pushTokens use ' . bin2hex(bzcompress(json_encode($tokens, 9))));
										break;
									}
			
									$this->loopcartdata = $this->loopcart();
									$this->looptotals = $this->foot();
									
									$this->jsBrowser();
									$this->fbjs();
		}  
		
    }

    public function action($act=null) {	
		global $pushTokens, $_tokens;

		switch ($act) {
			
			case 'clickaway'    :  	$out = $this->todo ? $this->todolist() : $this->clickaway_action();
									break;
			
			case "cartguestreg" :   break;
			case "cartguestuser":   break;
			case "cartinvoice"  :   break;	
			case "cartcustomer" : 	break;
			case "cartaddress"  : 	break;
			case "carttransport": 	break;				
			case "cartpayment"  : 	break;				
			
			case "sship"     	:   $out = $this->show_supershipping();
									break;
	   
			case "transcart" 	:   break;
							
			case 'searchtopic'	:	//handler from shkatalog
									break;
									
			case 'addtocart'  	:   if ($pushTokens) return json_encode($_tokens);
			
									if (!_v($this->shclass . '.carthandler')) {

											$out = $this->cartview();
									}
									break;
									
			case 'removefromcart': 	if ($pushTokens) return json_encode($_tokens);
			
									if (!_v($this->shclass .'.carthandler')) {
										$out = $this->cartview();
									}
									break;							
		 
			case "cartcustselect": 
			case "fastpick" 	:	//$out = $this->fastpick ? localize('_FASTPICKON',$this->lan) : localize('_FASTPICKOFF',$this->lan);
									$out = $this->cartview();
									break;
		    case 'viewcart'     :      
			default          	:	if ($pushTokens) return json_encode($_tokens);
			
									$out = $this->todo ? $this->todolist() : $this->cartview();
        }

	    return ($out);
    }	
	
	protected function fbjs() {
		if (!defined('JAVASCRIPT_DPC')) return ;
		
		if (_m('cms.paramload use CMS+fbLogMode')==1) {
			
			$fbin = (defined('SHLOGIN_DPC')) ? _m('shlogin.is_fb_logged_in') : _m('cmslogin.is_fb_logged_in');
			$fbid = (defined('SHLOGIN_DPC')) ? _v('shlogin.facebook_userId') : _v('cmslogin.facebook_userId');
						
			$code = (defined('SHLOGIN_DPC')) ? _m('shlogin.fblogin_javascript') : _m('cmslogin.fblogin_javascript');

			if (iniload('JAVASCRIPT')) {
				$js = new jscript;		   	 	
				$js->load_js($code,null,1);		
				unset ($js);
			}
		}		
	}		
	
	//called by shusers.dologin
	public function jsBrowser() {
		if (!defined('JAVASCRIPT_DPC')) return ;

		switch ($this->status) {
			case 3      :   $code = $this->jsStatus3(); break;
			case 2      :   $code = $this->jsStatus2(); break;
			case 1      :   $code = $this->jsStatus1(); break;
			case 0      :
			default 	:	$code = $this->jsStatus0();
		}		
		   
		if ($code) {
			$js = new jscript;	
			$js->load_js($code,null,1);		
			unset ($js);
		}
	}	
	
	//cart view
	protected function jsStatus0() {
		$mobileDevices = _m('cmsrt.mobileMatchDev');		
		$gotoSection = 'cart-page'; 
		
		if ($addtocart = GetReq('a')) {
			$cartstr = explode(';', $addtocart);
			$urlstr = "&id=" . $cartstr[0];
			
			$gotoSection = 'cart-Product' . $this->getcartCount();
		}
		else {
			$urlstr = ($cat = GetReq('cat')) ? "&cat=" . $cat : "&id=" . $gotoSection;
			
			//echo $this->cartsumitems; //not calculated yet
			if ((GetReq('t')=='calc') && ($cartsumitems = $this->getcartCount())) { //goto calc products1..n
				for($i=1;$i<=$cartsumitems;$i++) {
					if ($calcItemVal = GetReq('Product'.$i)) { 
						$gotoSection = 'cart-Product' . $i; 
						//echo $i; 
						break;
					}	
				}	
			}		
		}	
		
		$code = $this->js_compute_qty();			
		$code.= $this->js_guest_registration();			
		$code.= "
jQuery('#guestdetailsbutton').on('click touchstart',function(){
	jQuery.ajax({ url: 'katalog.php?t=cartguestuser', cache: false, success: function(html){
		jQuery('#guestdetails').html(html);
		if (/{$mobileDevices}/i.test(navigator.userAgent)) 
			window.scrollTo(0,parseInt(jQuery('#guestdetails').offset().top, 10));
		else
			gotoTop('guestdetails');
	}})
});	
		
jQuery(document).ready(function () {
	if (/{$mobileDevices}/i.test(navigator.userAgent)) 
		window.scrollTo(0,parseInt(jQuery('#$gotoSection').offset().top, 10));
	else {		
		gotoTop('$gotoSection');	
	
		jQuery(window).scroll(function() { 
			if (agentDiv('$gotoSection')) {
				jQuery.ajax({ url: 'jsdialog.php?t=jsdcode{$urlstr}&div=$gotoSection', cache: false, success: function(jsdialog){
					eval(jsdialog);		
				}})	
			}
			else if (agentDiv('cart-page')) {
				jQuery.ajax({ url: 'jsdialog.php?t=jsdcode{$urlstr}&div=cart-page', cache: false, success: function(jsdialog){
					eval(jsdialog);		
				}})	
			}	
		});	
	}		
});	
";

		return ($code);
	}
	
	//cart-checkout or login page
	protected function jsStatus1() {
		$mobileDevices = _m('cmsrt.mobileMatchDev');
		$gotoSection = 'cart-summary';//'cart-page';
		
		$code = "
jQuery(document).ready(function () {
	
    if (/{$mobileDevices}/i.test(navigator.userAgent)) {
	  //delegate events
		  
	  //jQuery('#addressway').on('change', function (e) { 
	  jQuery('body').on('change', '#addressway', function(){
		url = 'katalog.php?t=cartaddress&addressway='+jQuery(this).val();
		jQuery.ajax({ url: url, cache: false, success: function(html){
			jQuery('#addressdetails').html(html);
		}});
      });
	
	  //jQuery('#roadway').on('change', function (e) {
	  jQuery('body').on('change', '#roadway', function(){
		url = 'katalog.php?t=carttransport&roadway='+jQuery(this).val();
		jQuery.ajax({ url: url, cache: false, success: function(html){
			jQuery('#transportdetails').html(html);
		}});
      });	
	
	  //jQuery('#payway').on('change', function (e) {
	  jQuery('body').on('change', '#payway', function(){
		url = 'katalog.php?t=cartpayment&payway='+jQuery(this).val();
		jQuery.ajax({ url: url, cache: false, success: function(html){
			jQuery('#paymentdetails').html(html);
		}});
      });	

	  //jQuery('#customerway').on('change', function (e) {
	  jQuery('body').on('change', '#customerway', function(){
		url = 'katalog.php?t=cartcustomer&customerway='+jQuery(this).val();
		jQuery.ajax({ url: url, cache: false, success: function(html){
			jQuery('#customerdetails').html(html);
		}});
      });	

	  //jQuery('#invoiceway').on('change', function (e) {
	  jQuery('body').on('change', '#invoiceway', function(){
		url = 'katalog.php?t=cartinvoice&invway='+jQuery(this).val();
		jQuery.ajax({ url: url, cache: false, success: function(html){
			jQuery('#invoicedetails').html(html);
		}});
      });	  
	}
	
	if (/{$mobileDevices}/i.test(navigator.userAgent)) 
		window.scrollTo(0,parseInt(jQuery('#$gotoSection').offset().top, 10));
	else {		
		gotoTop('$gotoSection');	
	
		jQuery(window).scroll(function() { 
			if (agentDiv('$gotoSection')) {
				jQuery.ajax({ url: 'jsdialog.php?t=jsdcode&id=cart-status-1&div=$gotoSection', cache: false, success: function(jsdialog){
					eval(jsdialog);		
				}})	
			}	
		});
	}	
});	
";	
		
		return ($code);
	}

	protected function jsStatus2() {
		$mobileDevices = _m('cmsrt.mobileMatchDev');
		$gotoSection = 'cart-summary';//'cart-page';
		
		$code = "
jQuery(document).ready(function () {	
	if (/{$mobileDevices}/i.test(navigator.userAgent)) 
		window.scrollTo(0,parseInt(jQuery('#$gotoSection').offset().top, 10));
	else 	
		gotoTop('$gotoSection');	
});	
";		
		return ($code);		
	}

	protected function jsStatus3() {
		$mobileDevices = _m('cmsrt.mobileMatchDev');
		$gotoSection = 'cart-page';
		
		$code = "
jQuery(document).ready(function () {	
	if (/{$mobileDevices}/i.test(navigator.userAgent)) 
		window.scrollTo(0,parseInt(jQuery('#$gotoSection').offset().top, 10));
	else 	
		gotoTop('$gotoSection');	
});	
";		
		return ($code);			
	}	
	
	//called by input field onkeyup when free qty edit is on
	protected function js_compute_qty() {
        $url = $this->url . '/calc/'; 
	
		$out = "	
function computeqty(textbox,n)
{
  var nval = document.getElementById(textbox).value;	
  var textInput = Number(nval); 
  var qty = textInput + n;  
  if (qty>0) { 
	var location = '$url'+textbox+'/'+qty+'/'; 
	window.location.href = location; 
  }	
}
function preselqty(id,step,limit)
{
  var nval = document.getElementById(id).value;	
  var presel = Number(nval);
  if ((step<0) && (presel>limit)) qty = presel + Number(step);
  else if ((step>0) && (presel<limit))qty = presel + Number(step);
  else qty = presel;  
}
";	
		return $out;
    }
	
	protected function js_guest_registration() {

		$guesterr = localize('_guesterr', $this->lan);
		$invmail = localize('_invalidemail', $this->lan);
		$invname = localize('_invalidname', $this->lan);
		$invaddr = localize('_invalidaddress', $this->lan);
		$invps = localize('_invalidpostcode', $this->lan);
		$invcountry = localize('_invalidcountry', $this->lan);
		$invphone = localize('_invalidphone', $this->lan);
		$ajaxurl = seturl("t=");
		
		$code = <<<EOF
function guestreg(gotourl)
{
	var gurl = gotourl;
	var emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;	
    var email = jQuery('#guestemail').val();
	var gname = jQuery('#guestname').val();
	var gaddr = jQuery('#guestaddress').val();
	var gcode = jQuery('#guestpostcode').val();
	var gcoun = jQuery('#guestcountry').val();
	var gphon = jQuery('#guestphone').val();
	
	var err = '';
	var validemail = emailReg.test(email);
	
	//alert('data:'+gname+' '+gaddr+' '+gcode+' '+gcoun+' '+email+':'+validemail);
	if (validemail==false) err = '$invmail.<br/>';
	if (!gname)	err += '$invname.<br/>';
	if (!gaddr)	err += '$invaddr.<br/>';
	if (!gphon)	err += '$invphone.<br/>';
	if (!gcode)	err += '$invps.<br/>'; 
	if (!gcoun)	err += '$invcountry.<br/>';
	if (err) 
		new jQuery.Zebra_Dialog(err, {'type':'error','title':'$guesterr'});
	else {
	jQuery.ajax({
		url: '{$ajaxurl}cartguestreg',
		type: 'POST',
		data: {FormAction: 'cartguestreg', email: email, name: gname, address: gaddr, tel: gphon, postcode: gcode, country: gcoun},
		success:function(postdata) {
			if (postdata) {
				jQuery('#guestdetails').html(postdata);
				if (gurl) {
					setTimeout(function(){  
						window.location.href = '$ajaxurl' + gurl;
					}, 1000);
				}	
			}		
	}}); }		
}
EOF;
		return $code;	
	}
	
	protected function js_addtocart() {

		$out = "	
function addtocart(id,cartdetails)
{
  var preselqty = Number(document.getElementById(id).value);
  var location = cartdetails+preselqty+'/';
  window.location.href = location;
};
";	
		return $out;
    }	
	
	protected function javascript() {

		if (defined('JAVASCRIPT_DPC')) {
			
			$code = $this->js_addtocart();	
			
			$js = new jscript;	
			$js->load_js($code,"",1);			   
			unset ($js);
		}			   	   	     
	}	
	
	//save cart details cookie	
	protected function js_storeCart() {
		$usr = $this->cusrid;

		if ($daystosave = _m('cms.paramload use ESHOP+saveCartCookie')) {	
		
			if ($this->notempty()) { 
			    /* disabled method
				$theCartData = $this->base64CartSession();
				$out = "cc('mycart','$theCartData',$daystosave);";
				*/
				$this->cookie_store_cart();
				$out .= "cc('pcart','$usr',$daystosave);";
			}
			else {
				/* disabled method
				$out = "cc('mycart','',-1);"; //remove
				*/
				$this->cookie_clean_cart();
				$out .= "cc('pcart','',-1);"; //remove
			}	
		
			if (!defined('JAVASCRIPT_DPC')) return false;		
			
			$js = new jscript;	
			$js->load_js($out,"",1);			   
			unset ($js);

			return true;	
		}
		return false;
	}
	
	//clean cart details cookie	
	protected function js_cleanCart() {
		$usr = $this->cusrid;
	
		if ($daystosave = _m('cms.paramload use ESHOP+saveCartCookie')) {
			
			$this->cookie_clean_cart();
			
			/* cc('mycart','',-1); */
			$out = "	
	cc('pcart','',-1);
";	
			if (!defined('JAVASCRIPT_DPC')) return false;
			
			$js = new jscript;	
			$js->load_js($out,"",1);			   
			unset ($js);

			return true;			
		}
		return false;	
	}	
	
	public function jsDialog($text=null, $title=null, $time=null, $source=null) {
		if (!defined('JAVASCRIPT_DPC')) return ;
		$_text = $text ? addslashes($text) : null;
		$_title = $title ? addslashes($title) : null;
		
	    $stay = $time ? $time : 3000;//2000;
	   
        /*if (defined('JSDIALOGSTREAM_DPC')) {
	   
			if ($text)	
				$code = _m("jsdialogstream.say use $_text+$_title+$source+$stay");
			else
				$code = _m('jsdialogstream.streamDialog use jsdtime');
		*/	
		if ((defined('JSDIALOGSTREAM_DPC')) && ($code = _m("jsdialogstream.say use $_text+$_title+$source+$stay"))) {
			
			$js = new jscript;	
			$js->load_js($code,null,1);		
			unset ($js);
	    }	
	}
	
	public function jsDialogFrame($url) {
		
		if ((defined('JSDIALOG_DPC')) && ($code = _m('jsdialog.zdialogFrame use '. $url))) {
			
			$js = new jscript;	
			$js->load_js($code,null,1);		
			unset ($js);
		}

		return null;	
	}
	
	public function jsDialogAjax($url) {
		//'buttons':  [{caption: 'Ok', callback: function() { alert('clicked')}}]
		$code = "new jQuery.Zebra_Dialog('', 
	{
		'source':  {'ajax': '$url'},
		width: 600,
		'buttons':  ['Cancel']
	});";
		
		if ((defined('JSDIALOG_DPC')) && ($code)) {//($code = _m('jsdialog.zdialogAjax use '. $url))) {
			
			$js = new jscript;	
			$js->load_js($code,null,1);		
			unset ($js);
		}

		return null;	
	}	

	//redirection when blank spaces exist when redir (headers sent)
	protected function _header($to=null) {
		if( !headers_sent() ){
			header("Location: " . $to);
		}
		else{
			echo '
			<script type="text/javascript">
			document.location.href="'. $to .'";
			</script>
			Redirecting to <a href="' . $to . '">'. $to .'</a>
			';
		}
		die();
	}
	
	protected function dispatch_pay_engines() {
		//$_payway = $this->superfastcart ? GetParam('payway') : GetSessionParam('payway');		
		$_payway = GetParam('payway') ?? GetSessionParam('payway');	//getparam = superfast
		
		$payway = strtoupper(trim($_payway));
		$finalCost = ($this->test2pay>0) ? $this->test2pay : $this->myfinalcost;
	    $urlgo = _v('cmsrt.httpurl') . '/cart-submit/';
		//echo  $payway.' '.$this->autopay;
		
		if (strcmp($payway,'PAYPAL')==0) {

			if (($this->status==3) && ($this->autopay>0)) {
				
				$this->submit_order();	
				SetSessionParam('paypalID',$this->transaction_id);
				SetSessionParam('amount',$finalCost);

				//reset global params
				SetSessionParam('TransactionID',0);
				SetSessionParam('cartstatus',0); 
				$this->status = 0;		  

				$this->_header($urlgo . strtolower($_payway) . '/');
				exit;
			}
		}
		elseif (strcmp($payway,'PIRAEUS')==0) {	

			if (($this->status==3) && ($this->autopay>0)) {

				$this->submit_order();		  
				SetSessionParam('piraeusID',$this->transaction_id);
				SetSessionParam('amount',$finalCost);

				//reset global params
				SetSessionParam('TransactionID',0);
				SetSessionParam('cartstatus',0); 
				$this->status = 0;		  
			
				$this->_header($urlgo . strtolower($_payway) . '/');
				exit;
			}
		}
		elseif (strcmp($payway,'EUROBANK')==0) {
			
			if (($this->status==3) && ($this->autopay>0))  {

				$this->submit_order();		  
				SetSessionParam('eurobankID',$this->transaction_id);
				SetSessionParam('amount',$finalCost);
				
				//reset global params
				SetSessionParam('TransactionID',0);
				SetSessionParam('cartstatus',0); 
				$this->status = 0;		  

				$this->_header($urlgo . strtolower($_payway) . '/');
				exit;
			}
		}	
		elseif (strcmp($payway,'VIVAPAY')==0) {
			
			if (($this->status==3) && ($this->autopay>0))  {

				$this->submit_order();		  
				SetSessionParam('vivapayID',$this->transaction_id);
				SetSessionParam('amount',$finalCost);
				
				//reset global params
				SetSessionParam('TransactionID',0);
				SetSessionParam('cartstatus',0); 
				$this->status = 0;		  

				//if ($this->superfastcart) && 
				/*if ((defined('SHVIVAPAY_DPC')) && ($create_payment = _m('shvivapay.viva_create_payment use 1'))) {
					//redirection here
					$this->_header(_v('shvivapay.viva_url') . '/web/checkout?ref=' . $create_payment->OrderCode);	
				}	
				else*/ 
					$this->_header($urlgo . strtolower($_payway) . '/'); //redirection to vivapay.php
				
				exit;
			}
		}		
		else { //simple order
	  
			if (($this->status==3) && ($this->submit_order(true))) { 
	  
				SetSessionParam('amount',null);					 								 
				SetSessionParam('subtotal',0);
				SetSessionParam('total',0);
				SetSessionParam('roadway',null);
				SetSessionParam('payway',null);	
				SetSessionParam('addressway',null);
				SetSessionParam('customerway',null);								 	   		   
				SetSessionParam('invway',null);	
				SetSessionParam('sxolia',null);								 
				SetSessionParam('qty_total',null);
			}
			
			SetSessionParam('transcost',null);
			SetSessionParam('paycost',null);
			SetSessionParam('shipcost',null);
			//echo 'submited';
		} 
	}		

	public function addtocart($item=null,$qty=null) {
		$db = GetGlobal('db');	
		
		$a = $item ? $item : GetReq('a');
		$_qty = $qty ? $qty : GetReq('qty'); 
		$cat = GetReq('cat');
		$page = 0;
		$stock_message = null;
		$addtocartTitle = localize('_BLN1', $this->lan);
		$nostockTitle = localize('_ADDMSG1', $this->lan);
		
		//init missing attr when item selected
		$this->itemqtyselect_misattr = false; 
		
		$_pSize = GetParam('selectpSize');
		$_pColor = GetParam('selectpColor');		
		//use when one field for 2 values //(upd:use psize or color attr)
		//$_pSizeColor = GetParam('selectpSizeColor'); 
		
		$_code = _v($this->shclass . '.fcode');		
		
		$sSQL = "select $_code,{$this->selectsql} from products  WHERE $_code ='" . $a . "'";	  
		$result = $db->Execute($sSQL,2);		
		
		if ($title = $result->fields['itmname']) { //check sql return value	

			$pp = _m($this->shclass . '.read_policy'); 	
		    $price = $result->fields[$pp];
			$priceqty = _m($this->shclass . ".read_qty_policy use ". $a.'+'.$price."++".$_qty);
			
			//qty meter method per item 22,21,2,1,0=default use global params
			$qtycalc_method = $result->fields['uniida'];
			//when size/color the item code has sizecolor attr as cart id
			$extCode = ($_pSize || $_pColor) ? $a . '['.$_pSize . $_pColor .']' : $a;
			//add size/color at item title
			$extTitle = ($_pSize || $_pColor) ? $this->replace_cartchars($title) .' ['.$_pSize.' '.$_pColor .']' : $title;
			
			//return qty 0 when qty < 0 
			$pqty = ($result->fields['ypoloipo1']<0) ? 0 : $result->fields['ypoloipo1'];
			
			$params = array(0=>$extCode, 
							1=>$extTitle, /*$this->replace_cartchars($title),*/
							2=>'',
							3=>'',
							4=>$cat,
							5=>$page,
							6=>'',
							7=>$a,
							8=>$priceqty,
							9=>1,
							10=>$_pSize,
							11=>$_pColor,							
							12=>$result->fields['uniname2'],
							13=>$result->fields['uni2uni1'],								
							14=>$pqty,
							15=>0,
							);	
			//print_r($params);
	   
			if ($this->getcartCount() < $this->maxcart) { //check cart maximum items

				$this->qty_total+=1;
				SetSessionParam('qty_total',$this->qty_total);
			
				$val = floatval(str_replace(',','.',$params[8]));
				$this->total = $this->total + $val;
				//echo '>',strval($params[8]),'+',$this->total;//,'+';print_r($params);//[8];
				SetSessionParam('total',$this->total);			
	   
				//get selected quantity number
				$preuni = GetParam("PRESELUNI");			
				$preqty = GetParam("PRESELQTY") ? GetParam("PRESELQTY") : ($_qty ? $_qty : 1);  
              
				if ((is_number($preqty)) && ($preqty>0)) {
					
					//if isset 2nd mm convert
					if (($this->uniname2) && ($preuni==$params[12])) {
						if ($params[13]) {
							$preqty = ($preqty * $params[13]); //2nd mm
						}	
						else {
							$preqty = 1; // default 1 qty
							$this->jsDialog("Error: Invalid qty uni2", localize('SHCART_DPC', $this->lan));
						}	
					}
					
					//check storage
					$qtycalc_param = $this->allowqtyover ? 11 : 1; //get more items than in db
					if ($this->ignoreqtyzero) {} else $qtycalc_param += 1; //check if db items is 0 or <0
					
					//per item calc or global param for all items
					$qtycalc = $qtycalc_method ? $qtycalc_method : $qtycalc_param; 
					//echo $qtycalc . '>>>';

					switch ($qtycalc) {
						case 12://check zero 
								if ($params[14]<=0) {
									$this->jsDialog(localize('_STOCKOUT',$this->lan), $addtocartTitle);
									break; //exit here
								}
						case 11://set qty = selection
								/*if ($this->itemHasQtySelection($params[7])) { //is size/color item
									$_ypoloipo1 = 0 ; //init (check zero -12- can be disabled)
									
									if ($_pSize || $_pColor) { //get qty from selection table
										$_ypoloipo1 = $this->itemHasQtySelection($params[7], true, $_pSize, $_pColor) - $this->qtyin($extCode);
										//continue
									}
									else {
										$this->jsDialog(localize('_ITEMQTYSELECT',$this->lan), $addtocartTitle);
										$this->itemqtyselect_misattr = true;
										return false;
									}	
								}
								else
									$_ypoloipo1 = $params[14] - $this->qtyin($extCode);
								*/
								if (($y = $this->pcheckQty($params[7], $params[14], $_pSize, $_pColor))===false)
									return false;
								
								$_ypoloipo1 =  $y - $this->qtyin($extCode); 
								//echo $_ypoloipo1 . '>>>>'. $y . 'aaa';
								
								if ($preqty > $_ypoloipo1) {
									$stockout = ($preqty - $_ypoloipo1);
									$stock_message = $this->replace_cartchars($params[1],true) ." ". localize('_STOCKOUT',$this->lan) . " (" . $stockout . ")";
									$this->jsDialog($stock_message, $nostockTitle);
																		
									//$preqty = $_ypoloipo1; //as calculated /entered with check
									$params[15] = $stockout; //save backorder
								}	
								$params[9]= $preqty; //overwrite								
								$this->addto(implode(";",$params));	
								break;
						
						case 2 ://check zero
								if ($params[14]<=0) {
									$this->jsDialog(localize('_STOCKOUT',$this->lan), $addtocartTitle);
									break; //exit here
								}	
						case 1 ://set qty = max in storage
								/*if ($this->itemHasQtySelection($params[7])) { //is size/color item
									$_ypoloipo1 = 0 ; //init (check zero -2- can be disabled)
									if ($_pSize || $_pColor) { //get qty from selection table
										$_ypoloipo1 = $this->itemHasQtySelection($params[7], true, $_pSize, $_pColor) - $this->qtyin($extCode);
										//continue
									}
									else {
										$this->jsDialog(localize('_ITEMQTYSELECT',$this->lan), $addtocartTitle);
										$this->itemqtyselect_misattr = true;
										return false;
									}	
								}
								else
									$_ypoloipo1 = $params[14] - $this->qtyin($extCode);
								*/
								if (($y = $this->pcheckQty($params[7], $params[14], $_pSize, $_pColor))===false)
									return false;
								
								$_ypoloipo1 =  $y - $this->qtyin($extCode); 
								
								if ($preqty > $_ypoloipo1) {
									$stockout = ($preqty - $_ypoloipo1);
									$stock_message = $this->replace_cartchars($params[1],true) ." ". localize('_STOCKOUT',$this->lan) . " (" . $stockout . ")";
									$this->jsDialog($stock_message, $nostockTitle);
									
									$preqty = $_ypoloipo1; 
									$params[15] = $stockout; //save backorder
								}	
								$params[9]= $preqty; //overwrite
								$this->addto(implode(";",$params));
								break;
								 
						case 0 :
						default: //as entered no checks
								/*if ($this->itemHasQtySelection($params[7])) { //is size/color item
									if ($_pSize || $_pColor) { 
										//continue
									}
									else {
										$this->jsDialog(localize('_ITEMQTYSELECT',$this->lan), $addtocartTitle);
										$this->itemqtyselect_misattr = true;
										return false;
									}	
								}
								*/
								if (($y = $this->pcheckQty($params[7], $params[14], $_pSize, $_pColor))===false)
									return false;
								
								//$_ypoloipo1 =  $y - $this->qtyin($extCode); 
								$params[9]= $preqty; //overwrite
								$this->addto(implode(";",$params));
					}	
				}
				else {
					$input_message = localize('_INPUTERR',$this->lan);
					$this->jsDialog($input_message, localize('SHCART_DPC', $this->lan));
				}

				//reset cart status when add item
				SetSessionParam('cartstatus',0);
				$this->status = 0;

				if ($user = $this->user ?? session_id())
					$this->update_statistics('cart-add', $user);
				
				//re-update prices and totals 
				$this->quick_recalculate();
			
				// as true and use val as js baloon				
				//return ($title); 
				if (!$stock_message) //if no prev message = stock message
					$this->jsDialog($this->replace_cartchars($extTitle,true), $addtocartTitle);
				
				return true;
			}
			else {
				//return localize('_MSG15',$this->lan);
				$this->jsDialog(localize('_MSG15',$this->lan), $addtocartTitle);
				return false;
			}	
			
		}
		else {
			$this->jsDialog('Error: Invalid item ID', localize('SHCART_DPC', $this->lan));
		}	
		 
		return false; 
	}
	
	//override
	public function remove($id=null,$qty=null) {
        //$myid = $id ? explode(';', $id) : explode(';', GetReq('a'));
		$myid = $id ? $id : GetReq('a');
		$_qty = $qty ? $qty : GetReq('qty'); //todo qty param -
		$ret = null;

		//print_r($this->buffer);
        reset ($this->buffer);           
        foreach ($this->buffer as $buffer_num => $buffer_data) {		
			
		    $param = explode(";",$buffer_data);
			$title = $this->replace_cartchars($param[1], true);
			
            //if ($param[0] == $myid[0]) {
			if (($param[0] == $myid) && $param[8] && $param[9]) {
				
	             $this->qty_total-=$param[9];
			     SetSessionParam('qty_total',$this->qty_total);	
				 
	             $this->total-=($param[8]*$param[9]);//price * qty
			     SetSessionParam('total',$this->total);					 	   
		    
                 $this->buffer[$buffer_num] = "x";  
				 $ret = $title; //js baloon
                 break;
            }                                   
        }

		if ($ret) {	
			$this->setStore();
		
			if ($user = $this->user  ?? session_id())
				$this->update_statistics('cart-remove', $user);
		
			$this->quick_recalculate();	//re-update prices and totals	
		
			return ($ret);
		}
		
		return false;
	}

	//override
    public function isin($id) {

        reset ($this->buffer); 
        foreach ($this->buffer as $buffer_num => $buffer_data) {
		   $param = explode(";",$buffer_data);	
           if ($param[0] == $id) return true;                                    
        }                       
        return false;
    } 	
	
	//override
	public function clear() {
		parent::clear();
		
		$this->js_cleanCart();
	}

	//override with arg (cookie use)
    /*public function notempty($buffer=null) {
        $b = $buffer ? $buffer : $this->buffer;
		
        reset ($b); 
        while (list ($buffer_num, $buffer_data) = each ($b)) {
           $mchar = strlen($buffer_data); 
           if ($mchar > 1) return true;
        }                       
        return false;
    }*/		
	
	//fetch item cart qty already selected
    public function qtyin($id, $backorder=false) {

        reset ($this->buffer); 
        foreach ($this->buffer as $buffer_num => $buffer_data) {
		   $param = explode(";",$buffer_data);	
           if ($param[0] == $id) return ($backorder ? $param[15] : $param[9]);  
        }                       
        return false;
    } 	
	
	public function getDetailSelection($selection=null) {
		if (!$selection) return null;

		$ret = GetParam($selection) ? GetParam($selection) :
									  GetSessionParam($selection);
		//echo $selection.':'.$ret.'<br/>';									  
		return ($ret);							  
	}	
	
    public function submit_order($doSubmit=false) {
		$payway = $this->getDetailSelection('payway');
		$roadway = $this->getDetailSelection('roadway');
		$invway = $this->getDetailSelection('invway');	
		$sxolia = $this->getDetailSelection('sxolia');
		
		//get customer at auto-login when in superfast mode
		$customer = ($this->superfastcart) ? _v('shcustomers._customerway') : $this->getDetailSelection('customerway');		
		$fkey = 'id';
		
		$user = $this->user;
		$submit = false;	

		$this->quick_recalculate();
	   	   
		$qty = $this->qty_total;//getcartItems();
		$cost = str_replace(',','.',$this->total);//getcartTotal());
		$costpt = str_replace(',','.',$this->myfinalcost);//getcartSubtotal());
		//echo $this->qtytotal,'-',$this->total;
		
		try {

			if (defined('SHTRANSACTIONS_DPC'))  {
				//set this trid	
				$this->transaction_id = _m('shtransactions.saveTransaction use '.serialize($this->buffer)."+$user+$payway+$roadway+$qty+$cost+$costpt");
                //echo 'TRID:' . $this->transaction_id . ' USER:' . $user;
				
				if ($invoiceTemplate = $this->twig_invoice_template_name) {
			
					$date = date('d.m.y');			
					$invoice_tokens['invoice'] = localize('_ORDERSUBJECT',$this->lan).' '.$this->transaction_id;
					$invoice_tokens['mynotes'] = $sxolia . "<br/>" . $this->ppolicynotes;
					$invoice_tokens['mydate'] = $date;	
					$invoice_tokens['payway'] = localize($payway, $this->lan); 			
					$invoice_tokens['roadway'] = localize($roadway, $this->lan);
					$invoice_tokens['invway'] = localize($invway, $this->lan);
			  
					$tokens = serialize($invoice_tokens);

					_m('shtransactions.saveTransactionHtml use '.$this->transaction_id.'+'.$tokens.'+'.$invoiceTemplate."+$customer+$fkey");	
					
					//save trid as printout var for print purposes
					$this->printout = $this->transaction_id;
					SetSessionParam('printout',$this->printout);			
				}
				else { //standart template
					$tokens[] = $this->transaction_id;
					$tokens[] = _m('shcustomers.showcustomerdata use ++cusdetails');
					$tokens[] = GetSessionParam('orderdetails');
					$tokens[] = GetSessionParam('ordercart');
					
					_m('shtransactions.saveTransactionHtml use '.$this->transaction_id.'+'.serialize($tokens).'+shcartprint.htm'."+$customer+$fkey");								 							 
				}			 
			}
			else
				$this->transaction_id = '11';//dummy

			if (isset($this->transaction_id)) {
				//save in session
				SetSessionParam('TransactionID',$this->transaction_id);

				if ($doSubmit==true) {
					$submit = $this->submitCartOrder($this->transaction_id);
				}
				else //else submitCartOrder called by payengines when end of procedure
					$submit = true;
			}	
			else {
				$this->submiterror = 'Invalid transaction ID.';
				$this->update_statistics('cart-error-' . $this->submiterror, $this->user);		
				
				//popup message
				$this->jsDialog(localize('_CARTERROR', $this->lan) ,localize('_CART', $this->lan),6000);		
			}	
		}
		catch(Exception $e){
			
			//stackoverflow.com/questions/1214043/find-out-which-class-called-a-method-in-another-class	
			//list($childClass, $caller) = debug_backtrace(false, 2);				
			echo "[$caller -> $childClass]:";
			
			echo $e->getMessage(); 
			throw $e;
		}

		return $submit;	
    }
	
	//used by pay engines
	public function cancel_order() {
		SetSessionParam('cartstatus',0); 
		$this->status = 0; 

		$this->jsBrowser();	
		$this->fbjs();	
	}
	
	//alias, used by pay engines
	public function cancelCartOrder() {
		//$this->cancel_order(); //!!! not affceted
		
		//$this->quick_recalculate();
	}	
	
	//used by pay engines when comeback
	public function submitCartOrder($trid=null,$subject=null) {

		if ($this->testcart) { /* TEST MODE */}
		else {
			//when come back from pay engines with trid may the trid != this.trid		
			//get transaction id from session when return
			if ($ses_transaction_id = GetSessionParam('TransactionID')) {		
				if ((!$trid) || ($trid != $ses_transaction_id)) {
					//send suspicious mail
					$from = $this->cartsend_mail;
					$subj = "Suspicious transaction $trid : " . $this->transaction_id;
					$body = str_replace('+','<SYN/>','Please check this transaction id!'); 
					_m("cmsrt.cmsMail use $from+{$this->cartreceive_mail}+$subj+$body");
				}			
			}
			//else trid= this->trid and trid in session is null (simple order)
		}	
			
		$_trid = $trid ? $trid : $this->transaction_id;	
			
		if (!$error = $this->goto_mailer($_trid, $subject)) { 
			
			if ($this->cartPurchase()===true) {
				
				$this->analytics(null, $_trid);
				$this->logcart();
				$this->savePoints($this->user ,$_trid);
			
				//transport save
				if (defined('TRANSPORT_DPC')) 
					_m("transport.finalize use $_trid+" . $this->shippingcost);						

				$this->update_statistics('cart-submit', $this->user);
				
				$this->clear();				
				return true;
			}
			//else
			//popup message
			$this->submiterror = 'Internal DB error.';
			$this->jsDialog('Internal DB error, trID:' . $_trid, 
							localize('_CART', $this->lan),6000);				
			return false;
		}

		$this->mailerror = $error; //set mail error
		$this->update_statistics('cart-error-' . $this->mailerror, $this->user);		
		
		//popup message
		$this->jsDialog(localize('_CARTERROR', $this->lan) .' '. $this->mailerror ,	localize('_CART', $this->lan),6000);		
		
		return false;	
	}

	protected function goto_mailer($trid=null, $subject=null) {
	
	    if ($mytrid = $this->printout) {
			//fetch saved transaction html body
			$mailout = _m('shtransactions.getTransactionHtml use '.$mytrid);
		}
        else {		
			$details  = '<br/>'.localize('_PWAY',$this->lan) .':'. GetSessionParam('payway');
			$details .= '<br/>'.localize('_RWAY',$this->lan) .':'. GetSessionParam('roadway');
			$details .= '<br/>'.localize('_IWAY',$this->lan) .':'. GetSessionParam('invway');	   
			$details .= '<br/>'.localize('_DELIVADDRESS',$this->lan) .':'. GetSessionParam('addressway');	   
			$details .= '<br/>'.localize('_SXOLIA',$this->lan) .':'. GetSessionParam('sxolia');		   	  

			if ($invoiceTemplate = $this->twig_invoice_template_name) {
				//init tokens
				$invoice_tokens = array();
				$invoice_tokens['trid']       = $trid;
				$invoice_tokens['payway']     = localize(GetSessionParam('payway'), $this->lan);
				$invoice_tokens['roadway']    = localize(GetSessionParam('roadway'), $this->lan);
				$invoice_tokens['invway']     = localize(GetSessionParam('invway'), $this->lan);
				$invoice_tokens['addressway'] = GetSessionParam('addressway');
				$invoice_tokens['sxolia']     = GetSessionParam('sxolia');		   
				$invoice_tokens['cusdata']    = (array) _m('shcustomers.showcustomerdata use +++1');//array();	  
				$invoice_tokens['cartdata']   = (array) $this->quickview(true); //array of array lines		   
		    
				$x = 'notes123';//.var_export($invoice_tokens, true);
				$date = date('d.m.y');			
				//$invoice_tokens['invoice'] = GetSessionParam('invway') .' '. $trid;
				$invoice_tokens['invoice'] = localize('_ORDERSUBJECT',$this->lan) .' '. $trid; 
				$invoice_tokens['mynotes'] = GetSessionParam('sxolia');//$x;
				$invoice_tokens['mydate'] = $date;
				if (defined('TWIGENGINE_DPC')) {
					$t = array('invoice'=>GetSessionParam('invway') .' '. $trid,
								'mynotes'=>$x,
								'mydate'=>$date);
					$tokens = serialize($invoice_tokens);
					$mailout = _m("twigengine.render use $invoiceTemplate_name++$tokens");
				}
				else { //standart template
					$mycarttemplate = _m("cmsrt.select_template use shcartmail");		  
					$mailout .= $this->combine_tokens($mycarttemplate,$tokens,true);		
					$mailout .= '<!--end of document-->';	
				}
			} //standart template		  
			else {
				$tokens = array();
				$mycarttemplate = _m("cmsrt.select_template use shcartmail");
				$tokens[] = $trid;
				$tokens[] = _m('shcustomers.showcustomerdata use ++cusdetails');			
				$tokens[] = $details;
				$tokens[] = $this->quickview(); //no need to call session param ordercart
				$mailout = $this->combine_tokens($mycarttemplate,$tokens,true);		
				$mailout .= '<!--end of document-->';
			}
        }//printout		  
	   
	    //MAIL SUBJECT
	    $mailSubject = $subject ? $subject : 
						(($this->ordermailsubject) ? str_replace('@', $trid, $this->ordermailsubject) :	localize('_ORDERSUBJECT',$this->lan) . $trid);			
						
		if ($this->testcart) { /* TEST MODE */}
		else {
			//MAIL THE ORDER TO HOST
			$err1 = $this->cart_mailto($this->cartreceive_mail,$mailSubject,$mailout);
		
			//TO CUSTOMER
			$err2 = $this->cart_mailto($this->user, $mailSubject, $mailout);		    			  
		}  
		
		//null for true  
		//return ($err1 ? $err1 : ($err2 ? $err2 : null));
		//IN CASE OF EUROBANK RETURN err2 = 454 4.7.1 : Relay access denied for mail ($this->user)
		//TEMPORARY DISABLE err2
		
		return ($err1 ? $err1 : null);
	}	
	
    public function printorder() {

	    //DO NOT RE-RENDER PRINT OUT..
	    if ($trid = $this->printout) {
			$out = _m('shtransactions.getTransactionHtml use '.$trid);
			SetSessionParam('printout',null); //reset
			return ($out);
		}
		
	    $headtitle = paramload('SHELL','urltitle');	
		$this->transaction_id = $this->transaction_id ? 
								$this->transaction_id : GetReq('trid');
				
	
		if (!$mystyle = remote_paramload('SHCART','printstyle',$this->path))
			$mystyle = 'themes/style.css';
		  
		if (!$mytitle = remote_paramload('SHCART','printtitle',$this->path)) {		
			$mytitle = "<h1>$headtitle | Order No:".$this->transaction_id."</h1>";
			$tokens[] = $this->transaction_id;
		}  
		else {
			$mytitle = "<h1>$mytitle | Order No:".$this->transaction_id."</h1>";
			$tokens[] = $this->transaction_id;
		}  
		
	    $bprint = _m('javascript.JS_function use js_printwin+'.localize('_PRINT',$this->lan));
        $tokens[] =  $bprint;			

        if ($invoiceTemplate = $this->twig_invoice_template_name) { 
		
			//init-reset tokens
			$invoice_tokens = array();
			$invoice_tokens['trid'] = $this->transaction_id;
			$invoice_tokens['sxolia'] = GetSessionParam('orderdetails');
            //$cus = GetSessionParam('customerway'); 			
			$invoice_tokens['cusdata'] = (array) _m("shcustomers.showcustomerdata use +++1");	  
			$invoice_tokens['cartdata'] = GetSessionParam('ordercart');		   
		    
			$x = 'notes123';//.var_export($invoice_tokens, true);
			$date = date('d.m.y');			
			//$invoice_tokens['invoice'] = GetSessionParam('invway') .' '.$this->transaction_id;
			$invoice_tokens['invoice'] = localize('_ORDERSUBJECT',$this->lan).' '.$this->transaction_id;
			$invoice_tokens['mynotes'] = GetSessionParam('sxolia');//$x;
		    $invoice_tokens['mydate'] = $date;				
				
		    if (defined('TWIGENGINE_DPC')) {
			    $date = date('m.d.y');
				$x = 'notes123';//.var_export($invoice_tokens, true);
			    $t = array('invoice'=>GetSessionParam('invway') .' '.$this->transaction_id,
				           'mynotes'=>$x,
						   'mydate'=>$date);
			    $tokens = serialize($t);
			    echo _m("twigengine.render use $invoiceTemplate++$tokens");
				//echo 'z';
				die();
		    }
			else {
				$myprintcarttemplate = 	_m('cmsrt.select_template use shcartprint');	
				$out = $this->combine_tokens($myprintcarttemplate,$tokens,true);		
				$out .= '<!--end of document-->';		
			}
        }  		
	    else { 
			$myprintcarttemplate = _m('cmsrt.select_template use shcartprint');
			$tokens[] = _m('shcustomers.showcustomerdata use ++cusdetails');
			$tokens[] = GetSessionParam('orderdetails');
			$tokens[] = GetSessionParam('ordercart');					  
			$out = $this->combine_tokens($myprintcarttemplate,$tokens,true);
	    }

		return ($out);
	}	

    //called from step to step full recalc with uni2uni1 convertions  and storage check methods
    public function recalculate() {
		$db = GetGlobal('db');
		$this->stock_msg = null;
		$this->overitem = null;
		$_go = true;
		
		$this->read_policy();	   		
	   
		$this->qty_total = 0;
		SetSessionParam('qty_total',0);
		$this->total = 0;      
		
		$_code = _v($this->shclass . '.fcode');	
		$pp = _m($this->shclass . '.read_policy'); 			

		$counter = 0; 
		foreach ($this->buffer as $prod_id => $product) {

			if (($product) && ($product!='x')) {
           
				$counter += 1;
				$param = explode(";", $product); //print_r($param);
				$aa = $prod_id + 1;		
		   
				//selected quantity  ..get ? get : post when select is onChange
				$selectedqty = GetReq("Product$aa") ? GetReq("Product$aa") : 
								(GetParam("Product$aa") ? GetParam("Product$aa") : intval($param[9])); 

				//selected uniname convert from 2nd mm
				if ($selecteduni = GetParam("Uniname$aa")) {
					if (($selecteduni == $param[12]) && ($param[13]))  //if selected = 2nd mm
						$selectedqty = ($selectedqty * $param[13]); //multiply by sxesh mm2
				}						
				
				$this->qty_total += $selectedqty;
	
				//extCode : when size/color the item code has sizecolor attr as cart id, remove it before sql it
				//$_realCode = ($param[10] || $param[11]) ? str_replace(array($param[10], $param[11],'[',']'), '', $param[0]) : $param[0];
				//https://stackoverflow.com/questions/19948660/how-to-replace-everything-between-braces-from-a-string
				$_realCode = $param[7]; //preg_replace('/[\[].*?[\]]/', '', $param[0]); //by default with no question / param[7]
				
				$sSQL = "select $_code,{$this->selectsql} from products  WHERE $_code ='" . $_realCode . "'";	  
				$result = $db->Execute($sSQL,2);
				if ($title = $result->fields['itmname']) { //check sql return value	

					$price = $result->fields[$pp];
					$ap_price = _m($this->shclass . ".read_qty_policy use ". $_realCode.'+'.$price."++".$selectedqty);			 		   			 
					$param[8] = $ap_price; //update
					$param[14] = $result->fields['ypoloipo1']; //update
					
					$this->total = $this->total + ($selectedqty * $ap_price); //update				
					
					//check storage					
					$qtycalc_method = $result->fields['uniida'];
					$qtycalc_param = $this->allowqtyover ? 11 : 1; //get more items than in db
					if ($this->ignoreqtyzero) {} else $qtycalc_param += 1; //check if db items is 0 or <0
					
					//per item calc or global param for all items
					$qtycalc = $qtycalc_method ? $qtycalc_method : $qtycalc_param; 
					
					switch ($qtycalc) {
						case 12://check zero 
								if ($param[14]<=0) {
									$stock_message = $this->replace_cartchars($param[1],true) ." ". localize('_STOCKOUT',$this->lan);
									$this->stock_msg .= $stock_message . "<br>";
									
									$param[9]= 0; //zero item qty
									if ($this->rejectqty)
										$this->buffer[$prod_id] = 'x';//=0 so delete it from list
									else
										$this->buffer[$prod_id] = implode(";", $param);
									break; //exit here
								}
						case 11://set qty = selection
								if ($this->itemHasQtySelection($_realCode)) {
									$_ypoloipo1 = 0; //init (check zero -12- can be disabled)
									if ($param[10] || $param[11]) { //get qty from selection table
										$_ypoloipo1 = $this->itemHasQtySelection($_realCode, true, $param[10], $param[11]);
										//continue
									}
									else {
										//$this->jsDialog(localize('_ITEMQTYSELECT',$this->lan), localize('SHCART_DPC', $this->lan));
										//return false;
										$this->stock_msg .= $this->replace_cartchars($param[1],true) ." ". localize('_ITEMQTYSELECT',$this->lan) . "<br>";
									}	
								}
								else
									$_ypoloipo1 = $param[14];
								
								if (($selectedqty > $_ypoloipo1)) {
									$stockout = ($selectedqty - $_ypoloipo1);
									$stock_message = $this->replace_cartchars($param[1],true) ." ". localize('_STOCKOUT',$this->lan) . " (" . $stockout . ")";
									$this->stock_msg .= $stock_message . "<br>";
																		
									$param[9] = $selectedqty;//as calculated /entered with check
									$param[15] = $stockout; //save backorder
									
									$this->overitem[$prod_id] = $stockout; //remark backorder item
								}	
								$param[9]= $selectedqty; //as is
								$this->buffer[$prod_id] = implode(";", $param);
								break;
						
						case 2 ://check zero								
								if ($param[14]<=0) {
									$stock_message = $this->replace_cartchars($param[1],true) ." ". localize('_STOCKOUT',$this->lan);
									$this->stock_msg .= $stock_message . "<br>";
									
									$param[9]= 0; //zero item qty
									if ($this->rejectqty)
										$this->buffer[$prod_id] = 'x';//=0 so delete it from list
									else
										$this->buffer[$prod_id] = implode(";", $param);
									break; //exit here
								}	
						case 1 ://set qty = max in storage
								if ($this->itemHasQtySelection($_realCode)) {
									$_ypoloipo1 = 0; //init (check zero -12- can be disabled)
									if ($param[10] || $param[11]) { //get qty from selection table
										$_ypoloipo1 = $this->itemHasQtySelection($_realCode, true, $param[10], $param[11]);
										//continue
									}
									else {
										//$this->jsDialog(localize('_ITEMQTYSELECT',$this->lan), localize('SHCART_DPC', $this->lan));
										//return false;
										$this->stock_msg .= $this->replace_cartchars($param[1],true) ." ". localize('_ITEMQTYSELECT',$this->lan) . "<br>";
									}	
								}
								else
									$_ypoloipo1 = $param[14];
								
								if (($selectedqty > $_ypoloipo1)) {
									$stockout = ($selectedqty - $_ypoloipo1);
									$stock_message = $this->replace_cartchars($param[1],true) ." ". localize('_STOCKOUT',$this->lan) . " (" . $stockout . ")";
									$this->stock_msg .= $stock_message . "<br>";
									
									$param[9] = $_ypoloipo1; //overwrite
									$param[15] = $stockout; //save backorder
									
									$this->overitem[$prod_id] = $stockout; //remark backorder item
								}	
								$param[9]= $selectedqty; //as is
								$this->buffer[$prod_id] = implode(";", $param);
								break;
								 
						case 0 :
						default: //as entered no checks
								if ($this->itemHasQtySelection($_realCode)) {
									if ($param[10] || $param[11]) { 
										//$_ypoloipo1 = $this->itemHasQtySelection($_realCode, true, $_pSize, $_pColor);
										$param[9]= $selectedqty; //as is
										$this->buffer[$prod_id] = implode(";", $param);
									}
									else {
										//$this->jsDialog(localize('_ITEMQTYSELECT',$this->lan), localize('SHCART_DPC', $this->lan));
										//return false;
										$this->stock_msg .= $this->replace_cartchars($param[1],true) ." ". localize('_ITEMQTYSELECT',$this->lan) . "<br>";
									}	
								}
								else {
									$param[9]= $selectedqty; //as is
									$this->buffer[$prod_id] = implode(";", $param);
								}
					}						
				}
			}
		}
		
		$this->setStore();

		//message for all items
		//if ($jcode)
		if ($this->stock_msg) {
			$nostockTitle = localize('_ADDMSG1', $this->lan);
			$this->jsDialog($this->stock_msg, $nostockTitle); 
			//if ($this->detailqty)
				//$this->sxolia .= $stock_message;
			
			if (!$this->backorders)
				$_go = false; //NEVER GOES TO NEXT STEP WHEN FALSE <<<<<<<<<<<<<
		}	
	   
		if ($this->itemscount)
			SetSessionParam('qty_total',$counter);//items count
		else
			SetSessionParam('qty_total',$this->qty_total);//qty count 
		 
		//$this->calculate_shipping(); //deprecated	 		 
		$this->calcShipping();
		
		return $_go;
	}
	
    public function setquantity($id,$qty=null) {

		$r = $this->readonly ? 'readonly' : null;

		$qtyname = $id ;
		$myqty = is_numeric($qty) ? $qty : 0;
		$selectedqty = GetParam($qtyname) ? GetParam($qtyname) : $myqty;
	  
		if (!$this->status) { //only if status=0 else when cart status > 0 qty change
	  
			if (($this->maxqty<0) || ($this->readonly)) { //free style
		    
				$onchange = "onkeyup=computeqty('$qtyname',0)"; 
				$onclickadd = "onclick=computeqty('$qtyname',1)";
				$onclickreduce = "onclick=computeqty('$qtyname',-1)";
				
				if ($myqtytemplate = _m('cmsrt.select_template use shcartlineqty')) {
					
					$qtytokens = array();
					$qtytokens[] = $qtyname;
					$qtytokens[] = $selectedqty;
					$qtytokens[] = $onchange;
					$qtytokens[] = $onclickadd;
					$qtytokens[] = $onclickreduce;
					$out = $this->combine_tokens($myqtytemplate, $qtytokens);
				}	
				else {
					$out = $this->minus ? "<a class='$this->minus' href='#reduce' $onclickreduce></a>" : null;
					$out.= "<input id=\"$qtyname\" name=\"$qtyname\" $onchange value=\"$selectedqty\" size=\"{$this->maxlength}\" maxlength=\"{$this->maxlength}\" $r >";//<<4 max lenght of qty		  
					$out.= $this->plus ? "<a class='$this->plus' href='#add' $onclickadd></a>" : null;
				}	
			}
			else { //combo style
		  
				$url_location = $this->url . '/calc/'; 
		  
				$out = "<SELECT class=\"myf_select_tiny\" name=\"$qtyname\" "; //>"
				$out .= "onChange=\"location='$url_location'+'$qtyname'+'/'+this.options[this.selectedIndex].value+'/'\">"; 
				//$out .= "onChange=\"this.form.submit()\">";
				for ($j=1;$j<=$this->maxqty;$j++) {
					if (($selectedqty) && ($selectedqty==$j)) 
						$out .= "<OPTION value='$j' selected>$j";
					else $out .= "<OPTION value='$j'>$j";
				}  
				$out .= "</OPTION></SELECT>";
			}	
		}
		else
			$out = $qty; 
		  
		return ($out);
	}	

    public function showsymbol($id,$allowremove=null,$qty=null) {
	//public function showsymbol($id,$group,$page,$allowremove=null,$qty=null) {	
		$myqty = $qty ? $qty : 1; 
		$param = explode(";",$id);

		$page = isset($param[5]) ? $param[5] : 0;
		$gr = isset($param[4]) ? $param[4] : null; 
		$ar = isset($param[0]) ? $param[0] : null; //$id;

		$price = isset($param[8]) ? $param[8] : 0; 
		$ypoA = isset($param[14]) ? $param[14] : 0;
		if (floatval(str_replace(",",".",$price))>0.001) {//check price
			//if ((!$this->ignoreqtyzero) && ($ypoA>0)) {//check availability..NOT WORK

			if (!($this->isin($param[0]))) {

				if ($this->bypass_qty) { //echo 'bypass_qty';
					$ml = "addcart/$ar/";
					$ml.= $gr ? "$gr/" : null;
					$ml.= $page ? "$page/" : null;
					$ml.= $myqty ? "$myqty/" : null;					

					$out = "<form method=\"POST\" action=\"";
					$out .= $ml;
					$out .= "\" name=\"PreSelectQty\">";
					$out .= $this->setquantity('PRESELQTY',1);

					if (($this->uniname2) && ($param[11]))
						$out .= "<br/>" . $this->setuniname('PRESELUNI',$param[10],$param[10],$param[11]);

					$out .= $this->submit_qty_button;
					$out .= "</form>";
				}
				else {
					$ml = "addcart/$ar/";
					$ml.= $gr ? "$gr/" : null;
					$ml.= $page ? "$page/" : null;
					$ml.= $myqty ? "$myqty/" : null;						
				}	
				
				$out = $this->myf_button(localize('_INCART',$this->lan),$ml,'_INCART');
			}
			else {
		   
				if (($this->notallowremove)&&(!$allowremove)) {//add again 		   	 		   
					$ml = "addcart/$ar/";
					$ml.= $gr ? "$gr/" : null;
					$ml.= $page ? "$page/" : null;
					$ml.= $myqty ? "$myqty/" : null;			 
					$out = $this->myf_button(localize('_INCART',$this->lan),$ml,'_INCART');
				}	 
				else {//remove 		   	 		   
					$mr = "remcart/$ar/";
					$mr.= $gr ? "$gr/" : null;
					$mr.= $page ? "$page/" : null;
					$mr.= $myqty ? "$myqty/" : null;						

					$out = $this->removeitemclass ? 
							"<a class='{$this->removeitemclass}' href='$mr'></a>" :
							$this->myf_button(localize('_REMCARTITEM',$this->lan),$mr,'_REMCARTITEM');    
				}	 
			}
			//}
			//else $out = $this->notavail;
		}
		else {
			if (!($this->isin($param[0]))) 
				$out = $this->myf_button($this->_NOTAVAL,_m('cmsrt.php_self use 1') . '#notavailable','_NOTAVAL');
			
			if ($allowremove) {
				$mr = "remcart/$ar/";
				$mr.= $gr ? "$gr/" : null;
				$mr.= $page ? "$page/" : null;
				$mr.= $myqty ? "$myqty/" : null;				

				$out .= $this->removeitemclass ? 
						"<a class='{$this->removeitemclass}' href='$mr'></a>" :
						$this->myf_button(localize('_REMCARTITEM',$this->lan),$mr,'_REMCARTITEM');		
			}		
		}	

		return ($out);
	}


	public function cartview($trid=null, $status=null) {
		$cat = GetReq('cat');
		$pview = $cmd ? $cmd : 'klist';
		$UserName = decode(GetGlobal('UserName')); 		
		$payway = $this->getDetailSelection('payway');
		$roadway = $this->getDetailSelection('roadway');
		$invway = $this->getDetailSelection('invway'); 
		
		if ($trid) //calldpc view case && PAYENGINES return 
			$this->transaction_id = $trid;		
		
		if ($status) {//calldpc view case && PAYENGINES return 
			$this->status = $status; 
			$this->recalculate(); 			
		}	
			
		//$myaction = _m('cmsrt.url use t=viewcart'); 
		switch ($this->status) {
			case 1  : 	$myaction = _m('cmsrt.url use t=cart-order'); break;
			case 2  : 	$myaction = _m('cmsrt.url use t=cart-submit');	break;
			case 0  :			
			default : 	$myaction = _m('cmsrt.url use t=cart-checkout'); 
		}		   
	    /*
		/////////////////////////////////////////////// 
		if ((empty($_POST)) && (!$this->notempty())) {
		
			$tokens[] = localize('_EMPTY',$this->lan);
			$emptycarttemplate = _m('cmsrt.select_template use shcartempty');
			
			return $this->combine_tokens($emptycarttemplate,$tokens,true);			
		}
		//////////////////////////////////////////////
		
 		//$status = $status ? $status : GetReq('status'); //PAYENGINES (DISABLE _GET status)  
		if ($status) { //PAYENGINES
			$this->status = $status;
			$this->recalculate(); 
		}	
	    */
		//if recalculate fails or calldpc view case && PAYENGINES return 
		if (empty($this->loopcartdata)) 
			$this->loopcartdata = $this->loopcart();
		if (empty($this->looptotals)) 
			$this->looptotals = $this->foot();	     	   
		
		if ($this->status<3) {

			if ($this->notempty()) {
           		   
				$tokens[] = $myaction;

				if ($this->status==2) {

					//get customer data or register new customer
					if (defined('SHCUSTOMERS_DPC')) {
						$mydate = date('d/m/Y h:i:s A'); //$this->make_gmt_date();
						
						if ($existed_customer = _m('shcustomers.showcustomerdata use ++cusdetails')) {
							//existed customer
							
							$tokens[] = $mydate;
							$tokens[] = $existed_customer;
							
							//continue cart
						}
						else {
							if ($UserName) { //user is logged in
							
							    //when fastcart auto-login is set to go to step2
								if ($this->fastcart) { //customer data exist with auto-login
									//case guest user auto-login
									//echo 'FASTCART AUTO-LOGIN STATUS 2';
									$tokens[] = $mydate;
									
									//after new customer reg
									$new_customer = _m('shcustomers.showcustomerdata use ++cusdetails');
									$tokens[] = $new_customer ?? array(0=>'No customer data');
									
									//continue cart
								}
								else {	//customer data not exist
									//register now
									$customer_regform = _m('shcustomers.register');
								
									//after new customer registration return to step 0
									SetSessionParam('cartstatus',0);
									$this->status = 0;
								
									return ($customer_regform); //exit now 
								}	
							}	
							else {	//user is NOT logged in
							
								if ($this->fastcart) {  
									//echo 'FASTCART STATUS 2';
									$tokens[] = $mydate;
									
									//after new customer reg
									$new_customer = _m('shcustomers.showcustomerdata use ++cusdetails');
									$tokens[] = $new_customer ?? array(0=>'No customer data');
									
									//continue cart
								}
								else { //test NO fastcart
									$customer_regform = _m('shcustomers.register');	//ACCESS DENIED
									return ($customer_regform); //exit now
								}	
							}
						}
					}
				}
				elseif ($this->status==1) {
					
					if (defined('SHCUSTOMERS_DPC')) {
						if ($cid = GetSessionParam('_customerway')) //default customer id _
							$_cus = $UserName ? _m("shcustomers.showcustomerdata use $cid+id+cusdetails") : null;
						else
							$_cus = $UserName ? _m("shcustomers.showcustomerdata use $UserName+code2+cusdetails") : null;			
					
						//if ($existed_customer = (defined('SHCUSTOMERS_DPC')) ? ($UserName ?  _m("shcustomers.showcustomerdata use $cid+id+cusdetails") : null) : null) {
						$tokens[] = date('d/m/Y h:i:s A');
						$tokens[] = $_cus; //$existed_customer;
					}
					else {
						$tokens[] = null;
						$tokens[] = null;//'xaxaxaxa'. $UserName. '>>>' . _m("shcustomers.showcustomerdata use $UserName+code2+cusdetails");
					}	
				}	
				else { //status 0
					$tokens[] = null;
					$tokens[] = null;
				}

				//loop cart
				$tokens[] = $this->loopcartdata;

				//footer
				$tokens[] = $this->looptotals;	   	   

				//calc
				$this->calculate_totals();
				
				switch ($this->status) {
			 
					case 1  : 	break;
						 
					case 2  :   SetSessionParam('ordercart',$this->quickview());
					            //print_r($_POST);
								$details  = '<br/>'.localize('_PWAY',$this->lan) . ':'. GetParam('payway');
								$details .= '<br/>'.localize('_RWAY',$this->lan) . ':'. GetParam('roadway');
								$details .= '<br/>'.localize('_IWAY',$this->lan) . ':'. GetParam('invway');	   
								$details .= '<br/>'.localize('_DELIVADDRESS',$this->lan) . ':'. GetParam('addressway');	   
								$details .= '<br/>'.localize('_SXOLIA',$this->lan) .':'. GetParam('sxolia');		   
								SetSessionParam('orderdetails',$details);
								//echo $details;
								break;
						 
					case 0  :	 
					default : 	
						    
				}
			 
				$tokens[] = null;
				$tokens[] = null;				 
			}
			else { //empty
				$tokens[] = localize('_EMPTY',$this->lan);	 		   
			}
			/////////////////////////////////////////////////////////////
			$tstep = $this->status ? strval($this->status) : '0';	
			$mysteptemplate = _m('cmsrt.select_template use shcartstep' . $tstep);
			$mycarttemplate = isset($mysteptemplate) ? $mysteptemplate : _m('cmsrt.select_template use shcart');

			$out = $this->combine_tokens($mycarttemplate,$tokens,true);
			return $out;			
			
	    }
	    else {//status>=3
	        //echo  $this->status . '>>>>>>>>' . $this->submiterror . '-'.$this->mailerror .'<br/>';
			
			if (defined('SHCUSTOMERS_DPC')) {
				if ($this->superfastcart) { 
					//$cid = GetSessionParam('_customerway'); //not yet session param
					//$existed_customer = $UserName ? _m("shcustomers.showcustomerdata use $cid+id+cusdetails") : null;
					$cid = GetParam('guestemail');
					$existed_customer = _m("shcustomers.showcustomerdata use $cid+code2+cusdetails");
				}
				elseif ($this->fastcart) {
					$cid = GetSessionParam('_customerway');
					$existed_customer = $UserName ? _m("shcustomers.showcustomerdata use $cid+id+cusdetails") : null;
				}
				else
					$existed_customer = _m("shcustomers.showcustomerdata use ++cusdetails");		
			}

			$tokens[] = (($this->submiterror) || ($this->mailerror)) ?
						$this->finalize_cart_error() :
						$this->finalize_cart_success();
				
			$tokens[] = $this->transaction_id;
			$tokens[] = $existed_customer;				
			
			$tokens[] = $this->loopcartdata;
			$tokens[] = $this->looptotals;
			
			/////////////////////////////////////////////////////////////////////
			$tstep = $this->status ? strval($this->status) : '0';	
			$mysteptemplate = _m('cmsrt.select_template use shcartstep' . $tstep); 
			$mycarttemplate = isset($mysteptemplate) ? $mysteptemplate : _m('cmsrt.select_template use shcart');

			//reset global params..								 
			SetSessionParam('TransactionID',0);
			SetSessionParam('cartstatus',0);
			$this->status = 0; //GOTO SHCART TEMPLATE NOT SHCARTSTEP !!!!!!!!!
			//echo $this->status . '>>>>>>>>';
			
			$out = $this->combine_tokens($mycarttemplate,$tokens,true);
			return $out;
	    }
	}
	
	protected function loopcart() {
	    if (empty($this->buffer)) return;
	
		$command = $this->itemclick ? $this->itemclick : GetReq('t');
		$status = $this->status ? strval($this->status) : '0';
		$ix = $this->imagex ? $this->imagex : 100;
	    $iy = $this->imagey ? $this->imagey : null; 
	    $ixw = $ix ? "width=".$ix : "width=".$ix;
	    $iyh = $iy ? "height=".$iy :null; //empty y=free dim	   
	   
	    //$myloopcarttemplate = _m('cmsrt.select_template use shcartline');
	    $tstep = $this->status ? strval($this->status) : '0';	
		$mysteptemplate = _m('cmsrt.select_template use shcartlinestep' . $tstep);
		$myloopcarttemplate = isset($mysteptemplate) ? $mysteptemplate : _m('cmsrt.select_template use shcartline');

        reset ($this->buffer);
		
		$this->cartsumitems = 0;
	    $this->qty_total = 0;
	    $this->total = 0;	
	
        foreach ($this->buffer as $prod_id => $product) {

		    if (($product) && ($product!='x')) {
				$aa+=1;
				$param = explode(";",$product); 
				$cat = $param[4];
				$item = $param[1];
				$utitle = $this->replace_cartchars($item, true);				
				$link = _m("cmsrt.url use t=$command&cat=$cat&id=" . $param[0] ."+" . $utitle); 
			   
				$itemphoto = _m($this->shclass . ".get_photo_url use ".$param[7].'+1');
				$linkimage = seturl("t=$command&cat=$cat&id=".$param[0], "<img src=\"" . $itemphoto . "\" $ixw $iyh alt=\"$item\">",null,null,null,true);
				
				$data[] = ($this->status==0) ? $linkimage : $aa; // . "&nbsp;" . $param[0];

				$details = $this->cartlinedetails ? ($param[6] ? '&nbsp;' . $this->replace_cartchars($param[6], true) : null) : null;	 
				
				switch ($this->status) {
					case 3  :  
					case 2  : 
					case 1  :	 $data[] = $utitle . $details; break; //$param[0] . "&nbsp;" . 				   
					case 0  : 
					default :	 $data[] = $link . $details;  break; //$param[0] . "<br/>" . 					
				}

				//$data[] = ($this->status) ? null : $this->showsymbol($product,$param[4],$param[5],1);//<<allow remove here
				$data[] = ($this->status) ? null : $this->showsymbol($product,1);//<<allow remove here

				$price = floatval(str_replace(",",".",$param[8]));
				$sumtotal = ($param[9] * $price);
				$this->qty_total += $param[9];	 
				$this->total += $sumtotal;
			   
				$data[] = number_format($price,$this->dec_num,',','.') . $this->moneysymbol;

				$options = $this->setquantity("Product$aa",$param[9]);
				if (($this->uniname2) && ($param[11]))
					$options .= $this->setuniname("Uniname$aa",$param[10],$param[10],$param[11]);
				$data[] = $options;

				$data[] = $this->settotal("Product$aa",$price,$param[9]) . $this->moneysymbol;
				
				$data[] = _m("cmsrt.url use t=$command&cat=$cat&id=" . $param[0]);
				$data[] = $utitle;
				$data[] = $itemphoto;
				$data[] = $param[0];
				$data[] = $aa;
				$data[] = $param[7];
				
				$data[] = $param[10]; // 12
				$data[] = $param[11];
				$data[] = $param[14];
				$data[] = $param[15];
               
			    $loopout .= $this->combine_tokens($myloopcarttemplate,$data,true);
				  
	            unset ($data);
		        unset ($param);
		    }
			$this->cartsumitems = $aa; //sum of cart items
	    }
	   	   
	    return ($loopout);  	 	
	}
	
	//tokens-api version / return tokens as var
	protected function loopcartTokens(&$tokens) {
	    if (empty($this->buffer)) return;

        reset ($this->buffer);
		
		$this->cartsumitems = 0;
	    $this->qty_total = 0;
	    $this->total = 0;	
	
        foreach ($this->buffer as $prod_id => $product) {

		    if (($product) && ($product!='x')) {
				$aa+=1;
				$param = explode(";",$product); 
				$code = $param[7]; //$param[0];
				$cat = $param[4];
				$item = $param[1];
				$utitle = $this->replace_cartchars($item, true);				
				$link = _m("cmsrt.url use t=$command&cat=$cat&id=" . $code ."+" . $utitle); 
			   
				$itemphoto = _m($this->shclass . ".get_photo_url use ".$param[7].'+1');
				$linkimage = seturl("t=$command&cat=$cat&id=".$code, "<img src=\"" . $itemphoto . "\" $ixw $iyh alt=\"$item\">",null,null,null,true);
				
				$data['cartstatus'] = ($this->status==0) ? '0' : $this->status; //$linkimage : $aa; 

				$details = null;//$this->cartlinedetails ? ($param[6] ? '&nbsp;' . $this->replace_cartchars($param[6], true) : null) : null;	 
				
				switch ($this->status) {
					case 3  :  
					case 2  : 
					case 1  :	 //$data['itmcarturldetails'] = $utitle . $details; break; //$param[0] . "&nbsp;" . 				   
					case 0  : 
					default :	 $data['itmcarturldetails'] = $link . $details;  break; //$param[0] . "<br/>" . 					
				}

				$data['itmcartremove'] = "remcart/".$param[0]."/"; //($this->status) ? null : $this->showsymbol($product,1);//<<allow remove here

				$price = floatval(str_replace(",",".",$param[8]));
				$sumtotal = ($param[9] * $price);
				$this->qty_total += $param[9];	 
				$this->total += $sumtotal;
			   
				$data['itmcartprice'] = number_format($price,$this->dec_num,',','.');// . $this->moneysymbol;

				$options = $this->setquantity("Product$aa",$param[9]);
				if (($this->uniname2) && ($param[11]))
					$options .= $this->setuniname("Uniname$aa",$param[10],$param[10],$param[11]);
				$data['itmcartuni'] = $options;

				$data['itmcarttotal'] = $this->settotal("Product$aa",$price,$param[9]);// . $this->moneysymbol;
				
				$data['itmcarturl'] = _m("cmsrt.url use t=$command&cat=$cat&id=" . $code);
				$data['itmcartname'] = $utitle;
				$data['itmcartphoto'] = $itemphoto;
				$data['itmcartcode'] = $param[0];
				$data['itmcartaa'] = $aa;
				$data['itmcode'] = $code;		
               
			    //$loopout .= $this->combine_tokens($myloopcarttemplate,$data,true);
				$tokens[] = $data;
				  
	            unset ($data);
		        unset ($param);
		    }
			$this->cartsumitems = $aa; //sum of cart items
	    }
	   	   
	    //return ($loopout);  	 	
	}	
	
    protected function setuniname($id,$uni,$uA=null,$uB=null) {
		$uniname = $id ;
		$selecteduni = GetParam($uniname);
		if (!$selecteduni) $selecteduni = $uni;
		//print $id.">".$selectedqty."()";

		if (!$this->status) {	//only if status=0 else when cart status > 0 uniname change
			$out = "<SELECT class=\"myf_select_small\" name=\"$uniname\">";

			if ($selecteduni==$uA)
				$out .= "<OPTION selected>$uA";
			else
				$out .= "<OPTION>$uA";

			if ($selecteduni==$uB)
				$out .= "<OPTION selected>$uB";
			else
				$out .= "<OPTION>$uB";

			$out .= "</OPTION></SELECT>";
		}
		return ($out);
	}	
	
    public function settotal($id,$price,$qty) {	

		if (!$qty) $qty = 1;
      
		if ($price!=0) 
			$result = ($price*$qty);
		else
			$result = "--&nbsp;";
		 
		$ret = number_format(floatval($result),$this->dec_num,',','.');	 
		return ($ret);
	}	
	
	protected function logcart() {
		
		foreach ($this->buffer as $prod_id => $product) {
			if (($product) && ($product!='x')) {
				$cartstr = explode(';', $product);
				$item = $cartstr[7]; //$cartstr[0];
				_m("cmsvstats.update_item_statistics use $item+checkout");				
			}	
		}		 		
		return true;
	}
	
	public function loadcart($transid=null) {
	    $a = $transid ? $transid : GetReq('tid');
		$transdata = array();

		if (is_number($a)) { //transaction
			if (defined('SHTRANSACTIONS_DPC')) {

				$transdata = _m('shtransactions.getTransaction use '.$a);
			
				if ($transdata) {
					//unserialize data
					$decodetrans = unserialize($transdata);
			  
					foreach ($decodetrans as $i=>$trcartrec) {
						/**** add log records to stats ****/ 
						$cartstr = explode(';', $trcartrec);
						$item = $cartstr[0];
						_m("cmsvstats.update_item_statistics use $item+cartin");				
				  
						$this->buffer[] = $trcartrec;
					}	
			  
					$this->setStore();
					$this->colideCart();
			  
					return true;
				}
			}
		} //stored cookie (disabled method)
		/*elseif (is_array($this->base64CartEncode($a))) {
			$decodecookie = $this->base64CartEncode($a);
			//print_r($decodecookie);
			
			foreach ($decodecookie as $i=>$trcartrec) {
				$this->buffer[] = $trcartrec;
			}	
			  
			$this->setStore();
			$this->colideCart();
			
			$this->js_cleanCart(); // clean cookie
			  
			return true;			
		}*/
		else { //pcart cookie named session
			if (($data = $this->cookie_fetch_cart($a)) &&
				(is_array($this->base64CartEncode($data)))) {
					
				$decodecookie = $this->base64CartEncode($data);
				foreach ($decodecookie as $i=>$trcartrec) {
					$this->buffer[] = $trcartrec;
				}	
			  
				$this->setStore();
				$this->colideCart();
				
				$this->js_cleanCart(); // clean cookie
				
				return true;
			}		
		}
		
		return false;
	}	

	public function previewcart($id,$cmd=null,$template=null) {
        $pview = $cmd ? $cmd : 'kshow';
	    $status = $this->status ? strval($this->status) : '0';
	    $ix = $this->imagex ? $this->imagex : 100;
	    $iy = $this->imagey ? $this->imagey : null;//free y
	    $ixw = $ix ? "width=".$ix : "width=".$ix;
	    $iyh = $iy ? "height=".$iy : null; //empty y=free dim	   		
		
        $loopcart_template = $template ? $template : 'shcartline';		
		$myloopcarttemplate = _m('cmsrt.select_template use ' . $loopcart_template); //.php file, code inside

		if (is_number($id)) {

			$transdata = _m('shtransactions.getTransaction use '.$id);
			$buffer = unserialize($transdata);	
		} //stored cookie (disabled method)
		/*elseif (is_array($this->base64CartEncode($id))) {
		
			$buffer = $this->base64CartEncode($id);
			//print_r($decodecookie);
		} */
		//pcart cookie named session
		elseif (($data = $this->cookie_fetch_cart($id)) &&
			(is_array($this->base64CartEncode($data)))) {
				
			$buffer = $this->base64CartEncode($data);
		}	
		
		if (!empty($buffer)) {
			foreach ($buffer as $prod_id => $product) {

				if (($product) && ($product!='x')) {
					$aa+=1;
					$param = explode(";",$product); 
					$code = $param[7]; //$param[0];
					$cat = $param[4];
					$item = $param[1];
					$qty = $param[9];
					$utitle = $this->replace_cartchars($item, true);
					
					//$addButton = $this->showsymbol($product,$param[4],$param[5],1);//<<allow remove here
					$addButton = $this->showsymbol($product,0,$qty);
					$link = _m("cmsrt.url use t=$pview&cat=$cat&id=" . $code ."+" . $utitle); 
			   
					$itemphoto = _m($this->shclass . ".get_photo_url use ".$param[7].'+1');
					$linkimage = seturl("t=$pview&cat=$cat&id=".$code, "<img src=\"" . $itemphoto . "\" $ixw $iyh alt=\"$item\">",null,null,null,true);	   
					$data[] = $linkimage;

					$details = $this->cartlinedetails ? ($param[6] ? '&nbsp;' . $this->replace_cartchars($param[6], true) : null) : null;					
					$data[] = $link . $details; //$param[0] . "<br/>" . 
					$data[] = $addButton;
                    $data[] = $qty;
					
					$price = floatval(str_replace(",",".",$param[8]));
					$data[] = number_format($price,$this->dec_num,',','.') . $this->moneysymbol;					
					
					$ssum = floatval(str_replace(",",".",$price)) * intval($param[9]);	
					$merikosynolo = number_format($ssum,$this->dec_num,',','.') . $this->moneysymbol;		   
					$data[] = $merikosynolo;
					
					$data[] = _m("cmsrt.url use t=$pview&cat=$cat&id=" . $code);
					$data[] = $utitle;
					$data[] = $itemphoto;	
					$data[] = $code; //$param[0];					
			   		   
					$loopout .= $this->combine_tokens($myloopcarttemplate,$data,true);
				
					unset ($data);
					unset ($param);
				}
			}
		}
	   	   
	    return ($loopout);  	 	
	}	
	
	
	
	//GUEST REG (DEF)
	
	public function guestDetails() {
		//if (defined('SHCUSTOMERS_DPC')) {

			if ($template = _m('cmsrt.select_template use shcartguestform')) {
				
				$tokens = array();
				return $this->combine_tokens($template, $tokens, true);
			}
			else
				return "Guest user registration form missing";			
		//}
		
		return null;
	}

	//as post come from guest details form
	public function guestRegistration() {
		$db = GetGlobal('db');	
		$email = GetParam('email');
		$name = GetParam('name');
		$address = GetParam('address');
		$postcode = GetParam('postcode');
		$country = GetParam('country');
		$tel = str_replace('+','00', GetParam('tel'));
		
		//register and login (save customer details or deliv address of existing user)
		$loggedin = (defined('SHLOGIN_DPC')) ?
					_m("shlogin.do_guest_login use $email+$name+$address+$postcode+$country+$tel") :
					_m("cmslogin.do_guest_login use $email+$name+$address+$postcode+$country+$tel");
		
		if ($loggedin) { 		
			if ($template = _m('cmsrt.select_template use shcartguestprocced')) {
				$tokens = array($email, $name, $address, $postcode, $country, $tel);
				return $this->combine_tokens($template, $tokens, true);
			}
			else
				return "Message: Guest user registration form missing";					
		}
		
		return false; //"Guest user registration failed";
	}
	
	//GUEST REG (FASTCART)

    //fastcart mode guest registration
	public function guestFastRegistration() {
		$db = GetGlobal('db');	
		$email = GetParam('email');
		$name = GetParam('name');
		$address = GetParam('address');
		$postcode = GetParam('postcode');
		$country = GetParam('country');
		$tel = str_replace('+','00', GetParam('tel'));
		
		//register and login (save customer details or deliv address of existing user)
		$loggedin = $this->do_guest_login_fastcart($email,$name,$address,$postcode,$country,$tel);
		
		if ($loggedin) {

			$this->user = $email; //update this user
			
			if ($template = _m('cmsrt.select_template use shcartguestprocced')) {
				$tokens = array($email, $name, $address, $postcode, $country, $tel);
				return $this->combine_tokens($template, $tokens, true);
			}
			else
				return "Message: Guest user registration form missing";					
		}
		
		return false; //"Guest user registration failed";
	}	
	
	//copied form cmslogin for fastcart (no mail messages and analytics)
	protected function do_guest_login_fastcart($email=null,$name=null,$address=null,$postcode=null,$country=null,$tel=null) {
	    $db = GetGlobal('db');	
		if (!$email) return false;
		
		if (($name) && (strstr($name, ' '))) {
			$p = explode(' ', $name);
			$fname = array_shift($p);
			$lname = implode(' ', $p); //rest array
		}
		else
			$fname = $lname = ($name ? $name : 'unknown');
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			
			$sUsername = $email;
			//$this->fbhash = '#facebook';
			//SetSessionParam('fbhash', '#facebook');
						  
			$sName = $name;
			$sId = $email;
			
			$sSQL = "select id from users WHERE username='{$email}' and active=1 order by id desc LIMIT 1"; //last entry
			$uret = $db->Execute($sSQL);
		
			if (!$uret->fields[0]) {
				 
				$pass = md5('!@test@!' . time()); //auto gen password
				  
				//insert guest user (active by def)	  
				$sSQL = "insert into users (code2,fname,lname,email,username,subscribe,seclevid, password, vpass, active, fb) values ";
				$sSQL.= "('{$sUsername}','{$fname}','{$lname}','{$email}','{$email}',1,1,'{$pass}','{$pass}',1,2)";
				$ret = $db->Execute($sSQL);
							  
				if ($db->Affected_Rows()) {
					/*
					if (defined('SHUSERS_DPC'))  
						_m("shusers.mailtohost use $sUsername++".$fname.'+'.$lname);
					else
						_m("cmsusers.mailtohost use $sUsername++".$fname.'+'.$lname);
					//if (defined('CMSSUBSCRIBE_DPC'))  
						//_m('cmssubscribe.dosubscribe use '.$sUsername.'+1');
					*/
				    //add save-update customer 
					if (defined('SHCUSTOMERS_DPC')) 
						$save = _m("shcustomers.save_guest_customer use $email+$name+$address+$postcode+$country+$tel");
					
					$this->update_statistics('registration', $sUsername);					
				}
				else
					return false;		
			}	
			else {  
				//add customer address
				/*
				if (defined('SHCUSTOMERS_DPC')) 
					$save = _m("shcustomers.save_guest_deliveryaddress use $email+$name+$address+$postcode+$country+$tel"); 
				*/
				//save-update user (only name not password)
				$sSQL = "update users set "; //(code2,fname,lname,email,username,subscribe,seclevid, password, vpass, active, fb) values ";
				$sSQL.= "fname=" . $db->qstr($fname);
				$sSQL.= ",lname=" . $db->qstr($lname);
				$sSQL.= " where username='{$email}' and active=1 and id=" . $uret->fields[0];
				$ret = $db->Execute($sSQL);
							  
				if ($db->Affected_Rows()) {
					//save-update customer
					if (defined('SHCUSTOMERS_DPC'))
						$save = _m("shcustomers.save_guest_customer use $email+$name+$address+$postcode+$country+$tel");
				}	
			}
			
			$GLOBALS['UserID'] = encode($sId);
			SetSessionParam("UserName", encode($sUsername));
			SetSessionParam("UserID", encode($sId));
			SetSessionParam("UserSecID", encode('1'));
					
			//set cookie
			if (paramload('SHELL','cookies')) {
				setcookie("cuser", $sUserName, time()+$this->time_of_session);
				setcookie("csess", session_id(), time()+$this->time_of_session);
			}
			
			_m('cmslogin.update_login_statistics use login+' . $sUsername);	

			return true;			
			
		}
        else 
		    SetGlobal('sFormErr',localize('_MSG1',getlocal()));	
		
		return false;
	}		
	
	//GUEST REG (SUPERFAST)
	
	protected function guestSuperFastCheck($fields) {
		$guesterr = localize('_guesterr', $this->lan);
		$invmail = localize('_invalidemail', $this->lan);
		$invname = localize('_invalidname', $this->lan);
		$invaddr = localize('_invalidaddress', $this->lan);
		$invps = localize('_invalidpostcode', $this->lan);
		$invcountry = localize('_invalidcountry', $this->lan);
		$invphone = localize('_invalidphone', $this->lan);	
		$invpayway = localize('_invalidpayway', $this->lan);
		$invterms = localize('_TERMSAPPROVE', $this->lan);
		
		$err = array();

		if (!$fields['guestemail']) $err[] = $invmail;
		if (!$fields['guestname'])	$err[] = $invname;
		if (!$fields['guestaddress']) $err[] =$invaddr;
		if (!$fields['guestphone'])	$err[] = $invphone;
		if (!$fields['guestpostcode'])	$err[] = $invps; 
		if (!$fields['guestcountry'])	$err[] = $invcountry;
		if (!$fields['payway'])			$err[] = $invpayway;
		if (!$fields['terms'])			$err[] = $invterms;		
		//print_r($err);
		
		if (!empty($err))
			return implode('<br>', $err);
		
		return false;
	}	
	
	public function guestSuperFastRegistration() {
		$db = GetGlobal('db');	
		$email = GetParam('guestemail');
		$name = GetParam('guestname');
		$address = GetParam('guestaddress');
		$postcode = GetParam('guestpostcode');
		$country = GetParam('guestcountry');
		$tel = str_replace('+','00', GetParam('guestphone'));
		
		//register and login (save customer details or deliv address of existing user)
		$loggedin = $this->do_guest_login_fastcart($email,$name,$address,$postcode,$country,$tel);
		
		if ($loggedin) { 

			$this->user = $email; //update this user
		
			if ($template = _m('cmsrt.select_template use shcartguestprocced')) {
				$tokens = array($email, $name, $address, $postcode, $country, $tel);
				return $this->combine_tokens($template, $tokens, true);
			}
			else
				return "Message: Guest user registration form missing";					
		}
		
		return false; //"Guest user registration failed";
	}	


	//CLICK AWAY	
	
	protected function clickaway_event() {
		
		if (($this->clickawaycode) && ($this->clickaway_url)) {
			echo '<br/>' . 'start:' . $this->clickawaycode;								
			echo '<br/>' . $this->clickaway_url;
											
			$merchant = remote_paramload('INDEX','company-name',$this->path);
			$afm = remote_paramload('INDEX','afm',$this->path);
			$address = remote_paramload('INDEX','address',$this->path);
										
			$comments = remote_paramload('CLICKAWAY','comments',$this->path);
										
			//$data = array("name" => "Hagrid", "age" => "36");                                                                    
			//json_encode($data); 
			$data_string = "{
    \"products\": 
    {
        \"action\": \"click_away\",
        \"subaction\": \"add_appointment\",
        \"code\": \"{$this->clickawaycode}\",
        \"extra_fields\": 
        {
            \"merchant\":\"Alexiou Vasilis, STEREOBIT\",
            \"afm\":\"055208430\",
            \"address\":\"13 Spanoy St. Thessaloniki\",
            \"date\":\"2020-12-28\",
            \"time\":\"18:00\",
            \"comments\":\"SAS PERIMENOUME\"
        }
    }
}"; 
										
			$this->clickaway_signature = sha256($this->clickaway_apikey . $this->clickaway_date);
			echo '<br/>' . $this->clickaway_signature;
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->clickaway_url);
			//curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
										
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
										
			curl_setopt($ch, CURLOPT_HTTPHEADER, 
						array(
							"loyalty-web-id: {$this->clickaway_webid}",
							"loyalty-date': {$this->clickaway_date}",
							"loyalty-signature': {$this->clickaway_signature}"
						)
			);
										
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
									
			$this->clickaway_return  = curl_exec($ch);
			echo '<br/>' . $this->clickaway_return;
			curl_close($ch);
				
			return true;
		}	
		
		return false;
	}
	
	protected function clickaway_action() {
		if (!$this->user) return false;
		
		$out = null;
		if ($this->clickawaycode)
			echo 'CODE:'.$this->clickawaycode;
		
		$tokens[] = $this->clickaway_signature;//$this->clickaway_return; //$this->clickaway_webid;  
		
	    //VIEW TRANSACTIONS
		if ((defined('SHTRANSACTIONS_DPC'))) {
			//$out .= _m('shtransactions.viewTransactions');
			$lnk1 = _m('cmsrt.url use t=transview'); 
			$trans_button = '&nbsp;'.$this->myf_button(localize('_TRANSLIST',$this->lan),$lnk1);
		} 	

		//CLICK AWAY
		if ($this->clickawaycode) { //code has already submited 
			//hide button
			
			//reset code
			SetSessionParam('clickacode',null);
		}
		else {
			//button for manual click away
			$lnk2 = _m('cmsrt.url use t=clickaway'); 
			$catell = localize('_CLICKAWAYENABLE',$this->lan);
			$caway_button = "<div class=\"inline-input\"><form method=\"POST\" action=\"clickaway/\"> <input data-placeholder=\"Insert code\" type=\"text\" name=\"clickawaycode\" /><button class=\"le-button\" type=\"submit\">$catell</button></form></div>";
			//$caway_button .= '&nbsp;'.$this->myf_button(localize('_CLICKAWAY',$this->lan),$lnk2);
		} 
		$tokens[] = $trans_button . $caway_button;	
		$tokens[] = $this->clickaway_return; //$this->clickaway_date;
		//$tokens[] = $this->clickaway_return;	//$this->clickaway_signature	

		$mycarttemplate = _m('cmsrt.select_template use shcartclickaway');	
		$out = $this->combine_tokens($mycarttemplate,$tokens,true);

		$this->update_statistics('cart-final-clickaway', $this->user);					
		
		return ($out);
	}		
	
	//curl less post (unused !!!)
	protected function post_request($url, array $params) {
		$query_content = http_build_query($params);
		$fp = fopen($url, 'r', FALSE, // do not use_include_path
		stream_context_create([
			'http' => [
				'header'  => [ // header array does not need '\r\n'
					'Content-type: application/x-www-form-urlencoded',
					'Content-Length: ' . strlen($query_content)
				],
			'method'  => 'POST',
			'content' => $query_content
			]
		]));
		
		if ($fp === FALSE) {
			return json_encode(['error' => 'Failed to get contents...']);
		}
		$result = stream_get_contents($fp); // no maxlength/offset
		fclose($fp);
		return $result;
	}	
	
	
	
	
	//PAYWAY
	
	public function payway() {
	    $pways = remote_arrayload('SHCART','payways',$this->path);
		if (!$pways) return null;
		   
		$defpay = remote_arrayload('SHCART','payway_default',$this->path);
		$default_pay = $defpay ? $defpay : 0;	   
		$payway = $this->getDetailSelection('payway');
		   		   
		foreach ($pways as $i=>$w) {
		    $lans_titles = explode('/',$w);
			$choice = $lans_titles[$this->lan];
			$choices[] = $choice;
			 
			if (strcmp($choice,$payway)==0) 
				$default_pay = $i;
			else
				$default_pay = 0;  
		}
		$params = implode(',',$choices);

        switch ($this->status) {
			 case 1 :	$pp = new multichoice('payway',$params,$default_pay,false);
						$radios = $pp->render();
						unset($pp);
					 
						$subtokens[] = $radios;					 
						$s1 = $this->get_selection_text('payway',$subtokens);
						$tokens[] = $s1 ? $s1 : $subtokens;						 
						break;
	         case 3 :
		     case 2 :	//$mypway = GetParam("payway")?GetParam("payway"):GetSessionParam("payway");
						//hold param
						SetSessionParam('payway', $payway); //$mypway);	
						$subtokens[] = localize($mypway, $this->lan);
						$s1 = $this->get_selection_text('payway',$subtokens);
						$tokens[] = $s1 ? $s1 :$subtokens;						 				 
						break;

			 default : 	$tokens[] = '&nbsp;';
		}

		return ($tokens);
	}

	public function payway2() {
		$db = GetGlobal('db');			

        switch ($this->status) {
			 case 1 :	$template = _m('cmsrt.select_template use ppay');
						$subtemplate = _m('cmsrt.select_template use ppayline');
						
						$rw = $this->getDetailSelection('roadway');
						$roadway = GetReq('roadway') ? GetReq('roadway') : 
									($rw ? $rw : GetGlobal('roadway'));

						$sSQL = "select code,title,lantitle,notes from ppayments where active=1";
						$sSQL.= $roadway ? " and tcodes like '%$roadway%'" : null;
						$sSQL.= " order by orderid";
						$res = $db->Execute($sSQL);	
						//return $sSQL;
						foreach ($res as $i=>$rec) {
							$title = $rec['lantitle'] ? localize($rec['lantitle'], $this->lan) : $rec['title'];
							$tokens = array($rec['code'], $title, $rec['notes']);
							$options[] = $this->combine_tokens($subtemplate, $tokens, true);
							unset ($tokens);
						}
						if (!empty($options)) {
							$opt = implode('', $options);
							$tokens2 = array('payway', $opt);
							return $this->combine_tokens($template, $tokens2, true);
						}	
						break;
	         case 3 :
		     case 2 :	$payway = $this->getDetailSelection('payway');
						SetSessionParam('payway',$payway);
						return (localize($payway, $this->lan));
	 							 					 
						break;

			 default : return null;
		}
	}	
	
	public function payDetails() {
		$db = GetGlobal('db');	
		
		$payway = $this->getDetailSelection('payway');
		$code = GetReq('payway') ? GetReq('payway') : $payway;		
		
		$rw = $this->getDetailSelection('roadway');
		$roadway = GetReq('roadway') ? GetReq('roadway') : 
						($rw ? $rw: GetGlobal('roadway'));
		
		$sSQL = "select notes from ppayments ";
		if ($code) {
			$sSQL.= "where code=" . $db->qstr($code);
		}	
		else {  
			if ($roadway)	
				$sSQL.= "where tcodes like '%$roadway%' and active=1 order by orderid LIMIT 1";
			else
				$sSQL.= "where active=1 order by orderid LIMIT 1";
		}	
		
		$res = $db->Execute($sSQL);	

		return $res->fields[0];			
	}
	
	//fast payments (method without login)
	public function payFast($nopresel=false) {
		$db = GetGlobal('db');
		if (!$this->superfastcart) return null; //disable when no superfastcart
		$_nopresel = $this->payFastPresel ? false : $nopresel;
		
		$UserName = decode(GetGlobal('UserName'));
		if ($UserName) return null; //disable when logged in
		
		$selectedPost = GetParam('payway'); //when selection is set
		
		switch ($this->status) {		
		
			case 2  :
						break;
		
			case 1  :	$template = _m('cmsrt.select_template use ppayfast');
						$subtemplate = _m('cmsrt.select_template use ppayfastline');
						
						$sSQL = "select code,title,lantitle,notes from ppayments where active=1";
						$sSQL.= " order by orderid";
						$res = $db->Execute($sSQL);	
						//return $sSQL;
						foreach ($res as $i=>$rec) {
							
							if ($selectedPost == $rec['code'])
								$_selection = 1;
							else
								$_selection = $_nopresel ? 0 : (($i==0) ? 1 : 0); //first element orderby orderid
							
							$title = $rec['lantitle'] ? localize($rec['lantitle'], $this->lan) : $rec['title'];
							$tokens = array($rec['code'], $title, $rec['notes'], $_selection);
							$options[] = $this->combine_tokens($subtemplate, $tokens, true);
							unset ($tokens);
						}
						if (!empty($options)) {
							$opt = implode('', $options);
							$tokens2 = array('payway', $opt);
							return $this->combine_tokens($template, $tokens2, true);
						}
						break;
			case 0  :
			default :   //do nothing
		}
	}	
	
	//ROADWAY

	public function roadway() {
	    $ways = remote_arrayload('SHCART','roadways',$this->path);
		if (!$ways) return null;
		   
		$defway = remote_arrayload('SHCART','roadway_default',$this->path);
		$default_ship = $defway ? $defway : 0; 
		
		foreach ($ways as $i=>$w) {
		    $lans_titles = explode('/',$w);
		    $choices2[] = $lans_titles[$this->lan];
		}

	    $params = implode(',',$choices2);

        switch ($this->status) {
			 case 1 :	$pp = new multichoice('roadway',$params,$default_ship,false);
						$radios = $pp->render();
						unset($pp);
					 
						$subtokens[] = $radios;
						if ($message = remote_arrayload('SHCART','roadwaystext',$this->path)) 
							$subtokens[] = $message[$this->lan];
						else
							$subtokens[] = '&nbsp;';
					   
						$s1 = $this->get_selection_text('roadway',$subtokens);
						if ($s1) {
							$tokens[] = $s1;
							$tokens[] = '&nbsp;';//dummy							
						}	
						else 
							$tokens =  $subtokens;   					   					   
						break;
	         case 3 :
		     case 2 :	$myrway = GetParam("roadway")?GetParam("roadway"):GetSessionParam("roadway");
						//hold param
						SetSessionParam('roadway',$myrway);
					 
						$subtokens[] = localize($myrway, $this->lan);
						$subtokens[] = '&nbsp;';
						$s1 = $this->get_selection_text('roadway',$subtokens);
						if ($s1) { 
							$tokens[] = $s1;
							$tokens[] = '&nbsp;';//dummy
						}	
						else 
							$tokens =  $subtokens;	 							 					 
						break;

			 default : $tokens[] = '&nbsp;';
			           $tokens[] = '&nbsp;';
		}

		return ($tokens);
	}
	
	public function roadway2($customer_address_array=null) {
		$db = GetGlobal('db');	

        switch ($this->status) {
			 case 1 :	$template = _m('cmsrt.select_template use ptrans');
						$subtemplate = _m('cmsrt.select_template use ptransline');
		
						//$sSQL = "select code,title,lantitle,notes from ptransports where active=1 order by orderid";
						$debug = 'start:';
						$res = $this->roadRules($customer_address_array, $debug); 
						$debug = null; //reset
						
						foreach ($res as $i=>$rec) {
							
							if ($i==0) //save 1st when address selected
								SetGlobal('roadway', $rec['code']); 
							
							$title = $rec['lantitle'] ? localize($rec['lantitle'], $this->lan) : $rec['title'];
							$tokens = array($rec['code'], $title, $rec['notes']);
							$options[] = $this->combine_tokens($subtemplate, $tokens, true);
							unset ($tokens);
						}
						if (!empty($options)) {
							$opt = implode('', $options);
							$tokens2 = array('roadway', $opt, $debug);
							return $this->combine_tokens($template, $tokens2, true);
						}	
						break;
	         case 3 :
		     case 2 :	$roadway = $this->getDetailSelection('roadway');
						SetSessionParam('roadway',$myrway);
						return (localize($roadway, $this->lan));
	 							 					 
						break;

			 default : return null;
		}
	}	
	
	public function roadDetails() {
		$db = GetGlobal('db');	
		$roadway = $this->getDetailSelection('roadway');
		$code = GetReq('roadway') ? GetReq('roadway') : 
					($roadway ? $roadway : GetGlobal('roadway'));
		
		$sSQL = "select notes from ptransports ";
		if ($code)
			$sSQL.= "where code=" . $db->qstr($code);
		else
			$sSQL.= "where active=1 order by orderid LIMIT 1";
		
		$res = $db->Execute($sSQL);	

		return $res->fields[0];	
	}	
	
	//road rules based on zip, country etc
	protected function roadRules($customer_address_array=null, &$debug) {
		$db = GetGlobal('db');	

		//customer address based rules		
		if (!empty($customer_address_array)) {
			$address = $customer_address_array[0];
			$area = $customer_address_array[1]; 
			$zip = $customer_address_array[2]; 
			$country = $customer_address_array[3];

			$sSQL = "select transports,cost,notes,orderid from ptransrules where active=1 and ";
			
			if ($address) $sSQLa[] = " address like '%$address%' ";
			if ($area) $sSQLa[] = " area like '%$area%' ";
			if ($zip) $sSQLa[] = " zip='$zip' ";
			if ($country) $sSQLa[] = " country='$country' ";
			
			$sSQL.= '(' . implode(' OR ', $sSQLa) . ') order by orderid DESC';
			$debug.= $sSQL;
			
			$res = $db->Execute($sSQL);	
			
			if (!empty($res)) {
				$rules = array();
				foreach ($res as $r=>$rec) {
					
					//transportation methods allowed, ptransport code
					if (strstr($rec['transports'], ',')) { 
						//comma separator
						$trmethods = explode(',', $rec['transports']);
						foreach ($trmethods as $ir=>$method)
							$rules['transports'][] = $method; 
					}
					else		 
						$rules['transports'][] = $rec['transports']; 
					
					$rules['cost'] += floatval($rec['cost']); //sum of costs
					$rules['notes'][] = $rec['notes']; //sum of notes
				}	
			}
			$debug .= var_export($rules, true);
		}
		
		//basic group transport rules
		/*calc based on cart net value choosing the right transport code, using aggregation(group by)*/
		$sSQL = "select code,title,lantitle,notes,cost,groupid,cs,orderid from ";
		$sSQL.= "(select code,title,lantitle,notes,cost,groupid,orderid,cartsum as cs from ptransports ";
		$sSQL.= "where active=1 and cartsum <=" . $this->total;
		if (!empty($rules['transports'])) { 
			$codegroup = implode("','", $rules['transports']);
			$sSQL.= " and code in ('$codegroup') group by cartsum DESC,code,cost) x group by groupid order by orderid";
		}
		else	
			$sSQL.= " group by cartsum DESC,code,cost) x group by groupid order by orderid";		
		
		$debug .= $sSQL;
		
		$res = $db->Execute($sSQL);	
		return ($res);	
	}	
	
	
	//INVOICEWAY
	
	public function invoiceway() {
		$ways = remote_arrayload('SHCART','invways',$this->path);
		$defway = remote_paramload('SHCART','invway_default',$this->path); 	
		$default_invoice = $defway ? $defway : 0;//override customers default invoice ??

		if (defined('SHCUSTOMERS_DPC'))  {
			$choose_invoice = _v('shcustomers.allow_inv_selection');
			$default_invoice = _v('shcustomers.invtype');
		}   
		   
		if (empty($ways)) {
			$ways[0] = localize('_APODEIXI',0).'/'.localize('_APODEIXI',1);//'_APODEIXI/_APODEIXI';
			$ways[1] = localize('_INVOICE',0).'/'.localize('_INVOICE',1);//'_INVOICE/_INVOICE';
		}

		foreach ($ways as $i=>$w) {
			$lans_titles = explode('/',$w);
			$choices2[] = $lans_titles[$this->lan];
		}

		$params = implode(',',$choices2);		   
		   
		switch ($this->status) {
			 case 1 : 	$pp = new multichoice('invway',$params,$default_invoice,false);
						$radios = $pp->render();
						unset($pp);

						$subtokens[] = $radios;		
						if ($message = remote_paramload('SHCART','invwaystext',$this->path)) 
							$subtokens[] = $message;
						else
							$subtokens[] = '&nbsp;';
					   
						$s1 = $this->get_selection_text('invoiceway',$subtokens);	
						if ($s1) { 
							$tokens[] = $s1;
							$tokens[] = '&nbsp;';//dummy
						}	
						else 
							$tokens =  $subtokens;   					   					   
						break;
	         case 3 :
		     case 2 :	$myiway = GetParam("invway")?GetParam("invway"):GetSessionParam("invway");
						SetSessionParam('invway',$myiway);
					 
						$subtokens[] = localize($myiway, $this->lan);
						$subtokens[] = '&nbsp;';
					 
						$s1 = $this->get_selection_text('invoiceway',$subtokens);	
						if ($s1) { 
							$tokens[] = $s1;
							$tokens[] = '&nbsp;';//dummy
						}	
						else 
							$tokens =  $subtokens;	 					 
						break;

			 default : $tokens[] = '&nbsp;';
			           $tokens[] = '&nbsp;';
	    }		 
			 
	    return ($tokens);	   	
	}
	
	public function invoiceway2() {
		//$ways = remote_arrayload('SHCART','invways',$this->path);
		$defway = remote_paramload('SHCART','invway_default',$this->path); 	
		$invtype = $defway ? $defway : 0;//override customers default invoice ??
 
		switch ($this->status) {
			case 1 : 	$template = _m('cmsrt.select_template use pinv');
						$subtemplate = _m('cmsrt.select_template use pinvline');
						$invoiceway = GetReq('invway') ? GetReq('invway') : 
									  $this->getDetailSelection('invway');
										
						if (defined('SHCUSTOMERS_DPC'))  { //override invtype!!!
							$allow = _v('shcustomers.allow_inv_selection');
							$invtype = _v('shcustomers.invtype');
							//if (!$allow) return null;
						}  
						//echo $this->is_reseller,'>';		
						if ($this->is_reseller)
							$dtypes = array(localize('_INVOICE',$this->lan), localize('_APODEIXI',$this->lan));
						else 
							$dtypes = ($invtype) ?  array(localize('_INVOICE',$this->lan), localize('_APODEIXI',$this->lan)):
													array(localize('_APODEIXI',$this->lan), localize('_INVOICE',$this->lan));

						foreach ($dtypes as $i=>$doctype) {
							$selected = ($doctype==$invoiceway) ? 'selected' : '';
							$tokens = array($doctype, $doctype, $selected, 'invway');
							$options[] = $this->combine_tokens($subtemplate, $tokens, true);
							unset ($tokens);
						}
						if (!empty($options)) {
							$opt = implode('', $options);
							$tokens2 = array('invway', $opt);
							return $this->combine_tokens($template, $tokens2, true);
						}	
						break;
	        case 3 :
		    case 2 :	$invoiceway = $this->getDetailSelection('invway');
						SetSessionParam('invway',$invoiceway);
						return ($invoiceway);	
						break;

			 default : 
	    }		    	
	}	
	
	public function invoiceDetails($notmpl=false) {
		$code = GetReq('invway') ? GetReq('invway') : 
			    $this->getDetailSelection('invway');

		if (defined('SHCUSTOMERS_DPC')) {
			//$isreseller = $this->is_reseller;//GetSessionParam('RESELLER');			
			//$customer = _m('shcustomers.getSelectedCustomer use ' . $code);
		}		
		
		return null;
	}	

	//ADDRESSWAY	
	
	public function addressway() {
		   	   
        switch ($this->status) {
			 case 1 : if (defined('SHCUSTOMERS_DPC')) {
					    //$combo=0;
	                    if ($deliv = _m('shcustomers.showdeliveryaddress use addressway')) {
							$pp = new multichoice('addressway',str_replace('<COMMA>',',',$deliv),null,false);
							$con = $pp->render();
							unset($pp);					
							$choice = $con;	
						}
						$addnewlink = _m('shcustomers.addnewdeliverylink use shcart>cartview');
	                  }
					  else
					    $con = "<input class=\"myf_input\" type=\"text\" name=\"addressway\" maxlenght=\"255\" value=\"\">"; 			 
					    
					  $subtokens[] = $con;
					  $subtokens[] = $addnewlink;						
					  
   		             if ($message = remote_paramload('SHCART','addresswaystext',$this->path)) {
		               $out .= $message;
					   $subtokens[] = $message;
					 }
					 else
					   $subtokens[] = '&nbsp;';
					   
					 $s1 = $this->get_selection_text('addressway',$subtokens);	
					 if ($s1) { 
						$tokens[] = $s1;
						$tokens[] = '&nbsp;';//dummy
						$tokens[] = '&nbsp;';//dummy
					 }	
					 else 
					    $tokens =  $subtokens;	   
		             break;
	         case 3 :					 	 
		     case 2 :$myiway = GetParam("addressway") ? GetParam("addressway") : GetSessionParam("addressway");
                     SetSessionParam('addressway',$myiway);		
					 
					 $subtokens[] = $myiway;
					 $subtokens[] = '&nbsp;';
					 $subtokens[] = '&nbsp;';
					 
					 $s1 = $this->get_selection_text('addressway',$subtokens);	
					 if ($s1) { 
						$tokens[] = $s1;
						$tokens[] = '&nbsp;';//dummy
						$tokens[] = '&nbsp;';//dummy
					 }	
					 else 
					    $tokens =  $subtokens;
					 			 
			         break;

			 default : $tokens[] = '&nbsp;';
					   $tokens[] = '&nbsp;';
					   $tokens[] = '&nbsp;';
			           $out = null;					  	 
			 	 
	    }
	   
	    return ($tokens);
	}
	
	public function addressway2() {
		   	   
        switch ($this->status) {
			 case 1 :	$template = _m('cmsrt.select_template use paddress');
						$subtemplate = _m('cmsrt.select_template use paddressline');
						$addressway = GetReq('addressway') ? GetReq('addressway') : 
									  $this->getDetailSelection('addressway');
										
						$addresses = _m('shcustomers.getAddresses');

						foreach ($addresses as $addressid=>$rec) {
							$selected = ($rec[0]==$addressway) ? 'selected' : '';
							$title = $rec[1] .' '. $rec[2] .' '. $rec[3];
							$tokens = array($rec[0], $title, $selected);
							$options[] = $this->combine_tokens($subtemplate, $tokens, true);
							unset ($tokens);
						}
						if (!empty($options)) {
							$opt = implode('', $options);
							$tokens2 = array('addressway', $opt);
							return $this->combine_tokens($template, $tokens2, true);
						}	
						break;
	         case 3 :						
			 case 2 :   $addressway = $this->getDetailSelection('addressway');
						SetSessionParam('addressway',$addressway);
						//return ($addressway);	//is id
						return _m('shcustomers.getSelectedAddress use ' . $addressway);

			 default : return null;					  	 
			 	 
	    }
	}	
	
	//also used inside invoice.htm (notmpl)
	public function addressDetails($notmpl=false) {
		$code = GetReq('addressway') ? GetReq('addressway') : 
			    $this->getDetailSelection('addressway');		

		if (defined('SHCUSTOMERS_DPC')) {

			if ((!$notmpl) && ($template = _m('cmsrt.select_template use paddressform'))) {
				
				$tokens = _m("shcustomers.getSelectedAddress use $code+1");
				
				//call roadway - payway
				$tokens[9] = $this->roadway2($tokens);
				
				return $this->combine_tokens($template, $tokens, true);
			}
			else
				return _m('shcustomers.getSelectedAddress use ' . $code);			
		}
		
		return null;
	}	
	
	//CUSTOMERWAY
	
	public function customerway() {
		   	   
        switch ($this->status) {
			 case 1 :
			   	      if (defined('SHCUSTOMERS_DPC')) {
						$combo=1;
	                    if ($cus = _m('shcustomers.showcustomers use customerway+'.$combo)) {
						  if ($combo) {
						    $choice = $cus;
						  }
						  else {
						    $pp = new multichoice('customerway',str_replace('<COMMA>',',',$cus),null,false);
					        $con = $pp->render();
					        unset($pp);						
							
							$choice = $con;
						  }
						}	
						$addnewlink = _m('shcustomers.addnewcustomerlink use shcart>cartview');    

						$subtokens[] = $choice;
						$subtokens[] = $addnewlink;
						
 						  
   		                if ($message = remote_paramload('SHCART','customerwaystext',$this->path)) {		
						  $subtokens[] = $message;
						}
						else
						  $subtokens[] = '&nbsp;';
						  
						$s1 = $this->get_selection_text('customerway',$subtokens,1,localize('_CUSTOMERSLIST',$this->lan),true);	
						if ($s1) { 
							$tokens[] = $s1;
							$tokens[] = '&nbsp;';//dummy
							$tokens[] = '&nbsp;';//dummy
						}	
						else 
							$tokens =  $subtokens;
						  				
					 }	 
		             break;
	         case 3 :					 	 
		     case 2 :$mycway = GetParam("customerway") ? GetParam("customerway") : GetSessionParam("customerway");
                     SetSessionParam('customerway',$mycway);	

					 $subtokens[] = _m('shcustomers.showcustomers use customerway++++'.$mycway);
					 $subtokens[] = '&nbsp;';
					 $subtokens[] = '&nbsp;';
					 
					 $s1 = $this->get_selection_text('customerway',$subtokens,1,localize('_CUSTOMERSLIST',$this->lan),true);	
					 if ($s1) { 
						$tokens[] = $s1;
						$tokens[] = '&nbsp;';//dummy
						$tokens[] = '&nbsp;';//dummy
					 }	
					 else 
						$tokens =  $subtokens;						 				 
			         break;

			 default : $tokens[] = '&nbsp;';
			           $tokens[] = '&nbsp;';
					   $tokens[] = '&nbsp;'; 
			           $out = null;					  	 	 	 
	    }
	   
	    return ($tokens);
	}	
	
	public function customerway2() {
		   	   
        switch ($this->status) {
			 case 1 :   $template = _m('cmsrt.select_template use pcust');
						$subtemplate = _m('cmsrt.select_template use pcustline');
						$customerway = GetReq('customerway') ? GetReq('customerway') : 
									   $this->getDetailSelection('customerway');
										
						$customers = _m('shcustomers.getCustomers');
						//print_r($customers);
						foreach ($customers as $customerid=>$rec) {
							$selected = ($rec[0]==$customerway) ? 'selected' : '';
							$tokens = array($rec[0], $rec[1], $selected);
							$options[] = $this->combine_tokens($subtemplate, $tokens, true);
							unset ($tokens);
						}
						if (!empty($options)) {
							$opt = implode('', $options);
							$tokens2 = array('customerway', $opt);
							return $this->combine_tokens($template, $tokens2, true);
						}	
						break;
	         case 3 :					 	 
		     case 2 : 	$customerway = $this->getDetailSelection('customerway');
						SetSessionParam('customerway',$customerway);
						//return ($customerway); //is id
						$fields = explode('<br/>', _m('shcustomers.getSelectedCustomer use ' . $customerway));
						return $fields[0];
						break;

			 default : 				  	 	 	 
	    }
	}	
	
	public function customerDetails($notmpl=false) {
		$code = GetReq('customerway') ? GetReq('customerway') : 
			    $this->getDetailSelection('customerway');		

		if (defined('SHCUSTOMERS_DPC')) {

			if ((!$notmpl) && ($template = _m('cmsrt.select_template use pcustform'))) {
				
				$tokens = _m("shcustomers.getSelectedCustomer use $code+1");
				return $this->combine_tokens($template, $tokens, true);
			}
			else
				return _m('shcustomers.getSelectedCustomer use ' . $code);			
		}
		
		return null;
	}	
	
	//COMMENTS
	
	public function comments() {
	
        switch ($this->status) {
			case 1  :	//DISABLED FIELD sxolia.htm (USE FIELD INSIDE SHCART.htm)
			            $subtokens[] = "<input class=\"myf_input\" type=\"text\" name=\"sxolia\" maxlenght=\"255\" value=\"{$this->sxolia}\">";
						$s1 = $this->get_selection_text('sxolia',$subtokens);	
						$tokens[] = $s1 ? $s1 : $subtokens;	  
						break;
	        case 3  :	$subtokens[] = GetSessionParam("sxolia");
						$s1 = $this->get_selection_text('sxolia',$subtokens);	
						$tokens[] = $s1 ? $s1 : $subtokens;
						break;
		    case 2  :	$sxolia = GetParam("sxolia") ? GetParam("sxolia") : GetSessionParam("sxolia");
						$subtokens[] = $sxolia;
						$s1 = $this->get_selection_text('sxolia',$subtokens);	
						$tokens[] = $s1 ? $s1 : $subtokens;					 
						//hold param
						SetSessionParam('sxolia',$sxolia);					 
						break;		     
					 
			default : 	$tokens[] = '&nbsp;';
						$out = null;
		   }	 
		   
		   return ($tokens); 	
	}

	//call from tmpls to add sxolia 
    public function	addRemarks($text=null,$append=null) {
		$sxolia = GetSessionParam('sxolia'); 
		if ($append==true)
			SetSessionParam('sxolia', $sxolia.$text);
		else
			SetSessionParam('sxolia', $text);
		
		return null;
	}
	
	//call from tmpls to del sxolia 
    public function	delRemarks() {
		
		SetSessionParam('sxolia', '');
		return null;
	}	
	
	protected function get_selection_text($id,$params=null) {
		$out = null;

		$mytemplate = _m('cmsrt.select_template use ' . $id);
		$out = $this->combine_tokens($mytemplate,$params,true);
		
		return ($out);	   	    	
	}	

	//CALULATIONS

    protected function calculate_totals() {
		$ret = 0;

	    $this->mydiscount = ($this->total > 0) ? ($this->discount ? ($this->total*$this->discount)/100 : 0) : 0; 
		$this->myshippingcost = ($this->total > 0) ? ($this->shippingcost ? $this->shippingcost : 0) : 0;		 
		if (($this->tax) && ($this->status)) {
			//($this->is_reseller)) {//is or not reseller calculate tax except if status <3
			$this->mytaxcost = (($this->total - $this->mydiscount) * 
								$this->tax)/100; //+$this->myshippingcost
		}
		else
			$this->mytaxcost = 0;

		$this->myfinalcost =  ($this->total - $this->mydiscount) + $this->mytaxcost + $this->myshippingcost;
	   	   
		$ret = number_format(floatval($this->myfinalcost),$this->dec_num,',','.');						

	    return ($ret);
    }	

    protected function print_button() {
		/* DISABLE PRINT BUTTON, VIEW ONLY AT TRANSACTIONS
	    $title = localize('_TRANSPRINT',$this->lan);
		$translink = 'printcart/';
		$ret = $this->myf_button(localize('_TRANSPRINT',$this->lan),$translink,'_TRANSPRINT');
	    */
		if (($this->fastcart) || ($this->superfastcart)) 
			return null;	

	    //VIEW TRANSACTIONS
		if ((defined('SHTRANSACTIONS_DPC'))) {
			//$out .= _m('shtransactions.viewTransactions');
			$lnk1 = _m('cmsrt.url use t=transview'); 
			
			$trans_button = '&nbsp;'.$this->myf_button(localize('_TRANSLIST',$this->lan),$lnk1);
		} 	

		//CLICK AWAY
		//if (GetSessionParam("roadway"=='clickaway')) {
			$lnk2 = _m('cmsrt.url use t=clickaway'); 

			$caway_button = '&nbsp;'.$this->myf_button(localize('_CLICKAWAYENABLE',$this->lan),$lnk2);
		//} 
			
		return ($ret . $trans_button . $caway_button);
    }
	
	protected function finalize_cart_success() {
		$out = null;
		$this->update_statistics('cart-final-purchase', $this->user);		
		
		if ($mygototitle = $this->onSuccessGotoTitle) {
			$onsuccess = explode('/',$mygototitle); 
			$onsuccesstitle = $onsuccess[$this->lan];
		}
		else 
			$onsuccesstitle = localize('_HOME',$this->lan);	
		
        $goto = $this->aftersubmitgoto ?
				$this->aftersubmitgoto : GetSessionParam('aftersubmitgoto');		
				
		$gobutton =  _m("cmsrt.url use t=$goto+$onsuccesstitle");
		
		$payway = $this->getDetailSelection('payway');
		$roadway = $this->getDetailSelection('roadway');	   
		$invway = $this->getDetailSelection('invway');	   
		$addressway = $this->getDetailSelection('addressway');		   
		$sxolia = $this->getDetailSelection('sxolia'); 
				
		$tokens[] = $this->transaction_id;				
		$tokens[] = $this->print_button();		
		$tokens[] = (($this->fastcart) || ($this->superfastcart)) ? $onsuccesstitle : $gobutton; 

		//change status of transaction
        //if (defined('SHTRANSACTIONS_DPC')) 
		   // _m('shtransactions.setTransactionStatus use '.$this->transaction_id."+1");					
		
		//if (($this->fastcart) || ($this->superfastcart)) 
			//return $tokens[0];		
		//else
		$mycarttemplate = _m('cmsrt.select_template use shcartsuccess');	
		$out = $this->combine_tokens($mycarttemplate,$tokens,true);		
		return ($out);
	}

	protected function finalize_cart_error() {
		$out = null;
		$this->update_statistics('cart-final-error', $this->user);	
		
		if ($err1 = $this->mailerror) {
			//change status of transaction
            if (defined('SHTRANSACTIONS_DPC')) 
		        _m('shtransactions.setTransactionStatus use '.$this->transaction_id."+-3");
			
			$error = $err1;//echo $error;
		}
		
		if ($err2 = $this->submiterror) { 
			//change status of transaction ?!
            if (defined('SHTRANSACTIONS_DPC')) 
		        _m('shtransactions.setTransactionStatus use '.$this->transaction_id."+-4");
						
			$error .= $err2; //"/Invalid transaction id.";
		}	
							 		
		$msg = localize('_TRANSERROR',$this->lan) . "&nbsp;" . "<a href='contact.php'>{$this->carterror_mail}</a>";
		$tokens[] = localize('_CARTERROR',$this->lan);//$msg; 			
		$tokens[] = $error;
		
		if ($this->testcart) { /* TEST MODE */}
		else {
			
			$mailerr = $this->transaction_id . '<br/>' . $this->user . '<br>' . $error;
			
			//MAIL THE ORDER TO HOST
			$merr = $this->cart_mailto($this->cartreceive_mail,"Error in transaction " . $this->transaction_id, $mailerr);
		
			//TO CUSTOMER
			//$err2 = $this->cart_mailto($this->user, $mailSubject, $mailout);		    			  
		}  		
		
		$mycarttemplate = _m('cmsrt.select_template use shcarterror');
		$out = $this->combine_tokens($mycarttemplate,$tokens,true);				
		return ($out);
	}
	
	public function quickview($ret_tokens=false, $template1=null, $template2=null) {	
		$out = null;
		 
		if ($this->notempty()) {
			
			$template = $template1 ? $template1 : 'fpcartline';	
			$mytemplate = _m('cmsrt.select_template use ' . str_replace('.htm', '', $template));
		
			$template2 = $template2 ? $template2 : 'fpcart';
			$mytemplate2 = _m('cmsrt.select_template use ' . str_replace('.htm', '', $template2));
	  
			$ret = '';
			foreach ($this->buffer as $prod_id => $product) {

				if (($product) && ($product!='x')) {
		 
					$toks = array();//reset line
			 
					$aa+=1;
					$param = explode(";",$product);
					$cat = $param[4];
					$itemdescr = $this->replace_cartchars($param[1], true);
					$id = $param[0]; //for links			   
					
					$toks[] = $prod_id+1;
					$toks[] = $param[0]; //$id;
					$toks[] = _m("cmsrt.url use t=kshow&cat=$cat&id=$id+" . $itemdescr); 
					$toks[] = number_format(floatval($param[8]),$this->dec_num,',','.');
					$toks[] = $param[9];
					
					$sum = floatval($param[8])*floatval($param[9]);//$param[11];
					$toks[] = number_format($sum,$this->dec_num,',','.') . $this->moneysymbol;
					
					$toks[] = _m($this->shclass . ".get_photo_url use ". $param[7] .'+1');
					$toks[] = _m("cmsrt.url use t=kshow&cat=$cat&id=$id");
					$toks[] = $itemdescr;
					$toks[] = $cat;
					$toks[] = $param[7]; 
					
					$toks[] = $param[10]; // 11
					$toks[] = $param[11];
					$toks[] = $param[14];
					$toks[] = $param[15];
			   
					if ($ret_tokens) 
						return $toks;	 
					else	
						$ret .= $this->combine_tokens($mytemplate,$toks,true);
				}  
			}			
		}				 

		$out = $this->combine_tokens($mytemplate2, array(0=>$ret, 1=>$this->myquickcartfoot()));

		return ($out);
	}

	//called inside funcs without uni2uni1 convertions and storage check methods
    protected function quick_recalculate() {

		$p_returned = _m($this->shclass . '.update_prices use '.serialize($this->buffer));	
	   
	    $this->read_policy();		   
	   
	    $this->qty_total = 0;
	    SetSessionParam('qty_total',0);
	    $this->total = 0;
	   
	    $counter = 0;
        foreach ($this->buffer as $prod_id => $product) {
			if (($product) && ($product!='x')) {
           
				$counter+=1;
				$param = explode(";",$product);
				
				$id = $param[7]; //$param[0];
				$qty = $param[9];		   
				$selectedqty = intval($param[9]);
		   
				$this->qty_total += intval($qty);
		   
				//new prices when updated from db (live)
				if (is_array($p_returned) && isset($p_returned[$id])) {

					$ap_price = _m($this->shclass . ".read_qty_policy use ". $id.'+'.$p_returned[$id]."++".$selectedqty);			 		   			 			 		   
					$param[8] = $ap_price ? $ap_price : $p_returned[$id];
				}		   
		   
				$p = floatval(str_replace(',','.',$param[8]));
				$this->total = $this->total + ($qty * $p); 
			}
	    }

	    if ($this->itemscount)
			SetSessionParam('qty_total',$counter);//items count
	    else
			SetSessionParam('qty_total',$this->qty_total);//qty count
		 
	    $this->colideCart();	 
		
	    //$this->calculate_shipping();	//deprecated		  
		$this->calcShipping();
	}

	public function foot($token=null) {
	
		$this->quick_recalculate();	
	   
	    //0 token
		$_ttc =  number_format(floatval($this->total),$this->dec_num,',','.'). $this->moneysymbol;
		$tokens[] = $_ttc; 
		
		if (!$this->status) {	
	     
			SetSessionParam('subtotal',$this->total);   
			SetSessionParam('total',$this->total);	//the same	 
		 
			if ((($this->tax) && ($this->is_reseller)) ||
				(($this->tax) && (!$this->showtaxretail))) {
			 
			    //calc here
				$this->mytaxcost = (($this->total - $this->mydiscount) * $this->tax)/100;
		   
				$_tdisc = null;
				$tokens[] = $_tdisc;//dummy token discount
			  
				$_txcost =  number_format(floatval($this->mytaxcost),$this->dec_num,',','.'). $this->moneysymbol;		   
				$tokens[] = $_txcost;		 	   		   
			}
			else 
				$tokens[] = '';	
		 
			//fill array with empty tokens when not all fields are active
			for ($x=count($tokens);$x<26;$x++) //6<<include details
				$tokens[] = '';		 
	    }
	    else {
		    //1 token
			if ($this->discount) {
				
				$this->mydiscount = ($this->discount) ? 
									($this->total * $this->discount)/100 : 0;
				
				//percent (discount) or value (mydiscount)
				$_tdisc = ($this->status>1) ? 
				           '-'. number_format(floatval($this->mydiscount),$this->dec_num,',','.') . $this->moneysymbol :
						   	    number_format(floatval($this->discount),$this->dec_num,',','.') . '%';
				$tokens[] = $_tdisc;
			} 
			else 
				$tokens[] = '';		 
		  	
			//2 token	
			if ((($this->tax) && ($this->is_reseller)) ||
				(($this->tax) && (!$this->showtaxretail))) {
			
			    //calc here
				$this->mytaxcost = (($this->total-$this->mydiscount) * $this->tax)/100;
			
				$_txxcost = number_format(floatval($this->mytaxcost),$this->dec_num,',','.'). $this->moneysymbol;		   
				$tokens[] = $_txxcost;		   
			}
			else
				$tokens[] = '';	
		 
		    //3 token
			if ($this->shippingcost) {   
				$_shcost = number_format(floatval($this->shippingcost),$this->dec_num,',','.'). $this->moneysymbol;		   
				$tokens[] = $_shcost;		   
			}
			else
				$tokens[] = '';			 
		  		 
			//4 token, final cost
			if (($this->discount) || ($this->shippingcost) || ($this->tax)) {
		 
				$finalcost = ($this->total-$this->mydiscount) +
				              $this->mytaxcost + 
							  $this->shippingcost;
		 
				$_ffcost = number_format(floatval($finalcost),$this->dec_num,',','.'). $this->moneysymbol;		   
				$tokens[] = $_ffcost;
		   
				SetSessionParam('subtotal',$this->total);   
				SetSessionParam('total',$finalcost);	//the final cost			   	 
			}
			else
				$tokens[] = '';	
		 
		    /* DISABLED TOKENS	
		    foreach ($this->customerway() as $t=>$tt)
				$tokens[] = $tt;
			foreach ($this->invoiceway() as $t=>$tt)
				$tokens[] = $tt;
			foreach ($this->roadway() as $t=>$tt)
				$tokens[] = $tt;
			foreach ($this->payway() as $t=>$tt)
				$tokens[] = $tt;
			
			if (!$nodeliv = remote_paramload('SHCART','nodelivery',$this->path)) {			 
				foreach ($this->addressway(true) as $t=>$tt)
					$tokens[] = $tt;
			}	
			if (!$nocomm = remote_paramload('SHCART','nocomments',$this->path)) {		 
				foreach ($this->comments() as $t=>$tt)
					$tokens[] = $tt;
			}
			*/	
			
			//EXTRA TOKENS
			
		    //5 token
			if ($this->transportcost) {   
				$_trcost = number_format(floatval($this->transportcost),$this->dec_num,',','.'). $this->moneysymbol;		   
				$tokens[] = $_trcost;		   
			}
			else
				$tokens[] = '';		

		    //6 token
			if ($this->paymentcost) {   
				$_prcost = number_format(floatval($this->paymentcost),$this->dec_num,',','.'). $this->moneysymbol;		   
				$tokens[] = $_prcost;		   
			}
			else
				$tokens[] = '';				
	    }
		
		//echo $this->total,':',$this->mydiscount;	
		//if ($coupon = GetParam('coupon')) echo $coupon;
		
		$tstep = $this->status ? strval($this->status) : '0';	
		$mysteptemplate = _m('cmsrt.select_template use shcartfooterstep' . $tstep);
		if (isset($mysteptemplate))
			$out = _m("cmsrt._ct use shcartfooterstep$tstep+" . serialize($tokens) . '+1');
		else
			$out = _m('cmsrt._ct use shcartfooter+' . serialize($tokens) . '+1');
		return ($out);
	}	

	public function myquickcartfoot() {

		$this->quick_recalculate();
				
		$_ttc =  number_format(floatval($this->total),$this->dec_num,',','.'). $this->moneysymbol;
		$tokens[] = $_ttc; 			

		//rest sums 
		if ($this->discount) {
			$this->mydiscount = ($this->discount) ? 
								($this->total * $this->discount)/100 : 0;
				
			//percent (discount) or value (mydiscount)
			$_tdisc = ($this->status>1) ? 
			           '-'. number_format(floatval($this->mydiscount),$this->dec_num,',','.') . $this->moneysymbol :
					   	    number_format(floatval($this->discount),$this->dec_num,',','.') . '%';			
					   
		    $tokens[] = $_tdisc;
		} 
		else
		    $tokens[] = '';		   

	   
		if ((($this->tax) && ($this->quicktax) && ($this->is_reseller)) ||
			(($this->tax) && ($this->quicktax) && (!$this->showtaxretail))) {
		   
			$this->mytaxcost = ((($this->total)*$this->tax)/100);//($this->total*$this->tax)/100;
		   
			$_ttd = number_format(floatval($this->mytaxcost),$this->dec_num,',','.'). $this->moneysymbol;
			$tokens[] = $_ttd;  			
		   
		    $grandtotal = $this->total + $this->mytaxcost;
		   
			$_ttg = number_format(floatval($grandtotal),$this->dec_num,',','.'). $this->moneysymbol;
			$tokens[] = $_ttg;  				
		}
		else
		    $tokens[] = '';	
		
	    if ($this->shippingcost) { 
			//echo 'sc:',$this->shippingcost;

            $_shcost = number_format(floatval($this->shippingcost),$this->dec_num,',','.'). $this->moneysymbol;		   
		    $tokens[] = $_shcost;
			/*
			if ($this->supershipping) {//link
		     //echo 'ss:',$this->supershipping;
             $data2[] = "<B>" . seturl('t=sship',localize('_SHIPCOST',$this->lan)) . " :</B>";		   
		    */
	    }
        else
			$tokens[] = '';			 
		  		 
		//final cost
		if (($this->discount) || ($this->shippingcost) || ($this->tax)) {
		 
			$finalcost = ($this->total+$this->mytaxcost+$this->shippingcost)-$this->mydiscount;
		 
            $_ffcost = number_format(floatval($finalcost),$this->dec_num,',','.'). $this->moneysymbol;		   
		    $tokens[] = $_ffcost;

			SetSessionParam('subtotal',$this->total);   
			SetSessionParam('total',$finalcost);	//the final cost			   	 
		}
		else
			$tokens[] = '';		   
	   
		//echo $this->total,':',$this->mydiscount;	
		//if ($coupon = GetParam('coupon')) echo $coupon;	   
	   
		$out = _m('cmsrt._ct use fpcartfooter+' . serialize($tokens) . '+1');
		return ($out);
	}

	protected function todolist() {
	    //echo $this->todo,'>';
		$mytemplate = _m('cmsrt.select_template use ' . $this->todo);
		 
		switch ($this->todo) {
			
			case 'fastcart'        :$this->status = 1;
									$ret = $this->cartview();//default view	

									break;

			case 'loginorregister' :if (defined('SHLOGIN_DPC')) 
										$a = _m("shlogin.quickform use +viewcart+shcart>cartview+status+1");  
									else
										$a = _m("cmslogin.quickform use +viewcart+shcart>cartview+status+1");  

									if (defined('SHUSERS_DPC')) 
										$b = _m("shusers.regform");
									
									$c = $this->quickview();									
									
								    $res = $a . $b; //any return data
								    if ($res) {
										$tokens[] = $a;
										$tokens[] = $b;
										$tokens[] = $c;
									
										$ret = $this->combine_tokens($mytemplate,$tokens,true);								
									} 
								    else
										$ret = $this->cartview();//default view										 
									break;
			case 'unknownlogin' :	break;
			case 'login'        :   break;
	   }

	   return ($ret);
	}
	
	public function getcartCount() {
		return $this->_count();
	}
	
	public function getcartTotal($noformat=null, $tax=null) {
		//$val = GetSessionParam('total'); 
		if (!$val = GetSessionParam('total')) 
			return $noformat ? floatval('0.0') : number_format(floatval('0.0'),$this->dec_num,',','.');
		
		$taxval = (!$this->status) ? ((floatval($val)*$this->tax)/100) : 0; /*0 when status>0 is recalc inside */
		$sval = ($tax) ? ($val + $taxval) : $val;
	   
		$ret = $noformat ? floatval($sval) : number_format(floatval($sval),$this->dec_num,',','.');	
		return ($ret);
	}
		
	public function getcartSubtotal($noformat=null) {
	   
		$val = GetSessionParam('subtotal');   
		$ret = $noformat ? floatval($val) : number_format(floatval($val),$this->dec_num,',','.');		   
		return ($ret);	
	}
	
	public function getcartItems() {
	   
		$itm = GetSessionParam('qty_total');
		$ret = $itm?$itm:'0';
		return ($ret);	
	}
	
	//use exact code if sizecolor attr
	public function getCartItemQty($id=null, $default=null, $exact=false) {
		$qtymeter = 0;
		if (!$id) return;
	
		$_xe = $exact ? 7 : 0;
		foreach ($this->buffer as $i=>$rec) {
			$data = explode(';',$rec);
			if ($data[$_xe]==$id) {
				$qtymeter+=$data[9];
			}
		}
		
		return ($default ? $default : $qtymeter);		
	}		
	
	/* get the cart position id in list */
	public function getCartItemPosition($id=null) {
		if (!$id) return;
	
		foreach ($this->buffer as $i=>$rec) {
			$data = explode(';',$rec);
			if ($data[0]==$id) 
				return ($i+1);
		}
		
		return 1;		
	}	
	
	//fix price view sub-template for all templates in theme
	public function getCartPriceSubTemplate($tmpl=null,$price1=null,$itmcode=null,$cartbutton=null,$zeroreturn=false) {
		$template = $tmpl ? $tmpl : 'shcartprice-subtemplate';
		if (($zeroreturn) && (floatval(str_replace(',','.',$price1))==0.0))
			return null;
		
		$mytemplate = _m("cmsrt.select_template use " . $template);		  
		$out = $this->combine_tokens($mytemplate, array(0=>$cartbutton, 1=>$price1, 2=>$itmcode),true);
		
		return ($out);
	}
	
	/*
			$params = array(0=>$item,
							1=>$this->replace_cartchars($title),
							2=>'',
							3=>'',
							4=>$cat,
							5=>$page,
							6=>'',
							7=>$item,
							8=>$priceqty,
							9=>1,
							10=>$_pSize,
							11=>$_pColor,							
							12=>$result->fields['uniname2'],
							13=>$result->fields['uni2uni1'],								
							14=>$result->fields['ypoloipo1'],
							15=>0,	
							);	
	*/
	//support size/color
	protected function colideCart() {
		if (empty($this->buffer)) return;
		$tempbuffer = array();
		$_price = array();
		$_qty = array();
		$_backorder = array();
	
		foreach ($this->buffer as $i=>$rec) {
			if ($rec!='x') {
				
				$data = explode(';',$rec);
				
				//0..7 = common attr plus 
				//then replace @A@ with price and qty
				//10..14 for size/color etc (same code diff size/color not colide)
				//then replace @B@ as 15th element = backorder qty
				$cs = $data[0].';'.$data[1].';'.$data[2].';'.$data[3].';'.$data[4].';'.$data[5].';'.$data[6].';'.$data[7].
						';@8@;@9@;'.$data[10].';'.$data[11].';'.$data[12].';'.$data[13].';'.$data[14].';@15@;';
						
				//$tempbuffer[$cs] = intval($tempbuffer[$cs])+intval($data[9]).';'.$data[8];
				
				if ($data[8]) $_price[$cs] = $data[8]; //override with last element
				if ($data[9]>0) $_qty[$cs] += $data[9];
				if ($data[15]>0) $_backorder[$cs] += $data[15]; else $_backorder[$cs] = 0;
				
				$tempbuffer[$cs] =  $data[8] .';'. $data[9];
			}
		}	

		if (!empty($tempbuffer)) {
			
			unset($this->buffer);
			
			foreach ($tempbuffer as $trec=>$priceandqty) {

				$params = explode(';',$priceandqty);
				$price = $_price[$trec];
				$qty = $_qty[$trec];
				$backorder = $_backorder[$trec];
				$this->buffer[] = str_replace(array('@8@','@9@','@15@'), 
											  array($price, $qty, $backorder), 
											  $trec);
			}		
		}	
	  
		$this->setStore();    
	}	
	
	/****************** user discount policy - coupons - points ****/
	
	public function read_policy() {
		
		//clickaway code posted
		if ($this->clickawaycode = GetParam('clickawaycode')) {
			SetSessionParam('clickacode',GetParam('clickawaycode'));
		}
		else	
			$this->clickawaycode = GetSessionParam('clickacode') ?? null;
		
        /*posted coupon discount or points policy discount*/
		$this->discount = GetSessionParam('cdiscount') ? 
							GetSessionParam('cdiscount') : $this->get_user_price_policy();
							
		//echo $this->discount ,'-';					
		//echo GetSessionParam('cdiscount'),':', GetSessionParam('pdiscount'),'-';
		//echo $_SESSION['coupon'],':',$_SESSION['points'];
		return ($this->discount);
	}

	/*...*/
	protected function get_user_price_policy() {
		$db = GetGlobal('db');		
		if (!$this->loyalty) return 0;
		
	    $reseller = GetSessionParam('RESELLER');	

		if ($id = $this->user) { 
		
			if ($coupon = GetParam('coupon')) { //one record named coupon price policy
				$sSQL = "select discount as disc from ppolicy where active=1 and code1=" .  $db->qstr($coupon);
				//$sSQL.= " and name=" .  $db->qstr($id) ; // (named coupon)
				//echo $sSQL;
				$result = $db->Execute($sSQL);
				
				//save used coupon (and disable after order submit)		
				if ($cdiscount = $result->fields[0]) {
					
					SetSessionParam('coupon', $coupon);
					SetSessionParam('cdiscount', $cdiscount);
					$this->isValidCoupon = true;
					
					$this->jsDialog(localize('_couponvalid', $this->lan), 
									localize('_discount', $this->lan) . ': '. $cdiscount . '%');	
					$ret = $cdiscount;
				}
				else
					$this->jsDialog(localize('_couponinvalid', $this->lan),
									localize('_coupon', $this->lan) . ': '. $coupon);	
			}
		    else { 
			    //user defined multiple price policy rows 
				$sSQL = "select sum(discount) as disc, sum(points) as pnt from ppolicy where code1=" .  $db->qstr($id) ;
				$sSQL.= " and active=1 group by code1";
				//echo $sSQL;
				$result = $db->Execute($sSQL);
				if ($pdiscount = $result->fields[0]) {
					
					SetSessionParam('points', $result->fields[1]);
					//SetSessionParam('pdiscount', $pdiscount);	//do not save (default ppolicy)
					/*
					$this->jsDialog(localize('_pointsused', $this->lan),
									localize('_discount', $this->lan) . ': '. $pdiscount . '%');
					*/					
					$dline[] = localize('_usedpointsdiscount', $this->lan) . ': '. $pdiscount . '%';
					$ret = $pdiscount;
				}

				//cart total price policy (valid only when not a coupon)
				$sSQL = "select discount,points from ppolicy where active=1 and code1 is NULL and code2 is NULL";
				$sSQL.= " and price <= " . $this->total;
				$sSQL.= " order by price desc LIMIT 1";
				//echo $sSQL;
				$result = $db->Execute($sSQL);		
				if ($cartdiscount = $result->fields[0]) {
					//echo 'cart discount';
					/*$this->jsDialog(localize('_pointstoset', $this->lan),
									localize('_points', $this->lan) . ': '. $result->fields[1]);			
					*/		
					$dline[] = localize('_totalcartdiscount', $this->lan) . ': '. $cartdiscount . '%';
					$dline[] = localize('_pointstoset', $this->lan) . ': '. $result->fields[1];
					
					$ret += $cartdiscount;	//plus !!!!
				}
				
				//dlines total messages dialog
				if (!empty($dline)) {
					$this->ppolicynotes = implode('<br/>',$dline);
					$this->jsDialog($this->ppolicynotes , localize('_discount', $this->lan));				
					//SetSessionParam('ppolicytext', $dtext); //used by html dac pages
				}	
			}			
	    }
	    else { //anonymous coupon
		
			if ($coupon = GetParam('coupon')) { //one record coupon price policy
				$sSQL = "select discount as disc from ppolicy where active=1 and code1=" .  $db->qstr($coupon);
				//echo $sSQL;
				$result = $db->Execute($sSQL);
				//save used coupon (and disable after order submit)		
				if ($cdiscount = $result->fields[0]) {
					
					SetSessionParam('coupon', $coupon);
					SetSessionParam('cdiscount', $cdiscount);
					$this->isValidCoupon = true;
					
					$this->jsDialog(localize('_couponexist', $this->lan), 
									localize('_discount', $this->lan) . ': '. $cdiscount . '%');	
					$ret = $cdiscount;
				}
				else
					$this->jsDialog(localize('_couponnotexist', $this->lan),
									localize('_coupon', $this->lan) . ': '. $coupon);	
			}		   
	    }
		
	    return ($ret ? $ret : 0);
	}

	public function validCoupon() {
		return $this->isValidCoupon;
	}	
	
	protected function savePoints($user, $trid) {
		$db = GetGlobal('db');		
		if (!$this->loyalty) return null;
		$sumofpoints = 0;
		
		if ($this->notempty()) {
			foreach ($this->buffer as $prod_id => $product) {
				if (($product) && ($product!='x')) {
					
					$toks = array();//reset line
			 
					$aa+=1;
					$param = explode(";",$product);
					$cat = $param[4];
					$itemdescr = $this->replace_cartchars($param[1], true);
					$id = $param[7]; //$param[0];

					$points = _m($this->shclass . ".read_point_policy use ". $id); 
		            if (!$points) continue;					
					
					$sSQL = "insert into custpoints (active,ccode,item,source,notes,points) values (1,'$user','$id','$trid','$itemdescr',$points)";					
					$res = $db->Execute($sSQL);
					
					$sum = ($points * $param[9]);
					$sumofpoints += $sum;
				}  
			}

			//sum of points !!!??? 
			if ($sumofpoints>0) {
				$sSQL = "insert into ppolicy (active,code1,code2,name,descr,points) values (1,'$user','$user','$trid','$trid',$sumofpoints)";
				$res = $db->Execute($sSQL);	
			}

            //disable point records or used coupon
			//if ($usedpoints = GetSessionParams('points')) {
			if ($coupon = GetSessionParams('coupon')) {	
				$sSQL = "update ppolicy set active=0 where active=1 and code1=" .  $db->qstr($coupon);
				//echo $sSQL;
				/*$result = $db->Execute($sSQL);
				
				//reset coupon
				SetSessionParam('coupon', '');
				SetSessionParam('cdiscount', 0);*/
			}		
		}				 

		return ($sumofpoints);		
	}	
	
	public function pointsview($ret_tokens=false, $template1=null, $template2=null) {
		if (!$this->loyalty) return null;
		
		if ($this->notempty()) {
			
			$template = $template1 ? $template1 : 'fpcartpoints';	
			$mytemplate = _m('cmsrt.select_template use ' . str_replace('.htm', '', $template));
		
			$template2 = $template2 ? $template2 : 'fpcartpoints-alt';
			$mytemplate2 = _m('cmsrt.select_template use ' . str_replace('.htm', '', $template2));
	  
			$ret = '';
			foreach ($this->buffer as $prod_id => $product) {

				if (($product) && ($product!='x')) {
					
					$toks = array();//reset line
			 
					$aa+=1;
					$param = explode(";",$product);
					$cat = $param[4];
					$itemdescr = $this->replace_cartchars($param[1], true);
					$id = $param[7]; //$param[0];

					$points = _m($this->shclass . ".read_point_policy use ". $id); 
		            if (!$points) continue;					
					
					$toks[] = $prod_id+1;
					$toks[] = $id;
					$toks[] = _m("cmsrt.url use t=kshow&cat=$cat&id=$id+" . $itemdescr); 
					$toks[] = $points;
					$toks[] = $param[9];
					
					$sum = ($points * $param[9]);
					$toks[] = $sum;
					
					$toks[] = _m($this->shclass . ".get_photo_url use ".$id.'+1');
			   
					if ($ret_tokens) 
						return $toks;	 
					else	
						$ret .= $this->combine_tokens($mytemplate,$toks,true);
				}  
			}			
		}				 

		$out = $this->combine_tokens($mytemplate2, array(0=>$ret, 1=>$this->myquickcartfoot()));

		return ($out);		
	}		
	
	
	/****************** shipping  *******************************/
	
	//standart roadway, payway costs
	protected function calcShipping() {
		$db = GetGlobal('db');
		
		if ($this->superfastcart) {
			$road_code = 'Courier'; //superfastcart uses only courier method
			$pay_code = GetParam('payway');
		}
		else {	
			$road_code = $this->getDetailSelection('roadway');
			$pay_code = $this->getDetailSelection('payway');
		}
		
		//transport cost
		if ($code = $road_code) { //$this->getDetailSelection('roadway')) {
			$sSQL = "select cost from ptransports where ";
			$sSQL.= "code=" . $db->qstr($code);
			$res = $db->Execute($sSQL);	
			$tcost = $res->fields[0];
			
			//save transport cost
			$this->transportcost = floatval($tcost);
			SetSessionParam('transcost', $this->transportcost);
		}
		else
			$this->transportcost = GetSessionParam('transcost');	
		
		//payment cost
		if ($code = $pay_code) { //$this->getDetailSelection('payway')) {
			$sSQL = "select cost from ppayments where code=" . $db->qstr($code);	
			$res = $db->Execute($sSQL);	
			$pcost = $res->fields[0];
			
			//save payment cost
			$this->paymentcost = floatval($pcost);
			SetSessionParam('paycost', $this->paymentcost);
		}
		else
			$this->paymentcost = GetSessionParam('paycost');
		
		
		if ($this->total > 0) {
			//save shipping cost as result of transp cost + payment cost
			$result = floatval($this->transportcost) + floatval($this->paymentcost);			
		}
		else
			$result = 0; //when no items in cart
		
		$this->shippingcost = $result;
		SetSessionParam('shipcost', $this->shippingcost);		
		
		return ($result);			
	}		
	
	/* disabled */
	protected function calculate_shipping() {
		$ways = remote_arrayload('SHCART','roadways',$this->path);
		//print_r($ways);
		//echo 'a';
		if (!$ways) return null;	
		//echo 'b';
		$wp = $ways[0];
		$w = explode('/',$wp);
		$roadway = array_pop($w);
		/*$shipway = GetParam("roadway") ? //no table in greek
						($this->lan ? //if in greek, get the english descr
								str_replace('/'.GetParam("roadway"),'',$ways[0]) : standart english descr 0array  
								GetParam("roadway")
						) :
						(GetSessionParam("roadway") ? 
								GetSessionParam("roadway") : 
								$roadway  //standart english descr ??? 0array
						);*/	
		$shipway = $this->getDetailSelection('roadway');				
		//echo 'b',$shipway;
		
		if ($this->supershipping) {
			//echo 'c';
			$cartweight = $this->weightCart();
			//echo '>',$cartweight; 
		
			$this->shippingcost = $this->calc_supershipping($cartweight,$shipway);
			SetSessionParam('shipcost',$this->shippingcost);
			//echo 'ship calc result:',$result;
			return ($this->shippingcost);
		 
		}
		else {//standart method	
			//echo 'd';
			foreach ($ways as $wid=>$way) {
				if (stristr($way,$shipway)) {
					$id = $wid;
				}
			}		
			$rfile = 'roadway'.$id.'.ini';
			//echo '>',$rfile;
			$file = $this->path . $rfile; //strtolower($shipway) . '.ini';
			if (is_readable($file)) {
				$data = parse_ini_file($file,1);
				//print_r($data);
		
				$method = $this->shipcalcmethod[$id];//per ship selection
		
				/*RECURSION... one func calls another..DISABLE*/
				//$this->quick_recalculate();	//to update totals and prices..	
		
				switch ($method) {
		
					case 2 : //use weight as param..invoke sql
							break;
		
					case 1 : //use items num as param
							$selector = floatval($this->qtytotal);
							break;
		
					case 0 :
					default: //using price as param
							$selector = floatval($this->total);
				}
		
				//echo $selector,'>';
				foreach ($data as $shipkey=>$shiparams) {
					$rcost = floatval($shipkey);
					//echo '<br>',$selector,'<=',$rcost;
					if ($selector<=$rcost){
						$result = floatval($shiparams['cost']);
						break;
					}  
				}
		
				$this->shippingcost += $result;
				//echo $this->shippingcost,'>';
				SetSessionParam('shipcost',$this->shippingcost);
			}
		}//method
		return ($result);
	}	
	
	protected function show_supershipping() {
		$db = GetGlobal('db');
		$shipway = $this->getDetailSelection('roadway');
		//$mymethod = strtolower(trim(str_replace(' ','',$shipway)));
	  
		$weight = $this->weightCart();
		
		$user_country_id = _m('shuser.get_user_country');
		$czone = GetReq('czone') ? GetReq('czone') : $user_country_id;	  
		
		$cservice = GetReq('cservice');
		$mymethod = strtolower(trim(str_replace(' ','',$cservice))) ?
	              strtolower(trim(str_replace(' ','',$cservice))) :
				  strtolower(trim(str_replace(' ','',$shipway)));	 
		$hr = false;	  
	  
		if ((!$weight) || (!$shipway) || (!$mymethod)) return;	  
	  	  
		$sSQL = "select id,weight,cost from " . $mymethod . " where ";
	  
		$zone = $this->get_country_shipzone($czone);
	  
		if ($zone) {
			if (stristr($zone,'|')) {
				//multiple record zones zone1,zone2 
				$myzones = explode('|',$zone);
				foreach ($myzones as $z=>$zn)
					$tempSQL[] =  'zone=' ."'" . $zn . "'";
		  
				$sSQL .= '(' . implode(' OR ',$tempSQL) . ')';  		
			}
			else
			$sSQL .= 'zone=' ."'" . $zone . "'"; //multiple zones zone1,zone2 per method=service		
		}
		/*elseif (!empty($this->shipzone)) {//old config sets

		foreach ($this->shipzone as $i=>$zone)
		  $tempSQL[] =  'zone=' ."'" . $zone . "'";
		  
		$sSQL .= '(' . implode(' OR ',$tempSQL) . ')';  
		}*/
		$sSQL .=" order by weight"; //desc  when <=weight
		//echo $sSQL;
	  
		$gourl1 = _m('cmsrt.url use t=sship&cservice='.$cservice); 
		$countries = "<select class=\"myf_select_small\" name=\"czone\" onChange=\"location='$gourl1&czone='+this.options[this.selectedIndex].value\">".
	               get_options_file('country',false,true,$czone).
				   "</select>";
		$services = implode(',',$this->shipmethods); 	

		$gourl2 = _m('cmsrt.url use t=sship&czone='.$czone); 
		/*$methods = "<select name=\"cservice\" onChange=\"location='$gourl2&cservice='+this.options[this.selectedIndex].value\">".
	               get_options_file('country',false,true,$cservice).
				   "</select>";*/
		$methods = "<select class=\"myf_select_small\" name=\"cservice\" onChange=\"location='$gourl2&cservice='+this.options[this.selectedIndex].value\">";
		foreach ($this->shipmethods as $i=>$v) {

	        if (stristr($v,'/')) {
			  $vv = explode('/',$v);
			  $title = $vv[$this->lan];
			  $methods .= "<option value=\"$vv[0]\"".($vv[0] == $cservice ? " selected" : "").">$title</option>";
			}
			else
			  $methods .= "<option value=\"$v\"".($v == $cservice ? " selected" : "").">$v</option>";		
		}  
		$methods .= "</select>";				   
				   
		$out .= '<span>'.
	           localize('_SHIPWEIGHT',$this->lan) . 
			   '&nbsp;:&nbsp;'.
			   $weight.localize('_KG',$this->lan).
			   '&nbsp;|&nbsp;'.
			   localize('_SHIPZONE',$this->lan).
			   '&nbsp;:&nbsp;'. 
			   $countries .
			   '&nbsp;&nbsp;'.
			   $methods;
			   '</span>';
		$out .= '<hr>';
	  
		if (!$zone) 
			return ($out); //no result
	  
		$resultset = $db->Execute($sSQL,2);	
		$result = $resultset;
		//print_r($resultset);
		foreach ($result as $n=>$rec) {
	  
			/*if ($rec['weight']>=$weight) {
				$out .= $rec['weight'].'|'.$rec['cost'];		 
			}
			else {
				$out .= $rec['weight'].'|'.$rec['cost'];
			}
			$out .= '<hr>';*/
			$field[] = /*($n+1) .*/ "1&nbsp;" . localize('_PARCELOF',$this->lan);
			$attr[] = 'left;40%';
		 
			$sweight = number_format(floatval($rec['weight']),$this->dec_num,',','.');
		 
			$field[] = $sweight . "&nbsp;" . localize('_KG',$this->lan);
			$attr[] = 'right;30%';	

			$scost = number_format(floatval($rec['cost']),$this->dec_num,',','.');
							
			$field[] = $scost . "&nbsp;" . $this->moneysymbol;
			$attr[] = 'right;30%';	

			$w1 = new window('',$field,$attr);  
			$out .= $w1->render("center::100%::0::group_article::left::0::0::");		 
			if (($rec['weight']>=$weight) && ($hr==false)) {
				//echo $rec['weight'],'-',$weight;		 
				$hr = true;
				$out .= '<hr>';
			}
			//$ww = round($weight,0); echo $ww,'>';
			//if (floatval($rec['weight']) == floatval($ww))
			//  $out .= $w1->render("center::100%::0::group_article_selected::left::0::0::"); 
			//else
			//  $out .= $w1->render("center::100%::0::group_article::left::0::0::"); 
			unset($field);
			unset($attr);
			unset($w1); 		 	 
		}
		return ($out);  
	}
		
	
	protected function calc_supershipping($weight=null, $method=null) {
		$db = GetGlobal('db');
		$mymethod = $method ? $method : $this->shipmethods[0]; //default 0 shipmethods
		$user_country_id = _m('shuser.get_user_country');
		$czone = /*GetReq('czone')?GetReq('czone'):*/$user_country_id;
	  
		$zone = $this->get_country_shipzone($czone);	  
	  
		if ((!$weight) || (!$method)) {
			return;//'No weight or no method!');
		} 	
	  	  
		$mymethod = strtolower(trim(str_replace(' ','',$method)));	
	  
		//print_r($this->shipzone);
	  
		//echo '>',$method,'-',$weight;
		$sSQL = "select cost from " . $mymethod . " where weight>=" . $weight;
	  
		if ($zone) { //table defined zones pre country
			if (stristr($zone,'|')) {
				//multiple record zones zone1,zone2 
				$myzones = explode('|',$zone);
				foreach ($myzones as $z=>$zn)
					$tempSQL[] =  'zone=' ."'" . $zn . "'";
		  
				$sSQL .= ' and (' . implode(' OR ',$tempSQL) . ')';  		
			}
			else
				$sSQL .= ' and zone=' ."'" . $zone . "'"; 	  
		}
		elseif (!empty($this->shipzone)) { //myconfig entry

			foreach ($this->shipzone as $i=>$zone)
				$tempSQL[] =  'zone=' ."'" . $zone . "'";
		  
			$sSQL .= ' and (' . implode(' OR ',$tempSQL) . ')';  
		}
		$sSQL .=" order by weight"; //desc  when <=weight
		//echo $sSQL;
	  
		$resultset = $db->Execute($sSQL,2);	
		$result = $resultset;
	  
		if ($result) {
			foreach ($result as $n=>$rec)
				return $rec['cost'];  
		}	
	  
		return 0;
	}
	
	protected function weightParcel($sumqty=null) {
		if (($sumqty) && (!empty($this->parcelunit))) {
			//echo '>',$sumqty;
			foreach ($this->parcelunit as $i=>$u) {
				if ($sumqty<=intval($u)) {
					$ret = floatval($this->parcelweight[$i]);
					//echo '>',$ret;
					return ($ret);
				} 	
			}
		} 	
		return 0;	
	}
	
	protected function weightCart() {	
		$total_weight = 0;
		$total_qty = 0;	  
	
		if (empty($this->buffer)) return;
	
		//echo '<pre>';
		//print_r($this->buffer);
		//echo '</pre>';	
	
		foreach ($this->buffer as $i=>$rec) {
			if ($rec!='x') {
				$data = explode(';',$rec);
				$cs = $data[0].';'.$data[1].';'.$data[2].';'.$data[3].';'.$data[4].';'.$data[5].';'.$data[6].';'.$data[7].';';
				$tempbuffer[$data[0]] = $data[9];
				$itemscodes[] = $data[0];
			}
		}
	  
		if (!empty($itemscodes)) {
	   
			$weights = _m($this->shclass . '.read_item_weight use '.implode(';',$itemscodes));	

			//print_r($tempbuffer); print_r($weights);
			foreach ($tempbuffer as $code=>$qty) {
				$total_weight+= floatval($weights[$code])*$qty;
				$total_qty+= $qty;
			}  
		  
			//extra parcel weight...  
			$total_weight+= $this->weightParcel($total_qty);
		
			//echo $total_weight;
			return ($total_weight);
		}
	  
		return null; 
	}	
	
	protected function get_country_shipzone($cid) {
		$db = GetGlobal('db');	
	  
		if ($cid>=0) {
			$id = $cid+1;//plus 1 to find rec	   
			$sSQL = "select zone from pcountry where id=".$id;
			$resultset = $db->Execute($sSQL,2);	
			$result = $resultset;	
          
			$ret = $resultset->fields[0];
			//echo $sSQL,$ret;
			return ($ret);		  
		}
	}	
	
	
	/************************* pqty items  ****************************/
	public function pQtyItemColor($code, $template=null, $chkqty=false) {
		$db = GetGlobal('db');
		if (!$code) return null;
		$retarr = array();
		
		$sSQL = "select id,pcode,psize,pcolor,qty,net,vat from pqtyitems where pcode=" . $db->qstr($code);
		//$sSQL.= $chkqty ? null : " and qty>0"; //def check DISABLE allow add to cart when 0 qty
		$res = $db->Execute($sSQL);

		if (!empty($res)) {	
			$tmpl = $template ? $template : 'fpitem-color';	
			$mytemplate = _m('cmsrt.select_template use ' . $tmpl);
			foreach ($res as $n=>$rec) {
				$tokens = array();
				$tokens[] = $rec['code'];
				$tokens[] = $rec['pcolor'];
				$tokens[] = ucfirst($rec['pcolor']);
			
				$retarr[] = $this->combine_tokens($mytemplate, $tokens, true);
			}	

		}
		if (!empty($retarr)) {
			
			//return implode('', $retarr);
			$tokens2[] = implode('', array_unique($retarr));			
			$tokens2[] = 'selectpColor';
			$tokens2[] = 'productColor';

			$myselectemplate = _m('cmsrt.select_template use fpitem-select');
			return $this->combine_tokens($myselectemplate, $tokens2, true);
		}	

		return false;	
		//return $this->combine_tokens($mytemplate, array($code,'none',localize('_NOTAVAILABLE' ,$this->lan)), true);
	}

	public function pQtyItemSize($code, $template=null, $chkqty=false) {
		$db = GetGlobal('db');
		if (!$code) return null;
		$retarr = array();
		
		$sSQL = "select id,pcode,psize,pcolor,qty,net,vat from pqtyitems where pcode=" . $db->qstr($code);
		//$sSQL.= $chkqty ? null : " and qty>0"; //def check DISABLE allow add to cart when 0 qty
		$res = $db->Execute($sSQL);
		
		if (!empty($res)) {
			$tmpl = $template ? $template : 'fpitem-size';	
			$mytemplate = _m('cmsrt.select_template use ' . $tmpl);					
			foreach ($res as $n=>$rec) {
				$tokens = array();
				$tokens[] = $rec['code'];
				$tokens[] = $rec['psize'];
				$tokens[] = ucfirst($rec['psize']);
			
				$retarr[] = $this->combine_tokens($mytemplate, $tokens, true);
			}	
		}
		if (!empty($retarr)) {
			//return implode('', $retarr);

			$tokens2[] = implode('', array_unique($retarr));			
			$tokens2[] = 'selectpSize';
			$tokens2[] = 'productSize';
			
			$myselectemplate = _m('cmsrt.select_template use fpitem-select');
			return $this->combine_tokens($myselectemplate, $tokens2, true);			
		}	

		return false;			
		//return $this->combine_tokens($mytemplate, array($code,'none',localize('_NOTAVAILABLE' ,$this->lan)), true);
	}	
	
	//use both
	public function pQtyItemSizeColor($code, $template=null, $chkqty=false) {
		$db = GetGlobal('db');
		if (!$code) return null;	
		$retarr = array();
		
		$sSQL = "select id,pcode,psize,pcolor,qty,net,vat from pqtyitems where pcode=" . $db->qstr($code);
		//$sSQL.= $chkqty ? null : " and qty>0"; //def check  DISABLE allow add to cart when 0 qty
		$res = $db->Execute($sSQL);
		
		if (!empty($res)) {		
			$tmpl = $template ? $template :  'fpitem-sizecolor';	
			$mytemplate = _m('cmsrt.select_template use ' . $tmpl);			
			foreach ($res as $n=>$rec) {
				$tokens = array();
				$tokens[] = $rec['code'];
				$tokens[] = $rec['pcolor'] . $rec['psize']; //number (size) last
				$tokens[] = ucfirst($rec['psize'] . ' ' . $rec['pcolor']);
			
				$retarr[] = $this->combine_tokens($mytemplate, $tokens, true);
			}	
		}
		if (!empty($retarr)) {
			//return implode('', $retarr);
			
			$tokens2[] = implode('', array_unique($retarr));			
			$tokens2[] = 'selectpSizeColor';
			$tokens2[] = 'productSizeColor';
			
			$myselectemplate = _m('cmsrt.select_template use fpitem-select');
			return $this->combine_tokens($myselectemplate, $tokens2, true);			
		}	

		return false;			
		//return $this->combine_tokens($mytemplate, array($code,'none',localize('_NOTAVAILABLE' ,$this->lan)), true);
	}	
	
	//depend on param to show selection boxes
	public function pQtyItemSelect($code, $template=null, $chkqty=false) {
		$ret = null;
		$itemqtysel = _m('cms.paramload use ESHOP+itemqtyselect');
		
		if (strstr($itemqtysel, ',')) {
			$qs = explode(',', $itemqtysel);
			foreach ($qs as $qtysel) {
				$qtyselFunc = 'pQtyItem' . ucfirst($qtysel);
				$ret.= $this->$qtyselFunc($code, $template, $chkqty);
			}
			return $ret;	
		}	
		
		switch ($itemqtysel) {
			case 'sizecolor' :  return $this->pQtyItemSizeColor($code, $template, $chkqty);
								break;
			case 'color'	 :	return $this->pQtyItemColor($code, $template, $chkqty);
								break;
			case 'size'		 :	return $this->pQtyItemSize($code, $template, $chkqty);  
								break;
			case 'all'       :
			default          :  $ret = $this->pQtyItemSize($code, $template, $chkqty);
								$ret.= $this->pQtyItemColor($code, $template, $chkqty);
								return $ret;
		}	
		
		return false;
	}	
	
	//when check qty return sum of qty else just if is existed record (without stock)
	protected function itemHasQtySelection($code, $chkqty=false, $size=null, $color=null) {
		$db = GetGlobal('db');
		if (!$itemqtysel = _m('cms.paramload use ESHOP+itemqtyselect')) //<<<<< ENABLE QTY ITEMS
			return false;
		
		//$code = _m("cmsrt.getRealItemCode use " . $code);
			
		$sSQL = $chkqty ? "select sum(qty) as sqty from pqtyitems where pcode=" . $db->qstr($code) :
						  "select id from pqtyitems where pcode=" . $db->qstr($code);
		//$sSQL.= $chkqty ? " and qty>0" : null; //def no DISABLE allow add to cart when 0 qty
		$sSQL.= $chkqty && $size ? " and psize=" . $db->qstr($size) : null; 
		$sSQL.= $chkqty && $color ? " and pcolor=" . $db->qstr($color) : null; 
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		
		//return qty 0 when qty < 0 or true / false
		return $chkqty ? (($res->fields['sqty']<0) ? 0 : $res->fields['sqty']) : 
							($res->fields['id'] ? true : false);
	} 
	
	protected function pcheckQty($code, $altqty=0, $_pSize=null, $_pColor=null, $nojs=false) {
		$_ypoloipo1 = 0 ;
		
		if ($this->itemHasQtySelection($code)) { //is size/color item
			
			if ($_pSize || $_pColor) { //get qty from selection table
				$_ypoloipo1 = $this->itemHasQtySelection($code, true, $_pSize, $_pColor);
			}
			else {
				if (!$nojs)
					$this->jsDialog(localize('_ITEMQTYSELECT',$this->lan), localize('_BLN1', $this->lan));
				
				$this->itemqtyselect_misattr = true;
				return false; //=== false return
			}	
		}
		else
			$_ypoloipo1 = $altqty; //0 for no size/color items	
		
		//echo $_ypoloipo1 . '<<<<';
		return $_ypoloipo1;
	}
	
	protected function pQtyPurchase($code, $qty, $size=null, $color=null) {
		$db = GetGlobal('db');
		if ((!$code) || (!$qty)) return 0;
		
		if (!$itemqtysel = _m('cms.paramload use ESHOP+itemqtyselect'))
			return 0; //disabled size/color
		
		if ($this->itemHasQtySelection($code)) { //is size/color item
		
		    $sSQL = "update pqtyitems set qty=qty-$qty where pcode=" . $db->qstr($code);
			$sSQL.= " AND psize=" . $db->qstr($size);
			$sSQL.= " AND pcolor=" . $db->qstr($color);
			$db->Execute($sSQL,1);	 
			
			if ($db->Affected_Rows())
				return true;
			
			return false; //false as ===
		}

		return 0;	
	}					
	
	protected function pQtyRefund($code, $qty, $size=null, $color=null) {
		$db = GetGlobal('db');
		if ((!code) || (!$qty)) return 0;
		
		if (!$itemqtysel = _m('cms.paramload use ESHOP+itemqtyselect'))
			return 0; //disabled size/color
		
		if ($this->itemHasQtySelection($code)) { //is size/color item
		
		    $sSQL = "update pqtyitems set qty=qty+$qty where pcode=" . $db->qstr($code);
			$sSQL.= " AND psize=" . $db->qstr($size);
			$sSQL.= " AND pcolor=" . $db->qstr($color);			
			$db->Execute($sSQL,1);	 
			
			if ($db->Affected_Rows())
				return true;
			
			return false; //false as ===
		}

		return 0;	
	}	
	
	//SCRIPTS JS
		
	/*send js data line by line */
	protected function getCartItemsScript($referer=null, $tid=null) {
		$db = GetGlobal('db');
		$items = array();
		$tokens = array();
		$ret = null;
		
		$tmplprod = $referer ? $referer . '-cartitem-js-analytics' : 'cartitem-js-analytics';				
		$mytemplate = _m('cmsrt.select_template use '. $tmplprod);	
		
		if ($tid) { //refund
			$sSQL1 = "select pid,qty,net,vat,ref,memo from pcartitems ";
			$sSQL1.= "where tid='$tid'";
			$res = $db->Execute($sSQL1);

			foreach ($res as $n=>$rec) {
				
				$prodID = $rec['pid'];
				$tokens = (array) _m($this->shclass . '.fetchProductTokens use '. $prodID);
				
				//override tokens
				$tokens[13] = $rec['qty']; //qty
				$pwt = $this->pricewithtax(floatval($rec['net']), intval($rec['vat']));
				$tokens[48] = number_format($pwt, $this->dec_num,',','.'); //price 
				$tokens[51] = $n + 1; //position in cart list
				
				$items[] = $this->combine_tokens($mytemplate, $tokens, true);
				unset($tokens);				
			}	
		}		
		else { // current cart data		
		
			foreach ($this->buffer as $prod_id => $product) {
				if (($product) && ($product!='x')) {
				
					$toks = explode(';', $product);
					$prodID = $toks[7]; //$toks[0]; //item code
					$tokens = (array) _m($this->shclass . '.fetchProductTokens use '. $prodID);
					
					$items[] = $this->combine_tokens($mytemplate, $tokens, true);
					unset($tokens);
				}	
			}
		}	
		//print_r($items);
		return (!empty($items)) ? implode(',',$items) : $ret;	
	}	
	
	/*get token data line by line */
	protected function getCartItemsTokens($tid=null) {		
		$db = GetGlobal('db');	
		$tokens = array();
		
		if ($tid) { //refund
			$sSQL1 = "select pid,qty,net,vat,ref,memo from pcartitems ";
			$sSQL1.= "where tid='$tid'";
			$res = $db->Execute($sSQL1);

			foreach ($res as $n=>$rec) {
				$prodID = $rec['pid'];
				$tokens[] = (array) _m($this->shclass . '.fetchProductTokens use '. $prodID);
			}	
		}		
		else { // current cart data
			foreach ($this->buffer as $prod_id => $product) {
				if (($product) && ($product!='x')) {
				
					$toks = explode(';', $product);
					$prodID = $toks[7]; //$toks[0]; //item code
					$tokens[] = (array) _m($this->shclass . '.fetchProductTokens use '. $prodID);
				}	
			}
		}
		return (array) $tokens;	
	}	
	
	/*get cart elements */	
	protected function getCartTransactionTokens($referer=null, $tid=null) {
		$db = GetGlobal('db');
		
		if (($referer=='refund') && ($tid)) {
			$sSQL1 = "select cid,ref,total,subt,shipc,disc,taxc,trac,payc,roadway,payway,addrway,custway,invway,memo from pcartvalues ";
			$sSQL1.= "where tid='$tid'";
			$res = $db->Execute($sSQL1);

			$tokens = array(0=>$tid, 
		                1=>number_format(floatval($res->fields['total']),$this->dec_num), 
		                2=>number_format(floatval($res->fields['subt']),$this->dec_num), 
						3=>number_format(floatval($res->fields['shipc']),$this->dec_num), 
						4=>number_format(floatval($res->fields['disc']),$this->dec_num), 
						5=>number_format(floatval($res->fields['taxc']),$this->dec_num),
						6=>number_format(floatval($res->fields['trac']),$this->dec_num),
						7=>number_format(floatval($res->fields['payc']),$this->dec_num),
						8=>number_format(floatval($res->fields['subt'])+
						                 floatval($res->fields['taxc'])+
										 floatval($res->fields['trac']),$this->dec_num),
						9=>number_format(floatval($res->fields['subt'])+
						                 floatval($res->fields['taxc']),$this->dec_num),				 
						);			
			
			$tokens[] = $referer ? $this->getCartItemsScript($referer, $tid) : 
									$this->getCartItemsTokens($tid);	
			
			$tokens[] = $res->fields['roadway'];
			$tokens[] = $res->fields['payway'];
			$tokens[] = $res->fields['addrway'];
			$tokens[] = $res->fields['custway'];
			$tokens[] = $res->fields['invway'];
			$tokens[] = $res->fields['memo'];
		}
		else {	// current cart data		
			$roadway = $this->getDetailSelection('roadway');
			$payway = $this->getDetailSelection('payway');	
			$addressway = $this->getDetailSelection('addressway');
			$customerway = $this->getDetailSelection('customerway');								 	   		   
			$invway = $this->getDetailSelection('invway');	
			$sxolia = $this->getDetailSelection('sxolia');
		
			$qtytotal =	GetSessionParam('qty_total');	
			//$paycost =	GetSessionParam('paycost');
			//$transcost = GetSessionParam('transcost');

			$ordertotal = str_replace(',', '.', $this->myfinalcost);
			$ordersubtotal = str_replace(',', '.', $this->total);
			$orderdiscount = $this->discount ? str_replace(',', '.', $this->discount) : '0.0';
			$shipcost = $this->shippingcost ? str_replace(',', '.', $this->shippingcost) : '0.0';
			$taxcost = $this->mytaxcost ? str_replace(',', '.', $this->mytaxcost) : '0.0';
			$transportcost = $this->transportcost ? str_replace(',', '.', $this->transportcost) : '0.0';
			$paymentcost = $this->paymentcost ? str_replace(',', '.', $this->paymentcost) : '0.0';
		
			if ($trid = $this->transaction_id) { //GetSessionParam('TransactionID') ;//$this->transaction_id		
				
				$tokens = array(0=>$trid, 
		                1=>number_format(floatval($ordertotal),$this->dec_num), 
		                2=>number_format(floatval($ordersubtotal),$this->dec_num), 
						3=>number_format(floatval($shipcost),$this->dec_num), 
						4=>number_format(floatval($discount),$this->dec_num), 
						5=>number_format(floatval($taxcost),$this->dec_num),
						6=>number_format(floatval($transportcost),$this->dec_num),
						7=>number_format(floatval($paymentcost),$this->dec_num),
						8=>number_format(floatval($ordersubtotal)+
						                 floatval($taxcost)+
										 floatval($transportcost),$this->dec_num),
						9=>number_format(floatval($ordersubtotal)+
						                 floatval($taxcost),$this->dec_num),				 
						);
				$tokens[] = $referer ? $this->getCartItemsScript($referer, $tid) : 
									$this->getCartItemsTokens($tid);	
				$tokens[] = $roadway;
				$tokens[] = $payway;
				$tokens[] = $addressway;
				$tokens[] = $customerway;
				$tokens[] = $invway;
				$tokens[] = $sxolia;
			}
			else
				return array(); //null
		}
		
		return (array) $tokens;	
	}
	
	/****************** referer js analytics scripts ********/	

	/*call from shcartsuccess tmpl for analytics*/
	public function postSubmitScript() {
		$ret = "/* post submit script */" . PHP_EOL;
		return ($ret);
	}	

	protected function submitScript($referer=null, $tid=null) {
		$ret = "/* $referer submit analytics script */". PHP_EOL;
		$tmplbody = $referer ? $referer . '-js-analytics' : 'noref-js-analytics';
		$tmplline = $referer ? $referer . '-js-item-analytics' : 'noref-js-item-analytics';		
		
		/*submit transcation data and cart items as array (token 10) */
		$tokensTR = $this->getCartTransactionTokens($referer, $tid);
		if (!empty($tokensTR))	
			$ret = _m("cmsrt._ct use $tmplbody+" . serialize($tokensTR) . '+1');
		
		//when refund do not a line by line items submit
		if (($referer=='refund') && ($tid))
			return ($ret);
		
		/*submit cart items line by line */
		$tokens = array();
		$mytemplate = _m('cmsrt.select_template use '. $tmplline);
		foreach ($this->buffer as $prod_id => $product) {
			if (($product) && ($product!='x')) {
				
				$toks = explode(';', $product);	
				$tokens[0] = $toks[7]; //$toks[0]; //item code
				$tokens[1] = addslashes($this->replace_cartchars($toks[1], true)); //item title
				$tokens[8] = number_format(floatval($toks[8]),$this->dec_num); //item net price 
				$tokens[9] = $toks[9]; //qty
				//extra order tokens
				$tokens[19] = $tid; //transaction id
				
				//$ret .= _m("cmsrt._ct use $tmplline+" . serialize($tokens) . '+1');
				$ret .= $this->combine_tokens($mytemplate, $tokens, true);
				unset($tokens);
			}	
		}		
		
		return ($ret);		

	}
	
    /*call from this submit_order */
	protected function analytics($event=null, $tid=null) {
		$ev = $event ? $event : 'cart';
		$referer = $_SESSION['http_referer']; //as saved by vstats
		
		$rstr = _m('cms.paramload use ESHOP+refererAnalytics');
		$refs = $rstr ? str_replace(',','|',strtolower($rstr)) : "skroutz|bestprice|google";
		//echo 'refs:' . $refs;
		
		//create analytics script if referer
		if (preg_match("/($refs)/i", $referer, $matches)) {
			
			$code = $this->submitScript($matches[0], $tid);	
		}
		
		$code .= $this->submitScript($ev, $tid);
		//echo $code;
		
		if ($code) {
			$js = new jscript;	
			$js->load_js($code,"",1);			   
			unset ($js);
		}		
	}	
	
		
	/****************** cart save / refund **********************/
			
	/*save cart elements - purchase */	
	protected function cartPurchase() {
		$db = GetGlobal('db');
		$fcode = _v("cmsrt.fcode");
		
		$tokens = $this->getCartTransactionTokens();
		//print_r($tokens);

		if (!empty($tokens)) {
			
			$tid = $tokens[0];
			$cid = $this->user;
			$refund = 0;	
			$tdate = date("Y-m-d H:i:s"); //use mysql now()			
			
			$sSQL1 = "insert into pcartvalues (tdate,tid,cid,ref,total,subt,shipc,disc,taxc,trac,payc,roadway,payway,addrway,custway,invway,memo) values (";
			$sSQL1.= "'$tdate','$tid','$cid',$refund,{$tokens[1]},{$tokens[2]},{$tokens[3]},{$tokens[4]},{$tokens[5]},{$tokens[6]},{$tokens[7]},'{$tokens[11]}','{$tokens[12]}','{$tokens[13]}','{$tokens[14]}','{$tokens[15]}','{$tokens[16]}'";
			$sSQL1.= ")";
			
			$db->Execute($sSQL1,1);	 
			//echo $sSQL1;
		
			if ($db->Affected_Rows()) {
				
				foreach ($this->buffer as $prod_id => $product) {
					if (($product) && ($product!='x')) {
				
						$toks = explode(';', $product);	
						$prodID = $toks[7]; //$toks[0]; //item code				
						$qty = intval($toks[9]); //quantity	
						$size = $toks[10];
						$color = $toks[11]; 
						$bqty = intval($toks[15]); //back order	qty
						$title = addslashes($this->replace_cartchars($toks[1], true));
						$netprice = number_format(floatval($toks[8]),$this->dec_num); 						
						$vat = $this->tax ?? 0;
						
						$sSQL2 = "insert into pcartitems (tdate,tid,pid,qty,size,color,bqty,net,vat,ref,memo) values (";
						$sSQL2.= "'$tdate','$tid','$prodID',$qty,'$size','$color',$bqty,$netprice,$vat,$refund,'$title'";
						$sSQL2.= ")";	
				
						$db->Execute($sSQL2,1);	 
						//echo $sSQL2;
						if ($db->Affected_Rows()) {
							//update inventory
							$sSQL3 = "update products set ypoloipo1=ypoloipo1-$qty where $fcode='$prodID'";
							$db->Execute($sSQL3,1);	
							//echo $sSQL3;
							
							//pqtyitems
							$this->pQtyPurchase($prodID, $qty, $toks[10], $toks[11]);
						}
						else {	
							$this->jsDialog($tid .' error 0x002', localize('_CARTERROR', $this->lan));
							return false;
						}						
					}	
				}
				return true;			
			}
			else
				$this->jsDialog($tid .' error 0x001', localize('_CARTERROR', $this->lan));
			
			return false;
		}
		$this->jsDialog('trID:' . $tid .' Empty tokens', localize('_CARTERROR', $this->lan));
		return false;
	}
	
	/*refund cart elements used by shtransactions */	
	public function cartRefund($tid=null) {
		$db = GetGlobal('db');
		$fcode = _v("cmsrt.fcode");
		if (!$tid) return false;
		
		$sSQL1 = "update pcartvalues set ref=1 where tid='$tid'";
		$db->Execute($sSQL1,1);	 
		//echo $sSQL1;	
		
		if ($db->Affected_Rows()) {

			$sSQL = "select pid,qty,size,color from pcartitems where tid='$tid'";
			$res = $db->Execute($sSQL);
			
			if ($res) {
				foreach ($res as $n=>$rec) {
					
					$prodID = $rec['pid'];
					$qty = intval($rec['qty']);
					
					$sSQL2 = "update pcartitems set ref=1 where pid='$prodID'";
					$db->Execute($sSQL2,1);	
			
					if ($db->Affected_Rows()) {
						//update inventory
						$sSQL3 = "update products set ypoloipo1=ypoloipo1+$qty where $fcode='$prodID'";
						$db->Execute($sSQL3,1);	
						//echo $sSQL3;	

						//pqtyitems
						$this->pQtyRefund($prodID, $qty, $rec['size'], $rec['color']);	
					}
					else {	
						$this->jsDialog($tid .' error!', localize('_trusercancel', $this->lan));
						return false;				
					}
				}
			}
			
			$this->jsDialog($tid, localize('_trusercancel', $this->lan));
			
			/* refund analytics */
			$this->analytics('refund', $tid);
			
			return true;
		}
		//else
			//echo $sSQL1; //older transactions
		
		return false;	
	}		
	
	
	
	//COOKIE STORE CART
	
	protected function cookie_store_cart() {
        $db = GetGlobal('db');
		$user = $this->cusrid; 
		
		if ((GetSessionParam('ADMIN')) || (_m("cms.isUaBot")))
			return false;

		$sSQL = "select id from pcart where userid=" . $db->qstr($user);	
		$res = $db->Execute($sSQL);				
		if ($existedid = $res->fields[0]) {
			$sSQL = "update pcart set";					
			//$sSQL.= " userid =" . $db->qstr($user) . ',';		
			$sSQL.= " data=" . $db->qstr($this->base64CartSession());
			$sSQL.= " where id=" . $existedid;
		}
		else { //insert
			$sSQL = "insert into pcart (userid,data) values (";					
			$sSQL.= $db->qstr($user) . ',';		
			$sSQL.= $db->qstr($this->base64CartSession()). ")";					
		}

		$db->Execute($sSQL,1);	 
		//echo $sSQL;
		
		if ($db->Affected_Rows()) 
			return true;
 
		return false;		
	}
	
	protected function cookie_clean_cart() {
        $db = GetGlobal('db');
		$user = $this->cusrid; 
		
		if ((GetSessionParam('ADMIN')) || (_m("cms.isUaBot")))
			return false;

		$sSQL = "update pcart set data=''";
		$sSQL.= " where userid=" . $db->qstr($user);

		$db->Execute($sSQL,1);	 
		//echo $sSQL;
			
		if ($db->Affected_Rows()) 
			return true;

		return false;		
	}	
	
	protected function cookie_fetch_cart($id=null) {
        $db = GetGlobal('db');
		$user = $id ? $id : $this->cusrid; 
		
		if ((GetSessionParam('ADMIN')) || (_m("cms.isUaBot")))
			return false;

		$sSQL = "select data from pcart where userid=" . $db->qstr($user);	
		$sSQL.= " order by datein DESC LIMIT 1";
		$res = $db->Execute($sSQL);	
		//echo $sSQL;	
		
		if ($data = $res->fields[0]) 
			return $data;
		
		return false;		
	}	
	
	
	/****************** funcs ***********************************/	   		
	
	public function base64CartEncode($str=null) {
		if (!$str) return null;
		//return unserialize(base64_decode(urldecode($str)));
		return json_decode(base64_decode(urldecode($str)));		
	}
	
	/*used by js behavior */
	public function base64CartSession() {				
		//$theCartData = urlencode(base64_encode(serialize($this->buffer)));
		$theCartData = urlencode(base64_encode(json_encode($this->buffer)));
		return $theCartData;	
	}	
	
	/*used by js behavior */
	public function cookie_diff_cart($id=null) {
		$scart = $this->base64CartSession($this->buffer);
		$pcart = $this->cookie_fetch_cart($id);
		
		return (strcmp($scart, $pcart)==0) ? '0' : '1';
	}	
	
    public function price_with_tax($price=null) {
		if (!$price) return '0,00';
		$myprice = floatval(str_replace(array('.',','),array('','.'),$price));
		
		//echo $price,':',$myprice,'*',$this->tax,'/100<br/>';
		$vat = ((($myprice)*$this->tax)/100);
		$vatprice = $myprice + $vat;
		
		$value = number_format(floatval($vatprice),$this->dec_num,',','.');
		$ret = $value . $this->moneysymbol;
        return ($ret);	
    }

	/*ver 2 as shkatalogmedia */
	public function pricewithtax($price,$tax=null) {
	
		if ($tax) {
			$mytax = ((floatval($price) * $tax)/100);	
			$value = (floatval($price) + $mytax);		  
		}
		elseif ($tax = $this->tax) {
			$mytax = ((floatval($price) * $tax)/100);	
			$value = (floatval($price) + $mytax);		  
		}		
		else
			$value = floatval($price);
	
		return ($value);
	}		
	
	protected function cart_mailto($to=null,$subject=null,$body=null) {
	    $from = $this->cartsend_mail;
		
		$body = str_replace('+','<SYN/>',$body); 
		$mailerr = _m("cmsrt.cmsMail use $from+$to+$subject+$body+{$this->transaction_id}+cart");

		return ($mailerr); 	
	}
	
	//called by twig invoice html as func add link tracker
	public function addTracker($returl=false) { 
	    $mtrack = _m('cms.paramload use CMS+mtrack');
	    //mtrack = $mtrack ? $mtrack : "http://www.stereobit.gr/mtrack/";	//.php		
			
		$r = $this->user;
		$i = $this->get_trackid($this->transaction_id);
		
		//$rurl = $mtrack . "?i=$i&r=$r";
		$rurl = $mtrack . "$i/$r/";
	
		$ret = $returl ? $rurl : "<img src='$rurl' border='0' width='1' height='1'/>";	 	  
				
		return ($ret);	 
	}	
	
	protected function get_trackid($id=null) {
		//$appname = paramload('ID','instancename');
		$appname = _v('cmsrt.appname'); 
		
		$i = $id ? $id : rand(100000,999999);	 
		$tid = date('YmdHms') .  $i . '@' . $appname;
		 
		return ($tid);	
	}		

	protected function update_statistics($id, $user=null) {
		if ($this->userLevelID >= 5) return false;
		
        if (defined('CMSVSTATS_DPC'))	
			return _m('cmsvstats.update_event_statistics use '.$id.'+'.$user);			
		
		return false;
	}	
	
	protected function replace_cartchars($string, $reverse=false) {
		if (!$string) return null;

		$g1 = array("'",',','"','+','/',' ','-&-');
		$g2 = array('_','~',"*","plus",":",'-','-n-');		
	  
		return $reverse ? str_replace($g2,$g1,$string) : str_replace($g1,$g2,$string);
	}	
	
	public static function myf_button($title,$link=null,$image=null) {

	    $path = self::$staticpath;
	    $bc = self::$myf_button_class;
	   
	    if (($image) && (is_readable($path."/images/".$image.".png"))) {
			$imglink = "<a href=\"$link\" title='$title'><img alt='$title' src='images/".$image.".png'/></a>";
		}
	   
		if (preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT'])) { 
			$_b = $imglink ? $imglink : "[$title]";
			$ret = "&nbsp;<a href=\"$link\">$_b</a>&nbsp;";
			return ($ret);
		}	
	   
		if (isset($imglink))
			return ($imglink);
	
		//else button	
		$ret = "<a class=\"$bc\" href=\"$link\">" . $title . "</a>";
		return ($ret);
	}	
	/*
	protected function combine_tokens(&$template_contents, $tokens, $execafter=null) {
	    if (!is_array($tokens)) return;
		
		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
			$fp = new fronthtmlpage(null);
			$ret = $fp->process_commands($template_contents);
			unset ($fp);		  		
		}		  		
		else
			$ret = $template_contents;
		  
	    foreach ($tokens as $i=>$tok) {
		    $ret = str_replace("$".$i."$",$tok,$ret);
	    }

		for ($x=$i;$x<60;$x++)
			$ret = str_replace("$".$x."$",'',$ret);
		
		if (($execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
			$fp = new fronthtmlpage(null);
			$retout = $fp->process_commands($ret);
			unset ($fp);
          
			return ($retout);
		}		
		
		return ($ret);
	}		
	*/
	
	/*********************** API *********************************/
	
	public function apiCartClear() {
		$this->clear();
		
		return true;
	}	
	
	public function apiCartAdd($item,$qty=null) {
		$db = GetGlobal('db');		
		if (!$item) return false;	
		
		//make params
		$_qty = $qty ? $qty : GetReq('qty');
		$cat = GetReq('cat');
		$page = 0;
		
		//init missing attr when item selected
		$this->itemqtyselect_misattr = false; 		
		
		$_pSize = GetParam('selectpSize');
		$_pColor = GetParam('selectpColor');			

		$_code = _v($this->shclass . '.fcode');
	  	  
		$sSQL = "select $_code,{$this->selectsql} from products  WHERE $_code ='" . $item . "'";	  
		$result = $db->Execute($sSQL,2);		
		
		if ($title = $result->fields['itmname']) {	 //check sql return value
			//echo $title;
			$pp = _m($this->shclass . '.read_policy'); 	
		    $price = $result->fields[$pp];
			$priceqty = _m($this->shclass . ".read_qty_policy use ". $a.'+'.$price."++".$_qty);
			
			//qty meter method per item 22,21,2,1,0=default use global params
			$qtycalc_method = $result->fields['uniida'];
			//when size/color the item code has sizecolor attr as cart id
			$extCode = ($_pSize || $_pColor) ? $a . '['.$_pSize . $_pColor .']' : $a;
			//add size/color at item title
			$extTitle = ($_pSize || $_pColor) ? $this->replace_cartchars($title) .' ['.$_pSize.' '.$_pColor .']' : $title;			
			
			//return qty 0 when qty < 0 
			$pqty = ($result->fields['ypoloipo1']<0) ? 0 : $result->fields['ypoloipo1'];			
			
			$params = array(0=>$extCode,
							1=>$extTitle,
							2=>'',
							3=>'',
							4=>$cat,
							5=>$page,
							6=>'',
							7=>$item,
							8=>$priceqty,
							9=>1,
							10=>$_pSize,
							11=>$_pColor,							
							12=>$result->fields['uniname2'],
							13=>$result->fields['uni2uni1'],								
							14=>$pqty,
							15=>0,	
							);
	   
			if ($this->getcartCount() < $this->maxcart) { //check cart maximum items

				$this->qty_total+=1;
				SetSessionParam('qty_total',$this->qty_total);
			
				$val = floatval(str_replace(',','.',$params[8]));
				$this->total = $this->total + $val;
				//echo '>',strval($params[8]),'+',$this->total;//,'+';print_r($params);//[8];
				SetSessionParam('total',$this->total);			
	   
				//get selected quantity number
				$preqty = GetParam("PRESELQTY");
				$preuni = GetParam("PRESELUNI");

				//preqty filed takes place when exist  
				$preqty = GetParam("PRESELQTY") ? GetParam("PRESELQTY") : ($_qty ? $_qty : 1);  
              
				if ((is_number($preqty)) && ($preqty>0)) {

					//if isset 2nd mm convert
					if (($this->uniname2) && ($preuni==$params[12])) {
						if ($params[13]) {
							$preqty = ($preqty * $params[13]); //2nd mm
						}	
						else {
							$preqty = 1; // default 1 qty
							//$this->jsDialog("Error: Invalid qty uni2", localize('SHCART_DPC', $this->lan));
						}	
					}					

					//check storage
					$qtycalc_param = $this->allowqtyover ? 11 : 1; //get more items than in db
					if ($this->ignoreqtyzero) {} else $qtycalc_param += 1; //check if db items is 0 or <0
					
					//per item calc or global param for all items
					$qtycalc = $qtycalc_method ? $qtycalc_method : $qtycalc_param; 
					
					switch ($qtycalc) {
						case 12://check zero 
								if ($params[14]<=0) {
									//$this->jsDialog(localize('_STOCKOUT',$this->lan), localize('_BLN1', $this->lan));
									return false; //exit here
								}
						case 11://set qty = selection
								if (($y = $this->pcheckQty($params[7], $params[14], $_pSize, $_pColor, true))===false) {
									//$this->jsDialog(localize('_ITEMQTYSELECT',$this->lan), localize('_BLN1', $this->lan));
									return false;
								}
								$_ypoloipo1 =  $y - $this->qtyin($extCode);
								
								if ($preqty > $_ypoloipo1) {
									$stockout = ($preqty - $_ypoloipo1);
									//$stock_message = localize('_STOCKOUT',$this->lan) . " (" . $stockout . ")";
									//$this->jsDialog($stock_message, localize('_BLN1', $this->lan));
																		
									//$preqty = $_ypoloipo1; //as calculated /entered with check
									$params[15] = $stockout; //save backorder
								}	
								$params[9]= $preqty; //overwrite
								$this->addto(implode(";",$params));
								break;
						
						case 2 ://check zero
								if ($params[14]<=0) {
									//$this->jsDialog(localize('_STOCKOUT',$this->lan), localize('_BLN1', $this->lan));
									return false; //exit here
								}	
						case 1 ://set qty = max in storage
								if (($y = $this->pcheckQty($params[7], $params[14], $_pSize, $_pColor, true))===false) {
									//$this->jsDialog(localize('_ITEMQTYSELECT',$this->lan), localize('_BLN1', $this->lan));
									return false;
								}	
								$_ypoloipo1 =  $y - $this->qtyin($extCode);
								
								if ($preqty > $_ypoloipo1) {
									$stockout = ($preqty - $_ypoloipo1);
									//$stock_message = localize('_STOCKOUT',$this->lan) . " (" . $stockout . ")";
									//$this->jsDialog($stock_message, localize('_BLN1', $this->lan));
									
									$preqty = $_ypoloipo1; 
									$params[15] = $stockout; //save backorder
								}	
								$params[9]= $preqty; //overwrite
								$this->addto(implode(";",$params));
								break;
								 
						case 0 :
						default: //as entered no checks
								$params[9]= $preqty; //overwrite
								$this->addto(implode(";",$params));
					}
				}

				SetSessionParam('cartstatus',0);
				$this->status = 0;
				
				if ($user = $this->user)
					$this->update_statistics('cart-api-add', $user);
				
				return true;
			}

		}//if itmname
		 
		return false; 
	}
	
	public function apiCartRemove($id) {
        //$myid = $id ? explode(';', $id) : explode(';', GetReq('a'));
		if (!$id) return null;		

        reset ($this->buffer);           
        foreach ($this->buffer as $buffer_num => $buffer_data) {		
			
		   $param = explode(";",$buffer_data);
		   
           if ($param[0] == $id) {
	             $this->qty_total-=$param[9];
			     SetSessionParam('qty_total',$this->qty_total);	
				 
	             $this->total-=($param[8]*$param[9]);//price * qty
			     SetSessionParam('total',$this->total);					 	   
		    
                 $this->buffer[$buffer_num] = "x";  
                 break;
           }                                   
        }                    
		$this->setStore();
		
		if ($user = $this->user)
			$this->update_statistics('cart-api-remove', $user);
		
 	    $this->quick_recalculate();	//re-update prices and totals	
		
		return ($id);
	}	
	
	public function apiCartRead() {
	    if (empty($this->buffer)) return;

        reset ($this->buffer);
		
		$cartsumitems = 0;
	    $qty_total = 0;
	    $total = 0;	
	
        foreach ($this->buffer as $prod_id => $product) {

		    if (($product) && ($product!='x')) {
				$aa+=1;
				$param = explode(";",$product); 
				$code = $param[7]; //$param[0];
				$cat = $param[4];
				$item = $param[1];
				$utitle = $this->replace_cartchars($item, true);				
				$link = _m("cmsrt.url use t=$command&cat=$cat&id=" . $code ."+" . $utitle); 
			   
				$itemphoto = _m($this->shclass . ".get_photo_url use ".$param[7].'+1');
				$linkimage = seturl("t=$command&cat=$cat&id=".$code, "<img src=\"" . $itemphoto . "\" $ixw $iyh alt=\"$item\">",null,null,null,true);
				
				$data['cartstatus'] = ($this->status==0) ? 0 : $this->status;//$linkimage : $aa; // . "&nbsp;" . $param[0];
				/*
				$details = null; //$this->cartlinedetails ? ($param[6] ? '&nbsp;' . $this->replace_cartchars($param[6], true) : null) : null;	 
				switch ($this->status) {
					case 3  :  
					case 2  : 
					case 1  :	 //$data['itmcarturldetails'] = $utitle . $details; break; //$param[0] . "&nbsp;" . 				   
					case 0  : 
					default :	 $data['itmcarturldetails'] = $link . $details;  break; //$param[0] . "<br/>" . 					
				}
				*/
				$data['itmcartremove'] = "remcart/".$param[0]."/"; //($this->status) ? null : $this->showsymbol($product,1);//<<allow remove here

				$price = floatval(str_replace(",",".",$param[8]));
				$sumtotal = ($param[9] * $price);
				$qty_total += $param[9];	 
				$total += $sumtotal;
			   
				$data['itmcartprice'] = number_format($price,$this->dec_num,',','.');// . $this->moneysymbol;
				$data['itmcartqty'] = $param[9];

				$options = $this->setquantity("Product$aa",$param[9]);
				if (($this->uniname2) && ($param[11]))
					$options .= $this->setuniname("Uniname$aa",$param[10],$param[10],$param[11]);
				$data['itmcartuni'] = $options;

				$data['itmcarttotal'] = $this->settotal("Product$aa",$price,$param[9]);// . $this->moneysymbol;
				
				$data['itmcarturl'] = _m("cmsrt.url use t=$command&cat=$cat&id=" . $code);
				$data['itmcarttitle'] = $utitle;
				$data['itmcartphoto'] = $itemphoto;
				$data['itmcartcode'] = $param[0];
				$data['itmcartaa'] = $aa;
				$data['itmode'] = $code;
               
			    $loopout[] = $data; 
				  
	            unset ($data);
		        unset ($param);
		    }
			$cartsumitems = $aa; //sum of cart items
	    }
	   	   
	    return ($loopout);  	 	
	}	

};
}
?>