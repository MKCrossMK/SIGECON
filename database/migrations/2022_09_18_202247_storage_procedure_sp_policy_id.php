<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
        CREATE PROCEDURE `sp_policy_id` (IN date_start DATE, sucursal INT) 
        BEGIN
            DECLARE policy_id varchar(15);
            DECLARE query INT;
         SELECT COUNT(*) INTO query FROM policies where YEAR(date_start) = YEAR(DATE(NOW())) AND branch_offices_id = sucursal;
           SET policy_id = CONCAT(sucursal, '-', MONTH(NOW()), '-', (SELECT (query + 1)), '-', YEAR(DATE(NOW())));
           SELECT policy_id;
        END
        ";

        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $procedure = "DROP PROCEDURE IF EXISTS sp_policy_id";
        DB::unprepared($procedure);

    }
};
