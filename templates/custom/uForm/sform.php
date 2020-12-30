<?php
// uncomment for debuging
//ini_set('error_reporting', E_ERROR);
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

// comment for debuging
ini_set('error_reporting', 0);
ini_set('display_errors', 0);

use uForm\classes\uForm;

require 'classes/uForm.php';


// ################## получаемые данные от формы ##################
//
if(0) uForm::saveDumpDataForm(); // при необходимости можно сохранить дамп присылаемых данных из формы ($_POST, $_FILES)
$customConfig = null;

// НАСТРОЙКА ВАЛИДАЦИИ ДАННЫХ ИЗ ФОРМЫ
$inputs = [
    'mainForm' => [ // id формы
        'Имя' => ['lenStr' => [2, 50, false]],
        'Телефон' => '',
        'Комментарий' => ['lenStr' => [0, 250, true]],        
   ]
];


// СПИСОК ОБЯЗАТЕЛЬНЫХ ПОЛЕЙ (можно оставить пустым, но удалять переменную нельзя)
$requires = [
    'mainForm' => ['Имя', 'Телефон', 'Комментарий']
];


// НАСТРОЙКА ВАЛИДАЦИИ ЗАГРУЖЕННЫХ ФАЙЛОВ (можно оставить пустым, но удалять переменную нельзя)
$files = [];


// -----------------------------------------------------------------------------------
// ############################### ФОРМИРОВАНИЯ ПИСЬМА ###############################
//
$uform = null;
$formData = getFormData($inputs, $files, $requires, $uform);
// $formData - полученные данные из формы в формате ['name1' => 'value1', 'name2' => 'value2']
// $formData также содержит "uFormId" - id формы, можно сделать if($formData['uFormId'] == 'uForm_any')
// и в зависимости от id формы, по-разному формировать письмо или отправить почту с другим конфигами SMTP через переменную $customConfig['configParamName'] = configParamVal
// $inputs[$formData['uFormId']] - список всех ожидаемых импутов


// ТЕМА ПИСЬМА
$mail_subject = 'Сообщение с сайта maya.com.ua';


// ТЕКСТ ПИСЬМА (тут формируем тело письма, на свое усмотрение)
$mail_body = '';
// перебор всех ожидаемых полей форм ($name - название поля, $formData[$name] - его значение)
foreach ($inputs[$formData['uFormId']] as $name => $valid){

    $mail_body .= '<b class="input-name">'.$name.'</b>: ';

    $mail_body .= '<span class="input-value">';

    if(!empty($formData[$name])){
        $mail_body .= is_array($formData[$name])? implode(', ', $formData[$name]) : $formData[$name];
    }
    else{
        $mail_body .=  " is empty";
    }

    $mail_body .= '</span><br>';
}



/**
 * ⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡
 * #################################### НИЖЕ НИЧЕГО МЕНЯТЬ НЕ СТОИТ ####################################
 *
*/




































/**
 * ⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡
 * ########################## Я ЖЕ ПРОСИЛ!  НЕ ДЕЛАЙ ЭТОГО!!!  ТВОЙ КОД ВЫШЕ! ##########################
 * ########################## Я ЖЕ ПРОСИЛ!  НЕ ДЕЛАЙ ЭТОГО!!!  ТВОЙ КОД ВЫШЕ! ##########################
 * ########################## Я ЖЕ ПРОСИЛ!  НЕ ДЕЛАЙ ЭТОГО!!!  ТВОЙ КОД ВЫШЕ! ##########################
 * ⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡⇑⇧⇑⇡
*/





























// КОД - КОТОРЫЙ ЛУЧШЕ НЕ ТРОГАТЬ...
// P.S. И так же все работает :(
//
if(empty($uform)){
    echo json_encode(['success' => false, 'error' => 'create uForm failed']);
    die;
}
/** @var uForm $uform */
$result = $uform->sendMail($mail_subject, $mail_body, $customConfig);
//$answer = ['success' => true];
$answerForAJAX = ['success' => $result[0], 'info' => $result[1]];
echo json_encode($answerForAJAX);


function getFormData($inputs, $files, $requires, &$uform)
{
    $uFormId = '';
    if(isset($_POST['uFormId']) && isset($inputs[$_POST['uFormId']])) {

        $uFormId = $_POST['uFormId'];
        $inputs = $inputs[$uFormId];
        $files = isset($files[$uFormId])? $files[$uFormId] : [];
        $requires = isset($requires[$uFormId])? $requires[$uFormId] : [];
    }
    else{
        $answer = ['success' => false, 'info' => 'failed form id'];
        echo json_encode($answer);
        die;
    }

    $uform = new uForm();
    // получение всех полей указанных в $inputs
    $formData = $uform->getPostData($inputs);
    if(empty($formData)) {
        $answer = ['success' => false, 'info' => 'empty data'];
        echo json_encode($answer);
        die;
    }
    elseif($formData == 'ISBOT'){
        $answer = ['success' => false, 'info' => 'isbot'];
        echo json_encode($answer);
        die;
    }
    // провека и получение файлов
    $uform->getLoadFiles($files);

    // проверка обязательных полей $requires
    $requireResult = $uform->testRequires($requires);
    if($requireResult !== true){
        $answer = ['success' => false, 'info' => 'empty required input', 'data' => $requireResult];
        echo json_encode($answer);
        die;
    }

    $formData['uFormId'] = $uFormId;
    return $formData;
}