<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Illuminate\Support\Facades\Redis;

class InformasiDesaController extends Controller
{
    public function index() 
    {
        $client = new Client();
        $token = Session::get('api-token');

        $response1 = $client->request('GET', env("API_BASE_URL", "http://localhost:8001") . "/api/berita?pub=1");
        $response2 = $client->request('GET', env("API_BASE_URL", "http://localhost:8001") . "/api/pengumuman?pub=1");
        $response3 = $client->request('GET', env("API_BASE_URL", "http://localhost:8001") . "/api/berita?pub=0");
        $response4 = $client->request('GET', env("API_BASE_URL", "http://localhost:8001") . "/api/pengumuman?pub=0");
        $response5 = $client->request('GET', env("API_BASE_URL", "http://localhost:8001") . "/api/aspirasi", [
            'headers' => [
                'Authorization' => 'Bearer '.$token
            ],
        ]);

        $berita = json_decode($response1->getBody());
        $pengumuman = json_decode($response2->getBody());
        $beritaReq = json_decode($response3->getBody());
        $pengumumanReq = json_decode($response4->getBody());
        $aspirasi = json_decode($response5->getBody());

        return view('adminInformasi', [
            "berita" => $berita,
            "pengumuman" => $pengumuman,
            "beritaReq" => $beritaReq,
            "pengumumanReq" => $pengumumanReq,
            "aspirasi" => $aspirasi
        ]);
    }

    public function tambahBerita(Request $request)
    {
        try {
            $client = new Client();
            $token = Session::get('api-token');

            $image = $request->file('foto');
            if (empty($image)) {
                $guzzleRequest = new GuzzleRequest('GET', env("API_BASE_URL", "http://localhost:8001") . "/api/berita");
                $guzzleResponse = new GuzzleResponse(400, [], json_encode(['message' => 'Foto harus diisi!']));

                throw new BadResponseException('Foto harus diisi!', $guzzleRequest, $guzzleResponse);
            }
            
            $response = $client->request('POST', env("API_BASE_URL", "http://localhost:8001") . "/api/berita", [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
                ],
                'multipart' => [
                    [
                        'name' => 'nama',
                        'contents' => $request->nama
                    ],
                    [
                        'name' => 'judul',
                        'contents' => $request->judul
                    ],
                    [
                        'name' => 'isi',
                        'contents' => $request->isi
                    ],
                    [
                        'name' => 'foto',
                        'contents' => fopen($image->getPathname(), 'r'),
                        'filename' => $image->getClientOriginalName(),
                    ],
                ]
            ]);

            $responseBody = json_decode($response->getBody());
            return redirect()->back()->with('success', $responseBody->message);

        } catch (BadResponseException $e){
            $response = $e->getResponse();
            $result = json_decode($response->getBody());

            return redirect()->back()->withErrors($result->message)->withInput($request->all());
        }
    }

    public function tambahPengumuman(Request $request)
    {
        try {
            $client = new Client();
            $token = Session::get('api-token');
            
            $response = $client->request('POST', env("API_BASE_URL", "http://localhost:8001") . "/api/pengumuman", [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
                ],
                'multipart' => [
                    [
                        'name' => 'nama',
                        'contents' => $request->nama
                    ],
                    [
                        'name' => 'judul',
                        'contents' => $request->judul
                    ],
                    [
                        'name' => 'isi',
                        'contents' => $request->isi
                    ]
                ]
            ]);

            $responseBody = json_decode($response->getBody());
            return redirect()->back()->with('success', $responseBody->message);

        } catch (BadResponseException $e){
            $response = $e->getResponse();
            $result = json_decode($response->getBody());

            return redirect()->back()->withErrors($result->message)->withInput($request->all());
        }
    }

    public function updateBerita(Request $request)
    {
        try {
            $client = new Client();
            $token = Session::get('api-token');

            $image = $request->file('foto');
            if (!empty($image)) {
                $multipart = [
                    [
                        'name' => 'nama',
                        'contents' => $request->nama
                    ],
                    [
                        'name' => 'isAccepted',
                        'contents' => $request->isAccepted
                    ],
                    [
                        'name' => 'judul',
                        'contents' => $request->judul
                    ],
                    [
                        'name' => 'isi',
                        'contents' => $request->isi
                    ],
                    [
                        'name' => 'foto',
                        'contents' => fopen($image->getPathname(), 'r'),
                        'filename' => $image->getClientOriginalName(),
                    ],
                ];
            } else {
                $multipart = [
                    [
                        'name' => 'nama',
                        'contents' => $request->nama
                    ],
                    [
                        'name' => 'isAccepted',
                        'contents' => $request->isAccepted
                    ],
                    [
                        'name' => 'judul',
                        'contents' => $request->judul
                    ],
                    [
                        'name' => 'isi',
                        'contents' => $request->isi
                    ],
                ];
            }
            
            $response = $client->request('POST', env("API_BASE_URL", "http://localhost:8001") . "/api/berita/$request->id?_method=PUT", [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
                ],
                'multipart' => $multipart
            ]);

            $responseBody = json_decode($response->getBody());
            return redirect()->back()->with('success', $responseBody->message);

        } catch (BadResponseException $e){
            $response = $e->getResponse();
            $result = json_decode($response->getBody());

            return redirect()->back()->withErrors($result->message)->withInput($request->all());
        }
    }

    public function updatePengumuman(Request $request)
    {
        try {
            $client = new Client();
            $token = Session::get('api-token');
            
            $response = $client->request('POST', env("API_BASE_URL", "http://localhost:8001") . "/api/pengumuman/$request->id?_method=PUT", [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
                ],
                'multipart' => [
                    [
                        'name' => 'nama',
                        'contents' => $request->nama
                    ],
                    [
                        'name' => 'isAccepted',
                        'contents' => $request->isAccepted
                    ],
                    [
                        'name' => 'judul',
                        'contents' => $request->judul
                    ],
                    [
                        'name' => 'isi',
                        'contents' => $request->isi
                    ]
                ]
            ]);

            $responseBody = json_decode($response->getBody());
            return redirect()->back()->with('success', $responseBody->message);

        } catch (BadResponseException $e){
            $response = $e->getResponse();
            $result = json_decode($response->getBody());

            return redirect()->back()->withErrors($result->message)->withInput($request->all());
        }
    }

    public function acceptBerita(Request $request, $id)
    {
        try {
            $client = new Client();
            $token = Session::get('api-token');

            $response = $client->request('PUT', env("API_BASE_URL", "http://localhost:8001") . "/api/berita/$id/ceklis", [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
                ],
                'json' => ['isAccepted' => intval($request->isAccepted)]
            ]);

            $responseBody = json_decode($response->getBody());
            return redirect()->back()->with('success', $responseBody->message);

        } catch (BadResponseException $e){
            $response = $e->getResponse();
            $result = json_decode($response->getBody());

            return redirect()->back()->withErrors($result->message)->withInput($request->all());
        }
    }

    public function acceptPengumuman(Request $request, $id)
    {
        try {
            $client = new Client();
            $token = Session::get('api-token');

            $response = $client->request('PUT', env("API_BASE_URL", "http://localhost:8001") . "/api/pengumuman/$id/ceklis", [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
                ],
                'json' => ['isAccepted' => intval($request->isAccepted)]
            ]);

            $responseBody = json_decode($response->getBody());
            return redirect()->back()->with('success', $responseBody->message);

        } catch (BadResponseException $e){
            $response = $e->getResponse();
            $result = json_decode($response->getBody());

            return redirect()->back()->withErrors($result->message)->withInput($request->all());
        }
    }
}
