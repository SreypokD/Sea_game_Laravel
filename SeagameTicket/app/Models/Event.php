<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    use HasFactory;
    protected $fillable =[
        'sportName',
        'typePlayer',
        'schedule',
        'stadium_id',
        'event_detail_id',
    ];
    public function tickets(): HasMany{
        return $this-> HasMany(Ticket::class);
    } 
    public function stadiums(): HasOne{
        return $this-> hasOne(Stadium::class);
    } 
    public function event_details(): HasOne{
        return $this-> hasOne(Event_detail::class);
    } 
}
