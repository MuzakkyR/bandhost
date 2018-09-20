<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\domain;

class DomainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ekstensi = input::get('ekstensi');
        $company = input::get('company');

        if ($ekstensi == null && $company == null)
        {
            $fildom = domain::paginate(6);
        }
        else if ($ekstensi != null && $company == null)
        {     
            $fildom = domain::where('domain_name', $ekstensi)
                ->orderBy('register_price', 'desc')
                ->paginate(5);
        }
        else if ($ekstensi == null && $company != null)
        {
            $fildom = domain::whereIn('brand', $company)
                ->paginate(5);
        }
        else
        {
            $fildom = domain::where('domain_name', $ekstensi)
                            ->whereIn('brand', $company)
                            ->paginate(4);
            
        }
        
        $fileks = domain::OrderBy('domain_name')->pluck('domain_name');
        $filcom = domain::OrderBy('brand')->pluck('brand');
        return view('/after/domain', ['fildom' => $fildom, 'fileks' => $fileks, 'filcom' => $filcom]);
    }


    public function refresh()
    {
        $domain = ['com','net','org'];
        $url = [
            'https://www.domainesia.com/harga-domain/',
            'https://www.jagoanhosting.com/domain-murah/',
            'https://idcloudhost.com/en/domain-murah-indonesia/'
        ];
        $brand = ['domainesia','jagoanhosting','idcloudhost'];
        $data_curl = [
            $domainesia = $this->curl($url[0]),
            $jagoanhosting = $this->curl($url[1]),
            $idcloudhost = $this->curl($url[2])
        ];
        $hasil_curl = [
            $dom = $this->domainesia($data_curl),
            $jag = $this->jagoanhosting($data_curl),
            $idc = $this->idcloudhost($data_curl)
        ];

        $update_domain = $this->updatedomain($domain, $brand, $hasil_curl);

        return redirect()->action('DomainController@index');
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
        $data_domainesia = explode('<td class="td18">', $data_curl[0]);

        $register_price = [
            $register_price_com = intval(str_replace('.', '',substr(implode('', explode('<td>', $data_domainesia[2])),207,7))),
            $register_price_net = intval(str_replace('.','',substr(implode('', explode('<td>', $data_domainesia[5])), 31, 7))),
            $register_price_org = intval(str_replace('.','',substr(implode('', explode('<td>', $data_domainesia[8])), 207, 7)))            
        ];

        $transfer_price = [
            $transfer_price_com = intval(str_replace('.', '',substr(implode('', explode('<td>', $data_domainesia[2])),286,7))),
            $transfer_price_net = intval(str_replace('.','',substr(implode('', explode('<td>', $data_domainesia[5])), 111,7))),
            $transfer_price_org = intval(str_replace('.','',substr(implode('', explode('<td>', $data_domainesia[8])), 286,7)))
        ];
        $renewal_price = [
            $renewal_price_com = intval(str_replace('.', '',substr(implode('', explode('<td>', $data_domainesia[3])),17,7))),
            $renewal_price_net = intval(str_replace('.','',substr(implode('', explode('<td>', $data_domainesia[6])), 17,7))),
            $renewal_price_org = intval(str_replace('.','',substr(implode('', explode('<td>', $data_domainesia[9])), 17,7)))
        ];

            return array ($register_price, $transfer_price, $renewal_price);
    }

    public function jagoanhosting($data_curl)
    {
        $data_jagoanhosting = explode("</td>", $data_curl[1]);
        
        $register_price = [
            $register_price_com = intval(str_replace('.','',substr(implode(' ',explode('rp', $data_jagoanhosting[1])),34,7))),
            $register_price_net = intval(str_replace('.','',substr(implode(' ',explode('rp', $data_jagoanhosting[6])),37,7))),
            $register_price_org = intval(str_replace('.','',substr(implode(' ',explode('rp', $data_jagoanhosting[11])),37,7)))
        ];

        $transfer_price = [
            $transfer_price_com = intval(str_replace('.','',substr(implode(' ', explode('Rp', $data_jagoanhosting[2])),32,7))),            
            $transfer_price_net = intval(str_replace('.','',substr(implode(' ', explode('Rp', $data_jagoanhosting[7])),32,7))),
            $transfer_price_org = intval(str_replace('.','',substr(implode(' ', explode('Rp', $data_jagoanhosting[12])),32,7)))
        ];
        
        $renewal_price = [
            $renewal_price_com = intval(str_replace('.','',substr(implode(' ', explode('Rp', $data_jagoanhosting[3])),32,7))),
            $renewal_price_net = intval(str_replace('.','',substr(implode(' ', explode('Rp', $data_jagoanhosting[8])),32,7))),
            $renewal_price_org = intval(str_replace('.','',substr(implode(' ', explode('Rp', $data_jagoanhosting[13])),32,7)))
        ];
        return array ($register_price, $transfer_price, $renewal_price);
    }

    public function idcloudhost($data_curl)
    {
        $data_idcloudhost = explode("</tr>", $data_curl[2]);
        
        $register_price = [
            $register_price_com = intval(str_replace('.','',substr(implode(' ',explode("Rp. ", $data_idcloudhost[1])),184,7))),
            $register_price_net = intval(str_replace('.','',substr(implode(' ',explode("Rp. ", $data_idcloudhost[2])),176,7))),
            $register_price_org = intval(str_replace('.','',substr(implode(' ',explode("Rp. ", $data_idcloudhost[5])),176,7)))
        ];

        $transfer_price = [
            $transfer_price_com = intval(str_replace('.','',substr(implode(' ',explode("Rp. ", $data_idcloudhost[1])),244,7))),
            $transfer_price_net = intval(str_replace('.','',substr(implode(' ',explode("Rp. ", $data_idcloudhost[2])),236,7))),
            $transfer_price_org = intval(str_replace('.','',substr(implode(' ',explode("Rp. ", $data_idcloudhost[5])),236,7)))
        ];

        $renewal_price = [
            $renewal_price_com = intval(str_replace('.','',substr(implode(' ',explode("Rp. ", $data_idcloudhost[1])),303,7))),
            $renewal_price_net = intval(str_replace('.','',substr(implode(' ',explode("Rp. ", $data_idcloudhost[2])),295,7))),
            $renewal_price_org = intval(str_replace('.','',substr(implode(' ',explode("Rp. ", $data_idcloudhost[5])),295,7)))
        ];

        return array ($register_price, $transfer_price, $renewal_price);

    }
    public function storedomain($domain, $brand, $hasil_curl)
    {
        for ($j=0; $j < count($brand); $j++)
        {
            for ($i=0; $i < count($domain); $i++) 
            { 
                domain::create([
                    'domainID' => substr($domain[$i], 0, 3) . substr($brand[$j], 1,2),
                    'domain_name' => $domain[$i],
                    'register_price' => $hasil_curl[$j][0][$i],
                    'transfer_price' => $hasil_curl[$j][1][$i],
                    'renewal_price' => $hasil_curl[$j][2][$i],
                    'brand' => $brand[$j]
                ]);   
            }
        }
        
    }
    public function updatedomain($domain, $brand, $hasil_curl)
    {
        for ($j=0; $j < count($brand); $j++)
        {
            for ($i=0; $i < count($domain); $i++) 
            { 
                $update_domain = domain::where('domainID', substr($domain[$i], 0, 3) . substr($brand[$j], 1,2))->first();
                if ($update_domain == null){
                    domain::create([
                        'domainID' => substr($domain[$i], 0, 3) . substr($brand[$j], 1,2),
                        'domain_name' => $domain[$i],
                        'register_price' => $hasil_curl[$j][0][$i],
                        'transfer_price' => $hasil_curl[$j][1][$i],
                        'renewal_price' => $hasil_curl[$j][2][$i],
                        'brand' => $brand[$j]
                    ]); 
                }
                else {
                    if ($update_domain->register_price <> $hasil_curl[$j][0][$i]){
                        $update_domain->update(['register_price' => $hasil_curl[$j][0][$i]]);
                    }
                    if ($update_domain->transfer_price <> $hasil_curl[$j][1][$i]){
                        $update_domain->update(['transfer_price' => $hasil_curl[$j][1][$i]]);
                    }
                    if ($update_domain->renewal_price <> $hasil_curl[$j][2][$i]){
                        $update_domain->update(['renewal_price' => $hasil_curl[$j][2][$i]]);
                    }
                }
            };
        };
    }
}