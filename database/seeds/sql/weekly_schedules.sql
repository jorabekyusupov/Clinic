INSERT INTO public.weekly_schedules (id,code,created_by,created_at) VALUES
	 (1,'A',1,NOW()),
	 (2,'B',1,NOW()),
	 (3,'C',1,NOW()),
	 (4,'D',1,NOW());

SELECT setval('weekly_schedules_id_seq', max(id)) FROM public.weekly_schedules;
