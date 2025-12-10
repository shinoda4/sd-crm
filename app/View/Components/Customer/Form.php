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

namespace App\View\Components\Customer;

use App\Models\Customer;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public Customer $customer;

    /**
     * Create a new component instance.
     */
    public function __construct(?Customer $customer = null)
    {
        $this->customer = $customer ?? new Customer();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.customer.form');
    }
}
