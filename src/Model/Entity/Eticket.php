<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Model\Entity\RandomStringGenerator;

/**
 * Eticket Entity
 *
 * @property int $id
 * @property string $qr
 * @property string $name
 * @property string $surname
 * @property string $cellphone
 * @property bool $confirmation
 * @property bool $scanned
 * @property string $type
 * @property int $mesa
 * @property \Cake\I18n\FrozenTime|null $deleted
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class Eticket extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'qr' => true,
        'name' => true,
        'surname' => true,
        'cellphone' => true,
        'confirmation' => true,
        'scanned' => true,
        'type' => true,
        'mesa' => true,
        'deleted' => true,
        'created' => true,
        'modified' => true,
        'sent' => true
    ];
    protected function _setQr($value)
    {
        if (strlen($value)) {
            $generator = new RandomStringGenerator();
            $result = $generator->hashQr($value);
            return $result;
        }
    }
}
