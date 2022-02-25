INSERT INTO public.study_degrees (id,created_by,created_at) VALUES
	 (1,1,NOW()),
	 (2,1,NOW()),
	 (3,1,NOW()),
	 (4,1,NOW()),
	 (5,1,NOW()),
	 (6,1,NOW()),
	 (7,1,NOW());
	 

SELECT setval('study_degrees_id_seq', max(id)) FROM public.study_degrees;
