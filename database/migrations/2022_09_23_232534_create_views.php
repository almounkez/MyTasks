<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE OR REPLACE  VIEW `proj_summary` AS select  `tasks`.`project_name` AS `project_name`, `tasks`.`user_id` AS `user_id`,sum(case when  `tasks`.`task_finished` = 1 then 1 else 0 end) AS `finished`,sum(case when  `tasks`.`task_finished` = 0 then 1 else 0 end) AS `unfinished` from  `tasks` where  `tasks`.`user_id` = 1 group by  `tasks`.`project_name`, `tasks`.`user_id` order by  `tasks`.`project_name`");
        DB::unprepared("CREATE OR REPLACE VIEW  `tasks_list` AS select  `tasks`.`id` AS `id`, `tasks`.`user_id` AS `user_id`, `tasks`.`project_name` AS `project_name`, `tasks`.`task_amount` AS `task_amount`, `tasks`.`task_duedate` AS `task_duedate`, `tasks`.`task_description` AS `task_description`, `tasks`.`task_eval` AS `task_eval`, `tasks`.`task_finished` AS `task_finished`, `tasks`.`created_at` AS `created_at`, `tasks`.`updated_at` AS `updated_at`,case when  `tasks`.`task_finished` = 0 then ifnull(to_days( `tasks`.`task_duedate`) - to_days(curdate()),0) else 0 end AS `duedays`,case when  `tasks`.`task_finished` = 1 then ifnull(to_days( `tasks`.`updated_at`) - to_days( `tasks`.`created_at`),0) else 0 end AS `taskdays` from  `tasks`");
        DB::unprepared("CREATE OR REPLACE VIEW  `tasks_period` AS select count(0) AS `cnt`,sum(case when  `tasks`.`task_finished` = 1 then 1 else 0 end) AS `finished`,sum(case when  `tasks`.`task_finished` = 0 then 1 else 0 end) AS `unfinished`,year( `tasks`.`task_duedate`) AS `tyear`,month( `tasks`.`task_duedate`) AS `tmonth`, `tasks`.`user_id` AS `user_id` from  `tasks` group by year( `tasks`.`task_duedate`),month( `tasks`.`task_duedate`), `tasks`.`user_id`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS `tasks_list`');
        DB::unprepared('DROP VIEW IF EXISTS `proj_summary`');
        DB::unprepared('DROP VIEW IF EXISTS `tasks_period`');
    }
};
