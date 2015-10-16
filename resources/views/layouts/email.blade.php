<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width" />
        <meta name="format-detection" content="telephone=no" />
        @yield('meta')
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,600,700' rel='stylesheet' type='text/css' />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css' />
        <title>@yield('title', 'Helpsmile')</title>
        <style type="text/css">
            /* ====== Client-specific Styles Bring inline: No ====== */
            #outlook a {padding:0;} 
            .ExternalClass {width:100%;}
            .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
            table {border-spacing: 0;border-collapse: collapse;}
            td {border-collapse: collapse !important;}
            table, td {mso-table-lspace: 0pt;mso-table-rspace: 0pt;}
            a{text-decoration:none !important;}
            .mob-link,.mob-link a{color:#bebbb9 !important;text-decoration:none !important;}
            p {margin: 0px 0px !important;}
            /* ====== Mobile Styles Bring inline: No ====== */
            @media only screen and (min-width:480px) and (max-width: 640px) {
            table[class="fullwidth"] {width: 100%!important;text-align:center!important;}
            table[class="container"] {width: 440px!important;text-align:center!important;}
            table[class="innercontainer"] {width: 420px!important;text-align:center!important;border:none !important;}
            table[class="innercontainer2"] {width: 320px!important;text-align:center!important;}
            td[class="split-mob"]{width: 100% !important;display: block !important;text-align:center !important;border:none !important;}
            img[class="banner"] {width: 100% !important;max-width: 100% !important;height:auto!important;}
            td[class="hide"]{display:none !important;}  
            }
            @media only screen and (max-width: 479px) {
            table[class="fullwidth"] {width: 100%!important;text-align:center!important;}
            table[class="container"] {width: 280px!important;text-align:center!important;}
            table[class="innercontainer"] {width: 260px!important;text-align:center!important;}
            table[class="innercontainer1"] {width: 420px!important;text-align:center!important;border:none !important;}
            table[class="innercontainer2"] {width: 220px!important;text-align:center!important;}
            td[class="split-mob"]{width: 100% !important;display: block !important;text-align:center !important;}
            td[class="split-mob1"]{width: 100% !important;padding-right: 0px !important;padding-left: 0px !important;display: block !important;text-align:center !important;}
            img[class="banner"] {width: 100% !important;max-width: 100% !important;height:auto!important;}
            td[class="hide"]{display:none !important;}
            }
        </style>
        <!--[if mso]>
        <style type="text/css"> body,table tr,table td,a, span,table.MsoNormalTable {  font-family:'Raleway', Arial, Helvetica, sans-serif !important;  }</style>
        <!--<![endif]-->
    </head>
    <body style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;margin: 0;padding: 0;mso-margin-top-alt: 0px;mso-margin-bottom-alt: 0px;mso-padding-alt: 0px 0px 0px 0px;font-family: 'Raleway', Arial,sans-serif;width: 100% !important;background-color: #e0dce0;" class="wrapper-color">
        <!-- Wrapper Table -->
        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin: 0;padding: 0;width: 100% !important;line-height: 100% !important;background-color: #e0dce0;" class="wrapper-color">
            <tr>
                <td align="center" valign="top">
                    @yield('content')
                </td>
            </tr>
        </table>
        <!-- Wrapper Table Ends -->
    </body>
</html>