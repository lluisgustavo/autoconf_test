<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class IgnoreSoftDeleted implements Rule
{
    protected $table;
    protected $column;

    public function __construct($table, $column)
    {
        $this->table = $table;
        $this->column = $column;
    }

    public function passes($attribute, $value)
    {
        $record = DB::table($this->table)
            ->where($this->column, $value)
            ->whereNotNull('deleted_at')
            ->first();
 
        return $record === null || $record->deleted_at !== null;
    }

    public function message()
    {
        return 'O campo :attribute já está sendo utilizado.';
    }
}