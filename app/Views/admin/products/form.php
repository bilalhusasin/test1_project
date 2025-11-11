<?php
$this->extend('templates/admin');

$this->section('page_title');
echo 'Products beheer';
$this->endSection();

$this->section('page_name');
echo 'Products';
$this->endSection();

$this->section('content');

$optionLeverbaar = array();
$optionLeverbaar[1] = 'Ja';
$optionLeverbaar[0] = 'Nee';

use App\Models\ProductsModel;

$model = new ProductsModel();

foreach($parents as $key => $parent){
    if(is_array($parent)){
        foreach($parent as $parentID => $item){
            if(isset($data['parent']) && $data['parent'] == $parentID){
                $merkID = $key;
            }
        }
    }
}

if (isset($validation)) : ?>
    <div class="alert alert-danger">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>


<!-- field-group" id="group1"
d-none field-group" id="group2"
d-none field-group" id="group3 group4 group5 group6" -->

<div class="buttons mb-3">
    <button type="button" class="btn btn-primary" id="btn-group1">Projecttapijt</button>
    <button type="button" class="btn btn-primary" id="btn-group2">Tapijttegels</button>
    <button type="button" class="btn btn-primary" id="btn-group3">Projectvinyl</button>
    <button type="button" class="btn btn-primary" id="btn-group4">PVC vloeren</button>
    <button type="button" class="btn btn-primary" id="btn-group5">Linoleum</button>
    <button type="button" class="btn btn-primary" id="btn-group6">Loose lay</button>
</div>

<p><b>Aantal kleuren binnen deze groep: <?= ((isset($kleuren)) ? $kleuren : '0') ?></b></p>


<?= form_open_multipart(route_to('saveProduct', (isset($data['id']) ? $data['id'] : 0))) ?>
<div class="form-group mt-3">
    <?php
    echo form_label('Hoofdcategorie', 'parent');

    echo '<select class="form-control parent" name="parent">';

    foreach ($parents as $key => $parent) {
        if (is_array($parent)) {
            if (isset($data['parent']) && $data['parent'] == $key) {
                echo '<option value="' . $key . '" selected><b>' . $merken[$key] . '</b></option>';
            } else {
                echo '<option value="' . $key . '"><b>' . $merken[$key] . '</b></option>';
            }

            foreach ($parent as $parent_key => $parent_item) {
                if (isset($data['parent']) && $data['parent'] == $parent_key) {
                    echo '<option value="' . $parent_key . '" selected>' . $parent_item . '</option>';
                } else {
                    echo '<option value="' . $parent_key . '">' . $parent_item . '</option>';
                }
            }
        } else {
            if (isset($data['parent']) && $data['parent'] == $key) {
                echo '<option value="' . $key . '" selected>' . $parent . '</option>';
            } else {
                echo '<option value="' . $key . '">' . $parent . '</option>';
            }
        }
    }

    echo '</select>';
    ?>

</div>

<?php
$options = array();
$options[1] = 'Merk';
$options[2] = 'Soort';
$options[3] = 'Product';
?>

<div class="form-group">
    <?php
    echo form_label('Type', 'type');
    echo form_dropdown('type', $options, set_value('type', (isset($data['type']) ? $data['type'] : '')), 'class="form-control typeDrop"');
    ?>
</div>

<div class="row">
    <div class="form-group col-4">
        <?php
        echo form_label('Naam', 'name');
        $data2 = [
            'name' => 'name',
            'value' => set_value('name', (isset($data['name']) ? $data['name'] : ''), false),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>

    <div class="form-group col-4">
        <?php
        echo form_label('Label', 'label');
        $data2 = [
            'name' => 'label',
            'value' => set_value('label', (isset($data['label']) ? $data['label'] : ''), false),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>

    <div class="form-group col-4">
        <?php
        echo form_label('Collection', 'collection');
        $data2 = [
            'name' => 'collection',
            'value' => set_value('collection', (isset($data['collection']) ? $data['collection'] : ''), false),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>
</div>

<div class="row">
    <div class="form-group col-2">
        <?php
        echo form_label('Kleurcode', 'kleur_code');
        $data2 = [
            'name' => 'kleur_code',
            'value' => set_value('kleur_code', (isset($data['kleur_code']) ? $data['kleur_code'] : ''), false),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>


    <div class="form-group col-2">
        <?php
        echo form_label('Kleur', 'kleur');
        ?>
        <input type="color" name="kleur" value="<?= (isset($data['kleur']) ? $data['kleur'] : '') ?>" class="form-control">
    </div>

    <div class="form-group col-2">
        <?php
        echo form_label('Kleurnaam', 'kleurnaam');
        $data2 = [
            'name' => 'kleurnaam',
            'value' => set_value('kleurnaam', (isset($data['kleurnaam']) ? $data['kleurnaam'] : ''), false),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>

    <div class="form-group col-2">        
        <?= form_label('Leverbaar', 'leverbaar') ?>
        <select name="leverbaar[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['leverbaar']) ? $data['leverbaar'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Niet leverbaar",
                "Leverbaar",
                "Direct leverbaar",
                "Leverbaar vanaf ... m2",
                "Leverbaar op aanvraag"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2">        
        <?= form_label('Segmenten', 'toepassing') ?>
        <select name="toepassing[]" class="select2 form-control" multiple>
            <?php
            // Voorbeeld: haal de opgeslagen JSON-waarden uit $data['toepassing'] (die uit de database komt)
            // $selectedValues = !empty($data['toepassing']) ? json_decode($data['toepassing'], true) : [];

            $storedValue = !empty($data['toepassing']) ? $data['toepassing'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Kantoren",
                "Onderwijs",
                "Winkels-Warenhuizen",
                "Gezondheidszorg",
                "Ouderenzorg",
                "Horeca-Leisure-Hospitality",
                "Hotels",
                "Sport",
                "Industrie",
                "Woonprojecten"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2">        
        <?= form_label('Stijl', 'dessins') ?>
        <select name="dessins[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['dessins']) ? json_decode($data['dessins'], true) : [];
            $storedValue = !empty($data['dessins']) ? $data['dessins'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Abstract",
                "Effen-Uni",
                "Beton-Concrete",
                "Hout",
                "Lijnen",
                "Steen",
                "Gemeleerd",
                "Bloem",
                "Grafisch",
                "Gedessineerd",
                "Geometrisch",
                "Textuur"
            ];
            
            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2">
        <?php
        echo form_label('Groep', 'groep');
        $data2 = [
            'name' => 'groep',
            'value' => set_value('groep', (isset($data['groep']) ? $data['groep'] : '')),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>

    <div class="form-group col-2">        
        <?= form_label('Textuur', 'textuur') ?>
        <select name="textuur[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['textuur']) ? json_decode($data['textuur'], true) : [];
            $storedValue = !empty($data['textuur']) ? $data['textuur'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Lussenpool-Bouclé",
                "Gesneden pool-Frisé",
                "Ongelijke lussenpool",
                "Geschoren lussenpool",
                "Minituft"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2">        
        <?= form_label('Producttype', 'producttype') ?>
        <select name="producttype[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['producttype']) ? json_decode($data['producttype'], true) : [];
            $storedValue = !empty($data['producttype']) ? $data['producttype'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Harde modulaire vloerbedekking",
                "Zachte modulaire vloerbedekking",
                "Harde vloerbedekking op rol",
                "Zachte vloerbedekking op rol"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 field-group group1">        
        <?= form_label('Formaat', 'formaat') ?>
        <select name="formaat[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['formaat']) ? json_decode($data['formaat'], true) : [];
            $storedValue = !empty($data['formaat']) ? $data['formaat'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Rol"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group2">        
        <?= form_label('Formaat', 'formaat') ?>
        <select name="formaat[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['formaat']) ? json_decode($data['formaat'], true) : [];
            $storedValue = !empty($data['formaat']) ? $data['formaat'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Tegel",
                "Plank",
                "Hexagon",
                "Trapeze"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group3 group4 group5 group6">        
        <?= form_label('Formaat', 'formaat') ?>
        <select name="formaat[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['formaat']) ? json_decode($data['formaat'], true) : [];
            $storedValue = !empty($data['formaat']) ? $data['formaat'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Rol",
                "Tegel",
                "Strook"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 field-group group1">        
        <?= form_label('Afmeting', 'afmeting') ?>
        <select name="afmeting[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['afmeting']) ? json_decode($data['afmeting'], true) : [];
            $storedValue = !empty($data['afmeting']) ? $data['afmeting'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "200cm breed",
                "300cm breed",
                "400cm breed",
                "500cm breed"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group2">        
        <?= form_label('Afmeting', 'afmeting') ?>
        <select name="afmeting[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['afmeting']) ? json_decode($data['afmeting'], true) : [];
            $storedValue = !empty($data['afmeting']) ? $data['afmeting'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Tapijttegels 50 x 50cm",
                "Tapijttegels 100 x 100cm",
                "Tapijtplanken 50 x 100cm",
                "Tapijtplanken 25 x 100cm"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 field-group group3 group4 group5 group6">        
        <?= form_label('Afmeting', 'afmeting') ?>
        <select name="afmeting[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['afmeting']) ? json_decode($data['afmeting'], true) : [];
            $storedValue = !empty($data['afmeting']) ? $data['afmeting'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "200cm breed",
                "300cm breed",
                "400cm breed",
                "500cm breed",
                "Tegel lengte x breedte cm",
                "Strook lengte x breedte cm"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group2">        
        <?= form_label('Optionele afmeting vanaf', 'opt_afmeting_vanaf') ?>
        <select name="opt_afmeting_vanaf[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['afmeting']) ? json_decode($data['afmeting'], true) : [];
            $storedValue = !empty($data['opt_afmeting_vanaf']) ? $data['opt_afmeting_vanaf'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "100m²",
                "200m²",
                "400m²",
                "600m²",
                "800m²"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group2">        
        <?= form_label('Optionele afmeting', 'opt_afmeting') ?>
        <select name="opt_afmeting[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['afmeting']) ? json_decode($data['afmeting'], true) : [];
            $storedValue = !empty($data['opt_afmeting']) ? $data['opt_afmeting'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Tapijttegels 50 x 50cm",
                "Tapijttegels 100 x 100cm",
                "Tapijtplanken 50 x 100cm",
                "Tapijtplanken 25 x 100cm"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group2 group3 group4 group5 group6">        
        <?= form_label('Maximale lengte rol', 'afmeting_rol') ?>
        <select name="afmeting_rol[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['afmeting']) ? json_decode($data['afmeting'], true) : [];
            $storedValue = !empty($data['afmeting_rol']) ? $data['afmeting_rol'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "20m1",
                "22m1",
                "25m1",
                "30m1",
                "32m1"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2">        
        <?= form_label('Gebruik', 'gebruik') ?>
        <select name="gebruik[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['gebruik']) ? json_decode($data['gebruik'], true) : [];
            $storedValue = !empty($data['gebruik']) ? $data['gebruik'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Licht Huishoudelijk",
                "Normaal Huishoudelijk",
                "Intensief Huishoudelijk",
                "Licht Project",
                "Normaal Project",
                "Intensief Project",
                "Zwaar Intensief Project",
                "Licht Industrieel",
                "Normaal Industrieel",
                "Zwaar Industrieel"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2">        
        <?= form_label('Klasse', 'klasse') ?>
        <select name="klasse[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['klasse']) ? $data['klasse'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "21",
                "22",
                "23",
                "31",
                "32",
                "33",
                "34",
                "41",
                "42",
                "43"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2">
        <?php
        echo form_label('Aanbieding', 'aanbieding');
        echo form_dropdown('aanbieding', $optionLeverbaar, set_value('type', (isset($data['aanbieding']) ? $data['aanbieding'] : '')), 'class="form-control"');
        ?>
    </div>

    <div class="form-group col-2">
        <?php
        echo form_label('Aanbieding positie', 'aanbieding_position');
        $data2 = [
            'name' => 'aanbieding_position',
            'value' => set_value('aanbieding_position', (isset($data['aanbieding_position']) ? $data['aanbieding_position'] : '')),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>

    <div class="form-group col-2">
        <?php
        echo form_label('Top 10', 'top10');
        echo form_dropdown('top10', $optionLeverbaar, set_value('type', (isset($data['top10']) ? $data['top10'] : '')), 'class="form-control"');
        ?>
    </div>

    <div class="form-group col-2">
        <?php
        echo form_label('Top 10 positie', 'top10_position');
        $data2 = [
            'name' => 'top10_position',
            'value' => set_value('top10_position', (isset($data['top10_position']) ? $data['top10_position'] : '')),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>
    
    <div class="form-group col-2">
        <?php
        echo form_label('Korting', 'korting');
        $data2 = [
            'name' => 'korting',
            'value' => set_value('korting', (isset($data['korting']) ? $data['korting'] : '')),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>

    <div class="form-group col-2">
        <?php
        echo form_label('Garantie', 'garantie');
        $data2 = [
            'name' => 'garantie',
            'value' => set_value('garantie', (isset($data['garantie']) ? $data['garantie'] : '')),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>

    <div class="form-group col-2">
        <?php
        echo form_label('Voorraad', 'voorraad');
        $data2 = [
            'name' => 'voorraad',
            'value' => set_value('voorraad', (isset($data['voorraad']) ? $data['voorraad'] : '')),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>    

    <div class="form-group col-2 field-group">
        <?php
        echo form_label('Minimaal bestel eenheid', 'min_bestel');
        $data2 = [
            'name' => 'min_bestel',
            'value' => set_value('min_bestel', (isset($data['min_bestel']) ? $data['min_bestel'] : '')),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>

    <div class="form-group col-2 d-none field-group">        
        <?= form_label('Bestel eenheid', 'bestel_eenheid') ?>
        <select name="bestel_eenheid[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['bestel_eenheid']) ? $data['bestel_eenheid'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "3",
                "4",
                "5",
                "6"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 field-group group1">        
        <?= form_label('Bel. eigenschap', 'bel_eigenschap') ?>
        <select name="bel_eigenschap[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['bel_eigenschap']) ? $data['bel_eigenschap'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Verkrijgbaar als tegel",
                "Brandvertragend",
                "Onderhoudsvriendelijk",
                "Geproduceerd van gerecyclde garens",
                "Duurzaam",
                "Geschikt voor trappen",
                "Slijtvast",
                "Contactgeluids isolatie",
                "Gemaakt in europa"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group2">        
        <?= form_label('Bel. eigenschap', 'bel_eigenschap') ?>
        <select name="bel_eigenschap[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['bel_eigenschap']) ? $data['bel_eigenschap'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Kosten besparend-minder snijverlies",
                "Duurzaam-geheel of gedeeltelijk recyclebaar",
                "Vermindert de concentratie fijnstof in de binnenlucht",
                "Bio-based materiaal toegepast",
                "Gerecyclede garens toegepast",
                "Standaard met Desso Ecobase backing 100% recyclebaar",
                "Geproduceerd in Europa",
                "Optioneel met Desso Sound Master backing verkrijgbaar",
                "Eerste en enige tapijtproduct bekroond met GUI Gold-Plus label",
                "Oneindige combinatie mogelijkheden in kleur, kwaliteit, afmeting en legrichting",
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group3">        
        <?= form_label('Bel. eigenschap', 'bel_eigenschap') ?>
        <select name="bel_eigenschap[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['bel_eigenschap']) ? $data['bel_eigenschap'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Verkrijgbaar als rol",
                "Onderhoudsvriendelijk",
                "Geproduceerd van gerecycled materiaal",
                "Bio-weekmakers",
                "Eenvoudig te reinigen",
                "Slijtvast",
                "Contactgeluids isolatie",
                "Bescherming tegen chemicalién",
                "Eftalaatvrij product"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group4">        
        <?= form_label('Bel. eigenschap', 'bel_eigenschap') ?>
        <select name="bel_eigenschap[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['bel_eigenschap']) ? $data['bel_eigenschap'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Kostenbesparend minder snijverlies",
                "Onderhoudsvriendelijk",
                "Eenvoudig te reinigen",
                "Transportvriendelijk",
                "Slijtvast",
                "Lange levensduur",
                "Geluiddempend",
                "Waterbestendig",
                "Geschikt voor vloerverwarming"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group5">        
        <?= form_label('Bel. eigenschap', 'bel_eigenschap') ?>
        <select name="bel_eigenschap[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['bel_eigenschap']) ? $data['bel_eigenschap'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "98% biologische en mineralen producten",
                "Uitzonderlijk lage CO2 voetafdruk",
                "Cradle to Cradle zilver",
                "Slijtvast",
                "Eenvoudige schoonmaak en onderhoud",
                "Lange levensduur-duurzaam",
                "Geluiddempend",
                "Geschikt voor vloerverwarming",
                "Verschillende designs",
                "Hygienisch",
                "Anti bacteriele werking",
                "Recylebaar na gebruik"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group6">        
        <?= form_label('Bel. eigenschap', 'bel_eigenschap') ?>
        <select name="bel_eigenschap[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['bel_eigenschap']) ? $data['bel_eigenschap'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Kostenbesparend minder snijverlies",
                "Onderhoudsvriendelijk",
                "Te combineren met tapijttegels",
                "Transportvriendelijk",
                "Slijtvast",
                "Lange levensduur",
                "Geluiddempend",
                "Geschikt voor vloerverwarming",
                "Verschillende designs",
                "Maatvast hoge dimensistabiliteit",
                "Geproduceerd van gerecyclede producten"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2">
        <?php
        echo form_label('Totaalgewicht', 'tot_gewicht');
        $data2 = [
            'name' => 'tot_gewicht',
            'value' => set_value('tot_gewicht', (isset($data['tot_gewicht']) ? $data['tot_gewicht'] : '')),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>

    <div class="form-group col-2">
        <?php
        echo form_label('Pool gewicht', 'pool_gewicht');
        $data2 = [
            'name' => 'pool_gewicht',
            'value' => set_value('pool_gewicht', (isset($data['pool_gewicht']) ? $data['pool_gewicht'] : '')),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>

    <div class="form-group col-2">        
        <?= form_label('Cradle to cradle', 'cradle') ?>
        <select name="cradle[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['cradle']) ? $data['cradle'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Cradle to cradle Gold-plus level gecertificeerd",
                "Cradle to cradle Gold level gecertificeerd",
                "Cradle to cradle Silver level gecertificeerd",
                "Cradle to cradle Bronze level gecertificeerd"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2">        
        <?= form_label('Poolmateriaal', 'poolmateriaal') ?>
        <select name="poolmateriaal[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['poolmateriaal']) ? $data['poolmateriaal'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "PP-Polypropyleen",
                "PA-Polyamide",
                "PA-Solution Dyed Nylon",
                "PA-Gereycled garen",
                "SDN-Thrive Matter",
                "Econyl Yarn"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>
    
    <div class="form-group col-2">
        <?php
        echo form_label('Aantal stuks', 'stuks_pak');
        $data2 = [
            'name' => 'stuks_pak',
            'value' => set_value('stuks_pak', (isset($data['stuks_pak']) ? $data['stuks_pak'] : ''), false),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>
    
    <div class="form-group col-2">
        <?php
        echo form_label('Prijs per stuk', 'stuks_prijs');
        $data2 = [
            'name' => 'stuks_prijs',
            'value' => set_value('stuks_prijs', (isset($data['stuks_prijs']) ? $data['stuks_prijs'] : ''), false),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>

    <div class="form-group col-2 d-none field-group group3 group4 group5 group6">        
        <?= form_label('Totale dikte', 'tot_dikte') ?>
        <select name="tot_dikte[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['tot_dikte']) ? $data['tot_dikte'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "X MM"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group3 group4 group5 group6">        
        <?= form_label('Soort toplaag', 'soort_toplaag') ?>
        <select name="soort_toplaag[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['soort_toplaag']) ? $data['soort_toplaag'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Pur",
                "PurPearl",
                "Smarttop",
                "Evercare",
                "Protecsol",
                "Sparclean",
                "Topclean"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group3 group4 group5 group6">        
        <?= form_label('Dikte toplaag', 'dikte_toplaag') ?>
        <select name="dikte_toplaag[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['dikte_toplaag']) ? $data['dikte_toplaag'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "0,15mm",
                "0,2mm",
                "0,25mm",
                "0,3mm",
                "0,4mm",
                "0,45mm",
                "0,5mm",
                "0,55mm",
                "0,7mm",
                "0,8mm",
                "1,0mm"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group3 group4 group5 group6">        
        <?= form_label('Slipweerstand', 'slipweerstand') ?>
        <select name="slipweerstand[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['slipweerstand']) ? $data['slipweerstand'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "R8",
                "R10",
                "R11",
                "R12",
                "R13",
                "R14"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group3 group4 group5 group6">        
        <?= form_label('Geluidisolatie', 'geluidiso') ?>
        <select name="geluidiso[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['geluidiso']) ? $data['geluidiso'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "8 DB",
                "9 DB",
                "10 DB",
                "11 DB",
                "12 DB",
                "13 DB",
                "14 DB",
                "15 DB",
                "16 DB",
                "17 DB",
                "18 DB",
                "19 DB",
                "20 DB"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group3 group4 group5 group6">        
        <?= form_label('Vloerverwarming', 'vloerverwarming') ?>
        <select name="vloerverwarming[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['vloerverwarming']) ? $data['vloerverwarming'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "27 C"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group3 group4 group5 group6">        
        <?= form_label('Weerstand chem', 'weerstand') ?>
        <select name="weerstand[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['weerstand']) ? $data['weerstand'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Normaal",
                "Goed",
                "Zeer goed",
                "Extreem"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-2 d-none field-group group3 group4 group5 group6">        
        <?= form_label('Hetro-Homogeen', 'type_geen') ?>
        <select name="type_geen[]" class="select2 form-control" multiple>
            <?php
            // $selectedValues = !empty($data['klasse']) ? json_decode($data['klasse'], true) : [];
            $storedValue = !empty($data['type_geen']) ? $data['type_geen'] : null;

            // Controleer of de opgeslagen waarde een JSON-string is
            if (is_string($storedValue) && is_array(json_decode($storedValue, true))) {
                $selectedValues = json_decode($storedValue, true); // Decodeer JSON
            } else {
                $selectedValues = $storedValue ? [$storedValue] : []; // Maak een array van de enkele waarde
            }

            // Alle beschikbare opties
            $options = [
                "Hetrogeen vinyl",
                "Homogeen vinyl"
            ];

            // Genereer de opties dynamisch
            foreach ($options as $option) {
                // Controleer of deze optie geselecteerd moet zijn
                $selected = in_array($option, $selectedValues) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
            
            foreach ($selectedValues as $value) {
                if (!in_array($value, $options)) {
                    echo "<option value=\"$value\" selected>$value</option>";
                }
            }
            ?>
        </select>
    </div>
</div>

<?php
$data2 = array(
    'name'        => 'afbeelding',
    'value'       => set_value('afbeelding', (isset($data['afbeelding']) ? $data['afbeelding'] : ''), false),
    'class'       => 'form-control'
);

echo '<div class="row mb-3">';
    echo '<div class="col-2">';
        echo form_label('Hoofdafbeelding', 'afbeelding');
        echo form_upload($data2);

        if(isset($data['afbeelding'])){
            if(strpos($data['afbeelding'], 'uploads') === false){
                $img = '/uploads/'.$merken[$merkID].'/'.$data['afbeelding'];
            }else{
                $img = $data['afbeelding'];
            }

            if (!file_exists(FCPATH.$img)) {
                $img = '/uploads/'.$data['afbeelding'];
            }
        }

        echo ((isset($data['afbeelding']) && $data['afbeelding'] != '') ? '<img src="'.$img.'" class="img-thumbnail">' : '');
    echo '</div>';

    $data2 = array(
        'name'        => 'sfeerfoto1',
        'value'       => set_value('sfeerfoto1', (isset($data['sfeerfoto1']) ? $data['sfeerfoto1'] : ''), false),
        'class'       => 'form-control'
    );

    echo '<div class="col-2">';
        echo form_label('Sfeerfoto 1', 'sfeerfoto1');
        echo form_upload($data2);

        if(isset($data['sfeerfoto1'])){
            if(strpos($data['sfeerfoto1'], 'uploads') === false){
                $img = '/uploads/'.$merken[$merkID].'/'.$data['sfeerfoto1'];
            }else{
                $img = $data['sfeerfoto1'];
            }

            if (!file_exists(FCPATH.$img)) {
                $img = '/uploads/'.$data['sfeerfoto1'];
            }
        }

        echo ((isset($data['sfeerfoto1']) && $data['sfeerfoto1'] != '') ? '<img src="'.$img.'" class="img-thumbnail">' : '');
    echo '</div>';

    $data2 = array(
        'name'        => 'sfeerfoto2',
        'value'       => set_value('sfeerfoto2', (isset($data['sfeerfoto2']) ? $data['sfeerfoto2'] : ''), false),
        'class'       => 'form-control'
    );

    echo '<div class="col-2">';
        echo form_label('Sfeerfoto 2', 'sfeerfoto2');
        echo form_upload($data2);

        if(isset($data['sfeerfoto2'])){
            if(strpos($data['sfeerfoto2'], 'uploads') === false){
                $img = '/uploads/'.$merken[$merkID].'/'.$data['sfeerfoto2'];
            }else{
                $img = $data['sfeerfoto2'];
            }

            if (!file_exists(FCPATH.$img)) {
                $img = '/uploads/'.$data['sfeerfoto2'];
            }
        }

        echo ((isset($data['sfeerfoto2']) && $data['sfeerfoto2'] != '') ? '<img src="'.$img.'" class="img-thumbnail">' : '');
    echo '</div>';

    $data2 = array(
        'name'        => 'sfeerfoto3',
        'value'       => set_value('sfeerfoto3', (isset($data['sfeerfoto3']) ? $data['sfeerfoto3'] : ''), false),
        'class'       => 'form-control'
    );

    echo '<div class="col-2">';
        echo form_label('Sfeerfoto 3', 'sfeerfoto3');
        echo form_upload($data2);

        if(isset($data['sfeerfoto3'])){
            if(strpos($data['sfeerfoto3'], 'uploads') === false){
                $img = '/uploads/'.$merken[$merkID].'/'.$data['sfeerfoto3'];
            }else{
                $img = $data['sfeerfoto3'];
            }

            if (!file_exists(FCPATH.$img)) {
                $img = '/uploads/'.$data['sfeerfoto3'];
            }
        }

        echo ((isset($data['sfeerfoto3']) && $data['sfeerfoto3'] != '') ? '<img src="'.$img.'" class="img-thumbnail">' : '');
    echo '</div>';

    $data2 = array(
        'name'        => 'sfeerfoto4',
        'value'       => set_value('sfeerfoto4', (isset($data['sfeerfoto4']) ? $data['sfeerfoto4'] : ''), false),
        'class'       => 'form-control'
    );

    echo '<div class="col-2">';
        echo form_label('Sfeerfoto 4', 'sfeerfoto4');
        echo form_upload($data2);

        if(isset($data['sfeerfoto4'])){
            if(strpos($data['sfeerfoto4'], 'uploads') === false){
                $img = '/uploads/'.$merken[$merkID].'/'.$data['sfeerfoto4'];
            }else{
                $img = $data['sfeerfoto4'];
            }

            if (!file_exists(FCPATH.$img)) {
                $img = '/uploads/'.$data['sfeerfoto4'];
            }
        }

        echo ((isset($data['sfeerfoto4']) && $data['sfeerfoto4'] != '') ? '<img src="'.$img.'" class="img-thumbnail">' : '');
    echo '</div>';

    $data2 = array(
        'name'        => 'collectiefoto',
        'value'       => set_value('collectiefoto', (isset($data['collectiefoto']) ? $data['collectiefoto'] : ''), false),
        'class'       => 'form-control'
    );

    echo '<div class="col-2">';
        echo form_label('Collectie foto', 'collectiefoto');
        echo form_upload($data2);

        if(isset($data['collectiefoto'])){
            if(strpos($data['collectiefoto'], 'uploads') === false){
                $img = '/uploads/'.$merken[$merkID].'/'.$data['collectiefoto'];
            }else{
                $img = $data['collectiefoto'];
            }

            if (!file_exists(FCPATH.$img)) {
                $img = '/uploads/'.$data['collectiefoto'];
            }
        }

        echo ((isset($data['collectiefoto']) && $data['collectiefoto'] != '') ? '<img src="'.$img.'" class="img-thumbnail">' : '');
    echo '</div>';
echo '</div>';

echo form_label('Samenvatting', 'samenvatting');
?>
<textarea id="editor1" name="samenvatting"><?= (isset($data['samenvatting']) ? $data['samenvatting'] : '') ?></textarea>

<?php
echo form_label('Omschrijving', 'omschrijving');
?>
<textarea id="editor2" name="omschrijving"><?= (isset($data['omschrijving']) ? $data['omschrijving'] : '') ?></textarea>

<?php
echo form_label('Extra content 1', 'extracontent1');
?>
<textarea id="editor3" name="extracontent1"><?= (isset($data['extracontent1']) ? $data['extracontent1'] : '') ?></textarea>

<?php
echo form_label('Extra content 2', 'extracontent2');
?>
<textarea id="editor4" name="extracontent2"><?= (isset($data['extracontent2']) ? $data['extracontent2'] : '') ?></textarea>

<?php
echo form_label('Extra content 3', 'extracontent3');
?>
<textarea name="extracontent3" id="editor5">
  <?= (isset($data['extracontent3']) ? $data['extracontent3'] : '') ?>
</textarea>

<?php

$data2 = array(
    'name'        => 'document1',
    'value'       => set_value('document1', (isset($data['document1']) ? $data['document1'] : ''), false),
    'class'       => 'form-control'
);
$data3 = array(
    'name'        => 'document2',
    'value'       => set_value('document2', (isset($data['document2']) ? $data['document2'] : ''), false),
    'class'       => 'form-control'
);
$data4 = array(
    'name'        => 'document3',
    'value'       => set_value('document3', (isset($data['document3']) ? $data['document3'] : ''), false),
    'class'       => 'form-control'
);
$data5 = array(
    'name'        => 'document4',
    'value'       => set_value('document4', (isset($data['document4']) ? $data['document4'] : ''), false),
    'class'       => 'form-control'
);
$data6 = array(
    'name'        => 'document5',
    'value'       => set_value('document5', (isset($data['document5']) ? $data['document5'] : ''), false),
    'class'       => 'form-control'
);
$data7 = array(
    'name'        => 'document6',
    'value'       => set_value('document6', (isset($data['document6']) ? $data['document6'] : ''), false),
    'class'       => 'form-control'
);
$data8 = array(
    'name'        => 'document7',
    'value'       => set_value('document7', (isset($data['document7']) ? $data['document7'] : ''), false),
    'class'       => 'form-control'
);
$data9 = array(
    'name'        => 'document8',
    'value'       => set_value('document8', (isset($data['document8']) ? $data['document8'] : ''), false),
    'class'       => 'form-control'
);
$data10 = array(
    'name'        => 'document9',
    'value'       => set_value('document9', (isset($data['document9']) ? $data['document9'] : ''), false),
    'class'       => 'form-control'
);
$data11 = array(
    'name'        => 'document10',
    'value'       => set_value('document10', (isset($data['document10']) ? $data['document10'] : ''), false),
    'class'       => 'form-control'
);

echo '<div class="row">';
    echo '<div class="col-2 mt-3">';
        echo form_label('Document 1', 'document1');
        echo form_upload($data2);
        echo '<small>Geupload bestand: '.(isset($data['document1']) ? $data['document1'] : '').'</small>';
    echo '</div>';
    echo '<div class="col-2 mt-3">';
        echo form_label('Document 2', 'document2');
        echo form_upload($data3);
        echo '<small>Geupload bestand: '.(isset($data['document2']) ? $data['document2'] : '').'</small>';
    echo '</div>';
    echo '<div class="col-2 mt-3">';
        echo form_label('Document 3', 'document3');
        echo form_upload($data4);
        echo '<small>Geupload bestand: '.(isset($data['document3']) ? $data['document3'] : '').'</small>';
    echo '</div>';
    echo '<div class="col-2 mt-3">';
        echo form_label('Document 4', 'document4');
        echo form_upload($data5);
        echo '<small>Geupload bestand: '.(isset($data['document4']) ? $data['document4'] : '').'</small>';
    echo '</div>';
    echo '<div class="col-2 mt-3">';
        echo form_label('Document 5', 'document5');
        echo form_upload($data6);
        echo '<small>Geupload bestand: '.(isset($data['document5']) ? $data['document5'] : '').'</small>';
    echo '</div>';
    echo '<div class="col-2 mt-3">';
        echo form_label('Document 6', 'document6');
        echo form_upload($data7);
        echo '<small>Geupload bestand: '.(isset($data['document6']) ? $data['document6'] : '').'</small>';
    echo '</div>';
    echo '<div class="col-2 mt-3">';
        echo form_label('Document 7', 'document7');
        echo form_upload($data8);
        echo '<small>Geupload bestand: '.(isset($data['document7']) ? $data['document7'] : '').'</small>';
    echo '</div>';
    echo '<div class="col-2 mt-3">';
        echo form_label('Document 8', 'document8');
        echo form_upload($data9);
        echo '<small>Geupload bestand: '.(isset($data['document8']) ? $data['document8'] : '').'</small>';
    echo '</div>';
    echo '<div class="col-2 mt-3">';
        echo form_label('Document 9', 'document9');
        echo form_upload($data10);
        echo '<small>Geupload bestand: '.(isset($data['document9']) ? $data['document9'] : '').'</small>';
    echo '</div>';
    echo '<div class="col-2 mt-3">';
        echo form_label('Document 10', 'document10');
        echo form_upload($data11);
        echo '<small>Geupload bestand: '.(isset($data['document10']) ? $data['document10'] : '').'</small>';
    echo '</div>';
echo '</div>';

?>

<div class="form-group">
    <?php
    echo form_label('Gerelateerd product 1', 'gerelateerd1');
    echo form_dropdown('gerelateerd1', $prods, set_value('gerelateerd1', (isset($data['gerelateerd1']) ? $data['gerelateerd1'] : '')), 'class="form-control"');
    ?>
</div>

<div class="form-group">
    <?php
    echo form_label('Gerelateerd product 2', 'gerelateerd2');
    echo form_dropdown('gerelateerd2', $prods, set_value('gerelateerd2', (isset($data['gerelateerd2']) ? $data['gerelateerd2'] : '')), 'class="form-control"');
    ?>
</div>

<div class="form-group">
    <?php
    echo form_label('Gerelateerd product 3', 'gerelateerd3');
    echo form_dropdown('gerelateerd3', $prods, set_value('gerelateerd3', (isset($data['gerelateerd3']) ? $data['gerelateerd3'] : '')), 'class="form-control"');
    ?>
</div>

<div class="form-group">
    <?php
    echo form_label('Gerelateerd product 4', 'gerelateerd4');
    echo form_dropdown('gerelateerd4', $prods, set_value('gerelateerd4', (isset($data['gerelateerd4']) ? $data['gerelateerd4'] : '')), 'class="form-control"');
    ?>
</div>

<div class="form-group sipInput">
    <?php
    if (empty($data['sip'])) {
        if(!isset($data['id'])){
            $sipParent = 0;
        }else{
            $parent1 = $model->find($data['parent']);

            if (empty($parent1['sip'])) {
                $parent2 = $model->find($parent1['parent']);

                if (isset($parent2['sip']) && empty($parent2['sip'])) {
                    $sipParent = 0;
                } else {
                    $sipParent = $parent2['sip'];
                }
            } else {
                $sipParent = $parent1['sip'];
            }
        }
    }

    echo form_label('SIP', 'sip');
    $data2 = [
        'name' => 'sip',
        'value' => set_value('sip', (isset($data['sip']) ? $data['sip'] : $sipParent)),
        'class' => 'form-control sip keyup keyup2 keyup3 keyup4'
    ];
    echo form_input($data2);
    ?>
</div>

<div class="row mb-3">
    <div class="col-2">
        <?php
        echo form_label('Prijs concurrent 1', 'concurrent500more');
        $data2 = [
            'name' => 'concurrent500more',
            'value' => set_value('concurrent500more', ((isset($data['concurrent500more']) && !empty($data['concurrent500more'])) ? $data['concurrent500more'] : 0)),
            'class' => 'form-control concurrent500more'
        ];
        echo form_input($data2);
        ?>
    </div>

    <div class="col-2">
        <?php
        echo form_label('Prijs concurrent 2', 'concurrent500');
        $data2 = [
            'name' => 'concurrent500',
            'value' => set_value('concurrent500', ((isset($data['concurrent500']) && !empty($data['concurrent500'])) ? $data['concurrent500'] : 0)),
            'class' => 'form-control concurrent500'
        ];
        echo form_input($data2);
        ?>
    </div>

    <div class="col-2">
        <?php
        echo form_label('Prijs concurrent 3', 'concurrent300');
        $data2 = [
            'name' => 'concurrent300',
            'value' => set_value('concurrent300', ((isset($data['concurrent300']) && !empty($data['concurrent300'])) ? $data['concurrent300'] : 0)),
            'class' => 'form-control concurrent300'
        ];
        echo form_input($data2);
        ?>
    </div>

    <div class="col-2">
        <?php
        echo form_label('Prijs concurrent 4', 'concurrent100');
        $data2 = [
            'name' => 'concurrent100',
            'value' => set_value('concurrent100', ((isset($data['concurrent100']) && !empty($data['concurrent100'])) ? $data['concurrent100'] : 0)),
            'class' => 'form-control concurrent100'
        ];
        echo form_input($data2);
        ?>
    </div>

    <div class="col-2">
        <?php
        echo form_label('Prijs concurrent 5', 'concurrent5');
        $data2 = [
            'name' => 'concurrent5',
            'value' => set_value('concurrent5', ((isset($data['concurrent5']) && !empty($data['concurrent5'])) ? $data['concurrent5'] : 0)),
            'class' => 'form-control concurrent5'
        ];
        echo form_input($data2);
        ?>
    </div>

    <div class="col-2">
        <?php
        echo form_label('Prijs concurrent 6', 'concurrent6');
        $data2 = [
            'name' => 'concurrent6',
            'value' => set_value('concurrent6', ((isset($data['concurrent6']) && !empty($data['concurrent6'])) ? $data['concurrent6'] : 0)),
            'class' => 'form-control concurrent6'
        ];
        echo form_input($data2);
        ?>
    </div>
</div>


<div class="card">
    <h5 class="card-header"> < 100 m2</h5>

    <div class="card-body">
        <div class="form-group kortingInput">
            <div class="row">
                <div class="col-1">
                    <?php
                    echo form_label('Korting op SIP - %', 'korting100');
                    $data2 = [
                        'name' => 'korting100',
                        'value' => set_value('korting100', (isset($data['korting100']) ? $data['korting100'] : '')),
                        'class' => 'form-control korting100 keyup'
                    ];
                    echo form_input($data2);

                    if(!isset($data['korting100price'])){
                        $data['korting100price'] = '';
                    }

                    echo '<input type="hidden" name="korting100price" class="korting100priceinput keyup" value="'.$data['korting100price'].'" /><small class="korting100price">'.$data['korting100price'].'</small>';
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('KIP', 'kip100');
                    $data2 = [
                        'name' => 'kip100',
                        'value' => set_value('kip100', (isset($data['kip100']) ? $data['kip100'] : '')),
                        'class' => 'form-control kip100 keyup'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Extra kosten per m2', 'extra1001');
                    $data2 = [
                        'name' => 'extra1001',
                        'value' => set_value('extra1001', ((isset($data['extra1001']) && !empty($data['extra1001'])) ? $data['extra1001'] : 0)),
                        'class' => 'form-control extra1001 keyup'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Marge - %', 'marge100');
                    $data2 = [
                        'name' => 'marge100',
                        'value' => set_value('marge100', ((isset($data['marge100']) && !empty($data['marge100'])) ? $data['marge100'] : 0)),
                        'class' => 'form-control marge100 keyup'
                    ];
                    echo form_input($data2);

                    if(!isset($data['marge100price'])){
                        $data['marge100price'] = '';
                    }

                    echo '<input type="hidden" name="marge100price" class="marge100priceinput keyup" value="'.$data['marge100price'].'" /><small class="marge100price">'.$data['marge100price'].'</small>';
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Adviesprijs leveren', 'advies_leveren100');
                    $data2 = [
                        'name' => 'advies_leveren100',
                        'value' => set_value('advies_leveren100', ((isset($data['advies_leveren100']) && !empty($data['advies_leveren100'])) ? $data['advies_leveren100'] : 0)),
                        'class' => 'form-control'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Prijs leveren', 'leveren100');
                    $data2 = [
                        'name' => 'leveren100',
                        'value' => set_value('leveren100', ((isset($data['leveren100']) && !empty($data['leveren100'])) ? $data['leveren100'] : 0)),
                        'class' => 'form-control leveren100 keyup'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Opslag aanbrengen', 'opslag100');
                    $data2 = [
                        'name' => 'opslag100',
                        'value' => set_value('opslag100', ((isset($data['opslag100']) && !empty($data['opslag100'])) ? $data['opslag100'] : 0)),
                        'class' => 'form-control opslag100 keyup'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Extra kosten', 'extra1002');
                    $data2 = [
                        'name' => 'extra1002',
                        'value' => set_value('extra1002', ((isset($data['extra1002']) && !empty($data['extra1002'])) ? $data['extra1002'] : 0)),
                        'class' => 'form-control extra1002 keyup'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Prijs aanbrengen', 'aanbrengen100');
                    $data2 = [
                        'name' => 'aanbrengen100',
                        'value' => set_value('aanbrengen100', ((isset($data['aanbrengen100']) && !empty($data['aanbrengen100'])) ? $data['aanbrengen100'] : 0)),
                        'class' => 'form-control aanbrengen100'
                    ];
                    echo form_input($data2);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card mt-3">
    <h5 class="card-header"> < 300 m2</h5>

    <div class="card-body">
        <div class="form-group kortingInput">
            <div class="row">
                <div class="col-1">
                    <?php
                    echo form_label('Korting op SIP - %', 'korting300');
                    $data2 = [
                        'name' => 'korting300',
                        'value' => set_value('korting300', (isset($data['korting300']) ? $data['korting300'] : '')),
                        'class' => 'form-control korting300 keyup2'
                    ];
                    echo form_input($data2);

                    if(!isset($data['korting300price'])){
                        $data['korting300price'] = '';
                    }

                    echo '<input type="hidden" name="korting300price" class="korting300priceinput keyup2" value="'.$data['korting300price'].'" /><small class="korting300price">'.$data['korting300price'].'</small>';
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('KIP', 'kip300');
                    $data2 = [
                        'name' => 'kip300',
                        'value' => set_value('kip300', (isset($data['kip300']) ? $data['kip300'] : '')),
                        'class' => 'form-control kip300 keyup2'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Extra kosten per m2', 'extra3001');
                    $data2 = [
                        'name' => 'extra3001',
                        'value' => set_value('extra3001', ((isset($data['extra3001']) && !empty($data['extra3001'])) ? $data['extra3001'] : 0)),
                        'class' => 'form-control extra3001 keyup2'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Marge - %', 'marge300');
                    $data2 = [
                        'name' => 'marge300',
                        'value' => set_value('marge300', ((isset($data['marge300']) && !empty($data['marge300'])) ? $data['marge300'] : 0)),
                        'class' => 'form-control marge300 keyup2'
                    ];
                    echo form_input($data2);

                    if(!isset($data['marge300price'])){
                        $data['marge300price'] = '';
                    }

                    echo '<input type="hidden" name="marge300price" class="marge300priceinput keyup2" value="'.$data['marge300price'].'" /><small class="marge300price">'.$data['marge300price'].'</small>';
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Adviesprijs leveren', 'advies_leveren300');
                    $data2 = [
                        'name' => 'advies_leveren300',
                        'value' => set_value('advies_leveren300', ((isset($data['advies_leveren300']) && !empty($data['advies_leveren300'])) ? $data['advies_leveren300'] : 0)),
                        'class' => 'form-control'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Prijs leveren', 'leveren300');
                    $data2 = [
                        'name' => 'leveren300',
                        'value' => set_value('leveren300', ((isset($data['leveren300']) && !empty($data['leveren300'])) ? $data['leveren300'] : 0)),
                        'class' => 'form-control leveren300 keyup2'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Opslag aanbrengen', 'opslag300');
                    $data2 = [
                        'name' => 'opslag300',
                        'value' => set_value('opslag300', ((isset($data['opslag300']) && !empty($data['opslag300'])) ? $data['opslag300'] : 0)),
                        'class' => 'form-control opslag300 keyup2'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Extra kosten', 'extra3002');
                    $data2 = [
                        'name' => 'extra3002',
                        'value' => set_value('extra3002', ((isset($data['extra3002']) && !empty($data['extra3002'])) ? $data['extra3002'] : 0)),
                        'class' => 'form-control extra3002 keyup2'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Prijs aanbrengen', 'aanbrengen300');
                    $data2 = [
                        'name' => 'aanbrengen300',
                        'value' => set_value('aanbrengen300', ((isset($data['aanbrengen300']) && !empty($data['aanbrengen300'])) ? $data['aanbrengen300'] : 0)),
                        'class' => 'form-control aanbrengen300'
                    ];
                    echo form_input($data2);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card mt-3">
    <h5 class="card-header"> < 500 m2</h5>

    <div class="card-body">
        <div class="form-group kortingInput">
            <div class="row">
                <div class="col-1">
                    <?php
                    echo form_label('Korting op SIP - %', 'korting500');
                    $data2 = [
                        'name' => 'korting500',
                        'value' => set_value('korting500', (isset($data['korting500']) ? $data['korting500'] : '')),
                        'class' => 'form-control korting500 keyup3'
                    ];
                    echo form_input($data2);

                    if(!isset($data['korting500price'])){
                        $data['korting500price'] = '';
                    }

                    echo '<input type="hidden" name="korting500price" class="korting500priceinput keyup3" value="'.$data['korting500price'].'" /><small class="korting500price">'.$data['korting500price'].'</small>';
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('KIP', 'kip500');
                    $data2 = [
                        'name' => 'kip500',
                        'value' => set_value('kip500', (isset($data['kip500']) ? $data['kip500'] : '')),
                        'class' => 'form-control kip500 keyup3'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Extra kosten per m2', 'extra5001');
                    $data2 = [
                        'name' => 'extra5001',
                        'value' => set_value('extra5001', ((isset($data['extra5001']) && !empty($data['extra5001'])) ? $data['extra5001'] : 0)),
                        'class' => 'form-control extra5001 keyup3'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Marge - %', 'marge500');
                    $data2 = [
                        'name' => 'marge500',
                        'value' => set_value('marge500', ((isset($data['marge500']) && !empty($data['marge500'])) ? $data['marge500'] : 0)),
                        'class' => 'form-control marge500 keyup3'
                    ];
                    echo form_input($data2);

                    if(!isset($data['marge500price'])){
                        $data['marge500price'] = '';
                    }

                    echo '<input type="hidden" name="marge500price" class="marge500priceinput keyup3" value="'.$data['marge500price'].'" /><small class="marge500price">'.$data['marge500price'].'</small>';
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Adviesprijs leveren', 'advies_leveren500');
                    $data2 = [
                        'name' => 'advies_leveren500',
                        'value' => set_value('advies_leveren500', ((isset($data['advies_leveren500']) && !empty($data['advies_leveren500'])) ? $data['advies_leveren500'] : 0)),
                        'class' => 'form-control'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Prijs leveren', 'leveren500');
                    $data2 = [
                        'name' => 'leveren500',
                        'value' => set_value('leveren500', ((isset($data['leveren500']) && !empty($data['leveren500'])) ? $data['leveren500'] : 0)),
                        'class' => 'form-control leveren500 keyup3'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Opslag aanbrengen', 'opslag500');
                    $data2 = [
                        'name' => 'opslag500',
                        'value' => set_value('opslag500', ((isset($data['opslag500']) && !empty($data['opslag500'])) ? $data['opslag500'] : 0)),
                        'class' => 'form-control opslag500 keyup3'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Extra kosten', 'extra5002');
                    $data2 = [
                        'name' => 'extra5002',
                        'value' => set_value('extra5002', ((isset($data['extra5002']) && !empty($data['extra5002'])) ? $data['extra5002'] : 0)),
                        'class' => 'form-control extra5002 keyup3'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Prijs aanbrengen', 'aanbrengen500');
                    $data2 = [
                        'name' => 'aanbrengen500',
                        'value' => set_value('aanbrengen500', ((isset($data['aanbrengen500']) && !empty($data['aanbrengen500'])) ? $data['aanbrengen500'] : 0)),
                        'class' => 'form-control aanbrengen500'
                    ];
                    echo form_input($data2);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card mt-3">
    <h5 class="card-header"> 500+ m2</h5>

    <div class="card-body">
        <div class="form-group kortingInput">
            <div class="row">
                <div class="col-1">
                    <?php
                    echo form_label('Korting op SIP - %', 'korting500more');
                    $data2 = [
                        'name' => 'korting500more',
                        'value' => set_value('korting500more', (isset($data['korting500more']) ? $data['korting500more'] : '')),
                        'class' => 'form-control korting500more keyup4'
                    ];
                    echo form_input($data2);

                    if(!isset($data['korting500moreprice'])){
                        $data['korting500moreprice'] = '';
                    }

                    echo '<input type="hidden" name="korting500moreprice" class="korting500morepriceinput keyup4" value="'.$data['korting500moreprice'].'" /><small class="korting500moreprice">'.$data['korting500moreprice'].'</small>';
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('KIP', 'kip500more');
                    $data2 = [
                        'name' => 'kip500more',
                        'value' => set_value('kip500more', (isset($data['kip500more']) ? $data['kip500more'] : '')),
                        'class' => 'form-control kip500more keyup4'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Extra kosten per m2', 'extra5001more');
                    $data2 = [
                        'name' => 'extra5001more',
                        'value' => set_value('extra5001more', ((isset($data['extra5001more']) && !empty($data['extra5001more'])) ? $data['extra5001more'] : 0)),
                        'class' => 'form-control extra5001more keyup4'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Marge - %', 'marge500more');
                    $data2 = [
                        'name' => 'marge500more',
                        'value' => set_value('marge500more', ((isset($data['marge500more']) && !empty($data['marge500more'])) ? $data['marge500more'] : 0)),
                        'class' => 'form-control marge500more keyup4'
                    ];
                    echo form_input($data2);

                    if(!isset($data['marge500moreprice'])){
                        $data['marge500moreprice'] = '';
                    }

                    echo '<input type="hidden" name="marge500moreprice" class="marge500morepriceinput keyup4" value="'.$data['marge500moreprice'].'" /><small class="marge500moreprice">'.$data['marge500moreprice'].'</small>';
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Adviesprijs leveren', 'advies_leveren500more');
                    $data2 = [
                        'name' => 'advies_leveren500more',
                        'value' => set_value('advies_leveren500more', ((isset($data['advies_leveren500more']) && !empty($data['advies_leveren500more'])) ? $data['advies_leveren500more'] : 0)),
                        'class' => 'form-control'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Prijs leveren', 'leveren500more');
                    $data2 = [
                        'name' => 'leveren500more',
                        'value' => set_value('leveren500more', ((isset($data['leveren500more']) && !empty($data['leveren500more'])) ? $data['leveren500more'] : 0)),
                        'class' => 'form-control leveren500more keyup4'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Opslag aanbrengen', 'opslag500more');
                    $data2 = [
                        'name' => 'opslag500more',
                        'value' => set_value('opslag500more', ((isset($data['opslag500more']) && !empty($data['opslag500more'])) ? $data['opslag500more'] : 0)),
                        'class' => 'form-control opslag500more keyup4'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Extra kosten', 'extra5002more');
                    $data2 = [
                        'name' => 'extra5002more',
                        'value' => set_value('extra5002more', ((isset($data['extra5002more']) && !empty($data['extra5002more'])) ? $data['extra5002more'] : 0)),
                        'class' => 'form-control extra5002more keyup4'
                    ];
                    echo form_input($data2);
                    ?>
                </div>

                <div class="col-1">
                    <?php
                    echo form_label('Prijs aanbrengen', 'aanbrengen500more');
                    $data2 = [
                        'name' => 'aanbrengen500more',
                        'value' => set_value('aanbrengen500more', ((isset($data['aanbrengen500more']) && !empty($data['aanbrengen500more'])) ? $data['aanbrengen500more'] : 0)),
                        'class' => 'form-control aanbrengen500more'
                    ];
                    echo form_input($data2);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="form-group kortingInput">
    <div class="row">
        <div class="col-2">
            <?php
            echo form_label('Extra kosten per m2 - €', 'extra2');
            $data2 = [
                'name' => 'extra2',
                'value' => set_value('marge', ((isset($data['extra2']) && !empty($data['extra2'])) ? $data['extra2'] : 0)),
                'class' => 'form-control extra2 keyup mb-3'
            ];
            echo form_input($data2);
            ?>
        </div>
        <div class="col-2">
            <?php
            echo form_label('Extra kosten per m2 - €', 'extra3');
            $data2 = [
                'name' => 'extra3',
                'value' => set_value('marge', ((isset($data['extra3']) && !empty($data['extra3'])) ? $data['extra3'] : 0)),
                'class' => 'form-control extra3 keyup mb-3'
            ];
            echo form_input($data2);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-2">
            <?php
            echo form_label('Prijs <300', 'p300');
            $data2 = [
                'name' => 'p300',
                'value' => set_value('p300', (isset($data['p300']) ? $data['p300'] : '')),
                'class' => 'form-control p300'
            ];
            echo form_input($data2);
            ?>
        </div>

        <div class="col-2">
            <?php
            echo form_label('Prijs <500', 'p500');
            $data2 = [
                'name' => 'p500',
                'value' => set_value('p500', (isset($data['p500']) ? $data['p500'] : '')),
                'class' => 'form-control p500'
            ];
            echo form_input($data2);
            ?>
        </div>

        <div class="col-2">
            <?php
            echo form_label('Prijs 500m2 +', 'p500more');
            $data2 = [
                'name' => 'p500more',
                'value' => set_value('p500more', (isset($data['p500more']) ? $data['p500more'] : '')),
                'class' => 'form-control p500more'
            ];
            echo form_input($data2);
            ?>
        </div>
    </div>
</div> -->

<button type="submit" name="submit" class="fixed-bottom btn btn-primary mb-5 fixedOpslaanBtn" value="opslaan">Opslaan</button>
<button type="submit" name="submit" class="fixed-bottom btn btn-primary fixedOpslaanBtn" value="opslaanMulti">Opslaan voor groep</button>

<?php
if(!empty($data['groep'])){
    ?>
        <a href="<?= route_to('deleteGroup', $data['groep']) ?>" class="btn btn-danger mt-3 float-right confirm-delete">Verwijder volledige groep</a>
    <?php
}
?>
<?= form_close() ?>

<?php
$this->endSection();

$this->section('jsscript');
?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script type="text/javascript">    
    $(document).ready(function() {        
        $('.confirm-delete').on('click', function(e) {
            e.preventDefault(); // Voorkom standaard actie van de link
            
            // Toon een bevestigingsvraag
            let confirmAction = confirm("Weet je zeker dat je deze groep volledig wilt verwijderen?");
            if (confirmAction) {
                // Ga naar de link als de gebruiker bevestigt
                window.location.href = $(this).attr('href');
            }
        });
        
        $('.select2').select2({
            tags: true,
            placeholder: "Selecteer of voeg nieuwe toe",
            allowClear: true,
            width: '100%'
        });

        $(".buttons button").click(function () {
            // Haal ID van de knop op en maak het bijpassende veld zichtbaar
            const groupId = this.id.replace('btn-', ''); // Verwijder 'btn-' van het ID
            $(".field-group").addClass('d-none'); // Verberg alle groepen
            $("." + groupId).removeClass('d-none'); // Toon de geselecteerde groep

            // Zorg dat de knop visueel actief wordt
            $(".buttons button").removeClass('active'); // Verwijder actieve klasse van andere knoppen
            $(this).addClass('active'); // Voeg actieve klasse toe aan de geklikte knop
        });

        $("form").on("submit", function () {
            $(".field-group.d-none :input").prop("disabled", true); // Disable verborgen velden
        });

        // Zorg dat verborgen velden weer enabled worden na het verzenden
        $("form").on("reset", function () {
            $(".field-group :input").prop("disabled", false); // Enable alle velden na reset
        });
    });
    
    ClassicEditor
        .create(document.querySelector('#editor1'), {
            toolbar: [
            'heading', // Voor koppen (H1, H2, etc.)
            '|',
            'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', 'removeFormat',
            '|',
            'fontSize', 'fontColor', 'fontBackgroundColor', // Lettertypes en kleuren
            '|',
            'alignment', // Tekstuitlijning
            'bulletedList', 'numberedList', '|', 'outdent', 'indent', // Lijsten en inspringing
            '|',
            'undo', 'redo', // Ongedaan maken/herhalen
        ]
    })
    .catch(error => {
        console.error('Er is een fout opgetreden:', error);
    });
    
    ClassicEditor
        .create(document.querySelector('#editor2'), {
            toolbar: [
            'heading', // Voor koppen (H1, H2, etc.)
            '|',
            'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', 'removeFormat',
            '|',
            'fontSize', 'fontColor', 'fontBackgroundColor', // Lettertypes en kleuren
            '|',
            'alignment', // Tekstuitlijning
            'bulletedList', 'numberedList', '|', 'outdent', 'indent', // Lijsten en inspringing
            '|',
            'undo', 'redo', // Ongedaan maken/herhalen
        ]
    })
    .catch(error => {
        console.error('Er is een fout opgetreden:', error);
    });
    
    ClassicEditor
        .create(document.querySelector('#editor3'), {
            toolbar: [
            'heading', // Voor koppen (H1, H2, etc.)
            '|',
            'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', 'removeFormat',
            '|',
            'fontSize', 'fontColor', 'fontBackgroundColor', // Lettertypes en kleuren
            '|',
            'alignment', // Tekstuitlijning
            'bulletedList', 'numberedList', '|', 'outdent', 'indent', // Lijsten en inspringing
            '|',
            'undo', 'redo', // Ongedaan maken/herhalen
        ]
    })
    .catch(error => {
        console.error('Er is een fout opgetreden:', error);
    });
    
    ClassicEditor
        .create(document.querySelector('#editor4'), {
            toolbar: [
            'heading', // Voor koppen (H1, H2, etc.)
            '|',
            'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', 'removeFormat',
            '|',
            'fontSize', 'fontColor', 'fontBackgroundColor', // Lettertypes en kleuren
            '|',
            'alignment', // Tekstuitlijning
            'bulletedList', 'numberedList', '|', 'outdent', 'indent', // Lijsten en inspringing
            '|',
            'undo', 'redo', // Ongedaan maken/herhalen
        ]
    })
    .catch(error => {
        console.error('Er is een fout opgetreden:', error);
    });
    
    ClassicEditor
        .create(document.querySelector('#editor5'), {
            toolbar: [
            'heading', // Voor koppen (H1, H2, etc.)
            '|',
            'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', 'removeFormat',
            '|',
            'fontSize', 'fontColor', 'fontBackgroundColor', // Lettertypes en kleuren
            '|',
            'alignment', // Tekstuitlijning
            'bulletedList', 'numberedList', '|', 'outdent', 'indent', // Lijsten en inspringing
            '|',
            'undo', 'redo', // Ongedaan maken/herhalen
        ]
    })
    .catch(error => {
        console.error('Er is een fout opgetreden:', error);
    });

    $('.parent').change(function() {
        $.ajax({
            data: {
                parent: $('.parent').val()
            },
            method: "POST",
            url: "<?= route_to('getSip') ?>",
            success: function(data) {
                $(".sip").val(data)
            }
        });
    });

    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this,
                args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function() {
                callback.apply(context, args);
            }, ms || 0);
        };
    }

    $('.keyup').keyup(delay(function(e) {
        $.ajax({
            data: {
                sip: $('.sip').val().replace(',', '.'),  // Voeg deze regel toe
                korting: $('.korting100').val().replace(',', '.'),  // Voeg deze regel toe
                parent: $('.parent').val()
            },
            method: "POST",
            url: "<?= route_to('getPrices') ?>",
            success: function(data) {
                $(".kip100").val(data);

                var sip = parseFloat($('.sip').val().replace(',', '.'));  // Pas hier ook aan
                var korting = parseFloat($('.korting100').val().replace(',', '.'));  // Pas hier ook aan

                var sum100 = (parseFloat($(".kip100").val()) / 100 * parseFloat($('.marge100').val()));
                $(".marge100price").html(sum100.toFixed(2));
                $(".marge100priceinput").val(sum100.toFixed(2));

                var sum100 = sip - parseFloat($(".kip100").val());
                $(".korting100price").html(sum100.toFixed(2));
                $(".korting100priceinput").val(sum100.toFixed(2));

                var sum100 = parseFloat($(".kip100").val()) + (parseFloat($(".kip100").val()) / 100 * parseFloat($('.marge100').val())) + parseFloat($(".extra1001").val());
                $(".leveren100").val(sum100.toFixed(2));

                var sum100 = parseFloat($(".leveren100").val()) + parseFloat($(".opslag100").val()) + parseFloat($(".extra1002").val());
                $(".aanbrengen100").val(sum100.toFixed(2));
            }
        });
    }, 1000));

    // Keyup2 met komma-omzetting
    $('.keyup2').keyup(delay(function(e) {
        $.ajax({
            data: {
                sip: $('.sip').val().replace(',', '.'),
                korting: $('.korting300').val().replace(',', '.'),
                parent: $('.parent').val()
            },
            method: "POST",
            url: "<?= route_to('getPrices') ?>",
            success: function(data) {
                $(".kip300").val(data);

                var sum100 = (parseFloat($(".kip300").val().replace(',', '.')) / 100 * parseFloat($('.marge300').val().replace(',', '.')));
                $(".marge300price").html(sum100.toFixed(2));
                $(".marge300priceinput").val(sum100.toFixed(2));

                var sum100 = parseFloat($(".sip").val().replace(',', '.')) - parseFloat($(".kip300").val().replace(',', '.'));
                $(".korting300price").html(sum100.toFixed(2));
                $(".korting300priceinput").val(sum100.toFixed(2));

                var sum100 = parseFloat($(".kip300").val().replace(',', '.')) + (parseFloat($(".kip300").val().replace(',', '.')) / 100 * parseFloat($('.marge300').val().replace(',', '.'))) + parseFloat($(".extra3001").val().replace(',', '.'));
                $(".leveren300").val(sum100.toFixed(2));

                var sum100 = parseFloat($(".leveren300").val().replace(',', '.')) + parseFloat($(".opslag300").val().replace(',', '.')) + parseFloat($(".extra3002").val().replace(',', '.'));
                $(".aanbrengen300").val(sum100.toFixed(2));
            }
        });
    }, 1000));

    // Keyup3 met komma-omzetting
    $('.keyup3').keyup(delay(function(e) {
        $.ajax({
            data: {
                sip: $('.sip').val().replace(',', '.'),
                korting: $('.korting500').val().replace(',', '.'),
                parent: $('.parent').val()
            },
            method: "POST",
            url: "<?= route_to('getPrices') ?>",
            success: function(data) {
                $(".kip500").val(data);

                var sum100 = (parseFloat($(".kip500").val().replace(',', '.')) / 100 * parseFloat($('.marge500').val().replace(',', '.')));
                $(".marge500price").html(sum100.toFixed(2));
                $(".marge500priceinput").val(sum100.toFixed(2));

                var sum100 = parseFloat($(".sip").val().replace(',', '.')) - parseFloat($(".kip500").val().replace(',', '.'));
                $(".korting500price").html(sum100.toFixed(2));
                $(".korting500priceinput").val(sum100.toFixed(2));

                var sum100 = parseFloat($(".kip500").val().replace(',', '.')) + (parseFloat($(".kip500").val().replace(',', '.')) / 100 * parseFloat($('.marge500').val().replace(',', '.'))) + parseFloat($(".extra5001").val().replace(',', '.'));
                $(".leveren500").val(sum100.toFixed(2));

                var sum100 = parseFloat($(".leveren500").val().replace(',', '.')) + parseFloat($(".opslag500").val().replace(',', '.')) + parseFloat($(".extra5002").val().replace(',', '.'));
                $(".aanbrengen500").val(sum100.toFixed(2));
            }
        });
    }, 1000));

    // Keyup4 met komma-omzetting
    $('.keyup4').keyup(delay(function(e) {
        $.ajax({
            data: {
                sip: $('.sip').val().replace(',', '.'),
                korting: $('.korting500more').val().replace(',', '.'),
                parent: $('.parent').val()
            },
            method: "POST",
            url: "<?= route_to('getPrices') ?>",
            success: function(data) {
                $(".kip500more").val(data);

                var sum100 = (parseFloat($(".kip500more").val().replace(',', '.')) / 100 * parseFloat($('.marge500more').val().replace(',', '.')));
                $(".marge500moreprice").html(sum100.toFixed(2));
                $(".marge500morepriceinput").val(sum100.toFixed(2));

                var sum100 = parseFloat($(".sip").val().replace(',', '.')) - parseFloat($(".kip500more").val().replace(',', '.'));
                $(".korting500moreprice").html(sum100.toFixed(2));
                $(".korting500morepriceinput").val(sum100.toFixed(2));

                var sum100 = parseFloat($(".kip500more").val().replace(',', '.')) + (parseFloat($(".kip500more").val().replace(',', '.')) / 100 * parseFloat($('.marge500more').val().replace(',', '.'))) + parseFloat($(".extra5001more").val().replace(',', '.'));
                $(".leveren500more").val(sum100.toFixed(2));

                var sum100 = parseFloat($(".leveren500more").val().replace(',', '.')) + parseFloat($(".opslag500more").val().replace(',', '.')) + parseFloat($(".extra5002more").val().replace(',', '.'));
                $(".aanbrengen500more").val(sum100.toFixed(2));
            }
        });
    }, 1000));
</script>

<?php
$this->endSection();
?>