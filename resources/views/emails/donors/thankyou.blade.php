@extends('layouts.email')

@section('content')

<!-- ======= HEADER MODULE ====== -->
@include('partials.emails._header')
<!-- ======= HEADER MODULE ENDS ====== -->

<!-- ======= TOP BANNER MODULE ====== -->
<table width="600" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;" class="container">
    <tr>
        <td background="{{ asset('assets/img/emails/topbanner.jpg') }}" align="center" valign="top" style="background-color: #6a6a6a;-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;background-position: top center;">
            <!--[if gte mso 9]>
            <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;">
                <v:fill type="frame" src="images/topbanner.jpg" color="#6a6a6a" />
                <v:textbox style="mso-fit-shape-to-text:true" inset="0,0,0,0">
                    <![endif]-->
                    <table width="560" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;" class="innercontainer">
                        <tr>
                            <td align="center" valign="top" style="padding-top:100px;padding-bottom:100px;">
                                <table  width="460" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;" class="innercontainer2">
                                    <tr>
                                        <td align="center" style="font-family: 'Raleway', Arial, Helvetica, sans-serif;color:#ffffff;text-transform:uppercase;font-size: 30px;font-weight:700;text-decoration:none;line-height:35px;text-align:center;padding-bottom:35px;">    
                                            Donate <span style="color:#e8be2d;" class="main-color">&amp;</span> Prevent Blindness
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" style="font-family: 'Raleway', Arial, Helvetica, sans-serif;color:#FFFFFF;font-size: 14px;font-weight:400;text-decoration:none;line-height:24px;text-align:center;padding-bottom:70px;"> 
                                            Thank you for your valuable donation of ₹ {{ $donated_amount }} to Helpsmile India. Your support directly goes in helping restore sight and eliminate blindness in India.
                                        </td>
                                    </tr>
                                    <!-- button -->
                                    <tr>
                                        <td align="center">
                                            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                <tr>
                                                    <td align="center" valign="middle" height="35" style="display: block;padding-left: 25px;padding-right: 25px;color: #1b2c34;border: 1px solid;border-color: #e8be2d;background-color:#e8be2d;border-radius:25px;" class="btn" >
                                                        <a href="{{ Config::get('Helpsmile.email.about') }}" style="text-align: center;text-decoration: none;-webkit-text-size-adjust: none;font-size: 13px;line-height: 35px;display: inline-block;width: 100%;font-family: 'Raleway', Arial, Helvetica, sans-serif;font-weight: 600;color: #1b2c34;text-transform:uppercase;">
                                                        About Us
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- button ends -->
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--[if gte mso 9]>
                </v:textbox>
            </v:rect>
            <![endif]-->
        </td>
    </tr>
</table>
<!-- ======= TOP BANNER MODULE ENDS ====== -->

<!-- ======= ABOUT MODULE ====== -->
<table width="600" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;background-color: #ffffff;" class="container">
    <tr>
        <td height="50"  style="font-size:0px; line-height:0px; mso-line-height-rule: exactly;">&nbsp;</td>
    </tr>
    <!-- heading starts -->
    <tr>
        <td align="center" valign="top" style="padding-bottom:50px;">
            <table width="560" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;" class="innercontainer">
                <tr>
                    <td class="h1" style="font-family: 'Raleway', Arial, Helvetica, sans-serif;color:#26211D;font-weight:600;line-height:28px;font-size: 22px;text-decoration:none;text-align:center;padding-bottom:5px;">
                        The Problem
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle">
                        <img src="{{ asset('assets/img/emails/underline.png') }}" width="60" height="10" alt="" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;border: none;text-align:center;" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- heading ends -->
    <tr>
        <td align="center" valign="top">
            <table width="560" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;" class="innercontainer">
                <tr>
                    <td>
                        <table align="center" width="500"  style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;" border="0" cellpadding="0" cellspacing="0" class="innercontainer">
                            <tr>
                                <td class="text" style="font-family: 'Raleway', Arial, Helvetica, sans-serif;color:#26211d;font-weight:400;line-height:22px;font-size: 13px;text-decoration:none;text-align:center;">
                                    Did you know that 80% of blindness can be prevented? There are more than 12 million* blind people in India. That’s about 30% of the world’s total blind population – most of whom went blind unnecessarily. You can make a difference by helping us combat the problem. Since 1966, we have been working with local partners to eliminate avoidable blindness and support people who are irreversibly blind or disabled.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Lists -->
                <tr>
                    <td align="center" style="padding-top:40px;">
                        <table align="center" width="100%"  style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="left" width="47%" style="font-family: 'Raleway', Arial, Helvetica, sans-serif;font-weight:600;line-height:26px;font-size: 13px;text-decoration:none;text-align:left;" class="split-mob">
                                    <span style="color:#e8be2d;font-weight:600;" class="main-color">&raquo;&nbsp;</span><span style="color:#26211d;" class="text">12 million people around India are blind</span><br />
                                </td>
                                <td width="6%" height="20" style="font-size:0px; line-height:0px; mso-line-height-rule: exactly;" class="split-mob">&nbsp;</td>
                                <td align="left" width="47%" style="font-family: 'Raleway', Arial, Helvetica, sans-serif;font-weight:600;line-height:26px;font-size: 13px;text-decoration:none;text-align:left;" class="split-mob">
                                   <span style="color:#e8be2d;font-weight:600;" class="main-color">&raquo;&nbsp;</span><span style="color:#26211d;" class="text">80% of this can be cured or prevented</span><br />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Lists end -->
            </table>
        </td>
    </tr>
    <tr>
        <td height="50"  style="font-size:0px; line-height:0px; mso-line-height-rule: exactly;">&nbsp;</td>
    </tr>
</table>
<!-- ======= ABOUT MODULE ====== -->

<!-- ======= FOOTER ====== -->
@include('partials.emails._footer')
<!-- ======= FOOTER ENDS ====== -->

<!-- ======= SOCIAL ICONS ====== -->
@include('partials.emails._socialicons')
<!-- ======= SOCIAL ICONS ENDS ====== -->

<!-- ======= COPYRIGHT ====== -->
@include('partials.emails._copyright')
<!-- ======= COYPRIGHT ENDS ====== -->

@stop