<?php
/**
 * Created by PhpStorm.
 * User: faridcs
 * Date: 12/26/17
 * Time: 11:20 AM
 */

namespace App\Services\Utils;

use Closure;
use DB;

class Transaction
{
    /**
     * Run transaction
     *
     * @param Closure $closure
     * @return mixed
     * @throws \Exception
     * @throws \Throwable
     */
    public static function run(Closure $closure)
    {
        return DB::transaction(function () use ($closure) {
            return DB::connection('mysql')->transaction($closure);
        });
    }

    /**
     * Begin transaction
     *
     * @throws \Exception
     */
    public static function begin()
    {
        DB::beginTransaction();
        DB::connection('mysql')->beginTransaction();
    }

    /**
     * Commit transaction
     */
    public static function commit()
    {
        DB::commit();
        DB::connection('mysql')->commit();
    }
}