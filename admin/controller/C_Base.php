<?php
include_once('controller/Controller.php');
include_once('model/M_mysql.php');

//
// BASE CONTROLLER.
//
abstract class C_Base extends Controller
{
	private     $start_time;
    protected   $content;
    protected   $basePath;

    protected   $configData;
    protected   $user;
    public      $user_model;
    public      $vars;
    public      $setDateFormat;

    public      $pages_model;

    function __construct($isLogin = 0)
	{
        $this->configData   = parse_ini_file('../config.ini',true);
        $this->basePath     = trim($this->configData['config']['basePath']) . "admin/";
        $this->baseSitePath = trim($this->configData['config']['baseSitePath']);

        $this->user = $_SESSION['user'];

        if(empty($this->user) && $isLogin == 0)
        {
            $this->baseSitePath = trim($this->configData['config']['baseSitePath']);
            $this->redirect('user/login');
        }

        $this->vars['enter_your_message'] = "Введіть Ваше запитання";

        /******/
        $this->pages_model = new M_Pages_Model();
    }

	protected function OnInput(){
		$this->start_time = microtime(true);
    }

	protected function OnOutput()
	{
		$render = array();
		$render['content'] = $this->content;

        $prices = $this->pages_model->getZonePrices();

		$vars = array('render' => $render, 'prices' => $prices);
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

    protected function location($str = ''){
        echo $this->basePath . $str;
    }

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

    // change date language on UA
    public function setDateFormat($date = ''){

        $month = array(
            'January'   =>  "Січня",
            'February'  =>  "Лютого",
            'March'     =>  "Березня",
            'April'     =>  "Квітня",
            'May'       =>  "Травня",
            'June'      =>  "Червня",
            'July'      =>  "Липня",
            'August'    =>  "Серпня",
            'September' =>  "Вересня",
            'October'   =>  "Жовтня",
            'November'  =>  "Листопада",
            'December'  =>  "Грудня"
        );

        $f          = $month[date("F", strtotime($date))];
        $j          = date("j",$date);
        $y          = date("Y", strtotime($date));
        $time       = date("H:m:i", strtotime($date));
        $separator  = ' o ';

        echo "$j $f $y $separator $time";

    }
}
