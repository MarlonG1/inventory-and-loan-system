<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Http\Interfaces\ISearch;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements ISearch
{
    use HasApiTokens, HasFactory, Notifiable, SearchTrait;

    protected $model = self::class;
    protected $fillable = [
        'google_id',
        'departamento_id',
        'carrera_id',
        'name',
        'lastname',
        'email',
        'password',
        'type',
        'phone',
        'carnet',
        'birth_date',
        'image',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    //Atributos para la busqueda
    protected $relations = ['departamento', 'carrera'];
    protected array $tables = ['users', 'departamentos', 'carreras'];
    protected array $fields = [
        'users' => ['name', 'lastname', 'type'],
        'departamentos' => [],
        'carreras' => ['nombre'],
    ];
    protected array $joins = [
        [
            'table' => 'departamentos',
            'firstKey' => 'departamentos.id',
            'secondKey' => 'users.departamento_id',
        ],
        [
            'table' => 'carreras',
            'firstKey' => 'carreras.id',
            'secondKey' => 'users.carrera_id',
        ],
    ];

    public function prestamos() : HasMany
    {
        return $this->hasMany(Prestamo::class);
    }

    public function departamento() : belongsTo
    {
        return $this->belongsTo(Departamento::class);
    }

    public function carrera() : belongsTo
    {
        return $this->belongsTo(Carrera::class);
    }

    //Metodos para la busqueda
    function getModel()
    {
        return app($this->model);
    }

    function getTables(): array
    {
        return $this->tables;
    }

    function getFields(): array
    {
        return $this->fields;
    }

    function getJoins(): array
    {
        return $this->joins;
    }

    function getRelations(): array
    {
        return $this->relations;
    }
}
