<?php



namespace App\Controllers;



use App\Controllers\BaseController;

use Config\Services;

use App\Models\ProductsModel;

use App\Models\PagesModel;

use PDO;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\IOFactory;

use PHPUnit\Event\Test\PrintedUnexpectedOutput;



class Products extends BaseController

{

    protected $moduleurl = 'products';



    public function index()

    {

        return view('admin/' . $this->moduleurl . '/manage');

    }



    public function productsSub($id = null, $prods = null)

    {

        $data = [];

        $data['sub'] = true;

        $data['id'] = $id;

        $data['prods'] = $prods;



        return view('admin/' . $this->moduleurl . '/manage', $data);

    }

    

    public function getProduct(){

        // Response voorbereiden

        $response = [

            'success' => false,

            'message' => '',

            'product' => null

        ];

        

        // Request valideren

        $request = $this->request;

        

        if ($request->isAJAX()) {

            $productId = $request->getPost('id');

            

            if (!empty($productId)) {

                // Product model laden

                $model = new ProductsModel();

                

                // Product ophalen

                $product = $model->find($productId);

                

                if ($product) {

                    // Succes response

                    $response['success'] = true;

                    

                    $html = '

                        <h2 class="teppetekal-area-title text-center fw-bold">'.$product['name'].'</h2>

                        <div class="tappetekal-wrapper montage-wrapper">

                            <div class="row">

                                <div class="col-md-6 col-lg-3">

                                    <div class="teppetekal-blk woodstone position-relative h-100 p-0">

                                        <img src="'.((file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $product['afbeelding'])) ? $product['afbeelding'] : '/uploads/'.$product['afbeelding'] ).'" alt="woodstone thumb" class="w-100">

                                        <h3 class="mb-0 fw-bold text-white text-center w-100 position-absolute bottom-0 start-0 z-1">'.$product['name'].'</h3>

                                    </div>

                                </div>

                                <div class="col-md-6 col-lg-3">

                                    <div class="teppetekal-blk trodon-line d-flex flex-column justify-content-center h-100">

                                        <h3 class="fw-bold">'.$product['name'].'</h3>

                                        <p class="mb-0">'.$product['voorraad'].'m² op voorraad</p>

                                        <h4 class="fw-bold mb-0">€ '.$product['leveren500'].' per m²</h4>

                                    </div>

                                </div>

                                <div class="col-md-6 col-lg-3">

                                    <div class="teppetekal-blk montage h-100 d-flex flex-column justify-content-center">

                                        <h3 class="fw-bold text-white">Offerte excl montage</h3>

                                        <div class="montage-input d-flex align-items-center">

                                            <input id="m2Excl" type="text" placeholder="Vul hier het aantal m2 in" class="sync-input text-white border border-white w-100 bg-transparent fw-light">

                                            <span class="text-white">M2</span>

                                        </div>

                                        <div class="montage-input d-flex align-items-center">

                                            <input id="priceExcl" type="text" placeholder="€'.$product['leveren500'].'" class="text-white border border-white w-100 bg-transparent fw-light" readonly>

                                            <span class="text-white">Prijs</span>

                                        </div>

                                        <div class="montage-input d-flex align-items-center mb-0">

                                            <input id="totalExcl" title="total" type="text" class="text-white border border-white w-100 bg-transparent fw-light" readonly>

                                            <span class="text-white">Totaal</span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-6 col-lg-3">

                                    <div class="teppetekal-blk montage incl-montage h-100 d-flex flex-column justify-content-center w-100 gray-bg">

                                        <h3 class="fw-bold text-white">Offerte incl montage</h3>

                                        <div class="montage-input d-flex align-items-center">

                                            <input id="m2Incl" type="text" placeholder="Vul hier het aantal m2 in" class="sync-input text-white border border-white w-100 bg-transparent fw-light">

                                            <span class="text-white">M2</span>

                                        </div>

                                        <div class="montage-input d-flex align-items-center">

                                            <input id="priceIncl" type="text" placeholder="€'.$product['aanbrengen500'].'" class="text-white border border-white w-100 bg-transparent fw-light" readonly>

                                            <span class="text-white">Prijs</span>

                                        </div>

                                        <div class="montage-input d-flex align-items-center mb-0">

                                            <input id="totalIncl" title="total" type="text" class="text-white border border-white w-100 bg-transparent fw-light" readonly>

                                            <span class="text-white">Totaal</span>

                                        </div>

                                    </div>

                                </div>   



                                <div class="offset-8 col-4">

                                    <i>* Bovengenoemde prijzen is exclusief btw.</i><br/>

                                    <i>* Prijzen zijn gebaseerd op benodigde aantal m².</i>



                                    <a href="#" class="btn btn1 col-4" data-bs-toggle="modal" data-bs-target="#offerteModal">Offerte mailen</a>                            

                                </div>

                            </div>

                        </div>



                        <div class="modal fade" id="offerteModal" tabindex="-1" aria-labelledby="offerteModalLabel" aria-hidden="true">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="offerteModalLabel">Offerte Aanvragen</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                    </div>

                                    <div class="modal-body">

                                        <form action="'.route_to('sendOfferte').'" method="POST">



                                            <div class="mb-3">

                                                <label for="naam" class="form-label">Naam</label>

                                                <input type="text" name="naam" class="form-control" value="'.(session('offerteName') ?? '').'" required>

                                            </div>



                                            <div class="mb-3">

                                                <label for="email" class="form-label">E-mailadres</label>

                                                <input type="email" name="email" class="form-control" value="'.(session('offerteMail') ?? '').'" required>

                                            </div>



                                            <!-- Verborgen velden met jQuery ingevulde prijzen -->

                                            <input type="hidden" name="m2Excl" id="hiddenM2Excl">

                                            <input type="hidden" name="priceExcl" id="hiddenPriceExcl">

                                            <input type="hidden" name="totalPriceExcl" id="hiddenTotalPriceExcl">

                                            <input type="hidden" name="m2Incl" id="hiddenM2Incl">

                                            <input type="hidden" name="priceIncl" id="hiddenPriceIncl">

                                            <input type="hidden" name="totalPriceIncl" id="hiddenTotalPriceIncl">



                                            <input type="hidden" name="product" value="'.htmlspecialchars($product['name'].' '.$product['kleur_code']).'">



                                            <button type="submit" class="btn btn1">Offerte Versturen</button>



                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    ';

                    

                    $response['product_html'] = $html;

                } else {

                    $response['message'] = 'Product niet gevonden';

                }

            } else {

                $response['message'] = 'Geen product ID opgegeven';

            }

        } else {

            $response['message'] = 'Alleen AJAX verzoeken zijn toegestaan';

        }

        

        // JSON response terugsturen

        return $this->response->setJSON($response);

    }



    public function resizePics()

    {

        $model = new ProductsModel();



        // Alleen producten die nog niet geresized zijn, max 10

        $producten = $model->where('imgresize', 0)->orderBy('RAND()')->findAll(1);



        // De velden die je wilt resizen

        $imageFields = [

            'afbeelding',

            'sfeerfoto1',

            'sfeerfoto2',

            'sfeerfoto3',

            'sfeerfoto4',

            'collectiefoto'

        ];



        foreach ($producten as $product) {

            $id = $product['id']; // Zorg dat dit je primaire sleutel is

            $resizedSomething = false;



            foreach ($imageFields as $field) {

                $filename = $product[$field] ?? null;



                if (!$filename) continue;



                $filepath = FCPATH . 'uploads/' . $filename;



                if (is_file($filepath)) {

                    try {

                        \Config\Services::image()

                            ->withFile($filepath)

                            ->resize(1300, 1100, true, 'height')

                            ->save($filepath);



                        echo "✔️ Geresized: {$filename}<br>";

                    } catch (\Exception $e) {

                        echo "❌ Fout bij {$filename}: " . $e->getMessage() . "<br>";

                    }

                } else {

                    echo "⚠️ Bestand niet gevonden: {$filename}<br>";

                }

            }



            $model->update($id, ['imgresize' => 1]);

        }

        

        echo '<meta http-equiv="refresh" content="30">';

    }



    public function search(){

        $model = new ProductsModel();



        $slugUrl = 'search';



        $search = $_POST['q'];



        $soorten = $model->select('id, name, url, parent')

                        ->where('active', 1)

                        ->where('type', 2)

                        ->findAll();



        $merken = $model->select('id, name, url')

                        ->where('parent', -1)

                        ->where('active', 1)

                        ->where('type', 1)

                        ->findAll();



        $menu = [];

        foreach($soorten as $item){

            if(!array_key_exists($item['url'], $menu)){

                $menu[$item['url']] = [

                    'name' => $item['name'],

                    'merken' => []

                ];

            }



            $menu[$item['url']]['merken'][] = $item['parent'];

        }



        $results = [];



        $searchTerms = ['name', 'samenvatting', 'omschrijving', 'duurzaam', 'kleur', 'kleurnaam', 'kleur_code', 'toepassing', 'dessins', 'gebruik', 'klasse', 'textuur', 'groep', 'extracontent1', 'extracontent2', 'formaat', 'afmeting', 'bel_eigenschap', 'tot_gewicht', 'pool_gewicht', 'cradle', 'poolmateriaal', 'afmeting_rol', 'label', 'collection', 'bestel_eenheid', 'min_bestel', 'extracontent3', 'opt_afmeting', 'tot_dikte', 'soort_toplaag', 'dikte_toplaag', 'slipweerstand', 'geluidiso', 'vloerverwarming', 'weerstand', 'type_geen']; // Vul deze array met je zoektermen



        $query = $model->where('type', 3)->where('active', 1);

        $query->groupStart(); // Groepeer LIKE statements

        foreach ($searchTerms as $term) {

            $query->orLike($term, $search);

        }

        $query->groupEnd();



        $products = $query->findAll();



        foreach ($products as $product) {

            if(isset($product['parent'])){

                $parent = $model->where('active', 1)->where('type', 2)->where('id', $product['parent'])->first();



                if(!isset($parent['parent'])){

                    continue;

                }else{

                    $merk = $model->where('active', 1)->where('type', 1)->where('id', $parent['parent'])->first();

                }

                // Voeg de extra gegevens toe aan het product

                $product['merk'] = $merk['url'] ?? null;

                $product['parent'] = $parent['url'] ?? null;



                // Voeg het product toe aan de groep

                $results[$product['groep']][] = $product;

            }

        }



        return view('public/search', ['results' => $results, 'search' => $search, 'menu' => $menu, 'merken' => $merken, 'slugUrl' => $slugUrl]);

    }



    public function getProds()

    {

        $model = new ProductsModel();

        $count = 0;



        // foreach($model->where('parent', -1)->findAll() as $item){

        //     $count = $count + 1;



        //     $data[$item['id']] = $item;



        //     foreach($model->where('parent', $item['id'])->findAll() as $child){

        //         $count = $count + 1;



        //         $data[$child['parent']]['childs'][$child['id']] = $child;



        //         foreach($model->where('parent', $child['id'])->like('name', $_POST['search']['value'])->findAll($_POST['length'], $_POST['start']) as $childchild){

        //             $count = $count + 1;



        //             $data[$child['parent']]['childs'][$child['id']]['childs'][$childchild['id']] = $childchild;

        //         }

        //     }

        // }



        // foreach ($data as $page) {

        //     $dataJson = [];



        //     $dataJson[] = [

        //             $page['name'],

        //             '<a href="'.route_to('editProduct', $page['id']).'">Bewerken</a></td>',

        //             '<a href="'.route_to('deleteProduct', $page['id']).'">Verwijderen</a></td>'

        //     ];



        //     if(isset($page['childs'])){

        //         foreach($page['childs'] as $child){

        //             $dataJson[] = [

        //                 '<span class="pl-2">'.$child['name'].'</span>',

        //                 '<a href="'.route_to('editProduct', $child['id']).'">Bewerken</a></td>',

        //                 '<a href="'.route_to('deleteProduct', $child['id']).'">Verwijderen</a></td>'

        //             ];



        //             if(isset($child['childs'])){

        //                 foreach($child['childs'] as $childchild){

        //                     $dataJson[] = [

        //                         '<span class="pl-4">'.$childchild['name'].'</span>',

        //                         '<a href="'.route_to('editProduct', $childchild['id']).'">Bewerken</a></td>',

        //                         '<a href="'.route_to('deleteProduct', $childchild['id']).'">Verwijderen</a></td>'

        //                     ];

        //                 }

        //             }

        //         }

        //     }

        // }



        $ids = [];



        foreach ($model->where('parent', -1)->findAll() as $parent) {

            $ids[] = $parent['id'];



            foreach ($model->where('parent', $parent['id'])->findAll() as $parentChild) {

                $ids[] = $parentChild['id'];

            }

        }



        foreach ($model->whereNotIn('id', $ids)->like('name', $_POST['search']['value'])->orLike('groep', $_POST['search']['value'])->orderBy('id', 'desc')->findAll($_POST['length'], $_POST['start']) as $childchild) {

            $data[] = $childchild;

        }



        $count = $model->whereNotIn('id', $ids)->like('name', $_POST['search']['value'])->orLike('groep', $_POST['search']['value'])->orderBy('id', 'desc')->countAllResults();



        foreach ($data as $item) {

            $dataJson[] = [

                '<span class="pl-4">' . $item['name'] . ' - ' . $item['kleur_code'] . '</span>',

                '<a href="' . route_to('copyProduct', $item['id']) . '">Copy</a></td>',

                '<a href="' . route_to('editProduct', $item['id']) . '">Bewerken</a></td>',

                '<a href="' . route_to('deleteProduct', $item['id']) . '">Verwijderen</a></td>'

            ];

        }



        $data = [

            'draw'            => $_POST['draw'],

            'recordsTotal'    => $count,

            'recordsFiltered' => $count,

            'data'            => $dataJson

        ];



        echo json_encode($data, JSON_UNESCAPED_SLASHES);

    }



    public function getMerken()

    {

        $model = new ProductsModel();

        $count = 0;



        if(isset($_POST['prods'])){

            $count = $model->like('name', $_POST['search']['value'])->where('type', 3)->where('parent', $_POST['prods'])->countAllResults();

            $query = $model->like('name', $_POST['search']['value'])->where('type', 3)->where('parent', $_POST['prods'])->findAll();

        }else if(isset($_POST['id'])){

            $count = $model->like('name', $_POST['search']['value'])->where('type', 2)->where('parent', $_POST['id'])->countAllResults();

            $query = $model->like('name', $_POST['search']['value'])->where('type', 2)->where('parent', $_POST['id'])->findAll();

        }else{

            $count = $model->like('name', $_POST['search']['value'])->where('parent', -1)->countAllResults();

            $query = $model->like('name', $_POST['search']['value'])->where('parent', -1)->findAll();

        }



        if(isset($_POST['prods'])){

            foreach ($query as $item) {

                $dataJson[] = [

                    '<span class="pl-4">' . $item['name'] . ' ' . $item['kleur_code'] . '</span>',

                    '<label class="switch"><input type="checkbox" data-id="'.$item['id'].'" class="myToggle" '.(($item['active'] == 1) ? 'checked' : '').'><span class="slider"></span></label>',

                    '<a href="' . route_to('editProduct', $item['id']) . '">Bewerken</a>',

                    '<a href="' . route_to('deleteProduct', $item['id']) . '">Verwijderen</a>'

                ];

            }

        }else if(isset($_POST['id'])){

            foreach ($query as $item) {

                $dataJson[] = [

                    '<span class="pl-4">' . $item['name'] . '</span>',

                    '<label class="switch"><input type="checkbox" data-id="'.$item['id'].'" class="myToggle" '.(($item['active'] == 1) ? 'checked' : '').'><span class="slider"></span></label>',

                    '<a href="' . route_to('productsSubProds', $item['parent'], $item['id']) . '">Bekijk producten</a>',

                    '<a href="' . route_to('deleteProduct', $item['id']) . '">Verwijderen</a>'

                ];

            }

        }else{

            foreach ($query as $item) {

                $dataJson[] = [

                    '<span class="pl-4">' . $item['name'] . '</span>',

                    '<label class="switch"><input type="checkbox" data-id="'.$item['id'].'" class="myToggle" '.(($item['active'] == 1) ? 'checked' : '').'><span class="slider"></span></label>',

                    '<a href="' . route_to('productsSubSoorten', $item['id']) . '">Bekijk soorten</a>',

                    '<a href="' . route_to('editProduct', $item['id']) . '">Bewerken</a>'

                ];

            }

        }



        $data = [

            'draw'            => $_POST['draw'],

            'recordsTotal'    => $count,

            'recordsFiltered' => $count,

            'data'            => $dataJson

        ];



        echo json_encode($data, JSON_UNESCAPED_SLASHES);

    }

    

    public function setActive()

    {

        // Controleer of het een AJAX-verzoek is

        if (! $this->request->isAJAX()) {

            return $this->response->setJSON(['status' => 'error', 'message' => 'Geen geldig verzoek'])->setStatusCode(400);

        }



        // Haal data op uit POST

        $id     = $this->request->getPost('id');

        $active = $this->request->getPost('active'); // Verwacht 1 of 0



        // Basis validatie

        if (! is_numeric($id) || ! in_array((int) $active, [0, 1], true)) {

            return $this->response->setJSON(['status' => 'error', 'message' => 'Ongeldige invoer'])->setStatusCode(400);

        }



        // Laad je model (vervang met jouw modelnaam als die anders is)

        $model = new ProductsModel();



        // Voer de update uit

        $updated = $model->update($id, ['active' => (int) $active]);



        if ($updated) {

            return $this->response->setJSON(['status' => 'ok']);

        }



        // Als de update mislukt

        return $this->response->setJSON(['status' => 'error', 'message' => 'Update mislukt'])->setStatusCode(500);

    }



    public function getAllMerken()

    {

        $model = new ProductsModel();

        $data = array();



        foreach ($model->where('type', 1)->findAll() as $row) {

            $data[$row['id']] = $row['name'];

        }



        return $data;

    }



    public function getAllProds()

    {

        $model = new ProductsModel();

        $data = array();



        foreach ($model->where('type', 3)->findAll() as $row) {

            $data[$row['id']] = $row['name'].' - '.$row['kleur_code'];

        }



        return $data;

    }



    public function getParents($id = null)

    {

        $model = new ProductsModel();

        $data['parents'] = array();

        $data['parents'][-1] = 'Geen hoofdcategorie';



        foreach ($model->where('parent', -1)->findAll() as $row) {

            if ($model->where('parent', $row['id'])->countAllResults() > 0) {

                $data['parents'][$row['id']] = array();

            } else {

                $data['parents'][$row['id']] = $row['name'];

            }



            foreach ($model->where('parent', $row['id'])->findAll() as $row2) {

                $data['parents'][$row['id']][$row2['id']] = '&nbsp;&nbsp;&nbsp;' . $row2['name'];

            }

        }



        return $data['parents'];

    }



    public function create()

    {

        $data = array();

        

        $data['prods'] = $this->getAllProds();

        $data['parents'] = $this->getParents();

        $data['merken'] = $this->getAllMerken();



        return view('admin/' . $this->moduleurl . '/form', $data);

    }



    public function edit($id = null)

    {

        $data = [];

        $model = new ProductsModel();

        $data['data'] = $model->find($id);

        $data['prods'] = $this->getAllProds();

        $data['parents'] = $this->getParents($id);

        $data['merken'] = $this->getAllMerken();

        $data['kleuren'] = $model->where('groep', $data['data']['groep'])->countAllResults();



        return view('admin/' . $this->moduleurl . '/form', $data);

    }



    public function copy($id = null){

        $model = new ProductsModel();

        $data = $model->find($id);



        $data['id'] = '';

        $data['kleur'] = '';

        $data['kleur_code'] = '';

        $data['kleurnaam'] = '';

        $data['dessins'] = '';

        $data['afbeelding'] = '';

        

        $model->save($data);



        return view('admin/products/manage');

    }



    public function getPrices()

    {

        $model = new ProductsModel();



        $sip = floatval(str_replace(',', '.', $_POST['sip']));

        $korting = floatval($_POST['korting']);



        $parent = $model->find($_POST['parent']);



        if(!empty($_POST['sip'])){

            return number_format($sip - ($sip / 100 * $korting), 2);

        }else if (!empty($parent['sip']) && $parent['sip'] != 0) {

            return number_format($parent['sip'] - ($parent['sip'] / 100 * $korting), 2);

        } else {

            $parent2 = $model->find($parent['parent']);



            if (!empty($parent2['sip']) && $parent2['sip'] != 0) {   

                return number_format($parent2['sip'] - ($parent2['sip'] / 100 * $korting), 2);

            }else{

                return number_format($sip - ($sip / 100 * $korting), 2);

            }

        }

    }



    public function getSip()

    {

        $model = new ProductsModel();



        $parent = $model->find($_POST['parent']);



        return number_format($parent['sip'], 2);

    }



    public function save($id = null, $group = null)

    {

        $data = [];

        if (!empty($this->request->getPost())) {

            $rules = [

                'name' => 'required|min_length[3]'

            ];

            

            if ($this->validate($rules)) {

                $data = $this->request->getVar();



                $data['opt_afmeting'] = $this->request->getPost('opt_afmeting') ?? [];

                $data['opt_afmeting_vanaf'] = $this->request->getPost('opt_afmeting_vanaf') ?? [];



                // $model = new ProductsModel();

                // $product = $model->find($id);



                // if ($product) { // Controleer of het product bestaat

                //     foreach ($data as $key => $value) {

                //         if (isset($product[$key]) && !empty($product[$key]) && empty($value)) {

                //             // Als de originele waarde niet leeg was en de nieuwe waarde nu leeg is, maak het een lege JSON-array

                //             $data[$key] = json_encode([], JSON_UNESCAPED_UNICODE);

                //         } elseif (is_array($value)) {

                //             // Als de waarde een array is, encodeer het zoals normaal

                //             $data[$key] = json_encode($value, JSON_UNESCAPED_UNICODE);

                //         }

                //     }

                // }



                foreach ($data as $key => $value) {

                    if (is_array($value)) {

                        $data[$key] = json_encode($value, JSON_UNESCAPED_UNICODE);

                    }

                }



                if (is_numeric($id) && $id != 0) {

                    $data['id'] = $id;

                }



                $model = new ProductsModel();



                $data['url'] = strtolower(url_title(remove_accents($data['name'])));



                $img = $this->request->getFile('afbeelding');

                if ($img->getName() != '') {

                    $originalName = $img->getName();

                    $img->move(FCPATH . 'uploads', $originalName);

                    $imagePath = FCPATH . 'uploads/' . $originalName;



                    \Config\Services::image()

                        ->withFile($imagePath)

                        ->resize(1300, 1100, true, 'height')

                        ->save($imagePath);



                    $data['afbeelding'] = $originalName;

                }



                $img = $this->request->getFile('sfeerfoto1');

                if ($img->getName() != '') {

                    $originalName = $img->getName();

                    $img->move(FCPATH . 'uploads', $originalName);

                    $imagePath = FCPATH . 'uploads/' . $originalName;



                    \Config\Services::image()

                        ->withFile($imagePath)

                        ->resize(1300, 1100, true, 'height')

                        ->save($imagePath);



                    $data['sfeerfoto1'] = $originalName;

                }



                $img = $this->request->getFile('sfeerfoto2');

                if ($img->getName() != '') {

                    $originalName = $img->getName();

                    $img->move(FCPATH . 'uploads', $originalName);

                    $imagePath = FCPATH . 'uploads/' . $originalName;



                    \Config\Services::image()

                        ->withFile($imagePath)

                        ->resize(1300, 1100, true, 'height')

                        ->save($imagePath);



                    $data['sfeerfoto2'] = $originalName;

                }



                $img = $this->request->getFile('sfeerfoto3');

                if ($img->getName() != '') {

                    $originalName = $img->getName();

                    $img->move(FCPATH . 'uploads', $originalName);

                    $imagePath = FCPATH . 'uploads/' . $originalName;



                    \Config\Services::image()

                        ->withFile($imagePath)

                        ->resize(1300, 1100, true, 'height')

                        ->save($imagePath);



                    $data['sfeerfoto3'] = $originalName;

                }



                $img = $this->request->getFile('sfeerfoto4');

                if ($img->getName() != '') {

                    $originalName = $img->getName();

                    $img->move(FCPATH . 'uploads', $originalName);

                    $imagePath = FCPATH . 'uploads/' . $originalName;



                    \Config\Services::image()

                        ->withFile($imagePath)

                        ->resize(1300, 1100, true, 'height')

                        ->save($imagePath);



                    $data['sfeerfoto4'] = $originalName;

                }



                $img = $this->request->getFile('collectiefoto');

                if ($img->getName() != '') {

                    $originalName = $img->getName();

                    $img->move(FCPATH . 'uploads', $originalName);

                    $imagePath = FCPATH . 'uploads/' . $originalName;



                    \Config\Services::image()

                        ->withFile($imagePath)

                        ->resize(1300, 1100, true, 'height')

                        ->save($imagePath);



                    $data['collectiefoto'] = $originalName;

                }



                $img = $this->request->getFile('document1');



                if ($img->getName() != '') {

                    $originalName = pathinfo($img->getName(), PATHINFO_FILENAME);



                    $sanitizedName = strtolower(str_replace(' ', '_', $originalName));



                    $newName = $sanitizedName . "." . $img->getClientExtension();



                    $img->move(FCPATH . 'uploads', $newName);

                    $data['document1'] = $img->getName();

                }



                $img = $this->request->getFile('document2');



                if ($img->getName() != '') {

                    $originalName = pathinfo($img->getName(), PATHINFO_FILENAME);



                    $sanitizedName = strtolower(str_replace(' ', '_', $originalName));



                    $newName = $sanitizedName . "." . $img->getClientExtension();



                    $img->move(FCPATH . 'uploads', $newName);

                    $data['document2'] = $img->getName();

                }



                $img = $this->request->getFile('document3');



                if ($img->getName() != '') {

                    $originalName = pathinfo($img->getName(), PATHINFO_FILENAME);



                    $sanitizedName = strtolower(str_replace(' ', '_', $originalName));



                    $newName = $sanitizedName . "." . $img->getClientExtension();



                    $img->move(FCPATH . 'uploads', $newName);

                    $data['document3'] = $img->getName();

                }



                $img = $this->request->getFile('document4');



                if ($img->getName() != '') {

                    $originalName = pathinfo($img->getName(), PATHINFO_FILENAME);



                    $sanitizedName = strtolower(str_replace(' ', '_', $originalName));



                    $newName = $sanitizedName . "." . $img->getClientExtension();



                    $img->move(FCPATH . 'uploads', $newName);

                    $data['document4'] = $img->getName();

                }



                $img = $this->request->getFile('document5');



                if ($img->getName() != '') {

                    $originalName = pathinfo($img->getName(), PATHINFO_FILENAME);



                    $sanitizedName = strtolower(str_replace(' ', '_', $originalName));



                    $newName = $sanitizedName . "." . $img->getClientExtension();



                    $img->move(FCPATH . 'uploads', $newName);

                    $data['document5'] = $img->getName();

                }



                $img = $this->request->getFile('document6');



                if ($img->getName() != '') {

                    $originalName = pathinfo($img->getName(), PATHINFO_FILENAME);



                    $sanitizedName = strtolower(str_replace(' ', '_', $originalName));



                    $newName = $sanitizedName . "." . $img->getClientExtension();



                    $img->move(FCPATH . 'uploads', $newName);

                    $data['document6'] = $img->getName();

                }



                $img = $this->request->getFile('document7');



                if ($img->getName() != '') {

                    $originalName = pathinfo($img->getName(), PATHINFO_FILENAME);



                    $sanitizedName = strtolower(str_replace(' ', '_', $originalName));



                    $newName = $sanitizedName . "." . $img->getClientExtension();



                    $img->move(FCPATH . 'uploads', $newName);

                    $data['document7'] = $img->getName();

                }



                $img = $this->request->getFile('document8');



                if ($img->getName() != '') {

                    $originalName = pathinfo($img->getName(), PATHINFO_FILENAME);



                    $sanitizedName = strtolower(str_replace(' ', '_', $originalName));



                    $newName = $sanitizedName . "." . $img->getClientExtension();



                    $img->move(FCPATH . 'uploads', $newName);

                    $data['document8'] = $img->getName();

                }



                $img = $this->request->getFile('document9');



                if ($img->getName() != '') {

                    $originalName = pathinfo($img->getName(), PATHINFO_FILENAME);



                    $sanitizedName = strtolower(str_replace(' ', '_', $originalName));



                    $newName = $sanitizedName . "." . $img->getClientExtension();



                    $img->move(FCPATH . 'uploads', $newName);

                    $data['document9'] = $img->getName();

                }



                $img = $this->request->getFile('document10');



                if ($img->getName() != '') {

                    $originalName = pathinfo($img->getName(), PATHINFO_FILENAME);



                    $sanitizedName = strtolower(str_replace(' ', '_', $originalName));



                    $newName = $sanitizedName . "." . $img->getClientExtension();



                    $img->move(FCPATH . 'uploads', $newName);

                    $data['document10'] = $img->getName();

                }



                $data['stuks_prijs'] = str_replace(',', '.', $data['stuks_prijs']);

                $data['sip'] = str_replace(',', '.', $data['sip']);

                $data['korting100price'] = str_replace(',', '.', $data['korting100price']);

                $data['kip100'] = str_replace(',', '.', $data['kip100']);

                $data['marge100price'] = str_replace(',', '.', $data['marge100price']);

                $data['leveren100'] = str_replace(',', '.', $data['leveren100']);

                $data['aanbrengen100'] = str_replace(',', '.', $data['aanbrengen100']);

                $data['concurrent100'] = str_replace(',', '.', $data['concurrent100']);

                $data['advies_leveren100'] = str_replace(',', '.', $data['advies_leveren100']);

                

                $data['korting300price'] = str_replace(',', '.', $data['korting300price']);

                $data['kip300'] = str_replace(',', '.', $data['kip300']);

                $data['marge300price'] = str_replace(',', '.', $data['marge300price']);

                $data['leveren300'] = str_replace(',', '.', $data['leveren300']);

                $data['aanbrengen300'] = str_replace(',', '.', $data['aanbrengen300']);

                $data['concurrent300'] = str_replace(',', '.', $data['concurrent300']);

                $data['advies_leveren300'] = str_replace(',', '.', $data['advies_leveren300']);

                

                $data['korting500price'] = str_replace(',', '.', $data['korting500price']);

                $data['kip500'] = str_replace(',', '.', $data['kip500']);

                $data['marge500price'] = str_replace(',', '.', $data['marge500price']);

                $data['leveren500'] = str_replace(',', '.', $data['leveren500']);

                $data['aanbrengen500'] = str_replace(',', '.', $data['aanbrengen500']);

                $data['concurrent500'] = str_replace(',', '.', $data['concurrent500']);

                $data['advies_leveren500'] = str_replace(',', '.', $data['advies_leveren500']);

                

                $data['korting500moreprice'] = str_replace(',', '.', $data['korting500moreprice']);

                $data['kip500more'] = str_replace(',', '.', $data['kip500more']);

                $data['marge500moreprice'] = str_replace(',', '.', $data['marge500moreprice']);

                $data['leveren500more'] = str_replace(',', '.', $data['leveren500more']);

                $data['aanbrengen500more'] = str_replace(',', '.', $data['aanbrengen500more']);

                $data['concurrent500more'] = str_replace(',', '.', $data['concurrent500more']);

                $data['advies_leveren500more'] = str_replace(',', '.', $data['advies_leveren500more']);



                if($data['submit'] == 'opslaanMulti'){

                    foreach($model->where('groep', $data['groep'])->findAll() as $product){

                        $data['id'] = $product['id'];



                        $data['kleur'] = $product['kleur'];

                        $data['kleur_code'] = $product['kleur_code'];

                        $data['kleurnaam'] = $product['kleurnaam'];

                        $data['afbeelding'] = $product['afbeelding'];

                        $data['leverbaar'] = $product['leverbaar'];

                        $data['afmeting'] = $product['afmeting'];

                        $data['dessins'] = $product['dessins'];

                        $data['formaat'] = $product['formaat'];



                        $model->save($data);

                    }

                }else{

                    $model->save($data);

                }



                return redirect($this->moduleurl);

            } else {

                $data['validation'] = $this->validator;

            }

        }



        $data['prods'] = $this->getAllProds();

        $data['parents'] = $this->getParents($id);

        $data['merken'] = $this->getAllMerken();



        return view('admin/' . $this->moduleurl . '/form', $data);

    }



    public function delete($id)

    {

        $data = [];

        $model = new ProductsModel();

        $data['data'] = $model->find($id);



        return view('admin/' . $this->moduleurl . '/delete', $data);

    }



    public function delete_sure($id)

    {

        $model = new ProductsModel();

        $data = $model->find($id);



        if (!is_null($data)) {

            $model->delete($id);

            session()->setFlashdata('success', 'Succesvol verwijderd');

        }



        return redirect($this->moduleurl);

    }



    public function importAanbod()

    {

        return view('admin/' . $this->moduleurl . '/import');

    }



    public function importAanbodSave()

    {

        $model = new ProductsModel();



        header('Content-Type: text/html; charset=UTF-8');



        $spreadsheet = new Spreadsheet();



        $file_or = $this->request->getFile('userfile');



        if (isset($file_or)) {

            if ($file_or->move(WRITEPATH . '/imports')) {

                $inputFileType = 'Xlsx';

                $inputFileName = WRITEPATH . '/imports/' . $file_or->getName();



                $spreadsheet = IOFactory::load($inputFileName);

                $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                $i = 1;



                foreach ($sheetData as $data) {

                    if ($i != 1) {

                        if ($data['A'] != '') {

                            $data2 = array();



                            $modelGetMerk = $model->where('name', ucfirst($data['B']))->where('type', 1);



                            if ($modelGetMerk->countAllResults() < 1) {

                                $dataMerk = array();

                                $dataMerk['name'] = ucfirst($data['B']);

                                $dataMerk['type'] = 1;

                                $dataMerk['parent'] = -1;



                                $model->save($dataMerk);

                            }





                            $modelGetSoort = $model->where('name', ucfirst($data['C']))->where('type', 2);



                            if ($modelGetSoort->countAllResults() < 1) {

                                $dataMerk = array();

                                $dataMerk['name'] = ucfirst($data['C']);

                                $dataMerk['type'] = 2;

                                $dataMerk['parent'] = $model->where('name', $data['B'])->where('type', 1)->first()['id'];



                                $model->save($dataMerk);

                            }





                            $modelGetProduct = $model->where('name', ucfirst($data['A']))->where('type', 3);



                            if ($modelGetProduct->countAllResults() < 1) {

                                $dataMerk = array();

                                $dataMerk['name'] = ucfirst($data['A']);

                                $dataMerk['type'] = 2;

                                $dataMerk['parent'] = $model->where('name', $data['C'])->where('type', 2)->first()['id'];



                                $model->save($dataMerk);

                            }

                        }

                    }



                    $i++;

                }

                session()->setFlashdata('success', 'Alles is geïmporteerd!');



                return redirect()->route('importAanbod');

            }

        } else {

            session()->setFlashdata('danger', 'Bestand kon niet geüpload worden.');



            return redirect()->route('importAanbod');

        }

    }



    public function deleteGroup($group){

        $model = new ProductsModel();



        $ids = [];



        foreach($model->where('groep', $group)->findAll() as $row){

            $model->delete($row['id']);

            session()->setFlashdata('success', 'Succesvol verwijderd');

        }



        return redirect($this->moduleurl);

    }



    public function import()

    {

        $model = new ProductsModel();



        // Definieer het pad naar je Excel-bestand

        $filePath = FCPATH . '/kleurcodes.xlsx';



        // Laad het Excel-bestand

        $spreadsheet = IOFactory::load($filePath);

        $worksheet = $spreadsheet->getActiveSheet();



        // Ga door elke rij in het werkblad

        foreach ($worksheet->getRowIterator() as $row) {

            $cellIterator = $row->getCellIterator();

            $cellIterator->setIterateOnlyExistingCells(FALSE);



            $cells = [];

            foreach ($cellIterator as $cell) {

                $cells[] = $cell->getValue();

            }



            // Controleer of de naam in kolom A (index 0) bestaat in de database

            $name = $cells[0]; // Kolom A

            $product = $model->where('name', $name)->where('edited', 0)->first();



            if ($product) {

                // De naam bestaat in de database waar edited = 0

                // Stel de velden in om bij te werken

                $updateFields = ['kleur_code' => $cells[1]];  // Kleur_code uit kolom B (index 1)



                // Zet 'edited' op 1 tijdens de update

                $updateFields['edited'] = 1;



                // Werk de database bij

                $model->update($product['id'], $updateFields);

            } else {

                // De naam bestaat niet in de database waar edited = 0

                // Voer hier de gewenste acties uit

            }

        }

        echo 'gefixt';

    }



    public function getOffertePrice(){

        $model = new ProductsModel();



        $id = $this->request->getPost('id');

        $m2 = $this->request->getPost('m2');



        $product = $model->find($id);



        if (!$id || !$m2 || !is_numeric($m2)) {

            return $this->response->setJSON(['error' => 'Ongeldige gegevens.']);

        }



        // Staffels instellen

        $pricePerM2Excl = 0;

        $pricePerM2Incl = 0;



        if ($m2 < 100) {

            $pricePerM2Excl = $product['leveren100'];

            $pricePerM2Incl = $product['aanbrengen100'];

        } elseif ($m2 < 300) {

            $pricePerM2Excl = $product['leveren300'];

            $pricePerM2Incl = $product['aanbrengen300'];

        } elseif ($m2 < 500) {

            $pricePerM2Excl = $product['leveren500'];

            $pricePerM2Incl = $product['aanbrengen500'];

        } else {

            $pricePerM2Excl = $product['leveren500more'];

            $pricePerM2Incl = $product['aanbrengen500more'];

        }



        // Totale prijs berekenen

        $totalExcl = $m2 * $pricePerM2Excl;

        $totalIncl = $m2 * $pricePerM2Incl;



        // JSON-respons terugsturen

        return $this->response->setJSON([

            'pricePerM2' => [

                'excl' => number_format($pricePerM2Excl, 2, '.', ''),

                'incl' => number_format($pricePerM2Incl, 2, '.', '')

            ],

            'totalExcl' => number_format($totalExcl, 2, '.', ''),

            'totalIncl' => number_format($totalIncl, 2, '.', '')

        ]);

    }



    public function sendStaal()

    {

        $session = session();

        $request = $this->request;



        // Form validatie

        $validation = \Config\Services::validation();

        $validation->setRules([

            'naam'       => 'required|min_length[2]',

            'email'      => 'required|valid_email',

            'tel'        => 'required|numeric',

            'adres'      => 'required',

            'postcode'   => 'required',

            'woonplaats' => 'required'

        ]);



        if (!$validation->withRequest($request)->run()) {

            dd($validation->getErrors());

            return redirect()->back()->withInput()->with('error', 'Er zijn fouten in het formulier.');

        }



        // Sessies opslaan

        $session->set([

            'formName'  => $request->getPost('naam'),

            'formMail'  => $request->getPost('email'),

            'formTel'   => $request->getPost('tel'),

            'formStr'   => $request->getPost('adres'),

            'formPost'  => $request->getPost('postcode'),

            'formPlace' => $request->getPost('woonplaats'),

        ]);



        // Email versturen

        $email = service('email');



        $email->setTo('info@kantoortapijt.nl');

        $email->setFrom($request->getPost('email'), $request->getPost('naam'));

        $email->setSubject(esc($request->getPost('naam')).' - Nieuwe staal aanvraag');

        $email->setBCC('info@wmc-media.nl');

        

        $message = "

            <h3>Nieuwe staal aanvraag</h3>

            <p><strong>Staal:</strong> " . esc($request->getPost('staal')) . "</p>

            <p><strong>Naam:</strong> " . esc($request->getPost('naam')) . "</p>

            <p><strong>E-mailadres:</strong> " . esc($request->getPost('email')) . "</p>

            <p><strong>Telefoonnummer:</strong> " . esc($request->getPost('tel')) . "</p>

            <p><strong>Adres:</strong> " . esc($request->getPost('adres')) . "</p>

            <p><strong>Postcode:</strong> " . esc($request->getPost('postcode')) . "</p>

            <p><strong>Woonplaats:</strong> " . esc($request->getPost('woonplaats')) . "</p>

        ";



        $email->setMessage($message);

        $email->setMailType('html');



        if ($email->send()) {

            return redirect()->back()->with('success', 'Staal aanvraag succesvol ontvangen en e-mail verzonden!');

        } else {

            return redirect()->back()->with('error', 'Staal aanvraag ontvangen, maar e-mail kon niet worden verzonden.');

        }



        return redirect()->back()->with('success', 'Staal aanvraag succesvol ontvangen!');

    }



    public function sendOfferte()

    {

        $request = $this->request;



        // Form validatie

        $validation = \Config\Services::validation();

        $validation->setRules([

            'naam'      => 'required|min_length[2]|max_length[100]',

            'email'     => 'required|valid_email|max_length[100]',

        ]);



        if (!$validation->withRequest($request)->run()) {

            return redirect()->back()->withInput()->with('error', 'Er zijn fouten in het formulier.');

        }



        $session = session();

        $session->set([

            'offerteName'  => $request->getPost('naam'),

            'offerteMail'  => $request->getPost('email')

        ]);

        



        $to = $request->getPost('email');

        $bcc = 'info@wmc-media.nl';

        // $bcc = 'info@wmc-media.nl, info@kantoortapijt.nl';

        $from = "info@tapijtwebsite.nl";

        $replyTo = $request->getPost('email');

        $subject = "Nieuwe offerte aanvraag";



        // E-mail header opmaken

        $headers = "From: Tapijtwebsite.nl <" . $from . "> \r\n";

        $headers .= "Reply-To: " . $replyTo . " \r\n";

        $headers .= "Bcc: " . $bcc . " \r\n";

        $headers .= "Return-Path: noreply@tapijtwebsite.nl \r\n";

        $headers .= "MIME-Version: 1.0\r\n"; // Nodig voor HTML-e-mails

        $headers .= "Content-Type: text/html; charset=UTF-8\r\n"; // HTML-ondersteuning



        $message = "

            <!DOCTYPE html>

            <html lang='nl'>

            <head>

                <meta charset='UTF-8'>

                <meta name='viewport' content='width=device-width, initial-scale=1.0'>

                <title>Offerte aanvraag</title>

            </head>

            <body>

                <div style='width: 100%; max-width: 1200px; margin: auto; padding: 20px; background-color: #f4f4f4; font-family: Arial, sans-serif;'>

                    <div style='background: white; padding: 20px; border-radius: 8px;'>

                        <center><img src='https://tapijtwebsite.nl/webAssets/img/logo.png' /></center>

                        <h2 style='text-align: center;'>Nieuwe Offerte Aanvraag</h2>

                        

                        <p><strong>Naam:</strong> " . esc($request->getPost('naam')) . "</p>

                        <p><strong>E-mailadres:</strong> " . esc($request->getPost('email')) . "</p>

                        <p><strong>Product:</strong> ".esc($request->getPost('product'))."</p>



                        <h3>Offerte details</h3>

                        <table style='width: 100%; border-collapse: collapse;'>

                            <tr style='background: #007bff; color: white;'>

                                <th style='padding: 10px;'>Type</th>

                                <th style='padding: 10px;'>Aantal m²</th>

                                <th style='padding: 10px;'>Prijs per m²</th>

                                <th style='padding: 10px;'>Totaalprijs</th>

                            </tr>

                            <tr>

                                <td style='padding: 10px; text-align: center;'>Exclusief montage</td>

                                <td style='padding: 10px; text-align: center;'>" . esc($request->getPost('m2Excl')) . "</td>

                                <td style='padding: 10px; text-align: center;'>" . esc($request->getPost('priceExcl')) . "</td>

                                <td style='padding: 10px; text-align: center; font-weight: bold;'>" . esc($request->getPost('totalPriceExcl')) . "</td>

                            </tr>

                            <tr>

                                <td style='padding: 10px; text-align: center;'>Inclusief montage</td>

                                <td style='padding: 10px; text-align: center;'>" . esc($request->getPost('m2Incl')) . "</td>

                                <td style='padding: 10px; text-align: center;'>" . esc($request->getPost('priceIncl')) . "</td>

                                <td style='padding: 10px; text-align: center; font-weight: bold;'>" . esc($request->getPost('totalPriceIncl')) . "</td>

                            </tr>

                        </table>



                        <div style='text-align: center; padding-top: 20px; font-size: 12px; color: #777;'>

                            <p>Deze offerte is gegenereerd via de website.</p>

                            <p>&copy; " . date('Y') . " Kantoortapijt. Alle rechten voorbehouden.</p>

                        </div>

                    </div>

                </div>

            </body>

            </html>

            ";



            if (mail($to, $subject, $message, $headers)) {

                log_message('error', "Mail() is WEL verzonden naar $to.");

                return redirect()->back()->with('success', 'Offerte succesvol verzonden!');

            } else {

                log_message('error', "Mail() is NIET verzonden naar $to.");

                return redirect()->back()->with('error', 'Offerte ontvangen, maar e-mail kon niet worden verzonden.');

            }

    }

}

