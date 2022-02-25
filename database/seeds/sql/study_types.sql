INSERT INTO public.study_types (id,created_by,created_at) VALUES
	 (1,1,NOW()),
	 (2,1,NOW()),
	 (3,1,NOW());
	 

SELECT setval('study_types_id_seq', max(id)) FROM public.study_types;
