<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <title><phpdac>cms.paramload use INDEX+title</phpdac></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!--[if mso]>
        <style>
            * {
                font-family: sans-serif !important;
            }
        </style>
    <![endif]-->
    
    <!--[if !mso]><!-->
        <!-- insert web font reference, eg: <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'> -->
    <!--<![endif]-->
    <!-- Web Font / @font-face : END -->
    
    <!-- CSS Reset -->
    <style type="text/css">

        html,
        body {
            Margin: 0 !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }
        
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        
        div[style*="margin: 16px 0"] {
            margin:0 !important;
        }
        
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }
                
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            Margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }
        
        img {
            -ms-interpolation-mode:bicubic;
        }
        
        .yshortcuts a {
            border-bottom: none !important;
        }
        
        .mobile-link--footer a,
        a[x-apple-data-detectors] {
            color:inherit !important;
            text-decoration: underline !important;
        }
      
    </style>
    
    <!-- Progressive Enhancements -->
    <style>
        
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td:hover,
        .button-a:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

        /* Media Queries */
        @media screen and (max-width: 480px) {

            .fluid,
            .fluid-centered {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                Margin-left: auto !important;
                Margin-right: auto !important;
            }

            .fluid-centered {
                Margin-left: auto !important;
                Margin-right: auto !important;
            }

            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }

            .stack-column-center {
                text-align: center !important;
            }
        
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                Margin-left: auto !important;
                Margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }
                
        }

    </style>

</head>
<body width="100%" bgcolor="#203450" style="Margin: 0;">
<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%" bgcolor="#203450" style="border-collapse:collapse;"><tr><td valign="top">
    <center style="width: 100%;">

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <!--div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
            (Optional) This text will appear in the inbox preview, but not the email body.
        </div-->
        
        <!-- Visually Hidden Preheader Text : END -->
        <div style="max-width: 680px;">
        
            <!--[if (gte mso 9)|(IE)]>
            <table cellspacing="0" cellpadding="0" border="0" width="680" align="center">
            <tr>
            <td>
            <![endif]-->

            <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px;">        
            
                <!-- Email Header : BEGIN -->
                <tr>
                    <td>
                        <a href="<phpdac>cms.getHttpUrl</phpdac>">
                        <img src="<phpdac>cms.getHttpUrl</phpdac>/images/newsletters/head-001.jpg" width="680" height="" alt="alt_text" border="0" align="center" style="width: 100%; max-width: 680px;">
                        </a>
                    </td>
                </tr>
                <!-- Email Header : END -->             
                <!-- Email Body : BEGIN -->
                <tr>
                    <td bgcolor='#FFFFFF' cellspacing="10">
                    <h1 align='center'><phpdac>cmsrt.slocale use _REMINDERTITLE</phpdac></h1>
                    <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;">
					
				<tr>
                  <td class="blsubtitles"><phpdac>cmsrt.slocale use _USERNAMETITLE</phpdac>: </td>
                  <td class="lptext" height="25">$0$</td>
                </tr>
                <!--tr>
                  <td class="blsubtitles"><phpdac>cmsrt.slocale use _USERPASSTITLE</phpdac>: </td>
                  <td class="lptext" height="25" nowrap="nowrap"></td>
                </tr-->
				<tr>
                  <td class="blsubtitles"><phpdac>cmsrt.slocale use _REGUSRACTIVLINKTITLE</phpdac>: </td>
                  <td class="lptext" height="25" nowrap="nowrap">
					<a href="$2$"><phpdac>cmsrt.slocale use _REGUSRLINKURL</phpdac></a>
				  </td>
                </tr>				

					</table>
					<br/>
					<br/>
                    </td>
                </tr>
                <!-- Email Body : END -->
            </table>
          
            <!-- Email Footer : BEGIN -->
            <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px;">
                <tr>
                    <td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; mso-height-rule: exactly; line-height:18px; text-align: center; color: #888888;">
                        <p align=center>
                        <a href="<phpdac>cms.paramload use INDEX+facebook</phpdac>">
                        <img border=0 alt="" src="<phpdac>cms.getHttpUrl</phpdac>/images/facebook.png"></a>  
                          <a href="<phpdac>cms.paramload use INDEX+youtube</phpdac>">
                        <img border=0 alt="" src="<phpdac>cms.getHttpUrl</phpdac>/images/youtube.png"></a>
                        </p>                    
                    
                        <phpdac>cmsrt.paramload use INDEX+title</phpdac><br><span class="mobile-link--footer"><phpdac>cmsrt.paramload use INDEX+address</phpdac></span>
                        <br><span class="mobile-link--footer">Tel 0030 <phpdac>cmsrt.paramload use INDEX+tel1</phpdac>, Fax 0030<phpdac>cmsrt.paramload use INDEX+tel2</phpdac> - <a href="<phpdac>cms.getHttpUrl</phpdac>"><phpdac>cmsrt.paramload use INDEX+domain</phpdac></a></span>
                        <br><span class="mobile-link--footer">Mail powered by <a href="https://www.stereobit.com/enterprise.php">e-Enterprise</a></span>                
                    </td>
                </tr>
            </table>
            <!-- Email Footer : END -->

            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </div>          
        
    </center>
</td></tr></table>
</body>
</html>