<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Table;
use Illuminate\Support\Facades\Log;

class TableController extends Controller
{
    public function index()
    {
        try {
            $tables = Table::select('id', 'table_size', 'table_type', 'table_image', 'table_amount')->get();
            return view('hotelViews.table_list', compact('tables'));

        } catch (\Exception $e) {
            // Log error
            Log::error('Failed to fetch tables: ' . $e->getMessage());

            return redirect()->route('hotelViews.tableShow')->with('error', 'Failed to fetch tables. Please try again.');
        }
    }



    public function tableShow()
    {
        return view('hotelViews.new_table');
    }



    public function storeTable(Request $request)
    {
        try {
            $request->validate([
                'table_size' => 'required|integer',
                'table_type' => 'required|string',
                'table_amount' => 'required|numeric|min:0',
                'table_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle file upload
            if ($request->hasFile('table_image')) {
                $path = $request->file('table_image')->store('public/images');
                $path = str_replace('public/', '', $path); 
            }

            // Create the table record
            $table = Table::create([
                'table_size' => $request->input('table_size'),
                'table_type' => $request->input('table_type'),
                'table_amount' => $request->input('table_amount'),
                'table_image' => $path ?? null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Logging success
            Log::info('Table created successfully.', ['table_id' => $table->id]);

            return redirect()->route('hotelViews.tableShow')->with('success', 'Table information stored successfully.');

        } catch (\Exception $e) {
            // Log error
            Log::error('Failed to store table: ' . $e->getMessage());

            return redirect()->route('hotelViews.tableShow')->with('error', 'Failed to store table. Please try again.');
        }
    }

    public function edit($id){
        $table=Table::find($id);

        if(!$table){
            // return redirect()->route('newVenue')->with('error');
        }

        return view('hotelViews.updateTable',compact('table'));
    }


    public function update(Request $request,$id)
{
    try {
        $request->validate([
            'id' => 'required|exists:tables,id',
            'table_size' => 'required|integer',
            'table_type' => 'required|string',
            'table_amount' => 'required|numeric|min:0',
            'table_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $table = Table::findOrFail($request->input('id'));

        if ($request->hasFile('table_image')) {
            // Delete old image if exists
            if ($table->table_image) {
                Storage::delete('public/' . $table->table_image);
            }

            // Store new image
            $path = $request->file('table_image')->store('public/images');
            $table->table_image = str_replace('public/', '', $path);
        }

        $table->table_size = $request->input('table_size');
        $table->table_type = $request->input('table_type');
        $table->table_amount = $request->input('table_amount');
        $table->save();

        // Logging success
        Log::info('Table updated successfully.', ['table_id' => $table->id]);

        return redirect()->route('hhotelViews.index')->with('success', 'Table information updated successfully.');

    } catch (\Exception $e) {
        // Log error
        Log::error('Failed to update table: ' . $e->getMessage());

        return redirect()->route('hotelViews.index')->with('error', 'Failed to update table. Please try again.');
    }
}


    public function deleteTable(Request $request)
    {
        try {
            $id = $request->input('id'); // Retrieve the 'id' parameter from the request

            $table = Table::find($id);

            if (!$table) {
                return redirect()->route('hotelViews.index')->with('error', 'Table not found.');
            }

            // Delete table image if exists
            if ($table->table_image) {
                Storage::delete('public/' . $table->table_image);
            }

            $table->delete();

            // Logging success
            Log::info('Table deleted successfully.', ['table_id' => $id]);

            return redirect()->route('hotelViews.index')->with('success', 'Table deleted successfully.');

        } catch (\Exception $e) {
            // Log error
            Log::error('Failed to delete table: ' . $e->getMessage());

            return redirect()->route('hotelViews.index')->with('error', 'Failed to delete table. Please try again.');
        }
    }
}
