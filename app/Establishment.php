<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string $build
 * @property string $floor
 * @property string $apt_nbr
 * @property string $zip
 * @property integer $visit_nbr
 * @property integer $city_id
 * @property integer $owner_id
 * @property integer $creator_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $owner
 * @property City $city
 * @property User $doctors
 * @property Phone $phones
 * @property Invoice $invoices
 * @property Calendar $calendars
 * @property User $creator
 * @property Img $imgs
 */
class Establishment extends Model
{

    protected $fillable = [
        'name', 'description',
        'address', 'build', 'floor', 'apt_nbr', 'zip',
        'visit_nbr',
        'city_id', 'owner_id', 'creator_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class,'owner_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function doctors()
    {
        return $this->belongsToMany(User::class, 'establishment_user', 'establishment_id', 'doctor_id');
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function calendars()
    {
        return $this->hasMany(Calendar::class);
    }

    public function creator()
    {
        return $this->hasOne(User::class);
    }

    public function imgs()
    {
        return $this->hasMany(Img::class);
    }

    /**
     * @param array $data attributes of Establishment and Owner.
     * @return Establishment
     */
    public function onStore(array $data)
    {
        $owner = new User();

        if(Category::where('id',$data['category'])->first()->category === 'doctor'){

            $owner = $owner->onStoreDoctor($data);

        }
        else{
            $owner = $owner->onStore($data);
        }

        $establishment = $this->create([
            'name'          => $data['name'],
            'description'   => $data['description'],
            'address'       => $data['address_establishment'],
            'build'         => $data['build'],
            'floor'         => $data['floor'],
            'apt_nbr'       => $data['apt_nbr'],
            'zip'           => $data['zip'],
            'city_id'       => $data['city'],
            'owner_id'      => $owner->id,
            'creator_id'    => auth()->user()->id,
        ]);

        if(isset($data['phones_establishment'][0])){

            foreach ($data['phones_establishment'] as $phone) {

                $establishment->phones()->create([
                    'phone'     => $phone
                ]);

            }

        }

        if(isset($data['imgs'][0])){

            foreach ($data['imgs'] as $img) {
                $establishment->imgs()->create(['img' => $img]);
            }

        }

        return $establishment;

    }
}
