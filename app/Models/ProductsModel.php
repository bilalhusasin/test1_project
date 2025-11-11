<?php namespace App\Models;
 
use App\Models\BaseModel;
 
class ProductsModel extends BaseModel
{
    protected $table = 'products';
    protected $allowedFields = [
        'name',
        'url',
        'type',
        'parent',
        'sip',
        'kleur_code',
        'leverbaar',

        'korting100',
        'korting100price',
        'kip100',
        'extra1001',
        'marge100',
        'marge100price',
        'leveren100',
        'opslag100',
        'extra1002',
        'aanbrengen100',
        'concurrent100',
        
        'korting300',
        'korting300price',
        'kip300',
        'extra3001',
        'marge300',
        'marge300price',
        'leveren300',
        'opslag300',
        'extra3002',
        'aanbrengen300',
        'concurrent300',
        
        'korting500',
        'korting500price',
        'kip500',
        'extra5001',
        'marge500',
        'marge500price',
        'leveren500',
        'opslag500',
        'extra5002',
        'aanbrengen500',
        'concurrent500',
        
        'concurrent5',
        'concurrent6',
        
        'korting500more',
        'korting500moreprice',
        'kip500more',
        'extra5001more',
        'marge500more',
        'marge500moreprice',
        'leveren500more',
        'opslag500more',
        'extra5002more',
        'aanbrengen500more',
        'concurrent500more',

        'kleur',
        'kleurnaam',
        'collection',
        'label',
        'toepassing',
        'dessins',
        'gebruik',
        'textuur',
        'producttype',
        'formaat',
        'afmeting',
        'korting',
        'klasse',
        'opt_afmeting',
        'opt_afmeting_vanaf',
        'bel_eigenschap',
        'tot_gewicht',
        'pool_gewicht',
        'poolmateriaal',
        'cradle',
        'garantie',
        'afbeelding',
        'bestel_eenheid',
        'min_bestel',
        'aanbieding',
        'top10',
        'groep',
        'samenvatting',
        'omschrijving',
        'voorraad',
        'edited',
        'extracontent1',
        'extracontent2',
        'extracontent3',

        'tot_dikte',
        'soort_toplaag',
        'dikte_toplaag',
        'slipweerstand',
        'geluidiso',
        'vloerverwarming',
        'weerstand',
        'type_geen',
        'afmeting_rol',

        'document1',
        'document2',
        'document3',
        'document4',
        'document5',
        'document6',
        'document7',
        'document8',
        'document9',
        'document10',
        'sfeerfoto1',
        'sfeerfoto2',
        'sfeerfoto3',
        'sfeerfoto4',
        'collectiefoto',
        'gerelateerd1',
        'gerelateerd2',
        'gerelateerd3',
        'gerelateerd4',
        'imgresize',
        'active',
        'top10_position',
        'aanbieding_position',
        'stuks_pak',
        'stuks_prijs',

        'advies_leveren100',
        'advies_leveren300',
        'advies_leveren500',
        'advies_leveren500more'
    ];
}