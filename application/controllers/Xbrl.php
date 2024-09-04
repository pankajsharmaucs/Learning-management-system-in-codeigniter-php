<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Xbrl extends CI_Controller
{


    public function index()
      {
          $source_url='http://15.206.122.169:8080/rest/xbrl/https://uat.kreditaid.com/upload/report/4ph17qJjgx/flipkart_ind_as.xml/facts?media=json&factListCols=Name,Label,Value,Period,Dimensions';
          // echo $source_url;
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_URL, $source_url);
          $file = curl_exec($ch);
          curl_close($ch);
          // echo $file;
          // exit;

          if($file){
            $result=json_decode($file);
            foreach ($result->factList as $fact) {
              // $name = explode(':', $fact[1]->name);
              // $name=$name[1];
              $name=$fact[1]->name;
              $value=@$fact[2]->value;
              $date=@$fact[2]->endInstant;
              $start=@$fact[2]->start;
              $dimensions=@$fact[2]->dimensions;

              $data[$name]['value'][]=$value;
              $data[$name]['end'][]=$date;
              $data[$name]['start'][]=$start;
              $data[$name]['dimensions'][]=$dimensions;
            }
            echo json_encode($data);
          }
      }

      public function test(){
        $src="https://uat.kreditaid.com/upload/report/4ph17qJjgx/flipkart_ind_as.xml";
        $data = file_get_contents($src);
        $xml = simplexml_load_string($data);
        $json = json_encode($xml);
        echo $json;
      }

//       string strURL = "http://webservice.group-ucs.com/ser_mainsearch.asmx/BuyReport?MemberID=" + memberID + "&Password=" + password + "&Country=" + country + "&ReportID=" + reportID + "&CustomerReference=" + customerReference + "&RequestFor=" + requestFor + "";
//             HttpWebRequest request = (HttpWebRequest)WebRequest.Create(strURL);
//             request.Method = "GET";
//             request.ContentType = "application/xml";
//             WebResponse response = request.GetResponse();
//             var
//  string strURL = "https://uat.kreditaid.com/upload/report/WF5InCvuVg/flipkart_ind_as.xml";
//             HttpWebRequest request = (HttpWebRequest)WebRequest.Create(strURL);
//             request.Method = "GET";
//             request.ContentType = "application/xml";
//
//
//             WebResponse response = request.GetResponse();
//             var responseString = new StreamReader(response.GetResponseStream()).ReadToEnd();
//             XmlDocument doc = new XmlDocument();
//             if (responseString.Contain
// Herkishan Kapil4:04 PM
// Reserves and surplus

}
