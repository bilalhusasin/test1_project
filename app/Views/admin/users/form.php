<?php
$this->extend('templates/admin');

$this->section('page_title');
echo 'Klanten beheer';
$this->endSection();

$this->section('page_name');
echo 'Klanten';
$this->endSection();

$this->section('content');

$options = array();
$options['0'] = 0;
$options['21'] = 21;

$options2 = array();
$options2['1'] = 'Geldig';
$options2['0'] = 'Niet geldig';
$options2['-1'] = 'N.v.t.';

if (isset($validation)) : ?>
    <div class="alert alert-danger">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<?= form_open(route_to('saveUsers', (isset($data['id']) ? $data['id'] : 0))) ?>
    <div class="row">
            <div class="form-group col-sm-3">
                <?php        
                echo form_label('Voorletter(s)*', 'voorletter');
                $data2 = [
                    'name' => 'voorletter',
                    'value' => set_value('voorletter', (isset($data['voorletter']) ? $data['voorletter'] : ''), false),
                    'class' => 'form-control'
                ];
                echo form_input($data2);
                ?>
            </div>
            
            <div class="form-group col-sm-3">
                <?php        
                echo form_label('Tussenvoegsel', 'tussenvoegsel');
                $data2 = [
                    'name' => 'tussenvoegsel',
                    'value' => set_value('tussenvoegsel', (isset($data['tussenvoegsel']) ? $data['tussenvoegsel'] : ''), false),
                    'class' => 'form-control'
                ];
                echo form_input($data2);
                ?>
            </div>
            
            <div class="form-group col-sm-6">
                <?php        
                echo form_label('Achternaam*', 'achternaam');
                $data2 = [
                    'name' => 'achternaam',
                    'value' => set_value('achternaam', (isset($data['achternaam']) ? $data['achternaam'] : ''), false),
                    'class' => 'form-control'
                ];
                echo form_input($data2);
                ?>
            </div>
            
            <div class="form-group col-sm-4">
                <?php        
                echo form_label('Land*', 'land');
                $data2 = [
                    'name' => 'land',
                    'value' => set_value('land', (isset($data['land']) ? $data['land'] : ''), false),
                    'class' => 'form-control'
                ];
                echo form_input($data2);
                ?>
            </div>
            
            <div class="form-group col-sm-4">
                <?php        
                echo form_label('Postcode*', 'postcode');
                $data2 = [
                    'name' => 'postcode',
                    'value' => set_value('postcode', (isset($data['postcode']) ? $data['postcode'] : ''), false),
                    'class' => 'form-control'
                ];
                echo form_input($data2);
                ?>
            </div>
            
            <div class="form-group col-sm-4">
                <?php        
                echo form_label('Huisnummer*', 'huisnr');
                $data2 = [
                    'name' => 'huisnr',
                    'value' => set_value('huisnr', (isset($data['huisnr']) ? $data['huisnr'] : ''), false),
                    'class' => 'form-control'
                ];
                echo form_input($data2);
                ?>
            </div>
        
            <div class="form-group col-sm-6">
                <?php        
                echo form_label('Straat*', 'straat');
                $data2 = [
                    'name' => 'straat',
                    'value' => set_value('straat', (isset($data['straat']) ? $data['straat'] : ''), false),
                    'class' => 'form-control'
                ];
                echo form_input($data2);
                ?>
            </div>
        
            <div class="form-group col-sm-6">
                <?php        
                echo form_label('Woonplaats*', 'woonplaats');
                $data2 = [
                    'name' => 'woonplaats',
                    'value' => set_value('woonplaats', (isset($data['woonplaats']) ? $data['woonplaats'] : ''), false),
                    'class' => 'form-control'
                ];
                echo form_input($data2);
                ?>
            </div>
        
            <div class="form-group col-sm-6">
                <?php        
                echo form_label('Telefoonnummer', 'tel');
                $data2 = [
                    'name' => 'tel',
                    'value' => set_value('tel', (isset($data['tel']) ? $data['tel'] : ''), false),
                    'class' => 'form-control'
                ];
                echo form_input($data2);
                ?>
            </div>
        
            <div class="form-group col-sm-6">
                <?php        
                echo form_label('Skype naam', 'skype');
                $data2 = [
                    'name' => 'skype',
                    'value' => set_value('skype', (isset($data['skype']) ? $data['skype'] : ''), false),
                    'class' => 'form-control'
                ];
                echo form_input($data2);
                ?>
            </div>
        
            <div class="form-group col-sm-6">
                <?php        
                echo form_label('Bedrijfsnaam', 'bedrijfsnaam');
                $data2 = [
                    'name' => 'bedrijfsnaam',
                    'value' => set_value('bedrijfsnaam', (isset($data['bedrijfsnaam']) ? $data['bedrijfsnaam'] : ''), false),
                    'class' => 'form-control'
                ];
                echo form_input($data2);
                ?>
            </div>
        
            <div class="form-group col-sm-6">
                <?php        
                echo form_label('BTW Nummer', 'btw');
                $data2 = [
                    'name' => 'btw',
                    'value' => set_value('btw', (isset($data['btw']) ? $data['btw'] : ''), false),
                    'class' => 'form-control'
                ];
                echo form_input($data2);
                ?>
            </div>
        
            <div class="form-group col-sm-6">
                <?php        
                echo form_label('E-mail*', 'email');
                $data2 = [
                    'name' => 'email',
                    'value' => set_value('email', (isset($data['email']) ? $data['email'] : ''), false),
                    'class' => 'form-control'
                ];
                echo form_input($data2);
                ?>
            </div>
        
            <div class="form-group col-sm-6">
                <?php        
                echo form_label('Saldo*', 'saldo');
                $data2 = [
                    'name' => 'saldo',
                    'value' => set_value('saldo', (isset($data['saldo']) ? $data['saldo'] : ''), false),
                    'class' => 'form-control'
                ];
                echo form_input($data2);
                ?>
            </div>
        
            <div class="form-group col-sm-6">
                <?php
                    echo form_label('BTW Percentage', 'btw_per');
                    echo form_dropdown('btw_per', $options, set_value('btw_per',(isset($data['btw_per']) ? $data['btw_per'] : '')), 'class="form-control"');
                ?>
            </div>
        
            <div class="form-group col-sm-6">
                <?php
                    echo form_label('BTW nr geldig?', 'btw_status');
                    echo form_dropdown('btw_status', $options2, set_value('btw_status',(isset($data['btw_status']) ? $data['btw_status'] : '')), 'class="form-control"');
                ?>
            </div>
        </div>

    <input type="submit" name="submit" class="btn btn-primary" value="Opslaan">
<?= form_close() ?>

<?php
$this->endSection();
?>