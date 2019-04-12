<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $id
 * @property string $last_name
 * @property string $first_name
 * @property string $birth
 * @property string $address
 * @property string $email
 * @property string $password
 * @property integer $category_id
 * @property integer $specialty_id
 * @property integer $sex_id
 * @property integer $city_id
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Category $category
 * @property Specialty $specialty
 * @property Sexe $sexe
 * @property Phone $phones
 * @property City $city
 * @property Seance $seance
 * @property Establishment $establishment // my establishment
 * @property Establishment $establishments // establishment where i work
 * @property Invoice $invoices
 * @property Appointment $patient_appointments
 * @property Assistance $assistants
 * @property Assistance $doctors
 * @property Establishment $establishments_created
 * @property Experience $experiences
 */
class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'face',
        'first_name', 'last_name', 'birth', 'address', 'visit_nbr',
        'description',
        'email', 'password',
        'category_id', 'specialty_id', 'sexe_id', 'city_id',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relationships

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function sexe()
    {
        return $this->belongsTo(Sexe::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function seance()
    {
        return $this->hasOne(Seance::class,'doctor_id');
    }

    public function establishment()
    {
        return $this->hasOne(Establishment::class,'owner_id');
    }

    public function establishments()
    {
        return $this->belongsToMany(Establishment::class, 'establishment_user', 'doctor_id', 'establishment_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class,'created_by');
    }

    public function patient_appointments()
    {
        return $this->hasMany(Appointment::class,'patient_id');
    }

    public function doctors()
    {
        return $this->hasMany(Assistance::class,'assistance_id');
    }

    public function assistants()
    {
        return $this->hasMany(Assistance::class,'doctor_id');
    }

    public function establishments_created()
    {
        return $this->hasMany(Establishment::class,'creator_id');
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class,'doctor_id');
    }

    // Operating

    /**
     * @param array $data
     * @return User Admin
     */

    public function onStore(array $data)
    {

        $user = $this->create([
            'face'              => $data['face'],
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'birth'             => $data['birth'],
            'address'           => $data['address'],
            'email'             => $data['email'],
            'password'          => bcrypt($data['password']),
            'category_id'       => $data['category'],
            'sexe_id'           => $data['sexe'],
            'city_id'           => $data['city'],
        ]);


        if(isset($data['phones'][0])) {

            foreach ($data['phones'] as $phone) {
                $user->phones()->create([
                    'phone' => $phone
                ]);
            }

        }

        return $user;

    }

    public function onStoreDoctor(array $data)
    {

        $user = $this->create([
            'face'              => $data['face'],
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'birth'             => $data['birth'],
            'address'           => $data['address'],
            'description'       => $data['description'],
            'email'             => $data['email'],
            'password'          => bcrypt($data['password']),
            'category_id'       => $data['category'],
            'specialty_id'      => $data['specialty'],
            'sexe_id'           => $data['sexe'],
            'city_id'           => $data['city'],
        ]);

        if(isset($data['phones'][0])) {

            foreach ($data['phones'] as $phone) {
                $user->phones()->create([
                    'phone' => $phone
                ]);
            }

        }

        if(isset($data['establishments'])){

            foreach ($data['establishments'] as $establishment) {
                $user->establishments()->sync($establishment);
            }

        }

        if(isset($data['faculties'][0])){

            $user->onStoreFaculty($data);

        }

        if(isset($data['experiences'][0])){

            $user->onStoreExperience($data);

        }

        $user->seance()->create([
            'price'     => (isset($data['price'])) ? $data['price'] : null,
            'seance'    => $data['seance']
        ]);

        return $user;

    }

    public function onStoreExperience(array $data)
    {
        foreach ($data['experiences'] as $experience) {

            $this->experiences()->create([
                'experience'    => true,
                'name'          => $experience['name'],
                'address'       => $experience['address'],
                'build'         => $experience['build'],
                'floor'         => $experience['floor'],
                'apt_nbr'       => $experience['apt_nbr'],
                'zip'           => $experience['zip'],
                'start'         => $experience['start'],
                'end'           => $experience['end'],
            ]);

        }
    }

    public function onStoreFaculty(array $data)
    {
        foreach ($data['faculties'] as $experience) {

            $this->experiences()->create([
                'name'          => $experience['name'],
                'address'       => $experience['address'],
                'build'         => $experience['build'],
                'floor'         => $experience['floor'],
                'apt_nbr'       => $experience['apt_nbr'],
                'zip'           => $experience['zip'],
                'start'         => $experience['start'],
                'end'           => $experience['end'],
            ]);

        }
    }

    public function onStoreAssistant(array $data)
    {
        $user = $this->onStore($data);

        $user->establishments()->sync($data['establishment']);

        $user->doctors()->create(['doctor_id' => $data['doctor']]);

        return $user;
    }

    public function onStoreAppointment($data)
    {
        $this->patient_appointments()->create([
            'price'         => (isset($data['price'])) ? $data['price'] : null,
            'reason'        => (isset($data['reason'])) ? $data['reason'] : '',
            'calendar_id'   => $data['calendar_id']
        ]);
    }

}
