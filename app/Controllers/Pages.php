<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PagesModel;
use App\Models\BlogModel;
use App\Models\ProductsModel;
use App\Models\ContentModel;
use App\Models\TemplatesModel;

class Pages extends BaseController {

    protected $moduleurl = 'pages';

    public function index() {
        $data = [];
        $model = new PagesModel();
        $data['data'] = $model->orderBy('id', 'desc')->findAll();

        return view('admin/' . $this->moduleurl . '/manage', $data);
    }

    public function migration() {
        $migrate = service('migrations');
        
        try {
            // Create tables
            $migrate->latest();
        } catch (\Exception $e) {
            
        }
    }

    public function get_templates() {
        $model = new TemplatesModel();
        $data = array();

        foreach ($model->findAll() as $template) {
            $data[$template['id']] = $template['name'];
        }

        return $data;
    }

    public function create() {
        $data['options'] = $this->get_templates();

        return view('admin/' . $this->moduleurl . '/form', $data);
    }

    public function edit($id = null) {
        $data = [];
        $model = new PagesModel();
        $data['data'] = $model->find($id);
        $data['options'] = $this->get_templates();

        return view('admin/' . $this->moduleurl . '/form', $data);
    }

    public function save($id = null) {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name' => 'required|min_length[3]'
            ];

            if ($this->validate($rules)) {
                $data = $this->request->getVar();
                if (is_numeric($id) && $id != 0) {
                    $data['id'] = $id;
                }

                if ($data['template'] == -1) {
                    $data['url'] = '/';
                } else {
                    $data['url'] = url_title($data['name'], '-', TRUE);
                }

                $model = new PagesModel();
                $model->save($data);

                return redirect($this->moduleurl);
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('admin/' . $this->moduleurl . '/form', $data);
    }

    public function delete($id) {
        $data = [];
        $model = new PagesModel();
        $data['data'] = $model->find($id);

        return view('admin/' . $this->moduleurl . '/delete', $data);
    }

    public function delete_sure($id) {
        $model = new PagesModel();
        $data = $model->find($id);

        if (!is_null($data)) {
            $model->delete($id);
            session()->setFlashdata('success', 'Succesvol verwijderd');
        }
        return redirect($this->moduleurl);
    }

    public function load($url = null, $url2 = null, $url3 = null, $url4 = null) {
        $model = new PagesModel();
        $modelProducts = new ProductsModel();
        $modelContent = new ContentModel();
        $modelBlog = new BlogModel();
        $modelTemplate = new TemplatesModel();

        $page = array();

        $page['slugUrl'] = $url;

        // if ($url == 'adminpanel') {
        //     return redirect('pages');
        // }

        $page['merken'] = $modelProducts->select('id, name, url')
                                        ->where('active', 1)
                                        ->where('parent', -1)
                                        ->where('type', 1)
                                        ->findAll();

        $page['merkenNames'] = [];
        foreach($page['merken'] as $row){
            $page['merkenNames'][$row['url']] = $row['name'];
        }

        $soorten = $modelProducts->select('id, name, url, parent')
                                        ->where('active', 1)
                                        ->where('type', 2)
                                        ->findAll();

        $page['menu'] = [];
        foreach($soorten as $item){
            if(!array_key_exists($item['url'], $page['menu'])){
                $page['menu'][$item['url']] = [
                    'name' => $item['name'],
                    'merken' => []
                ];
            }

            $page['menu'][$item['url']]['merken'][] = $item['parent'];
        }

        $page['blogsFooter'] = $modelBlog->orderBy('id', 'desc')->findAll(6);

        if ($url == '') {
            $page['data'] = $model->where('url', '/')->first();

            $page['soorten'] = $modelProducts->where('active', 1)->where('type', 2)->findAll();
        } else if(isset($url2) && isset($modelBlog->where('slug', $url2)->first()['id']) && $url == 'blog'){
            $page['blog'] = $modelBlog->where('slug', $url2)->first();

            $template = 'blog-detail';
        }else if($url == 'blog'){
            $page['blogs'] = $modelBlog->where('cat', -1)->findAll();

            $template = 'blog';
        }else if($url == 'advies'){
            $template = 'advies';
        }else if($url == 'over-ons'){
            $template = 'over-ons';
        }else if($url == 'werkwijze'){
            $template = 'werkwijze';
        }else if($url == 'merkenblog'){
            $page['blogs'] = $modelBlog->where('cat !=', -1)->findAll();

            $page['merkenblog'] = true;

            $template = 'blog';
        }else if($url == 'aanbiedingen'){
            $page['bannerTitle'] = 'Aanbiedingen';
            $page['bannerImg'] = '/webAssets/img/aanbiedingen.png';
            $page['bannerText'] = 'Ben je op zoek naar een prachtige vloer voor een scherpe prijs? Bekijk hier onze actuele aanbiedingen. Je vindt er hoge kwaliteit vloeren, zoals tapijttegels, PVC vloeren, projectvinyl en linoleum, met extra voordeel. Zo combineer je stijl en kwaliteit met een prijs die past bij elk budget.';
            $page['products'] = $modelProducts->where('active', 1)->where('aanbieding', 1)->orderBy('aanbieding_position', 'asc')->findAll();
            
            $template = 'producten_extra';
        }else if($url == 'top-10'){
            $page['bannerTitle'] = 'Top 10';
            $page['bannerImg'] = '/webAssets/img/top10.png';
            $page['bannerText'] = 'Op zoek naar inspiratie voor jouw nieuwe vloer? Wij hebben de 10 populairste vloeren voor je op een rij gezet. Van duurzaam PVC en klassiek laminaat tot warme houten vloeren en stijlvolle tapijttegels, in deze top 10 vind je gegarandeerd een vloer die past bij jouw interieur en wensen.';
            $page['products'] = $modelProducts->where('active', 1)->where('top10', 1)->orderBy('top10_position', 'asc')->findAll();
            
            $template = 'producten_extra';
        }else if($url == 'referenties'){
            if(isset($url2)){
                $page['bannerTitle'] = 'Referenties';
                $page['url'] = $url2;
                
                $template = 'referentie_single';
            }else{
                $page['bannerTitle'] = 'Referenties';
                $page['referenties'] = $modelProducts->where('active', 1)->where('top10', 1)->findAll();
                
                $template = 'referenties';
            }
        } else if(isset($url2) && isset($modelProducts->where('active', 1)->where('kleur_code', $url4)->where('url', $url3)->first()['id'])){
            $parent = $modelProducts->where('active', 1)->where('url', $url2)->first();
            $parent2 = $modelProducts->where('active', 1)->where('url', $url)->where('parent', $parent['id'])->first();

            $page['merk'] = $modelProducts->where('active', 1)->where('url', $url2)->first();

            $page['soort'] = $parent2['name'];

            $page['data'] = $modelProducts->where('active', 1)->where('parent', $parent2['id'])->where('url', $url3)->where('kleur_code', $url4)->first();
            
            $page['group'] = $modelProducts->where('active', 1)->where('groep', $page['data']['groep'])->findAll();
            
            $page['parents'] = [];
            foreach($modelProducts->where('active', 1)->where('type', 2)->findAll() as $soort){
                $parents[] = $soort['id'];
                $page['parents'][$soort['id']] = ['url' => $soort['url'], 'parent' => $modelProducts->find($soort['parent'])['url']];
            }
            
            $page['gerelateerd1'] = ((!empty($page['data']['gerelateerd1'])) ? $modelProducts->where('active', 1)->find($page['data']['gerelateerd1']) : '');
            $page['gerelateerd2'] = ((!empty($page['data']['gerelateerd2'])) ? $modelProducts->where('active', 1)->find($page['data']['gerelateerd2']) : '');
            $page['gerelateerd3'] = ((!empty($page['data']['gerelateerd3'])) ? $modelProducts->where('active', 1)->find($page['data']['gerelateerd3']) : '');
            $page['gerelateerd4'] = ((!empty($page['data']['gerelateerd4'])) ? $modelProducts->where('active', 1)->find($page['data']['gerelateerd4']) : '');

            $template = 'product';
        } else if (isset($modelProducts->where('active', 1)->where('url', $url)->first()['id'])) {
            $page['soort'] = $modelProducts->where('active', 1)->where('url', $url)->first();
            $page['merk'] = $modelProducts->where('active', 1)->where('url', $url2)->first();
    
            $parents = [];
            $page['parents'] = [];
    
            foreach ($modelProducts->where('active', 1)->where('type', 2)->where('url', $url)->where('parent', $page['merk']['id'])->findAll() as $soort) {
                $parents[] = $soort['id'];
                $page['parents'][$soort['id']] = ['url' => $soort['url'], 'parent' => $modelProducts->where('active', 1)->find($soort['parent'])['url']];
            }
    
            $page['soorten'] = $modelProducts->where('active', 1)->where('type', 2)->where('parent', $page['merk']['id'])->findAll();
    
            $page['prods'] = [];
    
            if (!empty($parents)) {
                // Paginering configuratie
                $perPage = 9;
                $pageNumber = 1; // Standaard paginanummer
                if (isset($url3) && $url3 === 'page' && isset($url4) && is_numeric($url4)) {
                    $pageNumber = (int) $url4;
                }
                $currentPage = $pageNumber;
                $offset = ($currentPage - 1) * $perPage;
    
                // Producten ophalen en sorteren
                $allProducts = $modelProducts->where('active', 1)->where('type', 3)->whereIn('parent', $parents)->orderBy('name', 'asc')->findAll();
    
                // Unieke groepen ophalen
                $uniqueGroups = [];
                foreach ($allProducts as $product) {
                    if (!in_array($product['groep'], $uniqueGroups)) {
                        $uniqueGroups[] = $product['groep'];
                    }
                }
    
                // Paginering toepassen op unieke groepen
                $paginatedGroups = array_slice($uniqueGroups, $offset, $perPage);
    
                // Totaal aantal unieke groepen
                $totalUniqueGroups = count($uniqueGroups);
    
                // Producten ophalen per groep
                $products = [];
                foreach ($paginatedGroups as $group) {
                    $groupProducts = $modelProducts->where('active', 1)->where('groep', $group)->findAll();
                    $products = array_merge($products, $groupProducts);
                }
    
                // Producten groeperen (optioneel)
                foreach ($products as $product) {
                    if (!array_key_exists($product['groep'], $page['prods'])) {
                        $page['prods'][$product['groep']] = [$product];
                    } else {
                        $page['prods'][$product['groep']][] = $product;
                    }
                }
    
                // Paginering links genereren
                $pager = \Config\Services::pager();
                $page['pager'] = $pager->makeLinks($currentPage, $perPage, $totalUniqueGroups, 'custom_pager');
    
                $template = 'producten';
            }
        } else {
            $page['data'] = $model->where('url', $url)->first();
        }

        $page['content'] = [];

        if (isset($page['data']['id'])) {
            foreach ($modelContent->where('page_id', $page['data']['id'])->findAll() as $content) {
                if ($content['content'] == '') {
                    $page['content'][$content['name']] = $content['afbeelding'];
                } else if ($content['afbeelding'] == '') {
                    $page['content'][$content['name']] = $content['content'];
                }
            }
        }

        if (!isset($template)) {
            if(isset($page['data']['template'])){
                $template = $modelTemplate->find($page['data']['template'])['name'];
            }else{
                echo 'test';
                exit();
            }
        }

        return view('public/' . strtolower($template), $page);
    }

    public function sendContact() {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name' => ['label' => 'Naam', 'rules' => 'required'],
                'email' => ['label' => 'E-mailadres', 'rules' => 'required'],
                'message' => ['label' => 'Bericht', 'rules' => 'required']
            ];

            if ($this->validate($rules)) {
                $data = $this->request->getVar();

                $to = 'eric@mpci.nl';
                $subject = 'Contactformulier via ' . env('logo') . '!';
                $message = '
                            Beste Eric,'
                        . '<br/>
                            <br/>
                            Het contactformulier is ingevuld, hieronder de gegevens:.<br/>
                            <br/>
                            <b>Naam: </b>' . $data['name'] . '<br/>
                            <b>E-mail: </b>' . $data['email'] . '<br/>
                            <b>Bericht: </b><br/>
                            ' . $data['message'] . '
                            <br/>
                            <br/>
                            Met vriendelijke groet,<br/>
                            <br/>
                            ' . env('logo') . '
                        ';
                $headers = 'From: ' . $data['email'] . "\r\n" .
                        'Reply-To: ' . $data['email'] . "\r\n" .
                        'MIME-Version: 1.0' . "\r\n" .
                        'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);

                session()->setFlashdata('success', 'Je bericht is succesvol verstuurd!');
            } else {
                $data['validation'] = $this->validator;
            }

            return view('public/contact', $data);
        }
    }

    public function uitleg() {
        return view('admin/pages/uitleg');
    }

    public function getLog()
    {
        // Specificeer het pad naar het logbestand
        $logPath = WRITEPATH . 'logs/log-' . date('Y-m-d') . '.log';

        $entries = [];  // Array om de gescheiden log entries op te slaan
        $currentEntry = [];  // Tijdelijke buffer voor de huidige log entry

        if (file_exists($logPath)) {
            // Haal de inhoud van het logbestand op als een array van regels
            $logContent = file($logPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($logContent as $line) {
                // Controleer of de regel begint met een logtype (bijvoorbeeld 'ERROR', 'CRITICAL', 'DEBUG')
                if (preg_match('/^(ERROR|CRITICAL|DEBUG|INFO|NOTICE|WARNING)/', $line)) {
                    // Als er al een entry in de buffer staat, voeg deze dan toe aan de lijst
                    if (!empty($currentEntry)) {
                        $entries[] = implode("\n", $currentEntry);
                        $currentEntry = [];  // Reset de buffer voor de volgende entry
                    }
                }
                // Voeg de huidige regel toe aan de entry-buffer
                $currentEntry[] = $line;
            }

            // Voeg de laatste entry toe als deze nog niet is toegevoegd
            if (!empty($currentEntry)) {
                $entries[] = implode("\n", $currentEntry);
            }

            // Keer de volgorde van de entries om zodat de nieuwste bovenaan staat
            $entries = array_reverse($entries);

            // Maak een nette weergave met scheidingslijnen
            $data['logContent'] = implode("\n\n----------------------------------------\n\n", $entries);
        } else {
            $data['logContent'] = 'Geen logs gevonden voor vandaag.';
        }

        // Laad de view en geef de data door
        return view('admin/pages/logviewer', $data);
    }
}
