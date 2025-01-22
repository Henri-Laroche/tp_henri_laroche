<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\RedirectResponse;

/**
 * @method static create(array $array)
 * @method static where(string $string, int|string|null $id)
 */
class ShortLink extends Model
{
    use HasFactory;
    protected $fillable = ['original_url', 'short_url', 'click_count', 'users_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function redirect($shortUrl): RedirectResponse
    {
        $link = ShortLink::where('short_url', $shortUrl)->firstOrFail();
        $link->increment('click_count');
        return redirect()->to($link->original_url);
    }

}
