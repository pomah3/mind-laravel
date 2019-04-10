@extends("email.base")

@section("content")

<table align="center" width="100%" height="270px" cellpadding="20" cellspacing="0" style="margin: 0 auto; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-position: 50% 69%; background-size: cover; max-width: 600px;" background="http://mind-itl-kfu.ru/img/white_pattern_for_email.png">
    <tr>
        <td align="center">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" style="font-size: 48px;">
                        <b>Подтвердите почту!</b>
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
                    <td align="left" style="font-size: 20px;">
                        {{ $user->get_name() }}, подтвердите свою почту по <a href="{{ URL::signedRoute("verify_email", ["user"=>$user]) }}">ссылке</a> и дождитесь ответного письма!
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
                    <td align="left" style="font-size: 25px;">
                        Приятного пользования! <br>
                        <b>Команда Mind</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

@endsection
