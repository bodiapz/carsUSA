<?php

class M_Parse_Model {
    
    public $db;
    public $user_id;
    public $html;

    public function __construct(){
        $this->db = M_PDO::Instance();
        include('assets/classes/simple_html_dom.php');
    }

    public function parse($url){

        $this->html = @file_get_html($url);

        //echo $this->html;

        if(!empty($this->html)) {

            foreach ($this->html->find('table.results') as $table) {
                $counter = 0;
                foreach ($table->find('tr') as $tr) {
                    $counter++;

                    foreach ($tr->find('td') as $key => $td) {

                        if ($key == 0) {
                            $car[$counter]['data'] = json_decode($td->children(0)->innertext);
                            foreach ($td->find('.photo-holder img') as $img)
                                $car[$counter]['image'] = $img->getAttribute('src');

                            /*foreach($td->find('.lot-meta li') as $li){
                                $car[$counter][] = $li->plaintext;
                            }*/

                            foreach ($td->find('li.lot-desc a') as $a) {
                                $car[$counter]['fullname'] = $a->plaintext;
                            }

                            foreach ($td->find('[for="VIN"]') as $vin) {
                                $car[$counter]['vin'] = $vin->parent()->plaintext;
                            }

                            foreach ($td->find('[for="Damage"]') as $damage) {
                                $car[$counter]['damage'] = $damage->parent()->plaintext;
                            }

                            foreach ($td->find('.text-ellipsis') as $millage) {
                                $car[$counter]['millage'] = $millage->plaintext;
                            }

                            foreach ($td->find('.text-ellipsis') as $millage) {
                                $car[$counter]['millage'] = $millage->plaintext;
                            }

                            foreach ($td->find('.location-block a') as $location) {
                                $car[$counter]['location'] = $location->plaintext;
                            }

                            foreach ($td->find('.date-block span') as $sale) {
                                $car[$counter]['sale'] = $sale->plaintext;
                            }

                            foreach ($td->find('.time-block') as $sale) {
                                $car[$counter]['timeLeft'] = $sale->plaintext;
                            }
                        }

                        if ($key == 1) {
                            $car[$counter][] = $td->plaintext;
                        }
                    }
                }
            }

            foreach ($this->html->find('.top-paging li') as $li) {
                $car['pagination'][$li->plaintext] = @$li->children(0)->href;
            }
        }

		//echo "<pre>"; print_r($car);
        if(!empty($car)) return $car;
        else return false;
    }

    public function curl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $this->html = curl_exec($ch);
        curl_close($ch);
    }


    public function cleanText($str)
    {
        return trim(preg_replace('/\s+/', ' ', $str));
    }


    public function parseSingle($lotId){
        $result = null;

        //$this->curl('http://ww2.copart.com/us/Lot/' . $lotId);
        //print_r(htmlspecialchars($this->html));


        $this->html = file_get_html('http://ww2.copart.com/us/Lot/' . $lotId);

        foreach ($this->html->find('.lot-photo') as $thumb) {
            $images['count'] = filter_var($thumb->plaintext, FILTER_SANITIZE_NUMBER_INT);
            $link = $thumb->next_sibling(0)->innertext;
            $images['link'] = substr($link, strpos($link, "'//") + 3);
            $images['link'] = substr($images['link'], 0, strpos($images['link'], "'"));
        }

        $bid = $this->html->find('.content-header h2');//print_r($bid);
        foreach ($bid as $row) {
            $result['name'] = $row->plaintext;
        }
		
        $endsDate = $this->html->find('.converted-time');//print_r($bid);
        foreach ($endsDate as $row) {
            $result['endsDate'] = $row->getAttribute('title');
			break;
        }

        $rows = $this->html->find('.lot-display-list div');

        foreach ($rows as $row) {
            $result[trim(strip_tags(@$row->children(0)->plaintext))] = trim(strip_tags(@$row->children(1)->plaintext));
        }

        if(!empty($images)) $result['images'] = $images;

        return $result;
        echo"<pre>";print_r($result);echo "</pre>";

        die();
    }

    public function saveCarUser($userId, $carId){
        $car = $this->db->selectOne("SELECT * FROM user_cars WHERE user_id = $userId AND car_id = $carId");
        if(empty($car)) $this->db->insert('user_cars', array('car_id' => $carId, 'user_id' => $userId));
    }
}