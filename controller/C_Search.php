<?php
include_once('controller/C_Base.php');

class C_Search extends C_Base
{
    public $main;
    public $parse_model;
    public $page_model;

    function __construct() 
    {
        parent::__construct();
        $this->parse_model = new M_Parse_Model();
        $this->page_model = new M_Page_Model();
    }

    protected function OnInput()
    {
        parent::OnInput();
    }

    protected function Action_index($type = '')
    {
        //echo"<pre>";print_r($_REQUEST);echo"</pre>";
        $this->main = true;
        $this->main_page = false;
        ;
        if(!isset($_POST['pagination-handler'])) {
            if (isset($_REQUEST['year_from']) && (int)$_REQUEST['year_from'] > 0) $year_from = (int)$_REQUEST['year_from']; else $year_from = 2005;
            if (isset($_REQUEST['year_to']) && (int)$_REQUEST['year_to'] > 0) $year_to = (int)$_REQUEST['year_to']; else $year_to = date('Y') + 1;
            if (isset($_REQUEST['brands']) && !empty($_REQUEST['brands'])) $make = $_REQUEST['brands']; else $make = '';
            if (isset($_REQUEST['models']) && !empty($_REQUEST['models'])) $model = $_REQUEST['models']; else $model = '';
            if (isset($_REQUEST['millage']) && !empty($_REQUEST['millage'])) $millage = $_REQUEST['millage']; else $millage = '';
            $this->meta['title'] = $make . $model;
            //die($_REQUEST['brands']);

            if($type !== '') $_REQUEST['categories'] = $type;

            if (isset($_REQUEST['categories'])) {
                switch ($_REQUEST['categories']) {
                    case "1" :
                        $category = "V";
                        break;//Auto
                    case "2" :
                        $category = "U";
                        break;//Tracks
                    case "3" :
                        $category = "L";
                        break;//treilers
                    case "4" :
                        $category = "M";
                        break;//яхта
                    case "5" :
                        $category = "C";
                        break;//мотоцикли
                    case "6" :
                        $category = "A";
                        break;//Quadro
                    case "7" :
                        $category = "V";
                        break;
                    default  :
                        $category = "V";
                        break;
                }
            } else $category = '';

            $make = trim(substr($make, 0, 4));

            //echo "http://ww2.copart.com/us/search?companyCode_vf=US&Sort=sd&LotTypes=$category&YearFrom=$year_from&YearTo=$year_to&Make=$make&ModelGroups=$model&RadioGroup=Location&YardNumber=&States=&PostalCode=&Distance=99999";
            $sitesToParse[] = "http://ww2.copart.com/us/search?companyCode_vf=US&Sort=sd&LotTypes=$category&YearFrom=$year_from&YearTo=$year_to&Make=$make&ModelGroups=$model&RadioGroup=Location&YardNumber=&States=&PostalCode=&Distance=99999";

        }
        else $sitesToParse[0] = 'http://ww2.copart.com/' . $_POST['pagination-handler'];

        if(strpos($sitesToParse[0], 'Page=') > 0){
            $current = substr(substr($sitesToParse[0], strpos($sitesToParse[0], 'Page=')), 0 + strlen('Page=') , 1);
        }
        else $current = 1;

        //print_r($sitesToParse[0]);

        $cars = $this->parse_model->parse($sitesToParse[0]);

        //echo "<pre>";print_r($cars);echo "</pre>";
        $vars = array('cars' => $cars, 'searchString' => $sitesToParse[0], 'current' => $current);
        $this->content = $this->View('parse/tpl_parse_result.php', $vars);
    }

    protected function OnOutput()
    {
        parent::OnOutput(); 
    }

    public function Action_page($lotId)
    {
		$images = array();
        $carId = null;
        $state = false;
        // adding assets, js
        $this->addJs('easing.1.3.js');
        $this->addJs('fitvids.js');
        $this->addJs('bxslider.js');
        $this->addJs('bxSliderInit.js');
        $this->addJs('fancybox/source/jquery.fancybox.pack.js');

        $this->main = true;

        $car = $this->parse_model->parseSingle($lotId);

        if(!empty($car['images'])) {
            for ($i = 1; $i < $car['images']['count']; $i++)
                $images[] = str_replace('_1X.JPG', '_' . $i . '.JPG', $car['images']['link']);
        }

        $carData['fullName'] = $car['name'];
        $carData['year']     = filter_var(substr($car['name'], 0, 5), FILTER_SANITIZE_NUMBER_INT);
        $carData['lotId']    = $lotId;
        $carData['odometer'] = (empty($car['Odometer'])) ? '' : $car['Odometer'];
        $carData['vin']      = (empty($car['VIN'])) ? '' : $car['VIN'];
        $carData['type']     = (empty($car['Body Style'])) ? '' : $car['Body Style'];
        $carData['color']    = (empty($car['Color'])) ? '' : $car['Color'];
        $carData['engine']   = (empty($car['Engine Type'])) ? '' : $car['Engine Type'];
        $carData['wheels']   = (empty($car['Drive'])) ? '' : $car['Drive'];
        $carData['fuel']     = (empty($car['Fuel'])) ? '' : $car['Fuel'];
        $carData['ends']     = (empty($car['endsDate'])) ? '' : date('Y-m-d H:i:s', strtotime($car['endsDate']));

		$this->meta['title'] = $car['name'];
		
        if(isset($images[0])) $carData['images']   = 'http://' . $images[0];
		
        if(isset($car['Current Bid']))
            $carData['price']    = (empty($car['Current Bid'])) ? '' : $car['Current Bid'];
        else
            $carData['price']    = (empty($car['Current Bid:'])) ? '' : $car['Current Bid:'];


        if(is_numeric($carData['lotId']) && !empty($carData['images']) && $car['name'] != 'Lot no longer exists.')
		{
            $_SESSION['lastSearch'][$lotId] = $carData;

			$carId = $this->page_model->saveCar($carData);
			
			if(!empty($this->user['id'])){
				$this->parse_model->saveCarUser($this->user['id'], $carId);
			}

            if(isset($this->user['id']))
                $state = $this->page_model->checkFavState($this->user['id'], $carId);//var_dump($state);
		}
		else{
			$carId = $this->page_model->deleteCar($carData);
			if(isset($_SESSION['lastSearch'][$lotId])) unset($_SESSION['lastSearch'][$lotId]);
		}
 //echo"<pre>";print_r($car);echo "</pre>";


        $vars = array('car' => $carData, 'car_ext' => $car, 'images' => $images, 'carId' => $carId, 'state' => $state);
        $this->content = $this->View('parse/tpl_detail.php', $vars);

    }

}