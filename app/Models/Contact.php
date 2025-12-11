<?php
/*
 * Copyright (c) 2025 Shunde
 * All rights reserved.
 *
 * This source code is strictly confidential and proprietary.
 * The content of this file may not be disclosed to third parties, copied or
 * duplicated in any form, in whole or in part, without the prior written
 * permission of Shunde.
 *
 * Use of this source code is governed by the terms of the license agreement
 * contained in the LICENSE file found in the root directory of this source tree.
 * If no LICENSE file is found, use is strictly prohibited.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    use HasFactory;
    protected $fillable = ['customer_id', 'name', 'title', 'email', 'phone'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'related');
    }

}
