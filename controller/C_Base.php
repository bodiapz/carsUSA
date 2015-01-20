<?php
include_once('controller/Controller.php');
include_once('model/M_mysql.php');

//
// BASE CONTROLLER.
//
abstract class C_Base extends Controller
{
	private $start_time;
    protected $content;
    protected $basePath;
    protected $configData;
    protected $user_model;

    public $url;
    public $prefix;
    public $langVars;
    public $location;
    public $js;
    public $css;
    public $currency;
    public $lastSearch;
    public $brands;
    public $randomCars;
    public $vars;
    public $user;
    public $user_id;

    function __construct()
	{ 	
		global $config;
        $this->currency = $this->getCurrency();

        $this->user_model = new M_User_Model();

        //echo "<pre>"; print_r($_SESSION);echo"</pre>";
        if(isset($_SESSION['lastSearch'])) {
            $i = 0;
            $rand = rand(0, count($_SESSION['lastSearch']));
            //echo $rand;
            foreach ($_SESSION['lastSearch'] as $key => $lot) {
                if($i == $rand) $this->lastSearch = $_SESSION['lastSearch'][$key];
                $i++;
            }
        }

        if(!empty($_SESSION['user']['id'])) {
            $this->user = $this->user_model->getUser($_SESSION['user']['id']);
        }

        $this->configData   = $config;
        //echo"<pre>";print_r($this->configData);echo"</pre>";
        $this->basePath     = trim($this->configData['config']['basePath']);
        $this->page_model = new M_Page_Model();
        $this->category_model = new M_Category_Model();

        $this->randomCars = $this->page_model->getRandomCars();
        if(empty($_SESSION['language']))
            $_SESSION['language'] = 'ua';

        $this->prefix = '';

        if(isset($_REQUEST['lang']) && ($_REQUEST['lang'] == 'ua' || $_REQUEST['lang'] == 'ru'))
            $_SESSION['language'] = $_REQUEST['lang'];

        if(isset($_SESSION['language']))
            if($_SESSION['language'] != 'ua') $this->prefix = $_SESSION['language'] . '_';
        
        if(isset($_SESSION['language']))
            $this->langVars = $this->get_translate($_SESSION['language']);

        //print_r($this->langVars);
        if(!empty($_REQUEST['action']))
            $this->page = $_REQUEST['action'];

        $this->vars['enter_your_message'] = "Введіть Ваше запитання";

        if(!empty($this->user))
            $this->user_id = $this->user['id'];

        //echo $this->getIpAddress();
    }

	protected function OnInput(){
		$this->start_time = microtime(true);
        $this->main_page = true;
    }

	protected function OnOutput()
	{
		$render = array();
		$render['content'] = $this->content;

        $categories = $this->category_model->get_categories();
        $brands     = $this->page_model->get_brands(1);
        $pages      = $this->page_model->getPages();


		$vars = array(
            'render' => $render,
            'categories' => $categories,
            'brands' => $brands,
            'randomCars' => $this->randomCars,
            'pages' => $pages
        );

		$page = $this->View('layout/tpl_content.php', $vars);

        $time = microtime(true) - $this->start_time;
        $page .= "<!-- Generated : $time sec.-->";
        echo $page;
	}


    protected function redirect($str = ''){
        $separator = "";
        //if(substr($this->basePath,strlen($this->basePath),1) == "/")
        //    $separator = "";
        header('Location: ' . $this->basePath . $separator . $str);
        die();
    }

    protected function checkAccess(){
        if(empty($this->user))
            $this->redirect();
    }

    protected function location($str = ''){
        echo $this->basePath . $str;
    }

    protected function load_view($fileName = '')
    {}

    protected function print_s($str = ''){
        if(!empty($str)){
            echo htmlspecialchars_decode(nl2br($str));
            return true;
        }
        else return false;
    }

    protected function highlight($str = '', $highlight){
        echo str_replace($highlight, '<span class="highlight">' . $highlight . '</span>', $str);
    }

    public function humanCount($count){
        if($count >= 1000000) $count = $count/1000000 . 'm';
        elseif($count >= 1000) $count = $count/1000 . 'k';

        return $count;
    }

    public function get_translate($language = 'ua')
    {
        $lang = fopen($this->basePath . 'assets/languages/' . $language . '.lang', 'r');

        while(!feof($lang)){
            $line = fgets($lang);
            $vars = explode('=', $line);
            if(count($vars) > 1 && $vars != '')
                $return[trim($vars[0])] = trim($vars[1]);
        }

        fclose($lang);

        return $return;
    }

    public function translate($str, $print = true)
    {
		if($print)
			if(!empty($this->langVars[$str])) echo $this->langVars[$str]; else echo $str;
		else
			return (!empty($this->langVars[$str])) ? $this->langVars[$str] : $str;
    }

    public function printJs()
    {
        if(!empty($this->js)) {
            foreach ($this->js as $js) {
                echo '<script type="text/javascript" src="' . $this->basePath . 'assets/js/' . $js . '" ></script>';
            }
        }
    }

    public function addJs($js)
    {
        $this->js[] = $js;
    }

    public function printCss()
    {
        if(!empty($this->css)) {
            foreach ($this->css as $css) {
                echo '<link type="text/css" rel="stylesheet" href="' . $this->basePath . 'assets/css/' . $css . '">';
            }
        }
    }

    public function addCss($css)
    {
        $this->css[] = $css;
    }

    public function getCurrency($link = 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=3'){
        $array = json_decode(file_get_contents($link));
        foreach ($array as $currency) {
            if($currency->ccy == 'USD') return $currency->sale;
        }
    }

    public function copartManuf($manuf){
        $shortBrand = substr($manuf, 0, 4);
        $shortBrand = str_replace(' ', '', $shortBrand);
        if(strtoupper($shortBrand) == 'JEEP') $shortBrand = "JEP";
        if(strtoupper($shortBrand) == 'TOYO') $shortBrand = "TOYT";
        if(strtoupper($shortBrand) == 'SUZU') $shortBrand = "SUZI";
        if(strtoupper($shortBrand) == 'SAAB') $shortBrand = "SAA";
        if(strtoupper($shortBrand) == 'ASSE') $shortBrand = "ASMB";
        if(strtoupper($shortBrand) == 'EAGL') $shortBrand = "EGIL";
        if(strtoupper($shortBrand) == 'EXCA') $shortBrand = "EXCL";
        if(strtoupper($shortBrand) == 'INTE') $shortBrand = "INTL";
        if(strtoupper($shortBrand) == 'LAFO') $shortBrand = "LAFZ";
        if(strtoupper($shortBrand) == 'LAMB') $shortBrand = "LAMO";
        if(strtoupper($shortBrand) == 'LEXU') $shortBrand = "LEXS";
        if(strtoupper($shortBrand) == 'MERC') $shortBrand = "MERZ";
        if(strtoupper($shortBrand) == 'MANX') $shortBrand = "MEYE";
        if(strtoupper($shortBrand) == 'MINI') $shortBrand = "MIN";
        if(strtoupper($shortBrand) == 'MOTO') $shortBrand = "MOGU";
        if(strtoupper($shortBrand) == 'PIER') $shortBrand = "PIRC";
        if(strtoupper($shortBrand) == 'ROAD') $shortBrand = "RMR";
        if(strtoupper($shortBrand) == 'ROLL') $shortBrand = "ROL";
        return $shortBrand;
    }

    public function generateRandomString($length = 40, $withChars = 1)
    {
        $chars  = "1234567890";
        $string = "";

        if($withChars == 1)
            $chars .= "qazxswedcvfrtgbnhyujmkiolpQAZXSWEDCVFRTGBNHYUJMKIOLP";

        for($i = 1; $i <= $length; $i++)
        {
            $string .= $chars[rand(1,strlen($chars)) - 1];
        }

        return $string;
    }

    public function getIpAddress()
    {
        $ipAddres = getenv('HTTP_CLIENT_IP')? : getenv('HTTP_X_FORWARDED_FOR')? : getenv('HTTP_X_FORWARDED')? : getenv('HTTP_FORWARDED_FOR')? : getenv('HTTP_FORWARDED')? : getenv('REMOTE_ADDR');
        echo $ipAddres;
    }

    public function imagesBigger($image)
    {
        $badChars = array('.jpg', '.JPG');
        $goodChars = array('X.jpg', 'X.JPG');
        echo str_replace($badChars, $goodChars, $image);
    }

    public function sendEmail($addresses, $subject = 'No subject', $body = '', $from = '', $atachment = ''){

        if($from == '') $from = $this->configData['mail']['smtpFrom'];

        require_once('assets/classes/phpmailer/class.phpmailer.php');
        require_once('assets/classes/phpmailer/class.smtp.php');
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug    = 0;
        $mail->CharSet = 'UTF-8';
        $mail->Debugoutput  = 'html';
        $mail->Host         = $this->configData['mail']['smtpServer'];
        $mail->Port         = $this->configData['mail']['smtpPort'];
        $mail->SMTPSecure   = $this->configData['mail']['smtpSecure'];
        $mail->SMTPAuth     = true;
        $mail->Username     = $this->configData['mail']['smtpLogin'];
        $mail->Password     = $this->configData['mail']['smtpPass'];

        $mail->setFrom($this->configData['mail']['smtpFrom'], 'Call2Bid');

        if(is_array($addresses)) {
            foreach ($addresses as $address)
                $mail->addAddress($address);
        }
        else $mail->addAddress($addresses);

        if(is_array($atachment)) {
            foreach ($atachment as $file)
                $mail->AddAttachment($file);
        }
        else $mail->AddAttachment($atachment);

        $mail->Subject = $subject;
        $mail->msgHTML($body);

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            die();
        }
    }
}
