CREATE OR REPLACE VIEW public.view_weekly_schedules
 AS
SELECT wk.id,
       wk.created_by,
       wk.updated_by,
       wk.deleted_by,
       wk.updated_at,
       wk.created_at,
       wk.deleted_at,
       wk.code,
       wkt.id AS weekly_schedule_translation_id,
       wkt.language_code,
       wkt.name
FROM weekly_schedules wk
         LEFT JOIN weekly_schedule_translations wkt ON wk.id = wkt.weekly_schedule_id;
