<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\FrozenTime|null $startTime
 * @property \Cake\I18n\FrozenTime|null $endTime
 * @property \Cake\I18n\FrozenTime|null $deleted
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $user_id
 * @property string $lat
 * @property string $lng
 * @property string|null $wp_msg
 * @property string|null $type
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Eticket[] $etickets
 */
class Event extends Entity
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
        'name' => true,
        'startTime' => true,
        'endTime' => true,
        'deleted' => true,
        'created' => true,
        'modified' => true,
        'user_id' => true,
        'lat' => true,
        'lng' => true,
        'wp_msg' => true,
        'type' => true,
        'user' => true,
        'etickets' => true
    ];
}
