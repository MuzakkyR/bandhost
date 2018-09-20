<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\hosting;

class HostingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $price = input::get('price');
        $company = input::get('company');

        if ($price == null && $company == null)
        {
            $filhos = hosting::paginate(5);
        }
        else if ($price != null && $company == null)
        {
            $filhos = hosting::where('month_price', '<', $price)
                ->where('month_price', '>', ($price-9999))
                ->paginate(5);                                
        }
        else if ($price == null && $company != null)
        {
            $filhos = hosting::whereIn('brand', $company)
                ->paginate(5);
        }
        else
        {
            $filhos = hosting::where('month_price', '<', $price)
                ->whereIn('brand', $company)
                ->paginate(5); 
        }
        $filcom = hosting::OrderBy('brand')->pluck('brand');

        return view('/after/hosting', ['filhos' => $filhos, 'filcom' => $filcom]);
    }
    public function single($hostingID)
    {
        $tampilkan = hosting::where('hostingID', $hostingID)->first();
        if (empty($tampilkan))
        {
            return '404 not Found';
        }
        else
        {
            return view ('/after/singlehosting', ['tampilkan' => $tampilkan]);
        }
    }
    public function refresh()
    {
        $url = [
            'https://www.domainesia.com/hosting/',
            'https://rumahhosting.com/hosting/hemat',
            'https://www.kuncihost.com/hosting/paket-hosting-us'
        ];
        $brand = [
            'domainesia',
            'rumahhosting',
            'kuncihost'
        ];
        $data_curl = [
            $domainesia = $this->curl($url[0]),
            $rumahhosting = $this->curl($url[1]),
            $kuncihost = $this->curl($url[2])
        ];
        $hasil_curl = [
            $dom = $this->domainesia($data_curl),
            $rum = $this->rumahhosting($data_curl),
            $kun = $this->kuncihost($data_curl)
        ];
        $updatehosting = $this->updatehosting($brand, $hasil_curl);
        
        return redirect()->action('HostingController@index');
    }

    public function curl($url)
    {
        // memulai sesi curl
        $ch = curl_init($url);
        // mengatur curl
        curl_setopt_array($ch, array(
                CURLOPT_RETURNTRANSFER=>true,
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false),
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false),
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true),
                CURLOPT_USERAGENT=>"Mozilla/5.0 (Windows NT 6.1; rv:50.0) Gecko/20100101 Firefox/50.0"
        )); 
        // menjalankan curl
        $hasil = curl_exec($ch);
        // tampilkan pesan error jika terjadi error
        $err = curl_error($ch) and print $err;
        // menutup curl
        curl_close($ch);
        // tampilkan hasil curl
        return $hasil;
    }

    public function domainesia($data_curl)
    {
        $data_domainesia = explode('<tr>', $data_curl[0]);

        $packet_name = [ "Lite" ];
        $month_price = [
            intval(str_replace('.', '', substr(implode('', explode('<td class="center">', $data_domainesia[23])), 58,5)))
        ];
        $disk_Space = [
            intval(substr(implode('', explode('<td class="center">', $data_domainesia[8])), 57, 3))
        ];
        $bandwidth = [
            substr(implode('', explode('<td class="center">', $data_domainesia[9])), 52, 9)
        ];
        $database = [
            substr(implode(explode('<td class="center">', $data_domainesia[39])), 51, 9)
        ];
        $email = [
            substr(implode('',explode('<td class="center">', $data_domainesia[32])), 54, 9)
        ];
        $addon = [
            intval(substr(implode('',explode('<td class="center">', $data_domainesia[28])), 55, 1))
        ];
        $parked = [
            intval(substr(implode(explode('<td class="center">', $data_domainesia[30])), 56, 1))
        ];
        $sub = [
            substr(implode(explode('<td class="center">', $data_domainesia[29])), 52, 9)
        ];
        $other = [
            "8000/order 2tahun atau 10000/order 1bulan, Server ID SG US & JP"
        ];

        return array ($packet_name, $month_price, $disk_Space, $bandwidth, $database, 
        $email, $addon, $parked, $sub, $other);
    }

    public function rumahhosting($data_curl)
    {
        $data_rumahhosting = explode('<div class="pricing-plan blue wow fadeInUp"', $data_curl[1]);
        $month_price_tiny = explode('<div class="monthprice serverlocal-month">', $data_rumahhosting[1]);
        $feature_data_tiny = explode('<li>', $data_rumahhosting[1]);
        $month_price_small = explode('<div class="monthprice serverlocal-month">', $data_rumahhosting[3]);
        $feature_data_small = explode('<li>', $data_rumahhosting[3]);

        $packet_name = ["Small Hemat", "Large Hemat"];
        $month_price = [
            intval(str_replace('.','',substr(implode('', explode('<span>', $month_price_tiny[1])), 3,5))),
            intval(str_replace('.','',substr(implode('', explode('<span>', $month_price_small[1])), 3,6)))
        ];
        $disk_Space = [
            intval(substr(implode('', explode('</li>', $feature_data_tiny[1])), 0,3)),
            intval(substr(implode('', explode('</li>', $feature_data_small[1])), 0,3))
        ];
        $bandwidth = [
            substr(implode(explode('</li>', $feature_data_tiny[2])), 0, 9),
            substr(implode(explode('</li>', $feature_data_small[2])), 0, 9)
        ];
        $database = [
            intval(substr(implode(explode('</li>', $feature_data_tiny[6])), 0, 2)),
            intval(substr(implode(explode('</li>', $feature_data_small[6])), 0, 2))
        ];
        $email = [
            intval(substr(implode(explode('</li>', $feature_data_tiny[5])), 0,2)),
            intval(substr(implode(explode('</li>', $feature_data_small[5])), 0,2))
        ];
        $addon = [
            intval(substr(implode('', explode('</li>', $feature_data_tiny[3])), 0,1)),
            intval(substr(implode('', explode('</li>', $feature_data_small[3])), 0,1))
        ];
        $parked = [
            -1,
            -1
        ];
        $sub = [
            intval(substr(implode('', explode('</li>', $feature_data_tiny[4])), 0,9)),
            intval(substr(implode('', explode('</li>', $feature_data_small[4])), 0,9))
        ];
        $other = [
            "Server ID",
            "Server ID"
        ];
        return array ($packet_name, $month_price, $disk_Space, $bandwidth, $database, 
        $email, $addon, $parked, $sub, $other);
    }
    public function kuncihost($data_curl)
    {
        $data_kuncihost = explode('<td class="tpk2">', $data_curl[2]);

        $packet_name = [
            "Bintan"
        ];
        $month_price = [
            intval(str_replace('.','',substr(implode('',explode('</td>', $data_kuncihost[16])), 81, 6)))
        ];
        $disk_Space = [
            intval(substr(implode('',explode('</td>', $data_kuncihost[9])), 0, 3))
        ];
        $bandwidth = [
            intval(substr(implode('',explode('</td>', $data_kuncihost[10])), 0, 2))
        ];
        $database = [
            substr(implode('', explode('</td>', $data_kuncihost[12])), 0, 1)
        ];
        $email = [
            -1,
            -1
        ];
        $addon = [
            intval(substr(implode(explode('</td>', $data_kuncihost[11])),0,1))
        ];
        $parked = [
            -1,
            -1
        ];
        $sub = [
            -1,
            -1
        ];
        $other = [
            "Server US"
        ];
        
        return array ($packet_name, $month_price, $disk_Space, $bandwidth, $database, 
        $email, $addon, $parked, $sub, $other);

    }

    public function updatehosting($brand, $hasil_curl)
    {
        
        for ($j=0; $j < count($brand); $j++)
        {
            for ($i=0; $i < count($hasil_curl[$j][0]); $i++) {
                if($hasil_curl[$j][3][$i] == "Unlimited" or $hasil_curl[$j][3][$i] == "Unmetered")
                {
                    $hasil_curl[$j][3][$i] = null;
                };
                if($hasil_curl[$j][4][$i] == "Unlimited" or $hasil_curl[$j][3][$i] == "unlimited")
                {
                    $hasil_curl[$j][4][$i] = null;
                };
                if($hasil_curl[$j][5][$i] == "Unlimited" or $hasil_curl[$j][3][$i] == "unlimited")
                {
                    $hasil_curl[$j][5][$i] = null;
                };
                if($hasil_curl[$j][8][$i] == "Unlimited" or $hasil_curl[$j][3][$i] == "unlimited")
                {
                    $hasil_curl[$j][8][$i] = null;
                };

                $hosting = hosting::where('hostingID', substr($hasil_curl[$j][0][$i], 0, 2) . substr($brand[$j], 0, 3))->first();
                if ($hosting == null){
                    hosting::create([
                        'hostingID' => substr($hasil_curl[$j][0][$i], 0, 2) . substr($brand[$j], 0, 3),
                        'packet_name'   => $hasil_curl[$j][0][$i],
                        'month_price'   => $hasil_curl[$j][1][$i],
                        'disk_space'    => $hasil_curl[$j][2][$i],
                        'bandwidth'     => $hasil_curl[$j][3][$i],
                        'database'      => $hasil_curl[$j][4][$i],
                        'email'         => $hasil_curl[$j][5][$i],
                        'addon_domain'  => $hasil_curl[$j][6][$i],
                        'parked_domain' => $hasil_curl[$j][7][$i],
                        'subdomain'     => $hasil_curl[$j][8][$i],
                        'other'         => $hasil_curl[$j][9][$i],
                        'brand'         => $brand[$j]
                    ]);
                }
                else {
                    if ($hosting->month_price <> $hasil_curl[$j][1][$i]){
                        $hosting->update(['month_price' => $hasil_curl[$j][1][$i]]);
                    }
                    if ($hosting->disk_space <> $hasil_curl[$j][2][$i]) {
                        $hosting->update(['disk_space'    => $hasil_curl[$j][2][$i]]);
                    }
                    if ($hosting->bandwidth <> $hasil_curl[$j][3][$i]){
                        $hosting->update(['bandwidth'     => $hasil_curl[$j][3][$i]]);
                    }
                    if ($hosting->database <> $hasil_curl[$j][4][$i]){
                        $hosting->update(['database'      => $hasil_curl[$j][4][$i]]);
                    }
                    if ($hosting->database <> $hasil_curl[$j][5][$i]){
                        $hosting->update(['email'      => $hasil_curl[$j][5][$i]]);
                    }
                    if ($hosting->database <> $hasil_curl[$j][6][$i]){
                        $hosting->update(['addon_domain'      => $hasil_curl[$j][6][$i]]);
                    }
                    if ($hosting->database <> $hasil_curl[$j][7][$i]){
                        $hosting->update(['parked_domain'      => $hasil_curl[$j][7][$i]]);
                    } 
                    if ($hosting->database <> $hasil_curl[$j][8][$i]){
                        $hosting->update(['subdomain'      => $hasil_curl[$j][8][$i]]);
                    } 
                    if ($hosting->database <> $hasil_curl[$j][9][$i]){
                        $hosting->update(['other'      => $hasil_curl[$j][9][$i]]);
                    }    
                }
            };
        };
    }
}
