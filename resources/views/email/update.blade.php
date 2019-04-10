@extends("email.base")

@section("content")

<table align="center" width="100%" height="270px" cellpadding="20" cellspacing="0" style="margin: 0 auto; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-position: 50% 69%; background-size: cover; max-width: 600px;" background="http://mind-itl-kfu.ru/img/white_pattern_for_email.png">
    <tr>
        <td align="center">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" style="font-size: 42px;">
                        <b>Mind обновился!</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>


<table align="center" width="100%" cellpadding="20" cellspacing="0" style="margin: 0 auto; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #ffffff; color: #000000; max-width: 600px;">
    <tr>
        <td align="center">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="left" style="font-size: 30px;">
                        <b>Что в новой версии:</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table align="center" width="100%" cellspacing="0" style="background-color: #FFFFFF; margin: 0 auto; margin-bottom: 15px; margin-top: 25px; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; max-width: 600px;">
    <tr>
        <td align="center" style="border-radius: 10px 0 0 10px; font-size: 40px; color: #ffffff; background-color: #004b7e;" width="10%">
            1
        </td>
        <td align="left" style="font-size: 20px; border: 1px solid #9ba2ab; padding-left: 20px; background-image: linear-gradient(to bottom, #ffffff 0%, #ebebeb 100%);">
            возможность отправлять сообщения
        </td>
    </tr>
</table>

@endsection

@section("ending")
    Приятного пользования! <br>
    <b>Команда Mind</b>
@endsection
