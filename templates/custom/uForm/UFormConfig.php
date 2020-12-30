<?php
namespace uForm;

class UFormConfig
{
    // ################## Настройки содержимого письма ##################
    public $isHtml = true; // текст письма оформлен при помощи HTML тегов - true | обычный текст - false

    // ################## отправитель и получатели ##################
    public $fromMail = 'mailer@maya.com.ua'; // Ваш Email, с которого отправляется письма (если используется SMTP, крайне желательно, чтоб совпадал с email-ом SMTP)
    public $receiverMails = 'front3.sofona@gmail.com'; // Email получателей chopykov@gmail.com
    public $bccMails = ''; // Email скрытых получателей (если нужно)
    public $techMails = 'info@sofona.com';

    // ################## Настройки SMTP ##################
    public $isSmtp = true; // если используется SMTP - true, иначе - false
    private $isSSL = ''; // если используется сайт с SSL (https) - true, иначе - false, если оставить пустым, попытается определить автоматически
    public $smtp = [
        'username' => 'mailer@maya.com.ua',
        'password' => '8aQs76tg',

        // this is the default for sofona smtp
        'host' => 'mail.smartmail.club',
        'SMTPAuth' => true,
    ];


    function __construct()
    {
        if(empty($this->isSSL)){
            $this->isSSL = (
                (isset($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https') ||
                (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ||
                (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443') ||
                (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
            );
        }

        if($this->isSSL) {
            $this->smtp['SMTPSecure'] = 'ssl';
            $this->smtp['port'] = '465';
        }
        else{
            $this->smtp['SMTPSecure'] = '';
            $this->smtp['port'] = '25';
        }
    }
}
