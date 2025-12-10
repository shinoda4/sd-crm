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

namespace App\Http\Controllers;

use App\Http\Requests\Contact\UpdateCustomerRequest;
use App\Models\Contact;
use App\Models\Customer;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $contacts = Contact::query()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('title', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->paginate(10)
            ->withQueryString();

        return view('contacts.index', compact('contacts', 'search'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'title' => 'nullable|string',
            'phone' => 'nullable|string',
            'customer_id' => 'required|integer|exists:customers,id',
            'notes' => 'nullable|string',
        ]);

        $contact = Contact::create($data);
        $contact->activities()->create([
            'user_id' => auth()->id(),
            'type' => 'create',
            'content' => '创建联系人'
        ]);

        return redirect()->route('contacts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::select('id', 'name')->orderBy('name')->get();

        return view('contacts.create', [
            'customers' => $customers,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $contact->load('customer');
        $customers = Customer::all();

        return view('contacts.edit', compact('contact', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Contact $contact)
    {
        $contact->update($request->validated());
        $contact->activities()->create([
            'user_id' => auth()->id(),
            'type' => 'update',
            'content' => '更新联系人信息'
        ]);
        return redirect()->route('contacts.show', $contact)->with('success', '已更新');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', '已删除');
    }
}
