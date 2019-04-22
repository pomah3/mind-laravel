<div style="font-family: 'Trebuchet MS', Helvetica, sans-serif;">
    <table align="center" width="100%" cellpadding="20" cellspacing="0" style="margin: 0 auto; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #004b7e; color: #ffffff; max-width: 600px;">
        <tr>
            <td align="center">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="">
                                        <img src="http://mind-itl-kfu.ru/img/logo_full.png" alt="MIND" border="0" width="" height="50" style="display:block;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    @yield('content')

    @component("email.components.p")
        Приятного пользования! <br>
        <b>Команда Mind</b>
    @endcomponent

    <table align="center" width="100%" cellpadding="5" cellspacing="0" style="margin: 0 auto; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #004b7e; color: #ffffff; max-width: 600px;">
        <tr>
            <td></td>
            <td>
                <a href="http://mind-itl-kfu.ru">
                    <img src="http://mind-itl-kfu.ru/img/logo_full.png" alt="MIND" border="0" width="" height="30" style="display:block; left: 0px" align="left">
                </a>
            </td>
            <td align="right">
                <table>
                    <tr>
                        <td style="text-align: right;">
                            <a style="color: #ffffff; font: 12px Arial, sans-serif; line-height: 15px; -webkit-text-size-adjust:none; display: block;" href="http://mind-itl-kfu.ru">Сайт</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">
                            <a style="color: #ffffff; font: 12px Arial, sans-serif; line-height: 15px; -webkit-text-size-adjust:none; display: block;" href="http://mind-itl-kfu.ru/doc">Справка</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">
                            <a style="color: #ffffff; font: 12px Arial, sans-serif; line-height: 15px; -webkit-text-size-adjust:none; display: block;" href="https://vk.com/mind_itl">Группа Вконтакте</a>
                        </td>
                    </tr>
                </table>
            </td>
            <td></td>
        </tr>

    </table>
</div>
